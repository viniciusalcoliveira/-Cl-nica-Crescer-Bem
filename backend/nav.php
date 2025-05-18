<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$caminhoBase = (str_contains($_SERVER['PHP_SELF'], 'index.php')) ? 'pages/' : '';

if (isset($_SESSION['usuario_tipo'])) {
  $tipo = $_SESSION['usuario_tipo'];

  if ($tipo === 'admin') {
    echo '<a href="' . $caminhoBase . '../admin/dashboard.php" class="nav-btn cadastrar">Dashboard Admin</a>';
  } elseif ($tipo === 'profissional') {
    echo '<a href="' . $caminhoBase . 'painel_profissional.php" class="nav-btn cadastrar">Meu Painel</a>';
  } elseif ($tipo === 'cliente' || $tipo === 'paciente' || $tipo === 'responsavel') {
    echo '<a href="' . $caminhoBase . 'area_paciente.php" class="nav-btn cadastrar">Minhas Consultas</a>';
  }
}

if (isset($_SESSION['usuario_nome'])) {
  echo '<a href="' . $caminhoBase . '../backend/logout.php" class="nav-btn entrar">Sair</a>';
} else {
  echo '<a href="' . $caminhoBase . 'cadastro.html" class="nav-btn cadastrar">Cadastrar</a>';
  echo '<a href="' . $caminhoBase . 'login.html" class="nav-btn entrar">Entrar</a>';
}
?>
