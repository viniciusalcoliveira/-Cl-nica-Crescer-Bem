<?php
require_once("../backend/conectar.php");

$busca = $_GET['busca'] ?? '';

$sql = "SELECT u.nome, p.especialidade, p.bio
        FROM profissionais p
        JOIN usuarios u ON p.usuario_id = u.id
        WHERE u.nome LIKE ? OR p.especialidade LIKE ?";

$param = '%' . $busca . '%';
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $param, $param);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Equipe de Profissionais</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background-color: #f4f6f9;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

main {
  flex: 1;
}

    header {
      background-color: #fff;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #d8e0e6;
    }
    .logo {
      max-height: 50px;
    }
    nav a {
      margin: 0 10px;
      text-decoration: none;
      color: #2c3e50;
      font-weight: bold;
    }
    nav a:hover {
      color: #27ae60;
    }
    h2 {
      text-align: center;
      margin: 40px 0 10px;
      color: #2c3e50;
    }
    form {
      text-align: center;
      margin-bottom: 30px;
    }
    input[type="text"] {
      padding: 10px;
      width: 90%;
      max-width: 400px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    .profissionais {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      padding: 0 40px 60px;
      max-width: 1200px;
      margin: auto;
    }
    .card {
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      text-align: center;
      transition: 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .foto {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      border: 3px solid #A7CF4A;
    }
    .especialidade {
      font-weight: bold;
      color: #27ae60;
      margin: 5px 0;
    }

    footer {
      background-color: #A7CF4A;
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
    }
    footer a {
      color: #fff;
      text-decoration: none;
    }
    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: space-between;
    }
    .footer-column {
      flex: 1 1 250px;
      max-width: 300px;
    }
    .footer-bottom {
      text-align: center;
      background-color: #8EBF3F;
      color: #fff;
      padding: 15px;
      font-size: 13px;
    }
    .footer-social img {
      width: 28px;
      height: 28px;
      object-fit: contain;
      margin-right: 10px;
    }

    @media (max-width: 600px) {
      header {
        flex-direction: column;
        align-items: flex-start;
      }
      nav {
        margin-top: 10px;
      }
      .profissionais {
        padding: 0 20px 60px;
      }
    }
  </style>
</head>
<body>

<header>
  <img src="../assets/img/logo.png" alt="Logo da Clínica Crescer Bem" class="logo">
  <nav>
    <a href="../index.php">Home</a>
    <a href="../index.php#sobre">Quem Somos</a>
    <a href="agendamento.php">Agendar Consulta</a>
    <a href="../index.php#contato">Contato</a>
    <?php include '../backend/nav.php'; ?>
  </nav>
</header>

<main>
  <h2>Equipe de Profissionais</h2>

  <form method="GET">
    <input type="text" name="busca" placeholder="Buscar por nome ou especialidade" value="<?= htmlspecialchars($busca) ?>">
  </form>

  <div class="profissionais">
    <?php while ($p = $resultado->fetch_assoc()): ?>
      <div class="card">
        <img src="../assets/img/default-user.png" class="foto" alt="Sem foto">
        <h3><?= htmlspecialchars($p['nome']) ?></h3>
        <p class="especialidade"><?= htmlspecialchars($p['especialidade']) ?></p>
        <p><?= nl2br(htmlspecialchars($p['bio'])) ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</main>

<footer id="contato">
  <div class="footer-container">
    <div class="footer-column">
      <img src="../assets/img/logo.png" alt="Logo da Clínica Crescer Bem" style="max-height: 60px; margin-bottom: 15px;">
      <p>A Clínica Crescer Bem é referência no cuidado infantil com excelência e humanização.</p>
      <p>📞 (98) 3089-4122<br>📧 contato@clinicacrescerbem.com.br</p>
    </div>
    <div class="footer-column">
      <h4>Serviços</h4>
      <ul style="list-style: none; padding: 0;">
        <li><a href="#servicos">Psicologia Infantil</a></li>
        <li><a href="#servicos">Fonoaudiologia</a></li>
        <li><a href="#servicos">Terapia Ocupacional</a></li>
        <li><a href="#servicos">Apoio Pedagógico</a></li>
        <li><a href="../blog.php">Blog Educativo</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Institucional</h4>
      <ul style="list-style: none; padding: 0;">
        <li><a href="#sobre">Sobre Nós</a></li>
        <li><a href="agendamento.php">Agendamento</a></li>
        <li><a href="#contato">Contato</a></li>
        <li><a href="#">Política de Privacidade</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Redes Sociais</h4>
      <div class="footer-social">
        <a href="https://www.instagram.com/clinicacrescerbem" target="_blank"><img src="../assets/img/instagram.png" alt="Instagram"></a>
        <a href="https://www.facebook.com/clinicacrescerbem" target="_blank"><img src="../assets/img/facebook.png" alt="Facebook"></a>
        <a href="https://www.linkedin.com/company/clinicacrescerbem" target="_blank"><img src="../assets/img/linkedin.png" alt="LinkedIn"></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    © 2025 Clínica Crescer Bem — Todos os direitos reservados.
  </div>
</footer>

</body>
</html>
