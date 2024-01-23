<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['senha']) && $_SESSION['user']->desabilitado == 0) {
    $userName = ucfirst($_SESSION['user']->nome);
    $userId = $_SESSION['user']->userId;
    if (isset($_SESSION['freelancer'])) {
        $jobs = '<a href="trabalhos.php" class="jobs">Seus trabalhos</a>';
        $myJobs = '<li><a href="requisicoes.php">Requisições</a></li>';
        $myJobsMobile = '<div class="mobile-option"><a href="requisicoes.php">Requisições</a></div>';
    } else {
        $jobs = '<a href="freelancer.php" class="jobs">Tornar-se freelancer</a>';
    }
} else {
    header('Location: ../');
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
    <link rel="stylesheet" href="../assets/css/light-theme-style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/user-style.css">
    <link rel="stylesheet" href="../assets/css/pedidos.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="mobile-menu-button">
                <i class='bx bx-menu'></i>
            </div>
            <div class="mobile-menu-box" style="display: none">
                <div class="mobile-menu">
                    <div class="mobile-option"><a href="profile?id=<?php echo $userId; ?>">Perfil</a></div>
                    <div class="mobile-option"><a href="#">Meus pedidos</a></div>
                    <div class="mobile-option"><a href="#">Favoritos</a></div>
                    <div class="mobile-option"><a href="#">Mensagens</a></div>
                    <div class="mobile-option"><a href="#">Configurações</a></div>
                    <div class="mobile-option"><a id="mobile-logout">Sair</a></div>
                    <div class="mobile-option">
                        <div class="light-mode-button">
                            <i class='bx bxs-sun'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo">
                <a href="../index.php">
                    <img class="logotipo" id="logo-dark-mode" src="../assets/svg/officia_logotipo.svg" alt="Logotipo Officia">
                    <img class="logotipo" id="logo-light-mode" src="../assets/svg/officia_logotipo_light.svg" alt="Logotipo Officia">
                </a>
            </div>
            <form action="" class="search-wrapper">
                <input type="text" placeholder="Faça sua pesquisa">
                <button><i class='bx bx-search'></i></button>
            </form>
            <div class="menu">
                <nav class="nav-bar">
                    <?php echo $jobs; ?>
                    <a class="main-button-style" id="menu-button">Olá, <?php echo $userName; ?></a>
                    <div class="user-menu">
                        <ul>
                            <li><a href="profile.php?id=<?php echo $userId; ?>">Perfil</a></li>
                            <li><a href="pedidos.php">Meus pedidos</a></li>
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
        <main>
            <section class="pedidos">

            </section>
        </main>
    </div>
    <div class="pedidos-list-wrapper">

    </div>
    <div id="userId" style="display: none;"><?php echo $userId; ?></div>
</body>
<script src="../assets/js/jquery/requisicoes.js"></script>
<script src="../assets/js/light-mode.js"></script>
<script src="../assets/js/user-menu.js"></script>
<script src="../assets/js/jquery/mobile-menu-button.js"></script>

</html>