<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if ($_POST) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];

    $imagem = $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], "../imagens/$imagem");

    $conn->query("INSERT INTO produtos (nome, preco, categoria, imagem) 
                  VALUES ('$nome', '$preco', '$categoria', '$imagem')");

    header('Location: painel.php');
    exit;
}

include 'header.php';
?>

<div class="container">
    <h2>Adicionar Produto</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Nome do produto" required>
        <input type="number" name="preco" placeholder="Preço" required>
        <input type="text" name="categoria" placeholder="Categoria" required>
        <input type="file" name="imagem" required>
        <button type="submit">Cadastrar Produto</button>
    </form>
</div>
