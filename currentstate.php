<?php
require './User.php';
require 'admin/admin.php';
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
$user = new User();
$admin = new Admin();
$email = $_SESSION["user"];
$continueFrom = "";
$lastCompletedChapter = $user->getLastCompletedChapter($email);
$totalCompletedChapter = 0;
$totalCompletedChapter = $admin->getUserLearningInfo($email);
if($totalCompletedChapter==0){
    $continueFrom = $lastCompletedChapter;
}
else{
    $continueFrom = $admin->getNextPage($lastCompletedChapter);
}
//echo $lastCompletedChapter;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="currentstate.css" type="text/css" rel="stylesheet" />
        <title>প্রোগ্রামিং শিখি</title>
    </head>
    <body>
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header" align="center">
                        <h2>প্রোগ্রামিং শিখি</h2>
                        <h3>Current status of learning </h3>
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
                            <h2>প্রোগ্রামিংশিখি তে স্বাগতম  </h2>
                            <br />

                            <b>This is your progress</b>
                            <p>Programming Language: C</p>   
                            <p>Total Completed Chapter:<?php echo $totalCompletedChapter?></p>
                            
                            <a href="<?php echo $continueFrom?>" >Continue after last completed chapter</a>
                            <?php
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

                <div class="gridbox gridfooter">
                    <div class="footer">
                        <p>This website is developed by Sharif</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
