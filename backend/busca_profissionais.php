<?php
$conn = new mysqli('localhost', 'root', '', 'clinica_modelar');
if ($conn->connect_error) die('Erro na conexão: ' . $conn->connect_error);

$busca = "%" . $_GET['q'] . "%";
$sql = "SELECT nome, especialidade, crp FROM profissionais WHERE nome LIKE ? OR especialidade LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $busca, $busca);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    echo "Nome: " . $row['nome'] . "<br>Especialidade: " . $row['especialidade'] . "<br>CRP: " . $row['crp'] . "<br><br>";
}
?>