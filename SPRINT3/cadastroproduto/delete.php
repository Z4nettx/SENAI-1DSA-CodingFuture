<?php

include '../connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM cadastroprodutos WHERE ProdutoID=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}
