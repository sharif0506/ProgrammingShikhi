<?php
        session_start();
        if (!isset($_SESSION["user"])) {
            header("location:index.php");
        }
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="profile.css" type="text/css" rel="stylesheet" />
        <title>ইউজার প্রোফাইল</title>
    </head>
    <body>
        
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3>ইউজার প্রোফাইল</h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="homepage.php"><div class='menuitem'>হোম </div></a>
                        <a href="profile.php"><div class='menuitem'>ইউজার প্রোফাইল</div></a>
                        <a href="logout.php"><div class='menuitem'>লগআউট</div></a>
                    </div>
                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1>ইউজার প্রোফাইল</h1>
                            <p>User Name:</p>
                            <p>Full Name:</p>
                            <p>Email:</p>
                            <p>No of completed topic:</p>
                            
                            <br /><br /><br /><br /><br />
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
