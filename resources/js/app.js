const navToggle = document.querySelector('#navToggle');
const navMenu = document.querySelector('#navMenu');
const searchToggle = document.querySelector('#searchToggle');
const searchModal = document.querySelector('#searchModal');
const searchModalClose = document.querySelector('#searchModalClose');

if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
        navMenu.classList.toggle('hidden');
    });
}

if (searchToggle && searchModal) {
    searchToggle.addEventListener('click', () => {
        searchModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
}

if (searchModalClose && searchModal) {
    searchModalClose.addEventListener('click', () => {
        searchModal.classList.add('hidden');
        document.body.style.overflow = '';
    });
}

searchModal?.addEventListener('click', (event) => {
    if (event.target === searchModal) {
        searchModal.classList.add('hidden');
        document.body.style.overflow = '';
    }
});

// Modal confirm flow for forms with class `confirm-action`
const confirmModal = document.getElementById('confirmModal');
const confirmTitle = document.getElementById('confirmModalTitle');
const confirmMessage = document.getElementById('confirmModalMessage');
const confirmBtn = document.getElementById('confirmModalConfirm');
const cancelBtn = document.getElementById('confirmModalCancel');

let pendingForm = null;

document.addEventListener('click', (e) => {
    const btn = e.target.closest('.confirm-action');
    if (!btn) return;

    e.preventDefault();
    const title = btn.dataset.actionTitle || 'Konfirmasi';
    const message = btn.dataset.actionMessage || 'Yakin ingin melanjutkan aksi ini?';

    pendingForm = btn.tagName === 'FORM' ? btn : btn.closest('form');

    confirmTitle.textContent = title;
    confirmMessage.textContent = message;

    confirmModal.classList.add('show');
});

cancelBtn?.addEventListener('click', () => {
    confirmModal.classList.remove('show');
    pendingForm = null;
});

confirmBtn?.addEventListener('click', async () => {
    if (!pendingForm) return;
    // Submit the form normally to keep server-side validation & session messages
    pendingForm.submit();
    confirmModal.classList.remove('show');
    pendingForm = null;
});

// Smooth scrolling for same-page anchor links
document.addEventListener('click', (event) => {
    const anchor = event.target.closest('a[href^="#"]');
    if (!anchor) return;

    const targetId = anchor.getAttribute('href');
    const targetElement = document.querySelector(targetId);
    if (!targetElement) return;

    event.preventDefault();
    targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });

    if (navMenu && !navMenu.classList.contains('hidden') && navToggle) {
        navMenu.classList.add('hidden');
    }
});

// Toast helper
function showToast(type, message) {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    const el = document.createElement('div');
    el.className = `toast ${type === 'success' ? 'toast-success' : 'toast-error'}`;
    el.textContent = message;

    container.appendChild(el);

    setTimeout(() => {
        el.remove();
    }, 4500);
}

// Expose to window for inline script usage
window.showToast = showToast;

// Show session toast if provided
if (window.__PAKUKERTO_TOAST) {
    const t = window.__PAKUKERTO_TOAST;
    showToast(t.type || 'success', t.message || 'Selesai');
}

