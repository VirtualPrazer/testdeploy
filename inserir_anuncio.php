<?php require('protect.php'); 

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
<body class="text-bg-dark">
<div class="container">
  <main>
    <header>
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="./img/logo.png" alt="Logotipo" width="125" height=125px class="rounded-5 me-2">
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.html" class="nav-link px-2 text-light">Início</a></li>
                    <li><a href="planos.html" class="nav-link px-2 text-light">Planos</a></li>
                    <li><a href="duvidas.html" class="nav-link px-2 text-light">Dúvidas</a></li>
                    <li><a href="sobre.html" class="nav-link px-2 text-light">Sobre</a></li>
                    <a href="painel_anuncios.php" class="btn btn-secondary">Painel de Anúncios</a>
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
      <h2>Inserir anúncio</h2>
      <p class="lead">Preencha o formulário abaixo para inserir o anúncio.</p>
      
    </div>

    <div class="row g-5">
      <div class="col-md-7 col-lg-12">
        <h4 class="mb-3">Minhas Informações</h4>
        <form action="creator.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Nome</label>
              <input type="text" class="form-control bg-dark-subtle" name="nome" id="nome" required>
              <div class="invalid-feedback">Nome válido é obrigatório.</div>
            </div>
            <div>
              <input type="hidden" name="data_criacao" value="<?php echo date('d-m-Y'); ?>">
            </div>
            <div class="col-sm-6">
              <label for="lastName" class="form-label">Idade</label>
              <input type="number" class="form-control bg-dark-subtle" name="idade" id="idade" required>
              <div class="invalid-feedback">Idade válido é obrigatório.</div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Altura</label>
                <input type="text" class="form-control bg-dark-subtle" name="altura" id="altura" required>
                <div class="invalid-feedback">Por favor.</div>
              </div>
  

            <div class="col-12">
              <label for="email" class="form-label">Telefone</label>
              <input type="number" class="form-control bg-dark-subtle" name="telefone" id="telefone" required>
              <div class="invalid-feedback">Por favor, insira um Telefone válido.</div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Cidade</label>
              <input type="text" class="form-control bg-dark-subtle" name="cidade" id="cidade" required>
              <div class="invalid-feedback">Por favor, insira seu endereço.</div>
            </div>

            <div class="col-md-5">
              <label for="secao" class="form-label">Plano</label>
              <select class="form-select bg-dark-subtle" name="secao" id="secao" required>
                <option value="">Escolha...</option>
                <option value="espGatas">Espaço das Gatas</option>
                <option value="gatasAlta">Gatas em Alta</option>
                <option value="maisProc">As Mais Procuradas</option>
              </select>
              <div class="invalid-feedback">Por favor, selecione um plano válido.</div>
            </div>

            <div class="col-md-5">
                <label for="country" class="form-label">Duração</label>
                <select class="form-select bg-dark-subtle" name="tempo" id="tempo" required>
                  <option value="">Escolha...</option>
                  <option>15 dias</option>
                  <option>30 dias</option>
                </select>
                <div class="invalid-feedback">Por favor, selecione.</div>
              </div>
              <label for="country" class="form-label">Descrição do anúncio</label>
              <textarea name="msg" id="msg" class="form-control bg-dark-subtle" placeholder="Insira aqui" cols="30" rows="5" required></textarea>
          </div><br>
          <div class="col-md-12">
            <label for="images" class="form-label">Envie suas fotos</label>
            <input type="file" class="form-control bg-dark-subtle" id="images" name="images[]" accept="image/*" multiple required>
            <div class="invalid-feedback">Por favor, envie pelo menos uma imagem.</div>
            <p id="fileSizeError" style="color: red; display: none;">O tamanho total dos arquivos não pode exceder 50MB.</p>
        </div><br>
          <hr class="my-4">
          <button class="w-100 btn btn-warning btn-lg" type="submit">Finalizar anúncio</button>
        </form>
      </div>
    </div>
  </main>

  <div class="container">
    <div class="text-center"><br>
    <img src="./img/logo.png" alt="Logotipo" width="180" height="180" class="rounded-5 me-2">
    </div>
    <footer class="py-0 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li><a href="#" class="nav-link px-2 text-light">Início</a></li>
                    <li><a href="planos.html" class="nav-link px-2 text-light">Planos</a></li>
                    <li><a href="duvidas.html" class="nav-link px-2 text-light">Dúvidas</a></li>
                    <li><a href="sobre.html" class="nav-link px-2 text-light">Sobre</a></li>
        </ul>
        <p class="text-center text-secondary">&copy; Os anúncios em nosso site são de responsabilidade exclusiva do Anunciante e publicados sem verificação prévia por nossa equipe. Não nos responsabilizamos pela veracidade, legalidade, direitos de propriedade ou perturbações causadas pelo conteúdo inserido pelo usuário.</p>
    </footer>
    
</div>
</div>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })();

  // Verificação do tamanho total das imagens
  document.getElementById('images').addEventListener('change', function() {
        const files = this.files;
        let totalSize = 0;
        for (let i = 0; i < files.length; i++) {
            totalSize += files[i].size;
        }
        
        const maxSize = 50 * 1024 * 1024; // 50MB em bytes
        const errorElement = document.getElementById('fileSizeError');
        
        if (totalSize > maxSize) {
            errorElement.style.display = 'block';
            this.value = ''; // Limpa o campo de arquivos
        } else {
            errorElement.style.display = 'none';
        }
    });
</script>

</body>
</html>
