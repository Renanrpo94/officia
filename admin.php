<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('Location: content/painelAdmin.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFFICIA ADMIN</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/admin-style.css">
</head>

<body>
    <div class="container">
        <form class="login">
            <div class="input-box">
                <label for="email">Email</label>
                <input type="text" name="email" autocomplete="off" placeholder="Digite seu email">
            </div>
            <div class="input-box">
                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha">
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="alert-wrapper">
            <div></div>
        </div>
    </div>
</body>
<script src="assets/js/jquery/login-admin.js"></script>

</html>