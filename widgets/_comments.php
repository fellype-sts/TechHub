<?php


if (isset($_POST['txt_comment'])) :


    $cmtform = [
        'product_id' => intval($_POST['product_id']),
        'social_id' => trim(htmlspecialchars($_POST['social_id'])),
        'social_name' => trim(htmlspecialchars($_POST['social_name'])),
        'social_photo' => trim(filter_input(INPUT_POST, 'social_photo', FILTER_SANITIZE_URL)),
        'social_email' => trim(filter_input(INPUT_POST, 'social_email', FILTER_SANITIZE_EMAIL)),
        'txt_comment' => trim(strip_tags($_POST['txt_comment']))
    ];


    if (!in_array("", $cmtform)) :


        $sql = <<<SQL

        INSERT INTO comment (
            cmt_product,
            cmt_social_id,
            cmt_social_name,
            cmt_social_photo,
            cmt_social_email,
            cmt_content
        ) VALUES (
            ?,?,?,?,?,?
        )

        SQL;


        $stmt = $conn->prepare($sql);


        $stmt->bind_param(
            "isssss",
            $cmtform['product_id'],
            $cmtform['social_id'],
            $cmtform['social_name'],
            $cmtform['social_photo'],
            $cmtform['social_email'],
            $cmtform['txt_comment']
        );


        $stmt->execute();

    endif;

endif;

// Query 
$sql = <<<SQL

SELECT 
cmt_id, cmt_social_name, cmt_social_photo, cmt_content,
DATE_FORMAT(cmt_date, "%d/%m/%Y às %H:%i") AS cmt_datebr
FROM comment
WHERE
	cmt_product = '{$id}'
    AND cmt_status = 'on'
ORDER BY cmt_date DESC;

SQL;

// Execute
$res = $conn->query($sql);

// Count comments
$cmt_total = $res->num_rows;

// Subtitle
if ($cmt_total == 0) $view_total = '<h5>Nenhum comentário</h5>';
elseif ($cmt_total == 1) $view_total = '<h5>1 comentário</h5>';
else $view_total = "<h5>{$cmt_total} comentários</h5>";

// If exists comments:
if ($cmt_total > 0) :

    // Loop
    $comments_view = '';
    while ($cmt = $res->fetch_assoc()) :

        // Sanitize
        $cmt_content = htmlspecialchars(trim($cmt['cmt_content']));

        $comments_view .= <<<HTML

<div class="cmt_box">
    <div class="cmt_header">
        <img src="{$cmt['cmt_social_photo']}" alt="{$cmt['cmt_social_name']}" referrerpolicy="no-referrer">
        <small>Por {$cmt['cmt_social_name']} em {$cmt['cmt_datebr']}.</small>
    </div>
    <div class="cmt_body">{$cmt_content}</div>
</div>

HTML;

    endwhile;

// If doesn't exist comments
else :

    $comments_view = '<p class="center">Seja o(a) primeiro(a) a comentar.</p>';

endif;

?>

<div class="comment_section">
    <h2 id="comment">Comentários</h2>
    <div id="commentBox"></div>
    <?php echo $view_total ?>
    <?php echo html_entity_decode($comments_view) ?>
</div>
</div>