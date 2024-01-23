<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['senha']) && isset($_SESSION['freelancer'])) {
    $userName = ucfirst($_SESSION['user']->nome);
    $userId = $_SESSION['user']->userId;
} else if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    header('Location: home.php');
} else {
    header('Location: ../index.php');
}

if (isset($_SESSION['freelancer'])) {
    $myJobs = '<li><a href="requisicoes.php">Requisições</a></li>';
    $myJobsMobile = '<div class="mobile-option"><a href="requisicoes.php">Requisições</a></div>';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFFICIA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="../assets/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/light-theme-style.css">
    <link rel="stylesheet" href="../assets/css/user-style.css">
    <link rel="stylesheet" href="../assets/css/jobs-style.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="logo"><a href="../index.php">
                    <img class="logotipo" id="logo-dark-mode" src="../assets/svg/officia_logotipo.svg" alt="Logotipo Officia">
                    <img class="logotipo" id="logo-light-mode" src="../assets/svg/officia_logotipo_light.svg" alt="Logotipo Officia">
                </a></div>
            <form action="" class="search-wrapper">
                <input type="text" placeholder="Faça sua pesquisa">
                <button><i class='bx bx-search'></i></button>
            </form>
            <div class="menu">
                <nav class="nav-bar">
                    <a class="main-button-style" id="menu-button">Olá, <?php echo $userName; ?></a>
                    <div class="user-menu">
                        <ul>
                            <li><a href="profile.php?id=<?php echo $userId; ?>">Perfil</a></li>
                            <li><a href="pedidos.php">Meus pedidos</a></li>
                            <?php if(isset($_SESSION['freelancer'])) echo $myJobs?>
                            <li><a href="#">Favoritos</a></li>
                            <li><a href="#">Mensagens</a></li>
                            <li><a href="#">Configurações</a></li>
                            <li><a id="logout">Sair</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="light-mode-button">
                    <i class='bx bxs-sun'></i>
                </div>
            </div>
        </header>
        <main class="jobs">
            <div class="alert-wrapper">
                <div></div>
            </div>
            <section class="jobs-section">
            </section>
        </main>
    </div>
    <div class="edit-wrapper">
        <form class="edit-box">
            <span class="close-login-wrapper">
                <i class='bx bx-x'></i>
            </span>
            <div class="input-group title">
                <div class="input-box">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Digite o título" autocomplete="off">
                </div>
                <div class="input-box">
                    <label for="preco">Preço</label>
                    <input type="text" name="preco" id="preco" placeholder="Digite o preço" autocomplete="off">
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" id="categoria">

                    </select>
                </div>
                <div class="input-box">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" cols="30" rows="10" placeholder="Escreva uma breve descrição sobre o seu trabalho"></textarea>
                </div>
            </div>
            <div class="button-box">
                <button type="submit" id="register">Editar Anuncio</button>
            </div>
        </form>
    </div>
</body>
<script src="../assets/js/light-mode.js"></script>
<script src="../assets/js/user-menu.js"></script>
<script src="../assets/js/jquery/trabalhos.js"></script>

</html>