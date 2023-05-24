<?php

require_once 'conexao.php';
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // recebe os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];
	$avaliacao = $_POST["rating"];
    $mensagem = $_POST["mensagem"];

    // prepara a instrução SQL para inserir os dados no banco de dados
    $sql = "INSERT INTO avaliacoes (nome, email, telefone, data_nascimento, avaliacao, mensagem) VALUES ('$nome', '$email', '$telefone', '$data_nascimento', '$avaliacao', '$mensagem')";

    // executa a instrução SQL
    if ($conn->query($sql) === TRUE) {
			echo "<script>";
			echo "alert('SUA AVALIÇÂO FOI COMPUTADA COM SUCESSO');";
			echo "</script>";
			header("Location: formulario.html");
			exit();
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}

// fecha a conexão com o banco de dados
$conn->close();

?>
