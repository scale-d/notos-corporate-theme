(function(){
  const btn = document.querySelector('.c-header__toggle');
  const nav = document.querySelector('#primaryMenu');
  if(!btn || !nav) return;
  btn.addEventListener('click', function(){
    const open = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', String(!open));
    document.documentElement.classList.toggle('nav-open', !open);
  });
})();

// ===== Copy link buttons (share) =====
(function () {
  function onReady(fn) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', fn);
    } else {
      fn();
    }
  }

  function ensureToast() {
    let toast = document.getElementById('notosCopyToast');
    if (toast) return toast;

    toast = document.createElement('div');
    toast.id = 'notosCopyToast';
    toast.className = 'c-copy-toast';
    toast.setAttribute('role', 'status');
    toast.setAttribute('aria-live', 'polite');
    document.body.appendChild(toast);
    return toast;
  }

  function showToast(message) {
    const toast = ensureToast();
    toast.textContent = message;
    toast.classList.add('is-visible');

    if (toast._timer) window.clearTimeout(toast._timer);
    toast._timer = window.setTimeout(() => {
      toast.classList.remove('is-visible');
    }, 1600);
  }

  async function copyToClipboard(text) {
    // Modern API (https / localhost)
    if (navigator.clipboard && window.isSecureContext) {
      await navigator.clipboard.writeText(text);
      return;
    }

    // Fallback
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.setAttribute('readonly', '');
    ta.style.position = 'fixed';
    ta.style.top = '-1000px';
    ta.style.left = '-1000px';
    document.body.appendChild(ta);
    ta.select();
    ta.setSelectionRange(0, ta.value.length);
    const ok = document.execCommand('copy');
    document.body.removeChild(ta);
    if (!ok) throw new Error('copy failed');
  }

  onReady(function () {
    const buttons = document.querySelectorAll('.js-copy-link[data-copy-url]');
    if (!buttons.length) return;

    buttons.forEach((btn) => {
      btn.addEventListener('click', async (e) => {
        e.preventDefault();

        const url = btn.getAttribute('data-copy-url');
        if (!url) return;

        const originalAria = btn.getAttribute('aria-label') || '';
        const originalTitle = btn.getAttribute('title');

        try {
          await copyToClipboard(url);
          btn.classList.add('is-copied');
          btn.setAttribute('aria-label', 'コピーしました');
          btn.setAttribute('title', 'コピーしました');
          showToast('リンクをコピーしました');
        } catch (err) {
          btn.setAttribute('aria-label', 'コピーに失敗しました');
          btn.setAttribute('title', 'コピーに失敗しました');
          showToast('コピーに失敗しました');
        }

        window.setTimeout(() => {
          btn.classList.remove('is-copied');
          if (originalAria) btn.setAttribute('aria-label', originalAria);
          else btn.removeAttribute('aria-label');

          if (originalTitle !== null) btn.setAttribute('title', originalTitle);
          else btn.removeAttribute('title');
        }, 1600);
      });
    });
  });
})();
