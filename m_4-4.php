<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php


        //DB接続設定
        //データソース名
        $dsn='mysql:データベース名;host=localhost';
        $user='ユーザー名';
        $password='パスワード';
        //PHP Data Objectsの略。どのデータベースを使っているのかを隠してくれる。
        $pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));


        $sql ='SHOW TABLES';
        $result = $pdo -> query($sql);
        foreach ($result as $row){
            echo $row[0];
            echo '<br>';
        }
        echo "<hr>";
        $sql ='SHOW CREATE TABLE tbtest';
        $result = $pdo -> query($sql);
        foreach ($result as $row){
        echo $row[1];
        }
    echo "<hr>";
        ?>
