<?php         
require ("_global.php") ; 
$page = [


    "title" => "Vendo produto",
    "css" => "view.css",
    "js" => "view.js"
];



//Get article ID and stores it in 'id' variable
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate id 
if ($id < 0) header ('Location: 404.php');

$sql= <<<SQL

SELECT 
	product_id, product_name, product_content , product_price, product_seller, product_summary
FROM
	product
WHERE 
product_id = '{$id}'
AND product_status = 'on';

SQL;

$res = $conn->query($sql);

// If articles doesn't exist show 404
if($res->num_rows == 0) header ('Location: 404.php');

// stores product in pdt 
$pdt = $res->fetch_assoc();

//Change title page

$page['title'] = $pdt['product_name'];

$product = <<<PDT

<div class="product">
    <h2 class= "section-title">{$pdt['product_name']}</h2>
    <p>{$pdt['product_summary']}</p>
    <div>{$pdt['product_content']} {$pdt['product_price']} &nbsp 
    <a href= 'https://www.mercadolivre.com.br/'> {$pdt['product_seller']}</a>
    </div>
</div>

PDT;

// Upodate number od views of product

$sql= <<<SQL

UPDATE product 
    SET product_views = product_views + 1
WHERE product_id = '{$id}';

SQL;

$conn->query($sql);


require("_header.php");

?>
<article> <?php echo $product ?> </article>


<?php require("_footer.php"); ?>