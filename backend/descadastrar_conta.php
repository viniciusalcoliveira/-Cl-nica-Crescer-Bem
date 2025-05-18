<?php
session_start();
require_once("conectar.php");

if (!isset($_SESSION['user_id'])) {
    die("Você precisa estar logado.");
}

$id = $_SESSION['user_type'] === 'admin' && isset($_GET['id']) ? $_GET['id'] : $_SESSION['user_id'];

$stmt = $conn->prepare("UPDATE usuarios SET ativo = 0 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo "Conta desativada com sucesso.";
?>
