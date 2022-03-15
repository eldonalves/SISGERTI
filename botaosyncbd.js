

function getPacientes(){
trpaciente = document.querySelectorAll("table[id*=tabelaPaciente]")[0].querySelectorAll("tr");
pacientes = [];
trpaciente.forEach(function(item, value){
  paciente = [];
  infop = item.querySelectorAll("td");
  if(Number.parseInt(infop[1].innerText)){
    paciente.push(infop[1].innerText);
    paciente.push(infop[2].innerText);
    paciente.push(infop[3].innerText);
    paciente.push(infop[4].innerText);
    paciente.push(infop[5].innerText);
    pacientes.push(paciente);
  }
});
return pacientes;
}

function createButton(){
  tablePaciente = document.querySelectorAll("table[id*=tabelaPaciente]")[0];
  button = document.createElement("input");
  button.type = "button";
  button.classList.add("botaoNovoItem");
  button.addEventListener("click", sendInfoBD);
  button.value = "SICRONIZAR PACIENTES";
  tablePaciente.after(button);
}

function ajaxSend(url, dados, acao){
  var ajax = new XMLHttpRequest();
  ajax.open("post", url, true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send(dados);
  ajax.onreadystatechange = acao;
}

function sendInfoBD(){
  pacientes = getPacientes();
  pacientesdados = "";
  pacientes.forEach(function(item,value){
    pacientesdados += item.toString()+"{paciente}";
  });
  ajaxSend("http://10.4.5.4/transporte/acao.php","acao=syncbd&pacientesdados="+pacientesdados,function(){});
  console.log(pacientesdados);
}
createButton();
