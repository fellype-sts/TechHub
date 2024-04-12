<?php
require ("_global.php");
$page = [
    "title" => "Página Inicial",
    "css" => "index.css",
    "js" => "index.js"
];
$sql = <<<SQL
    SELECT product_id, product_name, product_price, product_thumbnail
    FROM product
    WHERE 
    product_date <= NOW()
    AND product_status = 'on'
    ORDER BY product_price ASC;
SQL;
$res = $conn->query($sql);

$total = $res->num_rows;

$view_box = "";

/** If doesn't have products */
if ($total == 0):
    $view_box = "<h2>Sem ofertas disponíveis no momento.</h2>";
else:
    $count = 0;
    while ($pdt = $res->fetch_assoc()):
        // Verifica se é o início de uma nova linha
        if ($count % 3 == 0):
            $view_box .= '<div class="view_box-row">';
        endif;
        $view_box .= <<<HTML
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
        if ($count % 3 == 2 || $count == $total - 1):
            $view_box .= '</div>';
        endif;
        $count++;
    endwhile;
endif;

require ("_header.php");
?>
<article>
    <?php echo $view_box ?>
</article>
<?php require ("_footer.php"); ?>
