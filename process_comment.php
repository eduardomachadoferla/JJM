<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $news_id = intval($_POST['news_id']);
    $comment = trim($_POST['comment']);

    if ($comment === "") {
        header("Location: noticia.php?id=" . $news_id . "&error=empty");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO comments (news_id, user_id, comment, created_at)
                           VALUES (:news_id, :user_id, :comment, NOW())");

    $stmt->execute([
        ':news_id' => $news_id,
        ':user_id' => $_SESSION['user_id'],
        ':comment' => htmlspecialchars($comment, ENT_QUOTES, 'UTF-8')
    ]);

    header("Location: noticia.php?id=" . $news_id);
    exit;
}
?>
