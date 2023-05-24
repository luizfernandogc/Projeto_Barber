
<?php
require_once 'conexao.php';
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];
   // $COD_CLIENTE = $_POST["COD"]
    //$NOME_CLIENTE = $_POST["nome"];
   // $SOBRENOME_CLIENTE = $_POST["sobrenome"];
    //$cpf = $_POST["cpf"]
    //$sexo = $_POST["sexo"]
    //$celular = $_POST["celular"];
    //$email = $_POST["email"]

}

if (tipo =="delete") {
    $sql = "DELETE FROM CLIENTES WHERE cpf = '$cpf' ";
    if ($conn->query($sql) === TRUE) {
        echo "Dados apagados com sucesso!";
    } else {
        echo "<script>alert('Erro ao apagar dados')</script>" . $conn->error;
    }
    $conn->close();
}


?>