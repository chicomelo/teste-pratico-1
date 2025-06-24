<?php

    $slug = $_GET['slug'] ?? null;
    $produtosJson = file_get_contents('products.json');
    $produtos = json_decode($produtosJson, true);
    $produtoSelecionado = null;
    foreach ($produtos as $produto) {
        if ($produto['slug'] === $slug) {
            $produtoSelecionado = $produto;
            break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/slick.css" />
    <link rel="stylesheet" href="assets/css/slick-theme.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    
</head>
<body class="product-page">
    
    <?php include "header.php"; ?>

    <main class="pt-5">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-5 mb-4">
                    <div class="slider-foto">
                        <?php 
                            foreach($produtoSelecionado['image'] as $img){
                                echo "<img src=" . $img . " alt='$produtoSelecionado[title]' >";
                            }
                        ?>
                    </div>
                    <div class="slider-thumbs mt-4">
                        <?php 
                            foreach($produtoSelecionado['image'] as $img){
                                echo "<div><img src=" . $img . " alt='$produtoSelecionado[title]'></div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="col-12 offset-md-1 col-md-6">
                    <h1 class="display-1 fs-2"><?php echo $produtoSelecionado['title']; ?></h1>
                    <p class="text-muted"><?php echo $produtoSelecionado['description']; ?></p>
                    <div class="prices">
                        <del class="discount fs-6 text-muted lh-1">R$ <?php echo number_format($produtoSelecionado['price'] + 10, 2, ',', '.'); ?></del>
                        <p class="price fs-1 lh-1">R$ <?php echo number_format($produtoSelecionado['price'], 2, ',', '.'); ?></p>
                    </div>
                    <button class="btn btn-primary w-50">Comprar</button>
                    
                    
                    <h2 class="mt-5 fs-4">Avaliações dos usuários</h2>
                    <p class="text-warning">
                        <span class="fs-1 lh-1 media">0</span><span class="fs-5 lh-1">/5</span>
                        <span class="fs-5 text-dark">de <b>0 avaliações</b></span>
                    </p>
                    
                    <h3 class="mt-5 mb-3 fs-4">Deixe sua avaliação</h3>
                    <form class="form-avaliacao" action="#avaliacao" method="post">
                        <button type="submit" data-valor="1" data-id="<?php echo $produtoSelecionado['id']; ?>"></button>
                        <button type="submit" data-valor="2" data-id="<?php echo $produtoSelecionado['id']; ?>"></button>
                        <button type="submit" data-valor="3" data-id="<?php echo $produtoSelecionado['id']; ?>"></button>
                        <button type="submit" data-valor="4" data-id="<?php echo $produtoSelecionado['id']; ?>"></button>
                        <button type="submit" data-valor="5" data-id="<?php echo $produtoSelecionado['id']; ?>"></button>
                    </form>

                </div>

            </div>

        </div>

    </main>

    <?php include "footer.php"; ?>

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>