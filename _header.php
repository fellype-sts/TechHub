<?php
// Testa se solicitou a inclusão dos arquivos ".css" e ".js"
$_css = $_js = '';
if (isset($page['css']))
    $_css = '<link rel="stylesheet" href="assets/css/' . $page["css"] . '">' . "\n";

if (isset($page['js']))
    $_js = '<script src="assets/js/' . $page["js"] . '"></script>';

?>




<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <?php
    // Link da folha de estilos da página atual gerado dinâmicamente 
    echo $_css;
    ?>
    <link rel="shortcut icon" href="assets/img/<?php echo $site["logo"] ?>">
    <title> TechHub -
        <?php echo $page["title"] ?>
    </title>

</head>

<body >


    <header>
        <i onclick="toggleNav()" class="fa-solid fa-bars fa-fw" style="color: white"></i>
        <div class="header-logo">
            <a href="index.php" title="Home" alt="Página inicial">
                <img src="assets/img/logo02.png">
            </a>
        </div>
        <div class="header-search">
            <form action="search.php" method="get" onclick="return searchCheck()">
                <input type="search" name="q" id="search" placeholder="Pesquisar...">
                <button class="search" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <!-- <menu id="itens">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="about.php">Sobre</a></li>
            <li><a href="contacts.php">Contatos</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </menu> -->
    </header>
    <nav class="nav">
        <button type="button" class="nav-close">
            <ion-icon name="close-outline" size='large'></ion-icon>
        </button>
        <div class="nav-links-container">
            <a href="index.php" class="nav-link">
                <span class="nav-text"> Inicio </span>

                <ion-icon name="home-outline" size="large" ></ion-icon>
            </a>
            <a href="about.php" class="nav-link">
                <span class="nav-text"> Sobre </span>
                <ion-icon name="information-circle-outline" size = "large"></ion-icon>
            </a>
            <a href="contacts.php" class="nav-link">
                <span class="nav-text"> Contatos </span>
                <ion-icon name="people-circle-outline" size = "large" ></ion-icon>
            </a>
            <a href="login.php" class="nav-link">
                <span class="nav-text"> Login </span>
                <ion-icon name="enter-outline" size = "large"  ></ion-icon>
            </a>
        </div>
    </nav>

    <div id="wrap">


        </header>
        <main>