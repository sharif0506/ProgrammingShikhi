<?php
require './User.php';
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
$user = new User();
$languages = $user->getAllLanguage();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="homepage.css" type="text/css" rel="stylesheet" />
        <title>প্রোগ্রামিং শিখি</title>
    </head>
    <body>
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>হোম পেজ </h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="homepage.php"><div class='menuitem'>হোম </div></a>
                        <a href="profile.php"><div class='menuitem'>ইউজার প্রোফাইল</div></a>
                        <a href="forum/index.php"><div class='menuitem'>ফোরাম</div></a>
                        <a href="logout.php">   <div class='menuitem'>লগআউট</div></a>
                    </div>
                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>প্রোগ্রামিংশিখি তে স্বাগতম  </h1>
                            <br />
                            <?php
                            for ($i = 0; $i < sizeof($languages); $i++) {
                                echo "<a  style='color:white' href=Content/" . $languages[$i] . "/"."><p class='loginButton' ".">$languages[$i] প্রোগ্রামিং এর টিউটোরিয়াল</p></a>";
                                
                                }
                            ?>
                            
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />


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
