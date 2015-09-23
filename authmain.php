<?php
// Including the class
require_once("/var/www/html/classes/class_login.php");

// You must establish a connection to the mysql database before using this class
$database_connection=mysql_connect("localhost", "root", "despachado16");
$database_selection=mysql_select_db("speimx", $database_connection);




if(isset($_GET['module']) && ($_GET['module']=="login"))
{

    // Instantiating the class object
    
    $login = new Login();
    
    # Class configuration methods:
    
    // Setting the user table of mysql database
    $login->setDatabaseUsersTable('admin');
    
    // Setting the crypting method for passwords, can be set as 'sha1' or 'md5'
    $login->setCryptMethod('sha1');
    
    // Setting if class messages will be shown
    $login->setShowMessage(false);
    
    # Setting login session:

    $login->setLoginSession();
    
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
		
		header("Location: /index.html");
	}

	
	if ($login->getUserActive())
		header("Location: /index.php");
    else 
        header("Location: /index.html");

}

// echo "<br><br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}


?>