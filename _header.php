<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css");
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <title>TechHub</title>
</head>

<body>
    <div id="wrap">
        <header>
            <div class="header-logo">
                <a href="index.php" title="Home" alt="Página inicial">
                    <img src="assets/img/logo.png">
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
        </header>
        <nav>
            <a href="index.php" title="Home">
                <i class="fa-solid fa-house fa-fw" style="color: #000000;"></i>
                <span>Início</span>
            </a>
            <a href="category.php" title="Categorias">
                <i class="fa-solid fa-bars fa-fw" style="color: #000000;"></i>
                <span>Categorias</span>
            </a>
            <a href="about.php" title="Sobre nós">
                <i class="fa-solid fa-circle-info" style="color: #000000;"></i>
                <span>Sobre</span>

            </a>
        </nav>
        <main>