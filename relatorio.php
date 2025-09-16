<?php
session_start();
if(!isset($_SESSION['usuario'])){ header("Location: login.php"); exit; }
include 'conexao.php';

$sql = $pdo->query("SELECT curso, COUNT(*) as total FROM alunos GROUP BY curso");
$cursos = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql2 = $pdo->query("SELECT COUNT(*) as total_alunos FROM alunos");
$total = $sql2->fetch(PDO::FETCH_ASSOC)['total_alunos'];
?>
<h2>Total de alunos: <?= $total ?></h2>
<table border="1">
    <tr><th>Curso</th><th>Total</th></tr>
    <?php foreach($cursos as $c): ?>
        <tr>
            <td><?= $c['curso'] ?></td>
            <td><?= $c['total'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="logout.php">Sair</a>
<link rel="stylesheet" href="css/estilo.css">
