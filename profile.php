<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Perfil do Usuário",
    "css" => "profile.css",
    "js" => "profile.js"
);

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article >


    <div id="userCard"></div>

 

</article>



<?php
// Inclui o rodapé do documento
require('_footer.php');
?>