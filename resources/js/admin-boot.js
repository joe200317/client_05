import { initThemeDropdowns } from './theme-dropdown';
import { initFormSubmitGuards } from './form-submit-guard';
import { initMediaUploads } from './media-upload';

document.addEventListener('DOMContentLoaded', () => {
    initThemeDropdowns();
    initFormSubmitGuards();
    initMediaUploads();
});
