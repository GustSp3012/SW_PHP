<?php 
    include("config.php");
    include DBAPI;
    include HEADER_TEMPLATE;
?>
<div class="background-section">
    <div class="content">
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php clear_messages(); ?>
    <?php endif; ?>
        <div class="boxes">
            <div class="myflex">
           
                <div class="moldura">
                    <a href="customers/add.php">
                        <i class="fa-solid fa-user-plus fa-5x"></i>
                        <p>Novo cliente</p>
                    </a>
                </div>
                <div class="moldura">
                    <a href="customers/index.php" class="index-buttons">
                        <i class="fa-solid fa-users fa-5x"></i>
                        <p>gerenciar cliente</p>
                    </a>
                </div>
            </div>
            <div class="myflex">
                <div class="moldura">
                    <a href="produtos/add.php" class="index-buttons">
                        <i class="fa-solid fa-user-nurse fa-5x"></i>
                        <p>Novo Farmaceutico</p>
                    </a>
                </div>
                <div class="moldura">
                    <a href="produtos/" class="index-buttons">


                        <i class="fa-solid fa-gear fa-5x"></i>

                        <p>gerenciar farmaceuticos</p>


                    </a>
                </div>
            </div>
            <?php if(isset($_SESSION["user"])):?>
            <?php if($_SESSION['user']==="admin"):?>
            <div class="myflex">
                <div class="moldura">
                    <a href="usuarios/add.php" class="index-buttons">


                        <i class="fa-solid fa-user-gear fa-5x"></i>

                        <p>Novo usuario</p>


                    </a>
                </div>
                <div class="moldura">
                    <a href="usuarios/" class="index-buttons">


                        <i class="fa-solid fa-users-gear fa-5x"></i>

                        <p>gerenciar usuarios</p>
                    </a>
                </div>
            </div>
            <?php endif;?>
            <?php endif;?>
           
           
        </div>

    </div>
</div>
<?php 
    include FOOTER_TEMPLATE;
?>
 