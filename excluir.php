<?php
include 'conexao.php';
$id = $_GET['id'];

$sql = $pdo->prepare("DELETE FROM alunos WHERE id=?");
$sql->execute([$id]);

header("Location: alunos.php");
?>
<link rel="stylesheet" href="css/estilo.css">
