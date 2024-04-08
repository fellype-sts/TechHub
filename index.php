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

$product = "";

/** If doesn't have products */
if ($total == 0):
    $product = "<h2>Sem ofertas disponíveis no momento.</h2>";
else:
    $count = 0;
    while ($pdt = $res->fetch_assoc()):
        // Verifica se é o início de uma nova linha
        if ($count % 3 == 0):
            $product .= '<div class="product-row">';
        endif;
        $product .= <<<HTML
            <div class="product-container">
                <div class="product" onclick="location.href = 'view.php?id={$pdt['product_id']}'">
                    <img src="https://picsum.photos/300/200" alt="{$pdt['product_name']}">
                    <div>
                        <h4>{$pdt['product_name']}</h4>
                        <p>{$pdt['product_price']}</p>
                    </div>
                </div>
            </div>
        HTML;
        // Verifica se é o final de uma linha
        if ($count % 3 == 2 || $count == $total - 1):
            $product .= '</div>';
        endif;
        $count++;
    endwhile;
endif;

require ("_header.php");
?>
<article>
    <?php echo $product ?>
</article>
<?php require ("_footer.php"); ?>
