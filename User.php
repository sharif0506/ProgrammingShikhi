<?php

/**
 * Description of User
 *
 * @author sharif rahman
 */
class User {

    function getConnection() {
        $connection = NULL;
        $connection = mysqli_connect("localhost", "root", "", "programming_shikhi")
                or die("Could not connect with the database");
        return $connection;
    }
 
    function register($userName, $fullName, $email, $password) {
        $defaultPage = "home.php";
        $dbConnection = $this->getConnection();
        $sql = "INSERT INTO user VALUES ('$userName','$fullName','$email','$password','$defaultPage')";
        if ($dbConnection->query($sql) == TRUE) {
            
        } else {
            echo "Error: " . $dbConnection->error;
        }
        $dbConnection->close();
    }

    function checkEmailExist($email) {
        $emailExist = FALSE;
        $dbConnection = $this->getConnection();
        $dbConnection->close();
        return $emailExist;
    }

}
