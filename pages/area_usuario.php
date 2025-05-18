<?php
session_start();

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_tipo'])) {
  header("Location: ../index.php");
  exit;
}

$tipo = $_SESSION['usuario_tipo'];

if ($tipo === 'cliente' || $tipo === 'paciente' || $tipo === 'responsavel') {
  header("Location: area_paciente.php");
} elseif ($tipo === 'profissional') {
  header("Location: painel_profissional.php");
} else {
  echo "Tipo de usuário desconhecido.";
}
exit;
?>
