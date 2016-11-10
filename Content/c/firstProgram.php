 <?php
        require '../../admin/admin.php';
        $admin = new Admin();
        
        session_start();
        if (!isset($_SESSION["user"])) {
            header("location:../index.php");
        }
        $fileName = basename($_SERVER['PHP_SELF']);
        $thisPageHeading = $admin->getPageHeading($fileName);
        $content = $admin->getContent($fileName);
        $language = basename(dirname($_SERVER['PHP_SELF']));
        $pageHeadings = $admin->getAllPageHeading($language);
        $pageNames = $admin->getAllPageName($language);
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="default_content_layout.css" type="text/css" rel="stylesheet" />
        <title><?php echo "$thisPageHeading";?></title>
        
    </head>
    <body>
       
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3><?php echo $thisPageHeading?></h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="../../homepage.php"><div class='menuitem'>হোম </div></a>
                        <a  href="../../profile.php"><div class='menuitem'>  প্রোফাইল</div></a>
                        <a href="../../logout.php">   <div class='menuitem'>লগ আউট</div></a>
                    </div>
                    <div class="menuitem">     
                        <ul>
                            <?php 
                            
                            for ($i = 0; $i<sizeof($pageHeadings); $i++){
                                 echo "<li class='menuitem'><a href=".$pageNames[$i].">$pageHeadings[$i]</a></li>";
                            }
                            ?>        
                        </ul>
                    </div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h1><?php echo $thisPageHeading?></h1>
                            <?php echo $content ?>
                           
                        </div>
                    </div>
                </div>
                <div class="gridbox gridright">
                    Advertisement
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

