
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="adminPanel.css" type="text/css" rel="stylesheet" />
        <title></title>
        
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
                        <a  href="adminProfile.php"><div class='menuitem'>অ্যাডমিন  প্রোফাইল</div></a>
                        <a href="logout.php">   <div class='menuitem'>লগ আউট</div></a>
                    </div>
                    <div class="menuitem">     
                        <ul>
                            <li class="menuitem"><a  href="addContent.php">কন্টেন্ট তৈরি</a></li>
                            <li class="menuitem"><a href="#news">কন্টেন্ট আপডেট </a></li>
                            <li class="menuitem"><a href="#contact">কন্টেন্ট ডিলিট </a></li>
                            
                            
                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1></h1>
                            <p>Current user :</p>
                            <p>Total content :</p>
                            <p>Total question :</p>
                            <p>Total answer :</p>

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
