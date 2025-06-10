<?php
include('functions.php');

if (isset($_GET['pdf'])) {
    if ($_GET['pdf'] === "ok") {
        pdf(null,"usuarios");
    } else {
        pdf($_GET['pdf'],"usuarios");
    }
   
}



index();
include(HEADER_TEMPLATE);

?>
<?php if(empty($_SESSION['user'])):?>
<?php 
     $_SESSION['message']="voce nao esta logado";
     $_SESSION['type']="danger";
     header("Location: ../index.php");
     exit();
 ?>
<?php endif;?>
<?php if($_SESSION['user']!=="admin"):?>
<?php 
     $_SESSION['message']="voce nao e um admin";
     $_SESSION['type']="danger";
     header("Location: ../index.php");
     exit();
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
        <div class="usuarios">
            <div class="customers">
                <header>
                    <h2 class="white">Usuarios</h2>
                    <div class="actions">
                        <a class="" href="add.php"><i class="fa fa-user-plus"></i><span class="some"> Novo
                                usuario</span></a>
                        <?php if (!empty($_GET['search'])): ?>
                        <a class="btn btn-danger" href="index.php?pdf=<?php echo urlencode($_GET['search']); ?>"
                            download>
                            <i class="fa fa-file-pdf"></i><span class="some">Listagem</span>
                        </a>
                        <?php else: ?>
                        <a class="btn btn-danger" href="index.php?pdf=ok" download>
                            <i class="fa fa-file-pdf"></i><span class="some">Listagem</span>
                        </a>
                        <?php endif; ?>

                        <a class="" href=" index.php"><i class="fa fa-refresh"></i> <span class="some">
                                Atualizar</span></a>
                        <a id="filter-link"><i id="icon-filter" class="fa-solid fa-filter"></i><span class="some">
                                Filtro</span></a>
                    </div>
                </header>

                <div class="search-box" id="search-box" style="display: none;">
                    <form method="get" action="index.php" class="d-flex" style="width: 100%;">
                        <input type="text" name="search" id="search-input" placeholder="Filtrar por Nome ou CPF..."
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit" style="display: none;"></button> <!-- dispara ao pressionar Enter -->
                    </form>
                </div>

                <div class="table-container">
                    <table class="white">
                        <thead class="table-head">
                            <tr class="table-head-row">
                                <th>ID</th>
                                <th>Nome</th>
                                <th>User</th>
                                <th class="some-mobile">Foto</th>
                                <th>Opcoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($usuarios):?>
                            <?php foreach($usuarios as $usuario):?>
                            <tr class="usuarios-row">
                                <td><?php echo $usuario['id']; ?></td>
                                <td class="usuario-name"><?php echo $usuario['nome']; ?></td>
                                <td class="usuario-user"><?php echo $usuario['user']; ?></td>
                                <td class="some-mobile">
                                    <?php 
                                        $foto=$usuario['foto'];
                                        if(isset($foto)){
                                            echo "<img src=\"img/$foto\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\"";
                                        }else{
                                            echo "<img src=\"img/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
                                        }
                                    ?>
                                </td>
                                <td class="my-actions">
                                    <a href="view.php?id=<?php echo $usuario['id'];?>" class="ver"><i
                                            class="fa fa-eye"></i><span class="some"> ver</span></a>
                                    <a href="edit.php?id=<?php echo $usuario['id'];?>" class="editar"><i
                                            class="fa-solid fa-pen-to-square"></i>
                                        <span class="some"> editar</span></a>
                                    <a href="#" class="deletar" data-bs-toggle="modal"
                                        data-bs-target="#delete-modal-usuario"
                                        data-usuario="<?php echo $usuario['id']; ?>">
                                        <i class="fa fa-trash"></i> <span class="some"> Excluir</span>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <tr>
                                <td colspan="6">Nenhum registro encontrado.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>


                    </table>
                </div>

            </div>
        </div>
    </div>
    <?php endif?>

    <?php include('modal.php');?>

    <?php include(FOOTER_TEMPLATE);?>