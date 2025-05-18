<?php
session_start();
require_once("conectar.php");

if ($_SESSION['user_type'] !== 'admin') {
    die("Acesso restrito.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    $crp = $_POST['crp'];
    $especialidade = $_POST['especialidade'];

    // 1. Cria usuário
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha_hash, tipo) VALUES (?, ?, ?, 'profissional')");
    $stmt->bind_param("sss", $nome, $email, $senha);
    $stmt->execute();
    $usuario_id = $stmt->insert_id;

    // 2. Cria profissional
    $stmt2 = $conn->prepare("INSERT INTO profissionais (usuario_id, crp, especialidade) VALUES (?, ?, ?)");
    $stmt2->bind_param("iss", $usuario_id, $crp, $especialidade);
    $stmt2->execute();

    echo "Profissional cadastrado com sucesso!";
}
?>
