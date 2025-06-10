<?php 
    include "functions.php";
    view($_GET['id']);
    include HEADER_TEMPLATE;

?>
<div class="background-section">
    <div class="content">
        <div class="view-section container-fluid">

            <?php if(!$usuario):?>
            <header>
                <h2>Usuario Não encontrado</h2>
                <a href="index.php"><i class="fa-solid fa-arrow-left"></i> voltar</a>
            </header>
            <?php else:?>
            <header>
                <h2>Usuario <?php echo $usuario['id']; ?></h2>
                <a href="index.php"><i class="fa-solid fa-arrow-left"></i> voltar</a>
            </header>
            <div class="dados row">
                <div class="temas col-md-3">

                    <dt>Nome:</dt>
                    <dd><?php echo $usuario['nome']; ?></dd>

                    <dt>User</dt>
                    <dd><?php echo $usuario['user']; ?></dd>

                </div>

                <div class="temas col-md-3">
                    <dt>Senha:</dt>
                    <dd><?php echo $usuario['password']; ?></dd>
                </div>
            </div>
            <div class="coluna">
                <dt>Foto:</dt>
                <dd>
                    <?php
                                if(!empty($usuario['foto'])){
                                    echo "<img src=\"img/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">" ;
                                }else{
                                    echo "<img src=\"img/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">" ;
                                }		
                                                ?>
                </dd>
            </div>
            <div id="actions" class="actions row">
                <div class="col-md-12">
                    <a href="edit.php?id=<?php echo $usuario['id']; ?>"><i class="fa-solid fa-pen-to-square"></i>
                        Editar</a>
                    <a href="index.php"><i class="fa-solid fa-circle-arrow-left"></i>
                        Voltar</a>
                </div>
            </div>

            <?php endif;?>
        </div>
    </div>
</div>

<?php 
include FOOTER_TEMPLATE;
?>