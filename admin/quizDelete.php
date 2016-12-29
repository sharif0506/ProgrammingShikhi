<?php
session_start();
require './admin.php';
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}
if (!isset($_SESSION['language'])) {
    header("Location:contentSelectionForDeletingQuiz.php");
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['pageHeading'] = $_GET['pageHeading'];
}
$admin = new Admin();
$language = $_SESSION['language'];
$pageHeading = $_SESSION['pageHeading'];
$fileName = $admin->getFileName($language, $pageHeading);
$fileName = $fileName . ".php";
$content_id = $admin->getContentID($fileName);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $language = $_SESSION['language'];
    $pageHeading = $_SESSION['pageHeading'];
    $fileName = $admin->getFileName($language, $pageHeading);
    $fileName = $fileName . ".php";
    $content_id = $admin->getContentID($fileName);
    $admin->deleteQuiz($content_id);
    unset($_SESSION['language']);
    unset($_SESSION['$pageHeading']);
    header("Location:quiz.php");
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
                            <li class="menuitem"><a  href="quiz.php">কুইজ প্রশ্নোত্তর</a></li>

                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>Delete Content</h1>
                            <p>
                                The  quiz of <?php echo $pageHeading ?> chapter will be deleted. 
                                Do you want to continue?
                            </p>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input class="loginButton" type="submit" value="Confirm" />
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
