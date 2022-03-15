<?php
session_start();
require_once("conexaobd.php");
require_once("config.php");
require_once("acao/message.php");
  $permissaopagina = ["chamado.php","transporte.php","paciente.php","tecnico.php","painel.php", "login.php"];
  $pagina = "login.php";
  if(!empty($_GET["p"])):
    if(Config::PermissaoPagina($_GET["p"])):
      $pagina = $_GET["p"];
    else:
      $pagina = "login.php";
    endif;
  else:
    $pagina = "login.php";
  endif;
  if(in_array($pagina, $permissaopagina)):
    require_once("header.php");
    require_once($pagina);
  endif;
  Message::sendMessage();
  require_once("footer.php");
?>
