<?php
include 'conexao.php';
$id = $_GET['id'];

if(isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];

    $sql = $pdo->prepare("UPDATE alunos SET nome=?, email=?, curso=? WHERE id=?");
    $sql->execute([$nome, $email, $curso, $id]);

    header("Location: alunos.php");
}

$sql = $pdo->prepare("SELECT * FROM alunos WHERE id=?");
$sql->execute([$id]);
$aluno = $sql->fetch(PDO::FETCH_ASSOC);
?>
<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $aluno['nome'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $aluno['email'] ?>"><br>
    Curso: <input type="text" name="curso" value="<?= $aluno['curso'] ?>"><br>
    <button type="submit" name="salvar">Salvar</button>
</form>
<link rel="stylesheet" href="css/estilo.css">
