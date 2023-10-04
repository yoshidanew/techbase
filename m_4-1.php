<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php


        //DB接続設定
        $dsn='mysql:データベース名;host=localhost';
        $user='ユーザー名';
        $password='パスワード';
        $pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
