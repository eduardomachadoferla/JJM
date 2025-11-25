<?php
require_once __DIR__ . '/config.php';

// Verifica se o usuário está logado e é admin
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit;
}

// Verifica se o id do comentário foi enviado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$commentId = (int) $_GET['id'];
$newsId = isset($_GET['news_id']) && is_numeric($_GET['news_id']) ? (int) $_GET['news_id'] : null;

try {
    // Confirma que o comentário existe (opcional, para segurança)
    $stmt = $pdo->prepare("SELECT id FROM comments WHERE id = ?");
    $stmt->execute([$commentId]);
    $c = $stmt->fetch();

    if (!$c) {
        // comentário não encontrado
        if ($newsId) {
            header("Location: noticia.php?id=" . $newsId);
        } else {
            header("Location: index.php");
        }
        exit;
    }

    // Deleta o comentário
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->execute([$commentId]);

    // Redireciona de volta para a notícia (se soubermos o news_id)
    if ($newsId) {
        header("Location: noticia.php?id=" . $newsId . "&msg=comment_deleted");
    } else {
        header("Location: index.php");
    }
    exit;
} catch (Exception $e) {
    // Em caso de erro, redireciona com erro simples (você pode logar a exceção)
    if ($newsId) {
        header("Location: noticia.php?id=" . $newsId . "&error=delete_failed");
    } else {
        header("Location: index.php?error=delete_failed");
    }
    exit;
}
?>
