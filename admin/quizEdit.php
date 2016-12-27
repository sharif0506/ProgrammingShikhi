<?php
session_start();
require './admin.php';
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}
if (!isset($_SESSION['pageHeading'])) {
    header("Location:contentSelectionForAddingQuiz.php");
}
$admin = new Admin();
$errorMsg = "";
//session variable  haas language and pageheading 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['pageHeading'] = $_GET['pageHeading'];
}
$language = $_SESSION['language'];
$pageHeading = $_SESSION['pageHeading'];
$fileName = $admin->getFileName($language, $pageHeading);
$fileName = $fileName . ".php";
$content_id = $admin->getContentID($fileName);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="adminPanel.css" type="text/css" rel="stylesheet" />
        <title>অ্যাডমিন প্যানেল</title>
    </head>
    <body> 
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>Quiz</h3>
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
                            <li class="menuitem"><a href="newTutorialAdd.php">নতুন প্রোগ্রামিং ল্যাঙ্গুয়েজ সংযোজন</a></li>
                            <li class="menuitem"><a  href="addContent.php">নতুন কন্টেন্ট সংযোজন</a></li>
                            <li class="menuitem"><a  href="languageSelectionForUpdate.php">কন্টেন্ট আপডেট</a></li>
                            <li class="menuitem"><a  href="languageSelectionForDeleting.php">কন্টেন্ট ডিলিট</a></li>
                        </ul>
                    </div>
                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>Quiz</h1>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <?php
                                $optionCounter = 0;
                                for ($i = 0; $i < 5; $i++) {
                                    echo "<p>Question " . ($i + 1) . " </p>";
                                    echo "<p><textarea name='quizQuestion" . $i . "' rows='10' cols='50' required ></textarea></p>";
                                    for ($j = 0; $j < 4; $j++) {
                                        echo" <input type='text' name='option" . $optionCounter . "' placeholder='option " . ($j + 1) . "' required /><br />";
                                        $optionCounter++;
                                    }
                                    echo "<input type='text' name='answerOfQuizQuestion" . $i . "' placeholder='Correct Answer' required /><br />";
                                }
                                ?>
                                <input type="submit" class="loginButton" value="সাবমিট">
                            </form>    
                        </div>
                    </div>
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
