<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
</head>
<body>
<form method="post">
 <input type="number",name="number"><br>
 <input type="submit",value="送信"><br>
 </form>

<?php

$num=$_POST["number"];
    echo $num;


?>
</body>
</html>

if(!empty($_POST["num"]))
 {if($num%3==0 && $num%5==0){echo "FizzBuzz";}
  elseif($num%3==0){echo "Fizz";}
  elseif($num%5==0){echo "Buzz";}
     else{echo $num;}}
else{ echo "";}