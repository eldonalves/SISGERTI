<div>
  <div class="paginatitulo">INSCRIÇÕES REALIZADAS.</div>
  <?php
    require_once("acao/pessoa.php");
    $pessoas = Pessoa::pesquisarPessoas('',$conn);
    echo "Total de inscrições: ".count($pessoas);
  ?>
  <table class="tableinformacao middle" cellspacing="0">
    <tr><th>Nome</th><th>Data Nascimento</th><th>CPF</th><th>Instituição</th><th>Cargo</th></tr>
    <?php foreach ($pessoas as $key => $value): ?>
        <tr class="etiquetas"><td contenteditable><?php echo strtoupper($value["nome"]); ?></td>
          <td contenteditable><?php echo date("d/m/Y", strtotime($value["datanascimento"])); ?></td>
          <td contenteditable><?php echo $value["cpf"]; ?></td><td contenteditable><?php echo $value["profissionalinstituicao"]; ?></td><td contenteditable><?php echo $value["profissionalcargo"]; ?></td><td><button class="imprimiretiqueta">Imprimir</button></td></tr>

    <?php endforeach; ?>
  </table>
  <script>
    var botaoetiquetas = document.querySelectorAll(".imprimiretiqueta");
    var etiquetas = document.querySelectorAll(".etiquetas");
    etiquetas.forEach(function(item, value){
      item.querySelectorAll(".imprimiretiqueta")[0].addEventListener("click", function(){
        var dados = this.parentElement.parentElement.querySelectorAll("td");
        gerarEtiqueta(dados[0].innerText, dados[1].innerText, dados[3].innerText, dados[2].innerText);
      });
    });
    function gerarEtiqueta(nome, datanascimento, instituicao, CPF){
              var qrcode = new Image();
              var nomeA1 = nome;
              var instituicaoA1 = instituicao;
              var dataNascimento = "DN: "+datanascimento;
              var CPFA1 = "CPF: "+CPF;
              var modeloEtiqueta = document.createElement("div");
              var modeloEtiquetaA1 = document.createElement("div");
              var modeloNome = document.createElement("div");
              var modeloInstituicao = document.createElement("div");
              var modeloDataNascimento = document.createElement("div");
              var modeloCPF = document.createElement("div");
              //Configuração do modeloEtiqueta
              modeloEtiqueta.style.height = "140px";
              modeloEtiqueta.style.fontFamily = "Arial Black";
              //Configuração do modeloNomePaciente
              modeloNome.style.marginLeft = "79px";
              modeloNome.style.fontFamily = "Arial Black";
              modeloNome.style.fontSize = "19px";
              modeloNome.style.position = "absolute";
              modeloNome.style.top = "0";
              modeloNome.style.marginTop = "8px";
              //Configuração modeloNomeMaePaciente"
              modeloInstituicao.style.marginLeft = "79px";
              modeloInstituicao.style.fontSize = "19px";
              modeloInstituicao.style.fontFamily = "Arial Black";
              modeloInstituicao.style.position = "absolute";
              modeloInstituicao.style.top = "0";
              modeloInstituicao.style.marginTop = "35px";
              //Configuração do modeloEtiquetaA1
              modeloEtiquetaA1.style.position = "absolute";
              modeloEtiquetaA1.style.fontSize = "19px";
              modeloEtiquetaA1.style.fontFamily = "Arial Black";
              modeloEtiquetaA1.style.marginTop = "50px";
              modeloEtiquetaA1.style.marginLeft = "79px";
              //Preechimento dos dados
              modeloNome.innerText = nomeA1;
              modeloInstituicao.innerText = instituicaoA1;
              modeloDataNascimento.innerText = dataNascimento;
              modeloCPF.innerText = CPFA1;
              //Organizando estrutura"+
              modeloDataNascimento.style.display = "inline-block";
              modeloCPF.style.display = "inline-block";
              modeloCPF.style.marginLeft = "4px";
              modeloEtiqueta.appendChild(modeloNome);
              modeloEtiquetaA1.appendChild(modeloDataNascimento);
              modeloEtiquetaA1.appendChild(modeloCPF);
              modeloEtiqueta.appendChild(modeloEtiquetaA1);
              var source = window.open("", "", "250", "2800");
              source.document.write("<html><head><title>"+document.title+"</title><style>*{margin:0; padding:0}</style></head><body><div style=\"position:absolute;transform:rotate(180deg);left:400;top:100;width:800px\">"+modeloEtiqueta.innerHTML+"</div></body></head>");
              source.print();
              source.close();
    }
  </script>
</div>
