<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: painel.php');
    exit;
}

$id = $_GET['id'];
$p = $conn->query("SELECT * FROM produtos WHERE id=$id")->fetch_assoc();

if ($_POST) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $img = $p['imagem'];

    if (!empty($_FILES['imagem']['name'])) {
        $img = $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], "../imagens/$img");
    }

    $conn->query("UPDATE produtos SET nome='$nome', preco='$preco', categoria='$categoria', imagem='$img' WHERE id=$id");

    header('Location: painel.php');
    exit;
}

include 'header.php';
?>

<div class="container">
    <h2>Editar Produto</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nome" value="<?php echo $p['nome']; ?>" required>
        <input type="number" name="preco" value="<?php echo $p['preco']; ?>" required>
        <input type="text" name="categoria" value="<?php echo $p['categoria']; ?>" required>
        <img src="../imagens/<?php echo $p['imagem']; ?>" width="80"><br>
        <input type="file" name="imagem"><br>
        <button type="submit">Atualizar</button>
    </form>
</div>
