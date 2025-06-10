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
<?php endif;?>
<?php if($_SESSION['user']!=="admin"):?>
<?php 
     $_SESSION['message']="voce nao e um admin";
     $_SESSION['type']="danger";
 ?>
<?php endif;?>
<?php if($_SESSION['user']!=="admin" || empty($_SESSION['user']) ):?>
<div class="background-section">
    <div class="content">
        <div class="alert alert-<?php echo $_SESSION['type'];?> alert-dismissible" role="alert" id="actions">
            <?php echo $_SESSION['message'];?>
            <button type="button" data-bs-dismiss="alert" aria-label="Close" class="btn-close"></button>
        </div>
        <header>
            <a href="<?php echo RAIZ_PROJETO ;?>index.php" class="btn btn-light"><i class="fa fa-arrow-left"></i>
                Voltar</a>
        </header>
    </div>
</div>
<?php else:?>
<div class="background-section">
    <div class="content">
        <div class="form-section">
            <header>
                <h2>Editar Usuario</h2>
                <a href="index.php"><i class="fa fa-arrow-left"> </i></a>
            </header>
            <form action="edit.php?id=<?php echo $usuario['id'];?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="name">Nome do Usuario</label>
                        <input value="<?php echo $usuario['nome']; ?>" type="text" class="form-control"
                            name="usuario[nome]">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">User</label>
                        <input value="<?php echo $usuario['user']; ?>" type="text" class="form-control"
                            name="usuario[user]">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="campo1">Senha</label>
                        <input value="" type="password" class="form-control" name="usuario[password]" required>
                    </div>
                </div>

                <div class="row">
                    <?php
                        $foto="";
                        if(empty($usuario['foto'])){
                            $foto="semimagem.png";
                           
                        }else{
                            $foto= $usuario['foto'];
                          
                        }
                    ?>
                    <div class="form-group col-md-4">
                        <label for="foto">Foto:</label>
                        <input value="img/<?php echo "$foto";?>" type="file" class="form-control" name="foto" id="foto">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="foto">Pre-Visualização</label>
                        <img class="form-control shadow p-1 mb-1 bg-body rounded" id="imgPreview"
                            src="img/<?php echo "$foto"; ?>" width="200px" alt="foto do usuario">
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