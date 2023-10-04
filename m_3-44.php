<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
    <?php
    $filename="m_3-44.txt";
    $name=filter_input(INPUT_POST,"name");
    $comment=filter_input(INPUT_POST,"comment");
    $date=date("Y/m/d H:i:s");
    $deletenum=filter_input(INPUT_POST,"deletenum");
    $editnum=filter_input(INPUT_POST,"editnum");
    
    if(!empty($_POST["submit"]) && !empty($_POST["name"]) && $_POST["comment"]){
          if(file_exists($fn)){
            $num = count(file($fn)) + 1;
            }
           elseif(!empty($_POST["editnumber"])){
            $num=$_POST["editnumber"];
            }
           else{$num = 1;}
        $fp=fopen($filename,"a");
        fwrite($fp,$num."<>".$name."<>".$comment."<>".$date.PHP_EOL);
        fclose($fp);
     }
     elseif(!empty($_POST["submit"]) && !empty($_POST["name"]) && $_POST["comment"] && $_POST["editnumebr"]){
         $num=filter_input(INPUT_POST["editnum"]);
         $fp=fopen($filename,"w");
         $lines=file($filename,FILE_IGNORE_NEW_LINES);
         foreach($lines as $line){
          $element=explode("<>",$line);
          if($editnumber!=$element[0]){
              fwrite($fp,$element[0]."<>".$element[1]."<>".$element[2]."<>".$element[3].PHP_EOL);
          }
          elseif($editnumber==$element[0]){
              fwrite($fp,$num."<>".$name."<>".$comment."<>".$date.PHP_EOL);
          }
          elseif("削除済み"==$element[0]){
              fwrite($fp,$element[0].PHP_EOL);
          }
         fclose($fp);
         }
         
    if(!empty($_POST["delete"]) && !empty($_POST["deletenum"])){
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
        $fp=fopen($filename,"w");
        foreach($lines as $line){
            $element=explode("<>",$line);
            if($element[0]!=$deletenum){
                fwrite($filename,$element[0]."<>".$element[1]."<>".$element[2]."<>".$element[3].PHP_EOL);
            }
            elseif($element[0]==$deletenum){
                fwrite($filename,"削除済み");
            }
         fclose($fp);
        }
    }
         
    if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
     $lines=file($filename,FILE_IGNORE_NEW_LINES);
     foreach($lines as $line){
         $element=explode("<>",$line);
         if($editnum==$element[0]){
             $newname==$element[1];
             $newcomment==$element[2];
         }
     }
    }
    
    ?>
        
        <form method="post">
        <input type="name" name="name" placeholder="名前" value="
        <?php
         if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
             echo $newname;
         }
        ?>"><br>
        
        <input type="comment" name="comment" placeholder="コメント" value="
        <?php
        if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
            echo $newcomment;
        }
        ?>"><br>
        
        <input type="number" name="editnumber" placeholder="" value="
        <?php
        if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
            echo $editnum;}
            ?>">
            
        <input type="submit" name="送信" value="送信">
        <br><br>
        
        <input type="number" name="deletenum" placeholder="削除対象番号">
        <input type="submit" name="削除" value="delete">
        <br><br>
        
        <input type="number" name="editnum" placeholder="編集対象番号">
        <input type="submit" name="edit" value="編集">
        </form>
        
     <?php

    if(file_exists($filename)){
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
             if($line=="削除済み"){
                 echo "";}
                else{
                    $element=explode("<>",$line);
                    echo $element[0]." ".$element[1]." ".$element[2]." ".$element[3]."<br>";
                    
                }
             }
             
         }
    } 
     ?>
    </body> 
    </html>
    
     <input type="name" name="name" placeholder="名前"　value=
            <?php
             $lines=file($filename,FILE_IGNORE_NEW_LINES);
             foreach($lines as $line){
              $element=explode("<>",$line);
             if(!empty($_POST["edit"]) && !empty($_POST["editnum"]) && $element[4]==$editpass){
                 echo $element[1];
             }
             else {echo "";}
             }
            ?>
            ><br>
    <input type="comment" name="comment" placeholder="コメント"　value="
            <?php
             $lines=file($filename,FILE_IGNORE_NEW_LINES);
             foreach($lines as $line){
              $element=explode("<>",$line);
              if(!empty($_POST["edit"]) && !empty($_POST["editnum"]) && $element[4]==$editpass){
                 echo $element[2];
             }
             else {echo "";}
            }
            ?>"
            >
    <input type="number" name="editnumber" value="
            <?php
             $lines=file($filename,FILE_IGNORE_NEW_LINES);
             foreach($lines as $line){
              $element=explode("<>",$line);
             if(!empty($_POST["edit"]) && !empty($_POST["editnum"]) && $element[4]==$editpass){
                 echo $element[0];
             }
             else{echo "";}
             }
            ?>"
            ><br>
