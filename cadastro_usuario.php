<?php
include 'conexao.php';

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $sql->execute([$nome, $email, $senha]);

    echo "Usuário cadastrado com sucesso!";
}
?>
<form method="POST" >
    Nome: <input type="text" name="nome" ><br>
    Email: <input type="email" name="email" ><br>
    Senha: <input type="password" name="senha" ><br>
    <button type="submit" name="cadastrar">Cadastrar</button>
</form>
<link rel="stylesheet" href="css/estilo.css">
