<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Consulta produtos
$result = $conn->query("SELECT * FROM produtos");

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

include 'header.php';
?>

<div class="container">
    <h2>Produtos Cadastrados</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>

        <?php while ($p = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><img src="../imagens/<?php echo $p['imagem']; ?>" width="60"></td>
            <td><?php echo $p['nome']; ?></td>
            <td><?php echo $p['preco']; ?> MT</td>
            <td><?php echo $p['categoria']; ?></td>
            <td>
                <a class="btn btn-edit" href="editar_produto.php?id=<?php echo $p['id']; ?>">Editar</a>
                <a class="btn btn-delete"
                   href="remover_produto.php?id=<?php echo $p['id']; ?>"
                   onclick="return confirm('Deseja excluir este produto?')">
                   Excluir
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
