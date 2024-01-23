<?php
include_once "../pdo.php";
include_once "infoFreelancer.php";
include_once "crudFreelancer.php";

$InfoFreelancer = new InfoFreelancer();

$InfoFreelancer->setTitulo(filter_input(INPUT_POST, 'titulo'));
$InfoFreelancer->setPreco(filter_input(INPUT_POST, 'preco'));
$InfoFreelancer->setCategoria(filter_input(INPUT_POST, 'categoria'));
$InfoFreelancer->setDescricao(filter_input(INPUT_POST, 'descricao'));

$Freelancer = new Freelancer();

if (isset($_POST['criarAnuncio'])) {
    $InfoFreelancer->setFile($_FILES['uploadFile']);
    echo $Freelancer->criarAnuncio($InfoFreelancer, $pdo);
} else if (isset($_POST['listarAnuncio'])) {
    echo $Freelancer->listarAnuncio($pdo);
} else if (isset($_POST['editarAnuncio'])) {
    $InfoFreelancer->setJobId(filter_input(INPUT_POST, 'jobId'));
    echo $Freelancer->editarAnuncio($InfoFreelancer, $pdo);
} else if (isset($_POST['apagarAnuncio'])) {
    $InfoFreelancer->setJobId(filter_input(INPUT_POST, 'jobId'));
    echo $Freelancer->apagarAnuncio($InfoFreelancer, $pdo);
} else if (isset($_POST['listarCategorias'])) {
    echo $Freelancer->listarCategorias($pdo);
}