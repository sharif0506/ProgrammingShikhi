<?php
session_start();
require './admin.php';
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}

$admin = new Admin();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="adminPanel.css" type="text/css" rel="stylesheet" />
        <title>কুইজ প্রশ্নোত্তর</title>
        <style>
            .buttonNext {
                display: inline-block;
                border-radius: 4px;
                background-color: #274a6d;
                border: none;
                color: #FFFFFF;
                text-align: center;
                font-size: 20px;
                padding: 15px;
                width: 50%;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }

            .buttonNext span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }

            .buttonNext span:after {
                content: '\00bb';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -20px;
                transition: 0.5s;
            }

            .buttonNext:hover span {
                padding-right: 25px;
            }

            .buttonNext:hover span:after {
                opacity: 1;

            }
        </style>
    </head>

    <body> 
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>অ্যাডমিন প্যানেল</h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="adminPanel.php"><div class='menuitem'>অ্যাডমিন প্যানেল</div></a>
                        <a  href="adminProfile.php"><div class='menuitem'>অ্যাডমিন  প্রোফাইল</div></a>
                        <a href="logout.php">   <div class='menuitem'>লগ আউট</div></a>
                    </div>
                    <div class="menuitem">     
                        <ul>
                            <li class="menuitem"><a href="newTutorialAdd.php">নতুন প্রোগ্রামিং ল্যাঙ্গুয়েজ সংযোজন</a></li>
                            <li class="menuitem"><a  href="addContent.php">নতুন কন্টেন্ট সংযোজন</a></li>
                            <li class="menuitem"><a  href="languageSelectionForUpdate.php">কন্টেন্ট আপডেট</a></li>
                            <li class="menuitem"><a  href="languageSelectionForDeleting.php">কন্টেন্ট ডিলিট</a></li>
                            <li class="menuitem"><a  href="quiz.php">কুইজ প্রশ্নোত্তর</a></li>

                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>কুইজ প্রশ্নোত্তর</h1>
                            <a href="languageSelctionForAddingQuiz.php" ><button class='buttonNext' style='vertical-align:middle'><span>Quiz Add</span></button> </a>
                            <br />
                            <br />
                            <a href="languageSelectionForEditingQuiz.php" ><button class='buttonNext' style='vertical-align:middle'><span>Quiz Edit</span></button> </a>
                            <br />
                            <br />
                            <a href="languageSelectionForDeletingQuiz.php" ><button class='buttonNext' style='vertical-align:middle'><span>Quiz Delete</span></button> </a>
                        </div>
                    </div>
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
