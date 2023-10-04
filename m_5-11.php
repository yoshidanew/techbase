<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>mission5-1</title>
    </head>
    <body>
    <?php
        $dsn='mysql:dbname=データベース名;host=localhost';
        $user='ユーザー名';
        $password='パスワード';
        
        $pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

        $sql="CREATE TABLE IF NOT EXISTS mission5_1table"
        ."("
        ."id INT AUTO_INCREMENT PRIMARY KEY,"
        ."name CHAR(32),"
        ."comment TEXT,"
        ."date CHAR(32),"
        ."password CHAR(32)"
        .");";

        $stmt=$pdo->query($sql);
    ?>
    </body>
    </html> 