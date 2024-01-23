<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    header('Location: content/home.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate maxime cum, ea perspiciatis modi rerum corporis sit soluta magnam eos quas ducimus est a, eligendi, commodi ex provident. Rerum, harum.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFFICIA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="assets/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/light-theme-style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login-style.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="mobile-menu-button">
                <i class='bx bx-menu'></i>
            </div>    
            <div class="mobile-menu-box" style="display: none">
                <div class="mobile-menu">
                    <div class="mobile-option"><a href="#" class="jobs" id="mobile-login">Login</a></div>
                    <div class="mobile-option"><a href="content/register.html">Cadastre-se</a></div>
                    <div class="mobile-option">
                        <div class="light-mode-button">
                            <i class='bx bxs-sun'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo">
                <a href="index.php">
                    <img class="logotipo" id="logo-dark-mode" src="assets/svg/officia_logotipo.svg" alt="Logotipo Officia">
                    <img class="logotipo" id="logo-light-mode" src="assets/svg/officia_logotipo_light.svg" alt="Logotipo Officia">
                </a>
            </div>
            <div class="mobile-search">
                <i class='bx bx-search'></i>
            </div>
            <form action="" class="search-wrapper">
                <input type="text" placeholder="Faça sua pesquisa">
                <button><i class='bx bx-search'></i></button>
            </form>
            <div class="menu">
                <nav class="nav-bar">
                    <a href="#" class="jobs" id="login">Login</a>
                    <a href="content/register.html" class="main-button-style">Cadastre-se</a>
                </nav>
                <div class="light-mode-button">
                    <i class='bx bxs-sun'></i>
                </div>
            </div>
        </header>
        <div class="banner">
            <div class="banner-text">
                <h2 class="banner-text-h2">Bem-vindo ao
                    <span>OFFICIA</span>
                </h2>
                <p class="banner-text-p">
                    Seja bem vindo ao Officia, o melhor site para achar e anunciar seu serviço freelancer. Aqui voce
                    terá uma plataforma especializada em atender as necessidades e facilitar o trabalho de todos
                    envolvidos nesse serviço.
                </p>
                <div class="banner-img">
                    <img src="assets/img/index/welcome.jpg" alt="Picsum">
                </div>
                <a href="content/register.html" class="main-button-style">Cadastre-se</a>
            </div>
        </div>
        <main>
            <div class="h-scroll-wrapper">
                <h2>Temos o que você procura!</h2>
                <div class="h-scroll">
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Eletricista.png" alt="Eletricista">
                        <h3>Elétrica</h3>
                    </div>
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Construcao.png" alt="Construcão">
                        <h3>Construção civil</h3>
                    </div>
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Professor.png" alt="Professor">
                        <h3>Professor Particular</h3>
                    </div>
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Faxina.png" alt="Faxina">
                        <h3>Faxina</h3>
                    </div>
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Pintor.png" alt="Pintor">
                        <h3>Pintor</h3>
                    </div>
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Ilustrador.png" alt="Ilustrador">
                        <h3>Ilustrador</h3>
                    </div>
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Desenvolvedor.png" alt="Desenvolvedor">
                        <h3>Desenvolvimento</h3>
                    </div>
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Jardineiro.png" alt="Jardineiro">
                        <h3>Jardinagem</h3>
                    </div>
                    <div class="h-scroll-item">
                        <img src="assets/img/index/Designer.png" alt="Designer">
                        <h3>Design</h3>
                    </div>
                </div>
            </div>
            <section class="section-content">
                <div class="section-content-img">

                    <img src="assets/img/about.jpg" style="width:600px; height:375px;" alt="Picsum">
                </div>
                <div class="section-content-text">
                    <h2><span>Conheça nossa plataforma</span></h2>
                    <p>A officia tem o objetivo de intermediar o trabalhador freelancer e quem está precisando de um
                        trabalhador confiiavel e competentem, para realizar os mais diversos tipos de serviços. Em nossa
                        plataforma você vai encontrar:</p>
                    <ul>
                        <li><span>Pagamento 100% seguro</span></li>
                        <li><span>Sistema de avaliação de outros usuarios</span></li>
                        <li><span>Sistema e layout facil e rapido de ser utilizado</span></li>
                    </ul>
                    <a href="content/Sobre.html" class="main-button-style">Mostrar mais</a>
                </div>
            </section>
            <section class="section-content">
                <div class="section-content-img">
                    <video src="assets/img/freelancer.mp4" poster="assets/img/cover.png" controls style="width: 600px; height: 350px;"></video>
                </div>
                <div class="section-content-text">
                    <h2><span>O que é um</span> FREELANCER<span>?</span></h2>
                    <p>Você sabe o necessário para ser um freelancer? Se não, aprenda conosco! <br><br>
                        No OFFICIA te oferecemos a oportunidade de desenvolver suas habilidades como 
                        freelancer e te damos a chance de se tornar um de nossos colaboradores.</p>
                    <a class="main-button-style" href="content/register.html">To Dentro!</a>
                </div>
            </section>
            <section class="section-content">
                <div class="section-content-img">
                    <img src="assets/img/join.png" style="width:600px;" alt="Picsum">
                </div>
                <div class="section-content-text">
                    <h2><span>Gostou do </span>OFFICIA<span>?</span></h2>
                    <p>Nossa empresa valoriza a diversidade e a igualdade de oportunidades, criando um ambiente de trabalho flexível 
                        e inclusivo. Oferecemos ferramentas e recursos necessários para que freelancers possam se destacar em suas áreas 
                        de atuação. Nossa empresa está em constante crescimento e oferece muitas oportunidades para o desenvolvimento de 
                        carreira. Conosco você vai alcançar seus objetivos pessoais e chegar ao auge da sua carreira. Eai, o que falta para 
                        você vir trabalhar conosco? </p>
                    <a href="content/register.html" class="main-button-style">Quero vender!</a>
                </div>
            </section>
        </main>
    </div>
    <footer>&copy 2023 Todos direitos reservados. <div><a href="content/cronograma.html">Cronôgrama</a></div>
    </footer>

    <div class="login-wrapper" style="display: none;">
        <form class="login">
            <span class="close-login-wrapper">
                <i class='bx bx-x'></i>
            </span>
            <div class="social-login">
                <div class="social-login-google">
                    <img src="assets/svg/google-icon.svg" alt="Google Icon">
                    <span>Entrar com o Google</span>
                </div>
            </div>
            <div class="login-input-group">
                <div class="login-input-box">
                    <label for="email"><i class='bx bxs-envelope'></i> E-mail</label>
                    <input type="text" name="email" id="email-user" placeholder="Digite seu e-mail" autocomplete="off">
                </div>
                <div class="login-input-box">
                    <label for="senha"><i class='bx bxs-lock'></i> Senha</label>
                    <input type="password" name="senha" id="senha-user" placeholder="Digite sua senha" autocomplete="off">
                </div>
            </div>
            <div class="login-button-box">
                <button type="submit">Entrar</button>
            </div>
        </form>
    </div>

    <div class="alert-wrapper">
        <div></div>
    </div>
</body>
<script src="assets/js/login-wrapper.js"></script>
<script src="assets/js/light-mode.js"></script>
<script src="assets/js/jquery/login-ajax-index.js"></script>
<script src="assets/js/jquery/mobile-menu-button.js"></script>
</html>