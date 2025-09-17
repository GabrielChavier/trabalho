<?php
include 'init.php';
if(!isset($_SESSION['usuario'])) { header("Location: login.php"); exit; }

$erro = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')){
        $erro = 'Requisição inválida.';
    } else {
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $curso = trim($_POST['curso'] ?? '');
        $senha_raw = $_POST['senha'] ?? '';

        if(!$nome || !$email || !$curso || !$senha_raw){
            $erro = 'Preencha todos os campos.';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erro = 'Email inválido.';
        } elseif(strlen($senha_raw) < 6){
            $erro = 'Senha precisa ter pelo menos 6 caracteres.';
        } else {
            $senha = password_hash($senha_raw, PASSWORD_DEFAULT);
            try {
                $sql = $pdo->prepare("INSERT INTO alunos (nome, email, curso, senha) VALUES (?, ?, ?, ?)");
                $sql->execute([$nome, $email, $curso, $senha]);
                header("Location: alunos.php?msg=" . urlencode("Aluno cadastrado com sucesso!"));
                exit;
            } catch (PDOException $ex) {
                // se email duplicado
                if(strpos($ex->getMessage(), 'Integrity constraint') !== false || strpos($ex->getMessage(), 'Duplicate') !== false){
                    $erro = 'Email já cadastrado.';
                } else {
                    $erro = 'Erro no cadastro.';
                }
            }
        }
    }
}
?>
<div class="container mt-4">
    <h2>Cadastro de Aluno</h2>
    <?php if($erro): ?><div class="alert alert-danger"><?= e($erro) ?></div><?php endif; ?>
    <form method="POST" class="w-50">
        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
        <div class="mb-2"><label>Nome</label><input class="form-control" type="text" name="nome"></div>
        <div class="mb-2"><label>Email</label><input class="form-control" type="email" name="email"></div>
        <div class="mb-2"><label>Curso</label><input class="form-control" type="text" name="curso"></div>
        <div class="mb-2"><label>Senha</label><input class="form-control" type="password" name="senha"></div>
        <button class="btn btn-primary" type="submit">Cadastrar</button>
        <a href="alunos.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
