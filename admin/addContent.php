<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}
require 'admin.php';
$admin = new Admin();
$errorMsg = "";
$pageName = $pageHeading = $content = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pageName = $_POST['pageName'];
    $pageHeading = $_POST['pageHeading'];
    $content = $_POST['textarea'];
    $lastModified = "";
    $language = "";
    $fileExist = TRUE;
    $fileExist = $admin->checkFileNameExist($pageName);
    if($fileExist){
        $errorMsg = "Page name already exist.";
    }else{
        $admin->addContent($pageName, $pageHeading, $content, $language, $lastModified);
    }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="addContent.css" type="text/css" rel="stylesheet" />
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
                            <li class="menuitem"><a  href="addContent.php">কন্টেন্ট তৈরি</a></li>
                            <li class="menuitem"><a href="#">কন্টেন্ট আপডেট </a></li>
                            <li class="menuitem"><a href="#">কন্টেন্ট ডিলিট </a></li>


                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>কন্টেন্ট তৈরি</h1>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="text" name="pageName" placeholder="page name" required />
                                <br />
                                <p id="errMsg"><b><?php echo $errorMsg?></b></p>
                                <input type="text" name="pageHeading" placeholder="page heading" required />
                                <textarea name="textarea" rows="20" ></textarea>
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