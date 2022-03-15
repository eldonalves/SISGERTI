function CriticidadeOrganizer(element){
  table = element;
  tda1 = "";
  tda2 = "";
  modificando = true;
  modifique = false;
  while(modificando){
    ttr = table.querySelectorAll("tr");
    modificando = false;
    for(var x = 1; x < ttr.length - 1; x++){
      modifique = false;
      ttra1 = ttr[x];
      ttra2 = ttr[x+1];
      tda1 = ttr[x].querySelectorAll("td")[4];
      tda2 = ttr[x+1].querySelectorAll("td")[4];
      if(parseInt(tda2.innerText) > parseInt(tda1.innerText)){
        modifique = true;
        break;
      }
    }
    console.log(x);
    if(modifique){
      table.insertBefore(ttra2, ttra1);
      modificando = true;
    }
  }
}
