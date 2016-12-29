<?php
require 'admin/admin.php';
$admin = new Admin();

session_start();
if (!isset($_SESSION["user"])) {
    header("location:../index.php");
}
$quizInfo = array();
$quizset = basename($_SERVER['PHP_SELF']);
$quizInfo = $admin->getQuiz($quizset);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="run.css" type="text/css" rel="stylesheet" />
        <title><?php echo "Code Practice"; ?></title>
        <style>
            textArea{
                font-size: 22px;
            }
        </style>
    </head>
    <body>

        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header" align="center">
                        <h1>প্রোগ্রামিং শিখি</h1>
                        <h3><?php echo "Code Practice" ?></h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem">
                        <a href="../../homepage.php"><div class='menuitem'>হোম </div></a>
                        <a  href="../../profile.php"><div class='menuitem'>প্রোফাইল</div></a>
                        <a href="../../logout.php">   <div class='menuitem'>লগ আউট</div></a>
                    </div>


                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <div class="login">
                            <h2><?php echo "Write code here" ?></h2>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <textarea name='sourceCode' rows='20' cols='40' required ><?php if (isset($_POST['sourceCode'])) echo $_POST['sourceCode'] ?></textarea>

                                <br />
                                <input class="buttonNext" type="submit" value="Run" />
                            </form>
                        </div>
                        <div>
                            <h2><?php echo "Output" ?></h2>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $error = "";
                                $input = $_POST['sourceCode'];
                                $openedFile = fopen("test.c", 'w');
                                fwrite($openedFile, $input);
                                fclose($openedFile);
                                $process = proc_open('gcc test.c', array(
                                    1 => array("pipe", "w"), //stdout
                                    2 => array("pipe", "w")   // stderr
                                        ), $pipes);


                                $error = stream_get_contents($pipes[2]);
                                if ($error == '') {
                                    system("a.exe>output.txt");
                                    echo "<textarea name='output' rows='10' cols='40' required >" . file_get_contents('output.txt') . "</textarea>";
                                } else {
                                    echo $error;
                                }

                            }
                            ?>

                        </div>
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

