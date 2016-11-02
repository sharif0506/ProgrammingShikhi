<html>
    <head>
        <title>লগ ইন</title>
        <link rel="stylesheet" type="text/css" href="loginstyle.css" />

    </head>

    <body>
        <?php
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
            $password = $_POST['password'];

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
                    header("Location:index.php");
                } else {
                    $errorMsg = "Wrong email or password";
                }
            }
        }
        ?>
        <div class="header">
            <h1>ProgrammingShikhi</h1>
            <h3><?php echo "C Tutorial"; ?></h3>
        </div>
        <div class="login">
            <h1>লগ ইন</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="email" placeholder="ই মেইল" required="required" />
                <input type="password" name="password" placeholder="পাসওয়ার্ড" required="required" />
                <b><?php echo $errorMsg; ?></b>
                <input type="submit" class="loginButton" value="সাবমিট">
            </form>

            <p>Don't have an account...? </p>
            <p><a href='registration.php'>Click Here</a> for registration.</p>
        </div>

    </body>
</html>