<?php
date_default_timezone_set('America/Fortaleza');
class Paciente{
  function InserirPaciente($post,$nome, $datanascimento, $prontuario, $sexo, $nomemae, $conn){
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
    if(!empty($post[$nomemae])){
      $nomemae = $post[$nomemae];
    }
    else{
      $nomemae = "";
    }
    try {
      $stmt = $conn->prepare('INSERT INTO tpaciente (nome, datanascimento, prontuario,sexo, nomemae) VALUES(:nome, :datanascimento, :prontuario,:sexo, :nomemae)');
      $stmt->execute(array(
        ':nome' => $nome,
        ':datanascimento' => $datanascimento,
        ':prontuario' => $prontuario,
        ':sexo' => $sexo,
        ':nomemae' => $nomemae,
      ));
      return 1;
      }
      catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return 0;
      }
}
function AtualizarPaciente($data, $requisito, $conn){
  $dataA2 = "";
  $names = "";
  foreach ($data as $key => $value) {
    $names .= "{$key},";
    $dataA2 .= "{$key}=".$conn->quote($value).",";
  }
  $dataA2 = substr($dataA2,0,strlen($dataA2)-1);
  $names = substr($names,0,strlen($names)-1);
  try{
    $stmt = $conn->prepare('UPDATE tpaciente SET '.$dataA2.' WHERE '.$requisito);
    $stmt->execute();
    return 1;
  }
  catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    return 0;
  }
}
function InserirPacienteSyncBD($nome, $datanascimento, $prontuario, $sexo, $nomemae, $conn){
  //Verificando variaveis vazias

    $nome = $nome;
    $datanascimento = $datanascimento;
    $prontuario = $prontuario;
    $sexo = $sexo;
    $nomemae = $nomemae;
  try {
    $stmt = $conn->prepare('INSERT INTO tpaciente (nome, datanascimento, prontuario,sexo, nomemae) VALUES(:nome, :datanascimento, :prontuario,:sexo, :nomemae)');
    $stmt->execute(array(
      ':nome' => $nome,
      ':datanascimento' => $datanascimento,
      ':prontuario' => $prontuario,
      ':sexo' => $sexo,
      ':nomemae' => $nomemae,
    ));
    return 1;
    }
    catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      return 0;
    }
}
  static function PesquisarPaciente($requisito, $dados, $conn){
    $stmt = $conn->prepare('SELECT nome, nomemae, prontuario, datanascimento, sexo FROM tpaciente '.$requisito);
    $stmt->execute($dados);
    $pacientes = [];
    while ($row = $stmt->fetch()) {
      array_push($pacientes, array("nome"=>$row["nome"],
      "nomemae"=>$row["nomemae"],
      "prontuario"=>$row["prontuario"],
      "datanascimento"=>date("d/m/Y", strtotime($row["datanascimento"])),
      "sexo" =>$row["sexo"]));
    }
    return $pacientes;
  }
}

?>
