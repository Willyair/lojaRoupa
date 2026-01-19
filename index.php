<?php
include 'db.php';
session_start();

// Inicializa carrinho
if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adicionar produto ao carrinho
if (isset($_GET['add'])) {
    $id = intval($_GET['add']);
    $produto = $conn->query("SELECT * FROM produtos WHERE id=$id")->fetch_assoc();
    if(!$produto) die("Produto não encontrado");

    if(isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade']++;
    } else {
        $_SESSION['carrinho'][$id] = [
            'nome' => $produto['nome'],
            'preco' => $produto['preco'],
            'imagem' => $produto['imagem'],
            'quantidade' => 1
        ];
    }

    header('Location: index.php');
    exit;
}

// Filtro por categoria
$filtro = "";
if(isset($_GET['categoria'])){
    $cat = $conn->real_escape_string($_GET['categoria']);
    $filtro = "WHERE categoria='$cat'";
}

// Buscar produtos
$result = $conn->query("SELECT * FROM produtos $filtro");

// Buscar categorias
$cats = $conn->query("SELECT DISTINCT categoria FROM produtos");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Loja Willy Thomas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<!--    TOPO    -->

<div class="promos">
    <h1>PROMOÇÕES</h1>
</div>

<!-- CARROSSEL DE PROMOÇÕES -->
<div class="carrossel">
    <div class="slide"><img src="imagens/Oversized5.jpg" alt="Promoção 1"></div>
    <div class="slide"><img src="imagens/Oversized3.jpg" alt="Promoção 2"></div>
    <div class="slide"><img src="imagens/Oversized9.jpg" alt="Promoção 3"></div>
</div>
<!--    SOBRE NOS -->
<div class="about">
    <h1 class="titles">Sobre nos.</h1>
    <P>
        Está chegando a <b>WT</b> <i>(Willy Thoma)</i>, a loja moçambicana que promete
         transformar a forma como você se veste e se expressa! Com inauguração 
         em breve, a <b>WT</b> chega trazendo uma coleção diversificada que atende a todos
          os estilos e nichos: do científico ao tecnológico, do descolado ao tradicional, garantindo 
        que cada cliente encontre algo que combine perfeitamente com sua personalidade.
    </P>

    <p>
        Mas a <b>WT</b> não é apenas sobre roupas. Aqui, você
         também encontrará uma seleção de acessórios
          que completam seu visual com estilo e sofisticação. 
          E o melhor: não vendemos apenas produtos da nossa marca; 
          a <b>WT</b> também traz para você roupas de grandes marcas
         internacionais, garantindo qualidade, exclusividade e as últimas tendências da moda.
    </p>

    <p>
        Seja para impressionar no trabalho, se destacar na faculdade ou 
        simplesmente expressar sua essência no dia a dia, a <b>WT</b> <i>(Willy Thoma)</i>
         será o seu novo destino de moda em Moçambique.
         Fique atento à nossa abertura e venha descobrir um mundo de estilo sem limites!
    </p>
</div>

<!-- FILTRO DE CATEGORIAS -->
<div class="categorias">
    <a class="btn-cat" href="index.php?categoria=Acessórios">Acessórios</a>
    <?php while($c = $cats->fetch_assoc()):
        $catName = $c['categoria'];
        if($catName == "Acessórios") continue;
    ?>
        <a class="btn-cat" href="index.php?categoria=<?php echo urlencode($catName); ?>">
            <?php echo $catName; ?>
        </a>
    <?php endwhile; ?>
    <a class="btn-cat" href="index.php">Todas</a>
</div>

<!-- GRID DE PRODUTOS -->
<div class="container">
    <div class="produtos-grid">
        <?php
        $result = $conn->query("SELECT * FROM produtos $filtro");
        while($p = $result->fetch_assoc()): ?>
            <div class="produto-card">
                <?php if(!empty($p['promocao'])): ?>
                    <div class="promo"><?php echo $p['promocao']; ?></div>
                <?php endif; ?>
                <img src="imagens/<?php echo $p['imagem']; ?>" alt="<?php echo $p['nome']; ?>">
                <h3><?php echo $p['nome']; ?></h3>
                <p><?php echo $p['preco']; ?> MT</p>
                <a class="btn" href="index.php?add=<?php echo $p['id']; ?>">Adicionar ao Carrinho</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- JS CARROSSEL -->
<script>
let slides = document.querySelectorAll('.carrossel .slide');
let index = 0;

function showSlide(i){
    slides.forEach(s => s.classList.remove('active'));
    slides[i].classList.add('active');
}

function nextSlide(){
    index = (index + 1) % slides.length;
    showSlide(index);
}

showSlide(index);
setInterval(nextSlide, 3000);
</script>

</body>
</html>
