<?php 
    include "../config.php";
    include HEADER_TEMPLATE;
?>

<div class="background-section">
    <div class="content">
        <div class="login-container">
            <div class="login">
                <div class="header-login">
                    <h3>Login</h3>
                    <hr>
                    <p>entre em sua conta</p>
                </div>
                <form class="body-login" action="valida.php" method="post">
                    <div class="campo-login">
                        <label for="user">Login</label>
                        <input type="text" name="user" id="user" required>
                    </div>
                    <div class="campo-login">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" required>
                    </div>
                    <div class="footer-login">
                        <button type="submit"><i class="fa-solid fa-sd-card"></i><span
                                class="some-mobile">Salvar</span></button>
                        <a href="../index.php"><i class="fa-solid fa-arrow-left"></i><span
                                class="some-mobile">Cancelar</span></a>
                    </div>
                </form>
            </div>
            <div class="login-contato">
                <p>Nao tem conta?! Entre em contatom um adm</p>
                <a href="#"><i class="fa-solid fa-phone"></i>Contato</a>
            </div>
        </div>
    </div>
</div>











<?php  include FOOTER_TEMPLATE; ?>