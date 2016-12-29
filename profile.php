<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
require './User.php';
$user = new User();
$email = $_SESSION["user"];
$userInfo = $user->getUserInfo($email);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="profile.css" type="text/css" rel="stylesheet" />
        <title>ইউজার প্রোফাইল</title>
    </head>
    <body>
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header" align="center">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>ইউজার প্রোফাইল</h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="homepage.php"><div class='menuitem'>হোম </div></a>
                        <a href="profile.php"><div class='menuitem'>ইউজার প্রোফাইল</div></a>
                        <a href="forum/index.php"><div class='menuitem'>ফোরাম</div></a>
                        <a href="logout.php">   <div class='menuitem'>লগ আউট</div></a>
                    </div>
                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h2>ইউজার প্রোফাইল</h2>
                            <p>ইউজার নেম: <?php echo "$userInfo[0]"; ?></p>
                            <p>ফুলনেম:<?php echo "$userInfo[1]"; ?></p>
                            <p>ই মেইল:<?php echo "$userInfo[2]"; ?></p>
                            <a class="loginButton" href="updateFullNameOfUser.php" style="color: white">আপডেট  ফুল নেম</a>
                            <a class="loginButton" href="updatePasswordOfUser.php" style="color: white" >আপডেট  পাসওয়ার্ড</a>               
                            <br /><br /><br /><br /><br />
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
