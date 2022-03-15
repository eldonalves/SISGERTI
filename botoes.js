$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
window.onload = function(){

   checkinctransporte = document.querySelectorAll(".forminctransporte");
  if(checkinctransporte.length > 0){
    checkinctransporte.forEach(function(item, value){
      item.addEventListener("change", checkinctransporteselect);
    });
  }
  function checkinctransporteselect(){
    if(this.parentElement.style.fontWeight != "bold"){
      this.parentElement.style.fontWeight = "bold";
    }
    else{
      this.parentElement.style.fontWeight = "";
    }
    if(this.parentElement.innerText == "OUTRO" && this.parentElement.style.fontWeight == "bold"){
      document.querySelectorAll(".oincidenteform")[0].style.display = "block";
    }
    else{
      document.querySelectorAll(".oincidenteform")[0].style.display = "none";
    }
  }

   checkPSProntuario = document.querySelectorAll(".checkPSProntuario");
  if(checkPSProntuario.length > 0){
    checkPSProntuario[0].addEventListener("change", checkPSProntuarioChange);
  }
   buttonAtualizarPSProntuario = document.querySelectorAll(".buttonAtualizarPSProntuario");
  if(buttonAtualizarPSProntuario.length > 0){
    buttonAtualizarPSProntuario[0].addEventListener("click", buttonAtualizarPSProntuarioClick);
  }
   buttonCancelarChamado = document.querySelectorAll(".cancelarchamado");
  if(buttonCancelarChamado.length > 0){
    buttonCancelarChamado[0].addEventListener("click", CancelarChamado);
  }
   selectSetorOLeito = document.querySelectorAll(".selectSetorOLeito");
  if(selectSetorOLeito.length > 0){
    selectSetorOLeito[0].addEventListener("change", selectchamadooleitochange);
  }
   selectSetorDLeito = document.querySelectorAll(".selectSetorDLeito");
  if(selectSetorDLeito.length > 0){
    selectSetorDLeito[0].addEventListener("change", selectchamadodleitochange);
  }
   buttonAddTecnicoTransporteA1 = document.querySelectorAll(".addTecnicosTransporteButtonA1");
  if(buttonAddTecnicoTransporteA1.length > 0){
    buttonAddTecnicoTransporteA1[0].addEventListener("click", addListaTecnico);
  }
   buttonAtualizarTransporte = document.querySelectorAll(".atualizartransporte");
  if(buttonAtualizarTransporte.length > 0){
    buttonAtualizarTransporte[0].addEventListener("click", atualizarTransporte);
  }
   buttonCancelarTransporteSolicitante = document.querySelectorAll(".cancelartransportesolicitante");
  if(buttonCancelarTransporteSolicitante.length > 0){
    buttonCancelarTransporteSolicitante[0].addEventListener("click", cancelarTransporteSolicitante);
  }
   buttonAtualizarTransporteComeco = document.querySelectorAll(".atualizartransportecomeco");
  if(buttonAtualizarTransporteComeco.length > 0){
    if(buttonAtualizarTransporteComeco[0].style.display != "none"){
      buttonAtualizarTransporteComeco[0].addEventListener("click", atualizarTransporteComeco);
    }
  }
   buttonAtualizarTransporteTermino = document.querySelectorAll(".atualizartransportetermino");
  if(buttonAtualizarTransporteTermino.length > 0){
    if(buttonAtualizarTransporteTermino[0].style.display != "none"){
      buttonAtualizarTransporteTermino[0].addEventListener("click", atualizarTransporteTermino);
    }
  }
   selectIncidenteTransporte = document.querySelectorAll(".formctransporte");
  if(selectIncidenteTransporte.length > 0){
    selectIncidenteTransporte[0].addEventListener("click", incidenteTransporte);
  }
   prontuarioChamado = document.querySelectorAll(".prontuariochamado");
  if(prontuarioChamado.length > 0){
    prontuarioChamado[0].addEventListener("change", pesquisarProntuarioChamado);
  }
   removeTecnicoTransporte = document.querySelectorAll(".removetecnicotransporte");
  if(removeTecnicoTransporte.length > 0){
    removeTecnicoTransporte.forEach(function(item, value){
      item.addEventListener("click", removeTecnico);
    });
  }
}





function buttonAtualizarPSProntuarioClick(){
  prontuario = document.querySelectorAll(".pprontuario")[0].value;
  idchamado = document.querySelectorAll("input[name=idchamado]")[0].value;
  ajaxSend("acao.php","acao=atualizarpsprontuario&pprontuario="+prontuario+"&idchamado="+idchamado,function(){
    if (this.readyState == 4 && this.status == 200) {
     document.location.reload();
    }
  });
}
function checkPSProntuarioChange(){
  prontuario = document.querySelectorAll(".prontuariochamado")[0];
  nome = document.querySelectorAll(".prontuarionome")[0];
  nomemae = document.querySelectorAll(".prontuarionomemae")[0];
  datanascimento = document.querySelectorAll(".prontuariodatanascimento")[0];
  if(nome.getAttribute("disabled") == ""){
    prontuario.setAttribute("disabled","");
    prontuario.value = "";
    nome.removeAttribute("disabled");
    nome.value = "";
    nomemae.removeAttribute("disabled");
    nomemae.value = "";
    datanascimento.removeAttribute("disabled");
    datanascimento.value = "";
    datanascimento.type = "date";
  }
  else{
    prontuario.removeAttribute("disabled");
    nome.setAttribute("disabled","");
    nome.value = "";
    nomemae.setAttribute("disabled","");
    nomemae.value = "";
    datanascimento.setAttribute("disabled","");
    datanascimento.value = "";
    datanascimento.type = "text";
  }
}
function incidenteTransporte(){
  selectedIncidenteTransporte = document.querySelectorAll(".formctransporte")[0].selectedOptions[0];
  divincidentetransporte = document.querySelectorAll(".formincidentetransporte");
  if(divincidentetransporte.length > 0){
  divincidentetransporte = divincidentetransporte[0];
  if(selectedIncidenteTransporte.value != "1"){
      divincidentetransporte.style.display = "block";
    }
    else{
      divincidentetransporte.style.display = "none";
    }
  }
}
function atualizarTransporteComeco(){
<<<<<<< Updated upstream
    var idtransporte = document.querySelectorAll("input[name=idtransporte]")[0].value;
    idchamado = document.querySelectorAll("input[name=idchamado]")[0].value;
    var ajax = new XMLHttpRequest();
    var data = "acao=atualizartransportecomeco&idtransporte="+idtransporte;
=======
    idtransporte = document.querySelectorAll("input[name=idtransporte]")[0].value;
    idchamado = document.querySelectorAll("input[name=idchamado]")[0].value;
    ajax = new XMLHttpRequest();
    data = "acao=atualizartransportecomeco&idtransporte="+idtransporte+"&idchamado="+idchamado;
>>>>>>> Stashed changes
    ajax.open("post", "acao.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send(data);
    ajax.onreadystatechange = function() {
    	if (ajax.readyState == 4 && ajax.status == 200) {
        document.location.reload();
    	}
    }
}
function atualizarTransporteTermino(){
<<<<<<< Updated upstream
    var idtransporte = document.querySelectorAll("input[name=idtransporte]")[0].value;
    idchamado = document.querySelectorAll("input[name=idchamado]")[0].value;
    var ajax = new XMLHttpRequest();
    var data = "acao=atualizartransportetermino&idtransporte="+idtransporte+"&idchamado="+idchamado;
=======
    idtransporte = document.querySelectorAll("input[name=idtransporte]")[0].value;
    idchamado = document.querySelectorAll("input[name=idchamado]")[0].value;
     ajax = new XMLHttpRequest();
     data = "acao=atualizartransportetermino&idtransporte="+idtransporte+"&idchamado="+idchamado;
>>>>>>> Stashed changes
    ajax.open("post", "acao.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send(data);
    ajax.onreadystatechange = function() {
    	if (ajax.readyState == 4 && ajax.status == 200) {
    		 data = ajax.responseText;
        document.location.reload();
    	}
    }
}
function ajaxSend(url, dados, acao){
  ajax = new XMLHttpRequest();
  ajax.open("post", url, true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send(dados);
  ajax.onreadystatechange = acao;
}
function atualizarTransporte(){
  idtransporte = document.querySelectorAll("input[name=idtransporte]")[0].value;
  idchamado = document.querySelectorAll("input[name=idchamado]")[0].value;
  incidente = "";
  checkinctransporte = document.querySelectorAll(".forminctransporte:checked");
  checkinctransporte.forEach(function(item, value){
    if(item.value == "24"){
      incidente += item.value+"-"+document.querySelectorAll(".incidenteoutro")[0].value+",";
    }
    else{
      incidente += item.value+",";
    }
  });
  incidente = incidente.substring(0, incidente.length - 1);
  ajaxSend("acao.php","acao=concluirtransporte&incidente="+incidente+"&oincidente=&idtransporte="+idtransporte+"&idchamado="+idchamado,function(){
  document.location.reload();
  });
}
function CancelarChamado(){
   idtransporte = document.querySelectorAll("input[name=idtransporte]")[0].value;
   idchamado = document.querySelectorAll("input[name=idchamado]")[0].value;
  ajaxSend("acao.php","acao=cancelartransporte&idchamado="+idchamado+"&idtransporte="+idtransporte,function(){
    document.location.reload();
  });
}
function pesquisarProntuarioChamado(){
    prontuario = this.value;
    nome = document.querySelectorAll(".prontuarionome")[0];
    nomemae = document.querySelectorAll(".prontuarionomemae")[0];
    datanascimento = document.querySelectorAll(".prontuariodatanascimento")[0];
    ajaxSend("acao.php","acao=pesquisarprontuariochamado&prontuario="+prontuario,function(){
      if (this.readyState == 4 && this.status == 200) {
    		 data = this.responseText;
        if(data != ""){
          data = JSON.parse(data);
          nome.value = data.nome;
          nomemae.value = data.nomemae;
          datanascimento.value = data.datanascimento;
        }
        else{
          nome.value = "";
          nomemae.value = "";
          datanascimento.value = "";
        }
    	}
    });
  }
function removeTecnico(){
    tecnico = this;
    select = document.querySelectorAll(".formtecnicos")[0];
    idtecnico = tecnico.parentElement.parentElement.querySelectorAll("td")[0].innerText;
    nometecnico = tecnico.parentElement.parentElement.querySelectorAll("td")[1].innerText;
    idtransporte = document.querySelectorAll("input[name=idtransporte]")[0].value;
    ajaxSend("acao.php","acao=removetecnicotransporte&idtransporte="+idtransporte+"&tecnico="+idtecnico,function(){
      if (this.readyState == 4 && this.status == 200) {
        tecnicoa1 = document.createElement("option");
        tecnicoa1.innerText = nometecnico;
        tecnicoa1.value = idtecnico;
        $(".formtecnicos").append(tecnicoa1);
        tecnico.parentElement.parentElement.remove();
      }
    });
  }
function selectchamadooleitochange(){
    setor = this.selectedOptions[0].value;
    select = document.querySelectorAll(".selectChamadoOLeito")[0];
    ajaxSend("acao.php","acao=pesquisarleitossetor&setor="+setor,function(){
      if (this.readyState == 4 && this.status == 200) {
    		 data = this.responseText;
        if(data != ""){
          select.innerHTML = data;
        }
        else{
          select.innerHTML = "<option value=\"0\">SEM LEITO</option>";
        }
    	}
    });
  }
function selectchamadodleitochange(){
    setor = this.selectedOptions[0].value;
    select = document.querySelectorAll(".selectChamadoDLeito")[0];
    ajaxSend("acao.php","acao=pesquisarleitossetor&setor="+setor,function(){
      if (this.readyState == 4 && this.status == 200) {
    		 data = this.responseText;
        if(data != ""){
          select.innerHTML = data;
        }
        else{
          select.innerHTML = "<option value=\"0\">SEM LEITO</option>";
        }
    	}
    });
  }
