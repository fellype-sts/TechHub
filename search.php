<?php
require("_global.php");
$page = [
    "title" => "Procurando...",
    "css" => "index.css",
    "js" => "search.js"
];

$search_view = '';

$total = '';

$query = isset($_GET['q']) ? trim(htmlentities(strip_tags($_GET['q']))) : '';

if ($query != '') :
    $sql = <<<SQL

SELECT 
product_id, product_name, product_summary, product_price, product_thumbnail
FROM product 
WHERE 
	product_date <= NOW()
	AND product_status = 'off'
	AND product_name LIKE ?
	OR product_summary LIKE ?
	
ORDER BY product_price ASC;

SQL;

    // Prepare the query
    $search_query = "%{$query}%";

    // prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ss',
        $search_query,
        $search_query
    
    );
    $stmt->execute();
    // Get the search result
    $res = $stmt->get_result();

    // Total of registers
    $total = $res->num_rows;


    if ($total > 0) :

        if ($total == 1) $viewtotal = '1 resultato';
        else $viewtotal = "{$total} resultados";


        $search_view .= <<<HTML

        
<h2>Procurando por {$query}</h2>
<p><small>{$viewtotal}</small></p>
HTML;
        if ($total == 0) :
            $search_view = "<h2>Sem ofertas disponíveis no momento.</h2>";
        else :
            $count = 0;
            while ($pdt = $res->fetch_assoc()) :
                // Verifica se é o início de uma nova linha
                if ($count % 3 == 0) :
                    $search_view .= '<div class="view_box-row">';
                endif;
                $search_view .= <<<HTML
            <div class="view_box-container">
                <div class="view_box" onclick="location.href = 'view.php?id={$pdt['product_id']}'">
                    <img src="{$pdt['product_thumbnail']}" alt="{$pdt['product_name']}">
                    <div>
                        <h4>{$pdt['product_name']}</h4>
                        <p>{$pdt['product_price']}</p>
                    </div>
                </div>
            </div>
        HTML;
                // Verifica se é o final de uma linha
                if ($count % 3 == 2 || $count == $total - 1) :
                    $search_view .= '</div>';
                endif;
                $count++;
            endwhile;
        endif;
    else :
        $search_view .= <<<HTML

<h2>Procurando por {$query}</h2>
<p>Nenhum produto encontrado com "{$query}".</p>

HTML;
    endif;
else :
    $search_view .= <<<HTML

    <h2>Procurando...</h2>
    <p class="center">Digite algo no campo de busca!!!</p>
    
    HTML;

endif;


require("_header.php");
?>
<article><?php

            echo $search_view;
            ?></article>

<?php require("_footer.php"); ?>