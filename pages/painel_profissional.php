<?php
session_start();
require_once("../backend/conectar.php");

// Verifica se está logado como profissional
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
  header("Location: ../index.php");
  exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Obter ID do profissional vinculado ao usuário logado
$stmt = $conn->prepare("SELECT id FROM profissionais WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($profissional_id);
$stmt->fetch();
$stmt->close();

// Atualiza status se enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agendamento_id'], $_POST['novo_status'])) {
  $agendamento_id = (int) $_POST['agendamento_id'];
  $novo_status = $_POST['novo_status'];

  $update = $conn->prepare("UPDATE agendamentos SET status = ? WHERE id = ? AND profissional_id = ?");
  $update->bind_param("sii", $novo_status, $agendamento_id, $profissional_id);
  $update->execute();
  $update->close();
}

// Consulta agendamentos
$sql = "SELECT a.id, a.data, a.hora, a.status, u.nome AS cliente
        FROM agendamentos a
        JOIN usuarios u ON a.cliente_id = u.id
        WHERE a.profissional_id = ?
        ORDER BY a.data DESC, a.hora DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $profissional_id);
$stmt->execute();
$res = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel do Profissional</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f0f4f8;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #fff;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 2px solid #d8e0e6;
    }
    header .logo {
      height: 60px;
    }
    header nav a {
      margin: 0 10px;
      color: #333;
      text-decoration: none;
      font-weight: 500;
    }
    header nav a:hover {
      color: #27ae60;
    }
    main {
      padding: 40px 20px;
      max-width: 1000px;
      margin: auto;
    }
    h2 {
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }
    th {
      background: #27ae60;
      color: white;
    }
    tr:hover {
      background: #f9f9f9;
    }
    .btn-voltar {
      margin-top: 20px;
      display: inline-block;
      background-color: #27ae60;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      transition: background 0.3s ease;
    }
    .btn-voltar:hover {
      background-color: #219150;
    }
    form.inline-form {
      display: flex;
      gap: 8px;
      align-items: center;
    }
    select, button {
      padding: 5px 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    button {
      background: #27ae60;
      color: white;
      cursor: pointer;
    }
    button:hover {
      background: #219150;
    }

    html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
  }

  main {
    flex: 1 0 auto;
  }

  footer {
    flex-shrink: 0;
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
    <h2>Atendimentos Agendados</h2>
    <table>
      <thead>
        <tr>
          <th>Paciente</th>
          <th>Data</th>
          <th>Hora</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($c = $res->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($c['cliente']) ?></td>
            <td><?= htmlspecialchars($c['data']) ?></td>
            <td><?= htmlspecialchars($c['hora']) ?></td>
            <td><?= ucfirst($c['status']) ?></td>
            <td>
              <form method="post" class="inline-form">
                <input type="hidden" name="agendamento_id" value="<?= $c['id'] ?>">
                <select name="novo_status">
                  <option value="pendente" <?= $c['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                  <option value="confirmado" <?= $c['status'] === 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
                  <option value="cancelado" <?= $c['status'] === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>
                <button type="submit">Salvar</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <a href="../index.php" class="btn-voltar">← Voltar ao Início</a>
  </main>

  <footer style="background-color: #A7CF4A; color: #fff; font-family: 'Segoe UI', sans-serif; margin-top: 60px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px; display: flex; flex-wrap: wrap; gap: 30px; justify-content: space-between;">
      <div style="flex: 1 1 250px; max-width: 300px;">
        <img src="../assets/img/logo.png" alt="Logo da Clínica Crescer Bem" style="max-height: 60px; width: auto; margin-bottom: 15px;">
        <p>A Clínica Crescer Bem é referência no cuidado infantil com excelência e humanização.</p>
        <p>📞 (98) 3089-4122<br>📧 contato@clinicacrescerbem.com.br</p>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px; font-size: 18px;">Serviços</h4>
        <ul style="list-style: none; padding: 0;">
          <li><a href="../index.php#servicos" style="color: #fff; text-decoration: none;">Psicologia Infantil</a></li>
          <li><a href="../index.php#servicos" style="color: #fff; text-decoration: none;">Fonoaudiologia</a></li>
          <li><a href="../index.php#servicos" style="color: #fff; text-decoration: none;">Terapia Ocupacional</a></li>
          <li><a href="../index.php#servicos" style="color: #fff; text-decoration: none;">Apoio Pedagógico</a></li>
          <li><a href="../blog.php" style="color: #fff; text-decoration: none;">Blog Educativo</a></li>
        </ul>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px; font-size: 18px;">Institucional</h4>
        <ul style="list-style: none; padding: 0;">
          <li><a href="../index.php#sobre" style="color: #fff; text-decoration: none;">Sobre Nós</a></li>
          <li><a href="agendamento.php" style="color: #fff; text-decoration: none;">Agendamento</a></li>
          <li><a href="../index.php#contato" style="color: #fff; text-decoration: none;">Contato</a></li>
          <li><a href="#" style="color: #fff; text-decoration: none;">Política de Privacidade</a></li>
        </ul>
      </div>
      <div style="flex: 1 1 250px; max-width: 300px;">
        <h4 style="margin-bottom: 15px; font-size: 18px;">Redes Sociais</h4>
        <div style="display: flex; gap: 10px; align-items: center;">
          <a href="https://www.instagram.com/clinicacrescerbem" target="_blank" rel="noopener">
            <img src="../assets/img/instagram.png" alt="Instagram" style="width: 28px; height: 28px; object-fit: contain;">
          </a>
          <a href="https://www.facebook.com/clinicacrescerbem" target="_blank" rel="noopener">
            <img src="../assets/img/facebook.png" alt="Facebook" style="width: 28px; height: 28px; object-fit: contain;">
          </a>
          <a href="https://www.linkedin.com/company/clinicacrescerbem" target="_blank" rel="noopener">
            <img src="../assets/img/linkedin.png" alt="LinkedIn" style="width: 28px; height: 28px; object-fit: contain;">
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
