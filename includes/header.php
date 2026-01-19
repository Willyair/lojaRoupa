<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <!-- Retângulo à esquerda com a logo -->
    <div class="header-left">
        <a href="index.php">
            <img src="imagens/logo2.png" alt="Willy Thomas" class="logo-img">
        </a>
    </div>

    <!-- Menu de navegação à direita -->
    <nav>
        <a href="index.php">Loja</a>
        <a href="carrinho.php">Carrinho (<?php echo isset($_SESSION['carrinho']) ? array_sum(array_column($_SESSION['carrinho'], 'quantidade')) : 0; ?>)</a>
        <a href="admin/login.php">Admin</a>
    </nav>
</header>
