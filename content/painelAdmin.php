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
    <link rel="stylesheet" href="../assets/css/user-style.css">
    <link rel="stylesheet" href="../assets/css/light-theme-style.css">
    <link rel="stylesheet" href="../assets/css/painel-admin-style.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">
                <a href="painelAdmin.php">
                    <img class="logotipo" id="logo-dark-mode" src="../assets/svg/officia_logotipo.svg" alt="Logotipo Officia">
                    <img class="logotipo" id="logo-light-mode" src="../assets/svg/officia_logotipo_light.svg" alt="Logotipo Officia">
                </a>
            </div>
            <div class="admin-nav">
                <ul class="admin-nav-buttons">
                    Admin
                    <ul class="admin-nav-drop">
                        <li id="-rel">Relatórios</li>
                        <li id="admin-list">Lista</li>
                        <li id="admin-register"><a href="registerAdmin.php">Cadastrar</a></li>
                    </ul>
                </ul>
                <ul class="admin-nav-buttons">
                    Clientes
                    <ul class="admin-nav-drop">
                        <li id="user-rel">Relatórios</li>
                        <li id="user-list">Lista</li>
                    </ul>
                </ul>
                <ul class="admin-nav-buttons">
                    Trabalhos
                    <ul class="admin-nav-drop">
                        <li id="-rel">Relatórios</li>
                        <li id="jobs-list">Lista</li>
                    </ul>
                </ul>
                <ul class="admin-nav-buttons">
                    Pedidos
                    <ul class="admin-nav-drop">
                        <li id="-rel">Relatórios</li>
                        <li id="pedidos-list">Lista</li>
                    </ul>
                </ul>
                <ul class="admin-nav-buttons">
                    Ocorrências
                    <ul class="admin-nav-drop">
                        <li id="-rel">Relatórios</li>
                        <li id="-list">Lista</li>
                    </ul>
                </ul>
            </div>
            <div class="menu">
                <nav class="nav-bar">
                    <a class="main-button-style" id="menu-button">Olá, <?php echo $userName; ?></a>
                    <div class="user-menu">
                        <ul>
                            <li><a href="#">Perfil</a></li>
                            <li><a href="pedidos.php">Meus pedidos</a></li>
                            <?php if (isset($_SESSION['freelancer'])) echo $myJobs ?>
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
            <div class="alert-wrapper">
                <div></div>
            </div>
            <section class="admin-list">
                <div class="title">
                    <h2>Lista de Admins</h2>
                </div>
                <table>
                    <thead>
                        <th>Admin Id</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Nasc</th>
                        <th>CPF</th>
                        <th>Cel</th>
                        <th>Email</th>
                        <th>?</th>
                    </thead>
                    <tbody id="admin-list-item">
                    </tbody>
                </table>
            </section>
            <section class="user-list">
                <div class="title">
                    <h2>Lista de Clientes</h2>
                    <button id="show-disable" class="main-button-style">Desabilitados</button>
                    <button id="show-active" class="main-button-style" style="display: none;">Habilitados</button>
                </div>

                <table>
                    <thead>
                        <th>User Id</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Nasc</th>
                        <th>CPF</th>
                        <th>Cel</th>
                        <th>Email</th>
                        <th>FreelancerId</th>
                        <th>Desabilitado</th>
                        <th>?</th>
                    </thead>
                    <tbody id="user-list-item">
                    </tbody>
                </table>
            </section>
            <section class="jobs-list">
                <div class="title">
                    <h2>Lista de Trabalhos</h2>
                </div>
                <table>
                    <thead>
                        <th>Job Id</th>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Freelancer Id</th>
                        <th>Autor</th>
                        <th>?</th>
                    </thead>
                    <tbody id="jobs-list-item">

                    </tbody>
                </table>
            </section>
            <section class="pedidos-list">
                <div class="title">
                    <h2>Lista de pedidos</h2>
                </div>
                <table>
                    <thead>
                        <th>Pedido Id</th>
                        <th>User Id</th>
                        <th>Freelancer Id</th>
                        <th>Job Id</th>
                        <th>Status</th>
                        <th>Data Criação</th>
                        <th>Data Atualização</th>
                        <th>?</th>
                    </thead>
                    <tbody id="pedidos-list-item">

                    </tbody>
                </table>
            </section>
        </main>
        <div class="edit-wrapper">
            <form class="form-edit">
                <span class="close-edit-wrapper">
                    <i class='bx bx-x'></i>
                </span>
                <div class="user-info">
                    <div class="input-group">
                        <div class="input-box">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="nome" placeholder="Digite seu nome" autocomplete="off">
                        </div>
                        <div class="input-box">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" name="sobrenome" id="sobrenome" placeholder="Digite seu sobrenome" autocomplete="off">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-box">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF" autocomplete="off">
                        </div>
                        <div class="input-box">
                            <label for="nasc">Data de Nascimento</label>
                            <input type="date" name="nasc" id="nasc" placeholder="Data de Nascimento" autocomplete="off">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-box">
                            <label for="cel">Celular</label>
                            <input type="text" name="cel" id="cel" placeholder="Digite seu celular" autocomplete="off">
                        </div>
                        <div class="input-box">
                            <label for="email"><i class='bx bxs-envelope'></i> E-mail</label>
                            <input type="text" name="email" id="email" placeholder="Digite seu e-mail" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="button-box">
                    <button type="submit" id="register">Realizar Cadastro</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="../assets/js/light-mode.js"></script>
<script src="../assets/js/user-menu.js"></script>
<script src="../assets/js/jquery/painelAdmin.js"></script>

</html>