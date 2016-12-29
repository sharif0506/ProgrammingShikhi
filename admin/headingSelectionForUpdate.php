 <?php
        session_start();
        require './admin.php';
        if (!isset($_SESSION["admin"])) {
            header("location:index.php");
        }
        if (!isset($_POST['language'])) {
            header("location:languageSelectionForUpdate.php");
        }
        $_SESSION['language'] = $_POST['language'];
        $language = $_POST['language'];
        $admin = new Admin();
        $pageHeadings = $admin->getEveryContentHeading($language);
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
                            <li class="menuitem"><a  href="languageSelectionForUpdate.php">কন্টেন্ট আপডেট</a></li>
                            <li class="menuitem"><a  href="languageSelectionForDeleting.php">কন্টেন্ট ডিলিট</a></li>
                            <li class="menuitem"><a  href="quiz.php">কুইজ প্রশ্নোত্তর</a></li>
                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>কন্টেন্ট আপডেট</h1>
                            <form method="GET" action="editContent.php">
                            <p> <select name='pageHeading' style="width: 64%; height: 40px; font-size: 18px; text-align: center">
                                        <?php
                                        for ($i = 0; $i < sizeof($pageHeadings); $i++) {
                                            echo "<option  value='$pageHeadings[$i]'>$pageHeadings[$i]</option>";
                                            
                                        }
                                        ?>
                                    </select>
                                </p>
                                <input class="loginButton" type="submit" value="Submit" />
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
