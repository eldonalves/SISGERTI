<?php
date_default_timezone_set('America/Fortaleza');
class PacienteTemp{
  function InserirPacienteTemp($post,$nome, $nomemae, $datanascimento, $conn){
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
    if(!empty($post[$nomemae])){
      $nomemae = $post[$nomemae];
    }
    else{
      $nomemae = "";
    }
    try {
      $stmt = $conn->prepare('INSERT INTO tpacientetemp (nome, datanascimento, nomemae) VALUES(:nome, :datanascimento, :nomemae)');
      $stmt->execute(array(
        ':nome' => $nome,
        ':datanascimento' => $datanascimento,
        ':nomemae' => $nomemae,
      ));
      return $conn->lastInsertId();
      }
      catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return 0;
      }
}
  static function PesquisarPacienteTemp($requisito, $dados, $conn){
    $stmt = $conn->prepare('SELECT nome, nomemae, datanascimento FROM tpacientetemp '.$requisito);
    $stmt->execute($dados);
    $pacientes = [];
    while ($row = $stmt->fetch()) {
      array_push($pacientes, array("nome"=>$row["nome"],
      "nomemae"=>$row["nomemae"],
      "datanascimento"=>date("d/m/Y", strtotime($row["datanascimento"])
    )));
    }
    return $pacientes;
  }
}

?>
