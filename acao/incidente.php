<?php
date_default_timezone_set('America/Fortaleza');
class Incidente{
  function InserirIncidente($idtransporte, $idincidente,$texto, $idtecnico,$conn){
      //Verificando variaveis vazias
      $idtransporte = $idtransporte;
      $idtecnico = $idtecnico;
      $idincidente = $idincidente;
      $texto = $texto;
    try {
      $stmt = $conn->prepare('INSERT INTO tincidente (idtransporte,idtecnico, idincidente, texto) VALUES(:idtransporte,:idtecnico,:idincidente, :texto)');
      $stmt->execute(array(
        ':idtransporte' => $idtransporte,
        ':idtecnico' => $idtecnico,
        ':idincidente' => $idincidente,
        ':texto' => $texto
      ));
      return 1;
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
        $dataA2 .= "{$key}=$value,";
      }
      $dataA2 = substr($dataA2,0,strlen($dataA2)-1);
      $names = substr($names,0,strlen($names)-1);
      $stmt = $conn->prepare('UPDATE tincidente SET '.$dataA2.' WHERE '.$requisito);
      $stmt->execute();
    }
    function PesquisarIncidente($requisito, $dados,$conn){
    try{
    $stmt = $conn->prepare("SELECT id, idtransporte,idtecnico, idincidente, texto FROM tincidente ".$requisito);
    $stmt->execute($dados);
    $chamados = [];
    while ($row = $stmt->fetch()) {
      array_push($chamados, array("id"=>$row["id"],
      "idtransporte"=>$row["idtransporte"],
      "idtecnico"=>$row["idtecnico"],
      "idincidente"=>$row["idincidente"],
      "texto"=>$row["texto"]
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
