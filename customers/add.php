<?php 
	include("functions.php"); 
	add();
	include(HEADER_TEMPLATE); 
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
                <h2>Novo Cliente</h2>
                <a href="index.php"><i class="fa-solid fa-arrow-left"></i> voltar</a>
            </header>
            <form action="add.php" method="post">
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="name">Nome / Razão Social</label>
                        <input type="text" class="form-control" name="customer[name]" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">CNPJ / CPF</label>
                        <input type="text" placeholder="00000000000" class="form-control" name="customer[cpf_cnpj]"
                            required maxlength="11">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Data de Nascimento</label>
                        <input type="date" class="form-control" name="customer[birthdate]" required>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="campo3">CEP</label>
                    <input type="text" maxlength="8" placeholder="00000000" class="form-control"
                        name="customer[zip_code]" required>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="campo1">Endereço</label>
                        <input type="text" class="form-control" name="customer[address]" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">Bairro</label>
                        <input type="text" class="form-control" name="customer[hood]" required>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="campo1">Município</label>
                        <input type="text" class="form-control" name="customer[city]" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo2">Telefone</label>
                        <input type="tel" class="form-control" name="customer[phone]" maxlength="11" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Celular</label>
                        <input type="tel" class="form-control" name="customer[mobile]" maxlength="11" required>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="campo3">UF</label>
                        <input type="text" class="form-control" name="customer[state]" maxlength="2" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Inscrição Estadual</label>
                        <input type="text" maxlength="6" class="form-control" name="customer[ie]" required
                            placeholder="000000">
                    </div>

                </div>

                <div id="actions" class="row mt-2 actions">
                    <div class="col-md-12">
                        <button type="submit"><i class="fa-solid fa-sd-card"></i>
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
$(document).ready(function() {
    $('input[name="customer[zip_code]"]').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');

        if (cep.length === 8) {
            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                if (!('erro' in data)) {
                    // Preenche os campos com os valores retornados pela API
                    $('input[name="customer[address]"]').val(data.logradouro);
                    $('input[name="customer[hood]"]').val(data.bairro);
                    $('input[name="customer[city]"]').val(data.localidade);
                    $('input[name="customer[state]"]').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                }
            }).fail(function() {
                alert('Erro ao buscar o CEP. Tente novamente.');
            });
        } else {
            alert('CEP inválido.');
        }
    });
});
</script>