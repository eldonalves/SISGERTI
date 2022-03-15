<?php if (!Config::isLogin()):
  ?>
  <section class="col">
    <div class="paginatitulo">ACESSO AO SISTEMA</div>
    <form action="acao.php" method="post">
      <div class="fieldsetedit">
        <div class="title">LOGIN</div>
        <div class="form-group">
    <label for="exampleInputEmail1">Matrícula</label>
    <input type="text" name="prontuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Matrícula" required>
    <small id="emailHelp" class="form-text text-muted">Use sua matrícula para acessar o sistema.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Senha</label>
    <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
  </div>
      <div>
        <input type="hidden" name="acao" value="acessarsistema">
        <input type="submit" class="btn btn-sm btn-primary" value="CONECTAR">
      </div>
    </form>
  </section>
<?php else:
  header("Location:?p=painel.php");
  ?>

<?php endif; ?>
