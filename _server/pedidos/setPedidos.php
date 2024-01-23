<?php
include_once "../pdo.php";
include_once "infoPedidos.php";
include_once "crudPedidos.php";

$InfoPedidos = new InfoPedidos();

$InfoPedidos->setPedidoId(filter_input(INPUT_POST, 'pedidoId'));
$InfoPedidos->setUserId(filter_input(INPUT_POST, 'userId'));
$InfoPedidos->setFreelancerId(filter_input(INPUT_POST, 'freelancerId'));
$InfoPedidos->setJobId(filter_input(INPUT_POST, 'jobId'));

$Pedidos = new Pedidos();

if (isset($_POST['requisicao'])) {
    $InfoPedidos->setRequisicao(1);
    echo $Pedidos->requisicao($InfoPedidos, $pdo);
} else if (isset($_POST['verificarPedido'])) {
    echo $Pedidos->verificarPedido($pdo);
} else if (isset($_POST['pedidosUser'])) {
    echo $Pedidos->pedidosUser($pdo);
} else if (isset($_POST['pedidosFree'])) {
    echo $Pedidos->pedidosFree($InfoPedidos, $pdo);
} else if (isset($_POST['allPedidos'])) {
    echo $Pedidos->allPedidos($pdo);
} else if (isset($_POST['aceitarPedido'])) {
    $InfoPedidos->setAceitacao(1);
    echo $Pedidos->aceitarPedido($InfoPedidos, $pdo);
} else if (isset($_POST['pedidoConclusao'])) {
    $InfoPedidos->setPedidoConclusao(1);
    echo $Pedidos->pedidoConclusao($InfoPedidos, $pdo);
} else if (isset($_POST['concluirPedido'])) {
    $InfoPedidos->setConclusao(1);
    echo $Pedidos->concluirPedido($InfoPedidos, $pdo);
} else if (isset($_POST['novoPedido'])) {
    $InfoPedidos->setConcluido(1);
    echo $Pedidos->novoPedido($InfoPedidos, $pdo);
} else if (isset($_POST['listarAnunciosFree'])) {
    echo $Pedidos->listarAnunciosFree($InfoPedidos, $pdo);
} else if (isset($_POST['verifyProfile'])) {
    echo $Pedidos->verifyProfile($InfoPedidos);
}