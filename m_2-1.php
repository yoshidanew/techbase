<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
</head>
<body>
<form method="post">
 <input type="comment" name="comment" value="コメント"><br>
 <input type="submit" value="送信"><br>
</form>
<?php
if(!empty($_POST["comment"])){
$str=$_POST["comment"];
echo $str."を受け付けました。";}
else{echo "";}
?>
</body>
</html>