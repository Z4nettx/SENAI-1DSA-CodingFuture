<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fornecedor = $_POST["fornecedor"];
    $nome = $_POST["nome"];
    $qtd_estoque = $_POST["qtd_estoque"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];

    $imagem = "";

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
    // INSERT simples
    $sql = "INSERT INTO cadastroprodutos (Fornecedor, Nome, qtd_estoque, Descricao, Preco, Imagem)
            VALUES ('$fornecedor', '$nome', '$qtd_estoque', '$descricao', '$preco', '$imagem')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}
