window.onload = function(){
function inputHandler(masks, max, event) {
    var c = event.target;
    var v = c.value.replace(/\D/g, '');
    var m = c.value.length > max ? 1 : 0;
    VMasker(c).unMask();
    VMasker(c).maskPattern(masks[m]);
    c.value = VMasker.toPattern(v, masks[m]);
}

var telMask = ['999.999.999-99'];
var tel = document.querySelectorAll("input[name=cpf]");
if(tel.length > 0){
VMasker(tel).maskPattern(telMask[0]);
tel[0].addEventListener('input', inputHandler.bind(undefined, telMask,tel[0]), false);
}
}

function createAlertMessage(message, typealert, element){
  var caixa = document.createElement("div");
  caixa.classList.add("error");
  caixa.innerHTML = message;
  var error = document.querySelectorAll(".error");
  if(error.length > 0){
    error[0].remove();
  }
  element.before(caixa);
}
window.onscroll = function() {
  var sticky = document.querySelectorAll(".menu")[0];
  if( document.body.scrollTop+document.documentElement.scrollTop > sticky.offsetTop)
      sticky.classList.add("stuck");
  else sticky.classList.remove("stuck");
};

function habilitarModal(element){
  element.style.display = "block";
}
function desabilitarModal(element){
  element.style.display = "none";
}
