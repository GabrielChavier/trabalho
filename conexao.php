<?php

try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=escola;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   
    die("Erro ao conectar ao banco de dados.");
}
