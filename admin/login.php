<?php
session_start();
include '../db.php';


if ($_POST) {
$u = $_POST['usuario'];
$s = md5($_POST['senha']);


$sql = $conn->query("SELECT * FROM admin WHERE usuario='$u' AND senha='$s'");
if ($sql->num_rows > 0) {
$_SESSION['admin'] = $u;
header('Location: painel.php');
} else {
echo 'Login inválido';
}
}
?>
<link rel="stylesheet" href="css/style.css">


<form method="post">
<h2>Admin - Willy Thomas</h2>
<input name="usuario" placeholder="Usuário"><br>
<input type="password" name="senha" placeholder="Senha"><br>
<button>Entrar</button>
</form>