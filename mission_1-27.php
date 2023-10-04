<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8"/>
 </head>
  <body>
   <form method="post">
    <input type="number" name="num"><br>
    <input type="submit" name="送信"><br>
   </form>

   <?php
    $fp=fopen("mission_1-27.txt","a");
    if(!empty($_POST["num"]))
     {$num=$_POST["num"];
      fwrite($fp,$num.PHP_EOL);
      fclose($fp);
      echo "書き込み成功！！<br>";
     }
     else{ echo "";}
     
$contexts=file("mission_1-27.txt",FILE_IGNORE_NEW_LINES);

if(file_exists("mission_1-27.txt")){
 foreach($contexts as $cont){
     if($cont%3==0 && $cont%5==0){echo "FizzBuzz<br>";}
     elseif($cont%3==0){ echo "Fizz<br>";}
     elseif($cont%5==0){echo "Buzz<br>";}
     else{echo $cont."<br>";}}}
   

?>
</body>
</html>