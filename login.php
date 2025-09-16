<?php
session_start();
include 'conexao.php';

if(isset($_POST['entrar'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $sql->execute([$email]);
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if($usuario && password_verify($senha, $usuario['senha'])){
        $_SESSION['usuario'] = $usuario['id'];
        header("Location: alunos.php");
    } else {
        echo "Login invalido!";
    }
}
?>

<form method="POST" >
    Email: <input type="email" name="email" ><br>
    Senha: <input type="password" name="senha" ><br>
    <button type="submit" name="entrar">Entrar</button>
</form>
<link rel="stylesheet" href="css/estilo.css">
