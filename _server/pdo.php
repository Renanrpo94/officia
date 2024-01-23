<?php 
	$db = 'officia';
	$user = 'root';
	$pass = '';

	try {
		$pdo = new PDO ("mysql:host=localhost;dbname=$db", $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('set names utf8');
	} catch (PDOException $e) {
		echo 'Erro na conexão:' . $e->getMessage();
	}