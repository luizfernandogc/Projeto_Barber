<?php
// inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Função para deletar o CPF no banco de dados
function deletarCPF($cpf) {
  global $conn;

  // Verifica se o CPF existe no banco de dados
  $sql = "SELECT * FROM CLIENTES WHERE CPF = '$cpf'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // CPF encontrado, realiza a exclusão
    $deleteSql = "DELETE FROM CLIENTES WHERE CPF = '$cpf'";
    if ($conn->query($deleteSql) === TRUE) {
      return true;
    } else {
      return false;
    }
  } else {
    // CPF não encontrado
    return false;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cpf = $_POST["cpf"];

  // Chama a função para deletar o CPF
  if (deletarCPF($cpf)) {
    echo "CPF deletado com sucesso!";
  } else {
    echo "Falha ao deletar o CPF.";
  }
}

// fecha a conexão com o banco de dados
$conn->close();

?>