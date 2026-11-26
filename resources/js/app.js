import './bootstrap';
import { initThemeDropdowns } from './theme-dropdown';
import { initFormSubmitGuards, unlockFormSubmission } from './form-submit-guard';

document.addEventListener('DOMContentLoaded', () => {
    const revealItems = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealItems.forEach((item) => observer.observe(item));
    } else {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    }

    initThemeDropdowns();
    initFormSubmitGuards();
    window.unlockFormSubmission = unlockFormSubmission;

    // Keep Contact form custom dropdown (reference UI) working as before.
    const dropdown = document.querySelector('.contact-dropdown');
    const dropdownMenu = document.querySelector('.contact-dropdown-menu');
    const dropdownValue = document.querySelector('.contact-dropdown-value');
    const nativeSelect = document.querySelector('.contact-native-select');

    if (dropdown && dropdownMenu && dropdownValue && nativeSelect) {
        const closeDropdown = () => {
            dropdown.setAttribute('aria-expanded', 'false');
            dropdownMenu.classList.remove('is-open');
        };

        dropdown.addEventListener('click', () => {
            const isOpen = dropdown.getAttribute('aria-expanded') === 'true';
            if (isOpen) {
                closeDropdown();
            } else {
                dropdown.setAttribute('aria-expanded', 'true');
                dropdownMenu.classList.add('is-open');
                dropdownMenu.querySelector('button')?.focus();
            }
        });

        dropdownMenu.querySelectorAll('button').forEach((option) => {
            option.addEventListener('click', () => {
                dropdownMenu.querySelectorAll('button').forEach((item) => item.classList.remove('is-selected'));
                option.classList.add('is-selected');
                dropdownValue.textContent = option.textContent.trim();
                nativeSelect.value = option.dataset.value || '';
                nativeSelect.setCustomValidity('');
                closeDropdown();
                dropdown.focus();
            });
        });

        dropdown.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeDropdown();
            }
        });

        document.addEventListener('click', (event) => {
            if (!event.target.closest('.contact-form-grid label')) {
                closeDropdown();
            }
        });
    }

    const phoneInput = document.querySelector('.contact-form input[name="phone"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', () => {
            phoneInput.value = phoneInput.value.replace(/\D/g, '').slice(0, 10);
        });
    }

    const contactForm = document.querySelector('.contact-form');
    if (contactForm && nativeSelect) {
        contactForm.setAttribute('data-loading-text', 'Sending...');
        contactForm.addEventListener('submit', (event) => {
            if (!nativeSelect.value) {
                event.preventDefault();
                unlockFormSubmission(contactForm);
                nativeSelect.setCustomValidity('Please choose what you are interested in.');
                nativeSelect.reportValidity();
                dropdown?.focus();
                return;
            }

            nativeSelect.setCustomValidity('');
        });
    }
});
