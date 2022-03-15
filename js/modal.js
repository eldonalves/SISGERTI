function addListaTecnico(){
  this.disabled = true;
  button = this;
  modaltecnico = document.querySelectorAll(".addtecnicomodal")[0];
  idtransporte = document.querySelectorAll("input[name=idtransporte]")[0].value;
  tableLista = document.querySelectorAll(".listatecnico")[0];
  tecnico = document.createElement("tr");
  tecnicoSelected = document.querySelectorAll(".formtecnicos")[0].selectedOptions[0];
  tdNomeText = tecnicoSelected.innerText;
  tdIDText = tecnicoSelected.value;
  tdNome = document.createElement("td");
  tdID = document.createElement("td");
  tdID.style.width = "14px";
  removeTecnicoa1 = document.createElement("button");
  removeTecnicoa1.classList.add("btn");
  removeTecnicoa1.classList.add("btn-sm");
  removeTecnicoa1.classList.add("btn-danger");
  removeTecnicoa1.innerHTML = "&times;";
  removeTecnicoa1.addEventListener("click", removeTecnico);
  removeTecnicoTD = document.createElement("td");
  removeTecnicoTD.style.width = "14px";
  removeTecnicoTD.appendChild(removeTecnicoa1);
  ajaxSend("acao.php","acao=addtecnicotransporte&idtecnico="+tdIDText+"&idtransporte="+idtransporte,function(){
    if (this.readyState == 4 && this.status == 200) {
      tdID.innerText = tdIDText;
      tdNome.innerText = tdNomeText;
      tecnico.appendChild(tdID);
      tecnico.appendChild(tdNome);
      tecnico.appendChild(removeTecnicoTD);
      tableLista.appendChild(tecnico);
      tecnicoSelected.remove();
      button.disabled = false;
    }
  });
}
