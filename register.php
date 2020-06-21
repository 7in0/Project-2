<?php
//缺少重复验证
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('mysqli_oop_connect.php');
    $mysqli = new MySQLi(DBHOST, DBUSER, DBPASS, DBNAME);
    $user = $mysqli->real_escape_string(trim($_POST['user']));
    $email = $mysqli->real_escape_string(trim($_POST['email']));
    if ($_POST['pass1'] != $_POST['pass2']) {
        echo '<script>alert("两次输入密码不一致，请重新输入")</script>';
    } else {
        $p = password_hash(trim($_POST['pass1']), PASSWORD_DEFAULT);
    }
    $q = "INSERT INTO traveluser (UserName,Pass,Email) VALUES ('$user','$p','$email')";
    $r = @$mysqli->query($q);
    if ($mysqli->affected_rows == 1) {
        echo '<script>alert("注册成功！正在为您跳转登录界面");window.location.href= \'login.php\'</script>';
    } else {
        echo '<p>' . $mysqli->error . '<br><br>Query: ' . $q . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/register.css" rel="stylesheet" type="text/css">
</head>
<body>
<h3>Create a new account!</h3>
<form action="register.php" method="post">
    <p>
        Username<br>
        <input type="text" name="user" pattern="[a-zA-Z0-9_]+" required>
    </p>
    <p>
        E-mail<br>
        <input type="email" name="email" pattern="/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.([A-Za-z]{2,4})$/" required>
    </p>
    <p>
        Passward<br>
        <input type="password" name="pass1" pattern="[a-zA-Z0-9]" required>
    </p>
    <p>
        Confirm Your Password<br>
        <input type="password" name="pass2" pattern="[a-zA-Z0-9]" required>
    </p>
    <p>
        <input type='submit' value='Register'/>
    </p>
</form>
<div class="pictures"></div>
<footer>Privacy Policy丨
    Terms of use丨
    License Agreement丨
    Made with love by zjn No.19302010072
</footer>
</body>
</html>