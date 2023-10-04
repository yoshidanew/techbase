<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
<form method="post">
<input type="number" name="number" ><br>
<input type="submit" name="送信"><br>
</form>
<?php
$num=$_POST["number"];
if($num%3==0){echo "Fizz";}else{ echo "";}
if($num%5==0){echo "Buzz";}else{ echo "";}
if($num%3!=0 && $num%5!=0){echo $num;}else{ echo "";}
?>

</body>
</html>

