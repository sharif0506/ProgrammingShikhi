<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}
require 'admin.php';
$admin = new Admin();
$errorMsg = "";
$newTutorialLanguage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newTutorialLanguage = $_POST['newLanguageName'];
    $tutorialExist = $admin->checkTutorialExist($newTutorialLanguage);

    if ( $tutorialExist == TRUE ) {
        $errorMsg = "This tutorial already exist";
    } else {
        $admin->createNewTutorial($newTutorialLanguage);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="adminPanel.css" type="text/css" rel="stylesheet" />
        <title></title>

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
                            <li class="menuitem"><a href="newTutorialAdd.php">কন্টেন্ট আপডেট </a></li>
                            <li class="menuitem"><a  href="addContent.php">কন্টেন্ট তৈরি</a></li>

                            <li class="menuitem"><a href="#contact">কন্টেন্ট ডিলিট </a></li>


                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>Add New Programming Language  </h1>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="text" name="newLanguageName" placeholder="New Programming Language Name" required />
                                <br />
                                <p id="errMsg"><b style="color: red;"><?php echo $errorMsg ?></b></p>
                                <input type="submit" class="loginButton" value="সাবমিট">
                            </form> 

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
