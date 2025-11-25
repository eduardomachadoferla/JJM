<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $titulo = htmlspecialchars(trim($_POST['titulo']), ENT_QUOTES, 'UTF-8');
    $conteudo = htmlspecialchars(trim($_POST['conteudo']), ENT_QUOTES, 'UTF-8');
    $categoria = htmlspecialchars(trim($_POST['categoria']), ENT_QUOTES, 'UTF-8');

    $sql = "SELECT imagem FROM news WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);
    $imagem = $noticia['imagem'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $destino = 'uploads/' . $nomeArquivo;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);
        $imagem = $destino;
    }

    $sql = "UPDATE news SET titulo = ?, conteudo = ?, categoria = ?, imagem = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo, $conteudo, $categoria, $imagem, $id]);

    header('Location: noticia.php?id=' . $id);
    exit;
}
?>
