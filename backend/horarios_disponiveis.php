<?php
require_once 'conectar.php';
header('Content-Type: application/json');

$profissional_id = $_GET['profissional_id'] ?? null;
$data = $_GET['data'] ?? null;

if (!$profissional_id || !$data) {
  echo json_encode([]);
  exit;
}

// Converter data em dia da semana (em inglês)
$dia_semana = strtolower(date('l', strtotime($data)));
$mapa = [
  'monday' => 'segunda', 'tuesday' => 'terca', 'wednesday' => 'quarta',
  'thursday' => 'quinta', 'friday' => 'sexta', 'saturday' => 'sabado',
  'sunday' => 'domingo'
];
$dia_convertido = $mapa[$dia_semana] ?? '';

if (empty($dia_convertido)) {
  echo json_encode([]);
  exit;
}

// Buscar horário disponível
$sql = "SELECT hora_inicio, hora_fim FROM horarios_disponiveis 
        WHERE profissional_id = ? AND LOWER(dia_semana) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $profissional_id, $dia_convertido);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
  echo json_encode([]);
  exit;
}

$row = $res->fetch_assoc();
$inicio_ts = strtotime($row['hora_inicio']);
$fim_ts = strtotime($row['hora_fim']);

$horarios = [];
for ($ts = $inicio_ts; $ts < $fim_ts; $ts += 1800) {
  $hora = date('H:i', $ts);

  // Verifica se já está agendado
  $check = $conn->prepare("SELECT id FROM agendamentos WHERE profissional_id = ? AND data = ? AND hora = ?");
  $check->bind_param("iss", $profissional_id, $data, $hora);
  $check->execute();
  $check->store_result();

  if ($check->num_rows === 0) {
    $horarios[] = $hora;
  }
}

echo json_encode($horarios);
exit;
