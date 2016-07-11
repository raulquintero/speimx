<?php
// Including the class
require_once( __DIR__.'/../database.php' );
require_once( __DIR__.'/classes/class.db.php' );
require_once(__DIR__ . '/classes/class_login.php');


//DB_HOST, DB_USER, DB_PASS, DB_NAME
// You must establish a connection to the mysql database before using this class
// $database_connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
// $database_selection=mysql_select_db( DB_NAME, $database_connection);

$database = new DB();


if(isset($_GET['module']) && ($_GET['module']=="login"))
{

    // Instantiating the class object
    
    $login = new Login();
    
    # Class configuration methods:
    $login->setDatabase($database);
    // Setting the crypting method for passwords, can be set as 'sha1' or 'md5'
    $login->setCryptMethod('sha1');
    
    // Setting if class messages will be shown
    $login->setShowMessage(false);
    
    # Setting login session:

    $login->setLoginSession();

    if (isset($_POST['register']))
        echo $login->setRegister();
    
    # Showing login informations if login is done:
    
    // // Logged username
    // echo "Welcome: ".$login->getUserName()."<br>";
    
    // // Logged ID
    // echo "Your id is: ".$login->getUserId()."<br>";
    
    // // Logged user activation status
    // echo "Your activation status is: ".$login->getUserActive()."<br>";
        
    if((isset($_GET['action'])) && ($_GET['action']==1)) {
		// Logout
		$login->unsetLoginSession();
		
    }
    // print_r($_SESSION);
		header("Location: /index.php");

	
    // if ($login->getUserActive())
   	// 	header("Location: /index.php");
    // else
    //    header("Location: /index.html");

}

// echo "<br><br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}


?>