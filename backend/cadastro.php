<?php
require_once 'conectar.php';
header('Content-Type: application/json');

function limpar($dado) {
  return htmlspecialchars(trim($dado));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tipo = limpar($_POST['tipo']);
  $nome = limpar($_POST['nome']);
  $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf'] ?? '');
  $email = limpar($_POST['email']);
  $telefone = preg_replace('/[^0-9]/', '', $_POST['telefone'] ?? '');
  $data_nascimento = limpar($_POST['data_nascimento']);
  $genero = limpar($_POST['genero']);
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

  $endereco = limpar($_POST['endereco']);
  $numero = limpar($_POST['numero']);
  $complemento = limpar($_POST['complemento']);
  $bairro = limpar($_POST['bairro']);
  $cidade = limpar($_POST['cidade']);
  $estado = limpar($_POST['estado']);
  $cep = preg_replace('/[^0-9]/', '', $_POST['cep'] ?? '');
  $contato_preferencial = limpar($_POST['contato_preferencial']);
  $horario_contato = limpar($_POST['horario_contato']);
  $nome_filho = $tipo === 'responsavel' ? limpar($_POST['nome_filho'] ?? '') : null;

  // Conexão com banco
  $conn = new mysqli("localhost", "root", "", "clinica_modelar"); // ajuste o nome do banco se necessário

  if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Erro na conexão com o banco.']);
    exit;
  }

  // Verificação de e-mail
  $checkEmail = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
  $checkEmail->bind_param("s", $email);
  $checkEmail->execute();
  $checkEmail->store_result();
  if ($checkEmail->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'E-mail já cadastrado.']);
    exit;
  }

  // Verificação de CPF
  $checkCpf = $conn->prepare("SELECT id FROM usuarios WHERE cpf = ?");
  $checkCpf->bind_param("s", $cpf);
  $checkCpf->execute();
  $checkCpf->store_result();
  if ($checkCpf->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'CPF já cadastrado.']);
    exit;
  }

  // Inserção na tabela usuarios
  $sql = "INSERT INTO usuarios (
    tipo, nome, cpf, email, telefone, data_nascimento, genero, senha_hash, 
    endereco, numero, complemento, bairro, cidade, estado, cep, 
    contato_preferencial, horario_contato, nome_filho
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssssssssssssss",
    $tipo, $nome, $cpf, $email, $telefone, $data_nascimento, $genero, $senha,
    $endereco, $numero, $complemento, $bairro, $cidade, $estado, $cep,
    $contato_preferencial, $horario_contato, $nome_filho
  );

  if ($stmt->execute()) {
    $usuario_id = $stmt->insert_id;

    if ($tipo === 'profissional') {
      $crm = limpar($_POST['crm']);
      $especialidade = strtolower(trim($_POST['especialidade']));
      $bio = limpar($_POST['bio']);

      $sqlProf = "INSERT INTO profissionais (usuario_id, crp, especialidade, experiencia, bio) 
                  VALUES (?, ?, ?, '', ?)";
      $stmtProf = $conn->prepare($sqlProf);
      $stmtProf->bind_param("isss", $usuario_id, $crm, $especialidade, $bio);
      $stmtProf->execute();

      $prof_id = $stmtProf->insert_id;

      $dias = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'];
      foreach ($dias as $dia) {
        $inicio = $_POST[$dia . '_inicio'] ?? '';
        $fim = $_POST[$dia . '_fim'] ?? '';
        if (!empty($inicio) && !empty($fim)) {
          $sqlH = "INSERT INTO horarios_disponiveis (profissional_id, dia_semana, hora_inicio, hora_fim)
                   VALUES (?, ?, ?, ?)";
          $stmtH = $conn->prepare($sqlH);
          $diaSemanaFormatado = ucfirst($dia);
          $stmtH->bind_param("isss", $prof_id, $diaSemanaFormatado, $inicio, $fim);
          $stmtH->execute();
        }
      }
    }

    echo json_encode(['status' => 'success', 'message' => 'Cadastro realizado com sucesso.']);
    exit;

  } else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar no banco.']);
    exit;
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Requisição inválida.']);
}
