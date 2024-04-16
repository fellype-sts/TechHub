    </main>
    <footer>

        <a href="index.php">
            <i class="fa-solid fa-house fa-fw"></i>
        </a>
        <div>
            <div class="copyright">&copy; 2024 Eu Mesmo!</div>
            <a href="privacy.php">Políticas de Privacidade</a>
        </div>
        <a href="#wrap">
            <i class="fa-solid fa-circle-up fa-fw"></i>
        </a>

    </footer>
    &nbsp;
    </div>

    <?php // Importa as bibliotecas e configuração do Firebase 
    ?>
    <script src="https://www.gstatic.com/firebasejs/10.8.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.1/firebase-auth-compat.js"></script>


    <?php // Importa o JavaScript do tema 
    ?>
    <script src="assets/js/global.js"></script>
    <script>
        function toggleNav() {
            document.body.classList.toggle("nav-open");

            document.querySelector(".nav-close").addEventListener("click", () => {
                toggleNav();
            })
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <?php
    // Importa o JavaScript específico desta página dinâmicamente
    echo $_js;
    ?>


    </body>

    </html>