<?php
$posts = [
  [
    "titulo" => "Como estimular o desenvolvimento da fala",
    "resumo" => "Confira técnicas simples e eficazes para ajudar seu filho a desenvolver a linguagem de forma natural e divertida.",
    "imagem" => "assets/img/blog1.png",
    "link" => "pages/post1.php"
  ],
  [
    "titulo" => "Entendendo os marcos do desenvolvimento infantil",
    "resumo" => "Saiba quais comportamentos são esperados em cada fase do crescimento e quando é hora de buscar apoio especializado.",
    "imagem" => "assets/img/blog2.png",
    "link" => "pages/post2.php"
  ],
  [
    "titulo" => "Importância do apoio pedagógico individualizado",
    "resumo" => "Veja como o reforço personalizado pode ajudar crianças com dificuldades escolares a recuperar sua autoestima e aprendizado.",
    "imagem" => "assets/img/blog3.png",
    "link" => "pages/post3.php"
  ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Nosso Blog - Clínica Crescer Bem</title>
  <link rel="stylesheet" href="css/blog.css">
</head>
<body>

  <!-- HEADER -->
  <header>
    <img src="assets/img/logo.png" alt="Logo da Clínica Crescer Bem" class="logo" style="height: 70px;">
    <nav style="margin-top: 15px;">
      <a href="index.php">Home</a>
      <a href="#sobre">Quem Somos</a>
      <a href="pages/agendamento.php">Agendar Consulta</a>
      <a href="#contato">Contato</a>
      <?php include 'backend/nav.php'; ?>
    </nav>
  </header>

  <!-- BLOG CONTEÚDO -->
  <main class="container">
    <h1 style="color:#003366; text-align:center;">Nosso Blog</h1>
    <p style="text-align:center; margin-bottom: 40px;">Dicas, conteúdos educativos e novidades da nossa clínica</p>

    <div class="blog-list">
      <?php foreach ($posts as $post): ?>
        <div class="blog-card">
          <img src="<?= $post['imagem'] ?>" alt="<?= htmlspecialchars($post['titulo']) ?>">
          <div class="content">
            <h2><?= htmlspecialchars($post['titulo']) ?></h2>
            <p><?= htmlspecialchars($post['resumo']) ?></p>
            <a href="<?= $post['link'] ?>">Ler mais</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <!-- FOOTER -->
  <footer id="contato" style="background-color: #A7CF4A; color: #fff; font-family: 'Segoe UI', sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px; display: flex; flex-wrap: wrap; gap: 30px; justify-content: space-between;">
      <div style="flex: 1 1 250px; max-width: 300px;">
        <img src="assets/img/logo.png" alt="Logo da Clínica Crescer Bem" style="max-height: 60px; width: auto; margin-bottom: 15px;">
        <p>A Clínica Crescer Bem é referência no cuidado infantil com excelência e humanização.</p>
        <p>📞 (98) 3089-4122<br>📧 contato@clinicacrescerbem.com.br</p>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px; font-size: 18px;">Serviços</h4>
        <ul style="list-style: none; padding: 0;">
          <li><a href="#servicos" style="color: #fff; text-decoration: none;">Psicologia Infantil</a></li>
          <li><a href="#servicos" style="color: #fff; text-decoration: none;">Fonoaudiologia</a></li>
          <li><a href="#servicos" style="color: #fff; text-decoration: none;">Terapia Ocupacional</a></li>
          <li><a href="#servicos" style="color: #fff; text-decoration: none;">Apoio Pedagógico</a></li>
          <li><a href="blog.php" style="color: #fff; text-decoration: none;">Blog Educativo</a></li>
        </ul>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px; font-size: 18px;">Institucional</h4>
        <ul style="list-style: none; padding: 0;">
          <li><a href="#sobre" style="color: #fff; text-decoration: none;">Sobre Nós</a></li>
          <li><a href="pages/agendamento.php" style="color: #fff; text-decoration: none;">Agendamento</a></li>
          <li><a href="#contato" style="color: #fff; text-decoration: none;">Contato</a></li>
          <li><a href="#" style="color: #fff; text-decoration: none;">Política de Privacidade</a></li>
        </ul>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px; font-size: 18px;">Redes Sociais</h4>
        <div style="display: flex; gap: 10px; align-items: center;">
          <a href="#"><img src="assets/img/instagram.png" alt="Instagram" style="width: 28px; height: 28px;"></a>
          <a href="#"><img src="assets/img/facebook.png" alt="Facebook" style="width: 28px; height: 28px;"></a>
          <a href="#"><img src="assets/img/linkedin.png" alt="LinkedIn" style="width: 28px; height: 28px;"></a>
        </div>
      </div>
    </div>
    <div style="text-align: center; background-color: #8EBF3F; color: #fff; padding: 15px; font-size: 13px;">
      © 2025 Clínica Crescer Bem — Todos os direitos reservados.
    </div>
  </footer>

</body>
</html>
