<?php

/**
 * Check if had included js and css arquives
 */

 $_css = $_js = '';
if (isset($page['css']))
    $_css = '<link rel="stylesheet" href="assets/css/' . $page["css"] . '">' . "\n";

if (isset($page['js']))
    $_js = '<script src="assets/js/' . $page["js"] . '"></script>' . "\n";
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <?php echo $_css ?>
    <title>TechHub - <?php echo $page["title"]  ?></title>
</head>
<header>
    <div class="header-logo">
        <a href="index.php" title="Home" alt="Página inicial">          
                <img src="assets/img/logo02.png">           
        </a>
    </div>
    <div class="header-search">
            <form action="search.php" method="get" onclick = "return searchCheck()"> 
                <input type="search" name="q" id="search" placeholder="Pesquisar..." >
                <button class="search" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </header>

    <div id="wrap">
        
        <nav>
        <a href="category.php" title="Categorias"
        >
                
            </a>
            <a href="index.php" title="Home">
                <i class="fa-solid fa-house fa-fw" ></i>
                <span>Início</span>
            </a>
            
            <a href="about.php" title="Sobre nós">
                <i class="fa-solid fa-circle-info" ></i>
                <span>Sobre</span>

            </a>
        </nav>
        </header>
        <main>