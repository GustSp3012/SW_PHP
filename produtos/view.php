<?php 
    include "functions.php";
    view($_GET['id']);
    include HEADER_TEMPLATE;

?>
<div class="background-section">
    <div class="content">
        <div class="view-section container-fluid">

            <?php if(!$produto):?>
            <header>
                <h2>Farmaceutico Não encontrado</h2>
                <a href="index.php"><i class="fa-solid fa-arrow-left"></i> voltar</a>
            </header>
            <?php else:?>
            <header>
                <h2>Farmaceutico <?php echo $produto['id']; ?></h2>
                <a href="index.php"><i class="fa-solid fa-arrow-left"></i> voltar</a>
            </header>
            <div class="dados row">
                <div class="temas col-md-3">
                    <h3>Informações </h3>
                    <dt>Nome:</dt>
                    <dd><?php echo $produto['nome']; ?></dd>

                    <dt>Coren</dt>
                    <dd><?php echo $produto['codigo']; ?></dd>

                </div>
                <div class="temas col-md-3">
                    <h3>outros Dados</h3>
                    <dt>Genero:</dt>
                    <dd><?php echo $produto['genero']; ?></dd>
                </div>

                <div class="temas col-md-3">
                    <h3>Informaçoes Regionais</h3>
                    <dt>Endereço</dt>
                    <dd><?php echo $produto['descricao']; ?></dd>


                </div>

                <div class="temas col-md-3">
                    <h3>Outros dados</h3>
                    <dt>Data de Cadastro:</dt>
                    <dd><?php echo formatadata($produto['data_created'],"d/m/Y - H:i:s"); ?></dd>

                    <dt>Data da última modificação:</dt>
                    <dd><?php echo formatadata($produto['data_modified'],"d/m/Y - H:i:s"); ?></dd>
                </div>
            </div>
            <div class="coluna">
                <dt>Foto:</dt>
                <dd>
                    <?php
                                if(!empty($produto['foto'])){
                                    echo "<img src=\"img/" . $produto['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">" ;
                                }else{
                                    echo "<img src=\"img/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">" ;
                                }		
                                                ?>
                </dd>
            </div>
            <div id="actions" class="actions row">
                <div class="col-md-12">
                    <a href="edit.php?id=<?php echo $produto['id']; ?>"><i class="fa-solid fa-pen-to-square"></i>
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