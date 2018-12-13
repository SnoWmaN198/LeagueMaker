let win = window,
    doc = document;

function hasClass(el, cls) {
  return el.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
};

function addClass(el, cls) {
  if (!this.hasClass(el, cls)) {
    el.className += " " + cls;
  }
};

function removeClass(el, cls) {
  if (this.hasClass(el, cls)) {

    let reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
    el.className = el.className.replace(reg,' ');
  }
};

let site = doc.querySelectorAll('.site-wrap')[0],
    wrap = doc.querySelectorAll('.panel-wrap')[0],
    panel = doc.querySelectorAll('.panel'),
    zoom = doc.querySelectorAll('.js-zoom'),
    nav_up = doc.querySelectorAll('.js-up'),
    nav_left = doc.querySelectorAll('.js-left'),
    nav_right = doc.querySelectorAll('.js-right'),
    nav_down = doc.querySelectorAll('.js-down'),
    animation = doc.querySelectorAll('.js-animation'),
    pos_x = 0,
    pos_y = 0;

function setPos(){
  wrap.style.transform = 'translateX(' + pos_x + '00%) translateY(' + pos_y + '00%)';
  setTimeout( function(){
    removeClass(wrap, 'animate');
  }, 600);
}

setPos();

function moveUp(){
  addClass(wrap, 'animate');
  pos_y++;
  setPos();
}

function moveLeft(){
  addClass(wrap, 'animate');
  pos_x++;
  setPos();
}

function moveRight(){
  addClass(wrap, 'animate');
  pos_x--;
  setPos();
}

function moveDown(){
  addClass(wrap, 'animate--scale');
  pos_y--;
  setPos();
}

for (let x = 0; x < nav_up.length; x++){
  nav_up[x].addEventListener('click', moveUp);
}

for (let x = 0; x < nav_left.length; x++){
  nav_left[x].addEventListener('click', moveLeft);
}

for (let x = 0; x < nav_right.length; x++){
  nav_right[x].addEventListener('click', moveRight);
}

for (let x = 0; x < nav_down.length; x++){
  nav_down[x].addEventListener('click', moveDown);
}

for (let x = 0; x < zoom.length; x++){
  zoom[x].addEventListener('click', zoomOut);   
}

function zoomOut(e){
  e.stopPropagation();
  addClass(site, 'show-all');
  for (let x = 0; x < panel.length; x++){
    ( function(_x){
      panel[_x].addEventListener('click', setPanelAndZoom);
    })(x);
  }
}

function setPanelAndZoom(e){
  pos_x = -e.target.getAttribute('data-x-pos'),
  pos_y = e.target.getAttribute('data-y-pos');
  setPos();
  zoomIn();
}


function zoomIn(){
  for (let x = 0; x < panel.length; x++){
    panel[x].removeEventListener('click', setPanelAndZoom);
  }
  removeClass(site, 'show-all');
}