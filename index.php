<?php
require("_global.php");

$page = [
    "title" => "Página Inicial",
    "css" => "index.css",
    "js" => "index.js"
];




$sql_b = <<<SQL
    SELECT product_id, product_name, product_price, product_thumbnail, product_views
    FROM product
    WHERE 
    product_date <= NOW()
    AND product_status = 'on'
    ORDER BY product_views DESC
    LIMIT 3;
SQL;





$res_b = $conn->query($sql_b);
$total_b = $res_b->num_rows;
$view_box_b = "";

$count = 0;
while ($pdt_b = $res_b->fetch_assoc()) {
    // Verifica se é o início de uma nova linha
    if ($count % 3 == 0) {
        $view_box_b .= '<div class="view_box-row">';
    }
    $view_box_b .= <<<HTML
        <div class="view_box-container">
            <div class="view_box" onclick="location.href = 'view.php?id={$pdt_b['product_id']}'">
                <img src="{$pdt_b['product_thumbnail']}" alt="{$pdt_b['product_name']}">
                <div>
                    <h4>{$pdt_b['product_name']}</h4>
                    <p> R$ {$pdt_b['product_price']}</p>
                </div>
            </div>
        </div>
    HTML;
    // Verifica se é o final de uma linha 
    if ($count % 3 == 2 || $count == $total_b - 1) {
        $view_box_b .= '</div>';
    }
    $count++;
}

$sql_c = <<<SQL
   SELECT product_id, product_name, product_price, product_thumbnail, product_views, COUNT(c.cmt_id) AS num_comments
FROM product p
LEFT JOIN comment c ON p.product_id = c.cmt_product
WHERE p.product_status = 'on'
AND p.product_date <= NOW()
GROUP BY p.product_id
ORDER BY num_comments DESC
LIMIT 3;
SQL;

$res_c = $conn->query($sql_c);
$total_c = $res_c->num_rows;
$view_box_c = "";

$count = 0;
while ($pdt_c = $res_c->fetch_assoc()) {
    // Verifica se é o início de uma nova linha
    if ($count % 3 == 0) {
        $view_box_c .= '<div class="view_box-row">';
    }
    $view_box_c .= <<<HTML
        <div class="view_box-container">
            <div class="view_box" onclick="location.href = 'view.php?id={$pdt_c['product_id']}'">
                <img src="{$pdt_c['product_thumbnail']}" alt="{$pdt_c['product_name']}">
                <div>
                    <h4>{$pdt_c['product_name']}</h4>
                    <p> R$ {$pdt_c['product_price']}</p>
                </div>
            </div>
        </div>
    HTML;
    // Verifica se é o final de uma linha 
    if ($count % 3 == 2 || $count == $total_c - 1) {
        $view_box_c .= '</div>';
    }
    $count++;
}

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

/** Se não houver produtos */
if ($total == 0) {
    $view_box = "<h2>Sem ofertas disponíveis no momento.</h2>";
} else {
    $count = 0;
    while ($pdt = $res->fetch_assoc()) {
        // Verifica se é o início de uma nova linha
        if ($count % 3 == 0) {
            $view_box .= '<div class="view_box-row">';
        }
        $view_box .= <<<HTML
            <div class="view_box-container">
                <div class="view_box" onclick="location.href = 'view.php?id={$pdt['product_id']}'">
                    <img src="{$pdt['product_thumbnail']}" alt="{$pdt['product_name']}">
                    <div>
                        <h4>{$pdt['product_name']}</h4>
                        <p> R$ {$pdt['product_price']}</p>
                    </div>
                </div>
            </div>
        HTML;
        // Verifica se é o final de uma linha 
        if ($count % 3 == 2 || $count == $total - 1) {
            $view_box .= '</div>';
        }
        $count++;
    }
}


require("_header.php");
?>
<article>
    <?php echo $view_box_b ?>
</article>

<article>
    <?php echo $view_box_c ?>
</article>
<?php require("_footer.php"); ?>

<article>
    <?php echo $view_box ?>
</article>
<?php require("_footer.php"); ?>



