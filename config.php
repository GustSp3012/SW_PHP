<?php 
// BANCO DE DADOS INFORMAÇÕES
    define("DB_NAME", "crud_games");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_HOST", "localhost");

//CONSTANTES DO PROJETO E CAMINHOS IMPORTANTES
    if(!defined('ABSOLUTE_PATH')){
        define("ABSOLUTE_PATH",dirname(__FILE__).'/');
    }
    // altere a raiz quando hospedar
    if(!defined('RAIZ_PROJETO')){
        define("RAIZ_PROJETO",'/SW_PHP/');
    }
   /** caminho do arquivo de banco de dados **/
	if ( !defined('DBAPI') )
		define('DBAPI', ABSOLUTE_PATH . 'inc/database.php');

    /** caminhos dos templates de header e footer **/
	define('HEADER_TEMPLATE', ABSOLUTE_PATH . 'inc/header.php');
	define('FOOTER_TEMPLATE', ABSOLUTE_PATH . 'inc/footer.php');

    define("PDF",ABSOLUTE_PATH."inc/pdf.php");
    /** caminhos para o modal do cookie **/
define ("COOKIE_TEMPLATE",ABSOLUTE_PATH . "inc/modalcookie.php");
define ("COOKIE_TEMPLATE_POLITICA",ABSOLUTE_PATH . "inc/modalinfocookie.php");
    
?>