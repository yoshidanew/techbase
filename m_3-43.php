 <!DOCTYPE html>
 <html lang="ja">
 <head>
 <meta charset="utf-8" />
 <title>mission_3-4</title>
 </head>
 <body>
 <?php
 $name=$_POST["name"];
 $contents=$_POST["text"];
 $deletenum=$_POST["number"];
 $editnum=$_POST["number2"];
 $exnumber=$_POST["exnum"];
 $date = date("Y/m/d H:i:s");
 $filename="mission_3-4.txt";

 //投稿機能及び編集実行機能
 if (!empty($_POST["name"]) && !empty($_POST["text"])) {
                 if(empty($_POST["exnum"])){
                       if(file_exists($filename)){
                           $num = (count(file($filename)) + 1);
                           }else{$num=1;
                           } 
      $comment=$num."<>".$name."<>".$contents."<>".$date;
          $fp=fopen($filename, "a");
      fwrite($fp, $comment.PHP_EOL);
      fclose($fp);
 }else{
      $lines=file($filename,FILE_IGNORE_NEW_LINES);
       $fp=fopen($filename, "w");
                foreach($lines as $line){
                 $value=explode("<>", $line);
                 if($value[0]==$exnumber){
                     fwrite($fp, $exnumber."<>".$name."<>".$contents."<>".$date.PHP_EOL);
             }elseif($value[0]!=$exnumber){
                     fwrite($fp, $value[0]."<>".$value[1]."<>".$value[2]."<>".$value[3].PHP_EOL);
                 }elseif($value[0]="削除済み"){
                     fwrite($fp, $value[0]);
                 }
 }fclose($fp);
 }}

 //削除機能
 if(file_exists($filename) && isset($_POST["削除"]) && !empty($deletenum)){
     $lines=file($filename,FILE_IGNORE_NEW_LINES);
       $fp=fopen($filename, "a");
                foreach($lines as $line){
                 $value=explode("<>", $line);
                 if($value[0]==$deletenum && $line!="削除済み"){
                      array_splice($lines, $deletenum-1, 1,"削除済み");
                      file_put_contents($filename, implode("\n", $lines).PHP_EOL);
                 }
                 elseif($value[0]!=$deletenum && $line!="削除済み"){
                    echo "$value[0] $value[1] $value[2] $value[3]"."<br>";}
                    }
                     fclose($fp);
 }


 //編集機能
 if(!empty($_POST["編集"])){
     $lines=file($filename,FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                 $value=explode("<>", $line);
                 if($value[0]==$editnum && $line!="削除済み"){
                 $exnum=$value[0];
                 $exname=$value[1];
                 $excontents=$value[2];
                 }}
 }

                 
 ?>

 <form action="" method="post">
      名前<br> <input type="name" name="name"value="<?php if(isset($exname)) {echo $exname;} ?>" placeholder="ここに入力して下さい"><br>
      コメント<br><input type="text" name="text"value="<?php if(isset($excontents)) {echo $excontents;} ?>" placeholder="ここに入力して下さい"><br>
       <input type="hidden" name="exnum" value="<?php if(isset($exnum)) {echo $exnum;} ?>" placeholder="編集番号表示">
       <input type="submit" name="送信" value="送信"><br><br>
        </form>
       
       <form action="" method="post">
       削除用<br><input type="number" name="number" value=""placeholder="数字を入力して下さい"><br>
       <input type="submit" name="削除" value="削除"><br><br>
        編集対象番号<br><input type="number" name="number2" value=""placeholder="数字を入力して下さい"><br>
       <input type="submit" name="編集" value="編集"><br>
        </form>
        

 <?php
 //ブラウザ表示機能   
  if(file_exists($filename) && isset($_POST["送信"])){
  $lines=file($filename,FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                    if($line=="削除済み"){
                echo $line."<br>";}
            else{$value=explode("<>", $line);
                echo "$value[0] $value[1] $value[2] $value[3]"."<br>";}
                }}
 ?>

 </body>
 </head>