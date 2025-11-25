<?php
require_once __DIR__ . '/config.php';

if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}

$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Jornal Jovem Marista</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <div class="auth-container">
    <div class="auth-box">
      <h2>Entrar</h2>
      <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" action="process_login.php">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Senha</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Entrar</button>
      </form>

      <p class="link">Ainda não tem conta? <a href="register.php">Cadastre-se</a></p>
    </div>
  </div>
</body>
</html>
