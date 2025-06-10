<?php 
	include("functions.php");
	 if (session_status() === PHP_SESSION_NONE) {
				session_start();
		}
        if (isset($_GET['id'])){
		try{
			$usuario=find("usuarios",$_GET['id']);
			
			
			if(!verificaDuplicadas("produtos","foto",$usuario['foto'])){
				unlink("img/". $usuario['foto']);
			}
			delete($_GET['id']);
			header("Location: index.php");
			exit();
			
			
		}catch(Exception $e){
			$_SESSION['message']="Aconteceu um erro". $e->getMessage();
			$_SESSION['type']="danger";
		}
	}else{
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


	// original
	// if (isset($_GET['id'])){
	// 	delete($_GET['id']);
	// } else {
	// 	die("ERRO: ID não definido.");
	// }
?>