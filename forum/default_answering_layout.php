<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:../index.php");
}
require './Forum.php';
$forum = new Forum();
if (!isset($_GET["question"]) && !isset($_GET["asker"]) && !isset($_GET["date"])) {
   // header("Location:index.php");
    
}

$thisPageHeading = $_GET['questionHeading'];
$thisQuestion = $_GET['question'];
$thisQuestionAsker = $_GET['asker'];
$date = $_GET['date'];
$thisQuestionID = $forum->getQuestionID($thisPageHeading,$thisQuestionAsker,$date);
$_SESSION['questionID'] = $thisQuestionID;

    //header("Location:default_question_layout.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea'
            }
            );
        </script>
        <link href="default_question_layout.css" type="text/css" rel="stylesheet" />
        <title><?php echo "$thisPageHeading"; ?></title>
        <style>
            .questionDiv{
                height: 20%;
                weight: 50%;
                background-color: lightcyan;
            }
        </style>
    </head>
    <body>
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>ফোরাম<?php //echo $thisPageHeading   ?></h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="../index.php"><div class='menuitem'>হোম </div></a>
                        <a  href="../profile.php"><div class='menuitem'>প্রোফাইল</div></a>
                        <a  href="index.php"><div class='menuitem'>ফোরাম </div></a>
                        <a href="../logout.php">   <div class='menuitem'>লগ আউট</div></a>
                    </div>
                    <div class="menuitem">     
                        <ul>
                            <li class="menuitem"><a  href="askQuestion.php">প্রশ্ন করুন</a></li>
                        </ul>
                    </div>
                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <div class="questionDiv" >
                                <h1><?php echo $thisPageHeading ?></h1>
                                    <?php echo $thisQuestion; ?>   
                                <p><b>Asked by: </b><?php echo $thisQuestionAsker; ?></p>
                                <p><b>Date: </b><?php echo $date; ?></p>
                            </div>
                            <br />
                            <div class="answerDiv">
                                <form method="POST" action="saveAnswer.php">
                                    <textarea name="textarea" rows="20"  cols="80"></textarea>
                                    <input class="loginButton" type="submit" value="Submit" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gridbox gridright">
                    Advertisement
                </div>
                <div class="gridbox gridfooter">
                    <div class="footer">
                        <p>This website is developed by Sharif Rahman</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

