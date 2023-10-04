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

        //多分idというのはuseridでいいのかしら
        //AUTO_INCREMENTというのは、
        //1.データ型は整数型、
        //2.カラムに値が指定されなかった場合に自動的に値を割り当て、その値は1ずつ増加し連番になる。
        //つまり、今までの掲示板で作った＄numみたいなことになっている。
        //NOT NULLを入れたとしたら、それは何も入れないことを許可しないというもの。filter_inputと一緒かも。
        //PRIMARY KEY(主キー)というのはテーブル内でレコードを一いに識別できるように指定される列(カラム)のこと
        //重複する値は格納することができない。NULLも格納できない。 、
        $sql="CREATE TABLE IF NOT EXISTS tbtest"
        ."("
        ."id INT AUTO_INCREMENT PRIMARY KEY,"
        ."name CHAR(32),"
        ."comment TEXT"
        .");";
        //stmtとはPDOStatementオブジェクトを指している。
        //PDO::queryがSQLを実行した後のSQLの実行結果に関する情報を得たいときに書く。
        //queryデータベースで処理(データの抽出、操作など)を行うための命令
        $stmt =$pdo->query($sql);
        $sql ='SHOW TABLES';
        $result = $pdo -> query($sql);
        foreach ($result as $row){
            echo $row[0];
            echo '<br>';
        }
        echo "<hr>";
        //これは指定したテーブルの作成に使われたCREATE TABLEコマンドを表示することができる。
        $sql ='SHOW CREATE TABLE tbtest';
        $result = $pdo -> query($sql);
        foreach ($result as $row){
        echo $row[1];
        }
    echo "<hr>";


  //このプログラムを実行することにデータが一軒ずつ登録される。このデータ＝レコード
    $name='(まさみん)';
    $comment='(お疲れ様です!)';
    $sql="INSERT INTO tbtest(name, comment) VALUES(:name, :comment)";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':name',$name, PDD::PARAM_STR);
    $stmt->bindParam(':comment',$comment, PDD::PARAM_STR);
    $stmt->execute();
    //bindParamの引数名(:nameなど)はテーブルのカラム名に合わせるとミスが少ない。
        ?>
