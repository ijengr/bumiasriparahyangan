<?php
$u = 'root';
$p = '';
$host = '127.0.0.1';
$port = 3306;
try {
    $pdo = new PDO("mysql:host={$host};port={$port}", $u, $p, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec('CREATE DATABASE IF NOT EXISTS `bumiasri` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    echo "OK DB created\n";
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
    exit(1);
}
