<?php
date_default_timezone_set('America/Fortaleza');
class ChamadoStatus{
  function InserirChamadoStatus($idstatus, $idchamado,$idtecnico,$conn){
      //Verificando variaveis vazias
      $idstatus = $idstatus;
      $idchamado = $idchamado;
      $idtecnico = $idtecnico;
    try {
      $stmt = $conn->prepare('INSERT INTO tchamadostatus (idstatus, idchamado, idtecnico) VALUES(:idstatus, :idchamado, :idtecnico)');
      $stmt->execute(array(
        ':idstatus' => $idstatus,
        ':idchamado' => $idchamado,
        ":idtecnico" => $idtecnico
      ));
      return 1;
      }
      catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return 0;
      }
}
    function AtualizarChamadoStatus($data, $requisito, $conn){
      $dataA2 = "";
      $names = "";
      foreach ($data as $key => $value) {
        $names .= "{$key},";
        $dataA2 .= "{$key}=$value,";
      }
      $dataA2 = substr($dataA2,0,strlen($dataA2)-1);
      $names = substr($names,0,strlen($names)-1);
      $stmt = $conn->prepare('UPDATE tincidente SET '.$dataA2.' WHERE '.$requisito);
      $stmt->execute();
    }
    function PesquisarChamadoStatus($requisito, $dados,$conn){
    try{
    $stmt = $conn->prepare("SELECT id, idstatus, idchamado FROM tchamadostatus ".$requisito);
    $stmt->execute($dados);
    $chamados = [];
    while ($row = $stmt->fetch()) {
      array_push($chamados, array("id"=>$row["id"],
      "idstatus"=>$row["idstatus"],
      "idchamado"=>$row["idchamado"]
    ));
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
