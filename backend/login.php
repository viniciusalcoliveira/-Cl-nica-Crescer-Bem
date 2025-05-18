<?php
session_start();
require_once 'conectar.php';

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM usuarios WHERE email = ? OR nome = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
  if (password_verify($senha, $row['senha_hash'])) {
    // Sessões
    $_SESSION['usuario_id'] = $row['id'];
    $_SESSION['usuario_nome'] = $row['nome'];
    $_SESSION['usuario_tipo'] = $row['tipo']; // ✅ Correto agora

    // Redirecionamento
    if ($row['tipo'] === 'admin') {
      header("Location: ../admin/dashboard.php");
    } else {
      header("Location: ../index.php");
    }
    exit;
  }
}

// Falha no login
echo "<script>alert('Usuário ou senha inválidos'); window.history.back();</script>";
exit;
?>
