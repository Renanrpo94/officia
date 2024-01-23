<?php
include_once "../pdo.php";
include_once "infoAdmin.php";
include_once "crudAdmin.php";

$InfoAdmin = new InfoAdmin();

$InfoAdmin->setNome(filter_input(INPUT_POST, 'nome'));
$InfoAdmin->setSobrenome(filter_input(INPUT_POST, 'sobrenome'));
$InfoAdmin->setCPF(filter_input(INPUT_POST, 'cpf'));
$InfoAdmin->setNasc(filter_input(INPUT_POST, 'nasc'));
$InfoAdmin->setCel(filter_input(INPUT_POST, 'cel'));
$InfoAdmin->setEmail(filter_input(INPUT_POST, 'email'));

$Admin = new Admin();

if (isset($_POST['loginAdmin'])) {
    $InfoAdmin->setSenha(md5(filter_input(INPUT_POST, 'senha')));
    echo $Admin->loginAdmin($InfoAdmin, $pdo);
} 
else if (isset($_POST['createAdmin'])) {
    $InfoAdmin->setSenha(md5(filter_input(INPUT_POST, 'senha')));
    echo $Admin->createAdmin($InfoAdmin, $pdo);
} 
else if (isset($_POST['listAdmins'])) {
    echo $Admin->listAdmins($pdo);
} 
else if (isset($_POST['editAdmin'])) {
    $InfoAdmin->setId(filter_input(INPUT_POST, 'adminId'));
    echo $Admin->editAdmin($InfoAdmin, $pdo);
} 
else if (isset($_POST['deleteAdmin'])) {
    $InfoAdmin->setId(filter_input(INPUT_POST, 'adminId'));
    echo $Admin->deleteAdmin($InfoAdmin, $pdo);
} 
else if (isset($_POST['listUsers'])) {
    echo $Admin->listUsers($pdo);
} 
else if (isset($_POST['listUsersDisable'])) {
    echo $Admin->listUsersDisable($pdo);
} 
else if (isset($_POST['editUser'])) {
    $InfoAdmin->setId(filter_input(INPUT_POST, 'userId'));
    echo $Admin->editUser($InfoAdmin, $pdo);
} 
else if (isset($_POST['listarAnuncios'])) {
    echo $Admin->listarAnuncios($pdo);
} 
else if (isset($_POST['deleteUser'])) {
    $InfoAdmin->setId(filter_input(INPUT_POST, 'userId'));
    echo $Admin->deleteUser($InfoAdmin, $pdo);
} 
else if (isset($_POST['createAdmin'])) {
    echo $Admin->createAdmin($InfoAdmin, $pdo);
} 
