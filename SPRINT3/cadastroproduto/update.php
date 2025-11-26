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

    <!-- FORM INICIA AQUI (com enctype correto) -->
    <form class="form" action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $produto['ProdutoID'] ?>">

        <main>
            <section>
                <div class="alert alert-info">
                    <i class="fa-solid fa-circle-info"></i>
                    <p m-0>Atualize o Produto: <?= $produto['Nome'] ?></p>
                </div>
                <form class="form" action="cadproduto.php" method="POST" enctype="multipart/form-data">
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
                    <input type="number" steps="0.01" id="preco" placeholder="Preço: apenas números" name="preco" required>

                    <label for="desc">Descrição:</label>
                    <textarea name="descricao" id="desc" placeholder="Descrição do produto" required></textarea>

                    <label for="imagem">Adicionar imagem: (apenas PNG ou JPG/JPEG)</label>
                    <div class="container">
                        <label for="imagem"><i class="fa-solid fa-arrow-up-from-bracket"></i></label>
                        <input type="file" name="imagem" id="imagem" accept="image/*" hidden>
                    </div>
                    <button type="submit">Salvar Informações</button>
                </form>
            </section>
</body>

</html>