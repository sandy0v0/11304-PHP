<?php 
session_start();
if(!isset($_GET['login'])){
    header("location:login.php");
    exit();
}


$acc=$_POST['acc'];
$pw=$_POST['pw'];

if($acc=='admin' && $pw=='123456'){
    echo "帳密正確：登入成功";
    session_start();
    $_SESSION['login']=$acc;
    echo "<br><a href='login.php?login=$acc'>回首頁</a>";
}else{
    echo "帳密錯誤：登入失敗";

}

?>
