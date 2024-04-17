<?php
require("_global.php");

$page = [
    "title" => "Página Inicial",
    "css" => "index.css",
    "js" => "index.js"
];


/** MOST VIEWED */

$sql_b = <<<SQL
    SELECT product_id, product_name, product_price, product_thumbnail, product_views
    FROM product
    WHERE 
    product_date <= NOW()
    AND product_status = 'on'
    ORDER BY product_views DESC
;
SQL;

$res_b = $conn->query($sql_b);
$total_b = $res_b->num_rows;
$view_box_b = <<<HTML
    <section class="product-section"> <h1 class="product-category"> Mais vistos </h1> 
    <button class="pre-btn"><ion-icon name="chevron-back-outline"></ion-icon></button>
        <button class="nxt-btn"><ion-icon name="chevron-forward-outline"></ion-icon></button>

HTML;
$view_box_b .= <<<HTML
<div class="view_box-container">
HTML;
while ($pdt_b = $res_b->fetch_assoc()) {


    $view_box_b .= <<<HTML

            <div class="view_box" onclick="location.href = 'view.php?id={$pdt_b['product_id']}'">
                <img src="{$pdt_b['product_thumbnail']}" alt="{$pdt_b['product_name']}">
                <div class="product_info">
                    <h4 class="product-brand">{$pdt_b['product_name']}</h4>
                    <span class="price"> R$ {$pdt_b['product_price']}</span>
                </div>
            </div>

    HTML;
}
$view_box_b .= <<<HTML
</div> </section>
HTML;

if ($total_b == 0) {
    $view_box_b = "<h2>Sem ofertas disponíveis no momento.</h2>";
}

/** MOST COMMENTED */
$sql_c = <<<SQL
   SELECT product_id, product_name, product_price, product_thumbnail, product_views, COUNT(c.cmt_id) AS num_comments
FROM product p
LEFT JOIN comment c ON p.product_id = c.cmt_product
WHERE p.product_status = 'on'
AND p.product_date <= NOW()
GROUP BY p.product_id
ORDER BY num_comments DESC;
SQL;



$res_c = $conn->query($sql_c);
$total_c = $res_c->num_rows;


$view_box_c = <<<HTML
<section class="product-section"> 
    <h1 class="product-category"> Mais comentados </h1> 
    <button class="pre-btn"><ion-icon name="chevron-back-outline"></ion-icon></button>
        <button class="nxt-btn"><ion-icon name="chevron-forward-outline"></ion-icon></button>
HTML;

$view_box_c .= <<<HTML
    <div class="view_box-container">
HTML;


while ($pdt_c = $res_c->fetch_assoc()) {

    $view_box_c .= <<<HTML

    <div class="view_box" onclick="location.href = 'view.php?id={$pdt_c['product_id']}'">
        <img src="{$pdt_c['product_thumbnail']}" alt="{$pdt_c['product_name']}">
        <div class="product_info">
            <h4 class="product-brand">{$pdt_c['product_name']}</h4>
            <span class="price"> R$ {$pdt_c['product_price']}</span>
        </div>
    </div>

HTML;
}
$view_box_c .= <<<HTML
</div> </section>
HTML;

if ($total_c == 0) {
    $view_box_c = "<h2>Sem ofertas disponíveis no momento.</h2>";
}



/**GERAL */

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

$view_box = <<<HTML
<section class="product-section"> <h1 class="product-category"> Geral </h1> 
<button class="pre-btn"><ion-icon name="chevron-back-outline"></ion-icon></button>
        <button class="nxt-btn"><ion-icon name="chevron-forward-outline"></ion-icon></button>

HTML;


$view_box .= <<<HTML
<div class="view_box-container">
HTML;

while ($pdt = $res->fetch_assoc()) {

    $view_box .= <<<HTML

    <div class="view_box" onclick="location.href = 'view.php?id={$pdt['product_id']}'">
        <img src="{$pdt['product_thumbnail']}" alt="{$pdt['product_name']}">
        <div class="product_info">
            <h4 class="product-brand">{$pdt['product_name']}</h4>
            <span class="price"> R$ {$pdt['product_price']}</span>
        </div>
    </div>

HTML;
}
$view_box .= <<<HTML
</div> </section>
HTML;
/** Se não houver produtos */
if ($total == 0) {
    $view_box = "<h2>Sem ofertas disponíveis no momento.</h2>";
}


require("_header.php");
?>
<article>
    <?php echo $view_box_b ?>
    <?php echo $view_box_c ?>
    <?php echo $view_box ?>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
</article>
<?php require("_footer.php"); ?>
