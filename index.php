<?php
require("_global.php");
$page = [
    "title" => "Página Inicial",
    "css" => "index.css",
    "js" => "index.js"
];
$sql = <<<SQL
    SELECT product_id, product_name, product_price 
    FROM product
    WHERE 
    product_date <= NOW()
    AND product_status = 'on'
ORDER BY product_price ASC;

SQL;
$res= $conn->query($sql);

$total = $res->num_rows;

$product = "<h2> Melhores Ofertas </h2>";


/** If doesn't have products */

if ($total == 0) :
    $product = "<h2>Sem ofertas disponíveis num momento.</h2>";
else: 

    while($pdt =$res->fetch_assoc()):
        $product .= <<<HTML
    <div class="product" onclick="location.href = 'view.php?id={$pdt['product_id']}'">
    <div>
        <h4>{$pdt['product_name']}</h4>
        <p>{$pdt['product_price']}</p>
    </div>
    </div>
    HTML;
    endwhile;
endif;

require("_header.php");

?>
<article> <?php echo $product ?>
</article>
<?php require("_footer.php"); ?>