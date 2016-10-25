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
        $result = NULL;
        $dbConnection = $this->getConnection();
        $query = "SELECT * FROM user WHERE Email = '$email'";
        $x = $dbConnection->query($query);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $emailExist = TRUE;
            }
            mysqli_free_result($result);
        }
        $dbConnection->close();
        return $emailExist;
    }

    function checkUserNameExist($userName) {

        $userNameExist = FALSE;
        $result = NULL;
        $dbConnection = $this->getConnection();
        $query = "SELECT * FROM user WHERE UserName = '$userName'";
        $x = $dbConnection->query($query);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $userNameExist = TRUE;
            }
            mysqli_free_result($result);
        }
        $dbConnection->close();
        return $emailExist;
    }

    function logIn($email, $password) {
        $userExist = FALSE;
        $result = NULL;
        $dbConnection = $this->getConnection();
        $query = "SELECT * FROM user WHERE Email = '$email' AND Password = '$password'";
        
        $x = $dbConnection->query($query);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
         
            if ($numberOfRows > 0) {
                $userExist = TRUE;
            }
            mysqli_free_result($result);
        }
        $dbConnection->close();
        return $userExist;
        
    }

}
