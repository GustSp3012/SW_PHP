<?php 
include("../config.php");
include DBAPI;
require_once(PDF);

$produtos = null;
$produto = null;

function index(){
    global $produtos;
    if(empty($_GET['search'])){
		$produtos=find_all("produtos");
	}else{
		$resulFiltro= $_GET['search'];
		$produtos=filter("produtos","nome LIKE '%$resulFiltro%' OR codigo LIKE '%$resulFiltro%'");
	}
}
function upload($pasta_destino,$arquivo_destino,$tipo_arquivo,$nome_temp,$tamanho_arquivo){
		try{
			$nomearquivo= basename($arquivo_destino);
			$ok=1;

			//verifica se é uma imagem
			if(isset($_POST["submit"])) {
				$check=getimagesize($nome_temp);
				if($check !== false){
					$_SESSION['message']="O arquivo é uma imagem -".$check["mime"].".";
					$_SESSION['type']="info" ;
					$ok=1;
					
					
				}else{
					$ok=0;
					
					throw new Exception("O arquivo não é uma imagem");
				}

				//verifica se ja existe essa imagem na pasta
				if(file_exists($arquivo_destino)){
					$ok=0;
					return true;
					
					
				
					throw new Exception("essa imagem ja existe no nosso sistema ");
				}

				//verifica o tamanho do arquivo
				if($tamanho_arquivo> 5000000000){
					$ok=0;

					
					throw new Exception("arquivo muito grande ");
				}
				
				//verifica tipo do arquivo
				if($tipo_arquivo!="jpg"&&$tipo_arquivo!="jpeg"&&$tipo_arquivo!="png"&&$tipo_arquivo!="gif"){
					$ok=0;
				
					
					throw new Exception("são permetidos apenas jpeg,jpg,png,gif ");
						
				}

				if($ok==0){
					throw new Exception("upload não podera prosseguir ");
					exit();
					
				}else{
					$caminho_tmp= $_FILES["foto"]["tmp_name"];
					if(move_uploaded_file($caminho_tmp,$arquivo_destino)){
						$_SESSION['message']="O arquivo". htmlspecialchars($nomearquivo)." foi armazenado";
						$_SESSION['type']="success";
						return true;
				
						
					}else{
						throw new Exception("Desculpe mas o upload nao pode ser feito");
						return false;
					}
					
						
				}
			}
		}catch(Exception $e){
			$_SESSION['message']="Aconteceu um erro". $e->getMessage();
			$_SESSION['type']="danger";
		}
	}
function add(){
   if(!empty($_POST['produto'])){
        try{
            $produto=$_POST['produto'];
			
			
            if(!empty($_FILES['foto']['name'])){
                $arquivo=$_FILES['foto'];
                $pasta_destino="img/";
                $arquivo_destino=$pasta_destino.basename($arquivo["name"]);
                $nomearquivo=basename($arquivo["name"]);
                $resolucao_arquivo=getimagesize($arquivo["tmp_name"]);
                $tamanho_arquivo=$arquivo["size"];
                $nome_temp=$arquivo["tmp_name"];
                $tipo_arquivo= strtolower(pathinfo($arquivo_destino,PATHINFO_EXTENSION));

                if(upload($pasta_destino,$arquivo_destino,$tipo_arquivo,$nome_temp,$tamanho_arquivo)){
                    $produto['foto']=$nomearquivo;
                }

            }
            $today = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
            $produto['data_modified'] = $produto['data_created'] = $today->format("Y-m-d H:i:s");
			

            save("produtos", $produto);
            header("location: index.php");
        }catch(Exception $e){

        }
   }
    
}

function view($id=null){
    global $produto;
    $produto = find('produtos',$id);
    
} 

function edit(){
   $agora=new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    if($_GET['id']){
         $id=$_GET['id'];
        if(isset($_POST['produto'])){
            global $produto;
            $produto=$_POST['produto'];
            $produto['data_modified']=$agora->format("Y-m-d H:i:s");
			$arquivo= $_FILES["foto"];
		
					
					if(!empty($arquivo["name"])){
						$pasta_destino="img/";
						$arquivo_destino=$pasta_destino.basename($arquivo["name"]);
						$nomearquivo=basename($arquivo["name"]);
						$resolucao_arquivo=getimagesize($arquivo["tmp_name"]);
						$tamanho_arquivo=$arquivo["size"];
						$nome_temp=$arquivo["tmp_name"];
						$tipo_arquivo=strtolower(pathinfo($arquivo_destino,PATHINFO_EXTENSION));
						
						
							if(upload($pasta_destino,$arquivo_destino,$tipo_arquivo,$nome_temp,$tamanho_arquivo)){
								$produto['foto']=$nomearquivo;
							}
					}
					
           update('produtos',$id,$produto);
		   verificaDuplicadas('produtos', 'foto',$produto['foto']);
           header("location: index.php");
        }else{
            global $produto;
            $produto=find('produtos',$id);
        }
    }else{
       

    }
}

function delete($id = null) {

		global $produto;
		$produto = remove("produtos", $id);

		header('location: index.php');
}

function pdf($p = null, $tabela =null) {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
	// Obter dados da tabela especificada
    if ($p) {
        $dadosBrutos = filter($tabela, "nome LIKE '%$p%' OR codigo LIKE '%$p%'");
    } else {
        $dadosBrutos = find_all($tabela);
    }

    
    if (empty($dadosBrutos)) {
        $pdf->Cell(0, 10, 'Nenhum dado encontrado.', 1, 1, 'C');
        $pdf->Output();
        return;
    }


    $cabecalhos = array_keys($dadosBrutos[0]);

    
    $pdf->TabelaComBordas($cabecalhos, $dadosBrutos);
    $pdf->Output();
}






?>