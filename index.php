<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="index.css" type="text/css" rel="stylesheet" />
        <title>লগ ইন</title>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION['user'])){
            header("location:homepage.php");
        }
        require 'User.php';
        $user = new User();

        $errorMsg = "";
        $isValidInfo = TRUE;

        function validate_Information($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST['email'];
            $password = md5($_POST['password']);

            if (empty($email)) {
                $errorMsg = "Email is required";
                $isValidInfo = FALSE;
            } else {
                $email = validate_Information($email);
            }

            if (empty($password)) {
                $errorMsg = "Password is required";
                $isValidInfo = FALSE;
            }

            if ($isValidInfo == TRUE) {
                $userExist = $user->logIn($email, $password);
                if ($userExist) {
                    $_SESSION["user"]= $email;
                    header("Location:homepage.php");
                } else {
                    $errorMsg = "Wrong email or password";
                }
            }
        }
        ?>
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3></h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                     <div class="menuitem">
                        <a href="index.php"><div class='menuitem'>লগ ইন</div></a>
                        <a href="registration.php">   <div class='menuitem'>রেজিস্ট্রেশন</div></a>
                    </div>
                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>লগ ইন</h1>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="text" name="email" placeholder="ই মেইল" required="required" />
                                <br />
                                <input type="password" name="password" placeholder="পাসওয়ার্ড" required="required" />
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