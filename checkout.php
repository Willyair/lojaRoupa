<?php
session_start();
include 'db.php';

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<p>Seu carrinho está vazio.</p>";
    exit;
}

$total = 0;
foreach($_SESSION['carrinho'] as $item) {
    $total += $item['preco'] * $item['quantidade'];
}

// Aqui você pode processar o pedido
if ($_POST) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    // Salvar no banco, enviar email, etc.
    unset($_SESSION['carrinho']); // limpa carrinho
    echo "<p>Obrigado pelo seu pedido, $nome! Total: $total MT</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Willy Thomas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<h1>Finalizar Compra</h1>

<form method="post">
    <label>Seu nome:</label><br>
    <input type="text" name="nome" required><br><br>
    <label>Telefone:</label><br>
    <input type="text" name="telefone" required><br><br>
    <p>Total: <?php echo $total; ?> MT</p>
    <button type="submit" class="btn">Confirmar Pedido</button>
</form>

</body>
</html>
