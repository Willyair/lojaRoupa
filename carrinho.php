<?php
session_start();
include 'db.php';

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<p>Seu carrinho está vazio.</p>";
    exit;
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho - Willy Thomas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<h1>Meu Carrinho</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Produto</th>
        <th>Imagem</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Total</th>
        <th>Ações</th>
    </tr>
    <?php foreach($_SESSION['carrinho'] as $id => $item): 
        $subtotal = $item['preco'] * $item['quantidade'];
        $total += $subtotal;
    ?>
    <tr>
        <td><?php echo $item['nome']; ?></td>
        <td><img src="imagens/<?php echo $item['imagem']; ?>" width="50"></td>
        <td><?php echo $item['preco']; ?> MT</td>
        <td><?php echo $item['quantidade']; ?></td>
        <td><?php echo $subtotal; ?> MT</td>
        <td>
            <a href="remover_carrinho.php?id=<?php echo $id; ?>">Remover</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<p>Total: <?php echo $total; ?> MT</p>
<a class="btn" href="checkout.php">Finalizar Compra</a>

</body>
</html>
