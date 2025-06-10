<?php 
include("../config.php");
include DBAPI;
require_once(PDF);

$customers = null;
$customer = null;

function index() {
    global $customers;

    if (!empty($_GET['search'])) {
        $busca = $_GET['search'];
        $customers = filter("customers", "name LIKE '%$busca%' OR cpf_cnpj LIKE '%$busca%'");
    } else {
        $customers = find_all("customers");
    }
}

function add(){
    if(!empty($_POST['customer'])){
       
        $today= new DateTime("now",new DateTimeZone("America/Sao_Paulo"));
        
        $customer = $_POST['customer'];
        $customer['modified']=$customer['created']=$today->format("Y-m-d H:i:s");
        save("customers",$customer);
        header("location: index.php");
    }
    
}

function view($id=null){
    global $customer;
    $customer = find('customers',$id);
    
} 

function edit(){
  $agora = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
		try{
			if (isset($_GET['id'])) {

				$id = $_GET['id'];
				

				if (isset($_POST['customer'])) {
					$customer=$_POST['customer'];

					
					$customer['modified']=$agora->format("Y-m-d H:i:s");
					
					
					update('customers',$id,$customer);
					header("location: index.php");
					
				} else {
					
					global $customer;
					$customer=find('customers',$id);
				}
			}else{
				header("location: index.php");
			}
		}catch(Exception $e){
			$_SESSION['message']="Aconteceu um erro". $e->getMessage();
			$_SESSION['type']="danger";
		}
		
	}

function delete($id = null) {

		global $customer;
		$customer = remove("customers", $id);

		header('location: index.php');
}


function pdf($p = null, $tabela =null) {
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
	// Obter dados da tabela especificada
    if ($p) {
        $dadosBrutos = filter($tabela, "name LIKE '%$p%' OR cpf_cnpj LIKE '%$p%'");
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