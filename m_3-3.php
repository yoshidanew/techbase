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
    $fn="m_3-3.txt";
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
        $cont_array=[];
     fwrite($fp,$num."<>".$name."<>".$comment."<>".$date."<>".PHP_EOL);
     fclose($fp);
     $contents=file($fn);
     foreach($contents as $conts){
     $content=explode("<>",$conts);
     $content_array=[
        "num"=>$content[0],
        "name"=>$content[1],
        "comment"=>$content[2],
        "date"=>$content[3]
        ];
        $cont_array[]=$content_array;
       } 
     foreach($cont_array as $contss){
        echo $contss["num"]." ".$contss["name"]." ".$contss["comment"]." ".$contss["date"]."<br>";
     }
    }
    
    elseif(!empty($_POST["delete"])){
     $num=filter_input(INPUT_POST,"number");
     $fp=fopen($fn,"w");
     $contents=file($fn);
     for($i=0;$i<count($contents);$i=$i+1){
      $content=explode("<>",$contents[$i]);
      $postnum=$content[0];
      if ($postnum != $num){
        fwrite($fp,$content[$i].PHP_EOL);  
        fclose($fp);}
        else{ echo "";}
     }}
    
    elseif(file_exists($fn)){
     $contents=file($fn);
     foreach($contents as $conts){
      $content=explode("<>",$conts);
      $cont_array=[];
      $content_array=[
        "num"=>$content[0],
        "name"=>$content[1],
        "comment"=>$content[2],
        "date"=>$content[3]
        ];
        $cont_array[]=$content_array;
     foreach($cont_array as $contss){
        echo $contss["num"]." ".$contss["name"]." ".$contss["comment"]." ".$contss["date"]."<br>";
    }}}

    else{ 
     echo "";
    }
    ?>
</html>