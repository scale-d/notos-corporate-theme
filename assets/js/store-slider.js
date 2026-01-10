(function(){
  document.querySelectorAll('.c-store__photo').forEach(function($wrap){
    const imgs = Array.from($wrap.querySelectorAll('img'));
    if (imgs.length === 0) return;

    // ドット（あれば再構築）
    const dotsWrap = $wrap.querySelector('.c-store__pagination');
    let dots = [];
    if (dotsWrap){
      dotsWrap.innerHTML = '';
      for (let k=0; k<imgs.length; k++){
        const dot = document.createElement('span');
        dotsWrap.appendChild(dot);
        dots.push(dot);
        dot.addEventListener('click', ()=>go(k));
      }
    }

    // 矢印
    const prevBtn = $wrap.querySelector('.c-store__arrow--left');
    const nextBtn = $wrap.querySelector('.c-store__arrow--right');
    let i = 0;

    function go(n){
      i = (n + imgs.length) % imgs.length;
      imgs.forEach((img,idx)=> img.classList.toggle('is-active', idx===i));
      dots.forEach((d,idx)=> d.classList.toggle('is-active', idx===i));
    }

    if (prevBtn) prevBtn.addEventListener('click', ()=>go(i-1));
    if (nextBtn) nextBtn.addEventListener('click', ()=>go(i+1));

    // 初期表示
    go(0);
  });
})();