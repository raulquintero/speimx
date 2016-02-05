<?php
setlocale(LC_MONETARY, 'es_MX');
$relative_path=isset($relative_path) ? $relative_path : "";

$realpath=getcwd();
$pos = strpos($realpath, "/functions");

//$relative_path  --  para inclusiones de funciones desde view


if ($pos) $realpath = substr($realpath, 0, -10);  // devuelve "abcde"
require_once( $realpath.$relative_path.'/../database.php' );
require_once( $realpath.$relative_path.'/classes/class.db.php' );
require_once( $realpath.$relative_path.'/classes/class_login.php' );

require_once($realpath.$relative_path.'/functions/mensajes.php');
require_once($realpath.$relative_path.'/functions/busquedas.php');
require_once($realpath.$relative_path.'/functions/ticket.php');
require_once($realpath.$relative_path.'/functions/formato.php');
require_once($realpath.$relative_path.'/functions/formas.php');
require_once($realpath.$relative_path.'/functions/error.php');
require_once($realpath.$relative_path.'/functions/estadisticas.php');
require_once($realpath.$relative_path.'/functions/pos_cortedecaja.php');





$item_impresion='70001603';

/* sanitize data
foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}
*/


$path="/var/www/html/functions";
$iva=16;     
/////////////////////////////////////////////login class start
   // Instantiating the class object
    
    $login = new Login();
    
    # Class configuration methods:
    
    // Setting the user table of mysql database
    $login->setDatabaseUsersTable('admin');
    
//////////////////////////////////////////////login class end











?>


