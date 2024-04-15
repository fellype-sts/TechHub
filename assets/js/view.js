// Referência dos elementos HTML
const commentBox = document.getElementById('commentBox');

const rattingSystem = document.getElementById('rattingSystem')

// Monitora se houve mudanças na autenticação do usuário
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // Se alguém se logou, faça isso:
        showCommentField(user);
        showRatingField(user);
    } else {
        // Se alguém deslogou, faça isso:
        showLoginLink();
    }
});

function showCommentField(user) {
    // Obtém o id do artigo atual
    var searchParams = new URLSearchParams(window.location.search);
    // Obtém o valor do parâmetro "id"
    var idValue = parseInt(searchParams.get('id'));
    // Gera a view do formulário de comentários
    commentBox.innerHTML = `
<form method="post" action="view.php?id=${idValue}#comment" name="comment" id="commentForm" onsubmit="preSanitize()">
    <input type="hidden" name="product_id" value="${idValue}">
    <input type="hidden" name="social_id" value="${user.uid}">
    <input type="hidden" name="social_name" value="${user.displayName}">
    <input type="hidden" name="social_photo" value="${user.photoURL}">
    <input type="hidden" name="social_email" value="${user.email}">
    <textarea name="txt_comment" id="txtComment" placeholder="Comente aqui!" required minlength="3"></textarea>
    <button type="submit">Enviar</button>
</form>
    `;
}
function showRatingField(user){
    var searchParams = new URLSearchParams(window.location.search);

    var idValue = parseInt(searchParams.get('id'));

    rattingSystem.innerHTML = `
    <form method="post" action="view.php?id=${idValue}#rating" name="rating" id="ratingForm">
      <input type="hidden" name="rank_product" value="${idValue}">
      <input type="hidden" name="rank_user" value="${user.uid}">
      <label for="rank_scale">Escolha sua avaliação (de 1 a 5):</label>
      <input type="number" name="rank_scale" id="rank_scale" min="1" max="5" step="1" inputmode="numeric" required>
      <button type="submit">Enviar Avaliação</button>
    </form>
    `
}

function showLoginLink() {
    commentBox.innerHTML = `
<p><a href="login.php?ref=${location.href}%23comment">
    Logue-se</a> para comentar.
</p>
    `;
}

// Função que pré-sanitiza os comentários
function preSanitize() {
    const txtComment = document.getElementById('txtComment');
    txtComment.value = stripTags(txtComment.value);
}

// Checks if the user has already rated the product
function hasRatedProduct(productId) {
    // Checks if the product ID is stored in local storage
    var ratedProducts = localStorage.getItem("ratedProducts");
    if (!ratedProducts) {
        return false;
    }
    var ratedProductsArray = JSON.parse(ratedProducts);
    return ratedProductsArray.includes(productId);
}

// Function to submit the rating
function submitRating() {
    // Get the product ID
    var productId = document.getElementById("rank_product").value;
    
    // Check if the user has already rated the product
    if (hasRatedProduct(productId)) {
        alert("Você já avaliou este produto!");
        return false; // Prevents the rating submission
    }

    // If the user has not yet rated the product, allow the rating submission
    // Insert code here to send the rating to the server
    // ...

    // Add the product ID to the list of rated products in local storage
    var ratedProducts = localStorage.getItem("ratedProducts");
    var ratedProductsArray = ratedProducts ? JSON.parse(ratedProducts) : [];
    ratedProductsArray.push(productId);
    localStorage.setItem("ratedProducts", JSON.stringify(ratedProductsArray));

    return true; // Allows the rating submission
}
