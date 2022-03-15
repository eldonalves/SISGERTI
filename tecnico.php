<?php
if (isset($_GET["pesquisar"])):
if (Config::isLogin() && Config::isUserTransporte()):
require_once("acao/chamado.php");
$tecnico = new Tecnico();
$requisicao = $tecnico->CriarPesquisaChamado(
		array(
			"nome"=> (!empty($_GET["nome"])) ? "%".$_GET["nome"]."%" : "",
			"datatecnico" => (!empty($_GET["bdata"])) ? $_GET["bdata"]." 00:00:00" : "",
			"datatecnico--" => (!empty($_GET["edata"])) ? $_GET["edata"]." 23:59:59" : ""),
		array(
			"nome"=>"LIKE",
			"datatecnico" => ">=",
			"datatecnico--" => "<="),
		$conn);
$pg = 1;
if(!empty($_GET["pg"]) && is_numeric($_GET["pg"])):
	$pg = $_GET["pg"];
else:
	$pg = 1;
endif;
<<<<<<< Updated upstream
$paginacaolimit = 25;
=======
$paginacaolimit = 15;
>>>>>>> Stashed changes
$paginacaoinicio = ($pg*$paginacaolimit) - $paginacaolimit;
$paginacaooptlimit = 10;
$tecnicos = $tecnico->PesquisarTecnico((!empty($requisicao[0])) ? "WHERE ".$requisicao[0]." ORDER BY id DESC LIMIT {$paginacaoinicio},{$paginacaolimit}" : "WHERE 1 ORDER BY id DESC LIMIT {$paginacaoinicio},{$paginacaolimit}", array(), $conn);
$paginacaocount = count($tecnico->PesquisarTecnico((!empty($requisicao[0])) ? "WHERE ".$requisicao[0]." ORDER BY id DESC" : "WHERE 1 ORDER BY id DESC", array(), $conn));
	?>
<section class="col">
    <div class="paginatitulo">TÉCNICOS</div>
    <form action="" method="get">
        <input type="hidden" name="p" value="tecnico.php">
        <input type="hidden" name="pesquisar" value="">
        <div class="fieldsetedit">
            <div class="title">FILTRO</div>
						<div class="form-row">
								<div class="form-group col-md-6">
									<label>Nome</label>
									<div> <input type="text" class="form-control" name="nome" value="<?php echo (!empty($_GET["nome"]) ? $_GET["nome"]:"") ?>"> </div>
								</div>
						</div>
						<div class="form-inline">
								<label class="mb-2">Data do Cadastro</label>
								<div class="form-group mx-sm-3 mb-2">
									<input class="form-control" type="date" name="bdata" value="<?php echo (!empty($_GET["bdata"])) ? $_GET["bdata"] : "" ; ?>">
								</div>-
								<div class="form-group mx-sm-3 mb-2">
									<input class="form-control" type="date" name="edata" value="<?php echo (!empty($_GET["edata"])) ? $_GET["edata"] : "" ; ?>">
								</div>
						</div>
<<<<<<< Updated upstream
            <div><input type="submit" value="PESQUISAR" class="buttonform"></div>
        </div>
    </form>
    <table class="table table-striped">
=======
            <div><input type="submit" value="PESQUISAR" class="btn btn-sm btn-primary"></div>
        </div>
    </form>
    <table id="procurartecnicos" class="table table-striped table-responsive-md">
				<thead>
>>>>>>> Stashed changes
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>DATA NASCIMENTO</th>
            <th>NÍVEL</th>
        </tr>
<<<<<<< Updated upstream
=======
			</thead>
			<tbody>
>>>>>>> Stashed changes
        <?php foreach ($tecnicos as $key => $value): ?>
        <tr>
            <td><?php echo "<a class=\"btn btn-sm btn-primary\" href=\"?p=tecnico.php&edit=".$value["id"]."\" >".$value["id"]."</a>" ?></td>
            <td><?php echo $value["nome"] ?></td>
            <td><?php echo $value["datanascimento"] ?></td>
            <td><?php echo Config::$niveltecnico[$value["nivel"]] ?></td>
        </tr>
        <?php endforeach; ?>
<<<<<<< Updated upstream
=======
			</tbody>
>>>>>>> Stashed changes
    </table>
		<?php Config::CreatePaginacao($paginacaocount, $paginacaolimit, $pg,$_SERVER["REQUEST_URI"]); ?>
</section>
<?php
endif;
?>
<?php
else:
  ?>





<?php
require_once("acao/tecnico.php");
if (isset($_GET["edit"])):
  if(!empty($_GET["edit"])):
    $tecnico = new Tecnico();
    $tecnico = $tecnico->PesquisarTecnico("WHERE id=:id",array(":id" => $_GET["edit"]),$conn);
    if(count($tecnico) > 0 && $_SESSION["usuario"]["nivel"] >= 2):
      $edit = 2;
    else:
      $edit = 1;
    endif;
  else:
    $edit = 1;
  endif;
  if($edit == 1):
    $usuario["id"] = $_SESSION["usuario"]["id"];
    $usuario["sexo"] = $_SESSION["usuario"]["sexo"];
    $usuario["nome"] = $_SESSION["usuario"]["nome"];
    $usuario["datanascimento"] = $_SESSION["usuario"]["datanascimento"];
    $usuario["nivel"] = $_SESSION["usuario"]["nivel"];
    $usuario["matricula"] = $_SESSION["usuario"]["prontuario"];
  else:
    foreach ($tecnico as $key => $value):
      $usuario["id"] = $value["id"];
      $usuario["sexo"] = $value["sexo"];
      $usuario["nome"] = $value["nome"];
      $usuario["datanascimento"] = $value["datanascimento"];
      $usuario["nivel"] = $value["nivel"];
      $usuario["matricula"] = $value["prontuario"];
    endforeach;
  endif;
endif;
?>
<section class="col">
    <div class="paginatitulo">EDITANDO INFORMAÇOES DO TÉCNICO</div>
    <form action="acao.php" method="post">
        <div class="fieldsetedit">
            <div class="title">INFORMAÇÕES PESSOAIS</div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nome Completo</label>
                    <input type="text" class="form-control" name="nome" required<?php
						        if(isset($edit)):
						          $nome = $usuario["nome"];
						          echo " value=\"".$nome."\"";
						        endif;
        						?>>
                </div>
								<div class="form-group col-md-6">
									<label>Data de Nacimento</label>
									<input type="date" class="form-control" name="datanascimento" required<?php
			if(isset($edit)):
				$datanascimento = $usuario["datanascimento"];
				echo " value=\"".date("Y-m-d",strtotime(str_replace("/","-",$datanascimento)))."\"";
			endif;
			?>>
								</div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Sexo</label>
                    <select name="sexo" class="form-control" required>
                        <option <?php echo (isset($edit) && $usuario["sexo"] == "m" ? "selected " : ""); ?>value="m">MASCULINO</option>
                        <option <?php echo (isset($edit) && $usuario["sexo"] == "f" ? "selected " : ""); ?>value="f">FEMININO</option>
                    </select>
                </div>
                <?php if (isset($edit) && $edit == 2 && $_SESSION["usuario"]["nivel"] >= 2): ?>
                <div class="form-group col-md-3">
                    <label>Nível</label>
                    <select name="nivel" class="form-control" required>
                        <option <?php echo (isset($edit) && $usuario["nivel"] == "1" ? "selected " : ""); ?>value="1">TÉCNICO</option>
                        <option <?php echo (isset($edit) && $usuario["nivel"] == "2" ? "selected " : ""); ?>value="2">TÉCNICO DO TRANSPORTE</option>
                        <option <?php echo (isset($edit) && $usuario["nivel"] == "3" ? "selected " : ""); ?>value="3">AUXILIAR ADMINISTRATIVO</option>
                    </select>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="fieldsetedit">
            <div class="title">MATRÍCULA</div>
            <input type="text" class="form-control" name="prontuario" required<?php
      if(isset($edit)):
        $nome = $usuario["matricula"];
        echo " value=".$nome;
      endif;
      ?>>
        </div>
        <?php if (!isset($edit)): ?>
        <div class="fieldsetedit">
            <div class="title">SENHA PARA ACESSAR O SISTEMA</div>
            <div class="titleform">SENHA</div>
            <input type="password" class="form-control" name="senha" required>
            <div class="titleform">DIGITE A SENHA NOVAMENTE</div>
            <input type="password" class="form-control" name="senhaa2" required>
        </div>
        <?php endif; ?>
        <div>
            <?php if (!isset($edit)): ?>
            <input type="hidden" name="acao" value="registrartecnico">
<<<<<<< Updated upstream
            <?php else: ?>
            <input type="hidden" name="acao" value="atualizartecnico">
            <?php endif; ?>
            <input type="submit" value="REGISTRAR" class="btn btn-primary">
=======
						<input type="submit" value="Registrar" class="btn btn-primary">
            <?php else: ?>
            <input type="hidden" name="acao" value="atualizartecnico">
						<input type="submit" value="Atualizar" class="btn btn-primary">
            <?php endif; ?>
>>>>>>> Stashed changes
        </div>
    </form>
</section>
<?php
endif;
?>
