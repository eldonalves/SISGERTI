setInterval(AtualizarPainelChamados, 4000);

function AtualizarPainelChamados() {
    if (document.querySelectorAll(".painelchamados").length > 0) {
        chamadosnv = document.querySelectorAll(".chamadosnv tbody")[0];
        chamadosrecentes = document.querySelectorAll(".chamadosrecentes tbody")[0];
        chamadoscancelados = document.querySelectorAll(".chamadoscancelados tbody")[0];
        chamadospcriticidade = document.querySelectorAll(".chamadospcriticidade tbody")[0];
        chamadosprocessando = document.querySelectorAll(".chamadosprocessando tbody")[0];
        idnv = 0;
        idrecente = 0;
        idcancelado = 0;
        idprocessando = 0;
        if (chamadosnv.querySelectorAll("tr").length >= 2) {
            idnv = 0;
        }
        if (chamadosrecentes.querySelectorAll("tr").length >= 2) {
            idrecente = chamadosrecentes.querySelectorAll("tr")[1].querySelectorAll("td")[0].innerText;
        }
        if (chamadoscancelados.querySelectorAll("tr").length >= 2) {
            idcancelado = chamadoscancelados.querySelectorAll("tr")[1].querySelectorAll("td")[0].innerText;
        }
        if (chamadosprocessando.querySelectorAll("tr").length >= 2) {
            idprocessando = 0;
        }
        $.post("acao.php", {
                acao: "atualizarpainelchamados",
                idnv: 0,
                idrecente: idrecente,
                idcancelado: idcancelado,
                idprocessando: idprocessando,
            }, function(data) {
                chamadostrrecente = [];
                chamadostrcancelado = [];
                chamadostrnv = [];
                chamadostrprocessando = [];
                chamadosnvtrl = chamadosnv.querySelectorAll("tr").length;
                chamadosprocessandotrl = chamadosprocessando.querySelectorAll("tr").length;
                for (x = 1; x < chamadosnvtrl; x++) {
                    chamadosnv.querySelectorAll("tr")[1].remove();
                }
                for (x = 1; x < chamadosprocessandotrl; x++) {
                    chamadosprocessando.querySelectorAll("tr")[1].remove();
                }
                if (data != "") {
                    jsonData = JSON.parse(data);
                    jsonData[2].forEach(function(item, value) {
                        trdata = "<td><a target=\"_blank\" class=\"" + item.criticidade + "\" href=\"?p=transporte.php&idchamado=" + item.id + "\">" + item.id + "<\/a><\/td><td>" + item.sorigem + "<\/td><td>" + item.sdestino + "<\/td><td>" + item.datachamado + "<\/td>";
                        chamadostrnv.push(document.createElement("tr"));
                        chamadostrnv[chamadostrnv.length - 1].innerHTML = trdata;
                    });
                    if (chamadostrnv.length > 0) {}
                    chamadostrnv.forEach(function(item, value) {
                        chamadosnv.insertBefore(item, chamadosnv.querySelectorAll("tr")[1]);
                    });
                    jsonData = JSON.parse(data);
                    jsonData[3].forEach(function(item, value) {
                        trdata = "<td><a target=\"_blank\" class=\"" + item.criticidade + "\" href=\"?p=transporte.php&idchamado=" + item.id + "\">" + item.id + "<\/a><\/td><td>" + item.sorigem + "<\/td><td>" + item.sdestino + "<\/td><td>" + item.datachamado + "<\/td>";
                        chamadostrprocessando.push(document.createElement("tr"));
                        chamadostrprocessando[chamadostrprocessando.length - 1].innerHTML = trdata;
                    });
                    if (chamadostrnv.length > 0) {}
                    chamadostrprocessando.forEach(function(item, value) {
                        chamadosprocessando.insertBefore(item, chamadosprocessando.querySelectorAll("tr")[1]);
                    });
                    //CHAMADOS FEITOS HOJE
                    jsonData[0].forEach(function(item, value) {
                        trdata = "<td><a target=\"_blank\" class=\"" + item.criticidade + "\" href=\"?p=transporte.php&idchamado=" + item.id + "\">" + item.id + "<\/a><\/td><td>" + item.sorigem + "<\/td><td>" + item.sdestino + "<\/td><td>" + item.datachamado + "<\/td><td>" + item.criticidadepontuacao + "<\/td>";
                        chamadostrrecente.push(document.createElement("tr"));
                        chamadostrrecente[chamadostrrecente.length - 1].innerHTML = trdata;
                    });
                    if (chamadostrrecente.length > 0) {
                        document.querySelectorAll(".alertachamado")[0].play();
                    }
                    chamadostrrecente.forEach(function(item, value) {
                        chamadosrecentes.insertBefore(item, chamadosrecentes.querySelectorAll("tr")[1]);
                    });
                    chamadospcriticidade.innerHTML = chamadosrecentes.innerHTML;
                    CriticidadeOrganizer(chamadospcriticidade);
                    //CHAMADOS CANCELADOS
                    jsonData[1].forEach(function(item, value) {
                        trdata = "<td ><a target=\"_blank\" class=\"" + item.criticidade + "\" href=\"?p=transporte.php&idchamado=" + item.id + "\">" + item.id + "<\/a><\/td><td>" + item.sorigem + "<\/td><td>" + item.sdestino + "<\/td><td>" + item.datachamado + "<\/td>";
                        chamadostrcancelado.push(document.createElement("tr"));
                        chamadostrcancelado[chamadostrcancelado.length - 1].innerHTML = trdata;
                    });
                    if (chamadostrcancelado.length > 0) {
                        document.querySelectorAll(".alertacancelado")[0].play();
                    }
                    chamadostrcancelado.forEach(function(item, value) {
                        chamadoscancelados.insertBefore(item, chamadoscancelados.querySelectorAll("tr")[1]);
                    });
                }
            });
        }
      }
