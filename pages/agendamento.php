<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agendamento - Clínica Crescer Bem</title>
  <link rel="stylesheet" href="../css/agendamento.css">
  <style>
    .menu-toggle {
      display: none;
      font-size: 28px;
      background: none;
      border: none;
      cursor: pointer;
      color: #003366;
    }

    @media (max-width: 768px) {
      nav {
        position: absolute;
        top: 80px;
        left: 0;
        right: 0;
        background: white;
        flex-direction: column;
        display: none;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      }

      nav.open {
        display: flex;
      }

      .menu-toggle {
        display: block;
      }

      header {
        flex-wrap: wrap;
      }
    }
  </style>
</head>
<body>

<header>
  <img src="../assets/img/logo.png" alt="Logo" class="logo">
  <button class="menu-toggle" onclick="document.querySelector('nav').classList.toggle('open')">☰</button>
  <nav>
    <a href="../index.php">Home</a>
    <a href="../index.php#sobre">Quem Somos</a>
    <a href="agendamento.php">Agendar Consulta</a>
    <a href="../index.php#contato">Contato</a>
    <?php include '../backend/nav.php'; ?>
  </nav>
</header>

<section class="agendamento-box">
  <div class="card-agendamento">
    <h2>📅 Agende um Atendimento</h2>

    <div id="notificacao" class="notificacao hidden"></div>

    <form action="../backend/agendar.php" method="post" id="form-agendar">
      <label for="nome">Nome completo</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>

      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>

      <label for="telefone">Telefone</label>
      <input type="tel" id="telefone" name="telefone" placeholder="(99) 99999-9999" required>

      <label for="servico">Serviço</label>
      <select id="servico" name="servico" required>
        <option value="">Selecione o serviço</option>
        <option value="psicologia">Psicologia</option>
        <option value="fonoaudiologia">Fonoaudiologia</option>
        <option value="terapia ocupacional">Terapia Ocupacional</option>
        <option value="apoio pedagógico">Apoio Pedagógico</option>
      </select>

      <label for="profissional_id">Profissional</label>
      <select id="profissional_id" name="profissional_id" required>
        <option value="">Selecione um serviço primeiro</option>
      </select>

      <div class="row">
        <div>
          <label for="data">Data</label>
          <input type="date" id="data" name="data" required>
        </div>
        <div>
          <label for="hora">Hora</label>
          <select id="hora" name="hora" required>
            <option value="">Selecione um horário</option>
          </select>
        </div>
      </div>

      <button type="submit">Agendar</button>
    </form>
  </div>
</section>

<footer style="background-color: #A7CF4A; color: #fff; font-family: 'Segoe UI', sans-serif;">
  <div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px; display: flex; flex-wrap: wrap; gap: 30px; justify-content: space-between;">
    <div style="flex: 1 1 250px; max-width: 300px;">
      <img src="../assets/img/logo.png" alt="Logo da Clínica Crescer Bem" style="max-height: 60px; width: auto; margin-bottom: 15px;">
      <p>A Clínica Crescer Bem é referência no cuidado infantil com excelência e humanização.</p>
      <p>📞 (98) 3089-4122<br>📧 contato@clinicacrescerbem.com.br</p>
    </div>
    <div style="flex: 1 1 250px; max-width: 300px;">
      <h4 style="margin-bottom: 15px;">Serviços</h4>
      <ul style="list-style: none; padding: 0;">
        <li><a href="../index.php#servicos" style="color: #fff;">Psicologia Infantil</a></li>
        <li><a href="../index.php#servicos" style="color: #fff;">Fonoaudiologia</a></li>
        <li><a href="../index.php#servicos" style="color: #fff;">Terapia Ocupacional</a></li>
        <li><a href="../index.php#servicos" style="color: #fff;">Apoio Pedagógico</a></li>
        <li><a href="../blog.php" style="color: #fff;">Blog Educativo</a></li>
      </ul>
    </div>
    <div style="flex: 1 1 250px; max-width: 300px;">
      <h4 style="margin-bottom: 15px;">Institucional</h4>
      <ul style="list-style: none; padding: 0;">
        <li><a href="../index.php#sobre" style="color: #fff;">Sobre Nós</a></li>
        <li><a href="agendamento.php" style="color: #fff;">Agendamento</a></li>
        <li><a href="../index.php#contato" style="color: #fff;">Contato</a></li>
        <li><a href="#" style="color: #fff;">Política de Privacidade</a></li>
      </ul>
    </div>
    <div style="flex: 1 1 250px; max-width: 300px;">
      <h4 style="margin-bottom: 15px;">Redes Sociais</h4>
      <div style="display: flex; gap: 10px;">
        <a href="#"><img src="../assets/img/instagram.png" alt="Instagram" style="width: 28px;"></a>
        <a href="#"><img src="../assets/img/facebook.png" alt="Facebook" style="width: 28px;"></a>
        <a href="#"><img src="../assets/img/linkedin.png" alt="LinkedIn" style="width: 28px;"></a>
      </div>
    </div>
  </div>
  <div style="text-align: center; background-color: #8EBF3F; color: #fff; padding: 15px; font-size: 13px;">
    © 2025 Clínica Crescer Bem — Todos os direitos reservados.
  </div>
</footer>

<script src="../assets/js/agendamento.js"></script>
<script>
  // Fecha menu ao clicar fora
  document.addEventListener('click', function (e) {
    const nav = document.querySelector('nav');
    const toggle = document.querySelector('.menu-toggle');
    if (!nav.contains(e.target) && !toggle.contains(e.target)) {
      nav.classList.remove('open');
    }
  });
</script>
</body>
</html>
