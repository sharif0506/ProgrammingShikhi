<?php
require './admin.php';
$admin = new Admin();
session_start();

$errorMsg = "";
$fileName = "";
$pageHeading = "";
$id = 0;

if (!isset($_SESSION["admin"])) {
     header("location:index.php");
}
if (!isset($_SESSION['language'])) {
     header("location:languageSelectionForUpdate.php");
}
if (!isset($_GET['pageHeading'])) {
    header("location:languageSelectionForUpdate.php");
} else {
    $pageHeading = $_GET['pageHeading'];
}


$language = $_SESSION['language'];
$fileName = $admin->getFileName($language, $pageHeading);
$id = $admin->getContentID($fileName . ".php");
$_SESSION['id'] = $id;
$content = $admin->getContent($fileName . ".php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="adminPanel.css" type="text/css" rel="stylesheet" />
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea'
            }
            );
        </script>
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
                            <li class="menuitem"><a  href="deleteContent.php">Delete Content</a></li>
                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>Edit Content</h1>
                            <!--<form method="post" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">-->

                            <form method="post" action="testResult.php">
                                <input type="text" name="newPageHeading" placeholder="page heading" value="<?php echo $pageHeading; ?>" required />
                                <p>
                                </p>
                                <textarea name="textarea" rows="20" ><?php echo $content; ?></textarea>
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
