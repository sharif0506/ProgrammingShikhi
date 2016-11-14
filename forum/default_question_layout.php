 <?php
                
        session_start();
        if (!isset($_SESSION["user"])) {
            header("location:../index.php");
        }
        
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="default_question_layout.css" type="text/css" rel="stylesheet" />
        <title><?php //echo "$thisPageHeading";?></title>
        
    </head>
    <body>
       
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>ফোরাম<?php //echo $thisPageHeading?></h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="../../homepage.php"><div class='menuitem'>হোম </div></a>
                        <a  href="../../profile.php"><div class='menuitem'>প্রোফাইল</div></a>
                        <a  href="../index.php"><div class='menuitem'>ফোরাম </div></a>
                        <a href="../../logout.php">   <div class='menuitem'>লগ আউট</div></a>
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
                            <h1><?php //echo $thisPageHeading?></h1>
                            <?php// echo $content ?>
                           
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

