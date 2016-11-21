<?php
session_start();
if (!isset($_SESSION["admin"])) {
     header("location:index.php");
}
if (!isset($_SESSION['language'])) {
     header("location:languageSelectionForUpdate.php");
}

require './admin.php';

$id =0;
$admin = new Admin();
$pageHeading = $_POST['newPageHeading'];
$content = $_POST['textarea'];
$id = $_SESSION['id'];

$admin->updateContent($id, $pageHeading, $content);
header("location:languageSelectionForUpdate.php");
 
