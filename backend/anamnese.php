<?php
session_start();
require_once("conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        // Redireciona com erro se não estiver logado
        header("Location: ../pages/anamnese.php?erro=nao_logado");
        exit;
    }

    $cliente_id = $_SESSION['user_id'];
    $crianca = $_POST['crianca'];
    $idade = $_POST['idade'];
    $comportamento = $_POST['comportamento'];
    $historico = $_POST['historico'];

    $stmt = $conn->prepare("INSERT INTO anamnese (cliente_id, crianca_nome, idade, comportamento, historico) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isiss", $cliente_id, $crianca, $idade, $comportamento, $historico);
    $stmt->execute();

    header("Location: ../pages/anamnese.php?enviado=1");
    exit;
}
?>
