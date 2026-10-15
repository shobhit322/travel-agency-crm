{{-- VI Studio Travel CRM — Admin Login Page Demo Request Action & Modal --}}

<div class="vi-auth-extra-box">
    <div class="vi-auth-divider">
        <span class="vi-auth-divider-line"></span>
        <span class="vi-auth-divider-text">New to VI Studio?</span>
        <span class="vi-auth-divider-line"></span>
    </div>

    <div class="vi-auth-actions-group">
        <button 
            type="button" 
            id="vi-open-login-demo-modal"
            class="vi-auth-demo-btn"
        >
            <svg 
                class="vi-auth-btn-icon" 
                width="16" 
                height="16" 
                viewBox="0 0 24 24" 
                fill="none" 
                stroke="currentColor" 
                stroke-width="2" 
                stroke-linecap="round" 
                stroke-linejoin="round"
                style="width: 16px; height: 16px; min-width: 16px; min-height: 16px; max-width: 16px; max-height: 16px; display: inline-block; vertical-align: middle; flex-shrink: 0;"
            >
                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
            </svg>
            <span>Request Demo Access</span>
        </button>

        <a 
            href="{{ url('/') }}" 
            class="vi-auth-back-link"
        >
            <svg 
                class="vi-auth-link-icon" 
                width="14" 
                height="14" 
                viewBox="0 0 24 24" 
                fill="none" 
                stroke="currentColor" 
                stroke-width="2" 
                stroke-linecap="round" 
                stroke-linejoin="round"
                style="width: 14px; height: 14px; min-width: 14px; min-height: 14px; max-width: 14px; max-height: 14px; display: inline-block; vertical-align: middle; flex-shrink: 0;"
            >
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Return to Public Website</span>
        </a>
    </div>
</div>

{{-- Demo Request Modal --}}
<div id="vi-login-demo-modal" class="vi-login-modal" aria-hidden="true" role="dialog" style="display: none;">
    <div class="vi-login-modal-backdrop" id="vi-login-modal-backdrop"></div>
    <div class="vi-login-modal-dialog">
        <div class="vi-login-modal-content">
            <div class="vi-login-modal-header">
                <div class="vi-login-modal-title-group">
                    <div class="vi-login-modal-badge">
                        <span class="vi-dot"></span>
                        <span>VI Studio Travel CRM</span>
                    </div>
                    <h3 class="vi-login-modal-title">Request Demo Access</h3>
                    <p class="vi-login-modal-subtitle">Experience our next-generation travel agency management platform customized for your team.</p>
                </div>
                <button type="button" class="vi-login-modal-close" id="vi-close-login-demo-modal" aria-label="Close dialog">&times;</button>
            </div>

            {{-- Success State --}}
            <div id="vi-login-demo-success" style="display: none;" class="vi-login-success-box">
                <div class="vi-success-icon-wrap">
                    <svg 
                        class="vi-success-icon" 
                        width="32" 
                        height="32" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                        style="width: 32px; height: 32px; min-width: 32px; min-height: 32px; display: inline-block;"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h4>Demo Request Received!</h4>
                <p id="vi-login-demo-success-msg">Thank you! Your inquiry has been received. Our team will review your agency details and provision your demo environment within 24 hours.</p>
                <button type="button" class="vi-btn-modal-close" id="vi-btn-success-close">Done</button>
            </div>

            {{-- Form State --}}
            <form id="vi-login-demo-form" class="vi-login-modal-form">
                @csrf
                <div class="vi-form-row">
                    <div class="vi-form-field">
                        <label for="vi-modal-name">Full Name <span class="vi-required">*</span></label>
                        <input type="text" id="vi-modal-name" name="name" required placeholder="e.g. Sarah Jenkins" autocomplete="name">
                        <div class="vi-field-error" id="vi-error-name"></div>
                    </div>

                    <div class="vi-form-field">
                        <label for="vi-modal-email">Work Email <span class="vi-required">*</span></label>
                        <input type="email" id="vi-modal-email" name="email" required placeholder="sarah@travelagency.com" autocomplete="email">
                        <div class="vi-field-error" id="vi-error-email"></div>
                    </div>
                </div>

                <div class="vi-form-row">
                    <div class="vi-form-field">
                        <label for="vi-modal-company">Agency / Company Name <span class="vi-required">*</span></label>
                        <input type="text" id="vi-modal-company" name="company" required placeholder="e.g. Apex Journeys Ltd" autocomplete="organization">
                        <div class="vi-field-error" id="vi-error-company"></div>
                    </div>

                    <div class="vi-form-field">
                        <label for="vi-modal-focus">Primary Focus / Model</label>
                        <select id="vi-modal-focus" name="focus">
                            <option value="Luxury & Tailor-Made">Luxury & Tailor-Made Tours</option>
                            <option value="Group & Adventure Travel">Group & Adventure Travel</option>
                            <option value="Corporate & MICE">Corporate & MICE Management</option>
                            <option value="Destination Management Company (DMC)">DMC (Destination Management)</option>
                            <option value="Independent Travel Agency">Independent Travel Agency</option>
                        </select>
                    </div>
                </div>

                <div class="vi-form-field">
                    <label for="vi-modal-message">Specific Requirements or Inquiries</label>
                    <textarea id="vi-modal-message" name="message" rows="3" placeholder="Tell us about your team size, current pain points, or destinations..."></textarea>
                    <div class="vi-field-error" id="vi-error-message"></div>
                </div>

                <div class="vi-general-error" id="vi-general-error" style="display: none;"></div>

                <div class="vi-form-actions">
                    <button type="button" class="vi-btn-cancel" id="vi-btn-form-cancel">Cancel</button>
                    <button type="submit" class="vi-btn-submit" id="vi-btn-form-submit">
                        <span id="vi-btn-text">Submit Demo Request</span>
                        <span id="vi-btn-spinner" style="display: none;">
                            <svg class="vi-spinner-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity="0.25"></circle>
                                <path fill="currentColor" opacity="0.8" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            Submitting...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* === VI Studio Login Page Extra Actions === */
.vi-auth-extra-box {
    margin-top: 1.5rem !important;
    padding-top: 0.5rem !important;
    text-align: center !important;
    width: 100% !important;
}

.vi-auth-divider {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 0.75rem !important;
    margin-bottom: 1.25rem !important;
}

.vi-auth-divider-line {
    flex: 1 !important;
    height: 1px !important;
    background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.35), transparent) !important;
}

.vi-auth-divider-text {
    font-size: 0.75rem !important;
    color: #a5b4fc !important;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
}

.vi-auth-actions-group {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 0.85rem !important;
}

/* Request Demo Access Button */
.vi-auth-demo-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 0.5rem !important;
    padding: 0.65rem 1.4rem !important;
    font-size: 0.825rem !important;
    font-weight: 600 !important;
    color: #ffffff !important;
    text-decoration: none !important;
    background: linear-gradient(135deg, #7c3aed 0%, #06b6d4 100%) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 0.75rem !important;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.35) !important;
    cursor: pointer !important;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    line-height: 1 !important;
}

.vi-auth-demo-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5), 0 0 15px rgba(0, 212, 255, 0.3) !important;
    border-color: rgba(0, 212, 255, 0.5) !important;
}

.vi-auth-demo-btn:active {
    transform: translateY(0) !important;
}

.vi-auth-btn-icon {
    width: 16px !important;
    height: 16px !important;
    min-width: 16px !important;
    min-height: 16px !important;
    max-width: 16px !important;
    max-height: 16px !important;
    color: #00d4ff !important;
    flex-shrink: 0 !important;
}

/* Return to Public Website Link */
.vi-auth-back-link {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 0.4rem !important;
    font-size: 0.8rem !important;
    color: #94a3b8 !important;
    text-decoration: none !important;
    padding: 0.4rem 0.85rem !important;
    border-radius: 0.5rem !important;
    transition: all 0.2s ease !important;
    background: transparent !important;
    line-height: 1 !important;
}

.vi-auth-back-link:hover {
    color: #00d4ff !important;
    background: rgba(124, 58, 237, 0.12) !important;
}

.vi-auth-link-icon {
    width: 14px !important;
    height: 14px !important;
    min-width: 14px !important;
    min-height: 14px !important;
    max-width: 14px !important;
    max-height: 14px !important;
    color: currentColor !important;
    flex-shrink: 0 !important;
}

/* === Demo Request Modal Overlay & Dialog === */
.vi-login-modal {
    position: fixed !important;
    inset: 0 !important;
    z-index: 99999 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 1.25rem !important;
    overflow-y: auto !important;
}

.vi-login-modal-backdrop {
    position: fixed !important;
    inset: 0 !important;
    background: rgba(5, 5, 18, 0.88) !important;
    backdrop-filter: blur(18px) saturate(180%) !important;
    animation: vi-modal-fade 0.25s ease-out !important;
}

.vi-login-modal-dialog {
    position: relative !important;
    z-index: 10 !important;
    width: 100% !important;
    max-width: 36rem !important;
    margin: auto !important;
    animation: vi-modal-scale 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.vi-login-modal-content {
    background: linear-gradient(150deg, rgba(22, 16, 45, 0.98), rgba(10, 10, 26, 0.99)) !important;
    border: 1px solid rgba(124, 58, 237, 0.35) !important;
    border-radius: 1.5rem !important;
    padding: 2.25rem !important;
    box-shadow: 
        0 0 50px rgba(124, 58, 237, 0.25),
        0 0 100px rgba(6, 182, 212, 0.15),
        0 25px 60px rgba(0, 0, 0, 0.75) !important;
    color: #e0e7ff !important;
    position: relative !important;
}

.vi-login-modal-header {
    display: flex !important;
    align-items: flex-start !important;
    justify-content: space-between !important;
    gap: 1rem !important;
    margin-bottom: 1.5rem !important;
    text-align: left !important;
}

.vi-login-modal-badge {
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
    padding: 0.25rem 0.75rem !important;
    border-radius: 9999px !important;
    background: rgba(124, 58, 237, 0.2) !important;
    border: 1px solid rgba(124, 58, 237, 0.4) !important;
    font-size: 0.725rem !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    color: #00d4ff !important;
    margin-bottom: 0.5rem !important;
}

.vi-dot {
    width: 6px !important;
    height: 6px !important;
    border-radius: 50% !important;
    background: #00d4ff !important;
    box-shadow: 0 0 8px #00d4ff !important;
}

.vi-login-modal-title {
    font-size: 1.4rem !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    line-height: 1.25 !important;
    margin: 0 !important;
    background: linear-gradient(135deg, #ffffff 40%, #c4b5fd 100%) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
}

.vi-login-modal-subtitle {
    font-size: 0.85rem !important;
    color: #94a3b8 !important;
    margin-top: 0.4rem !important;
    line-height: 1.45 !important;
}

.vi-login-modal-close {
    background: rgba(255, 255, 255, 0.08) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #cbd5e1 !important;
    font-size: 1.5rem !important;
    line-height: 1 !important;
    width: 2.25rem !important;
    height: 2.25rem !important;
    border-radius: 50% !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.2s ease !important;
    flex-shrink: 0 !important;
}

.vi-login-modal-close:hover {
    background: rgba(239, 68, 68, 0.25) !important;
    border-color: rgba(239, 68, 68, 0.5) !important;
    color: #f87171 !important;
    transform: rotate(90deg) !important;
}

/* === Form Grid and Inputs === */
.vi-login-modal-form {
    display: flex !important;
    flex-direction: column !important;
    gap: 1.15rem !important;
    text-align: left !important;
}

.vi-form-row {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 1rem !important;
}

@media (max-width: 640px) {
    .vi-form-row {
        grid-template-columns: 1fr !important;
    }
}

.vi-form-field {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.35rem !important;
}

.vi-form-field label {
    font-size: 0.8rem !important;
    font-weight: 600 !important;
    color: #c4b5fd !important;
}

.vi-required {
    color: #f43f5e !important;
}

.vi-form-field input,
.vi-form-field select,
.vi-form-field textarea {
    width: 100% !important;
    padding: 0.65rem 0.9rem !important;
    background: rgba(10, 10, 26, 0.85) !important;
    border: 1px solid rgba(124, 58, 237, 0.35) !important;
    border-radius: 0.75rem !important;
    color: #ffffff !important;
    font-size: 0.875rem !important;
    font-family: inherit !important;
    transition: all 0.2s ease !important;
    outline: none !important;
    box-sizing: border-box !important;
}

.vi-form-field select option {
    background: #0f0f23 !important;
    color: #e0e7ff !important;
}

.vi-form-field input:focus,
.vi-form-field select:focus,
.vi-form-field textarea:focus {
    border-color: #00d4ff !important;
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2) !important;
    background: rgba(15, 15, 35, 0.95) !important;
}

.vi-form-field input::placeholder,
.vi-form-field textarea::placeholder {
    color: #64748b !important;
}

.vi-field-error {
    font-size: 0.75rem !important;
    color: #f87171 !important;
    min-height: 1rem !important;
    display: none !important;
}

.vi-field-error.visible {
    display: block !important;
}

.vi-general-error {
    background: rgba(239, 68, 68, 0.15) !important;
    border: 1px solid rgba(239, 68, 68, 0.4) !important;
    color: #fca5a5 !important;
    padding: 0.75rem !important;
    border-radius: 0.75rem !important;
    font-size: 0.825rem !important;
    text-align: center !important;
}

.vi-form-actions {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    gap: 0.85rem !important;
    margin-top: 0.5rem !important;
}

.vi-btn-cancel {
    padding: 0.65rem 1.25rem !important;
    background: transparent !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    border-radius: 0.75rem !important;
    color: #cbd5e1 !important;
    font-size: 0.85rem !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
}

.vi-btn-cancel:hover {
    background: rgba(255, 255, 255, 0.08) !important;
    color: #ffffff !important;
}

.vi-btn-submit {
    padding: 0.65rem 1.6rem !important;
    background: linear-gradient(135deg, #7c3aed 0%, #06b6d4 100%) !important;
    border: none !important;
    border-radius: 0.75rem !important;
    color: #ffffff !important;
    font-size: 0.85rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.35) !important;
}

.vi-btn-submit:hover:not(:disabled) {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5), 0 0 15px rgba(0, 212, 255, 0.3) !important;
}

.vi-btn-submit:disabled {
    opacity: 0.65 !important;
    cursor: not-allowed !important;
}

/* === Success State === */
.vi-login-success-box {
    text-align: center !important;
    padding: 1.5rem 0.5rem !important;
}

.vi-success-icon-wrap {
    width: 4.5rem !important;
    height: 4.5rem !important;
    margin: 0 auto 1.25rem !important;
    border-radius: 50% !important;
    background: rgba(16, 185, 129, 0.15) !important;
    border: 2px solid rgba(16, 185, 129, 0.4) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: 0 0 30px rgba(16, 185, 129, 0.35) !important;
}

.vi-success-icon {
    width: 32px !important;
    height: 32px !important;
    color: #34d399 !important;
}

.vi-login-success-box h4 {
    font-size: 1.4rem !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    margin-bottom: 0.5rem !important;
}

.vi-login-success-box p {
    font-size: 0.9rem !important;
    color: #a5b4fc !important;
    line-height: 1.55 !important;
    margin-bottom: 1.5rem !important;
}

.vi-btn-modal-close {
    padding: 0.65rem 2.2rem !important;
    background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%) !important;
    border: none !important;
    border-radius: 0.75rem !important;
    color: #ffffff !important;
    font-size: 0.85rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.35) !important;
    transition: all 0.2s ease !important;
}

.vi-btn-modal-close:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.45) !important;
}

/* Animations */
@keyframes vi-modal-fade {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes vi-modal-scale {
    from {
        opacity: 0;
        transform: scale(0.92) translateY(12px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.vi-spinner-icon {
    animation: vi-spin 1s linear infinite !important;
}

@keyframes vi-spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

<script>
(function() {
    function initViDemoModal() {
        const openBtn = document.getElementById('vi-open-login-demo-modal');
        const modal = document.getElementById('vi-login-demo-modal');
        const backdrop = document.getElementById('vi-login-modal-backdrop');
        const closeBtn = document.getElementById('vi-close-login-demo-modal');
        const cancelBtn = document.getElementById('vi-btn-form-cancel');
        const successCloseBtn = document.getElementById('vi-btn-success-close');
        const form = document.getElementById('vi-login-demo-form');
        const successBox = document.getElementById('vi-login-demo-success');
        const generalError = document.getElementById('vi-general-error');
        const submitBtn = document.getElementById('vi-btn-form-submit');
        const btnText = document.getElementById('vi-btn-text');
        const btnSpinner = document.getElementById('vi-btn-spinner');

        if (!openBtn || !modal || !form) return;

        function openModal() {
            modal.style.display = 'flex';
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            form.style.display = 'flex';
            if (successBox) successBox.style.display = 'none';
            if (generalError) {
                generalError.style.display = 'none';
                generalError.textContent = '';
            }
            clearErrors();
            const nameInput = document.getElementById('vi-modal-name');
            if (nameInput) setTimeout(() => nameInput.focus(), 100);
        }

        function closeModal() {
            modal.style.display = 'none';
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function clearErrors() {
            document.querySelectorAll('.vi-field-error').forEach(el => {
                el.textContent = '';
                el.classList.remove('visible');
            });
            if (generalError) {
                generalError.style.display = 'none';
                generalError.textContent = '';
            }
        }

        openBtn.addEventListener('click', openModal);
        if (backdrop) backdrop.addEventListener('click', closeModal);
        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        if (successCloseBtn) successCloseBtn.addEventListener('click', closeModal);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                closeModal();
            }
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            clearErrors();

            const name = document.getElementById('vi-modal-name').value.trim();
            const email = document.getElementById('vi-modal-email').value.trim();
            const company = document.getElementById('vi-modal-company').value.trim();
            const focus = document.getElementById('vi-modal-focus').value;
            const userMsg = document.getElementById('vi-modal-message').value.trim();
            const message = focus ? `[Focus: ${focus}] ${userMsg}` : userMsg;

            let hasError = false;
            if (!name) {
                const err = document.getElementById('vi-error-name');
                if (err) { err.textContent = 'Please enter your full name.'; err.classList.add('visible'); }
                hasError = true;
            }

            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                const err = document.getElementById('vi-error-email');
                if (err) { err.textContent = 'Please enter a valid work email address.'; err.classList.add('visible'); }
                hasError = true;
            }

            if (!company) {
                const err = document.getElementById('vi-error-company');
                if (err) { err.textContent = 'Please enter your travel agency or company name.'; err.classList.add('visible'); }
                hasError = true;
            }

            if (hasError) return;

            submitBtn.disabled = true;
            btnText.style.display = 'none';
            btnSpinner.style.display = 'inline-block';

            try {
                let csrfToken = '';
                const csrfInput = form.querySelector('input[name="_token"]');
                if (csrfInput) {
                    csrfToken = csrfInput.value;
                } else {
                    const metaToken = document.querySelector('meta[name="csrf-token"]');
                    if (metaToken) csrfToken = metaToken.getAttribute('content');
                }

                const response = await fetch('{{ route("demo-request.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ name, email, company, message, _token: csrfToken }),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    form.reset();
                    form.style.display = 'none';
                    if (successBox) {
                        const msgEl = document.getElementById('vi-login-demo-success-msg');
                        if (msgEl && data.message) msgEl.textContent = data.message;
                        successBox.style.display = 'block';
                    }
                } else if (response.status === 422 && data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const err = document.getElementById('vi-error-' + field);
                        if (err) {
                            err.textContent = data.errors[field][0];
                            err.classList.add('visible');
                        }
                    });
                } else {
                    if (generalError) {
                        generalError.textContent = data.message || 'Something went wrong. Please try again.';
                        generalError.style.display = 'block';
                    }
                }
            } catch (err) {
                if (generalError) {
                    generalError.textContent = 'Network error. Please check your connection and try again.';
                    generalError.style.display = 'block';
                }
            } finally {
                submitBtn.disabled = false;
                btnText.style.display = 'inline';
                btnSpinner.style.display = 'none';
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initViDemoModal);
    } else {
        initViDemoModal();
    }
})();
</script>
