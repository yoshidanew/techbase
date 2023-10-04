<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
</head>
<body>
<form method="post">
    <input type="text" name="comment">　<br>
    <input type="submit" value="送信"> <br>
    </form>
<?php
$fn="m_2-2.txt";
$fp=fopen($fn,"w");
if(!empty($_POST["comment"])){
 $str=$_POST["comment"];
 fwrite($fp,"$str".PHP_EOL);
 fclose($fp);
 $contexts=file($fn,FILE_IGNORE_NEW_LINES);
 foreach($contexts as $cont){
 if($cont=="ありがとう"){
     echo "どういたしまして！";
 }else{$fp=fopen($fn,"r");
 $contexts=file($fn);
 foreach($contexts as $cont){
     if($cont=="完成"){echo "おめでとう";}
     else{echo $cont."を送信しました。";}}
}}}
?>
</body>
</html>