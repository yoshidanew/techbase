<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>mission5-1test</title>
<head>
<body>
<?php
  if(!empty($_POST["edit"]) && !empty($_POST["editnum"])){
        $id=filter_input(INPUT_POST,"editnum");
        $sql4='SELECT * FROM mission5_1table';
        $stmt=$pdo->prepare($sql4);
        $results=$stmt->fetchALL();
        foreach($results as $row){
         if($row['id']==$id){
          $newname=$row['name'];
          $newcomment=$row['comment'];
         }
        }
    ?>
    