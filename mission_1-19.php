<?php
for($i=0;$i<=99;$i=$i+1)
{if($i%3==0){echo"Fizz";}else{echo "";}
if($i%5==0){echo"Buzz";}else{echo "";}
if($i%3!=0 && $i%5!=0){echo $i;}else{echo "";}
echo "<br>";};
?>