<?php

// Get id
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (isset($_POST['rank_product'])) {
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get the value of rating and product ID from the form
      $rank_scale = $_POST["rank_scale"];
      $rank_product = $_POST["rank_product"];
      $rank_user = $_POST["rank_user"];

      // Prepare the SQL statement to insert the rating into the ranking table
      $sql = "INSERT INTO ranking (rank_scale, rank_product) VALUES ('$rank_scale', '$rank_product')";

      // Check if the SQL query was executed successfully
      if ($conn->query($sql) === TRUE) {
         echo "Avaliação enviada com sucesso!";
      } else {
         echo "Erro ao enviar avaliação: " . $conn->error;
      }
   }
}
// Calculate the average rating of the product
$sql = "SELECT AVG(rank_scale) AS avg_rank FROM ranking WHERE rank_product = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($avg_rank);
$stmt->fetch();
$stmt->close();

// Generate stars based on the average rating
$stars = '';
$rating = round($avg_rank);
for ($i = 1; $i <= 5; $i++) {
   if ($i <= $rating) {
      $stars .= '<span class="fa fa-star checked"></span>';
   } else {
      $stars .= '<span class="fa fa-star"></span>';
   }
}

?>

<div>
   <?php echo $stars; ?> <p> A avaliação média é de <?php echo number_format($avg_rank, 2) ?> estrelas. </p>
   <p>Avalie o produto.</p>
</div>
<div id='rattingSystem'>
</div>