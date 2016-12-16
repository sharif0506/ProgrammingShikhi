<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="default_layout_style.css" type="text/css" rel="stylesheet" />
        <title>ProgrammingShikhi</title>
    </head>
    <body>
        <div class="gridcontainer">
            <div class="gridwrapper">
                <div class="gridbox gridheader">
                    <div class="header">
                        <h1>ProgrammingShikhi</h1>
                        <h3><?php echo "C Tutorial"; ?></h3>
                    </div>
                </div>
                <div class="gridbox gridmenu">
                    <div class="menuitem"><?php
                        for ($i = 0; $i < 5; $i++) {
                            echo "<div class='menuitem'>"." Topic $i </div>";
                        }
                        ?></div>

                </div>
                <div class="gridbox gridmain">
                    <div class="main">
                        <h1>Topic 1</h1>
                        <p>This is the content of topic one...</p>

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
