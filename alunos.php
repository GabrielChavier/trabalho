<?php
session_start();
if(!isset($_SESSION['usuario'])){ header("Location: login.php"); exit; }
include 'conexao.php';

$filtro = "";
if(isset($_GET['busca'])){
    $busca = "%".$_GET['busca']."%";
    $sql = $pdo->prepare("SELECT * FROM alunos WHERE nome LIKE ? OR curso LIKE ?");
    $sql->execute([$busca, $busca]);
} else {
    $sql = $pdo->query("SELECT * FROM alunos");
}
$alunos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<form method="GET">
    <input type="text" name="busca" placeholder="Buscar por nome ou curso">
    <button type="submit">Buscar</button>
</form>

<table border="1">
    <tr><th>Nome</th><th>Email</th><th>Curso</th><th>Ações</th></tr>
    <?php foreach($alunos as $aluno): ?>
        <tr>
            <td><?= $aluno['nome'] ?></td>
            <td><?= $aluno['email'] ?></td>
            <td><?= $aluno['curso'] ?></td>
            <td>
                <a href="editar.php?id=<?= $aluno['id'] ?>">Editar</a> | 
                <a href="excluir.php?id=<?= $aluno['id'] ?>" onclick="return confirm('Excluir aluno?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="logout.php">Sair</a>
<link rel="stylesheet" href="css/estilo.css">
