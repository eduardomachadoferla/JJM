<?php
require_once __DIR__ . '/config.php';

function highlight($text, $search) {
  if (!$search) return htmlspecialchars($text);
  return preg_replace(
    '/' . preg_quote($search, '/') . '/i',
    '<mark>$0</mark>',
    htmlspecialchars($text)
  );
}

$search = trim($_GET['search'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 6;
$offset = ($page - 1) * $perPage;

$where = "WHERE category = 'Eventos'";
$params = [];

if ($search !== '') {
  $where .= " AND (n.title LIKE :search OR n.summary LIKE :search OR n.content LIKE :search)";
  $params[':search'] = "%$search%";
}

$stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM news n $where");
$stmt->execute($params);
$total = (int)$stmt->fetch()['total'];
$pages = (int)ceil($total / $perPage);

$sql = "SELECT n.*, u.name AS author 
        FROM news n 
        JOIN users u ON u.id = n.user_id 
        $where
        ORDER BY published_at DESC 
        LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);

foreach ($params as $key => $value) {
  $stmt->bindValue($key, $value, PDO::PARAM_STR);
}
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$news = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Eventos - Jornal Jovem Marista</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php include __DIR__ . '/header.php'; ?>

  <section class="noticias">
    <h2>Eventos</h2>

    <form method="get" action="eventos.php" class="search-bar">
      <input type="text" name="search" placeholder="Buscar eventos..." value="<?= htmlspecialchars($search) ?>">
      <button type="submit">Buscar</button>
    </form>

    <div class="cards">
      <?php if (!$news): ?>
        <p>Nenhum evento encontrado.</p>
      <?php else: ?>
        <?php foreach ($news as $item): ?>
          <div class="card">
            <?php if (!empty($item['image'])): ?>
              <img src="<?= htmlspecialchars($item['image']) ?>" alt="Imagem do evento">
            <?php endif; ?>
            <span class="categoria"><?= htmlspecialchars($item['category']) ?></span>
            <h3><?= highlight($item['title'], $search) ?></h3>
            <p><?= nl2br(highlight($item['summary'], $search)) ?></p>
            <a href="noticia.php?id=<?= $item['id'] ?>">Continuar lendo</a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <?php if ($pages > 1): ?>
      <div class="paginacao">
        <?php if ($page > 1): ?>
          <a href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>" class="btn-page">← Anterior</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $pages; $i++): ?>
          <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>" class="btn-page <?= $i === $page ? 'ativo' : '' ?>">
            <?= $i ?>
          </a>
        <?php endfor; ?>
        <?php if ($page < $pages): ?>
          <a href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>" class="btn-page proxima">Próxima →</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </section>
</body>
</html>
