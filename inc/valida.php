<?php 
include("../config.php");
include(DBAPI);
include HEADER_TEMPLATE;

if (empty($_POST["user"]) || empty($_POST["senha"])) {
    header("Location:" . RAIZ_PROJETO);
    exit();
}


$bd = open_database();
$login = $_POST["user"];
$senha = $_POST["senha"];

try {
    if (!empty($senha) && !empty($login)) {
        $senha_crip = criptografia($senha);
        
        $sql = "SELECT id, nome, user, password FROM usuarios WHERE user = :login AND password = :senha LIMIT 1";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(":login", $login, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $senha_crip, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $dados["id"];
            $nome = $dados["nome"];
            $user = $dados["user"];
            
            if (!empty($user)) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['message'] = "Bem vindo " . $nome;
                $_SESSION['type'] = "success";
                $_SESSION['nome'] = $nome;
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $id;
                
                header("Location:" . RAIZ_PROJETO);
                exit();
            }
        } 

        // Se nenhum usuário foi encontrado, redireciona para a página principal
        $_SESSION['message'] = "Usuário não encontrado";
        $_SESSION['type'] = "danger";
        header("Location:" . RAIZ_PROJETO);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = 'danger';
    header("Location:" . RAIZ_PROJETO);
    exit();
}

include FOOTER_TEMPLATE;
?>