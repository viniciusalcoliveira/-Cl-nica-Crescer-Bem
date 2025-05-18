<?php
$conn = new mysqli('localhost', 'root', '', 'clinica_modelar');
if ($conn->connect_error) die('Erro na conexão: ' . $conn->connect_error);

$resp = $_POST['responsavel'];
$crianca = $_POST['crianca'];
$idade = $_POST['idade'];
$comportamento = $_POST['comportamento'];
$historico = $_POST['historico'];

$sql = "INSERT INTO anamnese (responsavel, crianca, idade, comportamento, historico)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiss", $resp, $crianca, $idade, $comportamento, $historico);
$stmt->execute();
echo "Anamnese registrada com sucesso!";
?>