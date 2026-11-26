const LOADING_LABELS = {
    default: 'Saving...',
    contact: 'Sending...',
    booking: 'Submitting...',
};

function resolveLoadingLabel(form, button) {
    const custom = button.dataset.loadingText || form.dataset.loadingText;
    if (custom) {
        return custom;
    }

    if (form.matches('.contact-form') || form.action.includes('/contact')) {
        return LOADING_LABELS.contact;
    }

    if (form.id === 'sessionBookingForm' || form.action.includes('session-bookings')) {
        return LOADING_LABELS.booking;
    }

    return LOADING_LABELS.default;
}

function lockSubmitButtons(form) {
    const buttons = Array.from(form.querySelectorAll('button[type="submit"], input[type="submit"]'));

    buttons.forEach((button) => {
        if (button.dataset.submitLocked === 'true') {
            return;
        }

        button.dataset.submitLocked = 'true';
        button.disabled = true;
        button.setAttribute('aria-busy', 'true');

        if (button instanceof HTMLInputElement) {
            button.dataset.originalValue = button.value;
            button.value = resolveLoadingLabel(form, button);
            return;
        }

        button.dataset.originalHtml = button.innerHTML;
        button.innerHTML = `<span class="submit-spinner" aria-hidden="true"></span><span>${resolveLoadingLabel(form, button)}</span>`;
    });

    return buttons;
}

function unlockSubmitButtons(form) {
    form.querySelectorAll('[data-submit-locked="true"]').forEach((button) => {
        button.disabled = false;
        button.removeAttribute('aria-busy');
        button.dataset.submitLocked = 'false';

        if (button instanceof HTMLInputElement && button.dataset.originalValue) {
            button.value = button.dataset.originalValue;
            return;
        }

        if (button.dataset.originalHtml) {
            button.innerHTML = button.dataset.originalHtml;
        }
    });
}

export function guardFormSubmission(form) {
    if (!(form instanceof HTMLFormElement) || form.dataset.submitGuardBound === 'true') {
        return;
    }

    form.dataset.submitGuardBound = 'true';

    form.addEventListener('submit', (event) => {
        if (form.dataset.submitting === 'true') {
            event.preventDefault();
            event.stopImmediatePropagation();
            return;
        }

        form.dataset.submitting = 'true';
        lockSubmitButtons(form);

        // Native navigations keep the lock; AJAX forms can unlock via custom event.
        form.addEventListener('submit:unlock', () => {
            form.dataset.submitting = 'false';
            unlockSubmitButtons(form);
        }, { once: true });
    }, true);
}

export function initFormSubmitGuards(root = document) {
    root.querySelectorAll('form[method="post"], form[method="POST"], form[data-submit-guard]').forEach((form) => {
        const method = (form.getAttribute('method') || 'get').toLowerCase();
        const spoofed = (form.querySelector('input[name="_method"]')?.value || '').toLowerCase();
        const effective = spoofed || method;

        if (! ['post', 'put', 'patch'].includes(effective) && ! form.hasAttribute('data-submit-guard')) {
            return;
        }

        // Skip destructive confirm forms in index tables unless marked.
        const methodSpoof = (form.querySelector('input[name="_method"]')?.value || '').toLowerCase();
        if ((form.classList.contains('inline-delete') || methodSpoof === 'delete') && ! form.hasAttribute('data-submit-guard')) {
            return;
        }

        guardFormSubmission(form);
    });
}

export function unlockFormSubmission(form) {
    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    form.dispatchEvent(new Event('submit:unlock'));
}
