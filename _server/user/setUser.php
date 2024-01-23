<?php
include_once "../pdo.php";
include_once "infoUser.php";
include_once "crudUser.php";

$InfoUser = new InfoUser();

$InfoUser->setNome(filter_input(INPUT_POST, 'nome'));
$InfoUser->setSobrenome(filter_input(INPUT_POST, 'sobrenome'));
$InfoUser->setCPF(filter_input(INPUT_POST, 'cpf'));
$InfoUser->setNasc(filter_input(INPUT_POST, 'nasc'));
$InfoUser->setCel(filter_input(INPUT_POST, 'cel'));
$InfoUser->setEmail(filter_input(INPUT_POST, 'email'));
if (isset($_POST['senha'])) {
    $InfoUser->setSenha(md5(filter_input(INPUT_POST, 'senha')));
}

$User = new User();

if (isset($_POST['createUser'])) {
    echo $User->createUser($InfoUser, $pdo);
} elseif (isset($_POST['loginUser'])) {
    echo $User->loginUser($InfoUser, $pdo);
} elseif (isset($_POST['logoutUser'])) {
    echo $User->logoutUser();
} elseif (isset($_POST['userFreelancer'])) {
    echo $User->userFreelancer($pdo);
} else if (isset($_POST['listarTodosAnuncios'])) {
    echo $User->listarTodosAnuncios($pdo);
} else if (isset($_POST['listarAnuncioCategoria'])) {
    $categoria = $_POST['categoria'];
    echo $User->listarAnuncioCategoria($categoria, $pdo);
} else if (isset($_POST['listUniqUser'])) {
    $userId = $_POST['userId'];
    echo $User->listUniqUser($userId, $pdo);
} else if (isset($_POST['activeUser'])) {
    echo $User->activeUser($InfoUser, $pdo);
} else if (isset($_POST['listUniqAnuncio'])) {
    $jobId = $_POST['jobId'];
    echo $User->listUniqAnuncio($jobId, $pdo);
} else if (isset($_POST['changeProfilePic'])) {
    $InfoUser->setFile($_FILES['uploadFile']);
    echo $User->changeProfilePic($InfoUser, $pdo);
}