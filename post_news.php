<?php
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Postar Notícia</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="news-form">
    <h2>Postar Notícia</h2>
    <form method="post" action="process_post.php" enctype="multipart/form-data">
      <label for="title">Título</label>
      <input type="text" name="title" id="title" required>

      <label for="summary">Resumo</label>
      <textarea name="summary" id="summary" rows="3" required></textarea>

      <label for="content">Conteúdo</label>
      <div class="editor-buttons">
        <button type="button" onclick="insertTag('content','<b>','</b>')"><b>B</b></button>
        <button type="button" onclick="insertTag('content','<i>','</i>')"><i>I</i></button>
      </div>
      <textarea name="content" id="content" rows="8" required></textarea>

      <label for="category">Categoria</label>
      <select name="category" id="category" required>
        <option value="Avisos">Avisos</option>
        <option value="Eventos">Eventos</option>
        <option value="Artigos">Artigos</option>
      </select>

      <input type="file" name="image" id="image" accept="image/*">
      <label for="image" class="file-label">📂 Selecionar Imagem</label>

      <div class="form-actions">
        <button type="submit">Publicar</button>
        <a href="index.php" class="btn-cancel">Cancelar</a>
      </div>
    </form>
  </div>

  <script>
  function insertTag(id, openTag, closeTag) {
    const txt = document.getElementById(id);
    const start = txt.selectionStart;
    const end = txt.selectionEnd;
    const selected = txt.value.substring(start, end);
    const newText = openTag + selected + closeTag;
    txt.value = txt.value.substring(0, start) + newText + txt.value.substring(end);
  }
  </script>
</body>
</html>
