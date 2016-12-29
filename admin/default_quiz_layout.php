<?php
require '../../../admin/admin.php';
$admin = new Admin();

session_start();
if (!isset($_SESSION["user"])) {
    header("location:../index.php");
}
$quizInfo = array();
$quizset = basename($_SERVER['PHP_SELF']);
$quizInfo = $admin->getQuiz($quizset);
$email=$_SESSION["user"];
$fileName = substr($quizset, 6);
$language = $_SESSION['language'];
echo $language;
$nextPage = $admin->getNextPage($fileName);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="default_content_layout.css" type="text/css" rel="stylesheet" />
        <title><?php echo "Quiz"; ?></title>
    </head>
    <body>

        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3><?php echo "Quiz" ?></h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="../../homepage.php"><div class='menuitem'>হোম </div></a>
                        <a  href="../../profile.php"><div class='menuitem'>প্রোফাইল</div></a>
                        <a href="../../logout.php">   <div class='menuitem'>লগ আউট</div></a>
                    </div>


                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1><?php ?></h1>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    echo "<p> Question " . ($i + 1) . ": " . $quizInfo[$i][0] . "</p>";
                                    echo "<input type='radio' name='option" . $i . "' value='" . $quizInfo[$i][1] . "' required />" . $quizInfo[$i][1] . "<br />";
                                    echo "<input type='radio' name='option" . $i . "' value='" . $quizInfo[$i][2] . "' required />" . $quizInfo[$i][2] . "<br />";
                                    echo "<input type='radio' name='option" . $i . "' value='" . $quizInfo[$i][3] . "' required />" . $quizInfo[$i][3] . "<br />";
                                    echo "<input type='radio' name='option" . $i . "' value='" . $quizInfo[$i][4] . "' required />" . $quizInfo[$i][4] . "<br />";
                                }
                                ?>
                                <br />
                                <input class="buttonNext" type="submit" value="Submit Answer" />
                            </form>
                        </div>
                        <div>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $wrongAnswer = array();
                                $countWrongAnswer = 0;
                                for ($i = 0; $i < 5; $i++) {
                                    if ($quizInfo[$i][5] != $_POST["option" . $i]) {
                                        $wrongAnswer[$i] = "Wrong";
                                        $countWrongAnswer++;
                                    }
                                    if ($quizInfo[$i][5] != $_POST["option" . $i]) {
                                        $wrongAnswer[$i] = "Correct";
                                    }
                                }
                                if ($countWrongAnswer == 0) {
                                    echo "<b style='color: green'>Excellent. All answer was correct.</b><br />";
                                    $admin->updateLastLearning($fileName, $email);
                                    $admin->updateLearning($fileName, $email, $language);
                                    echo "<a href='../".$nextPage."' ><button class='buttonNext'>Next</button></a>";
                                    
                                } else {
                                    echo "<b style='color: red'>Total wrong answer: " . $countWrongAnswer . ". You need to study again </b><br />";
                                    echo "<a href='../".$fileName."' ><button class='buttonPrev'>Learn Again</button></a>";
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="gridbox gridfooter">
                    <div class="footer">
                        <p>This website is developed by Sharif Rahman</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

