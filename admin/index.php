<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="icon" type="image/png" href="../images/logo.png"/>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap.min.css">

        <script src="../libs/jquery/jquery-3.2.1.min.js"></script>

        <title>Seja Solidário - Home</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light background-branco">
                <a class="navbar-brand" href="index.php"><img src="../images/logo.png" width="100" height="80" alt=""/></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php
                        
                        if(isset($_COOKIE['logadoadmin']) && $_COOKIE['logadoadmin'] == 'sim'){
                            ?>

                            <li class="nav-item">
                                <a class="nav-link" href="?p=doador/list"><i class="material-icons align-middle">card_giftcard</i> Doadores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?p=donatario/list"><i class="material-icons align-middle">support</i> Donatários</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?p=logout"><i class="material-icons align-middle">logout</i> Sair</a>
                            </li>

                            <?php
                        }

                        ?>
                    </ul>
                </div>
            </nav>
        </header>

        <main>

            <div>&nbsp;</div>
            <div>&nbsp;</div>

            <div class="container">
                <?php
                $page = filter_input(INPUT_GET, 'p');

                if ($page == '' || empty($page) || $page == 'index' || $page == 'index.php') {
                    include_once 'home.php';
                } else {
                    if (file_exists($page.'.php')) {
                        include_once $page.'.php';
                    } else {
                        header('Location: index.php');
                    }
                }
                ?>
            </div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
        </main>

        <script src="../js/mask.js"></script>
        <script src="../libs/bootstrap/js/popper.js"></script>
        <script src="../libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>


