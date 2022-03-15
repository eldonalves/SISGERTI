<?php
class Transporte{
  function InserirTransporte($post,$conn){
    $tcomeco = "";
    $ttermino = "";
    $ctermino = "";
    $dcomeco = "";
    $dtransporte = "";
    $tincidente = "";
    $oincidente = "";
    $observacao = "";
    try {
      $stmt = $conn->prepare('INSERT INTO ttransporte (tcomeco, ttermino, ctermino, dcomeco, dtransporte, tincidente, oincidente, observacao) VALUES(:tcomeco, :ttermino, :ctermino, :dcomeco, :dtransporte, :tincidente,:oincidente,:observacao)');
      $stmt->execute(array(
        ':tcomeco' => $tcomeco,
        ':ttermino' => $ttermino,
        ':ctermino' => $ctermino,
        ':dcomeco' => $dcomeco,
        ':dtransporte' => $dtransporte,
        ':tincidente' => $tincidente,
        ':oincidente' => $oincidente,
        ':observacao' => $observacao,
      ));
      return 1;
      }
      catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return 0;
      }
}
  function AtualizarTransporte($data, $requisito, $conn){
    $dataA2 = "";
    $names = "";
    foreach ($data as $key => $value) {
      $names .= "{$key},";
      $dataA2 .= "{$key}=".$conn->quote($value).",";
    }
    $dataA2 = substr($dataA2,0,strlen($dataA2)-1);
    $names = substr($names,0,strlen($names)-1);
    try{
      $stmt = $conn->prepare('UPDATE ttransporte SET '.$dataA2.' WHERE '.$requisito);
      $stmt->execute();
      return 1;
    }
    catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      return 0;
    }
  }
  function PesquisarTransporte($requisito, $dados,$conn){
    $stmt = $conn->prepare("SELECT id, tcomeco, ttermino, ctermino, dcomeco, dtransporte, tincidente, oincidente, observacao FROM ttransporte ".$requisito);
    $stmt->bindParam(':requisito', $requisito);
    $stmt->execute($dados);
    $pessoas = [];
    while ($row = $stmt->fetch()) {
      array_push($pessoas, array(
      "id"=>$row["id"],
      "tcomeco"=> "",
      "ttermino"=> date("Y-m-d H:i:s", strtotime($row["ttermino"])),
      "ctermino"=> date("Y-m-d H:i:s", strtotime($row["ctermino"])),
      "dcomeco"=> date("Y-m-d H:i:s", strtotime($row["dcomeco"])),
      "dtransporte"=>$row["dtransporte"],
      "tincidente"=>$row["tincidente"],
      "oincidente"=>$row["oincidente"],
      "observacao"=>$row["observacao"],
      "tcomeco"=>$row["tcomeco"]));
    }
    return $pessoas;
  }
}

?>
