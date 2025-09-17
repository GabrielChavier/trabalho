<?php
// init.php
session_start();
require_once 'conexao.php';

// gerar token CSRF se não existir
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// função helper para escapar saída
function e($str){ return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }

// incluir bootstrap (apenas link)
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/estilo.css">
