<?php 
    include "functions.php";
    if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

    if(empty($_SESSION['user'])){
        $_SESSION['message']="Você não está logado!";
		$_SESSION['type']="danger";
		header("Location:index.php");
		exit();
    }
    else{
        if($_GET['id']){
            delete($_GET['id']);
            header("location: index.php");
        }
        else{
            $_SESSION['message']="cliente nao encontrado";
		    $_SESSION['type']="danger";
            header("location: index.php");
        }
    }
    


?>