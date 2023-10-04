<?php
$filename="mission_1-25.txt";
$str="ガラスペン";
$exists=file_exists("$filename");
$contents=file($filename,FILE_IGNORE_NEW_LINES);

$fp=fopen($filename,"a");

fwrite($fp,$str.PHP_EOL);

fclose($fp);

echo "ファイル書き込み成功！！"."<br>";

if($exists){
    foreach( $contents as $cont){
        echo $cont."<br>";
    } }
    
echo $str

?>