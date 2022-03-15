<?php
require_once("acao/chamado.php");
$chamado = new Chamado();
?>
  <audio class="alertachamado">
  <source src="alertachamado.mp3" type="audio/mpeg">
  </audio>
  <audio class="alertacancelado">
  <source src="alertacancelado.mp3" type="audio/mpeg">
  </audio>
  <div class="paginatitulo">PAINEL DE CHAMADOS</div>
<<<<<<< Updated upstream
  <?php if($_SESSION["usuario"]["nivel"] > 1):?>
  <section class="col">
    <div class="fieldsetedit">
      <div class="title">CHAMADOS CRIADOS HOJE</div>
      <table class="table table-striped chamadosrecentes">
=======
  <?php if(Config::isUserTransporte()):?>
  <section class="col painelchamados">
    <div class="fieldsetedit border-success">
      <div class="title">CHAMADOS CRIADOS HOJE</div>
      <table class="table table-striped table-responsive-md chamadosrecentes">
>>>>>>> Stashed changes
        <tr>
          <th>ID</th><th>SETOR ORIGEM</th><th>SETOR DESTINO</th><th>DATA</th><th style="display:none">Pontuação</th>
          <?php
            $data = date("Y-m-d");
            $chamados = $chamado->PesquisarChamado("WHERE DATE(datachamado)=:datachamado ORDER BY id DESC LIMIT 6",array(":datachamado" => $data),$conn);
          ?>
        </tr>
          <?php foreach ($chamados as $key => $value): ?>
<<<<<<< Updated upstream
            <tr><td><a class="<?php echo $chamado->Criticidade($value["id"],$conn) ?> btn btn-sm" href="<?php echo "?p=transporte.php&idchamado=".$value["id"]?>" class="chamadonaourgente"><?php echo $value["id"]?></a></td><td><?php echo Config::$setores[$value["sorigem"]] ?></td><td><?php echo Config::$setores[$value["sdestino"]] ?></td><td><?php echo $value["datachamado"] ?></td></tr>
=======
            <tr><td><a target="_blank" class="<?php echo $chamado->Criticidade($value["id"],$conn) ?>" href="<?php echo "?p=transporte.php&idchamado=".$value["id"]?>" class="chamadonaourgente"><?php echo $value["id"]?></a></td>
              <td><?php echo Config::$setores[$value["sorigem"]] ?></td>
              <td><?php echo Config::$setores[$value["sdestino"]] ?></td>
              <td><?php echo $value["datachamado"] ?></td>
              <td style="display:none"><?php echo $chamado->CriticidadePontuacao($value["id"],$conn)?></td>
            </tr>
>>>>>>> Stashed changes
          <?php endforeach; ?>
      </table>
      <div><a href="?p=chamado.php&pesquisa=1&bdata=<?php echo $data ?>">VER MAIS</a></div>
    </div>
    <div class="fieldsetedit border-danger">
      <div class="title">CHAMADOS CANCELADOS</div>
<<<<<<< Updated upstream
      <table class="table table-striped chamadoscancelados">
=======
      <table class="table table-striped table-responsive-md chamadoscancelados">
>>>>>>> Stashed changes
        <tr>
          <th>ID</th><th>SETOR ORIGEM</th><th>SETOR DESTINO</th><th>DATA</th>
          <?php
            $data = date("Y-m-d");
            $chamados = $chamado->ChamadosCancelados("ORDER BY tchamado.id DESC LIMIT 6",array(),$conn);
          ?>
        </tr>
          <?php foreach ($chamados as $key => $value): ?>
<<<<<<< Updated upstream
            <tr><td><a class="<?php echo $chamado->Criticidade($value["id"],$conn) ?> btn btn-sm" href="<?php echo "?p=transporte.php&idchamado=".$value["id"] ?>"><?php echo $value["id"] ?></a></td><td><?php echo Config::$setores[$value["sorigem"]] ?></td><td><?php echo Config::$setores[$value["sdestino"]] ?></td><td><?php echo $value["datachamado"] ?></td></tr>
=======
            <tr><td><a target="_blank" class="<?php echo $chamado->Criticidade($value["id"],$conn) ?>" href="<?php echo "?p=transporte.php&idchamado=".$value["id"] ?>"><?php echo $value["id"] ?></a></td><td><?php echo Config::$setores[$value["sorigem"]] ?></td><td><?php echo Config::$setores[$value["sdestino"]] ?></td><td><?php echo $value["datachamado"] ?></td></tr>
>>>>>>> Stashed changes
          <?php endforeach; ?>
      </table>
      <div><a href="?p=chamado.php&pesquisa=1&bdata=<?php echo $data ?>">VER MAIS</a></div>
    </div>
<<<<<<< Updated upstream
    <div class="fieldsetedit">
      <div class="title">CHAMADOS</div>
      <table class="table table-striped">
=======
  </section>
  <section class="col">
    <div class="fieldsetedit border-warning">
      <div class="title">CHAMADOS POR CRITICIDADE</div>
      <table class="table table-striped table-responsive-md chamadospcriticidade">
        <tr>
          <th>ID</th><th>SETOR ORIGEM</th><th>SETOR DESTINO</th><th>DATA</th><th style="display:none">Pontuação</th>
        </tr>
      </table>
    </div>
    <div class="fieldsetedit border-warning">
      <div class="title">CHAMADOS PROCESSANDO</div>
      <table class="table table-striped table-responsive-md chamadosprocessando">
>>>>>>> Stashed changes
        <tr>
          <th>ID</th><th>SETOR ORIGEM</th><th>SETOR DESTINO</th><th>DATA</th>
          <?php
            $status = "2";
            $chamados = $chamado->PesquisarChamado("WHERE status = :status ORDER BY id DESC LIMIT 6",array(":status"=>$status),$conn);
          ?>
        </tr>
<<<<<<< Updated upstream
          <?php foreach ($chamados as $key => $value): ?>
            <tr><td><a class="<?php echo $chamado->Criticidade($value["id"],$conn) ?> btn btn-sm" href="<?php echo "?p=transporte.php&idchamado=".$value["id"] ?>"><?php echo $value["id"] ?></a></td><td><?php echo Config::$setores[$value["sorigem"]] ?></td><td><?php echo Config::$setores[$value["sdestino"]] ?></td><td><?php echo $value["datachamado"] ?></td></tr>
          <?php endforeach; ?>
=======
        <?php foreach ($chamados as $key => $value): ?>
          <tr><td><a target="_blank" class="<?php echo $chamado->Criticidade($value["id"],$conn) ?>" href="<?php echo "?p=transporte.php&idchamado=".$value["id"] ?>"><?php echo $value["id"] ?></a></td><td><?php echo Config::$setores[$value["sorigem"]] ?></td><td><?php echo Config::$setores[$value["sdestino"]] ?></td><td><?php echo $value["datachamado"] ?></td></tr>
        <?php endforeach; ?>
>>>>>>> Stashed changes
      </table>
    </div>
<<<<<<< Updated upstream
  </section>
  <section class="col">
    <div class="fieldsetedit">
      <div class="title">CHAMADOS EM ANDAMENTO</div>
      <table class="tableinformacao">
=======
    <div class="fieldsetedit border-primary">
      <div class="title">CHAMADOS NOVOS</div>
      <table class="table table-striped table-responsive-md chamadosnv">
>>>>>>> Stashed changes
        <tr>
          <th>ID</th><th>SETOR ORIGEM</th><th>SETOR DESTINO</th><th>DATA</th>
          <?php
            $chamados = $chamado->PesquisarChamado("WHERE status = 1 ORDER BY id DESC LIMIT 6",array(),$conn);
          ?>
        </tr>
          <?php foreach ($chamados as $key => $value): ?>
            <tr><td><a target="_blank" class="<?php echo $chamado->Criticidade($value["id"],$conn) ?>" href="<?php echo "?p=transporte.php&idchamado=".$value["id"] ?>"><?php echo $value["id"] ?></a></td><td><?php echo Config::$setores[$value["sorigem"]] ?></td><td><?php echo Config::$setores[$value["sdestino"]] ?></td><td><?php echo $value["datachamado"] ?></td></tr>
          <?php endforeach; ?>
      </table>
      <div><a href="#">VER MAIS</a></div>
    </div>
  </section>
  <?php else:?>
    <section class="col">
      <div class="fieldsetedit">
        <div class="title">CHAMADOS CRIADOS</div>
        <table class="table table-striped table-responsive-md">
          <tr>
            <th>ID</th><th>SETOR ORIGEM</th><th>SETOR DESTINO</th><th>PRONTUARIO</th><th>DATA</th><th>STATUS</th>
            <?php
              $data = date("Y-m-d");
              $chamados = $chamado->PesquisarChamado("WHERE idtecnico = :idtecnico ORDER BY id DESC LIMIT 6",array(":idtecnico"=>$_SESSION["usuario"]["id"]),$conn);
            ?>
          </tr>
            <?php foreach ($chamados as $key => $value): ?>
              <tr>
                <td><a class="<?php echo $chamado->Criticidade($value["id"],$conn) ?>" href="<?php echo "?p=transporte.php&idchamado=".$value["id"] ?>"><?php echo $value["id"] ?></a></td>
                <td><?php echo Config::$setores[$value["sorigem"]] ?></td>
                <td><?php echo Config::$setores[$value["sdestino"]] ?></td>
                <td><?php echo $value["ppaciente"] ?></td>
                <td><?php echo $value["datachamado"] ?></td>
                <td><div <?php
                if($value["status"] == 5):
                  if($chamado->ChamadoCancelado($value["id"], $conn)):
                    echo "class=\"cancelado\"";
                  else:
                    echo "class=\"concluido\"";
                  endif;
                endif;
                ?>><?php echo Config::$status[$value["status"]] ?></div></td>
              </tr>
            <?php endforeach; ?>
        </table>
        <div><a href="?p=chamado.php&pesquisa=1&bdata=<?php echo $data ?>">VER MAIS</a></div>
      </div>
    </section>
  <?php endif; ?>
