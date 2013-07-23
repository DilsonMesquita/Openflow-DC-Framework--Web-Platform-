
<?php
define('INCLUDE_CHECK',true);
require '../debug.php';
require 'login_panel/login_panel.php';

if (!isset($_SESSION['id']))
    { 
        header("location: ../index.php");
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>OF Datacenter</title> 
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
</head>
<body>
    <div id="main">
        <div class="container">
            <h1>Virtual Machine Groups</h1>
            <div class="sepContainer"></div>
            <h3>Request a VM Group:</h3>
            <p> 
                Creating a group of virtual machines allows for them do communicate inside the Datacenter.
                This might be usefull if you want for two or more virtual machines to communicate directly.
            </p>
            <?php include '../controller/vm/vmgroups.php';?>
            <tip> TIP: Check the virtual machines which you want to be part of the same group and then click Submit.</tip>
        </div>     
    </div>   
</body>
</html>