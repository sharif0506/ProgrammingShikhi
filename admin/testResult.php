<?php
////$fileName = array_diff(scandir(getcwd()), array('..', '.'));
////$size = sizeof($fileName);
//$fileName = basename($_SERVER['PHP_SELF']);
//$input = file_get_contents("input.txt");
//$openedFile = fopen("../Content/$fileName", 'w');
//fwrite($openedFile, $input);
////fwrite($openedFile, "Hello world");
//fclose($openedFile);
$fileName = "c_intro.php";
require './admin.php';
$admin   = new Admin();
$pageHeading = $admin->getPageHeading($fileName);
echo $pageHeading;