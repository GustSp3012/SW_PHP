<?php 
    include "functions.php";
    if (isset($_GET['pdf'])) {
        $busca=$_GET['pdf'];
        if ($busca === "ok") {
            pdf(null,"customers");
        } else {
            pdf($busca,"customers");
        }
    }
    index();
    include HEADER_TEMPLATE;
?>
<div class="background-section">
    <div class="content">
        <div class="customers">
            <header>
                <h2 class="white">Clientes</h2>
                <div class="actions">
                    <a href="add.php"><i class="fa fa-user-plus"></i><span class="some"> Novo
                            Cliente</span></a>
                    <?php if (!empty($_GET['search'])): ?>
                    <a class="btn btn-danger" href="index.php?pdf=<?php echo urlencode($_GET['search']); ?>" download>
                        <i class="fa fa-file-pdf"></i><span class="some">
                            Listagem</span>
                    </a>
                    <?php else: ?>
                    <a class="btn btn-danger" href="index.php?pdf=ok" download>
                        <i class="fa fa-file-pdf"></i><span class="some">
                            Listagem</span>
                    </a>
                    <?php endif; ?>
                    <a href="index.php"><i class="fa fa-refresh"></i> <span class="some"> Atualizar</span></a>
                    <a id="filter-link"><i id="icon-filter" class="fa-solid fa-filter"></i><span
                            class="some">Filtro</span></a>
                </div>
            </header>

            <div class="search-box" id="search-box" style="display: none;">
                <form method="get" action="index.php" class="d-flex" style="width: 100%;">
                    <input type="text" name="search" id="search-input" placeholder="Filtrar por Nome ou CPF..."
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
                            <th>CPF/CNPJ</th>
                            <th>Opcoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($customers):?>
                        <?php foreach($customers as $customer):?>
                        <tr class="customer-row">
                            <td><?php echo $customer['id']; ?></td>
                            <td class="customer-name"><?php echo $customer['name']; ?></td>
                            <td class="customer-cpf"><?php echo cpf($customer['cpf_cnpj']); ?></td>
                            <td class="d-flex my-actions">
                                <a href="view.php?id=<?php echo $customer['id'];?>" class="ver"><i
                                        class="fa fa-eye"></i><span class="some"> ver</span></a>
                                <a href="edit.php?id=<?php echo $customer['id'];?>" class="editar"><i
                                        class="fa-solid fa-pen-to-square"></i>
                                    <span class="some"> editar</span></a>
                                <a href="#" class="deletar" data-bs-toggle="modal" data-bs-target="#delete-modal"
                                    data-customer="<?php echo $customer['id']; ?>">
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
<?php include("modal.php"); ?>
<?php include  FOOTER_TEMPLATE;?>