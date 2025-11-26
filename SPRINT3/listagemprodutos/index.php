<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervejaria Dogma - Listagem de Produtos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../assets/favicon-dogma.ico" type="image/x-icon">
</head>

<body>
    <header>
        <img src="../assets/logo.png" alt="Logo">
        <h1>LISTAGEM DE PRODUTOS</h1>
    </header>
    <main>
        <section>
            <?php
            include '../connection.php';
            $sql = "SELECT FornecedorID, Nome FROM cadastrofornecedores";
            $result = $conn->query($sql);
            ?>
            <span>
                <a href="../paineladmin/index.php"><i class="fa-solid fa-arrow-left" title="Voltar"></i></a>
                <h2>Produtos Disponíveis</h2>
            </span>
            <div class="container-table">
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade em Estoque</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Fornecedor</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </thead>

                    <tbody>

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
                            <tr>
                                <td><?= $row['ProdutoID'] ?></td>
                                <td><?= $row['Nome'] ?></td>
                                <td><?= $row['qtd_estoque'] ?></td>
                                <td><?= $row['Descricao'] ?></td>
                                <td><?= $row['Preco'] ?></td>
                                <td><?= $row['FornecedorNome'] ?></td>
                                <td>
                                    <img src="../cadastroproduto/<?= $row['Imagem'] ?>" alt="">
                                </td>
                                <td>
                                    <a href="update.php?id=<?= $row['ProdutoID'];  ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="delete.php?id=<?= $row['ProdutoID'];  ?>"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <h3>Role para ver mais:</h3>
            </div>
        </section>
    </main>
</body>

</html>