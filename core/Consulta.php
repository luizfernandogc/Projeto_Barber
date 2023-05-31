<?php

// inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Função para consultar o CPF no banco de dados
function consultarCPF($cpf) {
  global $conn;

  // Verifica se o CPF foi encontrado
  $sql = "SELECT c.*, s.DESCRICAO AS SEXO FROM clientes c JOIN sexo s ON c.ID_SEXO = s.ID_SEXO WHERE CPF = '$cpf'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // CPF encontrado
    $row = $result->fetch_assoc();

    $resultado = [
      "nome" => $row["NOME_CLIENTE"],
      "cpf" => $cpf,
      "sobrenome" => $row["SOBRENOME_CLIENTE"],
      "sexo" => $row["SEXO"],
      "debitos" => $row["DEBITOS"],
      "celular" => $row["CELULAR"],
      "email" => $row["EMAIL"],
      "foto" => $row["FOTO_CLIENT"]
    ];

    return $resultado;
  } else {
    // CPF não encontrado
    return null;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cpf = $_POST["cpf"];

  // Chama a função para consultar o CPF
  $resultado = consultarCPF($cpf);

  if ($resultado) {
    // CPF encontrado
    $response = [
      "nome" => $resultado["nome"],
      "cpf" => $resultado["cpf"],
      "sobrenome" => $resultado["sobrenome"],
      "sexo" => $resultado["sexo"],
      "debitos" => $resultado["debitos"],
      "celular" => $resultado["celular"],
      "email" => $resultado["email"],
      "foto" => $resultado["foto"]
    ];

    // Retorna a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
  } else {
    // CPF não encontrado
    header('Content-Type: application/json');
    echo json_encode(["error" => "CPF não encontrado"]);
  }
}


// fecha a conexão com o banco de dados
$conn->close();

?>