<nav class="navbar navbar-dark bg-primary py-3">
    <div class="container">
        <?php
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $scriptName = $_SERVER['SCRIPT_NAME'];
            $basePath = rtrim(dirname($scriptName), '/\\');

            $baseURL = $protocol . "://" . $host . $basePath . "/";
        
        ?>
        <h1 class="my-0 fs-4">
            <a href="<?php echo $baseURL; ?>" class="navbar-brand">E-commerce</a>
        </h1>

    </div>
</nav>