<?php
require_once 'backend/conectar.php';
$slug = $_GET['slug'] ?? '';
$stmt = $conn->prepare("SELECT * FROM blog_posts WHERE slug = ? LIMIT 1");
$stmt->bind_param("s", $slug);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
if (!$post) {
  echo "Post não encontrado.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $post['titulo'] ?> - Blog</title>
  <link rel="stylesheet" href="css/blog.css">
</head>
<body>
  <main class="container post-content">
    <h1><?= htmlspecialchars($post['titulo']) ?></h1>
    <img src="uploads/<?= $post['imagem'] ?>" alt="<?= $post['titulo'] ?>">
    <p><?= nl2br($post['conteudo']) ?></p>
    <a href="blog.php" class="btn-voltar">← Voltar ao Blog</a>
  </main>

  <footer>
    <p>© 2025 Clínica Crescer Bem</p>
  </footer>
</body>
</html>
