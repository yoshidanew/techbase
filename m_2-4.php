<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>m_2-4</title>
</head>
<body>
「(コメント)　by(名前)」という感じでコメントをお願いします。
<form action="" method="post">
<input type="text" name="str">
<input type="submit" name="submit"　value=" ">
</form>
<?php
$str = filter_input(INPUT_POST,'str');
if(!empty($str)) {
$filename = "m_2-4.txt";
$fp = fopen($filename,"a");
fwrite($fp, $str.PHP_EOL);
fclose($fp);
}
$filename="m_2-4.txt";
$contents=file($filename);
foreach($contents as $cont){
echo $cont."<br>";}
?>
</body>
</html>