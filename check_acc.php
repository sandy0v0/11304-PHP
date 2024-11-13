<?php 
// session_start();
if(!isset($_POST['acc'])){
    header("location:login.php");
    exit();
}

$acc=$_POST['acc'];
$pw=$_POST['pw'];

$row=$pdo->query("select * from `member` where acc=$acc && pw =$pw")->fetch();

if($acc==$row['acc'] && $pw==$row['pw']){
    echo "帳密正確：登入成功";
    // session_start();
    setcookie("login","$acc",time()+180);
    echo $_COOKIE['login'];
    echo "<br><a href='login.php'>回首頁</a>";
}else{
    echo "帳密錯誤：登入失敗";

}

?>