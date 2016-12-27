<?php

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
        return $userNameExist;
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

    function getAllLanguage() {
        $languages;
        $connection = $this->getConnection();
        $sql = "SELECT NameOfProgrammingLanguage FROM tutorial ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $languages[$i] = $row["NameOfProgrammingLanguage"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $languages;
    }

    function getUserInfo($email) {
        $userInfo = array();
        $connection = $this->getConnection();
        $sql = "SELECT * FROM user WHERE Email = '$email'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $userInfo[0] = $row["UserName"];
                    $userInfo[1] = $row["FullName"];
                    $userInfo[2] = $row["Email"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        return $userInfo;
    }

    function updateFullName($name, $email) {
        $connection = $this->getConnection();
        $sql = "UPDATE user SET FullName = '$name' WHERE Email = '$email'";

        if ($connection->query($sql) == TRUE) {
            
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function updatePassword($password, $email) {
        $connection = $this->getConnection();
        $sql = "UPDATE user SET Password = '$password' WHERE Email = '$email'";
        if ($connection->query($sql) == TRUE) {
            
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function getLastCompletedChapter($email) {
        $lastChapter = "";
        $connection = $this->getConnection();
        $sql = "SELECT LastAccessedContent FROM user WHERE Email = '$email'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $lastChapter = $row["LastAccessedContent"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        return $lastChapter;
    }

}
