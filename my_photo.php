<?php
function outputMyphoto()
{
    require_once("mysqli_oop_connect.php");
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    $username = $_COOKIE['Username'];
    if (mysqli_connect_errno()) {
        die(mysqli_connect_error());
    }

//
    $sql = "SELECT * FROM travelimage NATURAL JOIN traveluser WHERE UserName = '$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) echo '您还未上传任何图片！';
    while ($row) {
        echo '<tr>
        <td><a href="details.php?id=' . $row['ImageID'] . '"><img src="travel-images/medium/' . $row['PATH'] . '" width="300" height="200">' . '</a></td>
               <td><h3>' . $row['Title'] . '</h3>
                <p>' . $row['Description'] . '</p></a></td></tr>
                <button class="modify" type="button" )">Modify</button>
            <button class="delete" type="button" >Delete</button></td>
    </tr>';
    }
}
?><

!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/myPhoto.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <title>My Photo</title>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img alt="Brand" src="../images/icon/叶子2.png" width="40px" height="30px"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="browser.html">Browse</a></li>
                <li><a href="search.php">Search</a></li>
            </ul>
            <ul class="nav navbar-nav nav-pills navbar-right">
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">My account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="upload.php"><i class="fa fa-upload"></i>Upload</a></li>
                        <li><a href="my_photo.php"><i class="fa fa-photo"></i>My Photo</a></li>
                        <li><a href="favor.html"><i class="fa fa-heart"></i>My Favorite</a></li>
                        <li><a href="login.html"><i class="fa fa-sign-in"></i>Log In</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<span id="topic">My photo</span>
<table class="display">
    <?php outputMyphoto()?>
</table>
<div id="page" onclick="alert('Go！')">
    <span><<</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>>></span>
</div>
<footer>Privacy Policy丨
    Terms of use丨
    License Agreement丨
    Made with love by zjn 19302010072
</footer>
</body>
</html>