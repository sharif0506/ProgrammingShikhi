<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("location:../index.php");
}
require './Forum.php';
require '../User.php';
$forum = new Forum();
$user = new User();
function validate_Information($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
$email = $_SESSION["user"];
$answer = $_POST['textarea'];
$answer = validate_Information($answer);
$answererEmail = $_SESSION["user"];
$answererInfo = $user->getUserInfo($email);
$answerer = $answererInfo[0];
$thisQuestionID = $_SESSION['questionID'];

$forum->addAnswer($thisQuestionID, $answer, $answerer);
header("location:index.php");
