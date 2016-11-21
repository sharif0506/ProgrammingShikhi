<?php

class Admin {

    function getConnection() {
        $connection = NULL;
        $connection = mysqli_connect("localhost", "root", "", "programming_shikhi")
                or die("Could not connect with the database");
        return $connection;
    }

    function logIn($email, $password) {
        $userExist = FALSE;
        $result = NULL;
        $dbConnection = $this->getConnection();
        $query = "SELECT * FROM admin WHERE Email = '$email' AND Password = '$password'";
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

    function makeDirectory($path, $directoryName) {
        chdir($path);
        mkdir($directoryName);
    }

    function createNewTutorial($newTutorialLanguage) {
        $path = "../content";
        $source = "default_content_layout.css";
        $connection = $this->getConnection();
        $sql = "INSERT INTO tutorial VALUES ('','$newTutorialLanguage')";
        if ($connection->query($sql) == TRUE) {
            $directory = $newTutorialLanguage;
            mkdir("$path/" . $newTutorialLanguage);
            $path = $path . "/" . $directory;

            $fileName = "default_content_layout.css";
            $input = file_get_contents($fileName);
            $openedFile = fopen("../content/$directory/$fileName", 'w');
            fwrite($openedFile, $input);
            fclose($openedFile);
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function addContent($fileName, $pageHeading, $content, $language) {
        $connection = $this->getConnection();
        $pageId = 0;
        $fileName = $fileName . ".php";
        $lastModified = date('d-m-Y');
      
        $sql = "INSERT INTO content VALUES ('','$fileName','$pageHeading','$content', '$language','$lastModified')";
        if ($connection->query($sql) == TRUE) {
            $input = file_get_contents("default_content_layout.php");
            $openedFile = fopen("../content/$language/$fileName", 'w');
            fwrite($openedFile, $input);
            fclose($openedFile);
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function getPageHeading($fileName) {
        $pageHeading = "";
        $connection = $this->getConnection();
        $sql = "SELECT PageHeading FROM content WHERE PageName='$fileName'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $pageHeading = $row["PageHeading"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        return $pageHeading;
    }

    function getContent($fileName) {
        $content = "";
        $connection = $this->getConnection();
        $sql = "SELECT Content FROM content WHERE PageName='$fileName'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $content = $row["Content"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        return $content;
    }

    function getAllPageHeading($language) {
        $pageHeadings;
        $connection = $this->getConnection();
        $sql = "SELECT PageHeading FROM content WHERE Language = '$language' ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $pageHeadings[$i] = $row["PageHeading"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $pageHeadings;
    }

    function getAllPageName($language) {
        $pageNames;
        $connection = $this->getConnection();
        $sql = "SELECT PageName FROM content WHERE Language = '$language' ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $pageNames[$i] = $row["PageName"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $pageNames;
    }

    function getAdminInfo($email) {
        $adminInfo;
        $connection = $this->getConnection();
        $sql = "SELECT * FROM admin WHERE Email = '$email'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $adminInfo[0] = $row["UserName"];
                    $adminInfo[1] = $row["FullName"];
                    $adminInfo[2] = $row["Email"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        return $adminInfo;
    }

    function checkFileNameExist($fileName) {
        $fileExist = FALSE;
        $result = NULL;
        $fileName = $fileName . ".php";
        $dbConnection = $this->getConnection();
        $query = "SELECT * FROM content WHERE PageName = '$fileName' ";

        $x = $dbConnection->query($query);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $fileExist = TRUE;
            }
            mysqli_free_result($result);
        }
        $dbConnection->close();
        return $fileExist;
    }

    function checkTutorialExist($nameOfLanguage) {
        $tutorialExist = TRUE;
        $connection = $this->getConnection();
        $sql = "SELECT NameOfProgrammingLanguage FROM tutorial WHERE NameOfProgrammingLanguage='$nameOfLanguage'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows == 0) {
                $tutorialExist = FALSE;
            }
            mysqli_free_result($result);
        }
        return $tutorialExist;
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

    function updateFullName($name, $email) {
        $connection = $this->getConnection();
        $sql = "UPDATE admin SET FullName = '$name' WHERE Email = '$email'";

        if ($connection->query($sql) == TRUE) {
            
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function updatePassword($password, $email) {
        $connection = $this->getConnection();
        $sql = "UPDATE admin SET Password = '$password' WHERE Email = '$email'";
        if ($connection->query($sql) == TRUE) {
            
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function getTotalNumberOfUser() {
        $numberOfUsers = 0;
        $connection = $this->getConnection();
        $sql = "SELECT UserName FROM user";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {

                    $i++;
                }
                $numberOfUsers = $i;
            }
            mysqli_free_result($result);
        }
        return $numberOfUsers;
    }

    function getTotalTutorial() {
        $numberOfTutorial = 0;
        $connection = $this->getConnection();
        $sql = "SELECT id FROM tutorial";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {

                    $i++;
                }
                $numberOfTutorial = $i;
            }
            mysqli_free_result($result);
        }
        return $numberOfTutorial;
    }

    function getTotalContent() {
        $numberOfContent = 0;
        $connection = $this->getConnection();
        $sql = "SELECT id FROM content";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                }
                $numberOfContent = $i;
            }
            mysqli_free_result($result);
        }
        return $numberOfContent;
    }

    function getTotalQuestionOfForum() {
        $numberOfQuestion = 0;
        $connection = $this->getConnection();
        $sql = "SELECT id FROM question";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                }
                $numberOfQuestion = $i;
            }
            mysqli_free_result($result);
        }
        return $numberOfQuestion;
    }

    function getEveryContentHeading($language) {
        $pageHeadings;
        $connection = $this->getConnection();
        $sql = "SELECT PageHeading FROM content WHERE Language='$language'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $pageHeadings[$i] = $row["PageHeading"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $pageHeadings;
    }

    function getFileName($language, $pageHeading) {
        $fileName = NULL;
        $connection = $this->getConnection();
        $sql = "SELECT PageName FROM content WHERE PageHeading='$pageHeading' AND Language='$language' ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $fileName = $row["PageName"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        $fileName = explode(".", $fileName);
        return $fileName[0];
    }

    function getContentID($pageName) {
        $id = 0;
        $connection = $this->getConnection();
        $sql = "SELECT id FROM content WHERE PageName = '$pageName' ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        return $id;
    }

    function updateContent($id, $pageHeading, $content) {
        $connection = $this->getConnection();
        $lastModified = date('d-m-Y');
        $sql = "UPDATE content SET  PageHeading='$pageHeading',Content='$content',LastModified = '$lastModified' WHERE id = '$id'";
        if ($connection->query($sql) == TRUE) {
            //do nothing
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }
    
    function deleteContent($pageHeading,$language){
        $connection = $this->getConnection();
        $sql = "DELETE FROM content WHERE PageHeading='$pageHeading' AND Language='$language'";
        if ($connection->query($sql) == TRUE) {
            //do nothing
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
       
    }
}
