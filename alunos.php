<?php
include 'init.php';
if(!isset($_SESSION['usuario'])){ header("Location: login.php"); exit; }

$busca = $_GET['busca'] ?? '';
if($busca !== ''){
    $like = "%$busca%";
    $sql = $pdo->prepare("SELECT * FROM alunos WHERE nome LIKE ? OR curso LIKE ? ORDER BY nome");
    $sql->execute([$like, $like]);
} else {
    $sql = $pdo->query("SELECT * FROM alunos ORDER BY nome");
}
$alunos = $sql->fetchAll();
$msg = $_GET['msg'] ?? '';
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Alunos</h2>
        <div>Bem vindo, <?= e($_SESSION['usuario_nome'] ?? '') ?> — <a href="logout.php">Sair</a></div>
    </div>

    <?php if($msg): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>

    <form class="mb-3" method="GET">
        <div class="input-group w-50">
            <input class="form-control" type="text" name="busca" value="<?= e($busca) ?>" placeholder="Buscar por nome ou curso">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            <a class="btn btn-primary" href="cadastro_aluno.php">Novo Aluno</a>
            <a class="btn btn-secondary" href="relatorio.php">Relatório</a>
        </div>
    </form>

    <table class="table table-striped">
        <thead><tr><th>Nome</th><th>Email</th><th>Curso</th><th>Ações</th></tr></thead>
        <tbody>
        <?php foreach($alunos as $aluno): ?>
            <tr>
                <td><?= e($aluno['nome']) ?></td>
                <td><?= e($aluno['email']) ?></td>
                <td><?= e($aluno['curso']) ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" href="editar.php?id=<?= e($aluno['id']) ?>">Editar</a>
                    <form style="display:inline" method="POST" action="excluir.php" onsubmit="return confirm('Excluir aluno?');">
                        <input type="hidden" name="id" value="<?= e($aluno['id']) ?>">
                        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
                        <button class="btn btn-sm btn-danger" type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
