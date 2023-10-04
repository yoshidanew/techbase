<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>mission5-1</title>
    </head>
    <body>

    <?php
    $dsn='mysql:dbname=データベース名;host:localhost';
    $user='ユーザー名';
    $password='パスワード';
    $pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

    $name=filter_input(INPUT_POST,"name");
    $comment=filter_input(INPUT_POST,"comment");
    $pass=filter_input(INPUT_POST,"subpass");
    $date=date("Y/m/d H:i:s");

    //投稿機能と編集機能
    if(!empty($_POST["submit"]) && !empty($_POST["name"]) && !empty($_POST["comment"]) && empty($_POST["editnumber"])){
     $sql="INSERT INTO mission5_1table (name, comment, date, password) VALUES(:name, :comment, :date, :password)";
     $stmt=$pdo->prepare($sql);
     $stmt->bindParam(':name',$name,PDO::PARAM_STR);
     $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
     $stmt->bindParam(':date',$date,PDO::PARAM_STR);
     $stmt->bindParam(':password',$pass,PDO::PARAM_STR);
     $stmt->execute();

     echo "送信しました。";
    }
    elseif(!empty($_POST["submit"]) && !empty($_POST["editnumber"])){
      $id=filter_input(INPUT_POST,"editnumber");
      $sql='UPDATE mission5_1table SET name=:name,comment=:comment, date=:date, password=:password WHERE id=:id';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':name',$name,PDO::PARAM_STR);
      $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
      $stmt->bindParam(':date',$date,PDO::PARAM_STR);
      $stmt->bindParam(':password',$pass,PDO::PARAM_STR);
      $stmt->bindParam(':id',$id,PDO::PARAM_INT);
      $stmt->execute();

      echo "編集しました。";
    }
      


    //削除機能
    if(!empty($_POST["delete"]) && !empty($_POST["deletenum"])){
     $id=filter_input(INPUT_POST,"deletenum");
     $deletepass=filter_input(INPUT_POST,"deletepass");
     $sql='SELECT * FROM mission5_1table';
     $stmt=$pdo->query($sql);
     $results=$stmt->fetchALL();
     foreach($results as $row){
      $depass=$row['password'];      
      if($row['id']==$id && $row['password']==$deletepass){
       $sql='delete from mission5_1table where id=:id';
       $stmt=$pdo->prepare($sql);
       $stmt->bindParam(':id',$id,PDO::PARAM_INT);
       $stmt->execute();

       echo "削除しました。";
      }
      elseif($row['id']==$id && $row['password']!=$deletepass){
        echo "パスワードが違います。";
      }
     }
    }

    //編集呼び出し定義
    if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
        $editid=filter_input(INPUT_POST,"editnum");
        $editpass=filter_input(INPUT_POST,"editpass");
        $sql='SELECT * FROM mission5_1table';
        $stmt=$pdo->query($sql);
        $results=$stmt->fetchALL();
        foreach($results as $row){
         if($row['id']==$editid && $row['password']==$editpass){
          $newname=$row['name'];
          $newcomment=$row['comment'];
         }
         elseif($row['id']==$editid && $row['password']!=$editpass){
          $newname="";
          $newcomment="";
          echo "パスワードが違います。";
         }
        }
    }
    ?>
    <!--入力フォーム/-->
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" value="<?php
         if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
          echo $newname;
         }
        ?>">
        <br>
        <input type="text" name="comment" placeholder="コメント" value="<?php
         if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
            echo $newcomment;
        }
        ?>">
        <br>
        <input type="password" name="subpass" placeholder="パスワード">
        <input type="hidden" name="editnumber" value="<?php
          if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
            echo $editid;
          }
          ?>">
        <input type="submit" name="submit" value="送信">
        <br><br>

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
    //ブラウザ表示
    $sql='SELECT*FROM mission5_1table';
    $stmt=$pdo->query($sql);
    $results=$stmt->fetchALL();
    foreach($results as $row){
           echo $row['id'].' ';
           echo $row['name'].' ';
           echo $row['comment'].' ';
           echo $row['date'].'<br>';
     echo "<hr>";
    }
    ?>
    </body>
</html>