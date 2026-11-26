document.addEventListener('DOMContentLoaded', () => {
    const STORAGE_KEY = 'mind_training_session_queries';
    const modal = document.getElementById('bookSessionModal');
    const form = document.getElementById('bookSessionForm');
    const closeBtn = document.getElementById('closeSessionModalBtn');
    const feedback = document.getElementById('sessionModalFeedback');

    if (!modal || !form) return;

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

    // Expose helper for future admin page integration
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

    // Trigger when clicking any "Book a Session" CTA or element with [data-open-session-modal]
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

    form.addEventListener('submit', (e) => {
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

        if (!isValid) return;

        const newQuery = {
            id: 'sess_' + Date.now(),
            name,
            email,
            program,
            timing,
            message,
            status: 'new',
            created_at: new Date().toISOString()
        };

        saveQuery(newQuery);
        form.reset();

        if (feedback) {
            feedback.hidden = false;
            feedback.textContent =
                'Session request saved! It will be available in the admin view once you connect your admin panel.';
        }
    });
});