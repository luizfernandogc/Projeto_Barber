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

// Função para salvar os dados
function salvarDados() {
  global $conn;

  // Obtém os dados do formulário
  $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
  $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
  $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '';
  $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
  $debitos = isset($_POST['debitos']) ? $_POST['debitos'] : '';
  $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $foto = isset($_POST['foto']) ? $_POST['foto'] : '';

  // Verifica se o CPF existe no banco de dados
  $sql = "SELECT * FROM clientes WHERE CPF = '$cpf'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // CPF encontrado, atualiza os dados
    $sql = "UPDATE clientes SET NOME_CLIENTE = '$nome', SOBRENOME_CLIENTE = '$sobrenome', ID_SEXO = '$sexo', DEBITOS = '$debitos', CELULAR = '$celular', EMAIL = '$email', FOTO_CLIENT = '$foto' WHERE CPF = '$cpf'";
    $result = $conn->query($sql);

    if ($result) {
      // Sucesso ao atualizar os dados
      $response = array(
        'success' => true,
        'message' => 'Dados atualizados com sucesso.',
        'sexos' => obterSexos() // Obtém os sexos e os inclui na resposta
      );
    } else {
      // Erro ao atualizar os dados
      $response = array(
        'success' => false,
        'message' => 'Erro ao atualizar os dados.'
      );
    }
  } else {
    // CPF não encontrado, retorna mensagem de erro
    $response = array(
      'success' => false,
      'message' => 'CPF não encontrado.'
    );
  }

  // Retorna a resposta como JSON
  header('Content-Type: application/json');
  echo json_encode($response);

  // Fecha a conexão com o banco de dados
  $conn->close();
}

// Verifica se a requisição é do tipo GET para obter os sexos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  // Retorna os sexos como resposta JSON
  header('Content-Type: application/json');
  echo json_encode(obterSexos());

  // Fecha a conexão com o banco de dados
  $conn->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Chama a função para salvar os dados
  salvarDados();
}

?>
