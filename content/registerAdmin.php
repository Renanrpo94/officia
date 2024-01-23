<?php
session_start();
if (isset($_SESSION['admin'])) {
    $userName = ucfirst($_SESSION['admin']->nome);
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
    <link rel="stylesheet" href="../assets/css/user-style.css">
    <link rel="stylesheet" href="../assets/css/register-style.css">
    <link rel="stylesheet" href="../assets/css/light-theme-style.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">
                <a href="painelAdmin.php">
                    <img class="logotipo" id="logo-dark-mode" src="../assets/svg/officia_logotipo.svg"
                        alt="Logotipo Officia">
                    <img class="logotipo" id="logo-light-mode" src="../assets/svg/officia_logotipo_light.svg"
                        alt="Logotipo Officia">
                </a>
            </div>
            <form action="" class="search-wrapper">
                <input type="text" placeholder="Faça sua pesquisa">
                <button><i class='bx bx-search'></i></button>
            </form>
            <div class="menu">
            <nav class="nav-bar">
                    <a class="main-button-style" id="menu-button">Olá, <?php echo $userName; ?></a>
                    <div class="user-menu">
                        <ul>
                            <li><a href="#">Perfil</a></li>
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
        <main>
            <section class="register-section">
                <div class="alert-wrapper">
                    <div></div>
                </div>
                <form id="form-register">
                    <div class="user-info">
                        <div class="input-group">
                            <div class="input-box">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" placeholder="Digite seu nome"
                                    autocomplete="off">
                            </div>
                            <div class="input-box">
                                <label for="sobrenome">Sobrenome</label>
                                <input type="text" name="sobrenome" id="sobrenome" placeholder="Digite seu sobrenome"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-box">
                                <label for="cpf">CPF</label>
                                <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF" autocomplete="off">
                            </div>
                            <div class="input-box">
                                <label for="nasc">Data de Nascimento</label>
                                <input type="date" name="nasc" id="nasc" placeholder="Data de Nascimento"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-box">
                                <label for="cel">Celular</label>
                                <input type="text" name="cel" id="cel" placeholder="Digite seu celular"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="login-info">
                        <div class="input-group">
                            <div class="input-box">
                                <label for="email"><i class='bx bxs-envelope'></i> E-mail</label>
                                <input type="text" name="email" id="email" placeholder="Digite seu e-mail"
                                    autocomplete="off">
                            </div>
                            <div class="input-box">
                                <label for="confirm-email"><i class='bx bxs-envelope'></i> Confirme seu e-mail</label>
                                <input type="text" name="confirm-email" id="confirm-email"
                                    placeholder="Confirme seu e-mail" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-box">
                                <label for="senha"><i class='bx bxs-lock'></i> Senha</label>
                                <input type="password" name="senha" id="senha" placeholder="Digite sua senha"
                                    autocomplete="off">
                            </div>
                            <div class="input-box">
                                <label for="confirm-senha"><i class='bx bxs-lock'></i> Confirme sua senha</label>
                                <input type="password" name="confirm-senha" id="confirm-senha"
                                    placeholder="Confirme sua senha" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="button-box">
                        <div class="terms">
                            <input type="checkbox" name="terms" id="terms">
                            <label for="terms">
                                Li e estou de acordo com o <a href="terms.html">Termos de uso e Política de Privacidade</a>
                            </label>
                        </div>
                        <button type="submit" id="register">Realizar Cadastro</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
    <footer>&copy 2023 Todos direitos reservados.<div><a href="../content/cronograma.html">Cronôgrama</a></div>
    </footer>
</body>
<script src="../assets/js/user-menu.js"></script>
<script src="../assets/js/light-mode.js"></script>
<script src="../assets/js/jquery/registerAdmin.js"></script>

</html>