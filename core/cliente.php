<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cpf = $_POST["cpf"];
  $nome = $_POST["nome"];
  $sobrenome = $_POST["sobrenome"];
  $sexo = $_POST["sexo"];
  $debitos = "0";
  $celular = $_POST["celular"];
  $email = $_POST["email"];
  $foto = $_POST["foto"];

  // Verifica se o CPF já existe no banco de dados
  $sql = "SELECT * FROM CLIENTES WHERE CPF = '$cpf'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // CPF já existe, exiba uma mensagem de erro
    $mensagem = "Erro: CPF já cadastrado";
  } else {
    // Insere os dados na tabela CLIENTES
    $sql = "INSERT INTO CLIENTES (CPF, NOME_CLIENTE, SOBRENOME_CLIENTE, ID_SEXO, DEBITOS, CELULAR, EMAIL, FOTO_CLIENT) 
            VALUES ('$cpf','$nome', '$sobrenome', '$sexo', '$debitos', '$celular', '$email', '$foto')";

    if ($conn->query($sql) === TRUE) {
      // Dados inseridos com sucesso
      $mensagem = "Cadastro realizado com sucesso!";
    } else {
      // Erro ao inserir os dados
      $mensagem = "Erro ao realizar o cadastro: " . $conn->error;
    }
  }
}

$conn->close();

echo $mensagem;


?>