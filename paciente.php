<section class="pagina">
  <div class="paginatitulo">REGISTRANDO PACIENTE NO SISTEMA</div>
  <form action="acao.php" method="post">
    <div class="fieldsetedit">
      <div class="title">INFORMAÇÕES PESSOAIS</div>
      <div>
        <div class="titleform">NOME COMPLETO DO PACIENTE</div>
        <input type="text" required name="nome">
      </div>
      <div>
        <div class="titleform">DATA DE NASCIMENTO</div>
        <input type="date" required name="datanascimento">
      </div>
      <div>
        <div class="titleform">NOME COMPLETO DA MÃE DO PACIENTE</div>
        <input type="text" required name="nomemae">
      </div>
      <div>
        <div class="titleform">SEXO DO PACIENTE</div>
        <select name="sexo" class="selectform">
          <option value="m">MASCULINO</option>
          <option value="F">FEMININO</option>
        </select>
      </div>
    </div>
    <div class="fieldsetedit">
      <div class="title">PRONTUÁRIO</div>
      <input type="text" required name="prontuario">
    </div>
  <div>
    <input type="hidden" name="acao" value="registrarpaciente">
    <input type="submit" value="REGISTRAR" class="botaosubmit">
  </div>
  </form>
</section>
