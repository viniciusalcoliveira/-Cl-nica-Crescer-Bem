<?php
session_start();
require_once("../backend/conectar.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
  header("Location: ../index.php");
  exit;
}

$id = intval($_GET['id'] ?? 0);
$acao = $_GET['acao'] ?? '';

if (!$id || !in_array($acao, ['confirmar', 'cancelar'])) {
  header("Location: painel_profissional.php");
  exit;
}

$status = $acao === 'confirmar' ? 'confirmado' : 'cancelado';

$stmt = $conn->prepare("UPDATE agendamentos SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $id);
$stmt->execute();

header("Location: painel_profissional.php");
exit;
