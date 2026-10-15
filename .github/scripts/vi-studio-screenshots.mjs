// Drives the running preview app with Chromium: records each page's HTTP status and takes screenshots.
// Throwaway database and demo credentials only (seeded by `php artisan db:seed` in CI).
import { chromium } from 'playwright';

const base = 'http://localhost:8000';
const agency = 'http://demo-travel.localhost:8000';
const results = [];

function note(title, message) {
  console.log(`::notice title=${title}::${message}`);
}

const browser = await chromium.launch();

async function revealAll(page) {
  await page.evaluate(() => document.querySelectorAll('.reveal').forEach((el) => el.classList.add('is-in')));
  await page.waitForTimeout(900);
}

async function visit(page, name, url, { full = false, clip = null } = {}) {
  const response = await page.goto(url, { waitUntil: 'networkidle' }).catch((e) => ({ status: () => `error: ${e.message.slice(0, 80)}` }));
  await revealAll(page);
  const status = response ? response.status() : 'no response';
  const title = (await page.title()).slice(0, 70);
  const overflow = await page.evaluate(() => document.documentElement.scrollWidth > document.documentElement.clientWidth + 1);
  results.push(`${name}=${status}${overflow ? ' H-SCROLL' : ''} [${title}]`);
  await page.screenshot({ path: `shots/${name}.png`, fullPage: full });
}

async function element(page, name, selector) {
  const handle = await page.$(selector);
  if (handle) {
    await handle.scrollIntoViewIfNeeded();
    await page.waitForTimeout(300);
    await handle.screenshot({ path: `shots/${name}.png` });
  } else {
    results.push(`${name}=MISSING ${selector}`);
  }
}

// ---------- Public website, desktop ----------
{
  const context = await browser.newContext({ viewport: { width: 1440, height: 900 } });
  const page = await context.newPage();
  await visit(page, 'home-desktop-hero', `${base}/`);
  await element(page, 'home-desktop-features', '#features');
  await element(page, 'home-desktop-how', '#how-it-works');
  await element(page, 'home-desktop-benefits', '#benefits');
  await element(page, 'home-desktop-demo', '#demo');
  await element(page, 'home-desktop-footer', 'footer.site-footer');

  // Submit the form for real (throwaway database) and look at the thank-you page.
  await page.goto(`${base}/request-demo`, { waitUntil: 'networkidle' });
  await page.fill('#demo-name', 'Asha Rao');
  await page.fill('#demo-email', 'asha@sunrise-travel.test');
  await page.fill('#demo-company', 'Sunrise Travel');
  await page.selectOption('#demo-team', '6-20');
  await page.fill('#demo-message', 'We would like to see bookings and invoicing.');
  await page.check('input[name=consent]');
  await page.waitForTimeout(3500);
  await page.screenshot({ path: 'shots/demo-form-filled.png' });
  await Promise.all([page.waitForURL('**/request-demo/thanks'), page.click('[data-submit]')]);
  results.push(`demo-submit -> ${page.url().replace(base, '')}`);
  await page.screenshot({ path: 'shots/demo-thanks.png' });

  // Validation errors.
  await page.goto(`${base}/request-demo`, { waitUntil: 'networkidle' });
  await page.fill('#demo-name', 'A');
  await page.fill('#demo-email', 'bad');
  await page.evaluate(() => document.querySelector('[data-demo-form]').setAttribute('novalidate', 'novalidate'));
  await page.evaluate(() => document.querySelectorAll('[required]').forEach((el) => el.removeAttribute('required')));
  await page.waitForTimeout(3300);
  await page.click('[data-submit]');
  await page.waitForLoadState('networkidle');
  results.push(`demo-invalid -> ${page.url().replace(base, '')}`);
  await page.screenshot({ path: 'shots/demo-errors.png' });
  await context.close();
}

// ---------- Public website, phone ----------
{
  const context = await browser.newContext({ viewport: { width: 390, height: 844 }, deviceScaleFactor: 2, isMobile: true });
  const page = await context.newPage();
  await visit(page, 'home-mobile-hero', `${base}/`);
  await page.click('[data-nav-toggle]');
  await page.waitForTimeout(400);
  await page.screenshot({ path: 'shots/home-mobile-menu.png' });
  await element(page, 'home-mobile-features', '#features');
  await element(page, 'home-mobile-demo', '#demo');
  await visit(page, 'login-mobile', `${base}/admin/login`);
  await context.close();
}

// ---------- Super Admin panel ----------
{
  const context = await browser.newContext({ viewport: { width: 1440, height: 900 } });
  const page = await context.newPage();
  await visit(page, 'login-desktop', `${base}/admin/login`);
  await page.fill('input[type=email]', 'admin@example.com');
  await page.fill('input[type=password]', 'password');
  await page.click('button[type=submit]');
  await page.waitForURL(`${base}/admin`, { timeout: 30000 }).catch(() => {});
  results.push(`admin-login -> ${page.url().replace(base, '')}`);
  await page.waitForLoadState('networkidle');
  await page.waitForTimeout(1200);
  await page.screenshot({ path: 'shots/admin-dashboard.png' });
  await visit(page, 'admin-saas-leads', `${base}/admin/saas-leads`);
  await visit(page, 'admin-tenants', `${base}/admin/tenants`);
  await visit(page, 'admin-tenant-create', `${base}/admin/tenants/create`);

  const phone = await browser.newContext({ viewport: { width: 390, height: 844 }, deviceScaleFactor: 2, isMobile: true, storageState: await context.storageState() });
  const mobile = await phone.newPage();
  await visit(mobile, 'admin-mobile-dashboard', `${base}/admin`);
  await context.close();
  await phone.close();
}

// ---------- Agency staff panel and customer portal (agency subdomain) ----------
{
  const context = await browser.newContext({ viewport: { width: 1440, height: 900 } });
  const page = await context.newPage();
  await visit(page, 'tenant-login', `${agency}/tenant/login`);
  await page.fill('input[type=email]', 'staff@example.com');
  await page.fill('input[type=password]', 'password');
  await page.click('button[type=submit]');
  await page.waitForURL(`${agency}/tenant`, { timeout: 30000 }).catch(() => {});
  results.push(`tenant-login -> ${page.url().replace(agency, '')}`);
  await page.waitForLoadState('networkidle');
  await page.waitForTimeout(1200);
  await page.screenshot({ path: 'shots/tenant-dashboard.png' });
  await visit(page, 'tenant-customers', `${agency}/tenant/customers`);
  await visit(page, 'tenant-bookings', `${agency}/tenant/bookings`);
  await visit(page, 'portal-login', `${agency}/portal/login`);
  await context.close();
}

await browser.close();
note('Preview results', results.join(' | '));
console.log(results.join('\n'));
