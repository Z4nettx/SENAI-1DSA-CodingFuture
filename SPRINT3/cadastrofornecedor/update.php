<?php
include '../connection.php';
$fornecedor = $fornecedor ?? null;

// Carrega os dados quando existe ?id=X
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM cadastrofornecedores WHERE FornecedorID = $id";
    $result = $conn->query($sql);
    $fornecedor = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST["nome"];
        $pais = $_POST["pais"];
        $endereco = $_POST["endereco"];
        $email = $_POST["email"];
        $cnpj = $_POST["cnpj"];
        $estado = $_POST["estado"];
        $observacoes = $_POST["observacoes"];

        $sql = "UPDATE cadastrofornecedores 
            SET 
                Nome = '$nome',
                Pais = '$pais',
                Endereco = '$endereco',
                email = '$email',
                CNPJ = '$cnpj',
                Estado = '$estado',
                Observacoes = '$observacoes'
            WHERE FornecedorID = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao atualizar: " . $conn->error;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Editar Fornecedor</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
        <img src="../assets/logo.png" alt="Logo Dogma">
    </header>
    <main>
        <section id="sec1">
            <form method="post">
                <div>
                    <a href="../cadastrofornecedor/index.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#9F6C54" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288 480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 105.4-105.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                        </svg></a>
                    <h2>Edite o Fornecedor: "<?= $fornecedor['Nome'] ?>"</h2>
                </div>

                <input type="text" name="nome" placeholder="Nome Fornecedor" required>
                <input type="text" name="pais" placeholder="País" required>
                <input type="text" name="endereco" placeholder="Endereco" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="text" name="cnpj" placeholder="CNPJ" maxlength="18" required>
                <input type="text" name="estado" placeholder="Estado" required>
                <textarea name="observacoes" placeholder="Observações" id="observacoes" cols="30" rows="6" required></textarea>
                <button type="submit">Salvar Informações</button>
            </form>
        </section>
    </main>
</body>

</html>