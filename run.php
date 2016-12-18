<?php

$input = $_POST['code'];
$openedFile = fopen("test.c", 'w');
fwrite($openedFile, $input);
fclose($openedFile);

$process = proc_open('gcc test.c',
    array(
        1 => array("pipe", "w"),  //stdout
        2 => array("pipe", "w")   // stderr
    ), $pipes);

echo stream_get_contents($pipes[2]);
print_r($pipes[0] );
exec ("a.exe > output.txt", $out);
//var_dump($out);
//echo $pipes[1];
//$output = shell_exec($cmdCommand1);
//echo $output;
//exec("gcc cFile.c", $out);
//exec ("a.exe", $out);
//
//print_r( $out);