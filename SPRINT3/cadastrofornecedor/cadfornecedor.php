<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $endereco = $_POST['endereço'] ?? '';
    $email = $_POST['email'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    $estado = $_POST['estado'] ?? '';

    $sql = "INSERT INTO cadastrofornecedores (nome, pais, endereço, email, cnpj, observacoes, estado) VALUES ('$nome','$pais','$endereco', '$email', '$cnpj','$observacoes','$estado')";

    if ($conn->query($sql) === TRUE) {
        header('Location: cadastrado.php');
    } else {
        echo "Erro: " . $conn->error;
    }

    
}

// $conn->close();
