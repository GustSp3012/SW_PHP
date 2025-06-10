            <?php include(COOKIE_TEMPLATE_POLITICA); //linha incluida ?>
            <?php include(COOKIE_TEMPLATE); //linha incluida ?>

            <footer class="container">
                <?php $date = new DateTime("now"); ?>
                <p>&copy; 2018 a <?php echo $date->format("Y"); ?> - Prof. Luiz Flávio</p>
            </footer>
            <script src="<?php echo RAIZ_PROJETO; ?>js/jquery-3.7.1.min.js"></script>
            <script src="<?php echo RAIZ_PROJETO; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
            <script src="<?php echo RAIZ_PROJETO; ?>js/awesome/all.min.js"></script>
            <script src="<?php echo RAIZ_PROJETO; ?>js/main.js"></script>

            </body>

            </html>