<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="registration.css" type="text/css" rel="stylesheet" />
        <title>রেজিস্ট্রেশন</title>
    </head>
    <body>
        <?php
        require 'User.php';
        session_start();
        if (isset($_SESSION['user'])){
            header("location:homepage.php");
        }
        $user = new User();
        $email = $userName = $fullName = "";
        $nameErr = $userNameErr = $emailErr = $passwordErr = "";
        $isValidInfo = TRUE;

        function validate_Information($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $rePassword = $_POST['rePassword'];

            if (empty($fullName)) {
                $nameErr = "Name is required";
                $isValidInfo = FALSE;
            } else {
                $name = validate_Information($fullName);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $nameErr = "Only letters and white space allowed";
                    $isValidInfo = FALSE;
                }
            }
            if (empty($userName)) {
                $userNameErr = "UserName is required";
                $isValidInfo = FALSE;
            } else {
                $userName = validate_Information($userName);
                // check if name only contains letters and whitespace
                if (!ctype_alnum($userName)) {
                    $userNameErr = "Only letters and numbers allowed";
                    $isValidInfo = FALSE;
                } else {
                    if ($user->checkUserNameExist($userName)) {
                        $userNameErr = "Username already used";
                        $isValidInfo = FALSE;
                    }
                }
            }

            if (empty($email)) {
                $emailErr = "Email is required";
                $isValidInfo = FALSE;
            } else {
                $email = validate_Information($email);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format.Need a valid email.";
                    $isValidInfo = FALSE;
                } else {
                    if ($user->checkEmailExist($email)) {
                        $emailErr = "Email is already used.Use a different one";
                        $isValidInfo = FALSE;
                    }
                }
            }
            if (empty($password) || empty($rePassword)) {
                $passwordErr = "Password is required";
                $isValidInfo = FALSE;
            }
            if ($password != $rePassword) {
                $passwordErr = "Password does not match";
                $isValidInfo = FALSE;
            }
            if (strlen($password) < 4 || strlen($rePassword) < 4) {
                $passwordErr = "Password must have at least 4 charecter";
                $isValidInfo = FALSE;
            }
            if ($isValidInfo == TRUE) {
                $password = md5($password);
                $user->register($userName, $fullName, $email, $password);
                session_start();
                $_SESSION["user"] = $email;
                header("Location:homepage.php");
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
                        <div class="registration">

                            <h1>রেজিস্ট্রেশন</h1>
                            <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
                                <input type="text" name="fullName" value="<?php echo "$fullName" ?>" placeholder="ফুলনেম" required="required" /> <br />
                                <b><?php echo "$nameErr"; ?></b>
                                <input type="text" name="userName" value="<?php echo "$userName" ?>" placeholder="ইউজার নেম" required="required" /> <br />
                                <b><?php echo "$userNameErr"; ?></b>
                                <input type="text" name="email" value="<?php echo "$email" ?>" placeholder="ই মেইল" required="required" /> <br />
                                <b><?php echo "$emailErr "; ?></b>
                                <input type="password" name="password" placeholder="পাসওয়ার্ড" required="required" /><br />
                                <input type="password" name="rePassword" placeholder="কনফার্ম পাসওয়ার্ড" required="required" /><br />
                                <b><?php echo "$passwordErr"; ?></b>
                                <input type="submit" class="signupbutton" value="সাবমিট" />
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
