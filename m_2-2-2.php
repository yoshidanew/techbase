<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>mission_2-02</title>
</head>
<body>
<form action="" method="post">
<input type="text" name="str">
<input type="submit" name="submit"　value=" ">
</form>
<?php
$str = filter_input(INPUT_POST,'str');
if(!empty($str)) {
  $filename = "m_2-2.txt";
  $fp = fopen($filename,"w");
  fwrite($fp, $str.PHP_EOL);
  fclose($fp);
  if ($str=="完成!") echo "おめでとう！";
          else echo $str."を受け付けました。";
}
?>
</body>
</html>