<?php

// inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Função para consultar o CPF no banco de dados
function consultarCPF($cpf) {
  global $conn;

  // Verifica se o CPF foi encontrado
  $sql = "SELECT C.NOME_CLIENTE,C.SOBRENOME_CLIENTE,S.DESCRICAO AS SEXO,C.DEBITOS,C.CELULAR,C.EMAIL,C.FOTO_CLIENT from clientes C join sexo S on C.ID_SEXO = S.ID_SEXO WHERE CPF = '$cpf'";
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
    echo "CPF: " . $resultado["cpf"] . "<br>";
    echo "Nome: " . $resultado["nome"] . "<br>";
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