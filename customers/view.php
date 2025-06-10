<?php 
   include "functions.php";
    view($_GET['id']);
    include HEADER_TEMPLATE;
   
?>
<div class="background-section">
    <div class="content">
        <div class="view-section container-fluid">

            <?php if(!$customer):?>
            <header>
                <h2>Cliente Não encontrado</h2>
                <a href="index.php"><i class="fa-solid fa-arrow-left"></i> voltar</a>
            </header>
            <?php else:?>
            <header>
                <h2>Cliente <?php echo $customer['id']; ?></h2>
                <a href="index.php"><i class="fa-solid fa-arrow-left"></i> voltar</a>
            </header>
            <div class="dados row">
                <div class="temas col-md-3">
                    <h3>Informações Pessoais</h3>
                    <dt>Nome / Razão Social:</dt>
                    <dd><?php echo $customer['name']; ?></dd>

                    <dt>CPF / CNPJ:</dt>
                    <dd><?php echo cpf($customer['cpf_cnpj']); ?></dd>

                    <dt>Data de Nascimento:</dt>
                    <dd><?php echo formatadata($customer['birthdate'],"d/m/Y"); ?></dd>
                </div>
                <div class="temas col-md-3">
                    <h3>Contatos</h3>
                    <dt>Telefone:</dt>
                    <dd><?php echo telefone($customer['phone']); ?></dd>

                    <dt>Celular:</dt>
                    <dd><?php echo telefone($customer['mobile']); ?></dd>
                </div>

                <div class="temas col-md-3">
                    <h3>Localização</h3>
                    <dt>Endereço:</dt>
                    <dd><?php echo $customer['address']; ?></dd>

                    <dt>Bairro:</dt>
                    <dd><?php echo $customer['hood']; ?></dd>

                    <dt>CEP:</dt>
                    <dd><?php echo cep($customer['zip_code']); ?></dd>

                    <dt>Cidade:</dt>
                    <dd><?php echo $customer['city']; ?></dd>


                </div>

                <div class="temas col-md-3">
                    <h3>Outros dados</h3>
                    <dt>Data de Cadastro:</dt>
                    <dd><?php echo formatadata($customer['created'],"d/m/Y - H:i:s"); ?></dd>

                    <dt>Data da última modificação:</dt>
                    <dd><?php echo formatadata($customer['modified'],"d/m/Y - H:i:s"); ?></dd>



                    <dt>UF:</dt>
                    <dd><?php echo $customer['state']; ?></dd>

                    <dt>Inscrição Estadual:</dt>
                    <dd><?php echo number_format($customer['ie'], 0, ",", "."); ?></dd>
                </div>
            </div>
            <div id="actions" class="actions row">
                <div class="col-md-12">
                    <a href="edit.php?id=<?php echo $customer['id']; ?>"><i class="fa-solid fa-pen-to-square"></i>
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