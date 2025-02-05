<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="adminPanel.css" type="text/css" rel="stylesheet" />
        <title>অ্যাডমিন প্যানেল</title>

    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION["admin"])) {
            header("location:index.php");
        }
        ?>
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
                            <h1>List of Contents</h1>
                            <form method="POST">
                                <select style="width: 64%; height: 40px; font-size: 18px; text-align: center">
                                        <?php
                                        for ($i = 0; $i < sizeof($languages); $i++) {
                                            echo "<option value='$languages[$i]'>$languages[$i]</option>";
                                        }
                                        ?>
                                    </select>
                                <button class="loginButton" formaction="">Edit</button>
                            </form>
                            <a class="loginButton" href="editContent.php" style="color: white">আপডেট  ফুল নেম</a>
                            <a class="loginButton" href="editContent.php" style="color: white">আপডেট  ফুল নেম</a>
                            <a class="loginButton" href="deleteContent.php" style="color: white" >আপডেট  পাসওয়ার্ড</a>
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
