<?php
require_once __DIR__ . '/config.php';

// Verifica login e dados de sessão
$displayName = htmlspecialchars($_SESSION['name'] ?? $_SESSION['user_name'] ?? ($_SESSION['email'] ?? 'Usuário'));
$loggedIn = !empty($_SESSION['user_id']);
$role = $_SESSION['role'] ?? '';

// Verifica qual página está aberta
$current_page = basename($_SERVER['PHP_SELF']);
$show_search = ($current_page === 'index.php'); // só mostra pesquisa no index
?>
<header>
  <div class="container">
    <div class="logo">
      <img src="imagem.png" alt="Logo" />
      <a href="index.php">Jornal Jovem Marista</a>
    </div>

    <nav>
      <ul>
        <li><a href="index.php" class="<?= $Administrador === 'index.php' ? 'active' : '' ?>">Início</a></li>
        <li><a href="avisos.php" class="<?= $current_page === 'avisos.php' ? 'active' : '' ?>">Avisos</a></li>
        <li><a href="artigos.php" class="<?= $current_page === 'artigos.php' ? 'active' : '' ?>">Artigos</a></li>
        <li><a href="eventos.php" class="<?= $current_page === 'eventos.php' ? 'active' : '' ?>">Eventos</a></li>
      </ul>
    </nav>

    <?php if ($show_search): ?>
    <div class="search-bar">
      <form action="index.php" method="get">
        <input type="text" name="q" placeholder="Pesquisar notícias..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button type="submit">Buscar</button>
      </form>
    </div>
    <?php endif; ?>

    <div class="actions">
      <?php if ($loggedIn): ?>
        <span class="user-name"><?= $displayName ?></span>
        <?php if ($role === 'admin'): ?>
          <a href="post_news.php" class="btn">Postar notícia</a>
        <?php endif; ?>
        <a href="logout.php" class="btn">Sair</a>
      <?php else: ?>
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn">Cadastro</a>
      <?php endif; ?>
    </div>
  </div>
</header>
