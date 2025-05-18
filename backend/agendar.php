<?php
session_start();
require_once("../backend/conectar.php");

function limpar($valor) {
  return htmlspecialchars(trim($valor));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = limpar($_POST['nome']);
  $email = limpar($_POST['email']);
  $telefone = limpar($_POST['telefone']);
  $servico = limpar($_POST['servico']); // especialidade
  $profissional_id = intval($_POST['profissional_id']);
  $data = limpar($_POST['data']);
  $hora = limpar($_POST['hora']);

  $cliente_id = $_SESSION['usuario_id'] ?? null;

  if (!$cliente_id || !$nome || !$email || !$telefone || !$servico || !$profissional_id || !$data || !$hora) {
    header("Location: ../pages/agendamento.php?status=erro");
    exit;
  }
  

  // Verifica se o horário já está ocupado
  $verifica = $conn->prepare("SELECT id FROM agendamentos WHERE profissional_id = ? AND data = ? AND hora = ?");
  $verifica->bind_param("iss", $profissional_id, $data, $hora);
  $verifica->execute();
  $verifica->store_result();

  if ($verifica->num_rows > 0) {
    header("Location: ../pages/agendamento.php?status=conflito");
    exit;
  }

  // Insere agendamento
  $stmt = $conn->prepare("INSERT INTO agendamentos (cliente_id, profissional_id, data, hora, status) VALUES (?, ?, ?, ?, 'pendente')");
  $stmt->bind_param("iiss", $cliente_id, $profissional_id, $data, $hora);

  if ($stmt->execute()) {
    header("Location: ../pages/agendamento.php?status=sucesso");
  } else {
    header("Location: ../pages/agendamento.php?status=erro");
  }
  exit;
}
?>
