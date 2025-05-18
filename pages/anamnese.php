<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Anamnese - Clínica Crescer Bem</title>
  <link rel="stylesheet" href="/CLINICA_UNDB/css/anamnese.css">
</head>
<body>

  <header>
    <img src="../assets/img/logo.png" alt="Logo da Clínica Crescer Bem" class="logo">
    <nav>
      <a href="../index.php">Home</a>
      <a href="#sobre">Quem Somos</a>
      <a href="agendamento.php">Agendar</a>
      <a href="#contato">Contato</a>
      <a href="/CLINICA_UNDB/pages/login.html">Entrar</a>
      </nav>
  </header>

  <main class="container">
    <?php if (isset($_GET['enviado'])): ?>
      <div class="alert-sucesso">Formulário enviado com sucesso!</div>
    <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'nao_logado'): ?>
      <div class="alert-erro">Você precisa estar logado para enviar o formulário.</div>
    <?php endif; ?>

    <form method="post" action="../backend/anamnese.php">
      <h2>Formulário de Anamnese</h2>

      <label for="responsavel">Nome do responsável:</label>
      <input type="text" id="responsavel" name="responsavel" required>

      <label for="crianca">Nome da criança:</label>
      <input type="text" id="crianca" name="crianca" required>

      <label for="idade">Idade da criança:</label>
      <input type="number" id="idade" name="idade" required>

      <label for="comportamento">Comportamento observado:</label>
      <textarea id="comportamento" name="comportamento" rows="4" required></textarea>

      <label for="historico">Histórico de saúde:</label>
      <textarea id="historico" name="historico" rows="4"></textarea>

      <button type="submit" class="submit-btn">Enviar</button>
    </form>
  </main>

  <footer id="contato" style="background-color: #A7CF4A; color: #fff; font-family: 'Segoe UI', sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px; display: flex; flex-wrap: wrap; gap: 30px; justify-content: space-between;">
      
      <div style="flex: 1 1 250px; max-width: 300px;">
        <img src="../assets/img/logo.png" alt="Logo da Clínica Crescer Bem" style="max-height: 60px; width: auto; margin-bottom: 15px;">
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
          <li><a href="agendamento.php" style="color: #fff; text-decoration: none;">Agendamento</a></li>
          <li><a href="#contato" style="color: #fff; text-decoration: none;">Contato</a></li>
          <li><a href="#" style="color: #fff; text-decoration: none;">Política de Privacidade</a></li>
        </ul>
      </div>
  
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px; font-size: 18px;">Redes Sociais</h4>
        <div style="display: flex; gap: 10px; align-items: center;">
          <a href="https://www.instagram.com/clinicacrescerbem" target="_blank" rel="noopener">
            <img src="../assets/img/instagram.png" alt="Instagram" style="width: 28px; height: 28px;">
          </a>
          <a href="https://www.facebook.com/clinicacrescerbem" target="_blank" rel="noopener">
            <img src="../assets/img/facebook.png" alt="Facebook" style="width: 28px; height: 28px;">
          </a>
          <a href="https://www.linkedin.com/company/clinicacrescerbem" target="_blank" rel="noopener">
            <img src="../assets/img/linkedin.png" alt="LinkedIn" style="width: 28px; height: 28px;">
          </a>
        </div>
      </div>
  
    </div>
    <div style="text-align: center; background-color: #8EBF3F; color: #fff; padding: 15px; font-size: 13px;">
      © 2025 Clínica Crescer Bem — Todos os direitos reservados.
    </div>
  </footer>

</body>
</html>
