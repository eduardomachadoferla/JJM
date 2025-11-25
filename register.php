<?php
require_once __DIR__ . '/config.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  if ($name === '' || $email === '' || $password === '') {
    $error = "Preencha todos os campos.";
  } else {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    try {
      $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password, 'user')");
      $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $passwordHash
      ]);
      header("Location: login.php");
      exit;
    } catch (PDOException $e) {
      $error = "Erro: email já cadastrado.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - Jornal Jovem Marista</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php include __DIR__ . '/header.php'; ?>

  <div class="auth-container">
    <div class="auth-box">
      <h2>Cadastro</h2>
      <p>Crie sua conta para comentar notícias</p>

      <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" autocomplete="off">
        <label>Nome</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="password" required>

        <button type="submit">Cadastrar</button>
      </form>

      <p class="link">Já tem conta? <a href="login.php">Faça login</a></p>
    </div>
  </div>
</body>
</html>
