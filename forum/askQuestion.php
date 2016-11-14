<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:../index.php");
}
require './Forum.php';
$forum = new Forum();
$languages = $forum->getAllNameOfProgrammingLanguage();
$email = $_SESSION['user'];

function validate_Information($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $questionHeading = $_POST['questionHeading'];
    $topic = $_POST['topic'];
    $question = $_POST['textarea'];
    $asker = $forum->getUserName($email);
    $forum->addQuestion($questionHeading, $topic, $question, $asker);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="index.css" type="text/css" rel="stylesheet" />
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea'
            }
            );
        </script>
        <title>প্রশ্ন করুন</title>
    </head>

    <body> 
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>ফোরাম</h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="../homepage.php"><div class='menuitem'>হোম </div></a>
                        <a  href="../profile.php"><div class='menuitem'>প্রোফাইল</div></a>
                        <a href="index.php"><div class='menuitem'>ফোরাম</div></a>
                        <a href="../logout.php">   <div class='menuitem'>লগ আউট</div></a>
                    </div>
                    <div class="menuitem">     
                        <ul> 
                            <li class="menuitem"><a  href="askQuestion.php">প্রশ্ন করুন</a></li>
                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>প্রশ্ন করুন</h1>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <input type="text" name="questionHeading" placeholder="Heading" required />
                                <p>Select A Language Related To Quesiton</p>
                                <p> <select name="topic" style="width: 64%; height: 40px; font-size: 18px; text-align: center">
                                        <?php
                                        for ($i = 0; $i < sizeof($languages); $i++) {
                                            echo "<option  value='$languages[$i]'>$languages[$i]</option>";
                                        }
                                        ?>
                                    </select>
                                </p>
                                <textarea name="textarea" rows="20"  cols="80">Question Details</textarea>
                                <br />
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
