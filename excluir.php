<?php
include 'init.php';
if(!isset($_SESSION['usuario'])){ header("Location: login.php"); exit; }

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: alunos.php");
    exit;
}

if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')){
    die('Requisição inválida.');
}

$id = intval($_POST['id'] ?? 0);
if($id <= 0) { header("Location: alunos.php"); exit; }

$stmt = $pdo->prepare("DELETE FROM alunos WHERE id = ?");
$stmt->execute([$id]);
header("Location: alunos.php?msg=" . urlencode("Aluno excluído."));
exit;
