<?php
include '../connection.php';
$produto = $produto ?? null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM cadastroprodutos WHERE ProdutoID = $id";
    $result = $conn->query($sql);
    $produto = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fornecedor = $_POST["fornecedor"];
    $nome = $_POST["nome"];
    $qtd_estoque = $_POST["qtd_estoque"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];

    $sql = "SELECT * FROM cadastroprodutos WHERE ProdutoID = $id";
    $result = $conn->query($sql);


    // Mantém a imagem atual
    $imagem = $produto['Imagem'];


    // Se o usuário enviou uma imagem, apenas salva do jeito que vier
    if (!empty($_FILES['imagem']['name'])) {

        if (!is_dir("img")) {
            mkdir("img", 0777, true);
        }

        $nomeArquivo = $_FILES['imagem']['name'];
        $caminhoTemp = $_FILES['imagem']['tmp_name'];

        // salva dentro da pasta img/ com o nome original
        $caminhoFinal = "img/" . $nomeArquivo;

        move_uploaded_file($caminhoTemp, $caminhoFinal);

        $imagem = $caminhoFinal;
    }

    $sql = "UPDATE cadastroprodutos 
SET Fornecedor='$fornecedor', Nome='$nome', Descricao='$descricao', Preco='$preco', Imagem='$imagem'
WHERE ProdutoID = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervejaria Dogma - Cadastro Produto</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../assets/favicon-dogma.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <header>
        <img src="../assets/logo.png" alt="Logo">
    </header>
    <main>
        <section id="sec1">
            <form action="cadfornecedor.php" method="post" enctype="multipart/form-data">
                <div>
                    <a href="../paineladmin/index.php" class="voltar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#9F6C54" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288 480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 105.4-105.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                        </svg></a>
                    <h2>Atualize o Produto <?= $produto['nome'] ?></h2>
                </div>
                <label for="fornecedor">Fornecedor:</label>
                <select id="fornecedor" name="fornecedor" required>
                    <option value="" selected disabled>Selecione o nome do fornecedor:</option>

                    <?php
                    include 'connection.php';
                    $sql = "SELECT FornecedorID, Nome FROM cadastrofornecedores";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['FornecedorID']}'>{$row['Nome']}</option>";
                    }
                    ?>
                </select>

                <label for="name">Nome do produto:</label>
                <input type="text" id="name" name="nome" placeholder="Nome do Produto" required>

                <label for="estoque">Quantidade em Estoque: (apenas números)</label>
                <input type="number" name="qtd_estoque" id="estoque" placeholder="Digite a quantidade de estoque do produto" required>

                <label for="preco">Preço:</label>
                <input type="number" steps="0.01" id="preco" placeholder="Preço: apenas números" name="preco" value="<?= $produto['nome'] ?> ?>" required>

                <label for="desc">Descrição:</label>
                <textarea name="descricao" id="desc" placeholder="Descrição do produto" required></textarea>

                <label for="imagem">Adicionar imagem: (apenas PNG ou JPG/JPEG)</label>
                <div class="container">
                    <label for="imagem"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                            <path d="M342.6 73.4C330.1 60.9 309.8 60.9 297.3 73.4L169.3 201.4C156.8 213.9 156.8 234.2 169.3 246.7C181.8 259.2 202.1 259.2 214.6 246.7L288 173.3L288 384C288 401.7 302.3 416 320 416C337.7 416 352 401.7 352 384L352 173.3L425.4 246.7C437.9 259.2 458.2 259.2 470.7 246.7C483.2 234.2 483.2 213.9 470.7 201.4L342.7 73.4zM160 416C160 398.3 145.7 384 128 384C110.3 384 96 398.3 96 416L96 480C96 533 139 576 192 576L448 576C501 576 544 533 544 480L544 416C544 398.3 529.7 384 512 384C494.3 384 480 398.3 480 416L480 480C480 497.7 465.7 512 448 512L192 512C174.3 512 160 497.7 160 480L160 416z" />
                        </svg></label>
                    <input type="file" name="imagem" id="imagem" accept="image/*" hidden>
                </div>
                <button type="submit">Salvar Informações</button>
            </form>
        </section>
</body>

</html>