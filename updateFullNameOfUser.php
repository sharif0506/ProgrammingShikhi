<?php
require 'User.php';
$user = new User();
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
$email = $_SESSION["user"];

$userInfo = $user->getUserInfo($email);

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
        <link href="profile.css" type="text/css" rel="stylesheet" />
        <title>আপডেট  ফুল নেম</title>

    </head>
    <body>

        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিংশিখি</h1>
                        <h3>আপডেট ইনফরমেশন</h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="homepage.php"><div class='menuitem'>হোম </div></a>
                        <a href="profile.php"><div class='menuitem'>ইউজার প্রোফাইল</div></a>
                        <a href="logout.php"><div class='menuitem'>লগআউট</div></a>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">

                            <h1>আপডেট  ফুল নেম</h1>
                            
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <p> <b>  ফুল  নেম :</b></p>
                                <input type="text" name="fullName" value="<?php echo $userInfo[1]; ?>" placeholder="ফুল  নেম " required />
                                <br />
                                <b style="color: red"><?php echo $errorMsg; ?></b>
                                <input type="submit" class="loginButton" value="সাবমিট">

                            </form>
                            <br /><br /><br /><br /><br />
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
