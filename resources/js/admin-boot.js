import { initThemeDropdowns } from './theme-dropdown';
import { initFormSubmitGuards } from './form-submit-guard';
import { initMediaUploads } from './media-upload';
import { initPasswordToggles } from './password-toggle';

document.addEventListener('DOMContentLoaded', () => {
    initThemeDropdowns();
    initFormSubmitGuards();
    initMediaUploads();
    initPasswordToggles();
});
