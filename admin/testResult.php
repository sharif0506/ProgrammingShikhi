<?php

//$fileName = "c_intro.php";
//require './admin.php';
//$admin   = new Admin();
//$pageHeading = $admin->getPageHeading($fileName);
//echo $pageHeading;
require './admin.php';
$admin = new Admin();
$newTutorialLanguage = "c";
$admin->createNewTutorial($newTutorialLanguage);