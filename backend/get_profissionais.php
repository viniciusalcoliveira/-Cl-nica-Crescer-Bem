<?php
require_once 'conectar.php';

header('Content-Type: application/json');

$servico = $_GET['servico'] ?? '';

if (empty($servico)) {
  echo json_encode([]);
  exit;
}

// Garantir que a busca seja case-insensitive
$sql = "SELECT p.id, u.nome 
        FROM profissionais p 
        JOIN usuarios u ON p.usuario_id = u.id 
        WHERE LOWER(p.especialidade) = LOWER(?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $servico);
$stmt->execute();
$result = $stmt->get_result();

$dados = [];
while ($row = $result->fetch_assoc()) {
  $dados[] = $row;
}

echo json_encode($dados);
