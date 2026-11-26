const EYE_ICON = `
<svg class="icon-eye" viewBox="0 0 24 24" aria-hidden="true">
    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
    <circle cx="12" cy="12" r="3"/>
</svg>
<svg class="icon-eye-off" viewBox="0 0 24 24" aria-hidden="true">
    <path d="M3 3l18 18"/>
    <path d="M10.6 10.6a2.5 2.5 0 0 0 3.5 3.5"/>
    <path d="M9.9 5.1A10.5 10.5 0 0 1 12 5c6.5 0 10 7 10 7a17.6 17.6 0 0 1-3.1 3.9"/>
    <path d="M6.1 6.1A17.4 17.4 0 0 0 2 12s3.5 7 10 7a10.4 10.4 0 0 0 4.3-.9"/>
</svg>
`;

function ensurePasswordField(input) {
    if (!(input instanceof HTMLInputElement) || input.dataset.passwordToggleReady === 'true') {
        return;
    }

    input.dataset.passwordToggleReady = 'true';

    let wrap = input.closest('.password-field');
    if (! wrap) {
        wrap = document.createElement('div');
        wrap.className = 'password-field';
        input.parentNode.insertBefore(wrap, input);
        wrap.appendChild(input);
    }

    let button = wrap.querySelector('[data-password-toggle]');
    if (! button) {
        button = document.createElement('button');
        button.type = 'button';
        button.className = 'password-toggle';
        button.setAttribute('data-password-toggle', '');
        button.setAttribute('aria-label', 'Show password');
        button.innerHTML = EYE_ICON;
        wrap.appendChild(button);
    }

    button.addEventListener('click', () => {
        const showing = input.type === 'text';
        input.type = showing ? 'password' : 'text';
        button.classList.toggle('is-visible', ! showing);
        button.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
        input.focus();
    });
}

export function initPasswordToggles(root = document) {
    root.querySelectorAll('input[type="password"]').forEach((input) => ensurePasswordField(input));
}
