const LIMIT_MESSAGE = 'Maximum 1 image is allowed. Please remove the existing image first.';

function showToast(message) {
    let toast = document.querySelector('.media-upload-toast');
    if (! toast) {
        toast = document.createElement('div');
        toast.className = 'media-upload-toast';
        toast.setAttribute('role', 'status');
        document.body.appendChild(toast);
    }

    toast.textContent = message;
    toast.classList.add('is-visible');
    clearTimeout(toast._hideTimer);
    toast._hideTimer = setTimeout(() => toast.classList.remove('is-visible'), 3200);
}

function setPreview(root, url) {
    const preview = root.querySelector('[data-media-preview]');
    const image = root.querySelector('[data-media-image]');
    const error = root.querySelector('[data-media-error]');
    const removeInput = root.querySelector('[data-media-remove]');

    if (! preview || ! image) {
        return;
    }

    image.src = url;
    preview.hidden = false;
    root.dataset.hasImage = 'true';

    if (error) {
        error.hidden = true;
        error.textContent = '';
    }

    if (removeInput) {
        removeInput.value = '0';
    }
}

function clearPreview(root) {
    const preview = root.querySelector('[data-media-preview]');
    const image = root.querySelector('[data-media-image]');
    const input = root.querySelector('[data-media-input]');
    const removeInput = root.querySelector('[data-media-remove]');
    const error = root.querySelector('[data-media-error]');

    if (image?.dataset.objectUrl) {
        URL.revokeObjectURL(image.dataset.objectUrl);
        delete image.dataset.objectUrl;
    }

    if (image) {
        image.removeAttribute('src');
    }

    if (preview) {
        preview.hidden = true;
    }

    if (input) {
        input.value = '';
        if (root.dataset.requiredOnEmpty === 'true') {
            input.required = true;
        }
    }

    if (removeInput) {
        removeInput.value = '1';
    }

    root.dataset.hasImage = 'false';

    if (error) {
        error.hidden = true;
        error.textContent = '';
    }
}

function enhanceMediaUpload(root) {
    if (! (root instanceof HTMLElement) || root.dataset.mediaEnhanced === 'true') {
        return;
    }

    root.dataset.mediaEnhanced = 'true';

    const input = root.querySelector('[data-media-input]');
    const removeBtn = root.querySelector('[data-media-remove-btn]');
    const error = root.querySelector('[data-media-error]');
    const image = root.querySelector('[data-media-image]');

    if (! input) {
        return;
    }

    if (image?.getAttribute('src')) {
        root.dataset.hasImage = 'true';
        input.required = false;
    } else {
        root.dataset.hasImage = 'false';
    }

    input.addEventListener('click', (event) => {
        // Block picking another file while a saved image is still attached.
        if (root.dataset.hasImage === 'true' && image?.getAttribute('src') && ! image.dataset.objectUrl) {
            event.preventDefault();
            if (error) {
                error.hidden = false;
                error.textContent = LIMIT_MESSAGE;
            }
            showToast(LIMIT_MESSAGE);
        }
    });

    input.addEventListener('change', () => {
        const file = input.files?.[0];

        if (! file) {
            return;
        }

        if (root.dataset.hasImage === 'true' && image?.getAttribute('src') && ! image.dataset.objectUrl) {
            // Existing saved image still present — block replacement until remove.
            input.value = '';
            if (error) {
                error.hidden = false;
                error.textContent = LIMIT_MESSAGE;
            }
            showToast(LIMIT_MESSAGE);
            return;
        }

        if (image?.dataset.objectUrl) {
            URL.revokeObjectURL(image.dataset.objectUrl);
        }

        const objectUrl = URL.createObjectURL(file);
        if (image) {
            image.dataset.objectUrl = objectUrl;
        }
        setPreview(root, objectUrl);
        input.required = false;
    });

    removeBtn?.addEventListener('click', (event) => {
        event.preventDefault();
        clearPreview(root);
    });
}

export function initMediaUploads(root = document) {
    root.querySelectorAll('[data-media-upload]').forEach((node) => enhanceMediaUpload(node));
}
