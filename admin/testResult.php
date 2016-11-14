<?php

//$fileName = "c_intro.php";
//require './admin.php';
//$admin   = new Admin();
//$pageHeading = $admin->getPageHeading($fileName);
//echo $pageHeading;
require './admin.php';
$user = new Admin();

//$admin->updateFullName($name, $email);
$email = $_SESSION['admin'];
echo $email;