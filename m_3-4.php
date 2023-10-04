<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
 
    <?php
    $fn="m_3-4.txt";
    if(file_exists($fn)){
        $num = count(file($fn)) + 1;
    }else{
        $num = 1;
    }   
    $fp=fopen($fn,"a");
    $name=filter_input(INPUT_POST,"name");
    $comment=filter_input(INPUT_POST,"comment");
    $date=date("Y/m/d/ H:i:s");
    if(!empty($_POST["submit"]) && !empty($_POST["name"]) && !empty($_POST["comment"]) && empty($_POST["editnumber"])){
     fwrite($fp,$num."<>".$name."<>".$comment."<>".$date."<>".PHP_EOL);
     fclose($fp);
    echo "送信しました！";
    }
    
    elseif(!empty($_POST["delete"]) && $_POST["number"]){
     $number=filter_input(INPUT_POST,"number");
     $contents=file($fn,FILE_IGNORE_NEW_LINES);
     $fp=fopen($fn,"w");
     for($i=0;$i<count($contents);$i=$i+1){
      $content=explode("<>",$contents[$i]);
      $textnum=$content[0];
      if($textnum!=$number){
          fwrite($fp,$contents[$i].PHP_EOL);
          }
        else{ echo "";}
      }
     fclose($fp);
     echo "削除しました！";
    }

    else {echo "";}
?>

       <form method="post">
            <input type="name" name="name" placeholder="名前"　value="
            <?php
            if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
              $editnum=filter_input(INPUT_POST,"editnum");
              $editcontents=file($fn,FILE_IGNORE_NEW_LINES);
              for($i=0;$i<count($editcontents);$i=$i+1){
               $editcontent=explode("<>",$editcontents[$i]);
               if($editcontent[0]==$editnum){
                 echo $editncontent[1];}}}
                   else {echo "";}
            ?>"
            
            ><br>
            <input type="comment" name="comment" placeholder="コメント" value="<?php
            if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
              $editnum=filter_input(INPUT_POST,"editnum");
              $editcontents=file($fn,FILE_IGNORE_NEW_LINES);
              for($i=0;$i<count($editcontents);$i=$i+1){
               $editcontent=explode("<>",$editcontents[$i]);
               if($editcontent[0]==$editnum){
                 echo $editncontent[2];}}}
               else {echo "";}
            ?>"
            ><br>
            <input type="number" name="editnumber" value="<?php
           if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
              $editnum=filter_input(INPUT_POST,"editnum");
              $editcontents=file($fn,FILE_IGNORE_NEW_LINES);
              for($i=0;$i<count($editcontents);$i=$i+1){
               $editcontent=explode("<>",$editcontents[$i]);
               if($editcontent[0]==$editnum){
                 echo $editcontent[0];}}}
               else {echo "";}
             
            ?>"
            >
             <input type="submit" name="submit" value="送信">
           <br><br>
            <input type="number" name="number" placeholder="削除対象番号">
            <input type="submit" name="delete"value="削除"><br><br>
            <input type="number" name="editnum" placeholder="編集対象番号">
            <input type="submit" name="edit" value="編集"><br>
   
</form>     

<?php  
    $contents=file($fn);
    for($i=0;$i<count($contents);$i=$i+1){
    $content=explode("<>",$contents[$i]);
    foreach($content as $cont){
    echo $cont." ";}
    echo "<br>";
    }
    ?>
    
　</body>
</html