<?php
require_once("acao/chamado.php");
require_once("acao/transporte.php");
require_once("acao/paciente.php");
require_once("acao/pacientetemp.php");
require_once("acao/tecnico.php");
require_once("acao/incidente.php");
require_once("acao/chamadostatus.php");
if(!empty($_GET["idchamado"])):
$chamado = new Chamado();
$paciente = new Paciente();
$idchamado = $_GET["idchamado"];
$chamados = $chamado->PesquisarChamado("WHERE id=:id",array(":id"=>$idchamado), $conn);
if(!empty($chamados[0]["id"])):
$paciente = $paciente->PesquisarPaciente("WHERE prontuario=:prontuario", array(":prontuario"=>$chamados[0]["ppaciente"]),$conn);
$pacientetemp = new PacienteTemp();
if(count($paciente) == 0 || $paciente[0]["prontuario"] == ""):
	$pacientetemp = $pacientetemp->PesquisarPacienteTemp("WHERE id=:psprontuario", array(":psprontuario"=>$chamados[0]["psprontuario"]),$conn);
endif;
if ($_SESSION["usuario"]["nivel"] > 1) {
	if($chamados[0]["idtransporte"] == 0){
		$transporte = new Transporte();
		$chamadostatus = new ChamadoStatus();
		$transporte->InserirTransporte("",$conn);
		$idtransporte = $conn->lastInsertId();
		$chamado->AtualizarChamado(array("idtransporte"=>$idtransporte, "status" => "2"),"id={$idchamado}",$conn);
		$requisito = "id={$idchamado}";
		$chamados = $chamado->PesquisarChamado("WHERE id=:id",array(":id"=>$idchamado), $conn);
		$chamadostatus->InserirChamadoStatus(2, $idchamado,$_SESSION["usuario"]["id"], $conn);
	}
	elseif($chamados[0]["status"] == 1) {
		$transporte = new Transporte();
		$idtransporte = $chamados[0]["idtransporte"];
		$chamado->AtualizarChamado(array("idtransporte"=>$idtransporte, "status" => "2"),"id={$idchamado}",$conn);
	}
}
else{
	if($chamados[0]["idtransporte"] == 0){
		$transporte = new Transporte();
		$transporte->InserirTransporte("",$conn);
		$idtransporte = $conn->lastInsertId();
		$chamado->AtualizarChamado(array("idtransporte"=>$idtransporte, "status" => "1"),"id={$idchamado}",$conn);
		$requisito = "id={$idchamado}";
		$chamados = $chamado->PesquisarChamado("WHERE id=:id",array(":id"=>$idchamado), $conn);
	}
}
$tecnico = new Tecnico();
$tecnicos = $tecnico->PesquisarTecnico("WHERE nivel > :nivel", array(":nivel" => 1), $conn);
$transporte = new Transporte();
$transporte = $transporte->PesquisarTransporte("WHERE id=:id",array(":id"=> $chamados[0]["idtransporte"]),$conn);
$tecnicosolicitante = $chamado->ChamadoSolicitante($chamados[0]["id"], $conn);
if (count($transporte) > 0) {
	$tecnicostransporte = $tecnico->PesquisarTecnicoTransporte("WHERE idtransporte=:idtransporte AND cancelado = :cancelado",array(":idtransporte"=>$transporte[0]["id"],":cancelado" => "0"), $conn);
} else {
	$tecnicostransporte = array();
}


?>
<<<<<<< Updated upstream
<section class="pagina">
<div class="paginatitulo">INFORMAÇÕES DO CHAMADO <?php echo $idchamado;?></div>
<section class="colunas colunaa1">
		<div class="fieldsetedit">
			<div class="title">INFORMAÇÕES DO PACIENTE</div>
			<div>
				<table class="table table-striped table-sm">
					<tr><th>PRONTUÁRIO</th><th>NOME</th><th>SEXO</th></tr>
					<tr><td><?php
					if(count($paciente) == 0 || $paciente[0]["prontuario"] == ""):
						if(count($pacientetemp) > 0):
							?>
							<button class="buttonform buttonPSProntuario">PRONTUÁRIO</button>
							<div class="modal psprontuariomodal" style="display:block">
=======
    <div class="paginatitulo">INFORMAÇÕES DO CHAMADO <?php echo $idchamado;?></div>
    <section class="col">
        <div class="fieldsetedit">
            <div class="title">INFORMAÇÕES DO PACIENTE</div>
						<div class="modal psprontuariomodal fade" id="psprontuariomodal" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
>>>>>>> Stashed changes
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Editar Prontuário</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div>
											<label>Prontuário</label>
											<input type="text" class="form-control pprontuario">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary btn-sm buttonAtualizarPSProntuario">Salvar</button>
									</div>
								</div>
							</div>
<<<<<<< Updated upstream
						</div>
							<?php
						endif;
					else:
						echo strtoupper($paciente[0]["prontuario"]);
					endif;
					?>
				</td>
					<td>
						<?php
						if(count($paciente) == 0):
							if(count($pacientetemp) > 0):
								echo $pacientetemp[0]["nome"];
							endif;
						else:
							echo strtoupper($paciente[0]["nome"]);
						endif;
						?>
					</td>
					<td>
						<?php
						if(count($paciente) == 0):
							if(count($pacientetemp) > 0):
								echo "";
							endif;
						else:
							echo strtoupper($paciente[0]["sexo"]);
						endif;
						?>
					</td>
				</tr>
				</table>
				<table class="table table-striped table-sm">
					<tr><th>NOME DA MÃE</th><th>DATA NASCIMENTO</th></tr>
					<tr><td><?php
					if(count($paciente) == 0):
						if(count($pacientetemp) > 0):
							echo $pacientetemp[0]["nomemae"];
						endif;
					else:
						echo strtoupper($paciente[0]["nomemae"]);
					endif;
						?></td>
						<td><?php
						if(count($paciente) == 0):
							if(count($pacientetemp) > 0):
								echo $pacientetemp[0]["datanascimento"];
							endif;
						else:
							echo strtoupper($paciente[0]["datanascimento"]);
						endif;
						 ?></td></tr>
				</table>
				<table class="table table-striped table-sm">
					<tr><th>ORIGEM</th><th>DESTINO</th></tr>
					<tr><td><?php
						echo Config::$setores[$chamados[0]["sorigem"]].(empty($chamados[0]["oleito"]) ? "" : "-".$chamados[0]["oleito"]);?></td>
						<td><?php echo Config::$setores[$chamados[0]["sdestino"]].(empty($chamados[0]["dleito"]) ? "" : "-".$chamados[0]["dleito"]); ?></td></tr>
				</table>
				<table class="table table-striped table-sm">
					<tr><th>SOLICITANTE</th></tr>
					<tr><td><?php echo $tecnicosolicitante["nome"] ?></td></tr>
				</table>
			</div>
		</div>
		<div class="fieldsetedit">
			<div class="title">OBSERVAÇÕES PASSADAS PELO SOLICITANTE</div>
			<textarea style="width: 100%; height: 150px;" name="observacao" disabled><?php echo $chamados[0]["observacao"] ?></textarea>
		</div>
		<div class="fieldsetedit">
			<div class="title">DETALHES DO TRANSPORTE</div>
			<div>
				<ul class="listformata1">
					<li><img src="<?php
=======
					</div>
            <div>
                <table class="table table-striped table-responsive-md">
                    <tr>
                        <th>PRONTUÁRIO</th>
                        <th>NOME</th>
                        <th>SEXO</th>
                    </tr>
                    <tr>
                        <td><?php
													if(count($paciente) == 0 || $paciente[0]["prontuario"] == ""):
														if(count($pacientetemp) > 0):
															?>
                            <button class="btn btn-primary btn-sm buttonPSProntuario" data-toggle="modal" data-target="#psprontuariomodal">Prontuário</button>
                            <?php
															endif;
														else:
															echo strtoupper($paciente[0]["prontuario"]);
														endif;
														?>
                        </td>
                        <td>
                            <?php
															if(count($paciente) == 0):
																if(count($pacientetemp) > 0):
																	echo $pacientetemp[0]["nome"];
																endif;
															else:
																echo strtoupper($paciente[0]["nome"]);
															endif;
														?>
                        </td>
                        <td>
                            <?php
															if(count($paciente) == 0):
																if(count($pacientetemp) > 0):
																	echo "";
																endif;
															else:
																echo strtoupper($paciente[0]["sexo"]);
															endif;
														?>
                        </td>
                    </tr>
                    <tr>
                        <th>NOME DA MÃE</th>
                        <th colspan="2">DATA NASCIMENTO</th>
                    </tr>
                    <tr>
                        <td>
													<?php
															if(count($paciente) == 0):
																if(count($pacientetemp) > 0):
																	echo $pacientetemp[0]["nomemae"];
																endif;
															else:
																echo strtoupper($paciente[0]["nomemae"]);
															endif;
																?>
													</td>
										      <td colspan="2">
														<?php
																if(count($paciente) == 0):
																	if(count($pacientetemp) > 0):
																		echo $pacientetemp[0]["datanascimento"];
																	endif;
																else:
																	echo strtoupper($paciente[0]["datanascimento"]);
																endif;
						 										?>
													</td>
                    </tr>
                    <tr>
                        <th>ORIGEM</th>
                        <th colspan="2">DESTINO</th>
                    </tr>
                    <tr>
                        <td><?php echo Config::$setores[$chamados[0]["sorigem"]].(empty($chamados[0]["oleito"]) ? "" : "-".$chamados[0]["oleito"]);?></td>
                        <td colspan="2"><?php echo Config::$setores[$chamados[0]["sdestino"]].(empty($chamados[0]["dleito"]) ? "" : "-".$chamados[0]["dleito"]); ?></td>
                    </tr>
                    <tr>
                        <th colspan="3">SOLICITANTE</th>
                    </tr>
                    <tr>
                        <td colspan="3"><?php echo $tecnicosolicitante["nome"] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="fieldsetedit">
            <div class="title">OBSERVAÇÕES PASSADAS PELO SOLICITANTE</div>
            <textarea style="width: 100%; height: 150px;" name="observacao" disabled><?php echo $chamados[0]["observacao"] ?></textarea>
        </div>
        <div class="fieldsetedit">
            <div class="title">DETALHES DO TRANSPORTE</div>
            <div>
                <ul class="listformata1">
                    <li><img src="<?php
>>>>>>> Stashed changes
						foreach (Config::$sventilatorioicons as $key => $value) {
							if ($chamados[0]["sventilatorio"] == $key && $key > 1)
							{
								echo $value;
							}
						}
					?>"></li>
                    <li><img src="<?php
						foreach (Config::$criticoicons as $key => $value) {
							if ($chamados[0]["critico"] == $key && $key > 1)
							{
								echo $value;
							}
						}
					?>"></li>
                    <li><img src="<?php
						foreach (Config::$precaucaoicons as $key => $value) {
							if ($chamados[0]["precaucao"] == $key && $key > 1)
							{
								echo $value;
							}
						}
					?>"></li>
                    <li><img src="<?php
						foreach (Config::$condicaoicons as $key => $value) {
							if ($chamados[0]["condicao"] == $key && $key > 1)
							{
								echo $value;
							}
						}
					?>"></li>
                    <li><img src="<?php
						foreach (Config::$veiculoicons as $key => $value) {
							if ($chamados[0]["veiculo"] == $key)
							{
								echo $value;
							}
						}
					?>"></li>
<<<<<<< Updated upstream
				</ul>
			</div>
		</div>
		<?php if (true): ?>
			<div class="fieldsetedit">
				<div class="title">TÉCNICOS RESPONSÁVEL PELO TRANSPORTE</div>
				<table class="listatecnico tableinformacao">
					<?php foreach ($tecnicostransporte as $key => $value): ?>
						<tr>
							<?php foreach ($tecnicos as $keyA1 => $valueA1): ?>
								<?php if ($valueA1["id"] == $value["idtecnico"]): ?>
									<td style="width:19px"><?php echo $valueA1["id"] ?></td>
									<td><?php echo $valueA1["nome"] ?></td>
									<?php if (strtotime($transporte[0]["ttermino"]) < 1): ?>
										<td style="width:34px"><div class="buttonform removetecnicotransporte">&times;</div></td>
									<?php endif; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</table>
				<?php if ($_SESSION["usuario"]["nivel"] > 1 && strtotime($transporte[0]["ttermino"]) < 1): ?>
					<button class="addTecnicosTransporteButton buttonForm">ADICIONAR TÉCNICO</button>
				<?php endif; ?>

				<div class="modal addTecnicosTransporteModal">
					<div class="modal-content">
					<div class="close closeModal">&times;</div>
					<p>
					<select class="formtecnicos">
						<?php if (!empty($tecnicostransporte)): ?>
							<?php foreach ($tecnicos as $key => $value): ?>
										<?php if (count($tecnico->PesquisarTecnicoTransporte("WHERE idtecnico=:idtecnico AND idtransporte=:idtransporte AND cancelado = :cancelado",array(":idtecnico"=>$value["id"], ":idtransporte"=>$transporte[0]["id"], ":cancelado" => 0),$conn)) == 0):?>
											<?php if ($valueA1["nivel"] == 2): ?>
												<option value="<?php echo $value["id"] ?>"><?php echo $value["nome"] ?></option>
											<?php endif; ?>
										<?php endif; ?>
							<?php endforeach; ?>
						<?php else: ?>
									<?php foreach ($tecnicos as $keyA1 => $valueA1): ?>
											<?php if ($valueA1["nivel"] == 2): ?>
												<option value="<?php echo $valueA1["id"] ?>"><?php echo $valueA1["nome"] ?></option>
											<?php endif; ?>
									<?php endforeach; ?>
						<?php endif; ?>
					</select>
					<button class="buttonForm addTecnicosTransporteButtonA1">ADICIONAR</button>
				</p>
				</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if (!($chamado->ChamadoConcluido($idchamado, $conn)) && !($chamado->ChamadoCancelado($idchamado, $conn))): ?>
			<div class="fieldsetedit">
				<div class="title">TRANSPORTE</div>
				<?php if (strtotime($transporte[0]["dcomeco"]) <= 0 && $_SESSION["usuario"]["nivel"] > 1): ?>
					<button class="buttonform atualizartransportecomeco">INICIAR</button>
				<?php endif; ?>
				<?php if (!($chamado->ChamadoConcluido($chamados[0]["id"],$conn)) && strtotime($transporte[0]["dcomeco"]) >= 0 || $_SESSION["usuario"]["nivel"] == 1): ?>
					<?php if ($_SESSION["usuario"]["nivel"] > 1): ?>
						<button class="buttonform atualizartransportetermino">TERMINAR</button>
					<?php endif; ?>
					<button class="buttonform cancelarchamado">CANCELAR</button>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ($chamado->ChamadoConcluido($chamados[0]["id"], $conn) || $chamado->ChamadoCancelado($chamados[0]["id"], $conn)): ?>
			<div class="fieldsetedit">
				<div class="title">HOUVE INCIDENTES?</div>
				<?php foreach (Config::$ctransporte as $key => $value):
=======
                </ul>
            </div>
        </div>
        <?php if (true): ?>
        <div class="fieldsetedit">
            <div class="title">TÉCNICOS RESPONSÁVEL PELO TRANSPORTE</div>
            <table class="listatecnico table table-striped">
                <?php foreach ($tecnicostransporte as $key => $value): ?>
                <tr>
                    <?php foreach ($tecnicos as $keyA1 => $valueA1): ?>
                    <?php if ($valueA1["id"] == $value["idtecnico"]): ?>
                    <td style="width:19px"><?php echo $valueA1["id"] ?></td>
                    <td><?php echo $valueA1["nome"] ?></td>
                    <?php if (Config::isUserTransporte() && strtotime($transporte[0]["ttermino"]) < 1 && !$chamado->ChamadoCancelado($chamados[0]["id"], $conn)): ?>
                    <td style="width:34px">
                        <div class="btn btn-danger btn-sm removetecnicotransporte">&times;</div>
                    </td>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php if ($_SESSION["usuario"]["nivel"] > 1 && strtotime($transporte[0]["ttermino"]) < 1 && !$chamado->ChamadoCancelado($chamados[0]["id"], $conn)): ?>
            <button class="addTecnicosTransporteButton btn btn-primary btn-sm" data-toggle="modal" data-target="#addtecnicomodal">Adicionar Técnico</button>
            <?php endif; ?>
            <div class="modal addtecnicomodal fade" id="addtecnicomodal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar técnico ao chamado.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <select class="form-control formtecnicos">
                                <?php if (!empty($tecnicostransporte)): ?>
                                <?php foreach ($tecnicos as $key => $valueA1): ?>
                                	<?php if (count($tecnico->PesquisarTecnicoTransporte("WHERE idtecnico=:idtecnico AND idtransporte=:idtransporte AND cancelado = :cancelado",array(":idtecnico"=>$valueA1["id"], ":idtransporte"=>$transporte[0]["id"], ":cancelado" => 0),$conn)) == 0):?>
                                		<?php if ($valueA1["nivel"] == 2): ?>
                                			<option value="<?php echo $valueA1["id"] ?>"><?php echo $valueA1["nome"] ?></option>
                                		<?php endif; ?>
                                	<?php endif; ?>
                                <?php endforeach; ?>
                                <?php else: ?>
                                	<?php foreach ($tecnicos as $keyA1 => $valueA1): ?>
                                		<?php if ($valueA1["nivel"] == 2): ?>
                                			<option value="<?php echo $valueA1["id"] ?>"><?php echo $valueA1["nome"] ?></option>
                                		<?php endif; ?>
                                	<?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary addTecnicosTransporteButtonA1">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if (!($chamado->ChamadoConcluido($idchamado, $conn)) && !($chamado->ChamadoCancelado($idchamado, $conn))): ?>
        <div class="fieldsetedit">
            <div class="title">TRANSPORTE</div>
            <?php if (strtotime($transporte[0]["dcomeco"]) <= 0 && $_SESSION["usuario"]["nivel"] > 1): ?>
            <button class="btn btn-primary btn-sm atualizartransportecomeco">INICIAR</button>
            <?php endif; ?>
            <?php if (!($chamado->ChamadoConcluido($chamados[0]["id"],$conn)) && strtotime($transporte[0]["dcomeco"]) >= 0 || $_SESSION["usuario"]["nivel"] == 1): ?>
            <?php if ($_SESSION["usuario"]["nivel"] > 1): ?>
            <button class="btn btn-success btn-sm atualizartransportetermino">TERMINAR</button>
            <?php endif; ?>
            <button class="btn btn-danger btn-sm cancelarchamado">CANCELAR</button>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if ($chamado->ChamadoConcluido($chamados[0]["id"], $conn) || $chamado->ChamadoCancelado($chamados[0]["id"], $conn)): ?>
        <div class="fieldsetedit">
            <div class="title">HOUVE INCIDENTES?</div>
            <?php foreach (Config::$ctransporte as $key => $value):
>>>>>>> Stashed changes
					$ctransporteid = "ctransporte".$key;
					$incidente = new Incidente();
					$incidenteencontrado = (count($incidente->PesquisarIncidente("WHERE idtransporte=:idtransporte AND idincidente=:idincidente",array(":idtransporte"=>$chamados[0]["idtransporte"],":idincidente" =>$key),$conn)) >= 1 ? true : false);
					?>
            <div class="checklist"><label for="<?php echo $ctransporteid ?>" <?php echo ($incidenteencontrado ? "style=\"font-weight:bold\" " : "") ?>><input type="checkbox" class="forminctransporte" <?php
					echo ($incidenteencontrado ? "checked " : "");
					echo (strtotime($transporte[0]["ctermino"]) > 0 ? "disabled " : "");
					?>name="ctransporte" id="<?php echo $ctransporteid ?>" value="<?php echo $key ?>"><?php echo $value ?></label></div>
            <?php endforeach; ?>
        </div>
        <div class="fieldsetedit oincidenteform" style="<?php
				$incidenteencontrado = $incidente->PesquisarIncidente("WHERE idtransporte=:idtransporte AND idincidente=:idincidente",array(":idtransporte"=>$chamados[0]["idtransporte"],":idincidente" =>24),$conn);
				echo (count($incidenteencontrado) >= 1 ? "display:block" : "display:none");
			?>">
            <div class="title">DIGITE O INCIDENTE</div>
            <textarea class="incidenteoutro" <?php echo (count($incidenteencontrado) >= 1 ? "disabled" : ""); ?>><?php echo (count($incidenteencontrado) >= 1 ? $incidenteencontrado[0]["texto"] : ""); ?></textarea>
        </div>
        <?php endif; ?>
    </section>
    <section class="col col-md-4">
        <div class="fieldsetedit">
            <div class="title">CHAMADO</div>
            <div>
                <table class="table table-striped table-responsive-md">
										<tr>
											<th>Começo</th>
											<th>Termino</th>
										</tr>
                    <tr>
                        <td>
                            <?php echo $chamados[0]["datachamado"]?>
                        </td>
                    <?php if ($_SESSION["usuario"]["nivel"] > 1): ?>
                        <td>
                            <?php
															if (strtotime($transporte[0]["ttermino"]) > 0): ?><?php
																echo date("d/m/Y H:i:s", strtotime($transporte[0]["ttermino"]));
																?><?php
								 						else:
									 						echo "CHAMADO AINDA ABERTO";
									 					?>
													<?php endif; ?>
                        </td>
                    </tr>
										<tr>
											<th colspan="2">Criticidade</th>
										</tr>
                    <tr>
                        <td colspan="2">
                          <div class="<?php echo $chamado->Criticidade($chamados[0]["id"],$conn) ?>"><?php  echo Config::$criticidade[$chamado->Criticidade($chamados[0]["id"],$conn)]?></div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <div class="fieldsetedit">
            <div class="title">INFORMAÇÕES DO TRANSPORTE</div>
            <div>
                <table class="table table-striped table-responsive-md">
                    <?php if ($_SESSION["usuario"]["nivel"] > 1): ?>
											<tr>
												<th>Inicio</th>
												<th>Termino</th>
											</tr>
                    <tr>
                        <td class="separador">
                            <?php
															if(strtotime($transporte[0]["dcomeco"]) > 0):
																echo date("d/m/Y H:i:s", strtotime($transporte[0]["dcomeco"]));
															else:
															endif;
														?>
                        </td>
                        <td>
                            <?php
															if (strtotime($transporte[0]["ttermino"]) > 0): ?><?php
																echo date("d/m/Y H:i:s", strtotime($transporte[0]["ttermino"]));
																?><?php
															 else:
																 echo "";
														?><?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <?php if ($_SESSION["usuario"]["nivel"] > 1): ?>
        <div class="fieldsetedit">
            <div class="title">DESEMPENHO</div>
            <div>
                <table class="table table-striped table-responsive-md">
										<tr>
											<th>Transporte</th>
											<th>Total</th>
											<th>Tempo Adequado</th>
										</tr>
                    <tr>
                        <td>
                            <?php
															echo (strtotime($transporte[0]["ttermino"]) > 0) ? Config::getMinutes($transporte[0]["ttermino"],$transporte[0]["dcomeco"])." Minutos" : "";
														?>
                            </span>
                        </td>
                        <td>
                            <?php
								 							echo (strtotime($transporte[0]["ttermino"]) > 0) ? Config::getMinutes($transporte[0]["ttermino"], date("Y-m-d H:i:s", Config::ConverterHorario($chamados[0]["datachamado"])))." Minutos" : ""
														?>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <?php endif; ?>
        <div class="fieldsetedit">
            <div class="title">STATUS DO CHAMADO</div>
            <div <?php
				if($chamados[0]["status"] == 5):
					if($chamado->ChamadoCancelado($chamados[0]["id"], $conn)):
						echo "class=\"cancelado\"";
					else:
						echo "class=\"concluido\"";
					endif;
				endif;
			?>><?php foreach (Config::$status as $key => $value): ?>
                <?php if ($chamados[0]["status"] == $key){echo $value;} ?>
                <?php endforeach; ?></div>
        </div>
        <form class="formatualizartransporte" action="acao.php" method="post">
            <input type="hidden" name="acao" value="atualizartransporte">
            <input type="hidden" name="idtransporte" value="<?php echo $transporte[0]["id"] ?>">
            <input type="hidden" name="idchamado" value="<?php echo $chamados[0]["id"] ?>">
        </form>
    </section>
    <?php if (!empty($_SESSION["usuario"]["id"]) && $_SESSION["usuario"]["nivel"] > 0): ?>
		<div class="w-100"></div>
    <div class="col">
        <?php if ($chamados[0]["status"] >= 4 && $transporte[0]["ctermino"] <= 0): ?>
        <button type="button" class="btn btn-primary btn-sm atualizartransporte">ENCERRAR CHAMADO</button>
        <?php endif; ?>
    </div>
    <?php endif; ?>
<?php endif;?>
<?php endif;?>
