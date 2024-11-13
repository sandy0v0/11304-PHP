<?php 
$dsn="mysql:host=localhost;charset=utf8;dbname=crud";
$pdo=new PDO($dsn,'root','');


echo $_POST['acc'];
echo $_POST['pw'];

if(!isset($_POST['acc'])){
    header("location:login2.php");
    exit();
}

$acc=$_POST['acc'];
$pw=$_POST['pw'];


// $sql="select * from `member` where `acc`='$acc' && `pw` ='$pw'";
$sql="select count(id) from `member` where `acc`='$acc' && `pw` ='$pw'";
//echo $sql;
$row=$pdo->query($sql)->fetchColumn();

//echo "<pre>";
//print_r($row);
//echo "</pre>";

// if($acc=$row['acc'] && $pw==$row['pw']){
if($row>=1){
    // echo "帳密正確:登入成功";
    // $_SESSION['login']=$acc;
    // echo "<br><a href='login2.php'>回首頁</a>";
    header("location:success.php");
}else{
    // echo "帳密錯誤:登入失敗";
    header("location:login2.php?err=1");
}


?>