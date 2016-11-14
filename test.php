<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="default_layout_style.css" type="text/css" rel="stylesheet" />
        <title>ProgrammingShikhi</title>
    </head>
    <body>
        <form action="#" method="post">
            <select name="Color">
                <option value="Red">Red</option>
                <option value="Green">Green</option>
                <option value="Blue">Blue</option>
                <option value="Pink">Pink</option>
                <option value="Yellow">Yellow</option>
            </select>
            <input type="submit" name="submit" value="Get Selected Values" />
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $selected_val = $_POST['Color'];  
            echo "You have selected :" . $selected_val;
        }
        ?>
    </body>
</html>
