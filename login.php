<?php
include 'init.php';

$erro = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if(!$email || !$senha){
        $erro = 'Preencha email e senha.';
    } else {
        $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        if($usuario && password_verify($senha, $usuario['senha'])){
            session_regenerate_id(true);
            $_SESSION['usuario'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header("Location: alunos.php");
            exit;
        } else {
            $erro = 'Login inválido.';
        }
    }
}
?>
<div class="container mt-4 w-50">
    <h2>Login</h2>
    <?php if($erro): ?><div class="alert alert-danger"><?= e($erro) ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-2"><label>Email</label><input class="form-control" type="email" name="email"></div>
        <div class="mb-2"><label>Senha</label><input class="form-control" type="password" name="senha"></div>
        <button class="btn btn-primary" type="submit">Entrar</button>
    </form>
</div>
