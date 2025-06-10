<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

    <!-- swiper sldes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- bootstrap e font awesome-->
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>css/awesome/all.min.css">
    <!-- my css -->
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>css/mycss/global.css">
</head>

<body>
    <script src="<?php echo RAIZ_PROJETO;?>js/main.js"></script>
    <nav class="navbar navbar-expand-md bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand espaçamento_logo" href="<?php echo RAIZ_PROJETO;?>">
                <img src="<?php echo RAIZ_PROJETO;?>css/img_site/logo2.png" alt="Logo"
                    class="d-inline-block align-text-top logo">
                CRUD
            </a>
            <button id="menu-mobile" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <i id="icon-menu-mobile" class="fa-solid fa-list white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 espaçamento ">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Clientes
                        </a>
                        <ul class="dropdown-menu bg-dark">
                            <li class="hover-white"><a class="dropdown-item text-white"
                                    href="<?php echo RAIZ_PROJETO;?>customers/add.php"><i
                                        class="fa-solid fa-user-plus"></i> Novo cliente</a></li>
                            <li class="hover-white"><a class="dropdown-item text-white"
                                    href="<?php echo RAIZ_PROJETO;?>customers"><i class="fa-solid fa-users"></i>
                                    gerenciar clientes</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user-doctor"></i> Farmaceuticos
                        </a>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="dropdown-item text-white" href="<?php echo RAIZ_PROJETO;?>produtos/add.php"><i
                                        class="fa-solid fa-user-nurse"></i> Novo Farmaceutico</a></li>
                            <li><a class="dropdown-item text-white" href="<?php echo RAIZ_PROJETO;?>produtos"><i
                                        class="fa-solid fa-gear"></i> Gerenciar
                                    farmaceuticos</a></li>

                        </ul>
                    </li>
                    <?php if(isset($_SESSION['user'])):?>
                    <?php if($_SESSION['user']==="admin"):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user-tie"></i> Usuarios
                        </a>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="dropdown-item text-white"
                                    href="<?php echo RAIZ_PROJETO; ?>usuarios/add.php"><i
                                        class="fa-solid fa-user-plus"></i> Novo Usuario</a></li>
                            <li><a class="dropdown-item text-white" href="<?php echo RAIZ_PROJETO; ?>usuarios"> <i
                                        class="fa-solid fa-users-gear"></i> Gerenciar
                                    Usuarios</a></li>

                        </ul>
                    </li>
                    <?php endif;?>

                    <li class="nav-item espaçamento">
                        <a class="nav-link white" href="<?php echo RAIZ_PROJETO?>inc/logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i> Sair
                        </a>
                    </li>

                    <?php else:?>
                    <li class="nav-item espaçamento">
                        <a class="nav-link white" href="<?php echo RAIZ_PROJETO;?>inc/login.php">
                            <i class="fa-solid fa-circle-user"></i> Login
                        </a>
                    </li>
                    <?php endif;?>

                </ul>

            </div>

        </div>
    </nav>