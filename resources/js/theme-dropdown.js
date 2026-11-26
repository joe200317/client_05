const CHEVRON_SVG = `
<svg class="theme-dd__chevron" viewBox="0 0 24 24" aria-hidden="true">
    <path d="m7 10 5 5 5-5"/>
</svg>
`;

function selectedLabel(select) {
    const option = select.options[select.selectedIndex];
    if (!option || option.value === '' || option.disabled) {
        return {
            label: option?.textContent?.trim() || 'Select an option',
            placeholder: true,
        };
    }

    return {
        label: option.textContent.trim(),
        placeholder: false,
    };
}

function closeMenu(trigger, menu) {
    trigger.setAttribute('aria-expanded', 'false');
    menu.classList.remove('is-open');
}

function openMenu(trigger, menu) {
    trigger.setAttribute('aria-expanded', 'true');
    menu.classList.add('is-open');
    menu.querySelector('button')?.focus();
}

function rebuildOptions(select, menu, valueEl, trigger) {
    menu.innerHTML = '';

    Array.from(select.options).forEach((option) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'theme-dd__option';
        button.setAttribute('role', 'option');
        button.dataset.value = option.value;
        button.textContent = option.textContent.trim();

        if (option.disabled && option.value === '') {
            button.dataset.placeholder = 'true';
        }

        if (option.selected) {
            button.classList.add('is-selected');
        }

        button.addEventListener('click', () => {
            select.value = option.value;
            select.dispatchEvent(new Event('change', { bubbles: true }));
            select.dispatchEvent(new Event('input', { bubbles: true }));

            menu.querySelectorAll('.theme-dd__option').forEach((item) => item.classList.remove('is-selected'));
            button.classList.add('is-selected');

            const meta = selectedLabel(select);
            valueEl.textContent = meta.label;
            valueEl.classList.toggle('is-placeholder', meta.placeholder);

            closeMenu(trigger, menu);
            trigger.focus();
        });

        menu.appendChild(button);
    });
}

export function enhanceThemeDropdown(select) {
    if (!(select instanceof HTMLSelectElement) || select.dataset.themeEnhanced === 'true') {
        return;
    }

    select.dataset.themeEnhanced = 'true';

    const wrap = document.createElement('div');
    wrap.className = 'theme-dd';
    select.parentNode.insertBefore(wrap, select);
    wrap.appendChild(select);
    select.classList.add('theme-dd__native');
    select.setAttribute('aria-hidden', 'true');
    select.tabIndex = -1;

    const trigger = document.createElement('button');
    trigger.type = 'button';
    trigger.className = 'theme-dd__trigger';
    trigger.setAttribute('aria-haspopup', 'listbox');
    trigger.setAttribute('aria-expanded', 'false');

    const valueEl = document.createElement('span');
    valueEl.className = 'theme-dd__value';
    const meta = selectedLabel(select);
    valueEl.textContent = meta.label;
    valueEl.classList.toggle('is-placeholder', meta.placeholder);

    trigger.appendChild(valueEl);
    trigger.insertAdjacentHTML('beforeend', CHEVRON_SVG);

    const menu = document.createElement('div');
    menu.className = 'theme-dd__menu';
    menu.setAttribute('role', 'listbox');
    if (select.id) {
        menu.setAttribute('aria-labelledby', select.id);
    }

    rebuildOptions(select, menu, valueEl, trigger);

    wrap.appendChild(trigger);
    wrap.appendChild(menu);

    trigger.addEventListener('click', () => {
        const isOpen = trigger.getAttribute('aria-expanded') === 'true';
        document.querySelectorAll('.theme-dd__menu.is-open').forEach((openMenuEl) => {
            if (openMenuEl !== menu) {
                const openTrigger = openMenuEl.parentElement?.querySelector('.theme-dd__trigger');
                if (openTrigger) {
                    closeMenu(openTrigger, openMenuEl);
                }
            }
        });

        if (isOpen) {
            closeMenu(trigger, menu);
        } else {
            openMenu(trigger, menu);
        }
    });

    trigger.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenu(trigger, menu);
        }
    });

    select.addEventListener('change', () => {
        rebuildOptions(select, menu, valueEl, trigger);
        const next = selectedLabel(select);
        valueEl.textContent = next.label;
        valueEl.classList.toggle('is-placeholder', next.placeholder);
    });

    document.addEventListener('click', (event) => {
        if (!wrap.contains(event.target)) {
            closeMenu(trigger, menu);
        }
    });
}

export function initThemeDropdowns(root = document) {
    root.querySelectorAll('select[data-theme-dropdown]').forEach((select) => {
        enhanceThemeDropdown(select);
    });
}
