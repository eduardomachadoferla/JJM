<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
        header("Location: login.php");
        exit;
    }

    $title = trim($_POST['title']);
    $summary = trim($_POST['summary']);
    $content = trim($_POST['content']);
    $category = $_POST['category'];
    $image = null;

    // Upload de imagem
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['image']['name']);
        $targetPath = $uploadDir . time() . '_' . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $targetPath;
        }
    }

    $stmt = $pdo->prepare("INSERT INTO news (title, summary, content, category, image, user_id, published_at)
                           VALUES (:title, :summary, :content, :category, :image, :user_id, NOW())");

    $stmt->execute([
        ':title' => $title,
        ':summary' => $summary,
        ':content' => $content,
        ':category' => $category,
        ':image' => $image,
        ':user_id' => $_SESSION['user_id']
    ]);

    header("Location: index.php");
    exit;
}
?>
