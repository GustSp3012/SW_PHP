    <?php
    include('functions.php');
    if (isset($_GET['pdf'])) {
        if ($_GET['pdf'] === "ok") {
            pdf(null,"produtos");
        } else {
            pdf($_GET['pdf'],"produtos");
        }
    }
    index();
    include(HEADER_TEMPLATE);

    ?>

    <div class="background-section">
        <div class="content">
            <div class="customers">
                <header>
                    <h2 class="white">Farmaceuticos</h2>
                    <div class="actions">
                        <a class="" href="add.php"><i class="fa fa-user-plus"></i><span class="some"> Novo
                                Farmaceutico</span></a>
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
                        <a class="" href="index.php"><i class="fa fa-refresh"></i> <span class="some">
                                Atualizar</span></a>
                        <a id="filter-link"><i id="icon-filter" class="fa-solid fa-filter"></i><span class="some">
                                Filtro</span></a>
                    </div>
                </header>

                <div class="search-box" id="search-box" style="display: none;">
                    <form method="get" action="index.php" class="d-flex" style="width: 100%;">
                        <input type="text" name="search" id="search-input" placeholder="Filtrar por Nome ou Coren..."
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit" style="display: none;"></button> <!-- dispara ao pressionar Enter -->
                    </form>
                </div>
                <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php clear_messages(); ?>
                <?php endif; ?>

                <div class="table-container">
                    <table class="white">
                        <thead class="table-head">
                            <tr class="table-head-row">
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Coren</th>
                                <th class="some-mobile">Foto</th>
                                <th>Opcoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($produtos):?>
                            <?php foreach($produtos as $produto):?>
                            <tr class="produto-row">
                                <td><?php echo $produto['id']; ?></td>
                                <td class="produto-name"><?php echo $produto['nome']; ?></td>
                                <td class="produto-codigo"><?php echo $produto['codigo']; ?></td>
                                <td class="some-mobile">
                                    <?php 
                                        $foto=$produto['foto'];
                                        if(isset($foto)){
                                            echo "<img src=\"img/$foto\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\"";
                                        }else{
                                            echo "<img src=\"img/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
                                        }
                                    ?>
                                </td>
                                <td class="my-actions">
                                    <a href="view.php?id=<?php echo $produto['id'];?>" class="ver"><i
                                            class="fa fa-eye"></i><span class="some"> ver</span></a>
                                    <a href="edit.php?id=<?php echo $produto['id'];?>" class="editar"><i
                                            class="fa-solid fa-pen-to-square"></i>
                                        <span class="some"> editar</span></a>
                                    <a href="#" class="deletar" data-bs-toggle="modal"
                                        data-bs-target="#delete-modal-game"
                                        data-produto="<?php echo $produto['id']; ?>">
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


    <?php include "modal.php"; ?>
    <?php include(FOOTER_TEMPLATE); ?>