<div
    class="session-modal"
    id="bookSessionModal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="sessionModalTitle"
    aria-hidden="true"
>
    <div class="session-modal__backdrop" data-close-session-modal></div>

    <div class="session-modal__dialog" role="document">
        <button
            type="button"
            class="session-modal__close"
            id="closeSessionModalBtn"
            aria-label="Close booking modal"
            data-close-session-modal
        >
            <span aria-hidden="true">&times;</span>
        </button>

        <div class="session-modal__header">
            <p class="section-kicker">Book a Session</p>
            <h2 id="sessionModalTitle">Reserve a calm space to begin</h2>
            <p>
                Share your preferred program and timing. We’ll review your request and get back to you.
            </p>
        </div>

        <form
            class="session-modal__form"
            id="bookSessionForm"
            method="post"
            action="{{ route('session-bookings.store') }}"
            data-submit-guard
            data-loading-text="Submitting..."
            novalidate
        >
            @csrf
            <div class="session-modal__row">
                <div class="session-field">
                    <label for="sessionName">Name</label>
                    <input
                        type="text"
                        id="sessionName"
                        name="name"
                        placeholder="Your full name"
                        autocomplete="name"
                        required
                    >
                    <small class="session-field__error" data-error-for="name"></small>
                </div>

                <div class="session-field">
                    <label for="sessionEmail">Email</label>
                    <input
                        type="email"
                        id="sessionEmail"
                        name="email"
                        placeholder="you@example.com"
                        autocomplete="email"
                        required
                    >
                    <small class="session-field__error" data-error-for="email"></small>
                </div>
            </div>

            <div class="session-modal__row">
                <div class="session-field">
                    <label for="sessionProgram">Program</label>
                    <select id="sessionProgram" name="program" class="session-select" data-theme-dropdown required>
                        <option value="" selected disabled>Choose a program</option>
                        @forelse (($bookingPrograms ?? collect()) as $bookingProgram)
                            <option value="{{ $bookingProgram->title }}">{{ $bookingProgram->title }}</option>
                        @empty
                            <option value="General Mind Training Session">General Mind Training Session</option>
                        @endforelse
                    </select>
                    <small class="session-field__error" data-error-for="program"></small>
                </div>

                <div class="session-field">
                    <label for="sessionTiming">Preferred Timing</label>
                    <select id="sessionTiming" name="timing" data-theme-dropdown required>
                        <option value="" selected disabled>Select a slot</option>
                        <option value="Morning (8:00 AM – 11:00 AM IST)">Morning (8:00 AM – 11:00 AM IST)</option>
                        <option value="Midday (11:30 AM – 2:30 PM IST)">Midday (11:30 AM – 2:30 PM IST)</option>
                        <option value="Afternoon (3:00 PM – 6:00 PM IST)">Afternoon (3:00 PM – 6:00 PM IST)</option>
                        <option value="Evening (6:30 PM – 9:00 PM IST)">Evening (6:30 PM – 9:00 PM IST)</option>
                        <option value="Weekend Flexible Slot">Weekend Flexible Slot</option>
                    </select>
                    <small class="session-field__error" data-error-for="timing"></small>
                </div>
            </div>

            <div class="session-field">
                <label for="sessionMessage">Your Message</label>
                <textarea
                    id="sessionMessage"
                    name="message"
                    rows="3"
                    placeholder="Tell us what you would like to work on or any questions you have..."
                    required
                ></textarea>
                <small class="session-field__error" data-error-for="message"></small>
            </div>

            <div class="session-modal__feedback" id="sessionModalFeedback" role="status" aria-live="polite" hidden></div>

            <div class="session-modal__actions">
                <button type="submit" class="btn btn-primary session-modal__submit" id="sessionSubmitBtn">
                    Send request <span aria-hidden="true">→</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div
    class="session-toast"
    id="sessionBookingToast"
    role="status"
    aria-live="polite"
    hidden
>
    <span class="session-toast__icon" aria-hidden="true">✓</span>
    <div class="session-toast__copy">
        <strong>Thank you!</strong>
        <p>Your session request has been submitted. We will contact you shortly.</p>
    </div>
</div>

<style>
    body.session-modal-open {
        overflow: hidden;
    }

    .session-toast {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 1400;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        max-width: min(92vw, 380px);
        padding: 14px 16px;
        color: #24392a;
        background: #fff;
        border: 1px solid #d7e4cc;
        border-radius: 14px;
        box-shadow: 0 16px 40px rgba(24, 38, 27, .18);
        opacity: 0;
        transform: translateY(12px);
        pointer-events: none;
        transition: opacity .24s ease, transform .24s ease;
    }

    .session-toast.is-visible {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .session-toast[hidden] {
        display: none !important;
    }

    .session-toast.is-visible[hidden] {
        display: flex !important;
    }

    .session-toast__icon {
        display: grid;
        width: 28px;
        height: 28px;
        flex-shrink: 0;
        place-items: center;
        border-radius: 50%;
        color: #fff;
        background: linear-gradient(100deg, #2d7542, #80a947);
        font-size: 13px;
        font-weight: 700;
    }

    .session-toast__copy strong {
        display: block;
        margin: 0 0 3px;
        font-size: 14px;
    }

    .session-toast__copy p {
        margin: 0;
        color: #5d6e5e;
        font-size: 13px;
        line-height: 1.45;
    }

    .session-modal {
        position: fixed;
        inset: 0;
        z-index: 1200;
        display: grid;
        place-items: center;
        padding: 20px;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity .24s ease, visibility .24s ease;
    }

    .session-modal.is-open {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .session-modal__backdrop {
        position: fixed;
        inset: 0;
        background: rgba(24, 38, 27, .52);
        backdrop-filter: blur(6px);
    }

    .session-modal__dialog {
        position: relative;
        z-index: 2;
        width: min(620px, 100%);
        max-height: min(92vh, 720px);
        overflow: visible;
        padding: 26px 28px 22px;
        background:
            radial-gradient(circle at 92% 8%, rgba(168, 204, 148, .2), transparent 34%),
            linear-gradient(155deg, #f9fbf4 0%, #f3f7ec 100%);
        border: 1px solid #d9e4cd;
        border-radius: 24px;
        box-shadow: 0 26px 68px rgba(24, 38, 27, .24);
        transform: translateY(14px) scale(.985);
        transition: transform .25s cubic-bezier(.22, 1, .36, 1);
    }

    .session-modal.is-open .session-modal__dialog {
        transform: translateY(0) scale(1);
    }

    .session-modal__close {
        position: absolute;
        top: 18px;
        right: 18px;
        display: grid;
        place-items: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: 1px solid #d5e2c7;
        background: rgba(255, 255, 255, .9);
        color: #283e2a;
        font-size: 22px;
        line-height: 1;
        cursor: pointer;
        transition: background-color .2s ease, transform .2s ease, color .2s ease;
    }

    .session-modal__close:hover,
    .session-modal__close:focus-visible {
        background: #2d7542;
        border-color: #2d7542;
        color: #fff;
        transform: scale(1.04);
        outline: none;
    }

    .session-modal__header {
        padding-right: 36px;
        margin-bottom: 16px;
    }

    .session-modal__header .section-kicker {
        margin: 0 0 4px;
    }

    .session-modal__header h2 {
        margin: 0 0 6px;
        color: #24392a;
        font-family: var(--font-heading);
        font-size: clamp(24px, 3.2vw, 30px);
        line-height: 1.14;
    }

    .session-modal__header > p:last-child {
        margin: 0;
        color: var(--muted, #5d6e5e);
        font-size: 13px;
        line-height: 1.55;
    }

    .session-modal__form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .session-modal__row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .session-field {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .session-field label {
        color: #30472f;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .9px;
        text-transform: uppercase;
    }

    .session-field input,
    .session-field select,
    .session-field textarea {
        width: 100%;
        padding: 11px 14px;
        border-radius: 12px;
        border: 1px solid #d8e3cd;
        background: rgba(255, 255, 255, .96);
        color: #24392a;
        font-family: inherit;
        font-size: 14px;
        line-height: 1.4;
        transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }

    .session-field select,
    .session-field select.session-select {
        appearance: none;
        -webkit-appearance: none;
        min-height: 48px;
        padding: 12px 46px 12px 14px;
        border: 1px solid #d5e3cb;
        border-radius: 14px;
        background-color: #fcfdf9;
        background-image:
            linear-gradient(45deg, transparent 50%, #2d7542 50%),
            linear-gradient(135deg, #2d7542 50%, transparent 50%),
            linear-gradient(to right, #e3eedb, #e3eedb);
        background-position:
            calc(100% - 20px) calc(50% - 3px),
            calc(100% - 14px) calc(50% - 3px),
            calc(100% - 42px) 50%;
        background-size: 6px 6px, 6px 6px, 1px 56%;
        background-repeat: no-repeat;
        color: #24392a;
        font-weight: 500;
        cursor: pointer;
        transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }

    .session-field select:hover,
    .session-field select.session-select:hover {
        border-color: #b7d0ae;
        background-color: #fff;
    }

    .session-field input::placeholder,
    .session-field textarea::placeholder {
        color: #8c9b89;
    }

    .session-field input:focus,
    .session-field select:focus,
    .session-field textarea:focus {
        outline: none;
        background: #fff;
        border-color: #2d7542;
        box-shadow: 0 0 0 4px rgba(45, 117, 66, .12);
    }

    .session-field textarea {
        min-height: 72px;
        max-height: 88px;
        resize: none;
    }

    .session-field.is-invalid input,
    .session-field.is-invalid select,
    .session-field.is-invalid textarea {
        border-color: #b5473c;
        box-shadow: 0 0 0 3px rgba(181, 71, 60, .1);
    }

    .session-field__error {
        min-height: 14px;
        color: #b5473c;
        font-size: 11px;
        font-weight: 600;
    }

    .session-modal__feedback {
        padding: 11px 14px;
        border-radius: 12px;
        background: #e6f2e8;
        border: 1px solid #b9d9c0;
        color: #20522e;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.45;
    }

    .session-modal__actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 2px;
    }

    .session-modal__submit {
        min-height: 44px;
        padding-inline: 22px;
        font-size: 13px;
    }

    @media (max-width: 650px) {
        .session-modal {
            padding: 12px;
        }

        .session-modal__dialog {
            padding: 22px 18px 18px;
            border-radius: 20px;
            max-height: 94vh;
            overflow-y: auto;
        }

        .session-modal__row {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .session-modal__actions {
            justify-content: stretch;
        }

        .session-modal__submit {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const STORAGE_KEY = 'mind_training_session_queries';
        const modal = document.getElementById('bookSessionModal');
        const form = document.getElementById('bookSessionForm');
        const feedback = document.getElementById('sessionModalFeedback');

        if (!modal || !form || modal.dataset.initialized === 'true') return;
        modal.dataset.initialized = 'true';

        let lastFocusedTrigger = null;

        const getStoredQueries = () => {
            try {
                const raw = localStorage.getItem(STORAGE_KEY);
                const parsed = raw ? JSON.parse(raw) : [];
                return Array.isArray(parsed) ? parsed : [];
            } catch (err) {
                return [];
            }
        };

        const saveQuery = (entry) => {
            const existing = getStoredQueries();
            existing.unshift(entry);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(existing));
            window.dispatchEvent(new CustomEvent('mindtraining:session-query-saved', {
                detail: { query: entry, allQueries: existing }
            }));
        };

        window.MindTrainingSessionStore = {
            getAll: getStoredQueries,
            clear: () => localStorage.removeItem(STORAGE_KEY)
        };

        const clearErrors = () => {
            form.querySelectorAll('.session-field').forEach((field) => {
                field.classList.remove('is-invalid');
            });
            form.querySelectorAll('.session-field__error').forEach((el) => {
                el.textContent = '';
            });
        };

        const setFieldError = (fieldName, message) => {
            const input = form.elements[fieldName];
            const errorEl = form.querySelector(`[data-error-for="${fieldName}"]`);
            const wrapper = input ? input.closest('.session-field') : null;

            if (wrapper) wrapper.classList.add('is-invalid');
            if (errorEl) errorEl.textContent = message;
        };

        const openModal = (triggerEl = null, presetProgram = '') => {
            lastFocusedTrigger = triggerEl || document.activeElement;
            clearErrors();

            if (feedback) {
                feedback.hidden = true;
                feedback.textContent = '';
            }

            if (presetProgram && form.elements.program) {
                const matchingOption = Array.from(form.elements.program.options).find(
                    (opt) => opt.value.toLowerCase() === presetProgram.toLowerCase()
                );
                if (matchingOption) {
                    form.elements.program.value = matchingOption.value;
                    form.elements.program.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('session-modal-open');

            setTimeout(() => {
                form.elements.name?.focus();
            }, 50);
        };

        const closeModal = () => {
            if (!modal.classList.contains('is-open')) return;
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('session-modal-open');

            if (lastFocusedTrigger && typeof lastFocusedTrigger.focus === 'function') {
                lastFocusedTrigger.focus();
            }
        };

        document.addEventListener('click', (e) => {
            if (e.target.closest('[data-close-session-modal]')) {
                closeModal();
                return;
            }

            const trigger = e.target.closest('[data-open-session-modal], a, button');
            if (!trigger) return;

            const hasExplicitAttr = trigger.hasAttribute('data-open-session-modal');
            const text = (trigger.textContent || '').trim().toLowerCase();
            const href = (trigger.getAttribute('href') || '').toLowerCase();

            const isBookSessionTrigger =
                hasExplicitAttr ||
                text.includes('book a session') ||
                text.includes('book my session') ||
                href.includes('book-session') ||
                href.includes('book-a-session');

            if (isBookSessionTrigger) {
                e.preventDefault();
                const presetProgram = trigger.getAttribute('data-program') || '';
                openModal(trigger, presetProgram);
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            clearErrors();

            if (feedback) {
                feedback.hidden = true;
                feedback.textContent = '';
            }

            const name = (form.elements.name?.value || '').trim();
            const email = (form.elements.email?.value || '').trim();
            const program = (form.elements.program?.value || '').trim();
            const timing = (form.elements.timing?.value || '').trim();
            const message = (form.elements.message?.value || '').trim();

            let isValid = true;

            if (!name) {
                setFieldError('name', 'Please enter your name.');
                isValid = false;
            }

            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                setFieldError('email', 'Please enter a valid email address.');
                isValid = false;
            }

            if (!program) {
                setFieldError('program', 'Please select a program.');
                isValid = false;
            }

            if (!timing) {
                setFieldError('timing', 'Please select a preferred timing.');
                isValid = false;
            }

            if (!message) {
                setFieldError('message', 'Please share a short message.');
                isValid = false;
            }

            const submitBtn = document.getElementById('sessionSubmitBtn');
            const unlock = () => {
                if (typeof window.unlockFormSubmission === 'function') {
                    window.unlockFormSubmission(form);
                } else if (submitBtn) {
                    submitBtn.disabled = false;
                }
            };

            if (!isValid) {
                unlock();
                return;
            }

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]')?.value || '',
                    },
                    body: new FormData(form),
                });

                const payload = await response.json().catch(() => ({}));

                if (!response.ok) {
                    if (payload.errors) {
                        Object.entries(payload.errors).forEach(([field, messages]) => {
                            setFieldError(field, Array.isArray(messages) ? messages[0] : String(messages));
                        });
                    } else if (feedback) {
                        feedback.hidden = false;
                        feedback.textContent = payload.message || 'Unable to submit your request. Please try again.';
                    }
                    unlock();
                    return;
                }

                saveQuery({
                    id: 'sess_' + Date.now(),
                    name,
                    email,
                    program,
                    timing,
                    message,
                    status: 'new',
                    created_at: new Date().toISOString(),
                });

                form.reset();
                form.querySelectorAll('select[data-theme-dropdown]').forEach((select) => {
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                });

                closeModal();
                unlock();
                showSessionToast(
                    payload.message || 'Your session request has been submitted. We will contact you shortly.'
                );
            } catch (error) {
                if (feedback) {
                    feedback.hidden = false;
                    feedback.textContent = 'Unable to submit your request. Please try again.';
                }
                unlock();
            }
        });

        const toast = document.getElementById('sessionBookingToast');
        let toastTimer = null;

        const showSessionToast = (message) => {
            if (!toast) return;

            const copy = toast.querySelector('.session-toast__copy p');
            if (copy && message) {
                copy.textContent = message;
            }

            toast.hidden = false;
            requestAnimationFrame(() => toast.classList.add('is-visible'));

            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => {
                toast.classList.remove('is-visible');
                setTimeout(() => {
                    toast.hidden = true;
                }, 250);
            }, 5200);
        };
    });
</script>