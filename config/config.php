<?php
setlocale(LC_MONETARY, 'es_MX');


$realpath=getcwd();
$pos = strpos($realpath, "/functions");


if ($pos) $realpath = substr($realpath, 0, -10);  // devuelve "abcde"
require_once( $realpath.'/../database.php' );
require_once( $realpath.'/classes/class.db.php' );
require_once( $realpath.'/classes/class_login.php' );

require_once($realpath.'/functions/mensajes.php');  
require_once($realpath.'/functions/ticket.php');
require_once($realpath.'/functions/formato.php');
require_once($realpath.'/functions/formas.php');
require_once($realpath.'/functions/error.php');
require_once($realpath.'/functions/estadisticas.php');
require_once($realpath.'/functions/pos_cortedecaja.php');





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


