<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervejaria Dogma</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../assets/favicon-dogma.ico" type="image/x-icon">
</head>

<body>
    <header>
        <img src="assets/logo.png" alt="Logo">
        <nav>
            <ul>
                <a href="#sec1">
                    <li>Home</li>
                </a>
                <a href="#sec2">
                    <li>Cervejas</li>
                </a>
                <a href="#sec4">
                    <li>Prêmios</li>
                </a>
            </ul>

        </nav>
        <div>
            <a href="cadastrousuario/index.php"><i title="Fazer Cadastro" class="fa-solid fa-user"></i></a>
            <i class="fa-solid fa-magnifying-glass"></i>
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
    </header>
    <main>
        <section id="sec1">
        </section>
        <?php
        include 'connection.php';
        // buscar produtos
        $sql = "SELECT Nome, Preco, Imagem FROM cadastroprodutos";
        $result = $conn->query($sql);
        ?>
        <section id="sec2">
            <h1>CERVEJAS DISPONÍVEIS</h1>
            <div class="produtos">
                <?php while ($p = $result->fetch_assoc()): ?>
                    <div class="produto">
                        <img src="cadastroproduto/<?= $p['Imagem'] ?>" alt="<?php echo $p['Nome']; ?>">
                        <p><?php echo $p['Nome']; ?></p>
                        <p>R$ <?php echo number_format($p['Preco'], 2, ',', '.'); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
        <section id="sec4">
            <i class="fa-solid fa-award"></i>
            <h1>RECONHECIMENTO NACIONAL E INTERNACIONAL</h1>
            <p>A Cervejaria Dogma foi eleita a melhor cervejaria por <strong>3 anos consecutivos no RateBeer</strong> e
                premiada em eventos globais como
                a Borefts Beer Festival. Além de também ser reconhecida em território nacional como o <strong>Melhor
                    Chope
                    de São Paulo</strong> nos anos
                de 2019, 2021 e 2022 no Prêmio Veja Comer e Beber!</p>
        </section>
    </main>
    <footer>
        <div>
            <img src="assets/logo.png" alt="Logo">
            <p>&copy; 2205 Cervejaria Dogma - Todos os Direitos Reservados.</p>
        </div>
        <div class="socials">
            <i class="fa-solid fa-envelope"></i>
            <i class="fa-brands fa-whatsapp"></i>
            <i class="fa-brands fa-instagram"></i>
        </div>
    </footer>
</body>

</html>