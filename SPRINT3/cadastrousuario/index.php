<?php
include '../connection.php';

$mensagem = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($email == "" || $senha == "") {
        $mensagem = "Campos nulos. Insira novamente";
    } else {
    // Verifica se o e-mail já está cadastrado
    $verifica = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = $conn->query($verifica);

    if ($resultado && $resultado->num_rows > 0) {
        $mensagem = "Este e-mail já está cadastrado.";
    } else {
        // Insere novo usuário
        $sql = "INSERT INTO usuario (email, senha) VALUES ('$email', '$senha')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../login/index.php");
            $mensagem = "Usuário cadastrado com sucesso!<br><a href='../login/index.php'>Fazer login</a>";
        } else {
            $mensagem = "Erro ao cadastrar: " . $conn->error;
        }
    }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro - Cervejaria Dogma</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="../assets/favicon-dogma.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <main>
        <img src="../assets/logo.png" alt="Logotipo da Cervejaria Dogma" />
        <h1>Cadastre-se</h1>
        <form method="POST" action="../cadastrousuario/index.php">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Cadastrar</button>
        </form>

        <footer>
                <ul>
                    <li><a href="#">Política de privacidade</a></li>
                    <li><a href="#">Termos de serviço</a></li>
                    <li><a href="../login/">Já tem uma conta?</a></li>
                </ul>
            <div class="alert alert-info">
                <?php if (!empty($mensagem)) echo $mensagem; ?>
            </div>
        </footer>
    </main>
</body>

</html>