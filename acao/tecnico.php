<?php
date_default_timezone_set('America/Fortaleza');
class Tecnico{
  function InserirTecnico($post,$nome, $datanascimento, $prontuario, $sexo,$senha, $conn){
    //Verificando variaveis vazias
    if(!empty($post[$nome])){
      $nome = $post[$nome];
    }
    else{
      $nome = "";
    }
    if(!empty($post[$datanascimento])){
      $datanascimento = date("Y-m-d", strtotime($post[$datanascimento]));
    }
    else{
      $datanascimento = "";
    }
    if(!empty($post[$prontuario])){
      $prontuario = $post[$prontuario];
    }
    else{
      $prontuario = "";
    }
    if(!empty($post[$sexo])){
      $sexo = $post[$sexo];
    }
    else{
      $sexo = "";
    }
    if(!empty($post[$senha])){
      $senha = md5($post[$senha]);
    }
    else{
      $senha = "";
    }
    $nivel = "1";
    try {
      $stmt = $conn->prepare('INSERT INTO ttecnico (nome, datanascimento, prontuario, sexo,senha, nivel) VALUES(:nome, :datanascimento, :prontuario, :sexo,:senha, :nivel)');
      $stmt->execute(array(
        ':nome' => $nome,
        ':datanascimento' => $datanascimento,
        ':prontuario' => $prontuario,
        ':sexo' => $sexo,
        ':nivel'=> $nivel,
        ':senha'=> $senha
      ));
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
<<<<<<< Updated upstream
      $requisicao .= "{$keyFilter} ".$condition[$key]." '{$value}' AND ";
=======
      $requisicao .= "{$keyFilter} ".$condition[$key]." {$conn->quote($value)} AND ";
>>>>>>> Stashed changes
      $requisicaoData[":{$key}"] = $value;
    }
    if (strlen($requisicao) > 0) {
      $requisicao = substr($requisicao,0,strlen($requisicao)-4);
    }
    array_push($datas, $requisicao);
<<<<<<< Updated upstream
    array_push($datas, $requisicaoData);
=======
>>>>>>> Stashed changes
    return $datas;
  }
function AtualizarTecnico($data, $requisito, $conn){
  $dataA2 = "";
  $names = "";
  foreach ($data as $key => $value) {
    $names .= "{$key},";
    $dataA2 .= "{$key}=".$conn->quote($value).",";
  }
  $dataA2 = substr($dataA2,0,strlen($dataA2)-1);
  $names = substr($names,0,strlen($names)-1);
  try{
    $stmt = $conn->prepare('UPDATE ttecnico SET '.$dataA2.' WHERE '.$requisito);
    $stmt->execute();
    return 1;
  }
  catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    return 0;
  }
}
  static function PesquisarTecnico($requisito, $dados, $conn){
    $stmt = $conn->prepare('SELECT id,nome, prontuario, datanascimento, sexo,senha, nivel FROM ttecnico '.$requisito);
    $stmt->execute($dados);
    $pacientes = [];
    while ($row = $stmt->fetch()) {
      array_push($pacientes, array(
      "id"=>$row["id"],
      "nome"=>$row["nome"],
      "prontuario"=>$row["prontuario"],
      "datanascimento"=>date("d/m/Y",strtotime($row["datanascimento"])),
      "sexo" =>$row["sexo"],
      "senha"=>$row["senha"],
      "nivel" =>$row["nivel"]));
    }
    return $pacientes;
  }
  function AtualizarTecnicoTransporte($data, $requisito, $conn){
    $dataA2 = "";
    $names = "";
    foreach ($data as $key => $value) {
      $names .= "{$key},";
      $dataA2 .= "{$key}=".$conn->quote($value).",";
    }
    $dataA2 = substr($dataA2,0,strlen($dataA2)-1);
    $names = substr($names,0,strlen($names)-1);
    try{
      $stmt = $conn->prepare('UPDATE ttecnicotransporte SET '.$dataA2.' WHERE '.$requisito);
      $stmt->execute();
      return 1;
    }
    catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      return 0;
    }
  }
  function InserirTecnicoTransporte($post, $idtransporte, $idtecnico, $conn){
    //Verificando variaveis vazias
    if(!empty($post[$idtransporte])){
      $idtransporte = $post[$idtransporte];
    }
    else{
      $idtransporte = "";
    }
    if(!empty($post[$idtecnico])){
      $idtecnico = $post[$idtecnico];
    }
    else{
      $idtecnico = "";
    }
    try {
      $stmt = $conn->prepare('INSERT INTO ttecnicotransporte (idtransporte, idtecnico) VALUES(:idtransporte, :idtecnico)');
      $stmt->execute(array(
        ':idtransporte' => $idtransporte,
        ':idtecnico' => $idtecnico
      ));
      return 1;
      }
      catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return 0;
      }
    }
    static function PesquisarTecnicoTransporte($requisito, $dados, $conn){
      $stmt = $conn->prepare('SELECT id,idtransporte,idtecnico,datatecnicotransporte FROM ttecnicotransporte '.$requisito);
      $stmt->execute($dados);
      $pacientes = [];
      while ($row = $stmt->fetch()) {
        array_push($pacientes, array(
        "id"=>$row["id"],
        "idtransporte"=>$row["idtransporte"],
        "idtecnico"=>$row["idtecnico"],
        "datatecnicotransporte"=>$row["datatecnicotransporte"]));
      }
      return $pacientes;
    }
}

?>
