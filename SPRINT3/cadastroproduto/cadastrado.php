<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos - Cervejaria Dogma</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../assets/favicon-dogma.ico" type="image/x-icon">
</head>

<body>
    <header>
        <img src="../assets/logo.png" alt="Logo">
    </header>
    <main>
        <section>
            <a href="../paineladmin/index.php" class="back-button">
                    <i class="fa-solid fa-arrow-left" title="Voltar"></i>
                </a>

                <h2>Cadastro de Produto</h2>
            <form class="form" action="cadproduto.php" method="POST" enctype="multipart/form-data">
                <label for="fornecedor">Fornecedor:</label>
                <select id="fornecedor" name="fornecedor" required>
                    <option value="" selected disabled>Selecione o nome do fornecedor:</option>

                    <?php
                    include '../connection.php';
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
                <input type="number" step="0.01" id="preco" placeholder="Preço: apenas números" name="preco" required>

                <label for="desc">Descrição:</label>
                <textarea name="descricao" id="desc" placeholder="Descrição do produto" required></textarea>

                <label for="imagem">Adicionar imagem:</label>
                <div class="container">
                    <label for="imagem"><i class="fa-solid fa-arrow-up-from-bracket"></i></label>
                    <input type="file" name="imagem" id="imagem" accept="image/*" hidden>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </section>
        <section>
            <h2>Listagem do Produto</h2>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Quantidade Estoque</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Fornecedor</th>
                            <th>Imagem</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <?php
                    include '../connection.php';
                    // Query correta
                    $sql = "SELECT * FROM cadastrofornecedores ORDER BY FornecedorID ASC";
                    $result = $conn->query($sql);
                    ?>
                    <tbody>
                        <tr>
                            <?php
                            $sql = "
                                        SELECT 
                                            p.ProdutoID,
                                            p.Nome,
                                            p.qtd_estoque,
                                            p.Descricao,
                                            p.Preco,
                                            f.Nome AS FornecedorNome,
                                            p.Imagem
                                        FROM cadastroprodutos p
                                        INNER JOIN cadastrofornecedores f
                                        ON p.Fornecedor = f.FornecedorID
                                        ORDER BY p.ProdutoID ASC
                                        ";


                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()):
                            ?>
                                <td><?= $row['ProdutoID'] ?></td>
                                <td><?= $row['Nome'] ?></td>
                                <td><?= $row['qtd_estoque'] ?></td>
                                <td><?= $row['Descricao'] ?></td>
                                <td><?= $row['Preco'] ?></td>
                                <td><?= $row['FornecedorNome'] ?></td>
                                <td>
                                    <img src="<?= $row['Imagem'] ?>" alt="">
                                </td>
                                <td class="actions">
                                    <a href="update.php?id=<?= $row['ProdutoID'];  ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="delete.php?id=<?= $row['ProdutoID'];  ?>"><i class="fa-solid fa-trash"></i></a>
                                </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>