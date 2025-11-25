<?php
require_once __DIR__ . '/config.php';

// Verifica se é admin
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

// Busca a notícia
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$noticia) {
    header("Location: index.php");
    exit;
}

// Atualização de notícia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $summary = trim($_POST['summary']);
    $content = trim($_POST['content']);
    $category = $_POST['category'];

    // Upload de imagem (opcional)
    $image = $noticia['image'];
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['image']['name']);
        $targetPath = $uploadDir . time() . '_' . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            // Remove imagem antiga
            if (!empty($image) && file_exists($image)) {
                unlink($image);
            }
            $image = $targetPath;
        }
    }

    // Atualiza no banco
    $stmt = $pdo->prepare("UPDATE news 
                           SET title = :title, summary = :summary, content = :content, category = :category, image = :image 
                           WHERE id = :id");
    $stmt->execute([
        ':title' => $title,
        ':summary' => $summary,
        ':content' => $content,
        ':category' => $category,
        ':image' => $image,
        ':id' => $id
    ]);

    header("Location: noticia.php?id=$id");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Notícia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="news-form">
    <h2>Editar Notícia</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="title">Título</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($noticia['title']) ?>" required>

        <label for="summary">Resumo</label>
        <textarea name="summary" id="summary" rows="3" required><?= htmlspecialchars($noticia['summary']) ?></textarea>

        <label for="content">Conteúdo</label>
        <div class="editor-buttons">
            <button type="button" onclick="insertTag('content','<b>','</b>')"><b>B</b></button>
            <button type="button" onclick="insertTag('content','<i>','</i>')"><i>I</i></button>
        </div>
        <textarea name="content" id="content" rows="8" required><?= htmlspecialchars($noticia['content']) ?></textarea>

        <label for="category">Categoria</label>
        <select name="category" id="category" required>
            <option value="Avisos" <?= $noticia['category'] === 'Avisos' ? 'selected' : '' ?>>Avisos</option>
            <option value="Eventos" <?= $noticia['category'] === 'Eventos' ? 'selected' : '' ?>>Eventos</option>
            <option value="Artigos" <?= $noticia['category'] === 'Artigos' ? 'selected' : '' ?>>Artigos</option>
        </select>

        <label for="image">Imagem (opcional)</label>
        <input type="file" name="image" id="image" accept="image/*">
        <?php if (!empty($noticia['image'])): ?>
            <p>Imagem atual: <img src="<?= htmlspecialchars($noticia['image']) ?>" alt="" style="max-height:100px;vertical-align:middle;margin-left:10px;"></p>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit">Salvar Alterações</button>
            <a href="noticia.php?id=<?= $id ?>" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

<script>
function insertTag(id, openTag, closeTag) {
    var txt = document.getElementById(id);
    var start = txt.selectionStart;
    var end = txt.selectionEnd;
    var selected = txt.value.substring(start, end);
    var newText = openTag + selected + closeTag;
    txt.value = txt.value.substring(0, start) + newText + txt.value.substring(end);
}
</script>

</body>
</html>
