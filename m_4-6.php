<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php


        //DB接続設定
        //データソース名
        //SQLとは、構造問い合わせ言語という意味である。データベースへ指示を出す言語のことである。
        //リレーショナルデータベースのデータを操作するための言語である。
        //DDL(データ定義言語)：データベースの定義や作成にかかわる命令文(外枠ってことかな)
        //　CREATE：データベースの定義や作成にかかわる命令文
        //　DROP：データベースやテーブルの削除
        //　ALTER：データベースやテーブルの変更
        //　JOIN：テーブルの結合
        //　TRUNCATE：テーブルのデータを削除

        //DML(データ操作言語)：データの取得・登録・更新・削除などのデータ操作(中身の操作のシステムづくりかな)
        //　SELECT：データ取得
        //　UPDATE：データ更新
        //　DELETE：データ削除
        //　INSERT：データ挿入
        
        //DCL(データ制御言語)：主にトランザクションの制御やデータベースへのアクセスを制御するためのコマンド
        //トランザクション：一連の処理をひとまとめにしたもの。
        //　BEGIN：トランザクション開始
        //　COMMIT：実行した処理の確定
        //　ROLLBACK；データの戻し
        //　GRANT；ユーザー権限付与
        //　REVOKE：ユーザー権限はく奪

        $dsn='mysql:dbname=データベース名;host=localhost';
        $user='ユーザー名';
        $password='パスワード';
        //PHP Data Objectsの略。データベースに接続するための言葉。
        //インスタンスというのはデータベース全般のサービスのこと。SQL Serverの実行単位である。インストールされたSQL　Serverの実態のことであり、エンジンの実行単位である。
        //SQL Serverのプログラムを一つインストールするとインスタンスごとに固有のフォルダ中に実行ファイル郡(サービスの実態)
        //がコピーされ、サービスとして実行されるようになる。インスタンスごとに1プロセス(SQL Serverサービス)が作成され、インスタン単位ごとに実行停止可能。、
        //書き方：インスタンス名=new PDO("データベースの種類:host=接続先アドレス,db=データベース名前
        //　charset=文字エンコード" "ユーザー名","パスワード",オプション)
        //でもここだと　new PDO =("データベースの種類:host=接続先アドレス,ユーザー名,パスワード,オプション)
        //データベースに接続した後にオプションを指定する際は、
        //$pdo->setAttribute(属性,値)
        //PDO::ATTER_ERRMODE,PDO::ERRMODE_EXCEPTION)を設定することで、エラーが発生した時にPDOExceptionの例外を投げてくれる。
        $pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
        
        //SELECT文；データベースからデータを取り出すための構文
        //SELECT句：「どの項目(列)のデータを検索するか」を指定する。
        //*を選択すると表のすべての列データを指定できる。
        //FROM句：「どの表から検索するか」を指定する
        //WHERE　「どのような条件で行を検索するか」を指定する。

        $sql='SELECT * FROM tbtest';
        $stmt=$pdo->query($sql);

        //fetchALLというのは、データベースから受け取ったデータをすべて一つの配列に入れ、それをPHPのプログラム内で加工するのにつかわれる 
        //配列変数=(PDOStatement　オブジェクト)->fetchALL();
        $results=$stmt->fetchALL();
        foreach($results as $row){
              echo $row['id'].',';
              echo $row['name'].',';
              echo $row['comment'].'<br>';
             echo "<hr>";
         }
        ?>
