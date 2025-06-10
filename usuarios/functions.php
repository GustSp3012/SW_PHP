<?php 
include("../config.php");
include DBAPI;
require_once(PDF);


$usuarios = null;
$usuario = null;

function index() {
    global $usuarios;

    if (!empty($_GET['search'])) {
        $busca = $_GET['search'];
        $usuarios = filter("usuarios", "nome LIKE '%$busca%' OR user LIKE '%$busca%'");
    } else {
        $usuarios = find_all("usuarios");
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
   if(!empty($_POST['usuario'])){
        try{
            $usuario=$_POST['usuario'];
			if(!empty($usuario['password'])){		
				$senha= criptografia($usuario['password']);
				$usuario['password']= $senha;
			}
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
                    $usuario['foto']=$nomearquivo;
                }
            }


            save("usuarios", $usuario);
            header("location: index.php");
        }catch(Exception $e){

        }
   }
    
}

function view($id=null){
    global $usuario;
    $usuario = find('usuarios',$id);
    
} 

function edit(){
    if($_GET['id']){
         $id=$_GET['id'];
        if(isset($_POST['usuario'])){
            global $usuario;
            $usuario=$_POST['usuario'];
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
								$usuario['foto']=$nomearquivo;
							}
					}
					if(!empty($usuario['password']))	{
						$senha= criptografia($usuario['password']);
						$usuario['password']= $senha;
					}
					
				
			
			
           update('usuarios',$id,$usuario);
		   verificaDuplicadas('usuarios', 'foto', $usuario['foto']);
           header("location: index.php");
        }else{
            global $usuario;
            $usuario=find('usuarios',$id);
        }
    }else{
       

    }
}

function delete($id = null) {

		global $usuario;
		$usuario = remove("usuarios", $id);

		header('location: index.php');
}

/**
 * Gerando PDF
 */
function pdf($p = null, $tabela =null) {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Obter dados da tabela especificada
    if ($p) {
        $dadosBrutos = filter($tabela, "nome like '%" . $p . "%'");
		echo '<pre>';
		var_dump($dadosBrutos);
		echo '</pre>';
		exit();
    } else {
        $dadosBrutos = find_all($tabela);
    }

    // Se não houver dados, evita erro
    if (empty($dadosBrutos)) {
        $pdf->Cell(0, 10, 'Nenhum dado encontrado.', 1, 1, 'C');
        $pdf->Output();
        return;
    }

    // Pega os nomes das colunas do primeiro registro
    $cabecalhos = array_keys($dadosBrutos[0]);

    // Envia para a função da tabela
    $pdf->TabelaComBordas($cabecalhos, $dadosBrutos);
    $pdf->Output();
}








?>