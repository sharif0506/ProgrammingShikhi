<head>
    <title>রেজিস্ট্রেশন</title>
    <link rel="stylesheet" type="text/css" href="signupstyle.css">
</head>

<body>
    <?php
    require 'User.php';
    $user = new User();

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
                $emailErr = "Invalid email format";
                $isValidInfo = FALSE;
            } else {
                if ($user->checkEmailExist($email)) {
                    $emailErr = "Email already used";
                    $isValidInfo = FALSE;
                }
            }
        }
        if (empty($password) || empty($rePassword)) {
            $passwordErr = "Password is required";
            $isValidInfo = FALSE;
        }
        if ($password != $rePassword) {
            $passwordErr = "Password mismatch";
            $isValidInfo = FALSE;
        }
        if (strlen($password) < 4 || strlen($rePassword) < 4) {
            $passwordErr = "Password must have at least 4 charecter";
            $isValidInfo = FALSE;
        }
        if ($isValidInfo == TRUE) {
            $password = md5($password);
            $user->register($userName, $fullName, $email, $password);
            header("Location:index.php");
        }
    }
    ?>
    <div class="registration">

        <h1>রেজিস্ট্রেশন</h1>
        <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
            <input type="text" name="fullName" placeholder="ফুলনেম" required="required" />
            <b><?php echo "$nameErr"; ?></b>
            <input type="text" name="userName" placeholder="ইউজার নেম" required="required" />
            <b><?php echo "$userNameErr"; ?></b>
            <input type="text" name="email" placeholder="ই মেইল" required="required" />
            <b><?php echo "$emailErr"; ?></b>
            <input type="password" name="password" placeholder="পাসওয়ার্ড" required="required" />
            <input type="password" name="rePassword" placeholder="কনফার্ম পাসওয়ার্ড" required="required" />
            <b><?php echo "$passwordErr"; ?></b>
            <input type="submit" class="signupbutton" value="সাবমিট" />
        </form>
        <a href="index.php">Home Page</a>
    </div>


</body>