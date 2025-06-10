<?php 
    include "functions.php";
    edit();
    include HEADER_TEMPLATE;
?>
<?php if(empty($_SESSION['user'])):?>
<?php 
     $_SESSION['message']="voce nao esta logado";
     $_SESSION['type']="danger";
 ?>
<div class="background-section">
    <div class="content">
        <div class="alert alert-<?php echo $_SESSION['type'];?> alert-dismissible" role="alert" id="actions">
            <?php echo $_SESSION['message'];?>
            <button type="button" data-bs-dismiss="alert" aria-label="Close" class="btn-close"></button>
        </div>
        <header>
            <a href="<?php echo RAIZ_PROJETO ;?>produtos/index.php" class="btn btn-light"><i class="fa fa-arrow-left"></i>
                Voltar</a>
        </header>
    </div>
</div>
<?php else:?>
<div class="background-section">
    <div class="content">
        <div class="form-section">
            <header>
                <h2>Editar Farmaceutico</h2>
                <a href="index.php"><i class="fa fa-arrow-left"> </i></a>
            </header>
            <form action="edit.php?id=<?php echo $produto['id'];?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="name">Nome</label>
                        <input value="<?php echo $produto['nome']; ?>" type="text" class="form-control"
                            name="produto[nome]">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">Coren</label>
                        <input maxlength="6" value="<?php echo $produto['codigo']; ?>" type="text" class="form-control"
                            name="produto[codigo]">
                    </div>
                </div>
                <div class="row">


                    <div class="form-group col-md-5">
                        <label for="campo2">Endereço</label>
                        <input value="<?php echo $produto['descricao']; ?>" type="text" class="form-control"
                            name="produto['descricao']">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="campo3">Gênero</label>
                        <input value="<?php echo $produto['genero']; ?>" type="text" class="form-control"
                            name="produto[genero]">
                    </div>
                </div>

                <div class="row">
                    <?php
                        $foto="";
                        if(empty($produto['foto'])){
                            $foto="semimagem.png";
                           
                        }else{
                            $foto= $produto['foto'];
                          
                        }
                    ?>
                    <div class="form-group col-md-4">
                        <label for="foto">Foto:</label>
                        <input value="img/<?php echo "$foto";?>" type="file" class="form-control" name="foto" id="foto">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="foto">Pre-Visualização</label>
                        <img class="form-control shadow p-1 mb-1 bg-body rounded" id="imgPreview"
                            src="img/<?php echo "$foto"; ?>" width="200px" alt="foto do produto">
                    </div>
                </div>

                <div id="actions" class="row mt-2 actions">
                    <div class="col-md-12">
                        <button type="submit" name="submit"><i class="fa-solid fa-sd-card"></i>
                            Salvar</button>
                        <a href="index.php" class=""><i class="fa-solid fa-circle-arrow-left"></i>
                            Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif;?>
<?php   
    include FOOTER_TEMPLATE;
?>
<script>
$(document).ready(() => {
    $("#foto").change(function() {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $("#imgPreview").attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>