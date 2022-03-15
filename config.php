<?php
class Config{
  static $niveis = array(
    "normal",
    "transporte",
    "moderador",
    "admin"
  );
  static $setores = array(
  1 => "AMBULATÓRIO / TRIAGEM",
  2 => "BANHEIRO",
  3 => "CENTRO CIRÚRGICO",
  4 => "CLÍNICA CIRÚRGICA",
  5 => "CLÍNICA MÉDICA",
  6 => "ECOCARDIOGRAMA",
  7 => "ENDOSCOPIA SALA I",
  8 => "ENDOSCOPIA SALA II",
  9 => "ESPERA / AMBULATÓRIO",
  10 => "GUARITA",
  11 => "PORTARIA",
  12 => "REGISTRO AMBULATÓRIO",
  13 => "REGISTRO / INTERNAÇÃO",
  14 => "RESSONÂNCIA",
  15 => "SALA DE INDUÇÃO",
  16 => "SALA DE PREPARO",
  17 => "TOMOGRAFIA",
  18 => "UTI ADULTO I",
  19 => "UTI ADULTO II",
  20 => "PREPARO DE CADÁVERES",
  21 => "CLÍNICA TRAUMATO",
  22 => "CENTRO CIRÚRGICO TRAUMATO",
  23 => "ESPERA / INDUÇÃO",
  24 => "UTIN",
  25 => "UCINCO",
  26 => "UCE",
  27 => "ULTRASSONAGRAFIA I",
  28 => "ULTRASSONOGRAFIA II",
  29 => "AVC AGUDO",
  30 => "AVC SUBAGUDO",
  31 => "RAIO X (IMAGEM)",
  32 => "RAIO X EMERGÊNCIA",
  33 => "SERVIÇO SOCIAL",
  34 => "CLÍNICA OBSTÉTRICA",
  35 => "OBSTETRICIA CANGURU",
  36 => "OBSTETRICIA PARTO NORMAL",
  37 => "UTI ADULTO III",
  38 => "CENTRO CIRÚRGICO OBSTÉTRICO",
  39 => "AMIL OBSTÉTRICO",
  40 => "EMERGÊNCIA OBSTETRICIA",
  41 => "ULTRASSON OBSTETRICIA",
  42 => "EXAMES OBSTETRICIA",
  43 => "REGISTRO OBSTÉTRICO",
  44 => "COVID UTI I",
  45 => "COVID UTI II",
  46 => "CLINICA COVID II",
  47 => "COVID UTI III",
  48 => "CLINICA COVID I",
  49 => "HOSPITAL DE CAMPANHA",
  50 => "UTI COVID IV",
  51 => "HOSPITAL DE CAMPANHA II"
  );
  static $leitos = array(
  4 => array(301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,326,327,328,329),
  5 => array(201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229),
  18 => array(1,2,3,4,5,6,7,8,9,10),
  19 => array(11,12,13,14,15,16,17,18,19,20),
  21 => array(401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429),
  24 => array(1,2,3,4,5,6,7,8,9,10),
  25 => array(11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26),
  26 => array(101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,1126,17,128,129),
  29 => array(1,2,3,4,5,6,7,8,9,10),
  30 => array(115,116,117,118,119,120,121,122,123,124),
  34 => array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25),
  35 => array(1,2,3,4),
  36 => array(1,2,3,4,5),
  37 => array(21,22,23,24,25,26,27,28,29,30),
  44 => array(31,32,33,34,35,36,37,38,39,40,41,42,43,44),
  45 => array(45,46,47,48,49,50,51,52,53,54,55,56,57,58,59),
  46 => array(301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,326,327,328,329),
  47 => array(60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75),
  48 => array(411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429),
  49 => array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40),
  50 => array(401,402,403,404,405,406,407,408,409,410),
  51 => array(41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83)
  );
  static $sventilatorio = array(
  1 => "NENHUM",
  2 => "CATETER",
  3 => "VENTILAÇÃO MECÂNICA",
  4 => "MÁSCARA RESERVATÓRIA 50%",
  5 => "MÁSCARA RESERVATÓRIA 100%",
  6 => "MÁSCARA DE VENTURI");
  //7 => "TRAQUEOSTOMIZADO");
  static $sventilatorioicons = array(
    1 => "images/icons/sventilatorio/nenhum.png",
    2 => "images/icons/sventilatorio/cateter.png",
    3 => "images/icons/sventilatorio/venturi.png",
    4 => "images/icons/sventilatorio/mascara_50.png",
    5 => "images/icons/sventilatorio/mascara_100.png",
    6 => "images/icons/sventilatorio/ventilacao_mecanica.png");
    //7 => "images/icons/sventilatorio/traqueostomizado.png");
  static $criticoicons = array(
    1 => "images/icons/critico/nao.png",
    2 => "images/icons/critico/critico.png"
  );
  static $precaucao = array(
  1 => "NENHUMA",
<<<<<<< Updated upstream
  2 => "AVC EM JANELA TERAPÊUTICA",
  3 => "URGENTE"
);
static $condicaoicons = array(
  1 => "images/icons/condicao/nenhuma.png",
  2 => "images/icons/condicao/avc_janela.png",
  3 => "images/icons/condicao/urgente.png"
);
static $ctransporte = array(
1 => "AGUARDOU ELEVADOR",
2 => "AGUARDOU O PRONTUÁRIO",
3 => "AGUARDOU PACIENTE FICAR PRONTO",
4 => "DEMORA NA ENTREGA DO PACIENTE",
5 => "DEMORA PARA RECEBER PACIENTE",
6 => "LEVAR CILINDRO DE O²",
7 => "ELEVADOR QUEBRADO",
8 => "EQUIPE INCOMPLETA",
9 => "FALHAS NA IDENTIFICAÇÃO SEGURA",
10 => "FALHAS NA TRANSMISSÃO DE INFORMAÇÕES",
11 => "PACIENTE NÃO ESTAVA PRONTO",
12 => "PIORA CLÍNICA",
13 => "SEM CADEIRA DE RODAS",
14 => "SEM MACA DE TRANSPORTE",
15 => "SEM TÉCNICO DE TRANSPORTE DISPONÍVEL",
16 => "TRANSFERÊNCIA EXTERNA",
17 => "TRANSFERÊNCIA DE LEITOS",
18 => "TÉCNICOS EM OUTRO CHAMADO",
19 => "PULSEIRA ILEGÍVEL",
20 => "PACIENTE EXTERNO P/ TOMOGRAFIA",
21 => "TRANSFERÊNCIA INTERNA",
22 => "TRANSPORTE CANCELADO PELA ORIGEM",
23 => "SEM VEÍCULO DISPONÍVEL",
24 => "OUTRO",
);
static $csolicitante = array("N/A",
1 => "AGUARDOU ELEVADOR",
2 => "AGUARDOU O PRONTUÁRIO",
3 => "AGUARDOU PACIENTE FICAR PRONTO",
4 => "DEMORA NA ENTREGA DO PACIENTE",
5 => "DEMORA PARA RECEBER PACIENTE",
6 => "LEVAR CILINDRO DE O²",
7 => "ELEVADOR QUEBRADO",
8 => "EQUIPE INCOMPLETA",
9 => "FALHAS NA IDENTIFICAÇÃO SEGURA",
10 => "FALHAS NA TRANSMISSÃO DE INFORMAÇÕES",
11 => "PACIENTE NÃO ESTAVA PRONTO",
12 => "PIORA CLÍNICA",
13 => "SEM CADEIRA DE RODAS",
14 => "SEM MACA DE TRANSPORTE",
15 => "SEM TÉCNICO DE TRANSPORTE DISPONÍVEL",
16 => "TRANSFERÊNCIA EXTERNA",
17 => "TRANSFERÊNCIA DE LEITOS",
18 => "TÉCNICOS EM OUTRO CHAMADO",
19 => "PULSEIRA ILEGÍVEL",
20 => "PACIENTE EXTERNO P/ TOMOGRAFIA",
21 => "TRANSFERÊNCIA INTERNA",
22 => "TRANSPORTE CANCELADO PELA ORIGEM",
23 => "SEM VEÍCULO DISPONÍVEL");

static $veiculo = array(
1 => "CADEIRA",
2 => "MACA",
3 => "LEITO",
4 => "LEITO AUTOMÁTICO",
5 => "BERÇO");
static $veiculoicons = array(
1 => "images/icons/veiculo/cadeira.png",
2 => "images/icons/veiculo/maca.png",
3 => "images/icons/veiculo/leito.png",
4 => "images/icons/veiculo/leito_automatico.png",
5 => "images/icons/veiculo/berco.png");
static $status = array(1 => "NOVO",
2 => "PROCESSANDO",
3 => "TRANSPORTANDO",
4 => "CONCLUIDO" ,
5 => "FINALIZADO",
6 => "CANCELADO"
);
static $criticidade = array(
  "chamadonaourgente" => "NÃO URGENTE",
  "chamadopoucourgente" => "POUCO URGENTE",
  "chamadourgente" => "URGENTE",
  "chamadoimediato" => "IMEDIATO"
);
static $permissoespagina = array(
  "chamado.php" => 1,
  "painel.php" => 1,
  "tecnico.php" => 0,
  "login.php" => 0,
  "transporte.php" => 1,
  "paciente.php" => 2
);
static $niveltecnico = array(
  1 => "TÉCNICO",
  2 => "TÉCNICO DE TRANSPORTE",
  3 => "AUXILIAR ADMINISTRATIVO"
);
static function OrdemAlfabetica($array){
  $values = array_values($array);
  $keys = array_keys($array);
  $arraya1 = array();
  for($i = 0; $i < count($values); $i++):
    array_push($arraya1, array(0=>$values[$i], 1=>$keys[$i]));
  endfor;
  sort($arraya1);
  return $arraya1;
}
static function PermissaoPagina($pagina){
  $usernivel = (empty($_SESSION["usuario"]["nivel"]) ? 0 : $_SESSION["usuario"]["nivel"]);
  if(in_array($pagina,self::$permissoespagina) && self::$permissoespagina[$pagina] <= $usernivel):
    return true;
  endif;
    return false;
}
static function isLogin(){
  if(!empty($_SESSION["usuario"]["id"])):
    return true;
  else:
    return false;
  endif;
}
static function isUserTransporte(){
  if(self::isLogin()):
    if($_SESSION["usuario"]["nivel"] >=2):
=======
  2 => "AEROSSÓIS",
  3 => "CONTATO",
  4 => "GOTÍCULA",
  5 => "AEROSSÓIS E CONTATO",
  6 => "AEROSSÓIS E GOTÍCULA",
  7 => "CONTATO E GOTÍCULA",
  8 => "AEROSSÓIS, CONTATO E GOTÍCULA",
  9 => "PRECAUÇÃO REVERSA");
  static $precaucaoicons = array(
    1 => "images/icons/precaucao/nenhuma.png",
    2 => "images/icons/precaucao/aerosol.png",
    3 => "images/icons/precaucao/contato.png",
    4 => "images/icons/precaucao/goticula.png",
    5 => "images/icons/precaucao/aerosol_contato.png",
    6 => "images/icons/precaucao/aerosol_goticula.png",
    7 => "images/icons/precaucao/contato_goticula.png",
    8 => "images/icons/precaucao/aerosol_contato_goticula.png",
    9 => "images/icons/precaucao/precaucao_reversa.png");
  static $condicao = array(
    1 => "NENHUMA",
    2 => "AVC EM JANELA TERAPÊUTICA",
    3 => "URGENTE"
  );
  static $condicaoicons = array(
    1 => "images/icons/condicao/nenhuma.png",
    2 => "images/icons/condicao/avc_janela.png",
    3 => "images/icons/condicao/urgente.png"
  );
  static $ctransporte = array(
  1 => "AGUARDOU ELEVADOR",
  2 => "AGUARDOU O PRONTUÁRIO",
  3 => "AGUARDOU PACIENTE FICAR PRONTO",
  4 => "DEMORA NA ENTREGA DO PACIENTE",
  5 => "DEMORA PARA RECEBER PACIENTE",
  6 => "LEVAR CILINDRO DE O²",
  7 => "ELEVADOR QUEBRADO",
  8 => "EQUIPE INCOMPLETA",
  9 => "FALHAS NA IDENTIFICAÇÃO SEGURA",
  10 => "FALHAS NA TRANSMISSÃO DE INFORMAÇÕES",
  11 => "PACIENTE NÃO ESTAVA PRONTO",
  12 => "PIORA CLÍNICA",
  13 => "SEM CADEIRA DE RODAS",
  14 => "SEM MACA DE TRANSPORTE",
  15 => "SEM TÉCNICO DE TRANSPORTE DISPONÍVEL",
  16 => "TRANSFERÊNCIA EXTERNA",
  17 => "TRANSFERÊNCIA DE LEITOS",
  18 => "TÉCNICOS EM OUTRO CHAMADO",
  19 => "PULSEIRA ILEGÍVEL",
  20 => "PACIENTE EXTERNO P/ TOMOGRAFIA",
  21 => "TRANSFERÊNCIA INTERNA",
  22 => "TRANSPORTE CANCELADO PELA ORIGEM",
  23 => "SEM VEÍCULO DISPONÍVEL",
  24 => "OUTRO",
  25 => "TRANSPORTE JÁ REALIZADO",
  26 => "TRANSPORTE JÁ SOLICITADO"
  );
  static $csolicitante = array("N/A",
  1 => "AGUARDOU ELEVADOR",
  2 => "AGUARDOU O PRONTUÁRIO",
  3 => "AGUARDOU PACIENTE FICAR PRONTO",
  4 => "DEMORA NA ENTREGA DO PACIENTE",
  5 => "DEMORA PARA RECEBER PACIENTE",
  6 => "LEVAR CILINDRO DE O²",
  7 => "ELEVADOR QUEBRADO",
  8 => "EQUIPE INCOMPLETA",
  9 => "FALHAS NA IDENTIFICAÇÃO SEGURA",
  10 => "FALHAS NA TRANSMISSÃO DE INFORMAÇÕES",
  11 => "PACIENTE NÃO ESTAVA PRONTO",
  12 => "PIORA CLÍNICA",
  13 => "SEM CADEIRA DE RODAS",
  14 => "SEM MACA DE TRANSPORTE",
  15 => "SEM TÉCNICO DE TRANSPORTE DISPONÍVEL",
  16 => "TRANSFERÊNCIA EXTERNA",
  17 => "TRANSFERÊNCIA DE LEITOS",
  18 => "TÉCNICOS EM OUTRO CHAMADO",
  19 => "PULSEIRA ILEGÍVEL",
  20 => "PACIENTE EXTERNO P/ TOMOGRAFIA",
  21 => "TRANSFERÊNCIA INTERNA",
  22 => "TRANSPORTE CANCELADO PELA ORIGEM",
  23 => "SEM VEÍCULO DISPONÍVEL");

  static $veiculo = array(
  1 => "CADEIRA",
  2 => "MACA",
  3 => "LEITO",
  4 => "LEITO AUTOMÁTICO",
  5 => "BERÇO");
  static $veiculoicons = array(
  1 => "images/icons/veiculo/cadeira.png",
  2 => "images/icons/veiculo/maca.png",
  3 => "images/icons/veiculo/leito.png",
  4 => "images/icons/veiculo/leito_automatico.png",
  5 => "images/icons/veiculo/berco.png");
  static $status = array(1 => "NOVO",
  2 => "PROCESSANDO",
  3 => "TRANSPORTANDO",
  4 => "CONCLUIDO" ,
  5 => "FINALIZADO",
  6 => "CANCELADO"
  );
  static $criticidade = array(
    "chamadonaourgente" => "NÃO URGENTE",
    "chamadopoucourgente" => "POUCO URGENTE",
    "chamadourgente" => "URGENTE",
    "chamadoimediato" => "IMEDIATO"
  );
  static $permissoespagina = array(
    "chamado.php" => 1,
    "painel.php" => 1,
    "tecnico.php" => 0,
    "login.php" => 0,
    "transporte.php" => 1,
    "paciente.php" => 2
  );
  static $niveltecnico = array(
    1 => "TÉCNICO",
    2 => "TÉCNICO DE TRANSPORTE",
    3 => "AUXILIAR ADMINISTRATIVO"
  );
  static function OrdemAlfabetica($array){
    $values = array_values($array);
    $keys = array_keys($array);
    $arraya1 = array();
    for($i = 0; $i < count($values); $i++):
      array_push($arraya1, array(0=>$values[$i], 1=>$keys[$i]));
    endfor;
    sort($arraya1);
    return $arraya1;
  }
  static function PermissaoPagina($pagina){
    $usernivel = (empty($_SESSION["usuario"]["nivel"]) ? 0 : $_SESSION["usuario"]["nivel"]);
    if(in_array($pagina,self::$permissoespagina) && self::$permissoespagina[$pagina] <= $usernivel):
      return true;
    endif;
      return false;
  }
  static function isLogin(){
    if(!empty($_SESSION["usuario"]["id"])):
>>>>>>> Stashed changes
      return true;
    else:
      return false;
    endif;
<<<<<<< Updated upstream
  else:
    return false;
  endif;
}
static function isUserAdmin(){
  if(isLogin()):
    if($_SESSION["usuario"]["nivel"] >=4):
      return true;
    else:
      return false;
    endif;
  else:
    return false;
  endif;
}
static function CreatePaginacao($paginacaocount, $paginacaolimit, $pg,$url){
  ?>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <?php
        for($x = 1; $x <= ($paginacaocount/$paginacaolimit)+($paginacaocount%$paginacaolimit > 0 ? 1 : 0); $x++){
          ?>
            <li class="page-item <?php echo ($pg == $x ? "active":"") ?>"><a class="page-link" href="<?php echo (strrpos($url,"pg=")?str_replace("pg={$pg}","pg={$x}", $url):$url."&pg={$x}") ?>"><?php echo $x ?></a></li>
          <?php
        }
      ?>
    </ul>
  </nav>
  <?php
}
=======
  }
  static function isUserTransporte(){
    if(self::isLogin()):
      if($_SESSION["usuario"]["nivel"] >=2):
        return true;
      else:
        return false;
      endif;
    else:
      return false;
    endif;
  }
  static function CreatePaginacao($paginacaocount, $paginacaolimit, $pg,$url){
    ?>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <?php
          for($x = 1; $x <= ($paginacaocount/$paginacaolimit)+($paginacaocount%$paginacaolimit > 0 ? 1 : 0); $x++){
            ?>
              <li class="page-item <?php echo ($pg == $x ? "active":"") ?>"><a class="page-link" href="<?php echo (strrpos($url,"pg=")?str_replace("pg={$pg}","pg={$x}", $url):$url."&pg={$x}") ?>"><?php echo $x ?></a></li>
            <?php
          }
        ?>
      </ul>
    </nav>
    <?php
  }
  static function ConverterHorario($horario){
    $horario = strtotime(str_replace("/", "-", $horario));
    return $horario;
  }
  static function getMinutes($date,$datea2){
    $date = new DateTime($date);
    $result = $date->diff(new DateTime($datea2));
    $minutes = $result->d * 24 * 60;
    $minutes += $result->h * 60;
    $minutes += $result->i;
    return $minutes;
  }
  static function OrganizerPOST($post, $parameters){
    foreach ($parameters as $key => $value):
      if(!isset($post[$value])):
        $post[$value] = "";
      endif;
    endforeach;
  }
  static function VerifyEmptyPOST($post, $parameters){
    foreach ($parameters as $key => $value):
      if(!isset($post[$value]) || empty($post[$value])):
        return true;
      endif;
    endforeach;
  }
>>>>>>> Stashed changes
}
?>
