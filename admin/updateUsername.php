<?php
require 'admin.php';
$user = new Admin();
session_start();
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}
$email = $_SESSION["admin"];

$adminInformation = $user->getAdminInfo($email);
$errorMsg = "";
$fullName = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = $_POST['fullName'];
    if (isset($fullName)) {
        $user->updateFullName($fullName, $email);
    } else {
        $errorMsg = "Error in updating UserName";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="adminPanel.css" type="text/css" rel="stylesheet" />
        <title>আপডেট ইনফরমেশন</title>

    </head>
    <body>

        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিংশিখি</h1>
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
                            <li class="menuitem"><a href="newTutorialAdd.php">নতুন প্রোগ্রামিং ল্যাঙ্গুয়েজ সংযোজন </a></li>
                            <li class="menuitem"><a  href="addContent.php">নতুন কন্টেন্ট সংযোজন </a></li>
                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">

                            <h1>আপডেট ইনফরমেশন</h1>
                            
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <p> <b>  ফুল  নেম :</b></p>
                                <input type="text" name="fullName" value="<?php echo $adminInformation[1]; ?>" placeholder="ফুল  নেম " required />
                                <br />
                                <b style="color: red"><?php echo $errorMsg; ?></b>
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
