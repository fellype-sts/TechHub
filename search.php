<?php
require("_global.php");
$page = [
    "title" => "Procurando...",
    "css" => "search.css",
    "js" => "search.js"
];

$search_view = '';

$total = '';

$query = isset($_GET['q']) ? trim(htmlentities(strip_tags($_GET['q']))) : '';
$category = isset($_GET['category']) ? intval($_GET['category']) : 0;
$order = isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc']) ? $_GET['order'] : 'asc';

// Função para obter todas as categorias do banco de dados
function getCategories($conn)
{
    $categories = [];
    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}

$categories = getCategories($conn);

if ($query != '') :



    $sql = <<<SQL
SELECT 
    product_id, product_name, product_summary, product_price, product_thumbnail
FROM 
    product 
WHERE 
    product_date <= NOW()
    AND product_status = 'on'
    AND (product_name LIKE ? OR product_summary LIKE ?)
SQL;

    // Prepare the parameters for the query
    $search_query = "%{$query}%";
    $params = ['ss', &$search_query, &$search_query];

    // If a category is selected, add it to the query
    if ($category > 0) {
        $sql .= " AND product_category = ?";
        $params[0] .= 'i';
        $params[] = &$category;
    }

    $sql .= " ORDER BY product_price $order;";

    // prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(...$params);
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

<article>
<div class="form-container">
    <form action="" method="GET">
        <label for="category">Filtrar por Categoria:</label>
        <select name="category" id="category">
            <option value="">Todas as categorias</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['ctr_id']; ?>"><?php echo $category['ctr_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="order">Filtrar por preço:</label>
        <select name="order" id="order">
            <option value="asc">Do Menor para o Maior</option>
            <option value="desc">Do Maior para o Menor</option>
        </select>
        <label for="text">Nome do produto:</label>
        <input type="text" name="q" value="<?php echo $query; ?>" placeholder="Pesquisar...">
        <button type="submit">Filtrar</button>
    </form>
</div>
    <?php echo $search_view; ?>
</article>
<?php require("_footer.php"); ?>