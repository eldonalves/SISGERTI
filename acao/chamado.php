<?php
date_default_timezone_set('America/Fortaleza');
require_once("criticidade.php");
require_once("chamadostatus.php");
require_once("tecnico.php");
class Chamado{
  function Criticidade($id,$conn){
    try{
      $chamado = $this->PesquisarChamado("WHERE id=:id",array(":id"=>$id),$conn);
      $osetor = (isset(Criticidade::$osetor[$chamado[0]["sorigem"]]) ? Criticidade::$osetor[$chamado[0]["sorigem"]]:0);
      $dsetor = (isset(Criticidade::$osetor[$chamado[0]["sdestino"]]) ? Criticidade::$osetor[$chamado[0]["sdestino"]]:0);
      $precaucao = Criticidade::$precaucao[$chamado[0]["precaucao"]];
      $sventilatorio = Criticidade::$sventilatorio[$chamado[0]["sventilatorio"]];
      $critico = Criticidade::$critico[$chamado[0]["critico"]];
      $veiculo = Criticidade::$veiculo[$chamado[0]["veiculo"]];
      $condicao = Criticidade::$condicao[$chamado[0]["condicao"]];
      $pontuacao = $osetor+$dsetor+$precaucao+$sventilatorio+$critico+$veiculo+$condicao;
      if($pontuacao < 45):
        return "chamadonaourgente";
      elseif($pontuacao >= 45 && $pontuacao < 80):
        return "chamadopoucourgente";
      elseif($pontuacao >= 80 && $pontuacao < 120):
        return "chamadourgente";
      elseif($pontuacao >= 120):
        return "chamadoimediato";
      endif;
      return "";
    }
    catch(Exception $e) {
      return "";
    }
  }
  function CriticidadePontuacao($id,$conn){
    $chamado = $this->PesquisarChamado("WHERE id=:id",array(":id"=>$id),$conn);
    $osetor = Criticidade::$osetor[$chamado[0]["sorigem"]];
    $dsetor = Criticidade::$dsetor[$chamado[0]["sdestino"]];
    $precaucao = Criticidade::$precaucao[$chamado[0]["precaucao"]];
    $sventilatorio = Criticidade::$sventilatorio[$chamado[0]["sventilatorio"]];
    $critico = Criticidade::$critico[$chamado[0]["critico"]];
    $veiculo = Criticidade::$veiculo[$chamado[0]["veiculo"]];
    $condicao = Criticidade::$condicao[$chamado[0]["condicao"]];
    $pontuacao = $osetor+$dsetor+$precaucao+$sventilatorio+$critico+$veiculo+$condicao;
    return $pontuacao;
  }
  function InserirChamado($post, $ppaciente,$psprontuario, $idtecnico, $oleito,$dleito, $sorigem, $sdestino, $precaucao, $sventilatorio, $critico,$condicao, $status, $idtransporte,$veiculo,$observacao, $conn){
    //Verificando variaveis vazias
    if(!empty($post[$ppaciente])){
      $ppaciente = $post[$ppaciente];
    }
    else{
      $ppaciente = "";
    }
      $psprontuario = $psprontuario;
    if(!empty($post[$idtecnico])){
      $idtecnico = $post[$idtecnico];
    }
    else{
      $idtecnico = "";
    }
    if(!empty($post[$oleito])){
      $oleito = $post[$oleito];
    }
    else{
      $oleito = "";
    }
    if(!empty($post[$dleito])){
      $dleito = $post[$dleito];
    }
    else{
      $dleito = "";
    }
    if(!empty($post[$sorigem])){
      $sorigem = $post[$sorigem];
    }
    else{
      $sorigem = "";
    }
    if(!empty($post[$sdestino])){
      $sdestino = $post[$sdestino];
    }
    else{
      $sdestino = "";
    }
    if(!empty($post[$precaucao])){
      $precaucao = $post[$precaucao];
    }
    else{
      $precaucao = "";
    }
    if(!empty($post[$sventilatorio])){
      $sventilatorio = $post[$sventilatorio];
    }
    else{
      $sventilatorio = "";
    }
    if(!empty($post[$critico])){
      $critico = $post[$critico];
    }
    else{
      $critico = "0";
    }
    if(!empty($post[$condicao])){
      $condicao = $post[$condicao];
    }
    else{
      $condicao = "0";
    }
    if(!empty($sventilatorio)){
      if ($sventilatorio > 1) {
        $oxigenio = "1";
      }
      else{
        $oxigenio = "0";
      }
    }
    else{
      $oxigenio = "0";
    }
    $status = "1";
    $idtransporte = "0";
    if(!empty($post[$veiculo])){
      $veiculo = $post[$veiculo];
    }
    else{
      $veiculo = "";
    }
    if(!empty($post[$observacao])){
      $observacao = $post[$observacao];
    }
    else{
      $observacao = "";
    }
    try {
      $stmt = $conn->prepare('INSERT INTO tchamado(ppaciente,psprontuario, idtecnico, sorigem, sdestino,precaucao, sventilatorio, critico, condicao, status, idtransporte, veiculo, observacao, oleito, dleito) VALUES(:ppaciente,:psprontuario, :idtecnico,:sorigem, :sdestino,:precaucao, :sventilatorio, :critico, :condicao, :status, :idtransporte,:veiculo, :observacao, :oleito, :dleito)');
      $stmt->execute(array(
        ':psprontuario' => $psprontuario,
        ':ppaciente' => $ppaciente,
        ':idtecnico' => $idtecnico,
        ':oleito' => $oleito,
        ':dleito' => $dleito,
        ':sorigem' => $sorigem,
        ':sdestino' => $sdestino,
        ':precaucao' => $precaucao,
        ':sventilatorio' => $sventilatorio,
        ':critico' => $critico,
        ':condicao' => $condicao,
        ':status' => $status,
        ':idtransporte' => $idtransporte,
        ':veiculo' => $veiculo,
        ':observacao' => $observacao
      ));
      return 1;
      }
      catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return 0;
      }
}
function ChamadosCancelados($requisicao,$dados, $conn){
  try{
  $stmt = $conn->prepare("SELECT tchamado.id, tchamado.datachamado, tchamado.ppaciente,tchamado.psprontuario,tchamado.idtecnico,tchamado.sorigem, tchamado.sdestino,tchamado.precaucao, tchamado.sventilatorio, tchamado.critico, tchamado.condicao, tchamado.status, tchamado.idtransporte, tchamado.veiculo, tchamado.observacao, tchamado.oleito, tchamado.dleito FROM tchamado, tchamadostatus WHERE tchamadostatus.idstatus = 6 AND tchamadostatus.idchamado = tchamado.id ".$requisicao);
  $stmt->execute($dados);
  $chamados = [];
  while ($row = $stmt->fetch()) {
    array_push($chamados,
    array("id"=>$row["id"],
    "datachamado"=>date("d/m/Y h:i:s", strtotime($row["datachamado"])),
    "ppaciente"=>$row["ppaciente"],
    "psprontuario"=>$row["psprontuario"],
    "idtecnico"=>$row["idtecnico"],
    "sorigem"=>$row["sorigem"],
    "sdestino"=>$row["sdestino"],
    "precaucao"=>$row["precaucao"],
    "sventilatorio"=>$row["sventilatorio"],
    "critico"=>$row["critico"],
    "condicao"=>$row["condicao"],
    "status"=>$row["status"],
    "idtransporte"=>$row["idtransporte"],
    "veiculo"=>$row["veiculo"],
    "oleito"=>$row["oleito"],
    "dleito"=>$row["dleito"],
    "observacao" =>$row["observacao"] ));
  }
  return $chamados;
  }
  catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    return 0;
  }
}
function AtualizarChamado($data, $requisito, $conn){
  $dataA2 = "";
  $names = "";
  foreach ($data as $key => $value) {
    $names .= "{$key},";
    $dataA2 .= "{$key}=".$conn->quote($value).",";
  }
  $dataA2 = substr($dataA2,0,strlen($dataA2)-1);
  $names = substr($names,0,strlen($names)-1);
  try{
    $stmt = $conn->prepare('UPDATE tchamado SET '.$dataA2.' WHERE '.$requisito);
    $stmt->execute();
    return 1;
  }
  catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    return 0;
  }
}
  function CriarPesquisaChamado($data,$condition, $conn){
      $filterData = array();
      $requisicao = "";
      $requisicaoData = array();
      $datas = array();
      foreach ($data as $key => $value) {
        if (!empty($value)) {
          $filterData[$key] = $value;
        }
      }
      foreach ($filterData as $key => $value) {
        $keyFilter = preg_replace("[-]","",$key);
        $requisicao .= "{$keyFilter} ".$condition[$key]." {$conn->quote($value)} AND ";
        $requisicaoData[":{$key}"] = $value;
      }
      if (strlen($requisicao) > 0) {
        $requisicao = substr($requisicao,0,strlen($requisicao)-4);
      }
      array_push($datas, $requisicao);
      return $datas;
    }
  function ChamadoCancelado($idchamado,$conn){
    $chamadostatus = new ChamadoStatus();
    $chamadocancelado = $chamadostatus->PesquisarChamadoStatus("WHERE idchamado = :idchamado AND idstatus = :idstatus", array(":idchamado"=>$idchamado, ":idstatus" => 6),$conn);
    if(count($chamadocancelado) > 0):
      return true;
    else:
      return false;
    endif;
  }
  function ChamadoConcluido($idchamado,$conn){
    $chamadostatus = new ChamadoStatus();
    $chamadoconcluido = $chamadostatus->PesquisarChamadoStatus("WHERE idchamado = :idchamado AND idstatus = :idstatus", array(":idchamado"=>$idchamado, ":idstatus" => 4),$conn);
    if(count($chamadoconcluido) > 0):
      return true;
    else:
      return false;
    endif;
  }
  function ChamadoEncerrado($idchamado,$conn){
    $chamadostatus = new ChamadoStatus();
    $chamadoencerrado = $chamadostatus->PesquisarChamadoStatus("WHERE idchamado = :idchamado AND idstatus = :idstatus", array(":idchamado"=>$idchamado, ":idstatus" => 5),$conn);
    if(count($chamadoencerrado) > 0):
      return true;
    else:
      return false;
    endif;
  }
  function ChamadoTecnicos($idchamado, $conn){
    $tecnico = new Tecnico();
    $chamado = $this->PesquisarChamado("WHERE id = :idchamado",array(":idchamado" => $idchamado),$conn);
    $tecnicos = $tecnico->PesquisarTecnicoTransporte("WHERE idtransporte=:idtransporte AND cancelado = :cancelado",array(":idtransporte"=>$chamado[0]["idtransporte"],":cancelado" => "0"), $conn);
    if(count($tecnicos) > 0):
      return $tecnicos;
    else:
      return false;
    endif;
  }
  function ChamadoSolicitante($idchamado, $conn){
    $tecnico = new Tecnico();
    $chamado = $this->PesquisarChamado("WHERE id = :idchamado",array(":idchamado" => $idchamado),$conn);
    $idtransporte = $chamado[0]["idtransporte"];
    $idtecnico = $chamado[0]["idtecnico"];
    $tecnicotransporte = $tecnico->PesquisarTecnico("WHERE id=:idtecnico",array(":idtecnico"=>$idtecnico), $conn);
    if(count($tecnicotransporte) > 0):
      return $tecnicotransporte[0];
    else:
      return false;
    endif;
  }
  function ChamadoId($idchamado, $conn){
    $chamado = new Chamado();
    $chamadoa1 = $chamado->PesquisarChamado("WHERE id=:id",array(":id"=>$idchamado), $conn);
    if(count($chamadoa1) > 0):
      return $chamadoa1;
    else:
      return false;
    endif;
  }
  function PesquisarChamado($requisito, $dados,$conn){
    try{
    $stmt = $conn->prepare("SELECT id, datachamado, ppaciente,psprontuario,idtecnico,sorigem, sdestino,precaucao, sventilatorio, critico, condicao, status, idtransporte, veiculo, observacao, oleito, dleito FROM tchamado ".$requisito);
    $stmt->execute($dados);
    $chamados = [];
    while ($row = $stmt->fetch()) {
      array_push($chamados,
      array("id"=>$row["id"],
      "datachamado"=>date("d/m/Y H:i:s", strtotime($row["datachamado"])),
      "ppaciente"=>$row["ppaciente"],
      "psprontuario"=>$row["psprontuario"],
      "idtecnico"=>$row["idtecnico"],
      "sorigem"=>$row["sorigem"],
      "sdestino"=>$row["sdestino"],
      "precaucao"=>$row["precaucao"],
      "sventilatorio"=>$row["sventilatorio"],
      "critico"=>$row["critico"],
      "condicao"=>$row["condicao"],
      "status"=>$row["status"],
      "idtransporte"=>$row["idtransporte"],
      "veiculo"=>$row["veiculo"],
      "oleito"=>$row["oleito"],
      "dleito"=>$row["dleito"],
      "observacao" =>$row["observacao"] ));
    }
    return $chamados;
    }
    catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      return 0;
    }
  }
}

?>
