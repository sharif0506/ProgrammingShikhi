<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:../index.php");
}
require './Forum.php';
$forum = new Forum();
$questions = $forum->getAllQuestion();
$questionDate = $forum->getAllQuestionDate();
$questionAsker = $forum->getAllQuestionAsker();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="index.css" type="text/css" rel="stylesheet" />
        <title>ফোরাম</title>
        <style>
            .questionDiv{
                height: 20%;
                weight: 50%;
                background-color: lightgray;
            }
        </style>
    </head>

    <body> 
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>ফোরাম</h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="../homepage.php"><div class='menuitem'>হোম </div></a>
                        <a href="../profile.php"><div class='menuitem'>ইউজার প্রোফাইল</div></a>
                        <a href="index.php"><div class='menuitem'>ফোরাম</div></a>
                        <a href="../logout.php">   <div class='menuitem'>লগআউট</div></a>
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
                            <h1>ফোরাম</h1>
                            <?php
                            for ($i = 0; $i < sizeof($questions); $i++) {
                                echo "<a href='default_question_layout.php?$questions[$i]]'style='text-align:left'><div class='questionDiv'>"
                                . "<h3>$questions[$i]</h3>"
                                . " <br />"
                                . "<P>Published by:$questionAsker[$i]</p>"
                                . "<P style='text-align:right'>Date: $questionDate[$i]</p>"
                                . "</div>"
                                . "<a>";
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="gridbox gridright">
                    Advertisement
                </div>
                <div class="gridbox gridfooter">
                    <div class="footer">
                        <p>This website is developed by Sharif</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
