<?php
include 'conexao.php';

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = $pdo->prepare("INSERT INTO alunos (nome, email, curso, senha) VALUES (?, ?, ?, ?)");
    $sql->execute([$nome, $email, $curso, $senha]);

    echo "Aluno cadastrado com sucesso!";
}
?>
<form method="POST">
    Nome: <input type="text" name="nome"><br>
    Email: <input type="email" name="email"><br>
    Curso: <input type="text" name="curso"><br>
    Senha: <input type="password" name="senha"><br>
    <button type="submit" name="cadastrar">Cadastrar</button>
</form>
<link rel="stylesheet" href="css/estilo.css">
