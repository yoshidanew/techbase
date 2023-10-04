<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
<form  method="post">
    <input type="text" name="comment"> <br>
 <input type ="submit" value="送信">　
 </form><br>
<?php
$str=$_POST['comment'];
echo $str;
?>
<body>
</html>