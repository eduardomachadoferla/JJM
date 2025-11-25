<?php
require_once __DIR__ . '/config.php';

// Verifica login e permissão
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit;
}

// Verifica se recebeu o ID da notícia
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

// Verifica se a notícia existe
$stmt = $pdo->prepare("SELECT image FROM news WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$noticia) {
    header("Location: index.php");
    exit;
}

// Remove a imagem associada (se existir)
if (!empty($noticia['image']) && file_exists($noticia['image'])) {
    unlink($noticia['image']);
}

// Deleta a notícia do banco
$stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
$stmt->execute([$id]);

// Redireciona para a página inicial
header("Location: index.php");
exit;
?>
