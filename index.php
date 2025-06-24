<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grid de Produtos</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    
</head>
<body class="home-page">
    
    <?php include "header.php"; ?>

    <main class="pt-5">

        <div class="container">


            <div class="row mb-4">
                <div class="col-12 col-md-6 col-lg-8 col-xl-9 ">
                    <h2 class="fs-2 fw-bold">Produtos</h2>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 ">
                    <form action="#" method="post" class="form-buscar d-flex">
                        <input class="form-control me-2" type="search" placeholder="Buscar produto" aria-label="Buscar">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </form>
                </div>
            </div>

            <div class="row">

                <?php
                    $produtosJson = json_decode(file_get_contents('products.json'), true);
                    foreach($produtosJson as $produto){
                ?>

                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card overflow-hidden rounded-3">
                        
                        <div class="card-thumb p-4">
                            <img src="<?php echo $produto['image'][0] ?>" class="w-100 h-100" alt="<?php echo $produto['title'] ?>" style="object-fit: contain;" />
                        </div> 

                        <div class="card-body">
                            <h5 class="card-title fs-5 fw-bold"><?php echo $produto['title'] ?></h5>
                            <p class="card-text text-muted">
                                <?php echo $produto['short']; ?>
                            </p>
                            <a href="<?php echo $baseURL ?>produto.php?slug=<?php echo $produto['slug']; ?>" class="w-100 btn btn-primary">Ver mais</a>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>

            </div>

        </div>

    </main>

    <?php include "footer.php"; ?>


    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>

