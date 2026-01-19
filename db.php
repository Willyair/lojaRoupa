<?php
$conn = new mysqli("localhost", "root", "", "willy_thomas");
if ($conn->connect_error) {
die("Erro de conexão");
}
?>