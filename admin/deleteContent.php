<?php
require 'admin.php';
$admin = new Admin();
session_start();
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}
if (isset($_POST['pageHeading'])) {
    $pageHeading = $_POST['pageHeading'];
}

$language = $_SESSION['language'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fileName = $admin->getFileName($language, $pageHeading);
    $admin->deleteContent($pageHeading, $language);
    $file = "../Content/$language/$fileName".".php";
    unlink($file);
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
                        <h3>অ্যাডমিন প্যানেল</h3>
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
                            <li class="menuitem"><a  href="editContent.php">Edit Content</a></li>
                            <li class="menuitem"><a  href="languageSelectionForDeleting.php">Delete Content</a></li>

                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>Delete Content</h1>
                            <p>
                                The  file will be deleted. 
                                Do you want to continue?
                            </p>
                            <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input class="loginButton" type="submit" value="Confirm" />
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
