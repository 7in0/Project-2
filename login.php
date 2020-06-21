<?php
require_once("mysqli_oop_connect.php");
try{
//
//$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
//$name = $_POST['username'];
//$pwd = $_POST['password'];
//$sql = "select Pass from traveluser where UserName = '$name'";
//$result = mysqli_query($connection, $sql);
//$row = mysqli_fetch_assoc($result);
//echo $row[0];
//if ($pwd == $row[0]) {
//    $expiryTime = time() + 60 * 60 * 24;
//    setcookie("Username", $_POST['username'], $expiryTime);
//    echo "<script>alert('登录成功，正在为您跳转主页');location.href= 'index.php';</script>";
//} else {
//    echo " <script>alert('用户名或密码错误，请重新输入');location.href= 'login.html';</script>";
//    echo $pwd;

//}
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//得到用户的输入
$name = $_POST['username'];

$pwd = $_POST['password'];

    $sql_name = "select Pass from traveluser where UserName = '$name'";

    $result = $pdo->query($sql_name);

    $row = $result->fetch();

    $expiryTime =time()+60*60*24;


    if ($pwd == $row[0] ){
        setcookie("Username", $_POST['username'], $expiryTime);
        echo "<script>location.href ='index.php';</script>";
    }else {
        echo "<script>alert('用户名或密码错误');</script>";
    }

$pdo = null;
}catch (PDOException $e){
    die($e->getMessage());
}
