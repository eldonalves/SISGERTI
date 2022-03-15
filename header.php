<html>

<head>
    <title>HRSC - Hospital Regional do Sertao Central</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="/transporte/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js"></script>
    <script src="/transporte/js/bootstrap.min.js"></script>
<<<<<<< Updated upstream
    <script src="botoes.js"></script>
    <script src="vanillamasker.js"></script>
</head>

<body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/transporte/">Transporte</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <?php if (!Config::isLogin()): ?>
        <li class="nav-item <?php echo ($pagina == "chamado.php" ? "active":"") ?>">
          <a class="nav-link" href="?p=login.php">Login <span class="sr-only">(current)</span></a>
        </li>
      <?php endif; ?>
      <?php if (Config::isLogin()): ?>
        <li class="nav-item <?php echo ($pagina == "chamado.php" ? "active":"") ?>">
          <a class="nav-link" href="?p=chamado.php">Novo chamado</a>
        </li>
      <?php endif; ?>
      <?php if (Config::isLogin()): ?>
        <li class="nav-item <?php echo ($pagina == "painel.php" ? "active":"") ?>">
          <a class="nav-link" href="?p=painel.php">Painel</a>
        </li>
      <?php endif; ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php echo ($pagina == "tecnico.php" ? "active":"") ?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Técnicos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="?p=tecnico.php">Registrar</a>
          <a class="dropdown-item" href="?p=tecnico.php&pesquisar">Procurar</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
        <section>
            <?php if (Config::isLogin()): ?>
            <div class="menulogin">
                <div class="name"><?php echo $_SESSION["usuario"]["nome"] ?> <a href="acao.php?acao=sairsistema" style="padding:2px; background-color: #2488e0; color: #FFFFFF; border-radius:4px">SAIR</a></div>
            </div>
            <?php endif; ?>
        </section>
=======
    <script src="formulario.js"></script>
    <script src="botoes.js"></script>
    <script src="js/criticidade.js"></script>
    <script src="js/painel.js"></script>
    <script src="js/modal.js"></script>
    <script src="vanillamasker.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
          <div class="container">
            <a class="navbar-brand" href="/transporte/">Transporte</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php if (!Config::isLogin()): ?>
                    <li class="nav-item <?php echo ($pagina == "chamado.php" ? "active":"") ?>">
                        <a class="nav-link" href="?p=login.php">Login <span class="sr-only">(current)</span></a>
                    </li>
                    <?php endif; ?>
                    <?php if (Config::isLogin()): ?>
                    <li class="nav-item <?php echo ($pagina == "chamado.php" ? "active":"") ?>">
                        <a class="nav-link" href="?p=chamado.php">Novo chamado</a>
                    </li>
                    <?php endif; ?>
                    <?php if (Config::isLogin()): ?>
                    <li class="nav-item <?php echo ($pagina == "painel.php" ? "active":"") ?>">
                        <a class="nav-link" href="?p=painel.php">Painel</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo ($pagina == "tecnico.php" ? "active":"") ?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Técnicos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="?p=tecnico.php">Registrar</a>
                            <?php if (Config::isUserTransporte()): ?>
                              <a class="dropdown-item" href="?p=tecnico.php&pesquisar">Procurar</a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
            <?php if (Config::isLogin()): ?>
              <div>
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Minha conta</a>
                    <div class="dropdown-menu" aria-labelledby="menulogin">
                        <a class="dropdown-item" href="?p=tecnico.php&edit">Editar perfil</a>
                        <a class="dropdown-item" href="acao.php?acao=sairsistema">Sair</a>
                    </div>
                  </li>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        </nav>
>>>>>>> Stashed changes
    </header>
    <section class="container">
        <section class="row">
