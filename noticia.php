<?php
require_once __DIR__ . '/config.php';

// Valida id da notícia
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = (int) $_GET['id'];

// Busca notícia
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$noticia) {
    echo "<p style='text-align:center;margin-top:40px;'>Notícia não encontrada.</p>";
    exit;
}

// Busca comentários (ajuste nomes se seu esquema for diferente)
$stmt = $pdo->prepare("SELECT c.id, c.comment AS content, c.user_id, c.created_at, u.name AS user_name 
                       FROM comments c
                       JOIN users u ON c.user_id = u.id
                       WHERE c.news_id = ?
                       ORDER BY c.created_at DESC");
$stmt->execute([$id]);
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Dados do usuário logado
$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['role'] ?? 'user';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($noticia['title']) ?> - Jornal</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="noticia-detalhe">
  <?php if (!empty($noticia['image'])): ?>
    <img src="<?= htmlspecialchars($noticia['image']) ?>" alt="<?= htmlspecialchars($noticia['title']) ?>">
  <?php endif; ?>

  <h1><?= htmlspecialchars($noticia['title']) ?></h1>
  <h2><?= htmlspecialchars($noticia['summary']) ?></h2>
  <p><?= nl2br(htmlspecialchars($noticia['content'])) ?></p>

  <?php if ($user_role === 'admin'): ?>
    <div class="admin-actions" style="margin-top:18px;">
      <a href="edit_news.php?id=<?= $noticia['id'] ?>" class="btn-edit">Editar Notícia</a>
      <a href="delete_news.php?id=<?= $noticia['id'] ?>" class="btn-delete" onclick="return confirm('Deseja realmente excluir esta notícia?');">Excluir Notícia</a>
    </div>
  <?php endif; ?>
</div>

<!-- Comentários -->
<div class="comentarios">
  <h2>Comentários</h2>

  <?php if ($user_id): ?>
    <form method="post" action="process_comment.php" class="form-comentario">
      <textarea name="comment" placeholder="Escreva seu comentário..." required></textarea>
      <input type="hidden" name="news_id" value="<?= $noticia['id'] ?>">
      <button type="submit">Publicar</button>
    </form>
  <?php else: ?>
    <p style="text-align:center;">Faça <a href="login.php">login</a> para comentar.</p>
  <?php endif; ?>

  <div class="lista-comentarios">
    <?php if (count($comentarios) === 0): ?>
      <p>Nenhum comentário ainda. Seja o primeiro!</p>
    <?php else: ?>
      <?php foreach ($comentarios as $comentario): ?>
        <div class="comentario">
          <strong><?= htmlspecialchars($comentario['user_name']) ?>:</strong>
          <p><?= nl2br(htmlspecialchars($comentario['content'])) ?></p>
          <small><?= date('d/m/Y H:i', strtotime($comentario['created_at'])) ?></small>

          <?php if ($user_role === 'admin'): ?>
            <!-- link correto para delete_comment.php com id do comentário e news_id (para redirecionar de volta) -->
            <div style="margin-top:8px;">
              <a href="delete_comment.php?id=<?= $comentario['id'] ?>&news_id=<?= $noticia['id'] ?>" 
                 class="btn-delete" 
                 onclick="return confirm('Excluir este comentário?');">Excluir Comentário</a>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
