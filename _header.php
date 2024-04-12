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
<header>
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
</header>

<div id="wrap">

<nav>
        
        <a  href="" title="Categorias">
            <i class="fa-solid fa-list fa-fw"></i>
            <span>Categorias</span>
        </a>
        <a href="index.php" title="Home">
            <i class="fa-solid fa-house fa-fw"></i>
            <span>Início</span>
        </a>

        <a href="about.php" title="Sobre nós">
            <i class="fa-solid fa-circle-info"></i>
            <span>Sobre</span>

            <a href="contacts.php" title="Fale Conosco">
            <i class="fa-regular fa-comment-dots fa-fw"></i>
            <span>Contatos</span>

        </a>

        </a>
        <?php // Botão de interação do perfil do usuário, modificado pelo JavaScript 
        ?>
        <a id="userAccess" href="login.php" title="Logue-se">
        <img id="userImg" src="" alt="" referrerpolicy="no-referrer"> 
                <i id="userIcon" class="fa-solid fa-right-to-bracket fa-fw"></i>
                <span id="userLabel">Entrar</span>
            </a>
    </nav>
    </header>
    <main>