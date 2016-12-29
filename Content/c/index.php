<?php
require '../../admin/admin.php';
$admin = new Admin();

session_start();
if (!isset($_SESSION["user"])) {
    header("location:../../index.php");
}
$email = $_SESSION['user'];
$fileName = basename($_SERVER['PHP_SELF']);
$thisPageHeading = $admin->getPageHeading($fileName);
$content = $admin->getContent($fileName);
$language = basename(dirname($_SERVER['PHP_SELF']));
$_SESSION['language'] = $language;
$pageHeadings = $admin->getAllPageHeading($language);
$pageNames = $admin->getAllPageName($language);
$previousPage = $admin->getPreviousPage($fileName);
$nextPage = $admin->getNextPage($fileName);
$isComplete = $admin->isCompleteLearning($fileName, $email);
$quizset = "quizof".$fileName;
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $admin->updateLastLearning($fileName, $email);
//    $admin->updateLearning($fileName, $email, $language);
//    header("Location:$nextPage");
//}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="default_content_layout.css" type="text/css" rel="stylesheet" />
        <title><?php echo "$thisPageHeading"; ?></title>
        <style>

            .buttonDone {
                background-color: #255627; /* Green */
                border: none;
                color: white;
                padding: 10px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 18px;
                margin: 4px 2px;
                cursor: pointer;
                width: 40%;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
            }



            .buttonDone:hover {
                box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
            }


        </style>
    </head>
    <body>

        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div  class="header" align="center">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3><?php echo $thisPageHeading ?></h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="../../homepage.php"><div class='menuitem'>হোম </div></a>
                        <a  href="../../profile.php"><div class='menuitem'>প্রোফাইল</div></a>
                        <a href="../../logout.php"><div class='menuitem'>লগ আউট</div></a>
                    </div>
                    <div class="menuitem">     
                        <ul>
                            <?php
                            for ($i = 0; $i < sizeof($pageHeadings); $i++) {
                                echo "<li class='menuitem'><a href=" . $pageNames[$i] . ">$pageHeadings[$i]</a></li>";
                            }
                            ?>        
                        </ul>
                    </div>
                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <!--<h1><?php echo $thisPageHeading ?></h1>-->
                            <?php echo $content ?>

                        </div>
                    </div>
                    <div id="pagination" align="center">
                        <?php
                        if ($previousPage != "") {
                            echo "<a href=" . "$previousPage" . "><button class='buttonPrev' style='vertical-align:middle'><span>Previous</span></button> </a>";
                        }
                        ?>      
                        <!--<form action="<?php// echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="display: inline">-->
                           
                            <?php 
                            if ($isComplete==TRUE){
                                echo '<input class="buttonDone" type="submit" value="Completed" disabled />';
                            }  else {
                                //echo '<input class="buttonDone" type="submit" value="Mark As Completed" />'; 
                                echo "<a href='quiz/".$quizset."' ><button class='buttonDone'>Mark As Complete</button></a>";
                            }   
                            ?>
                            
                        <!--</form>-->
                        

                        <?php
                        if ($nextPage != "") {
                            echo "<a href=" . "$nextPage" . "><button class='buttonNext' style='vertical-align:middle'><span>Next</span></button> </a>";
                        }
                        ?>
                    </div>
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