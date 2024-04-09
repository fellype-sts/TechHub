<?php         
require ("_global.php") ; 
$page = [

    "title" => "Vendo produto",
    "css" => "index.css",
    "js" => "index.js"
];


//Get article ID and stores it in 'id' variable
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate id 
if ($id < 0) header ('Location: 404.php');

$sql= <<<SQL

SELECT 
	product_id, product_name, product_content 
FROM
	product
WHERE 
product_id = '{$id}'
AND product_status = 'on';

SQL;

$res = $conn=>query($sql);

// If articles doesn't exist show 404
if($res->num_rows == 0) header ('Location: 404.php');

// stores product in pdt 
$pdt = $res->fetch_assoc();

//Change title page

$page['title'] = $art['art_title'];

$product = <<<PDT

<div class="product">
    <h2>{$pdt['product_name']}</h2>
    <small> </small>
</div>

PDT;

require("_header.php");

?>
<article> </article>

<?php require("_footer.php"); ?>