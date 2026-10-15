{{-- VI Studio Travel CRM — Login Page Demo Request & Back Navigation --}}
<div class="mt-6 pt-5 border-t border-purple-500/20 text-center space-y-3">
    <div class="flex items-center justify-center gap-2">
        <span class="text-xs text-indigo-200/70 font-medium">Interested in VI Studio Travel CRM?</span>
    </div>

    <div>
        <button 
            type="button" 
            id="vi-open-login-demo-modal"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-semibold tracking-wide text-white uppercase transition-all duration-300 rounded-xl shadow-lg cursor-pointer bg-gradient-to-r from-purple-600 via-indigo-600 to-cyan-500 hover:from-purple-500 hover:to-cyan-400 hover:shadow-purple-500/30 hover:scale-[1.02] active:scale-[0.98] border border-purple-400/30"
        >
            <svg class="w-4 h-4 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <span>Request Demo Access</span>
        </button>
    </div>

    <div>
        <a 
            href="{{ url('/') }}" 
            class="inline-flex items-center gap-1.5 text-xs text-indigo-300/80 hover:text-cyan-300 transition-colors py-1 px-2 rounded-lg hover:bg-white/5"
        >
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
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
                    <p class="vi-login-modal-subtitle">Discover how our all-in-one travel management platform transforms bookings, operations, and agency growth.</p>
                </div>
                <button type="button" class="vi-login-modal-close" id="vi-close-login-demo-modal" aria-label="Close dialog">&times;</button>
            </div>

            {{-- Success State --}}
            <div id="vi-login-demo-success" style="display: none;" class="vi-login-success-box">
                <div class="vi-success-icon-wrap">
                    <svg class="vi-success-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h4>Request Received!</h4>
                <p id="vi-login-demo-success-msg">Thank you! Your demo request has been received. Our team will contact you shortly with your demo environment details.</p>
                <button type="button" class="vi-btn-modal-close" id="vi-btn-success-close">Done</button>
            </div>

            {{-- Form State --}}
            <form id="vi-login-demo-form" class="vi-login-modal-form">
                @csrf
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

                <div class="vi-form-field">
                    <label for="vi-modal-company">Travel Agency / Company</label>
                    <input type="text" id="vi-modal-company" name="company" placeholder="e.g. Apex Journeys Ltd" autocomplete="organization">
                    <div class="vi-field-error" id="vi-error-company"></div>
                </div>

                <div class="vi-form-field">
                    <label for="vi-modal-message">Agency Requirements / Message</label>
                    <textarea id="vi-modal-message" name="message" rows="3" placeholder="Tell us about your team size, destinations, or specific CRM needs..."></textarea>
                    <div class="vi-field-error" id="vi-error-message"></div>
                </div>

                <div class="vi-general-error" id="vi-general-error" style="display: none;"></div>

                <div class="vi-form-actions">
                    <button type="button" class="vi-btn-cancel" id="vi-btn-form-cancel">Cancel</button>
                    <button type="submit" class="vi-btn-submit" id="vi-btn-form-submit">
                        <span id="vi-btn-text">Submit Request</span>
                        <span id="vi-btn-spinner" style="display: none;">
                            <svg class="animate-spin h-4 w-4 text-white inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            Sending...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Modal Base Styles */
.vi-login-modal {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    overflow-y: auto;
}

.vi-login-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(5, 5, 15, 0.85);
    backdrop-filter: blur(16px) saturate(160%);
    animation: vi-fade-in 0.25s ease-out;
}

.vi-login-modal-dialog {
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 32rem;
    margin: auto;
    animation: vi-scale-up 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.vi-login-modal-content {
    background: linear-gradient(145deg, rgba(20, 15, 40, 0.95), rgba(10, 10, 26, 0.98));
    border: 1px solid rgba(124, 58, 237, 0.35);
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 
        0 0 50px rgba(124, 58, 237, 0.25),
        0 0 100px rgba(6, 182, 212, 0.15),
        0 25px 60px rgba(0, 0, 0, 0.7);
    color: #e0e7ff;
    position: relative;
}

.vi-login-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.vi-login-modal-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    background: rgba(124, 58, 237, 0.2);
    border: 1px solid rgba(124, 58, 237, 0.4);
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #00d4ff;
    margin-bottom: 0.5rem;
}

.vi-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #00d4ff;
    box-shadow: 0 0 8px #00d4ff;
}

.vi-login-modal-title {
    font-size: 1.35rem;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.3;
    margin: 0;
    background: linear-gradient(135deg, #ffffff 40%, #c4b5fd 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.vi-login-modal-subtitle {
    font-size: 0.8rem;
    color: #94a3b8;
    margin-top: 0.35rem;
    line-height: 1.4;
}

.vi-login-modal-close {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #cbd5e1;
    font-size: 1.5rem;
    line-height: 1;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.vi-login-modal-close:hover {
    background: rgba(239, 68, 68, 0.25);
    border-color: rgba(239, 68, 68, 0.5);
    color: #f87171;
    transform: rotate(90deg);
}

/* Form Styles */
.vi-login-modal-form {
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}

.vi-form-field {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
    text-align: left;
}

.vi-form-field label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #c4b5fd;
}

.vi-required {
    color: #f43f5e;
}

.vi-form-field input,
.vi-form-field textarea {
    width: 100%;
    padding: 0.65rem 0.9rem;
    background: rgba(10, 10, 26, 0.7);
    border: 1px solid rgba(124, 58, 237, 0.3);
    border-radius: 0.75rem;
    color: #ffffff;
    font-size: 0.875rem;
    font-family: inherit;
    transition: all 0.2s ease;
    outline: none;
    box-sizing: border-box;
}

.vi-form-field input:focus,
.vi-form-field textarea:focus {
    border-color: #00d4ff;
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2);
    background: rgba(15, 15, 35, 0.9);
}

.vi-form-field input::placeholder,
.vi-form-field textarea::placeholder {
    color: #64748b;
}

.vi-field-error {
    font-size: 0.75rem;
    color: #f87171;
    min-height: 1rem;
    display: none;
}

.vi-field-error.visible {
    display: block;
}

.vi-general-error {
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.4);
    color: #fca5a5;
    padding: 0.75rem;
    border-radius: 0.75rem;
    font-size: 0.8rem;
    text-align: center;
}

.vi-form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.75rem;
    margin-top: 0.5rem;
}

.vi-btn-cancel {
    padding: 0.65rem 1.25rem;
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 0.75rem;
    color: #cbd5e1;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.vi-btn-cancel:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
}

.vi-btn-submit {
    padding: 0.65rem 1.5rem;
    background: linear-gradient(135deg, #7c3aed 0%, #06b6d4 100%);
    border: none;
    border-radius: 0.75rem;
    color: #ffffff;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.35);
}

.vi-btn-submit:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5);
}

.vi-btn-submit:disabled {
    opacity: 0.65;
    cursor: not-allowed;
}

/* Success Box */
.vi-login-success-box {
    text-align: center;
    padding: 1.5rem 0.5rem;
}

.vi-success-icon-wrap {
    width: 4rem;
    height: 4rem;
    margin: 0 auto 1.25rem;
    border-radius: 50%;
    background: rgba(16, 185, 129, 0.15);
    border: 2px solid rgba(16, 185, 129, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 25px rgba(16, 185, 129, 0.3);
}

.vi-success-icon {
    width: 2rem;
    height: 2rem;
    color: #34d399;
}

.vi-login-success-box h4 {
    font-size: 1.35rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 0.5rem;
}

.vi-login-success-box p {
    font-size: 0.875rem;
    color: #a5b4fc;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.vi-btn-modal-close {
    padding: 0.65rem 2rem;
    background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
    border: none;
    border-radius: 0.75rem;
    color: #ffffff;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    transition: all 0.2s ease;
}

.vi-btn-modal-close:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

/* Keyframes */
@keyframes vi-fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes vi-scale-up {
    from {
        opacity: 0;
        transform: scale(0.92) translateY(10px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
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
            const message = document.getElementById('vi-modal-message').value.trim();

            let hasError = false;
            if (!name) {
                const err = document.getElementById('vi-error-name');
                if (err) { err.textContent = 'Please provide your full name.'; err.classList.add('visible'); }
                hasError = true;
            }

            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                const err = document.getElementById('vi-error-email');
                if (err) { err.textContent = 'Please provide a valid work email address.'; err.classList.add('visible'); }
                hasError = true;
            }

            if (hasError) return;

            // Submit request
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            btnSpinner.style.display = 'inline-block';

            try {
                // Get CSRF token
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
