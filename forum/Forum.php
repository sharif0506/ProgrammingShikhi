<?php

class Forum {

    function getConnection() {
        $connection = NULL;
        $connection = mysqli_connect("localhost", "root", "", "programming_shikhi")
                or die("Could not connect with the database");
        return $connection;
    }

    function addQuestion($questionHeading, $topic, $question, $asker) {
        $connection = $this->getConnection();
        $date = date('d-m-Y');
        $sql = "INSERT INTO question VALUES ('','$questionHeading','$topic','$question','$asker','$date')";
        if ($connection->query($sql) == TRUE) {
//            $input = file_get_contents("default_content_layout.php");
//            $openedFile = fopen("../content/$language/$fileName", 'w');
//            fwrite($openedFile, $input);
//            fclose($openedFile);
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function getAllNameOfProgrammingLanguage() {
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
    
    function getUserName($email) {
        $userName;
        $connection = $this->getConnection();
        $sql = "SELECT * FROM user WHERE Email = '$email'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $userName = $row["UserName"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        return $userName;
    }
    
    function getAllQuestion(){
        $questions;
        $connection = $this->getConnection();
        $sql = "SELECT questionHeading FROM question ORDER BY id DESC";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $questions[$i] = $row["questionHeading"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $questions;
        
    }
    
    function getAllQuestionDate(){
        $date;
        $connection = $this->getConnection();
        $sql = "SELECT date FROM question ORDER BY id DESC";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $date[$i] = $row["date"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $date;
    }
    
     function getAllQuestionAsker(){
        $questionAsker;
        $connection = $this->getConnection();
        $sql = "SELECT asker FROM question ORDER BY id DESC";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $questionAsker[$i] = $row["asker"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $questionAsker;
    }
}
