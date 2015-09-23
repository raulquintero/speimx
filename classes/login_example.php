<?php
// Including the class
require_once("class_login.php");

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
    $login->setShowMessage(true);
    
    # Setting login session:

    $login->setLoginSession();
    
    # Showing login informations if login is done:
    
    // Logged username
    echo "Welcome: ".$login->getUserName()."<br>";
    
    // Logged ID
    echo "Your id is: ".$login->getUserId()."<br>";
    
    // Logged user activation status
    echo "Your activation status is: ".$login->getUserActive()."<br>";
        
    if((isset($_GET['action'])) && ($_GET['action']==1)) {
		// Logout
		$login->unsetLoginSession();
	}
}
?>


<head>
    <style>
        h1 {
            color: #555;
            font-size: 16px;
            text-decoration: underline;
        }
        form#login_form {
            background: #FFFFCC;
            border: 1px solid #555;
            color: #555;
            width: 500px;
        }
        label.login_label {
            float: left;
            margin-left: 50px;
            margin-bottom: 10px;
            width: 200px;
            text-align: left;
        }
        
        label.login_label:hover {
            background: #FFFFCC;
        }
        
        input.login_input {
            color: #777;
            font-size: 11px;
            margin-bottom: 10px;
            width: 200px;
        }
        input.login_submit {
            width: 200px;
            margin-left: 150px;
        }
        hr.login_hr {
            color: #555;
            clear: both;
            height: 0px;
            margin-bottom: 10px;
            width: 450px;
        }
    </style>
</head>
<body>
    <h1>Login Module:</h1>
    <p><small>Look the source of this file to view the html code used in the form shown below:</small></p>
    <form action="?module=login" id="login_form" method="post">
        <p>
            <label class="login_label">Username:</label><input name="user_name" class="login_input">
            <label class="login_label">Password:</label><input name="user_pass" class="login_input" type="password">
            <hr class="login_hr" />
            <input type="submit" class="login_submit">
        </p>
    </form>
