<?php
include 'User.php';
$email = "sharif.rahman06@gmail.com";
$password = "iit123";
$user = new User();

$userExist = $user->logIn( $email, $password );

if ($userExist == TRUE) {
    //$user->register($userName, $fullName, $email, $password);

   echo "User already exist";
}  else {
    echo "User does not exist";
}

