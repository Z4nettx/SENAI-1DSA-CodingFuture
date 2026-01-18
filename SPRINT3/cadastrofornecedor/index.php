<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Fornecedores - Cervejaria Dogma</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../assets/favicon-dogma.ico" type="image/x-icon">
</head>

<body>
    <header>
        <img src="../assets/logo.png" alt="Logo Dogma Cervejaria" class="logo-dogma" />
    </header>
    <main>
        <section id="sec1">
            <form action="cadfornecedor.php" method="post">
                <div>
                    <a href="../paineladmin/index.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#9F6C54" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288 480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 105.4-105.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                        </svg></a>
                    <h2>Cadastro de Fornecedores</h2>
                </div>

                <label for="fornecedor">Nome do Fornecedor:</label>
                <input type="text" name="nome" placeholder="Nome Fornecedor" required>

                <label for="pais">País:</label>
                <input type="text" name="pais" placeholder="País" required>

                <label for="ender">Endereço:</label>
                <input type="text" name="endereco" placeholder="Endereço" required>
                
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="E-mail" required>

                <label for="cnpj">CNPJ:</label>
                <input type="text" name="cnpj" placeholder="CNPJ" maxlength="18" required>

                <label for="estado">Estado:</label>
                <input type="text" name="estado" placeholder="Estado" required>

                <label for="observacoes">Observações</label>
                <textarea name="observacoes" placeholder="Observações" id="observacoes" cols="30" rows="6" required></textarea>

                <button type="submit">Cadastrar Fornecedor</button>
            </form>
        </section>
        <section id="sec2">
            <h2>Listagem de Fornecedores</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>País</th>
                            <th>Email</th>
                            <th>Endereço</th>
                            <th>CNPJ</th>
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
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['FornecedorID'] ?></td>
                                <td><?= $row['Nome'] ?></td>
                                <td><?= $row['Pais'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['Endereço'] ?></td>
                                <td><?= $row['CNPJ'] ?></td>
                                <td class="actions">
                                    <a href="update.php?id=<?= $row['FornecedorID']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="#9f6c54" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L368 46.1 465.9 144 490.3 119.6c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L432 177.9 334.1 80 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                                        </svg></a>
                                    <a href="delete.php?id=<?= $row['FornecedorID']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
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