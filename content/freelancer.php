<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    $userName = ucfirst($_SESSION['user']->nome);
    $userId = $_SESSION['user']->userId;
    if (isset($_SESSION['freelancer'])) {
        header('Location: home.php');
    }
} else {
    header('Location: home.php');
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
    <link rel="stylesheet" href="../assets/css/terms-style.css">
    <link rel="stylesheet" href="../assets/css/user-style.css">
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
                    <?php if(isset($_SESSION['freelancer'])) echo $myJobsMobile?>
                    <div class="mobile-option"><a href="#">Favoritos</a></div>
                    <div class="mobile-option"><a href="#">Mensagens</a></div>
                    <div class="mobile-option"><a href="#">Configurações</a></div>
                    <div class="mobile-option"><a id="logout">Sair</a></div>
                    <div class="mobile-option">
                        <div class="light-mode-button">
                            <i class='bx bxs-sun'></i>
                        </div>
                    </div>
                </div>
            </div>
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
                            <li><a href="profile?id=<?php echo $userId; ?>">Perfil</a></li>
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
            <div class="alert-wrapper">
                <div>asdasd</div>
            </div>
            <form id="terms" class="terms">
                <div class="item-1">
                    <h2>Política de Privacidade</h2>
                    <p>
                        A Equipe Officia valoriza a privacidade de nossos usuários e está empenhada em proteger suas informações
                        pessoais. Esta Política de Privacidade descreve como coletamos, usamos e protegemos as informações que você
                        nos
                        fornece ao utilizar nossos serviços.
                    </p>
                </div>
                <div class="item-2">
                    <h2>Coleta de Informações</h2>
                    <p>
                        Podemos coletar informações pessoais, como nome, endereço de e-mail e número de telefone, quando você se
                        registra em nosso site ou utiliza nossos serviços. Além disso, podemos coletar informações não pessoais,
                        como
                        dados demográficos e preferências, para melhorar sua experiência com nossos serviços.
                    </p>
                </div>
                <div class="item-3">
                    <h2>Uso de Informações</h2>
                    <p>
                        Utilizamos as informações coletadas para personalizar e melhorar nossos serviços, fornecer suporte técnico,
                        enviar comunicações importantes sobre o site e seus recursos, além de enviar informações promocionais, como
                        atualizações e ofertas especiais. Não compartilhamos suas informações pessoais com terceiros, exceto quando
                        necessário para fornecer os serviços solicitados por você.
                    </p>
                </div>
                <div class="item-4">
                    <h2>Proteção de Informações</h2>
                    <p>
                        Implementamos medidas de segurança para proteger suas informações pessoais contra acesso não autorizado, uso
                        indevido ou divulgação. No entanto, nenhuma transmissão de dados pela Internet ou sistema de armazenamento
                        eletrônico é totalmente seguro. Portanto, não podemos garantir a segurança completa de suas informações.
                    </p>
                </div>
                <div class="item-5">
                    <h2>Cookies</h2>
                    <p>
                        Utilizamos cookies para melhorar a sua experiência no site. Os cookies são pequenos arquivos de texto
                        armazenados no seu dispositivo que nos permitem reconhecê-lo quando você retorna ao site. Você pode optar
                        por
                        desativar os cookies nas configurações do seu navegador, mas isso pode afetar a funcionalidade do site.
                    </p>
                </div>
                <div class="item-6">
                    <h2>Alterações na Política de Privacidade</h2>
                    <p>
                        Podemos atualizar esta Política de Privacidade periodicamente. Recomendamos que você reveja esta página
                        regularmente para estar ciente de quaisquer alterações. Ao continuar a utilizar nossos serviços após as
                        alterações entrarem em vigor, você está concordando com a nova Política de Privacidade.
                    </p>
                </div>
                <div class="item-7">
                    <h2>Entre em Contato</h2>
                    <p>
                        Se você tiver alguma dúvida ou preocupação sobre nossa Política de Privacidade, entre em contato conosco
                        através
                        dos canais de suporte fornecidos em nosso site. Estamos comprometidos em resolver qualquer problema
                        relacionado
                        à privacidade de forma rápida e justa.
                    </p><br>
                    <p>
                        Ao utilizar nossos serviços, você concorda com os termos desta Política de Privacidade. A Equipe Officia se
                        reserva o direito de alterar esta política a qualquer momento, conforme necessário, para cumprir com as leis
                        e
                        regulamentos aplicáveis.
                    </p>
                </div>
                <div class="terms-box">
                    <div>
                        <input type="checkbox" name="terms" id="check-terms">
                        <label for="check-terms">
                            Li e estou de acordo com o Termos de uso e Política de Privacidade
                        </label>
                    </div>
                    <button type="submit" class="main-button-style" id="register">Realizar Cadastro</button>
                </div>
            </form>
        </main>
        <footer>&copy 2023 Todos direitos reservados. <div><a href="content/cronograma.html">Cronôgrama</a></div>
        </footer>
    </div>
</body>
<script src="../assets/js/light-mode.js"></script>
<script src="../assets/js/user-menu.js"></script>
<script src="../assets/js/jquery/freelancer.js"></script>

</html>