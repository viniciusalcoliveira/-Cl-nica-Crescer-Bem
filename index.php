<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Clínica Crescer Bem</title>
  <link rel="stylesheet" href="css/index.css">
  <style>
    section#sobre, section#servicos {
      scroll-margin-top: 100px;
    }
  </style>
</head>
<body>

  <header>
    <img src="assets/img/logo.png" alt="Logo da Clínica Crescer Bem" class="logo">
    <nav>
      <a href="index.php">Home</a>
      <a href="#sobre">Quem Somos</a>
      <a href="pages/agendamento.php">Agendar Consulta</a>
      <a href="#contato">Contato</a>
      <?php include 'backend/nav.php'; ?>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-content">
      <div class="text">
        <h1 class="animate-slide">Bem-vindo à Clínica Crescer Bem</h1>
        <p class="animate-fade">
          Cuidamos do desenvolvimento do seu filho com carinho, respeito e profissionalismo. 
          Nossos serviços são voltados para o acompanhamento psicológico, pedagógico, terapêutico e fonoaudiológico.
        </p>
        <a href="pages/agendamento.php" class="btn-hero">Agendar Consulta</a>
      </div>
      <div class="img">
        <img src="assets/img/banner.png" alt="Criança e terapeuta montando quebra-cabeça">
      </div>
    </div>
  </section>

  <section class="sobre" id="sobre">
    <h2>Sobre a Clínica Crescer Bem</h2>
    <p>
      A Clínica Crescer Bem é um espaço dedicado ao desenvolvimento infantil, 
      oferecendo atendimento humanizado e especializado nas áreas de Psicologia, 
      Terapia Ocupacional, Fonoaudiologia e Apoio Pedagógico. 
      Nossa missão é acolher e acompanhar cada criança em sua jornada de crescimento, 
      com amor, cuidado e profissionalismo.
    </p>
  </section>

  <section class="servicos" id="servicos">
    <h2>Nossos Serviços</h2>
    <div class="cards">
      <?php
      require_once 'backend/conectar.php';
      $mapas = [
        'psicologia' => 'psicologia.html',
        'fonoaudiologia' => 'fono.html',
        'terapia' => 'terapia.html',
        'apoio' => 'pedagogia.html'
      ];
      $servicos = $conn->query("SELECT * FROM servicos WHERE ativo = 1 ORDER BY id ASC");
      while ($s = $servicos->fetch_assoc()):
        $slug = $s['slug'];
        $arquivo = $mapas[$slug] ?? '#';
      ?>
        <div class="card">
          <img src="assets/img/<?= htmlspecialchars($s['imagem']) ?>" alt="<?= htmlspecialchars($s['nome']) ?>">
          <h3><?= htmlspecialchars($s['nome']) ?></h3>
          <a href="pages/<?= $arquivo ?>" class="btn-saiba">Saiba mais</a>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <section class="extras">
    <h2>Ferramentas de Apoio</h2>
    <p>Explore nossos recursos para facilitar o acompanhamento terapêutico do seu filho.</p>
    <div class="extras-buttons">
      <div class="card-extra">
        <h3>Formulário de Anamnese</h3>
        <p>Preencha informações sobre o comportamento da criança para ajudar nossos especialistas.</p>
        <a href="pages/anamnese.php" class="btn-extra">Preencher Anamnese</a>
      </div>
      <div class="card-extra">
        <h3>Buscar Profissionais</h3>
        <p>Encontre rapidamente os profissionais disponíveis por nome ou especialidade.</p>
        <a href="pages/equipe.php" class="btn-extra">Buscar Profissionais</a>
      </div>
    </div>
  </section>

  <footer id="contato" style="background-color: #A7CF4A; color: #fff; font-family: 'Segoe UI', sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px; display: flex; flex-wrap: wrap; gap: 30px; justify-content: space-between;">
      <div style="flex: 1 1 250px; max-width: 300px;">
        <img src="assets/img/logo.png" alt="Logo da Clínica Crescer Bem" style="max-height: 60px; width: auto; margin-bottom: 15px;">
        <p>A Clínica Crescer Bem é referência no cuidado infantil com excelência e humanização.</p>
        <p>📞 (98) 3089-4122<br>📧 contato@clinicacrescerbem.com.br</p>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px;">Serviços</h4>
        <ul style="list-style: none; padding: 0;">
          <li><a href="#servicos" style="color: #fff;">Psicologia Infantil</a></li>
          <li><a href="#servicos" style="color: #fff;">Fonoaudiologia</a></li>
          <li><a href="#servicos" style="color: #fff;">Terapia Ocupacional</a></li>
          <li><a href="#servicos" style="color: #fff;">Apoio Pedagógico</a></li>
          <li><a href="blog.php" style="color: #fff;">Blog Educativo</a></li>
        </ul>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px;">Institucional</h4>
        <ul style="list-style: none; padding: 0;">
          <li><a href="#sobre" style="color: #fff;">Sobre Nós</a></li>
          <li><a href="pages/agendamento.php" style="color: #fff;">Agendamento</a></li>
          <li><a href="#contato" style="color: #fff;">Contato</a></li>
          <li><a href="#" style="color: #fff;">Política de Privacidade</a></li>
        </ul>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px;">Redes Sociais</h4>
        <div style="display: flex; gap: 10px; align-items: center;">
          <a href="#"><img src="assets/img/instagram.png" alt="Instagram" style="width: 28px;"></a>
          <a href="#"><img src="assets/img/facebook.png" alt="Facebook" style="width: 28px;"></a>
          <a href="#"><img src="assets/img/linkedin.png" alt="LinkedIn" style="width: 28px;"></a>
        </div>
      </div>
    </div>
    <div style="text-align: center; background-color: #8EBF3F; color: #fff; padding: 15px; font-size: 13px;">
      © 2025 Clínica Crescer Bem — Todos os direitos reservados.
    </div>
  </footer>

  <!-- Aviso de Cookies -->
  <div id="cookie-banner" style="
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #003366;
    color: #fff;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 9999;
    font-size: 14px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 -2px 5px rgba(0,0,0,0.2);
    display: none;
  ">
    <span>
      Utilizamos cookies para melhorar sua experiência no site. Ao continuar navegando, você concorda com nossa 
      <a href="#" style="color: #A7CF4A; text-decoration: underline;">Política de Privacidade</a>.
    </span>
    <button onclick="aceitarCookies()" style="
      background: #A7CF4A;
      color: #003366;
      border: none;
      padding: 8px 16px;
      margin-left: 20px;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
    ">Aceitar</button>
  </div>

  <script>
    function aceitarCookies() {
      document.getElementById('cookie-banner').style.display = 'none';
    }

    window.addEventListener('DOMContentLoaded', () => {
      document.getElementById('cookie-banner').style.display = 'flex';
    });
  </script>

  <script src="assets/js/canvas.js"></script>
</body>
</html>
