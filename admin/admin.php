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
        $path = "../Content";
        $source = "default_content_layout.css";
        $connection = $this->getConnection();
        $sql = "INSERT INTO tutorial VALUES ('','$newTutorialLanguage')";
        if ($connection->query($sql) == TRUE) {
            $directory = $newTutorialLanguage;
            mkdir("$path/" . $newTutorialLanguage);
            mkdir("$path/" . $newTutorialLanguage."/quiz");
            $path = $path . "/" . $directory;
            $fileName = "default_content_layout.css";
            $input = file_get_contents($fileName);
            $openedFile = fopen("../content/$directory/$fileName", 'w');
            fwrite($openedFile, $input);
            fclose($openedFile);
            $openedFile = fopen("../content/$directory/quiz/$fileName", 'w');
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
            $openedFile = fopen("../Content/$language/$fileName", 'w');
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

    function deleteContent($pageHeading, $language) {
        $connection = $this->getConnection();
        $sql = "DELETE FROM content WHERE PageHeading='$pageHeading' AND Language='$language'";
        if ($connection->query($sql) == TRUE) {
            //do nothing
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function getPreviousPage($currentPage) {
        $previousPage = "";
        $id = $this->getContentID($currentPage);
        $connection = $this->getConnection();
        $sql = "SELECT PageName FROM content WHERE id = (SELECT max(id) FROM content WHERE id < '$id') ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $previousPage = $row["PageName"];
                    break;
                }
            }
            mysqli_free_result($result);
        }

        return $previousPage;
    }

    function getNextPage($currentPage) {
        $nextPage = "";
        $id = $this->getContentID($currentPage);
        $connection = $this->getConnection();
        $sql = "SELECT PageName FROM content WHERE id = (SELECT min(id) FROM content WHERE id > '$id') ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nextPage = $row["PageName"];
                    break;
                }
            }
            mysqli_free_result($result);
        }
        return $nextPage;
    }

    function updateLastLearning($currentPage, $currentUser) {
        $connection = $this->getConnection();
        $sql = "UPDATE user SET  LastAccessedContent='$currentPage' WHERE Email = '$currentUser'";
        if ($connection->query($sql) == TRUE) {
            //do nothing
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }

    function updateLearning($currentPage, $email, $language) {
        $pageId = $this->getContentID($currentPage);
        $connection = $this->getConnection();
        $sql = "INSERT INTO learning VALUES ('',$pageId,'$email','$language')";
        if ($connection->query($sql) == TRUE) {
            
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
        return $sql;
    }

    function getUserLearningInfo($email){
        $totalCompletedChapter = 0;
        $connection = $this->getConnection();
        $sql = "SELECT * FROM learning WHERE UserEmail = '$email' ";
        $x = $connection->query($sql);
       
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                while ($row = $result->fetch_assoc()) {
                   $totalCompletedChapter ++;
                }
            }
            mysqli_free_result($result);
        }
        $connection->close();
        return $totalCompletedChapter;
    }
    
    function isCompleteLearning($fileName, $email) {
        $isCompleteLearning = FALSE;
        $content_id = $this->getContentID($fileName);
        $connection = $this->getConnection();
        $sql = "SELECT * FROM learning WHERE Content_id = '$content_id' ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $isCompleteLearning = TRUE;
            }
            mysqli_free_result($result);
        }
        return $isCompleteLearning;
    }

    function getContentHeadingsToAddQuiz($language) {
        $pageHeadings;
        $connection = $this->getConnection();
        $sql = "SELECT PageHeading FROM content WHERE Language = '$language' AND id NOT IN (SELECT content_id FROM quizquestion)";
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

    function addQuiz($questions, $answers, $options, $fileName, $quizset,$language) {
        $contentId = $this->getContentID($fileName);
        $connection = $this->getConnection();
        $sql = "INSERT INTO quizquestion VALUES "
                . "('','$quizset','$contentId','$questions[0]','$options[0]','$options[1]','$options[2]','$options[3]','$answers[0]'),"
                . "('','$quizset','$contentId','$questions[1]','$options[4]','$options[5]','$options[6]','$options[7]','$answers[1]'),"
                . "('','$quizset','$contentId','$questions[2]','$options[8]','$options[9]','$options[10]','$options[11]','$answers[2]'),"
                . "('','$quizset','$contentId','$questions[3]','$options[12]','$options[13]','$options[14]','$options[15]','$answers[3]'),"
                . "('','$quizset','$contentId','$questions[4]','$options[16]','$options[17]','$options[18]','$options[19]','$answers[4]')";

        if ($connection->query($sql) == TRUE) {
            $input = file_get_contents("default_quiz_layout.php");
            $openedFile = fopen("../Content/".$language."/quiz/$quizset", 'w');
            fwrite($openedFile, $input);
            fclose($openedFile);
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
        return $sql;
    }

    function getContentHeadingsToEditQuiz($language) {
        $pageHeadings = array();
        $connection = $this->getConnection();
        $sql = "SELECT PageHeading FROM content WHERE Language = '$language' AND id IN (SELECT content_id FROM quizquestion)";
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

    function getQuizQuestions($contentId) {
        $questionInfo = array();
        $connection = $this->getConnection();
        $sql = "SELECT * FROM quizquestion WHERE content_id = '$contentId' ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $questionInfo[$i][0] = $row["question"];
                    $questionInfo[$i][1] = $row["option_one"];
                    $questionInfo[$i][2] = $row["option_two"];
                    $questionInfo[$i][3] = $row["option_three"];
                    $questionInfo[$i][4] = $row["option_four"];
                    $questionInfo[$i][5] = $row["answer"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $questionInfo;
    }

    function getQuizQuestionIDs($content_id) {
        $ids = array();
        $connection = $this->getConnection();
        $sql = "SELECT id FROM quizquestion WHERE content_id = '$content_id'";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $ids[$i] = $row["id"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        $connection->close();
        return $ids;
    }

    function editQuiz($quizinfo, $content_id) {
        $ids = array();
        $ids = $this->getQuizQuestionIDs($content_id);
        $connection = $this->getConnection();
        for ($i = 0; $i < sizeof($ids); $i++) {
            $sql = "UPDATE quizquestion  SET question='".$quizinfo[$i][0]."', option_one='".$quizinfo[$i][1]."',option_two='".$quizinfo[$i][2]."', option_three='".$quizinfo[$i][3]."', option_four = '".$quizinfo[$i][4]."', answer = '".$quizinfo[$i][5]."' "
                    . "WHERE id = '$ids[$i]'";
            if ($connection->query($sql) == TRUE) {
                //do nothing
            } else {
                echo "Error: " . $connection->error;
            }
        }
        $connection->close();
    }
    
    function deleteQuiz($content_id){
        $connection = $this->getConnection();
        $sql = "DELETE FROM quizquestion WHERE content_id='$content_id'";
        if ($connection->query($sql) == TRUE) {
            //delete file
        } else {
            echo "Error: " . $connection->error;
        }
        $connection->close();
    }
    
    function getQuiz($quizset) {
        $questionInfo = array();
        $connection = $this->getConnection();
        $sql = "SELECT * FROM quizquestion WHERE quiz_set = '$quizset' ";
        $x = $connection->query($sql);
        if ($result = $x) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $questionInfo[$i][0] = $row["question"];
                    $questionInfo[$i][1] = $row["option_one"];
                    $questionInfo[$i][2] = $row["option_two"];
                    $questionInfo[$i][3] = $row["option_three"];
                    $questionInfo[$i][4] = $row["option_four"];
                    $questionInfo[$i][5] = $row["answer"];
                    $i++;
                }
            }
            mysqli_free_result($result);
        }
        return $questionInfo;
    }
}
