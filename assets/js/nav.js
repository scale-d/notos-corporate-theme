(function(){
  const btn = document.querySelector('.site-nav__toggle');
  const nav = document.querySelector('#primaryMenu');
  if(!btn || !nav) return;
  btn.addEventListener('click', function(){
    const open = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', String(!open));
    document.documentElement.classList.toggle('nav-open', !open);
  });
})();
