<?php 
	include("functions.php");
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
        if (isset($_GET['id'])){
            try{
                $produto=find("produtos",$_GET['id']);
                
                
                if(!verificaDuplicadas("produtos","foto",$produto['foto'])){
                    unlink("img/". $produto['foto']);
                }
                delete($_GET['id']);
                header("Location: index.php");
                exit();
            
            
            }catch(Exception $e){
                $_SESSION['message']="Aconteceu um erro". $e->getMessage();
                $_SESSION['type']="danger";
            }
        }
        else{
            include (HEADER_TEMPLATE);
            echo"<div class=\"alert alert-danger alert-dismissible\" role=\"alert\" id=\"actions\">
                    Nao recebemos nenhum id
                    <button type=\"button\" data-bs-dismiss=\"alert\" aria-label=\"Close\" class=\"btn-close\"></button>
                </div>
                <header>
                    <a href=\"". RAIZ_PROJETO. "index.php\" class=\"btn btn-light\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
                </header>";
                include(FOOTER_TEMPLATE);
                die();
        }
    }
    
?>