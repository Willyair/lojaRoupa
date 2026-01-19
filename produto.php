<?php
include 'db.php';
$id = $_GET['id'];
$p = $conn->query("SELECT * FROM produtos WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $p['nome']; ?></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2><?php echo $p['nome']; ?></h2>
<img src="imagens/<?php echo $p['imagem']; ?>">
<p>Preço: <?php echo $p['preco']; ?> MT</p>
<a href="index.php">Voltar</a>
</body>
</html>