<?php
require_once __DIR__ . '/config.php';

// Busca (se foi enviado)
$search = trim($_GET['q'] ?? '');

// Monta consulta
$sql = "SELECT * FROM news";
$params = [];

if ($search !== '') {
    $sql .= " WHERE title LIKE :search OR summary LIKE :search OR content LIKE :search";
    $params[':search'] = "%$search%";
}

$sql .= " ORDER BY published_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Jornal Jovem Marista</title>

  <!-- caminho relativo padrão: ajuste se seu styles.css estiver em outra pasta (ex: css/styles.css) -->
  <link rel="stylesheet" href="styles.css">

  <!-- meta viewport para responsividade -->
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>

  <!-- incluir header DENTRO do body (após o head) -->
  <?php include __DIR__ . '/header.php'; ?>

  <!-- Hero / introdução -->
 <section class="hero">
  <div class="hero-content left">
    <h1>Jornal Jovem Marista</h1>
    <p>
      O <strong>JJM (Jornal Jovem Marista)</strong> é uma iniciativa produzida por alunos,
      onde o principal objetivo é dar voz aos principais agentes de nossas unidades, os estudantes.
    </p>
    <p>
      O projeto tem como principal meta integrar nossos alunos, além de informar e registrar acontecimentos
      que ocorrem em nossa unidade, Marista Escola Social Cascavel.
    </p>
    <p>
      Como um jornal, temos a ocupação de publicar notícias sobre a nossa escola,
      mas também informamos sobre eventos futuros e grandes acontecimentos dentro da esfera Marista.
    </p>
    <p>
      Tudo isso feito com o <strong>carisma Marista</strong>, sendo escrito e produzido por alunos da nossa unidade,
      carregando os valores de nosso fundador, <strong>São Marcelino Champagnat</strong>.
    </p>
  </div>
</section>

  <!-- Notícias -->
 <!-- Notícias -->
<section class="noticias">
  <h2>Últimas Notícias</h2>

  <?php if (empty($noticias)): ?>
    <p style="text-align:center; color:#555; margin-top:20px;">
      Nenhuma notícia encontrada<?= $search ? " para <strong>" . htmlspecialchars($search) . "</strong>" : "" ?>.
    </p>
  <?php else: ?>
    <div class="cards">
      <?php foreach ($noticias as $noticia): ?>
        <div class="card">

          <?php if (!empty($noticia['image'])): ?>
            <div class="thumb">
              <img src="<?= htmlspecialchars($noticia['image']) ?>" alt="">
            </div>
          <?php else: ?>
            <div class="thumb">
              <img src="uploads/default.jpg" alt="">
            </div>
          <?php endif; ?>

          <div class="card-body">
            <span class="categoria"><?= htmlspecialchars($noticia['category']) ?></span>
            <h3><?= htmlspecialchars($noticia['title']) ?></h3>
            <p><?= htmlspecialchars($noticia['summary']) ?></p>
          </div>

    <div class="card-footer">
    <div class="meta">
        <?= htmlspecialchars(date('d/m/Y', strtotime($noticia['published_at'] ?? 'now'))) ?>
    </div>
</div>

<div class="admin-actions">
    <!-- Ler mais: todo mundo vê -->
    <a href="noticia.php?id=<?= $noticia['id'] ?>" class="btn-lermais">Ler mais</a>

    <!-- Editar / Excluir: só admin -->
    <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="edit_news.php?id=<?= $noticia['id'] ?>" class="btn-edit">Editar</a>
        <a href="delete_news.php?id=<?= $noticia['id'] ?>" class="btn-delete"
           onclick="return confirm('Excluir esta notícia?')">Excluir</a>
    <?php endif; ?>
</div>


        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>


</body>
</html>
