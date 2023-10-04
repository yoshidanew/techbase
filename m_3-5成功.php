<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
     <?php
     echo "テーマ：好きな曲のタイトル";
      //定義
      $filename="m_3-5.txt";
      $name=filter_input(INPUT_POST,"name");
      $comment=filter_input(INPUT_POST,"comment");
      $date=date("Y/m/d H:i:s");
      $deletenum=filter_input(INPUT_POST,"deletenum");
      $editnum=filter_input(INPUT_POST,"editnum");
      $passward=filter_input(INPUT_POST,"passward");
      $editpass=filter_input(INPUT_POST,"editpass");
      
      //送信および編集機能
      //送信機能と編集機能を分けるためにeditnumberがからであるかどうか定義すること。
       if(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["passward"]) && empty($_POST["editnumber"]) && !empty($_POST["submit"])){
           if(file_exists($filename)){
               $lines=file($filename,FILE_IGNORE_NEW_LINES);
               $num=count($lines)+1;
           }
           else{$num=1;
           }
         $fp=fopen($filename,"a");
         fwrite($fp,$num."<>".$name."<>".$comment."<>".$date."<>".$passward."<>".PHP_EOL);
         fclose($fp);
       }
       
       elseif(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["editnumber"]) && !empty($_POST["passward"])){
           $num=filter_input(INPUT_POST,"editnumber");
           $lines=file($filename,FILE_IGNORE_NEW_LINES);
           $fp=fopen($filename,"w");
           foreach($lines as $line){
               $element=explode("<>",$line);
                   if($element[0]!=$num){
                       fwrite($fp,$line.PHP_EOL);
                   }
                   elseif($element[0]==$num){
                       fwrite($fp,$num."<>".$name."<>".$comment."<>".$date."<>".$passward.PHP_EOL);
                   }
                   else{echo "";}
           
     
       }
             fclose($fp);
       }
      //削除機能
       if(!empty($_POST["deletenum"]) && !empty($_POST["delete"])){
           $lines=file($filename,FILE_IGNORE_NEW_LINES);
           $fp=fopen($filename,"w");
           foreach($lines as $line){
               $element=explode("<>",$line);
               if($element[0]==$deletenum && $element[4]==$_POST["deletepass"]){
                   fwrite($fp,"削除済み".PHP_EOL);
               }
               elseif($element[0]!=$deletenum){
                   fwrite($fp,$element[0]."<>".$element[1]."<>".$element[2]."<>".$element[3]."<>".$element[4].PHP_EOL);
               }
             
           fclose($fp);
       }
       }

 //編集機能での呼び出し
      if(!empty($_POST["editnum"]) && !empty($_POST["edit"])){
          $lines=file($filename,FILE_IGNORE_NEW_LINES);
          foreach($lines as $line){
              $element=explode("<>",$line);
              if($element[0]==$editnum && $element[4]==$_POST["editpass"]){
                  $newname=$element[1];
                  $newcomment=$element[2];
              }
              elseif($element[0]==$editnum && $element[4]!=$_POST["editpass"]){
                  echo "パスワードが違います。";
              }
          }
      }
     

     ?>
<form method="post">
    <input type="name" name="name" placeholder="名前" value="<?php
            if(!empty($_POST["edit"]) && !empty($_POST["editnum"]) && !empty($newname)){
                 echo $newname;}
                 else{echo "";}
            ?>"
            
            ><br>
            <input type="comment" name="comment" placeholder="コメント" value="<?php
            if(!empty($_POST["edit"]) && !empty($_POST["editnum"]) && !empty($newcomment)){
                 echo $newcomment;}
               else {echo "";}
            ?>"
            ><br>
            <input type="hidden" name="editnumber" value="<?php  
            if(!empty($_POST["edit"]) && !empty($_POST["editnum"]) && !empty($newname)){
                echo $editnum;}
            ?>"
            >
    <input type="password" name="passward" placeholder="パスワード">
    <input type="submit" name="submit" value="送信">
            <br><br>
            
            <!--削除フォーム/-->
    <input type="number" name="deletenum" placeholder="削除対象番号">
            <br>
    <input type="password" name="deletepass" placeholder="パスワード">
    <input type="submit" name="delete" value="削除">
        　　<br><br>
    <input type="number" name="editnum" placeholder="編集対象番号">
        　　<br>
    <input type="password" name="editpass" placeholder="パスワード">
    <input type="submit" name="edit" value="編集">

        </form>
        
     <?php
    
      if(file_exists($filename)){
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
            $element=explode("<>",$line);
            if($element[0] =="削除済み"){
          echo ""; 
        }
            else{
                echo $element[0]." ".$element[1]." ".$element[2]." ".$element[3]."<br>";
            }
          
      }
      }
    ?>
 
    </body>  
</html>