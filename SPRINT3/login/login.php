<?php
include '../connection.php';

$mensagem = ''; // variável para exibir no HTML

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Verifica se o usuário existe
    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        // Login válido → redireciona
        header("Location: ../paineladmin/index.php");
        exit;
    } else {
        header("Location: erro.php");
    }
}

