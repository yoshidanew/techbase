<?php
//書き込みモードファイルを開く
$fp=fopen("mission_1-25.txt","a");
//ファイルに書き込む
$str="Hello World";
fwrite($fp,"$str".PHP_EOL);

//ファイルを閉じるr
fclose($fp);

echo "ファイル書き込み成功！！"

?>