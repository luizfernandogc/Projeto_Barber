<?php
/*
// inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cpf = $_POST["cpf"];

  // Realize aqui a lógica de consulta do CPF no banco de dados ou qualquer outra fonte de dados

  // Verifica se o CPF foi encontrado
  $sql = "SELECT * FROM clientes WHERE cpf = $cpf";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // CPF encontrado
    $row = $result->fetch_assoc();

    $resultado = [
      "sexo" => $row["sexo"],
      "cpf" => $cpf,
    ];

    // Exibir os dados do cliente
    echo "CPF encontrado:<br>";
    echo "Nome: " . $resultado["sexo"] . "<br>";
    echo "CPF: " . $resultado["cpf"] . "<br>";
  } else {
    // CPF não encontrado
    echo "CPF não encontrado";
  }
}

// fecha a conexão com o banco de dados
$conn->close();


?>*/


// inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Função para consultar o CPF no banco de dados
function consultarCPF($cpf) {
  global $conn;

  // Verifica se o CPF foi encontrado
  $sql = "SELECT * FROM CLIENTES WHERE CPF = '$cpf'";
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
    echo "CPF encontrado:<br>";
    echo "Nome: " . $resultado["nome"] . "<br>";
    echo "CPF: " . $resultado["cpf"] . "<br>";
    echo "Sobrenome: " . $resultado["sobrenome"] . "<br>";
    echo "Sexo: " . $resultado["sexo"] . "<br>";
    echo "Débitos: " . $resultado["debitos"] . "<br>";
    echo "Celular: " . $resultado["celular"] . "<br>";
    echo "Email: " . $resultado["email"] . "<br>";
    echo "Foto: " . $resultado["foto"] . "<br>";
  } else {
    // CPF não encontrado
    echo "CPF não encontrado";
  }
}

// fecha a conexão com o banco de dados
$conn->close();

?>