<?php
require 'config.php'; 

// Captura os dados enviados pelo formulário
$nome = $_POST['nome'];
$msg = $_POST['msg'];
$cidade = $_POST['cidade'];
$idade = $_POST['idade'];
$secao = $_POST['secao'];
$telefone = $_POST['telefone'];
$data_criacao_post = $_POST['data_criacao'];
$data_criacao = new DateTime($data_criacao_post);
$duracao = $_POST['tempo'];

// Verifica se foram enviadas imagens
if (isset($_FILES['images'])) {
    $uploadedImages = [];

    // Cria uma pasta para salvar as imagens, se não existir
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Processa cada imagem enviada
    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;

        // Move a imagem para a pasta de destino
        if (move_uploaded_file($tmpName, $targetFilePath)) {
            $uploadedImages[] = $targetFilePath; // Adiciona o caminho da imagem ao array
        }
    }

    // Constrói $newCard e $perfilContent dinamicamente com as imagens carregadas e define a foto de perfil
    $carouselItems = '';
    $galleryItems = '';
    $mainImage = $uploadedImages[0];

    foreach ($uploadedImages as $index => $imagePath) {
        $isActive = $index === 0 ? 'active' : ''; // Apenas a primeira imagem é marcada como ativa
        $carouselItems .= "<div class='carousel-item $isActive'><img src='$imagePath' class='d-block w-100' alt='$nome' style='height:375px; object-fit: cover;'></div>";
        $galleryItems .= "<div class='col-md-4'><img src='$imagePath' alt='Foto " . ($index + 1) . "' class='img-fluid'></div>";
    }




// Determina a classe CSS com base na seção
switch ($secao) {
    case 'maisProc':
        $classPlano = "col-6 col-md-4 mb-4";
        $colorbg = "rgba(255, 215, 0, 0.5)";
        break;
    case 'gatasAlta':
        $classPlano = "col-6 col-md-3 mb-4";
        $colorbg = "rgba(255, 0, 106, 0.5)";
        break;
    case 'espGatas':
        $classPlano = "col-6 col-md-2 mb-4";
        $colorbg = "rgba(255, 255, 255, 0.5)";
        break;
    default:
        $classPlano = "col-6 col-md-4 mb-4";
        $colorbg = "rgba(255, 215, 0, 0.5)";
}
// Insere os dados no banco de dados
$sql = "INSERT INTO perfil (nome, msg, cidade, idade, secao) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$nome, $msg, $cidade, $idade, $secao])) {
    echo "Novo anúncio adicionado com sucesso";
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Erro: " . $errorInfo[2];
}

// Fechar a conexão
$pdo = null;

// ID único para o carousel e o link da página de perfil
$card_id = "card" . uniqid();
$carousel_id = "carousel" . uniqid();
$perfil_page = "perfil_" . uniqid() . ".html";

// Adiciona a nova div na seção apropriada de index2.html
$indexFile = 'index.html';
$indexContent = file_get_contents($indexFile);

$newCard = <<<HTML
    <!-- novo -->
                <div class="$classPlano" id="$card_id">
                    <div class="card position-relative">
                        <!-- Carrossel com transição automática (intervalo de 3 segundos) -->
                        <div id="$carousel_id" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner">
                                <a href="$perfil_page" class="text-decoration-none">
                                    $carouselItems
                                </a>
                            </div>
                            
                            <!-- Indicadores do carrossel dinâmicos -->
                            <ol class="carousel-indicators">
HTML;

// Adiciona os indicadores de forma dinâmica
foreach ($uploadedImages as $index => $imagePath) {
    $activeIndicator = $index === 0 ? 'active' : '';
    $newCard .= "<li data-bs-target='#$carousel_id' data-bs-slide-to='$index' class='$activeIndicator'></li>";
}

$newCard .= <<<HTML
                </ol>
                
                <!-- Controles de navegação -->
                <button class="carousel-control-prev" type="button" data-bs-target="#$carousel_id" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#$carousel_id" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                
                <!-- Barra superior com o nome do modelo -->
                <div class="rounded-5 position-absolute top-0 start-0 w-100 p-2 text-center" style="background-color: $colorbg;">
                    <h6 class="rounded bg-white text-dark" style="--bs-bg-opacity: .35; margin: -10px; padding: 0;" id="modeloNome">$nome</h6>
                </div>
                
                <!-- Barra inferior com as informações das badges -->
                <div class="position-absolute bottom-0 start-0 w-100 p-0 text-center" style="$colorbg;">
                    <span class="badge bg-light text-dark" style="--bs-bg-opacity: .8;">Camgirl</span>
                    <span class="badge bg-light text-dark" style="--bs-bg-opacity: .8;">Sexo virtual</span>
                </div>
            </div>
        </div>
    </div>
HTML;

// Localiza o ponto de inserção na seção específica

$indexFile = 'index.html';
$indexContent = file_get_contents($indexFile);
$indexContent = str_replace("id=\"$secao\">", "id=\"$secao\">$newCard", $indexContent);
file_put_contents($indexFile, $indexContent);


// Cria a nova página de perfil
$perfilContent = <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prazer Virtual - $nome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gallery img {
            width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        .carousel-item img {
            width: 100%;
            height: auto;
        }
        .row {
            display: flex;
            align-items: stretch; 
        }

        .main-photo {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 0px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }
    </style>
</head>
<body class="text-bg-dark">
    <div class="container mt-5">
        <header>
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <img src="./img/logo.png" alt="Logotipo" width="100" height="100" class="rounded-5 me-2">
                    </a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="index.html" class="nav-link px-2 text-light">Início</a></li>
                        <li><a href="planos.html" class="nav-link px-2 text-light">Planos</a></li>
                        <li><a href="duvidas.html" class="nav-link px-2 text-light">Dúvidas</a></li>
                        <li><a href="sobre.html" class="nav-link px-2 text-light">Sobre</a></li>
                    </ul>
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control form-control-dark text-bg-light" placeholder="Pesquise por característica" aria-label="Search">
                    </form>
                    <div class="text-end">
                        <a href="login.php" class="btn btn-outline-danger me-2">Login</a>
                        <a href="planos.html" class="btn btn-danger">Quero Anunciar</a>
                    </div>
                </div> 
            
            
            </div>
        </header><br><br>
        
        <div class="row">
            <div class="col-md-6">
                <div class="main-photo">
                    <img src="$mainImage" alt="$nome" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <h1>$nome</h1><br>
                <h6>Idade: $idade anos</h6>
                <h6>Cidade: $cidade</h6><br>
                <h5 class="text-light">$msg</h5><br>
                <button class="btn btn-warning" onclick="mostrarBotaoCopiar()">Ver Telefone</button>
                <a href='https://wa.me/$telefone?text=Olá {$nome}, te encontrei no Prazer Virtual' class='btn btn-success'>Ver Whatsapp</a>                <button class="btn btn-outline-danger" id="botaoCopiar" onclick="copiarParaClipboard('$telefone')" style="display: none;">$telefone</button>        
            </div>
        </div>
        <h2 class="mt-5">Galeria de Fotos</h2>
        <div class="gallery row">
            $galleryItems
        </div>
    </div>
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

    <script>
        function mostrarBotaoCopiar() {
            // Exibe o botão de copiar telefone
            document.getElementById('botaoCopiar').style.display = 'inline-block';
        }

        function copiarParaClipboard(texto) {
            // Cria um elemento de input temporário
            const inputTemporario = document.createElement("input");
            // Define o valor do input como o texto a ser copiado
            inputTemporario.value = texto;
            // Adiciona o input temporário ao corpo do documento
            document.body.appendChild(inputTemporario);
            // Seleciona o conteúdo do input
            inputTemporario.select();
            // Executa o comando de cópia
            document.execCommand("copy");
            // Remove o input temporário
            document.body.removeChild(inputTemporario);
    
            // Mensagem de confirmação
            alert("Número copiado para a área de transferência!");
        }

    </script>
</body>
</html>
HTML;

file_put_contents($perfil_page, $perfilContent);

$data_expiracao = clone $data_criacao; // Clona para preservar a data original
if ($duracao == '15 dias') {
    $data_expiracao->modify('+15 days');
} elseif ($duracao == '30 dias') {
    $data_expiracao->modify('+30 days');
}

$data_expiracao_formatada = $data_expiracao->format('d/m/Y');

$painel_id = "painel" . uniqid();
$novoAnuncioPainel = <<<HTML
<!-- novo -->
<div class="d-flex align-items-center p-3 border-bottom" id="$painel_id">
    <div class="flex-shrink-0 me-3">
        <img src="$mainImage" alt="$nome" width="40" height="40" class="rounded-circle">
    </div>
    <div class="flex-grow-1">
        <h6 class="mb-0">$nome</h6>
        <small class="text-muted">Criado em: {$data_criacao->format('d/m/Y')} | Plano: $secao </small><br>
        <small class="text-muted">Expira em: $data_expiracao_formatada</small><br>
        <small>ID do Card: $card_id</small><br>
        <small>ID da Página de Perfil: $perfil_page</small><br>
        </div>
        <form action="delete.php" method="post" style="display:inline;">
            <input type="hidden" name="card_id" value="{$card_id}">
            <input type="hidden" name="perfil_page"  value="{$perfil_page}">
            <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
        </form>
</div>
HTML;

// Insere o novo card no painel de anúncios
$painelFile = 'painel_anuncios.php';
$painelContent = file_get_contents($painelFile);
$painelContent = str_replace("id=\"anuncios\">", "id=\"anuncios\">$novoAnuncioPainel", $painelContent);
file_put_contents($painelFile, $painelContent);

// Redireciona para o painel após o processamento
header("Location: painel_anuncios.php");
exit();
} else {
    echo "Nenhuma imagem foi enviada.";
}
?>
