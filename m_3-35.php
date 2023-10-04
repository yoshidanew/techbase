<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <form method="post">
            <input type="name" name="name" value="名無しさん"><br>
            <input type="comment" name="comment" placeholder="名前">
            <input type="submit" name="submit" value="送信"　placeholder="コメント"><br><br>
            <input type="number" name="number" placeholder="削除対象番号">
            <input type="submit" name="delete"value="削除"><br>
   
    <?php
    $fn="m_3-35.txt";
    if(file_exists($fn)){
        $num = count(file($fn)) + 1;
    }else{
        $num = 1;
    }   
    $fp=fopen($fn,"a");
    $name=filter_input(INPUT_POST,"name");
    $comment=filter_input(INPUT_POST,"comment");
    $date=date("Y/m/d/ H:i:s");
    if(!empty($_POST["submit"]) && !empty($_POST["name"]) && !empty($_POST["comment"])){
     fwrite($fp,$num."<>".$name."<>".$comment."<>".$date."<>".PHP_EOL);
     fclose($fp);
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
    }
    else{echo "";}
     
     
    $contents=file($fn);
    for($i=0;$i<count($contents);$i=$i+1){
    $content=explode("<>",$contents[$i]);
    foreach($content as $cont){
    echo $cont." ";}
    echo "<br>";
    }
    ?>
　</body>
</html>