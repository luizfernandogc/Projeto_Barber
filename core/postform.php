<?php

// inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    // prepara a instrução SQL para inserir os dados no banco de dados
    $sql = "INSERT INTO sua_tabela (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";

    // executa a instrução SQL
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}

// fecha a conexão com o banco de dados
$conn->close();

?>