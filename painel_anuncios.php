<?php require('protect.php'); 
require('config.php'); 
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inserir Anuncio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 960px;
        }
        .form-check {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
  <main>
    <header>
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="./img/logo-removebg-preview.png" alt="Logotipo" width="120" height="120" class="me-2">
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.html" class="nav-link px-2 text-dark">Início</a></li>
                    <li><a href="planos.html" class="nav-link px-2 text-dark">Planos</a></li>
                    <li><a href="duvidas.html" class="nav-link px-2 text-dark">Dúvidas</a></li>
                    <li><a href="sobre.html" class="nav-link px-2 text-dark">Sobre</a></li>
                    <a href="inserir_anuncio.php" class="btn btn-link">Inserir Anúncio</a>
                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-light" placeholder="Pesquise por característica" aria-label="Search">
                </form>
                <div class="text-end">
                
                <form action="logout.php" method="POST">
                  <button type="submit" class="btn btn-danger">Sair</button>
                </form>
                    <a href="planos.html" class="btn btn-warning">Quero Anunciar</a>
                </div>
                
            </div> 
            
            
        </div>
    </header>
    <div class="py-5 text-center">
      <h2>Painel de anúncios</h2>
      <p class="lead">Verifique ou delete anúncios expirados.</p>
      <div id="anuncios"><!-- novo -->
<div class="d-flex align-items-center p-3 border-bottom" id="painel67315cf28fb20">
    <div class="flex-shrink-0 me-3">
        <img src="uploads/Captura de tela 2024-09-30 170944.png" alt="Kula Minado" width="40" height="40" class="rounded-circle">
    </div>
    <div class="flex-grow-1">
        <h6 class="mb-0">Kula Minado</h6>
        <small class="text-muted">Criado em: 11/11/2024 | Plano: gatasAlta </small><br>
        <small class="text-muted">Expira em: 11/12/2024</small><br>
        <small>ID do Card: card67315cf28ee2f</small><br>
        <small>ID da Página de Perfil: perfil_67315cf28ee36.html</small><br>
        </div>
        <form action="delete.php" method="post" style="display:inline;">
            <input type="hidden" name="card_id" value="card67315cf28ee2f">
            <input type="hidden" name="perfil_page"  value="perfil_67315cf28ee36.html">
            <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
        </form>
</div>
    
    <div class="container">
        <div class="text-center"><br>
        <img src="./img/logo-removebg-preview.png" alt="Logotipo" width="180" height="180" class="me-2">
        </div>
        <footer class="py-0 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li><a href="#" class="nav-link px-2 text-dark">Início</a></li>
                        <li><a href="planos.html" class="nav-link px-2 text-dark">Planos</a></li>
                        <li><a href="duvidas.html" class="nav-link px-2 text-dark">Dúvidas</a></li>
                        <li><a href="sobre.html" class="nav-link px-2 text-dark">Sobre</a></li>
            </ul>
            <p class="text-center text-dark">&copy; Os anúncios em nosso site são de responsabilidade exclusiva do Anunciante e publicados sem verificação prévia por nossa equipe. Não nos responsabilizamos pela veracidade, legalidade, direitos de propriedade ou perturbações causadas pelo conteúdo inserido pelo usuário.</p>
        </footer>
    </div>
</div>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
