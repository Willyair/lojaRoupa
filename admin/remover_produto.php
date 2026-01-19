<?php
session_start();
include '../db.php';
include 'header.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: painel.php');
    exit;
}

$id = $_GET['id'];
$conn->query("DELETE FROM produtos WHERE id=$id");

header('Location: painel.php');
exit;
