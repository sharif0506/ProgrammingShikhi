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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = md5($_POST['currentPassword']);
    $newPassword = md5($_POST['newPassword']);
    $confirmNewPassword = md5($_POST['confirmNewPassword']);
    $currentPasswordMatch = $user->logIn($email, $currentPassword);
    if ($currentPasswordMatch) {
        if ($newPassword == $confirmNewPassword) {
            $user->updatePassword($newPassword, $email);
        } else {
            $errorMsg = "New password mismatch";
        }
    } else {
        $errorMsg = "Current Password doesnot match";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="profile.css" type="text/css" rel="stylesheet" />
        <title>আপডেট  পাসওয়ার্ড</title>

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

                            <h1>আপডেট  পাসওয়ার্ড</h1>
                            
                             <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <p><b>বর্তমান পাসওয়ার্ড :</b></p>
                                <input type="password" name="currentPassword" placeholder="বর্তমান পাসওয়ার্ড"  />
                                <br />
                                <p><b>নতুন পাসওয়ার্ড :</b></p>
                                <input type="password" name="newPassword" placeholder="নতুন পাসওয়ার্ড"  />
                                <p><b>কনফার্ম  নতুন পাসওয়ার্ড :</b></p>
                                <p><input type="password" name="confirmNewPassword" placeholder="কনফার্ম  নতুন পাসওয়ার্ড"  /></p>
                                <b style="color: red"><?php echo $errorMsg; ?></b>
                                <input type="submit" class="loginButton" value="সাবমিট">

                            </form>
                            <br /><br />
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
