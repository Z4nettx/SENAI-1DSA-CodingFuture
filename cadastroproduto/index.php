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
        <section id="sec1">
            <form action="cadproduto.php" method="post" enctype="multipart/form-data">
                <div>
                    <a href="../paineladmin/index.php" class="voltar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#9F6C54" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288 480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 105.4-105.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                        </svg></a>
                    <h2>Cadastro de Produtos</h2>
                </div>
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
                <label for="name">Nome do Produto:</label>
                <input type="text" id="name" name="nome" placeholder="Nome do Produto" required>

                <label for="estoque">Quantidade em Estoque (apenas números):</label>
                <input type="number" name="qtd_estoque" id="estoque" placeholder="Digite a quantidade de estoque do produto" maxlength="11" required>

                <label for="preco">Preço:</label>
                <input type="number" step="0.01" id="preco" placeholder="Preço: apenas números" name="preco" required>

                <label for="desc">Descrição:</label>
                <textarea name="descricao" id="desc" placeholder="Descrição do produto" required></textarea>

                <label for="imagem">Adicionar imagem (apenas PNG ou JPG/JPEG): </label>
                <div class="container">
                    <label for="imagem"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                            <path d="M342.6 73.4C330.1 60.9 309.8 60.9 297.3 73.4L169.3 201.4C156.8 213.9 156.8 234.2 169.3 246.7C181.8 259.2 202.1 259.2 214.6 246.7L288 173.3L288 384C288 401.7 302.3 416 320 416C337.7 416 352 401.7 352 384L352 173.3L425.4 246.7C437.9 259.2 458.2 259.2 470.7 246.7C483.2 234.2 483.2 213.9 470.7 201.4L342.7 73.4zM160 416C160 398.3 145.7 384 128 384C110.3 384 96 398.3 96 416L96 480C96 533 139 576 192 576L448 576C501 576 544 533 544 480L544 416C544 398.3 529.7 384 512 384C494.3 384 480 398.3 480 416L480 480C480 497.7 465.7 512 448 512L192 512C174.3 512 160 497.7 160 480L160 416z" />
                        </svg></label>
                    <input type="file" name="imagem" id="imagem" accept="image/*" hidden>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </section>
        <section id="sec2">
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
                                    <a href="update.php?id=<?= $row['ProdutoID']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="#9f6c54" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L368 46.1 465.9 144 490.3 119.6c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L432 177.9 334.1 80 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                                        </svg></a>
                                    <a href="delete.php?id=<?= $row['ProdutoID']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="#900909" d="M136.7 5.9L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-8.7-26.1C306.9-7.2 294.7-16 280.9-16L167.1-16c-13.8 0-26 8.8-30.4 21.9zM416 144L32 144 53.1 467.1C54.7 492.4 75.7 512 101 512L347 512c25.3 0 46.3-19.6 47.9-44.9L416 144z" />
                                        </svg></a>
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