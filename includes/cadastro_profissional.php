<?php
$conn = new mysqli('localhost', 'root', '', 'clinica_modelar');
if ($conn->connect_error) die('Erro na conexão: ' . $conn->connect_error);

$nome = $_POST['nome'];
$especialidade = $_POST['especialidade'];
$crp = $_POST['crp'];

$sql = "INSERT INTO profissionais (nome, especialidade, crp) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $especialidade, $crp);
$stmt->execute();
echo "Profissional cadastrado com sucesso!";
?>