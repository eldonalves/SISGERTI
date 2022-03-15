<?php
session_start();
date_default_timezone_set('America/Fortaleza');
require_once("conexaobd.php");
require_once("acao/paciente.php");
require_once("acao/chamado.php");
require_once("acao/incidente.php");
require_once("acao/transporte.php");
require_once("acao/tecnico.php");
require_once("acao/chamadostatus.php");
require_once("acao/pacientetemp.php");
require_once("acao/message.php");
require_once("config.php");
if (!empty($_POST["acao"])) {
    $acao = $_POST["acao"];
} elseif (!empty($_GET["acao"])) {
    $acao = $_GET["acao"];
} else {
    $acao = "";
}

<<<<<<< Updated upstream
switch($acao){
  case "registrarpaciente":
    $paciente = new Paciente();
    if($paciente->InserirPaciente($_POST, "nome", "datanascimento", "prontuario","sexo", "nomemae", $conn)){
      Message::createMessage("PACIENTE FOI REGISTRADO", "2");
      header("Location:/transporte/?p=paciente.php");
    }
  break;
  case "registrartecnico":
    $tecnico = new Tecnico();
    if($_POST["senha"] == $_POST["senhaa2"]):
      if($tecnico->InserirTecnico($_POST, "nome", "datanascimento", "prontuario","sexo","senha", $conn)):
        Message::createMessage("TÉCNICO FOI REGISTRADO", "2");
        header("Location:/transporte/?p=tecnico.php");
      else:
        Message::createMessage("NÃO FOI POSSÍVEL FAZER O CADASTRO.", "1");
        header("Location:/transporte/?p=tecnico.php");
      endif;
    else:
      Message::createMessage("SENHAS NÃO SÃO IGUAIS", "1");
      header("Location:/transporte/?p=tecnico.php");
    endif;
  break;
  case "atualizartecnico":
    $tecnico = new Tecnico();
    if(isset($_POST["nivel"]) && $_SESSION["usuario"]["nivel"] >= 3):
      if($tecnico->AtualizarTecnico(array("nome"=>$_POST["nome"], "nivel" => $_POST["nivel"], "sexo"=>$_POST["sexo"],"prontuario"=>$_POST["prontuario"],"datanascimento"=>$_POST["datanascimento"]),"id=".$_SESSION["usuario"]["id"],$conn)):
        $_SESSION["usuario"]["nome"] = $_POST["nome"];
        $_SESSION["usuario"]["sexo"] = $_POST["sexo"];
        $_SESSION["usuario"]["datanascimento"] = $_POST["datanascimento"];
        $_SESSION["usuario"]["prontuario"] = $_POST["prontuario"];
        header("Location:/transporte/?p=tecnico.php&edit");
      endif;
    endif;
    if($tecnico->AtualizarTecnico(array("nome"=>$_POST["nome"],"sexo"=>$_POST["sexo"],"prontuario"=>$_POST["prontuario"],"datanascimento"=>$_POST["datanascimento"]),"id=".$_SESSION["usuario"]["id"],$conn)):
      $_SESSION["usuario"]["nome"] = $_POST["nome"];
      $_SESSION["usuario"]["sexo"] = $_POST["sexo"];
      $_SESSION["usuario"]["datanascimento"] = $_POST["datanascimento"];
      $_SESSION["usuario"]["prontuario"] = $_POST["prontuario"];
      header("Location:/transporte/?p=tecnico.php&edit");
    endif;
    break;
  case "registrarchamado":
  $chamado = new Chamado();
  $paciente = new Paciente();
    if(empty($_POST["psprontuario"])):
      if(count($paciente->PesquisarPaciente("WHERE prontuario = :ppaciente", array(":ppaciente"=>$_POST["ppaciente"]),$conn)) > 0):
        if($chamado->InserirChamado($_POST,"ppaciente","","idtecnico", "oleito", "dleito","sorigem", "sdestino", "precaucao", "sventilatorio", "critico", "condicao", "status", "idtransporte","veiculo","observacao",$conn)):
          Message::createMessage("CHAMADO FOI REGISTRADO", "2");
          header("Location:/transporte/?p=chamado.php");
        endif;
      else:
        Message::createMessage("PRONTUÁRIO NÃO FOI ENCONTRADO", "1");
        header("Location:/transporte/?p=chamado.php");
=======
switch ($acao) {
    case "registrarpaciente":
        $paciente = new Paciente();
        if ($paciente->InserirPaciente($_POST, "nome", "datanascimento", "prontuario", "sexo", "nomemae", $conn)) {
            Message::createMessage("PACIENTE FOI REGISTRADO", "2");
            header("Location:/transporte/?p=paciente.php");
        }
        break;
    case "registrartecnico":
        $tecnico = new Tecnico();
        if ($_POST["senha"] == $_POST["senhaa2"]):
            if ($tecnico->InserirTecnico($_POST, "nome", "datanascimento", "prontuario", "sexo", "senha", $conn)):
                Message::createMessage("TÉCNICO FOI REGISTRADO", "2");
                header("Location:/transporte/?p=tecnico.php");
            else:
                Message::createMessage("NÃO FOI POSSÍVEL FAZER O CADASTRO.", "1");
                header("Location:/transporte/?p=tecnico.php");
            endif;
        else:
            Message::createMessage("SENHAS NÃO SÃO IGUAIS", "1");
            header("Location:/transporte/?p=tecnico.php");
        endif;
        break;
    case "atualizartecnico":
        $tecnico = new Tecnico();
        if (isset($_POST["nivel"]) && $_SESSION["usuario"]["nivel"] >= 2 && $_POST["nivel"] > 0):
            if ($tecnico->AtualizarTecnico(array("nome" => $_POST["nome"],"nivel" => $_POST["nivel"],"sexo" => $_POST["sexo"],"datanascimento" => $_POST["datanascimento"]), "prontuario=" . $_POST["prontuario"], $conn)):
                Message::createMessage("DADOS SOBRE O TÉCNICO FOI ATUALIZADO", "2");
                header("Location:".$_SERVER["HTTP_REFERER"]);
            endif;
        elseif(isset($_POST["prontuario"]) && $_POST["prontuario"] == $_SESSION["usuario"]["prontuario"]):
          if ($tecnico->AtualizarTecnico(array("nome" => $_POST["nome"],"sexo" => $_POST["sexo"],"datanascimento" => $_POST["datanascimento"]), "id=" . $_SESSION["usuario"]["id"], $conn)):
              $_SESSION["usuario"]["nome"]           = $_POST["nome"];
              $_SESSION["usuario"]["sexo"]           = $_POST["sexo"];
              $_SESSION["usuario"]["datanascimento"] = $_POST["datanascimento"];
              $_SESSION["usuario"]["prontuario"]     = $_POST["prontuario"];
              Message::createMessage("PERFIL FOI ATUALIZADO", "2");
              header("Location:/transporte/?p=tecnico.php&edit");
          endif;
        endif;
        break;
    case "registrarchamado":
        $chamado  = new Chamado();
        $paciente = new Paciente();
        if(Config::VerifyEmptyPOST($_POST, array("sorigem", "sdestino", "precaucao", "sventilatorio", "critico", "condicao", "status", "idtransporte", "veiculo"))):
          Message::createMessage("FOI ENCONTRADO UM PROBLEMA NO REGISTRO DO CHAMADO, ENTRE EM CONTADO COM UM ADMINISTRADOR", "1");
          header("Location:/transporte/?p=chamado.php");
        endif;
        if (empty($_POST["psprontuario"])):
            if (count($paciente->PesquisarPaciente("WHERE prontuario = :ppaciente", array(
                ":ppaciente" => $_POST["ppaciente"]
            ), $conn)) > 0):
                if ($chamado->InserirChamado($_POST, "ppaciente", "", "idtecnico", "oleito", "dleito", "sorigem", "sdestino", "precaucao", "sventilatorio", "critico", "condicao", "status", "idtransporte", "veiculo", "observacao", $conn)):
                    Message::createMessage("CHAMADO FOI REGISTRADO", "2");
                    header("Location:/transporte/?p=chamado.php");
                endif;
            else:
                Message::createMessage("PRONTUÁRIO NÃO FOI ENCONTRADO", "1");
                header("Location:/transporte/?p=chamado.php");
            endif;
        else:
            $pacientetemp   = new PacienteTemp();
            $idpacientetemp = $pacientetemp->InserirPacienteTemp($_POST, "prontuarionome", "prontuarionomemae", "prontuariodatanascimento", $conn);
            if ($chamado->InserirChamado($_POST, "ppaciente", $idpacientetemp, "idtecnico", "oleito", "dleito", "sorigem", "sdestino", "precaucao", "sventilatorio", "critico", "condicao", "status", "idtransporte", "veiculo", "observacao", $conn)):
                Message::createMessage("CHAMADO FOI REGISTRADO", "2");
                header("Location:/transporte/?p=chamado.php");
            endif;
        endif;
        break;
    case "registrartransporte":
        $transporte = new Transporte();
        if ($chamado->InserirChamado($_POST, "tcomeco", "ttermino", "dcomeco", "dtransporte", "cincidente", "ctransporte", "observacao", $conn)) {
        }
        break;
    case "atualizartransportecomeco":
        if(Config::isUserTransporte()):
          $transporte   = new Transporte();
          $chamado      = new Chamado();
          $chamadostatus = new ChamadoStatus();
          $idtransporte = $conn->quote($_POST["idtransporte"]);
          $idchamado = $_POST["idchamado"];
          $tcomeco      = date("Y-m-d H:i:s");
          if(!$chamado->ChamadoCancelado($idchamado, $conn)):
            if ($transporte->AtualizarTransporte(array( "dcomeco" => $tcomeco ), "id={$idtransporte}", $conn)):
                $requisito = "idtransporte={$idtransporte}";
                $chamado->AtualizarChamado(array("status" => 3 ), $requisito, $conn);
                $chamadostatus->InserirChamadoStatus(3, $idchamado, $_SESSION["usuario"]["id"], $conn);
            endif;
          else:
          endif;
        endif;
        break;
    case "atualizartransportetermino":
      if(Config::isUserTransporte()):
        $transporte    = new Transporte();
        $chamado       = new Chamado();
        $tecnico       = new Tecnico();
        $chamadostatus = new ChamadoStatus();
        if (empty($_POST["idchamado"]) || empty($_POST["idchamado"])):
            Message::createMessage("ERROR NO SISTEMA, ENTRE EM CONTATO COM UM TÉCNICO DE INFORMÁTICA", "1");
            return false;
        endif;
        $idchamado          = $_POST["idchamado"];
        $idtransporte       = $_POST["idtransporte"];
        $ttermino           = date("Y-m-d H:i:s");
        $transportes        = $transporte->PesquisarTransporte("WHERE id=:id", array(
            ":id" => $idtransporte
        ), $conn);
        $tecnicostransporte = $tecnico->PesquisarTecnicoTransporte("WHERE idtransporte=:idtransporte AND cancelado = :cancelado", array(
            ":idtransporte" => $idtransporte,
            ":cancelado" => "0"
        ), $conn);
        if (strtotime($transportes[0]["dcomeco"]) > 0):
            if (count($tecnicostransporte) > 0):
                if ($transporte->AtualizarTransporte(array(
                    "ttermino" => $ttermino
                ), "id={$idtransporte}", $conn)):
                    $requisito = "idtransporte={$idtransporte}";
                    $chamado->AtualizarChamado(array(
                        "status" => 4
                    ), $requisito, $conn);
                    $chamadostatus->InserirChamadoStatus(4, $idchamado, $_SESSION["usuario"]["id"], $conn);
                endif;
              else:
                Message::createMessage("CHAMADO NÃO PODE SER CONCLUÍDO SEM NENHUM TÉCNICO ATRIBUÍDO.", "1");
            endif;
        endif;
>>>>>>> Stashed changes
      endif;
        break;
    case "addtecnicotransporte":
      if(Config::isUserTransporte()):
        $tecnico = new Tecnico();
        if ($tecnico->InserirTecnicoTransporte($_POST, "idtransporte", "idtecnico", $conn)):
        endif;
      endif;
<<<<<<< Updated upstream
    endif;
  break;
  case "registrartransporte":
    $transporte = new Transporte();
    if($chamado->InserirChamado($_POST,"tcomeco", "ttermino", "dcomeco", "dtransporte", "cincidente", "ctransporte", "observacao",$conn)){
      //header("location:http://".$_SERVER['SERVER_NAME']."/transporte/");
    }
    else{
    //header("location:http://".$_SERVER['SERVER_NAME']."/transporte/");
    }
  break;
  case "atualizartransportecomeco":
    $transporte = new Transporte();
    $chamado = new Chamado();
    $idtransporte = $conn->quote($_POST["idtransporte"]);
    $tcomeco = date("Y-m-d H:i:s");
    if($transporte->AtualizarTransporte(array("dcomeco" => $tcomeco),"id={$idtransporte}",$conn)){
      $requisito = "idtransporte={$idtransporte}";
      $chamado->AtualizarChamado(array("status" => 3),$requisito, $conn);
      echo date("d/m/Y H:i:s", strtotime($tcomeco));
    }
  break;
  case "atualizartransportetermino":
    $transporte = new Transporte();
    $chamado = new Chamado();
    $tecnico = new Tecnico();
    $chamadostatus = new ChamadoStatus();
    if(empty($_POST["idchamado"]) || empty($_POST["idchamado"])):
      Message::createMessage("ERROR NO SISTEMA, ENTRE EM CONTATO COM UM TÉCNICO DE INFORMÁTICA", "1");
      return false;
    endif;
    $idchamado = $_POST["idchamado"];
    $idtransporte = $_POST["idtransporte"];
    $ttermino = date("Y-m-d H:i:s");
    $transportes = $transporte->PesquisarTransporte("WHERE id=:id",array(":id"=> $idtransporte),$conn);
    $tecnicostransporte = $tecnico->PesquisarTecnicoTransporte("WHERE idtransporte=:idtransporte AND cancelado = :cancelado",array(":idtransporte"=>$idtransporte,":cancelado" => "0"), $conn);
    if(strtotime($transportes[0]["dcomeco"]) > 0):
      if(count($tecnicostransporte) > 0):
        if($transporte->AtualizarTransporte(array("ttermino" => $ttermino),"id={$idtransporte}",$conn)):
          $requisito = "idtransporte={$idtransporte}";
          $chamado->AtualizarChamado(array("status" => 4),$requisito, $conn);
          $chamadostatus->InserirChamadoStatus(4, $idchamado,$_SESSION["usuario"]["id"], $conn);
        endif;
      endif;
    endif;
  break;
  case "addtecnicotransporte":
    $tecnico = new Tecnico();
    if($tecnico->InserirTecnicoTransporte($_POST,"idtransporte", "idtecnico",$conn)):
    endif;
  break;
  case "concluirtransporte":
    $transporte = new Transporte();
    $chamado = new Chamado();
    $tecnico = new Tecnico();
    $incidente = new Incidente();
    $idchamado = $_POST["idchamado"];
    $incidentes = explode(",", $_POST["incidente"]);
    $chamadostatus = new ChamadoStatus();
    if(empty($incidentes[0])):
      $incidentes = array();
    endif;
    $idtransporte = $_POST["idtransporte"];
    foreach ($incidentes as $key => $value):
      $dados = explode("-",$value);
      $incidente->InserirIncidente($idtransporte,$dados[0],(count($dados) > 1 ? $dados[1] : ""),$_SESSION["usuario"]["id"],$conn);
    endforeach;
    if(!($chamado->ChamadoCancelado($idchamado,$conn))):
    //CHAMADO FOI CONCLUÍDO
    $transportes = $transporte->PesquisarTransporte("WHERE id=:id",array(":id"=> $idtransporte),$conn);
    $tecnicostransporte = $tecnico->PesquisarTecnicoTransporte("WHERE idtransporte=:idtransporte AND cancelado = :cancelado",array(":idtransporte"=>$idtransporte,":cancelado" => "0"), $conn);
    if(strtotime($transportes[0]["dcomeco"]) > 0):
      if (count($tecnicostransporte) > 0) :
        $ctermino = date("Y-m-d H:i:s");
        $transporte->AtualizarTransporte(array("ctermino" => $ctermino),"id={$idtransporte}",$conn);
        $requisito = "idtransporte={$idtransporte}";
        $chamado->AtualizarChamado(array("status" => 5),$requisito, $conn);
        $chamadostatus->InserirChamadoStatus(5, $idchamado,$_SESSION["usuario"]["id"], $conn);
        Message::createMessage("CHAMADO FOI CONCLÚIDO", "2");
      else:
        Message::createMessage("CHAMADO NÃO PODE SER CONCLUÍDO SEM NENHUM TÉCNICO ATRIBUÍDO.", "1");
      endif;
    else:
      Message::createMessage("CHAMADO NÃO PODE SER CONCLUÍDO SEM TER ÍNICIO DO TRANSPORTE.", "1");
    endif;
  elseif(count($incidentes) > 0):
    //CHAMADO FOI CANCELADO
    $ctermino = date("Y-m-d H:i:s");
    $transporte->AtualizarTransporte(array("ctermino" => $ctermino),"id={$idtransporte}",$conn);
    $requisito = "idtransporte={$idtransporte}";
    $chamado->AtualizarChamado(array("status" => 5),$requisito, $conn);
    $chamadostatus->InserirChamadoStatus(5, $idchamado,$_SESSION["usuario"]["id"], $conn);
    echo count($incidentes);
  else:
    Message::createMessage("ESTE CHAMADO FOI CANCELADO, NÃO PODE SER CONCLÚIDO SEM JUSTITIFICAR O CANCELAMENTO.", "1");
  endif;
  break;
  case "cancelartransporte":
    try{
      $transporte = new Transporte();
      $chamado = new Chamado();
      $tecnico = new Tecnico();
      $chamadostatus = new ChamadoStatus();
      $idtransporte = $_POST["idtransporte"];
      $idchamado = $_POST["idchamado"];
      $chamadoa1 = $chamado->ChamadoId($idchamado, $conn);
      if($chamadoa1["idtecnico"] == $_SESSION["usuario"]["id"]){
        $ttermino = date("Y-m-d H:i:s");
        $transporte->AtualizarTransporte(array("ttermino" => $ttermino),"id={$idtransporte}",$conn);
      }
      $requisito = "idtransporte={$idtransporte}";
      $chamado->AtualizarChamado(array("status" => 6),$requisito, $conn);
      $chamadostatus->InserirChamadoStatus(6, $idchamado,$_SESSION["usuario"]["id"], $conn);
    }
    catch(Exception $e) {
      echo 'Error: ' . $e->getMessage();
      return 0;
    }
  break;
  case 'acessarsistema':
    $tecnico = new Tecnico();
    $prontuario = (!empty($_POST["prontuario"])) ? $_POST["prontuario"] : "" ;
    $senha = (!empty($_POST["senha"])) ? md5($_POST["senha"]) : "" ;
    $acesso = $tecnico->PesquisarTecnico("WHERE prontuario=:prontuario AND senha=:senha", array(":prontuario"=>$prontuario, ":senha"=>$senha), $conn);
    if (count($acesso) > 0) {
      $_SESSION["usuario"]["id"] = $acesso[0]["id"];
      $_SESSION["usuario"]["nome"] = $acesso[0]["nome"];
      $_SESSION["usuario"]["datanascimento"] = $acesso[0]["datanascimento"];
      $_SESSION["usuario"]["sexo"] = $acesso[0]["sexo"];
      $_SESSION["usuario"]["nivel"] = $acesso[0]["nivel"];
      $_SESSION["usuario"]["prontuario"] = $acesso[0]["prontuario"];
      header("Location:/transporte/?p=painel.php");
    }
    else{
      Message::createMessage("USUÁRIO OU SENHA ESTÁ INCORRETO", "1");
      header("Location:/transporte/?p=login.php");
    }
    break;
=======
        break;
    case "concluirtransporte":
        $transporte    = new Transporte();
        $chamado       = new Chamado();
        $tecnico       = new Tecnico();
        $incidente     = new Incidente();
        $idchamado     = $_POST["idchamado"];
        $incidentes    = explode(",", $_POST["incidente"]);
        $chamadostatus = new ChamadoStatus();
        if (empty($incidentes[0])):
            $incidentes = array();
        endif;
        $idtransporte = $_POST["idtransporte"];
        foreach ($incidentes as $key => $value):
            $dados = explode("-", $value);
            $incidente->InserirIncidente($idtransporte, $dados[0], (count($dados) > 1 ? $dados[1] : ""), $_SESSION["usuario"]["id"], $conn);
        endforeach;
        if (!($chamado->ChamadoCancelado($idchamado, $conn))):
        //CHAMADO FOI CONCLUÍDO
            $transportes        = $transporte->PesquisarTransporte("WHERE id=:id", array(
                ":id" => $idtransporte
            ), $conn);
            $tecnicostransporte = $tecnico->PesquisarTecnicoTransporte("WHERE idtransporte=:idtransporte AND cancelado = :cancelado", array(
                ":idtransporte" => $idtransporte,
                ":cancelado" => "0"
            ), $conn);
            if (strtotime($transportes[0]["dcomeco"]) > 0):
                if (count($tecnicostransporte) > 0):
                    $ctermino = date("Y-m-d H:i:s");
                    $transporte->AtualizarTransporte(array(
                        "ctermino" => $ctermino
                    ), "id={$idtransporte}", $conn);
                    $requisito = "idtransporte={$idtransporte}";
                    $chamado->AtualizarChamado(array(
                        "status" => 5
                    ), $requisito, $conn);
                    $chamadostatus->InserirChamadoStatus(5, $idchamado, $_SESSION["usuario"]["id"], $conn);
                    Message::createMessage("CHAMADO FOI CONCLÚIDO", "2");
                else:
                    Message::createMessage("CHAMADO NÃO PODE SER CONCLUÍDO SEM NENHUM TÉCNICO ATRIBUÍDO.", "1");
                endif;
            else:
                Message::createMessage("CHAMADO NÃO PODE SER CONCLUÍDO SEM TER ÍNICIO DO TRANSPORTE.", "1");
            endif;
        elseif (count($incidentes) > 0):
            //CHAMADO FOI CANCELADO
            $ctermino = date("Y-m-d H:i:s");
            $transporte->AtualizarTransporte(array(
                "ctermino" => $ctermino
            ), "id={$idtransporte}", $conn);
            $requisito = "idtransporte={$idtransporte}";
            $chamado->AtualizarChamado(array(
                "status" => 5
            ), $requisito, $conn);
            $chamadostatus->InserirChamadoStatus(5, $idchamado, $_SESSION["usuario"]["id"], $conn);
            echo count($incidentes);
        else:
            Message::createMessage("ESTE CHAMADO FOI CANCELADO, NÃO PODE SER CONCLÚIDO SEM JUSTITIFICAR O CANCELAMENTO.", "1");
        endif;
        break;
    case "cancelartransporte":
        try {
            $transporte    = new Transporte();
            $chamado       = new Chamado();
            $tecnico       = new Tecnico();
            $chamadostatus = new ChamadoStatus();
            $idtransporte  = $_POST["idtransporte"];
            $idchamado     = $_POST["idchamado"];
            $chamadoa1     = $chamado->ChamadoId($idchamado, $conn);
            if ($chamadoa1["idtecnico"] == $_SESSION["usuario"]["id"]) {
                $ttermino = date("Y-m-d H:i:s");
                $transporte->AtualizarTransporte(array(
                    "ttermino" => $ttermino
                ), "id={$idtransporte}", $conn);
            }
            $requisito = "idtransporte={$idtransporte}";
            $chamado->AtualizarChamado(array(
                "status" => 6
            ), $requisito, $conn);
            $chamadostatus->InserirChamadoStatus(6, $idchamado, $_SESSION["usuario"]["id"], $conn);
        }
        catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
        break;
    case 'acessarsistema':
        $tecnico    = new Tecnico();
        $prontuario = (!empty($_POST["prontuario"])) ? $_POST["prontuario"] : "";
        $senha      = (!empty($_POST["senha"])) ? md5($_POST["senha"]) : "";
        $acesso     = $tecnico->PesquisarTecnico("WHERE prontuario=:prontuario AND senha=:senha", array(
            ":prontuario" => $prontuario,
            ":senha" => $senha
        ), $conn);
        if (count($acesso) > 0) {
            $_SESSION["usuario"]["id"]             = $acesso[0]["id"];
            $_SESSION["usuario"]["nome"]           = $acesso[0]["nome"];
            $_SESSION["usuario"]["datanascimento"] = $acesso[0]["datanascimento"];
            $_SESSION["usuario"]["sexo"]           = $acesso[0]["sexo"];
            $_SESSION["usuario"]["nivel"]          = $acesso[0]["nivel"];
            $_SESSION["usuario"]["prontuario"]     = $acesso[0]["prontuario"];
            header("Location:/transporte/?p=painel.php");
        } else {
            Message::createMessage("USUÁRIO OU SENHA ESTÁ INCORRETO", "1");
            header("Location:/transporte/?p=login.php");
        }
        break;
>>>>>>> Stashed changes
    case 'sairsistema':
        session_destroy();
        header("Location:/transporte/?p=login.php");
        break;


    case 'pesquisarprontuariochamado':
<<<<<<< Updated upstream
      $paciente = new Paciente();
      $prontuario = $_POST["prontuario"];
      $paciente = $paciente->PesquisarPaciente("WHERE prontuario=:prontuario",array(":prontuario" => $prontuario),$conn);
      if(count($paciente) > 0):
        $paciente[0]["datanascimento"] = date("d/m/Y", strtotime($paciente[0]["datanascimento"]));
        echo json_encode($paciente[0]);
      endif;
      break;

=======
        $paciente   = new Paciente();
        $prontuario = $_POST["prontuario"];
        if(!empty($prontuario)):
          $paciente   = $paciente->PesquisarPaciente("WHERE prontuario=:prontuario", array(
              ":prontuario" => $prontuario
          ), $conn);
          if (count($paciente) > 0):
              echo json_encode($paciente[0]);
          endif;
        endif;
          break;
>>>>>>> Stashed changes
    case 'removetecnicotransporte':
      if(Config::isUserTransporte()):
        $tecnico      = new Tecnico();
        $idtecnico    = $_POST["tecnico"];
        $idtransporte = $_POST["idtransporte"];
        $tecnico->AtualizarTecnicoTransporte(array(
            "cancelado" => 1
        ), "idtecnico = {$idtecnico} AND idtransporte = {$idtransporte}", $conn);
      endif;
        break;

    case 'atualizarpainelchamados':
      if(Config::isUserTransporte()):
        $chamado = new Chamado();
        $data = date("Y-m-d");
        $idnv = $_POST["idnv"];
        $idrecente = $_POST["idrecente"];
        $idcancelado = $_POST["idcancelado"];
        $idprocessando = $_POST["idprocessando"];
        $chamadosjson = array();
        $chamadosrecentes = $chamado->PesquisarChamado("WHERE DATE(datachamado)=:datachamado AND id > :id ORDER BY id", array(
            ":datachamado" => $data,
            ":id" => $idrecente
        ), $conn);
        if (count($chamadosrecentes) > 0) {
            for ($i = 0; $i < count($chamadosrecentes); $i++) {
              try{
                $chamadosrecentes[$i]["sorigem"]     = Config::$setores[$chamadosrecentes[$i]["sorigem"]];
                $chamadosrecentes[$i]["sdestino"]    = Config::$setores[$chamadosrecentes[$i]["sdestino"]];
                $chamadosrecentes[$i]["criticidade"] = $chamado->Criticidade($chamadosrecentes[$i]["id"], $conn);
                $chamadosrecentes[$i]["criticidadepontuacao"] = $chamado->CriticidadePontuacao($chamadosrecentes[$i]["id"], $conn);
              }
              catch(Exception $e){
                continue;
              }
            }
        }
        $chamadoscancelados = $chamado->ChamadosCancelados("AND tchamado.id > :id", array(
            ":id" => $idcancelado
        ), $conn);
        if (count($chamadoscancelados) > 0) {
            for ($i = 0; $i < count($chamadoscancelados); $i++) {
              try{
                $chamadoscancelados[$i]["sorigem"]     = Config::$setores[$chamadoscancelados[$i]["sorigem"]];
                $chamadoscancelados[$i]["sdestino"]    = Config::$setores[$chamadoscancelados[$i]["sdestino"]];
                $chamadoscancelados[$i]["criticidade"] = $chamado->Criticidade($chamadoscancelados[$i]["id"], $conn);
              }
              catch(Exception $e){
                continue;
              }
            }
        }
        $chamadosnv = $chamado->PesquisarChamado("WHERE id > :id AND status = 1 ORDER BY id", array(
            ":id" => $idnv
        ), $conn);
        if (count($chamadosnv) > 0) {
            for ($i = 0; $i < count($chamadosnv); $i++) {
              try{
                $chamadosnv[$i]["sorigem"] = (isset(Config::$setores[$chamadosnv[$i]["sorigem"]]) ? Config::$setores[$chamadosnv[$i]["sorigem"]]: "");
                $chamadosnv[$i]["sdestino"] = (isset(Config::$setores[$chamadosnv[$i]["sdestino"]]) ? Config::$setores[$chamadosnv[$i]["sdestino"]]: "");
                $chamadosnv[$i]["criticidade"] = $chamado->Criticidade($chamadosnv[$i]["id"], $conn);
              }
              catch(Exception $e){
                continue;
              }
            }
        }
        $chamadosp = $chamado->PesquisarChamado("WHERE id > :id AND status = 2 ORDER BY id", array(
            ":id" => $idprocessando
        ), $conn);
        if (count($chamadosp) > 0) {
            for ($i = 0; $i < count($chamadosp); $i++) {
              try{
                $chamadosp[$i]["sorigem"]     = Config::$setores[$chamadosp[$i]["sorigem"]];
                $chamadosp[$i]["sdestino"]    = Config::$setores[$chamadosp[$i]["sdestino"]];
                $chamadosp[$i]["criticidade"] = $chamado->Criticidade($chamadosp[$i]["id"], $conn);
              }
              catch(Exception $e){
                continue;
              }
            }
        }
        array_push($chamadosjson, $chamadosrecentes);
        array_push($chamadosjson, $chamadoscancelados);
        array_push($chamadosjson, $chamadosnv);
        array_push($chamadosjson, $chamadosp);
        echo json_encode($chamadosjson);
      endif;
        break;
    case 'pesquisarleitossetor':
        if (!empty($_POST["setor"])) {
            if (!empty(Config::$leitos[$_POST["setor"]])) {
                $setor = Config::$leitos[$_POST["setor"]];
                if (count($setor) > 0) {
                ?>
                <option value="">SELECIONE</option>
                <?php
                    foreach ($setor as $key => $value) {
                ?>
                <option value="<?php
                        echo $value;
                ?>"><?php
                        echo $value;
                ?></option>
                <?php
                    }
                }
            }
        }
        break;
    case "syncbd":
    $paciente = new Paciente();
      $pacientesdados = $_POST["pacientesdados"];
      $pacientesdadosa1 = explode("{paciente}", $pacientesdados);
      $pacientes = array();
      foreach ($pacientesdadosa1 as $key => $value) {
        $dados = explode(",", $value);
        if(count($dados) > 1){
          array_push($pacientes, $dados);
        }
      }
      foreach ($pacientes as $key => $value) {
        $value[3] = date("Y-m-d",strtotime(str_replace('/','-',$value[3])));
        if($paciente->InserirPacienteSyncBD($value[1],$value[3],$value[0],$value[2],$value[4],$conn)){
        }
      }
      break;
    case "atualizarpsprontuario":
        $chamado    = new Chamado();
        $idchamado  = $_POST["idchamado"];
        $prontuario = $_POST["pprontuario"];
        $chamado->AtualizarChamado(array(
            "ppaciente" => $prontuario
        ), "id={$idchamado}", $conn);
        break;
}

?>
