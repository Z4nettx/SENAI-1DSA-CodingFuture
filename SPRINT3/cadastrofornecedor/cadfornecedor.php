<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $email = $_POST['email'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    $estado = $_POST['estado'] ?? '';

    $sql = "INSERT INTO cadastrofornecedores (Nome, Pais, Endereco, email, CNPJ, Observacoes, Estado) VALUES ('$nome','$pais','$endereco', '$email', '$cnpj','$observacoes','$estado')";

    if ($conn->query($sql) === TRUE) {
        header('Location: cadastrado.php');
    } else {
        echo "Erro: " . $conn->error;
    }   
}
