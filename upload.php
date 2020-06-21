<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload</title>
    <script src="js/jquery.js"></script>
    <script src="js/upload.js"></script>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/upload.css" rel="stylesheet" type="text/css">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require_once("mysqli_oop_connect.php");
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$a=$_COOKIE['Username'];
    // Check for an uploaded file:
    if (isset($_FILES['upload'])) {
        $s = "select UID from traveluser WHERE UserName=$a";
        $result = mysqli_query($connection, $s);
        $UID=$result->fetch_array();
        $sql = "INSERT into travelimage(Title,Description,CityCode,UID,Content)VALUES($UID)";
        $r = @$mysqli->query($sql);
    } // End of isset($_FILES['upload']) IF.

    // Check for an error:
    if ($_FILES['upload']['error'] > 0) {
        echo '<p class="error">The file could not be uploaded because: <strong>';

        print '</strong></p>';

        if (file_exists($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
            unlink($_FILES['upload']['tmp_name']);
        }

    }
}// End of the submitted conditional.
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img alt="Brand" src="../images/icon/叶子2.png" width="40px"
                                                  height="30px"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="browser.php">Browse</a></li>
                <li><a href="search.php">Search</a></li>
            </ul>
            <ul class="nav navbar-nav nav-pills navbar-right">
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="true">My account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="upload.php"><i class="fa fa-upload"></i>Upload</a></li>
                        <li><a href="my_photo.php"><i class="fa fa-photo"></i>My Photo</a></li>
                        <li><a href="favor.php"><i class="fa fa-heart"></i>My Favorite</a></li>
                        <li><a href="logout.html"><i class="fa fa-sign-in"></i>Log In</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php
//if (!isset($_COOKIE['Username'])) {
//    echo "<h2 style='color: white'>您还没有登录，无法上传图片。请先进行登录。</h2>";
//} else {
//    echo "<li onclick=\"window.open('php/logout.php');window.close()\"><a href=\"index.php\"><i class=\"fa fa-sign-in\"></i>Log Out</a></li>";
//}
//?>
<div>
    <span id="topic">Upload</span>
    <fieldset id="preview">
    </fieldset>
    <div class="center">
        <input type="file" name="upload" id="upload"><br>
        <table>
            <tr>
                <td>title：</td>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <td>description：</td>
                <td><input type="text" name="description"></td>
            </tr>
            <tr>
                <td>country：</td>
                <td><input type="text" name="country"></td>
            </tr>
            <tr>
                <td>city：</td>
                <td><input type="text" name="city"></td>
            </tr>
        </table>
        <div class="refresh" >
            <a href="my_photo.php">
                <input type='submit' value='Upload'/>
            </a>
        </div>
    </div>
</div>

<footer>Privacy Policy丨
    Terms of use丨
    License Agreement丨
    Made with love by zjn 19302010072
</footer>
</body>
</html>