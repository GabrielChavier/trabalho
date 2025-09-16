<?php
session_start();
session_unset();   // limpa todas as variáveis da sessão
session_destroy(); // destrói a sessão

header("Location: login.php"); // redireciona pro login
exit;
?>
<link rel="stylesheet" href="css/estilo.css">
