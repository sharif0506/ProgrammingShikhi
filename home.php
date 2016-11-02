<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//if(!$_SESSION["user"]){
//   header('Location:index.php');
//   
//}
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}

$myStr = "1234";
$encStr = md5($myStr);
//$length = strlen($encStr);

echo "welcome to the home page of programming shikhi";
?>
<form action="logout.php" method ="post">
    <input type="submit" value="logout" />
</form>

