<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql="UPDATE `member` SET `acc`='{$_POST['acc']}' , 
                           `pw`='{$_POST['pw']}' ,
                           `email`='{$_POST['email']}' ,
                           `tel`='{$_POST['tel']}' 
                           WHERE `id`='{$_POST['id']}'";

/* echo $sql;
exit */

$dsn="mysql:host=localhost;charset=utf8;dbname=crud";
$pdo=new PDO($dsn,'root','');

if($pdo->exec($sql)){

    // echo "新增資料成功";
    header("location:reg_form.php?status=1");
}else{

    // echo "新增資料失敗";
    header("location:reg_form.php?status=0");
}


?>