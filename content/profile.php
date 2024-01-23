<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['senha']) && isset($_SESSION['freelancer'])) {
    $userName = ucfirst($_SESSION['user']->nome);
    $userId = $_SESSION['user']->userId;
    $jobs = '<a href="trabalhos.php" class="jobs">Seus trabalhos</a>';
} else if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    header('Location: home.php');
} else {
    header('Location: ../index.php');
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
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>

<body>
    <div class="container">
        <header>
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
                    <a class="main-button-style" id="menu-button">Olá,
                        <?php echo $userName; ?>
                    </a>
                    <div class="user-menu">
                        <ul>
                            <li><a href="profile.php?id=<?php echo $userId; ?>">Perfil</a></li>
                            <li><a href="#">Meus pedidos</a></li>
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
            <section class="user-info">
                <div class="user-info-img">
                    
                </div>
                <div class="user-info-name">Nome Sobrenome</div>
                <div class="user-info-rating">rating</div>
            </section>
            <section class="free">
                <div class="free-info">
                    <div class="free-info-status">user freelancer</div>
                    <div class="free-info-contact">
                        <span class="free-info-contact-email"><i class='bx bx-envelope'></i></span>
                        <span class="free-info-contact-cel"><i class='bx bx-phone'></i></span>
                    </div>
                </div>
                <a class="free-jobs">

                </a>
            </section>
            <div class="alert-wrapper">
                <div></div>
            </div>
        </main>
    </div>
</body>
<script src="../assets/js/light-mode.js"></script>
<script src="../assets/js/user-menu.js"></script>
<script src="../assets/js/jquery/profile.js"></script>

</html>