
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Entendendo os marcos do desenvolvimento infantil | Blog - Clínica Crescer Bem</title>
  <link rel="stylesheet" href="../css/blog.css">
  <style>
    .post-img {
      max-width: 100%;
      height: auto;
      display: block;
      margin: 20px auto;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-height: 400px;
      object-fit: cover;
    }
  </style>
</head>
<body>

  <header>
    <img src="../assets/img/logo.png" alt="Logo da Clínica Crescer Bem" class="logo">
    <nav>
      <a href="../index.php">Home</a>
      <a href="../index.php#sobre">Quem Somos</a>
      <a href="../pages/agendamento.php">Agendar Consulta</a>
      <a href="#contato">Contato</a>
      <?php include '../backend/nav.php'; ?>
    </nav>
  </header>

  <div class="container">
    <div class="post-content">
      <h1>Entendendo os marcos do desenvolvimento infantil</h1>
      <img src="../assets/img/blog2.png" alt="Entendendo os marcos do desenvolvimento infantil" class="post-img">
      
<p>As crianças passam por várias etapas de crescimento, cada uma com características específicas.</p>
<p>Aqui estão alguns marcos comuns:</p>
<ul>
  <li>3 meses: começa a sorrir e fazer sons simples;</li>
  <li>6 meses: reconhece rostos familiares e responde a estímulos;</li>
  <li>1 ano: já anda com apoio e fala palavras simples;</li>
  <li>2 anos: forma frases curtas e expressa vontades;</li>
  <li>3 anos: brincadeiras simbólicas e vocabulário expandido.</li>
</ul>
<p>Observar esses marcos ajuda a identificar atrasos precocemente e buscar ajuda especializada.</p>

    </div>
  </div>

  <footer id="contato">
    <div class="footer-container">
      <div class="footer-col">
        <img src="../assets/img/logo.png" alt="Logo da Clínica Crescer Bem" class="footer-logo">
        <p>A Clínica Crescer Bem é referência no cuidado infantil com excelência e humanização.</p>
        <p>📞 (98) 3089-4122<br>📧 contato@clinicacrescerbem.com.br</p>
      </div>
      <div class="footer-col">
        <h4>Serviços</h4>
        <ul>
          <li><a href="../index.php#servicos">Psicologia Infantil</a></li>
          <li><a href="../index.php#servicos">Fonoaudiologia</a></li>
          <li><a href="../index.php#servicos">Terapia Ocupacional</a></li>
          <li><a href="../index.php#servicos">Apoio Pedagógico</a></li>
          <li><a href="../blog.php">Blog Educativo</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Institucional</h4>
        <ul>
          <li><a href="../index.php#sobre">Sobre Nós</a></li>
          <li><a href="../pages/agendamento.php">Agendamento</a></li>
          <li><a href="#contato">Contato</a></li>
          <li><a href="#">Política de Privacidade</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Redes Sociais</h4>
        <div class="footer-social">
          <a href="#"><img src="../assets/img/instagram.png" alt="Instagram"></a>
          <a href="#"><img src="../assets/img/facebook.png" alt="Facebook"></a>
          <a href="#"><img src="../assets/img/linkedin.png" alt="LinkedIn"></a>
        </div>
      </div>
    </div>
    <div class="footer-copy">
      © 2025 Clínica Crescer Bem — Todos os direitos reservados.
    </div>
  </footer>

</body>
</html>
