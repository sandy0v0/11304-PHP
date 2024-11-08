<?php
$dsn= "mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$class_id=$GET['id'];
$class_sql="select * from classes" where id='$class_id';
$rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[班級]詳細資料</title>
</head>
<body>
<h1>班級學員</h1>    
<?php



?>

</body>
</html>