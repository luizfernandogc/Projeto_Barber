<?php

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Função para obter os tipos de sexo
function obterSexos() {
  global $conn;

  $sexos = array();

  // Consulta os tipos de sexo no banco de dados
  $sql = "SELECT * FROM sexo";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $sexos[$row['ID_SEXO']] = $row['DESCRICAO'];
    }
  }

  return $sexos;
}

// Monta a resposta com os sexos obtidos
$response = array(
  'success' => true,
  'sexos' => obterSexos()
);

// Retorna a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Fecha a conexão com o banco de dados
$conn->close();
?>
