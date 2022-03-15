<?php if (!empty($_GET["pesquisa"])):
require_once("acao/chamado.php");
$chamado = new Chamado();
$requisicao = $chamado->CriarPesquisaChamado(
		array(
			"ppaciente"=> (!empty($_GET["ppaciente"])) ? $_GET["ppaciente"] : "",
			"datachamado" => (!empty($_GET["bdata"])) ? $_GET["bdata"]." 00:00:00" : "",
			"datachamado--" => (!empty($_GET["edata"])) ? $_GET["edata"]." 23:59:59" : ""),
		array(
			"ppaciente"=>"=",
			"datachamado" => ">=",
			"datachamado--" => "<="),
		$conn);
		$pg = 1;
		if(!empty($_GET["pg"]) && is_numeric($_GET["pg"])):
			$pg = $_GET["pg"];
		else:
			$pg = 1;
		endif;
		$paginacaolimit = 30;
		$paginacaoinicio = ($pg*$paginacaolimit) - $paginacaolimit;
		$paginacaooptlimit = 10;
		$chamados = $chamado->PesquisarChamado((!empty($requisicao[0])) ? "WHERE ".$requisicao[0]." ORDER BY id DESC LIMIT {$paginacaoinicio},{$paginacaolimit}" : "WHERE 1 ORDER BY id DESC LIMIT {$paginacaoinicio},{$paginacaolimit}", array(), $conn);
		$paginacaocount = count($chamado->PesquisarChamado((!empty($requisicao[0])) ? "WHERE ".$requisicao[0]." ORDER BY id DESC" : "WHERE 1 ORDER BY id DESC", array(), $conn));
	?>
<<<<<<< Updated upstream
<section class="col col-md-auto">
=======
<section class="col">
>>>>>>> Stashed changes
    <div class="paginatitulo">CHAMADOS</div>
    <form action="" method="get">
        <input type="hidden" name="p" value="chamado.php">
        <input type="hidden" name="pesquisa" value="1">
        <div class="fieldsetedit">
            <div class="title">FILTRO</div>
<<<<<<< Updated upstream
            <table>
                <tr>

                    <td>
                        <div class="titleform">PRONTUARIO</div>
                        <div> <input type="text" name="ppaciente" value="<?php echo (!empty($_GET["ppaciente"]) ? $_GET["ppaciente"]:"") ?>"> </div>
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
=======
						<div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Prontuário</label>
                        <input class="form-control" type="text" name="ppaciente" value="<?php echo (!empty($_GET["ppaciente"]) ? $_GET["ppaciente"]:"") ?>">
                    </div>
									</div>
										<div class="form-inline">
												<label class="mb-2">Data do Transporte</label>
												<div class="form-group mx-sm-3 mb-2">
													<input class="form-control" type="date" name="bdata" value="<?php echo (!empty($_GET["bdata"])) ? $_GET["bdata"] : "" ; ?>">
												</div>-
												<div class="form-group mx-sm-3 mb-2">
													<input class="form-control" type="date" name="edata" value="<?php echo (!empty($_GET["edata"])) ? $_GET["edata"] : "" ; ?>">
												</div>
										</div>
            <div><input type="submit" value="PESQUISAR" class="btn btn-sm btn-primary"></div>
        </div>
    </form>
    <table class="table table-striped table-responsive-md">
>>>>>>> Stashed changes
        <tr>
            <th>ID</th>
            <th>ORIGEM</th>
            <th>DESTINO</th>
            <th>PRONTUARIO</th>
            <th>DATA DO CHAMADO</th>
            <th>STATUS</th>
        </tr>
        <?php foreach ($chamados as $key => $value): ?>
        <tr>
            <td><a class="<?php echo $chamado->Criticidade($value["id"],$conn) ?>" href="?p=transporte.php&idchamado=<?php echo $value["id"]?>"><?php echo strtoupper($value["id"]) ?></a></td>
<<<<<<< Updated upstream
            <td><?php echo strtoupper(Config::$setores[$value["sorigem"]]) ?></td>
            <td><?php echo strtoupper(Config::$setores[$value["sdestino"]]) ?></td>
=======
            <td><?php echo Config::$setores[$value["sorigem"]] ?></td>
            <td><?php echo Config::$setores[$value["sdestino"]] ?></td>
>>>>>>> Stashed changes
            <td><?php echo strtoupper($value["ppaciente"]) ?></td>
            <td><?php echo $value["datachamado"] ?></td>
            <td>
                <div <?php
				if($value["status"] == 5):
					if($chamado->ChamadoCancelado($value["id"], $conn)):
						echo "class=\"cancelado\"";
					else:
						echo "class=\"concluido\"";
					endif;
				endif;
				?>><?php echo Config::$status[$value["status"]] ?></div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<<<<<<< Updated upstream
=======
		<?php Config::CreatePaginacao($paginacaocount, $paginacaolimit, $pg,$_SERVER["REQUEST_URI"]); ?>
>>>>>>> Stashed changes
</section>
<?php elseif(!empty($_SESSION["usuario"]["id"])):?>
<section class="col">
    <div class="paginatitulo">CRIANDO CHAMADO PARA O TRANSPORTE</div>
    <form action="acao.php" method="POST">
        <div class="fieldsetedit">
            <div class="title">PACIENTE</div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Prontuário</label>
                    <input type="text" name="ppaciente" class="form-control prontuariochamado" placeholder="Prontuário" data-toggle="tooltip" data-placement="top" title="Prontuário do paciente" required>
										<small class="form-text text-muted">
  										Digite o prontuário do paciente, caso o paciente não tenha prontuário, ou o prontuário não foi encontrado, marque a opção de "Paciente sem Prontuário".
										</small>
                </div>
                <div class="col-auto my-1">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" id="psprontuario" class="custom-control-input checkPSProntuario" name="psprontuario">
                        <label class="custom-control-label" for="psprontuario">
                            Paciente sem prontuário.
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>Nome</label>
                    <input type="text" name="prontuarionome" class="form-control prontuarionome" placeholder="Nome" data-toggle="tooltip" data-placement="top" title="Nome do paciente" required disabled>
                </div>
<<<<<<< Updated upstream
                <div class="form-group col-md-4">
                    <label>Nome da Mãe</label>
                    <input type="text" name="prontuarionomemae" class="form-control prontuarionomemae" placeholder="Nome da Mãe" data-toggle="tooltip" data-placement="top" title="Nome da mãe do paciente" required disabled>
                </div>
                <div class="form-group col-auto">
=======
                <div class="form-group col-md-5">
                    <label>Nome da Mãe</label>
                    <input type="text" name="prontuarionomemae" class="form-control prontuarionomemae" placeholder="Nome da Mãe" data-toggle="tooltip" data-placement="top" title="Nome da mãe do paciente" required disabled>
                </div>
                <div class="form-group col-md-2">
>>>>>>> Stashed changes
                    <label for="inputEmail4">Data de Nascimento</label>
                    <input type="text" name="prontuariodatanascimento" class="form-control prontuariodatanascimento" placeholder="Data de Nascimento" data-toggle="tooltip" data-placement="top" title="Data de nacimento do paciente" required disabled>
                </div>
            </div>
        </div>
<<<<<<< Updated upstream

        <div class="fieldsetedit column">
            <div class="title">ORIGEM</div>
            <select class="selectSetorOLeito custom-select mr-sm-2" name="sorigem" data-toggle="tooltip" data-placement="top" title="Setor de origem" required>
                <option value="" selected disabled>ORIGEM</option>
                <?php foreach (Config::OrdemAlfabetica(Config::$setores) as $key => $value): ?>
                <option value="<?php echo $value[1] ?>"><?php echo $value[0] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="titleform">LEITO</div>
            <select class="selectChamadoOLeito custom-select mr-sm-2" required name="oleito">
            </select>
        </div>
        <div class="fieldsetedit column">
            <div class="title">DESTINO</div>
            <select class="selectSetorDLeito custom-select mr-sm-2" name="sdestino" data-toggle="tooltip" data-placement="top" title="Setor de destino" required>
                <option value="" selected disabled>DESTINO</option>
                <?php foreach (Config::OrdemAlfabetica(Config::$setores) as $key => $value): ?>
                <option value="<?php echo $value[1] ?>"><?php echo $value[0] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="titleform">LEITO</div>
            <select class="selectChamadoDLeito custom-select mr-sm-2" required name="dleito">
            </select>
        </div>
=======
				<div class="form-row">
					<div class="form-group col-md-3">
		        <div class="fieldsetedit column">
		            <div class="title">ORIGEM</div>
		            <select class="selectSetorOLeito custom-select mr-sm-2" name="sorigem" data-toggle="tooltip" data-placement="top" title="Setor de origem" required>
		                <option value="" selected disabled>ORIGEM</option>
		                <?php foreach (Config::OrdemAlfabetica(Config::$setores) as $key => $value): ?>
		                <option value="<?php echo $value[1] ?>"><?php echo $value[0] ?></option>
		                <?php endforeach; ?>
		            </select>
		            <div class="titleform">LEITO</div>
		            <select class="selectChamadoOLeito custom-select mr-sm-2" required name="oleito">
		            </select>
		        </div>
					</div>
					<div class="form-group col-md-3">
		        <div class="fieldsetedit column">
		            <div class="title">DESTINO</div>
		            <select class="selectSetorDLeito custom-select mr-sm-2" name="sdestino" data-toggle="tooltip" data-placement="top" title="Setor de destino" required>
		                <option value="" selected disabled>DESTINO</option>
		                <?php foreach (Config::OrdemAlfabetica(Config::$setores) as $key => $value): ?>
		                <option value="<?php echo $value[1] ?>"><?php echo $value[0] ?></option>
		                <?php endforeach; ?>
		            </select>
		            <div class="titleform">LEITO</div>
		            <select class="selectChamadoDLeito custom-select mr-sm-2" required name="dleito">
		            </select>
		        </div>
					</div>
			</div>
>>>>>>> Stashed changes
        <div class="fieldsetedit">
            <div class="title">SUPORTE VENTILATORIO</div>
            <ul class="listformata1">
                <?php foreach (Config::$sventilatorioicons as $key => $value): ?>
                <li><input class="checkstylea1" type="radio" <?php echo ($key == 1 ? "checked" : "") ?> value="<?php echo $key ?>" name="sventilatorio"><img src="<?php echo $value ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="fieldsetedit">
            <div class="title">CRÍTICO</div>
            <ul class="listformata1">
                <?php foreach (Config::$criticoicons as $key => $value): ?>
                <li><input class="checkstylea1" type="radio" <?php echo ($key == 1 ? "checked" : "") ?> value="<?php echo $key ?>" name="critico"><img src="<?php echo $value ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="fieldsetedit">
            <div class="title">CONDIÇÃO</div>
            <ul class="listformata1">
                <?php foreach (Config::$condicaoicons as $key => $value): ?>
                <li><input class="checkstylea1" type="radio" <?php echo ($key == 1 ? "checked" : "") ?> value="<?php echo $key ?>" name="condicao"><img src="<?php echo $value ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="fieldsetedit">
            <div class="title">PRECAUÇÃO</div>
            <ul class="listformata1">
                <?php foreach (Config::$precaucaoicons as $key => $value): ?>
                <li><input class="checkstylea1" type="radio" <?php echo ($key == 1 ? "checked" : "") ?> value="<?php echo $key ?>" name="precaucao"><img src="<?php echo $value ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="fieldsetedit">
            <div class="title">VEICULO</div>
            <ul class="listformata1">
                <?php foreach (Config::$veiculoicons as $key => $value): ?>
                <li><input class="checkstylea1" type="radio" <?php echo ($key == 1 ? "checked" : "") ?> value="<?php echo $key ?>" name="veiculo"><img src="<?php echo $value ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="fieldsetedit">
            <div class="title">Observações</div>
<<<<<<< Updated upstream
            <textarea class="form-control" data-toggle="tooltip" data-placement="top" title="Observações que devem ser passadas para o técnico de transporte"></textarea>
=======
            <textarea name="observacao" class="form-control" data-toggle="tooltip" data-placement="top" title="Observações que devem ser passadas para o técnico de transporte"></textarea>
>>>>>>> Stashed changes
        </div>
        <input type="hidden" name="acao" value="registrarchamado">
        <input type="hidden" name="idtecnico" value="<?php echo $_SESSION["usuario"]["id"] ?>">
        <input class="btn btn-primary btn-sm" type="submit" value="SOLICITAR">
    </form>
    </div>
</section>
<?php endif;?>
