<?php

// dados de conexão com o banco de dados
$ip = "localhost";
$usuario = "root";
$senha = "";
$database= "barbearia";

// cria a conexão com o banco de dados
$conn = new mysqli($ip, $usuario, $senha, $database);

// verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>