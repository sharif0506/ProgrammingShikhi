<?php

require 'admin.php';
$admin = new Admin();
session_start();
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}
$language = $_SESSION['language'];
$pageHeading = $_SESSION['pageHeading'];
//echo $language;
//echo $pageHeading;
$fileName = $admin->getFileName($language, $pageHeading);
//echo $fileName;
$admin->deleteContent($pageHeading, $language);
$file = "../Content/".$language."/".$fileName . ".php";
unlink($file);
header("Location:adminPanel.php");
