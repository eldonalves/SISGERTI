<?php if (!empty($_GET["pesquisa"])):
require_once("acao/chamado.php");
$chamado = new Chamado();
$requisicao = $chamado->CriarPesquisaChamado(
		array(
			"ppaciente"=> (!empty($_GET["ppaciente"])) ? $_GET["ppaciente"] : "",
			"datachamado" => (!empty($_GET["bdata"])) ? $_GET["bdata"]." 00:00:00" : "",
			"datachamado--" => (!empty($_GET["edata"])) ? $_GET["edata"]." 00:00:00" : ""),
		array(
			"ppaciente"=>"=",
			"datachamado" => ">",
			"datachamado--" => "<"),
		$conn);
$chamados = $chamado->PesquisarChamado((!empty($requisicao[0])) ? "WHERE ".$requisicao[0]." ORDER BY id DESC" : "WHERE 1", array(), $conn);
	?>
	<section class="pagina">
		<div class="paginatitulo">CHAMADOS</div>
		<form action="" method="get">
			<input type="hidden" name="p" value="chamado.php">
			<input type="hidden" name="pesquisa" value="1">
			<div class="fieldsetedit">
				<div class="title">Filtro</div>
				<table>
			<tr>

				<td>
					<div class="titleform">PRONTUARIO</div>
					<div> <input type="text" name="ppaciente" value="<?php echo (!empty($_GET["ppaciente"])) ? $_GET["ppaciente"] : "" ; ?>"> </div>
				</td>
			</tr>
			<tr>

				<td>
					<div class="titleform">DATA DO TRANSPORTE</div>
					<div> <input type="date" name="bdata" value="<?php echo (!empty($_GET["bdata"])) ? $_GET["bdata"] : "" ; ?>"> - <input type="date" name="edata" value="<?php
					 echo (!empty($_GET["edata"])) ? $_GET["edata"] : "" ; ?>"></div>
				</td>
			</tr>
			</table>
			<div><input type="submit" value="PESQUISAR" class="buttonform"></div>
			</div>
		</form>
		<table class="tableinformacao">
			<tr>
				<th>ID</th>
				<th>ORIGEM</th>
				<th>DESTINO</th>
				<th>PRONTUARIO</th>
				<th>DATA DO CHAMADO</th>
			</tr>
			<?php foreach ($chamados as $key => $value): ?>
				<tr>
				<td><a href="?p=transporte.php&idchamado=<?php echo $value["id"]?>"><?php echo strtoupper($value["id"]) ?></a></td>
				<td><?php echo strtoupper(Config::$setores[$value["sorigem"]]) ?></td>
				<td><?php echo strtoupper(Config::$setores[$value["sdestino"]]) ?></td>
				<td><?php echo strtoupper($value["ppaciente"]) ?></td>
				<td><?php echo $value["datachamado"] ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</section>
<?php elseif(!empty($_SESSION["usuario"]["id"])):?>
<section class="pagina">
	<div class="paginatitulo">CRIANDO CHAMADO PARA O TRANSPORTE</div>
<div class="main">
		<form action="acao.php" method="POST">
			<div class="fieldsetedit"><div class="title">PACIENTE</div>
				<div class="formtitle">PRONTUÁRIO</div>
				<input type="text" class="prontuariochamado" name="ppaciente" required placeholder="Prontuario">
				<input type="text" name="" class="prontuarionome" placeholder="Nome do Paciente" disabled style="width: 100%">
			</div>

			<div class="fieldsetedit column"><div class="title">ORIGEM</div>
						<select class="selectformcolumn selectSetorOLeito" name="sorigem" required>
							<option value="" selected disabled>ORIGEM</option>
							<?php foreach (Config::$setores as $key => $value): ?>
								<option value="<?php echo $key ?>"><?php echo $value ?></option>
							<?php endforeach; ?>
						</select>
						<div class="formtitle">LEITO</div>
						<select class="selectformcolumn selectChamadoOLeito" name="oleito">
						</select>
			</div>
			<div class="fieldsetedit column"><div class="title">DESTINO</div>
			<select class="selectformcolumn selectSetorDLeito" name="sdestino" required>
			<option value="" selected disabled>DESTINO</option>
			<?php foreach (Config::$setores as $key => $value): ?>
				<option value="<?php echo $key ?>"><?php echo $value ?></option>
			<?php endforeach; ?>
				</select>
				<div class="formtitle">LEITO</div>
				<select class="selectformcolumn selectChamadoDLeito" name="dleito">
				</select>
		</div>

			<div class="fieldsetedit"><div class="title">CUIDADOS AO PACIENTE</div>
					<table>
						<tr><td><div class="formtitle">SUPORTE VENTILATORIO</div>
							<select class="selectform" name="sventilatorio">
								<?php foreach (Config::$sventilatorio as $key => $value): ?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
								<?php endforeach; ?>
						</select></td></tr>
						<tr><td>
							<div class="formtitle">CRÍTICO</div>
							<select class="selectform" name="critico">
								<option value="0">NÃO</option>
								<option value="1">SIM</option>
						</select></td></tr>
						<tr><td>
							<div class="formtitle">CONDIÇÃO</div>
							<select class="selectform" name="condicao">
								<?php foreach (Config::$condicao as $key => $value): ?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
								<?php endforeach; ?>
						</select></td></tr>
						<tr><td>
							<div class="formtitle">PRECAUÇÃO</div><select class="selectform" name="precaucao">
								<?php foreach (Config::$precaucao as $key => $value): ?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
								<?php endforeach; ?>
					</select></td></tr>
					</table>
			</div>
			</div>
			<div class="fieldsetedit">
				<div class="title">VEÍCULO</div>
				<select class="selectform" name="veiculo">
				<?php foreach (Config::$veiculo as $key => $value): ?>
					<option value="<?php echo $key;?>"><?php echo $value;?></option>
				<?php endforeach; ?>
			</select>
			</div>
			<div class="fieldsetedit">
				<div class="title">Observações</div>
				<textarea style="width: 100%; height: 150px;" name="observacao"></textarea>
			</div>
			<input type="hidden" name="acao" value="registrarchamado">
			<input type="hidden" name="idtecnico" value="<?php echo $_SESSION["usuario"]["id"] ?>">
			<input class="botaosubmit" type="submit" value="SOLICITAR">
		</form>
	</div>
</section>
<?php endif;?>
