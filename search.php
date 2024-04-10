<?php         
require ("_global.php") ; 
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
product_id, product_name, product_summary, product_price
FROM product 
WHERE 
	product_date <= NOW()
	AND product_status = 'off'
	AND product_name LIKE ?
	OR product_summary LIKE ?
	OR product_content LIKE ?
ORDER BY product_price ASC;

SQL;

// Prepare the query
$search_query = "%{$query}%";

// prepare and execute the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    'sss',
    $search_query,
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

    while ($pdt= $res->fetch_assoc()) :
        $search_view .= <<<HTML
    <div class="view_box-container">
                <div class="view_box" onclick="location.href = 'view.php?id={$pdt['product_id']}'">
                    <img src="https://picsum.photos/300/200" alt="{$pdt['product_name']}">
                    <div>
                        <h4>{$pdt['product_name']}</h4>
                        <p>{$pdt['product_price']}</p>
                    </div>
                </div>
            </div>
HTML;

    endwhile;
    else :
        $search_view .= <<<HTML

<h2>Procurando por {$query}</h2>
<p>Nenhum produto encontrado com "{$query}".</p>

HTML;
    endif;
else:
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