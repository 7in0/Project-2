<?php
require_once('mysqli_oop_connect.php');

function displayResult()
{
    $title = $_POST['title'];
    $description = $_POST['description'];

    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

    //输入判定
    if ($title == '' && $description == '') {
        echo '<script>alert("请输入信息！")</script>';
        return;
    }

    if (isset($_GET['page']))
        $currentPage = $_GET['page'];
    else
        $currentPage = 1;


    if ($_POST['filter'] == "title") {
        $sql = "select ImageID,Title, Description,PATH from travelimage WHERE Title like '%" . $title . "%'";
    }
    if ($_POST['filter'] == "description") {
        $sql = "select ImageID,Title, Description,PATH from travelimage WHERE Title like '%" . $description . "%'";
    }
    $result = mysqli_query($connection, $sql);
    if ($result)
        $totalCount = $result->num_rows;
    else
        $totalCount = 0;

    if ($totalCount == 0)
        echo "没有相关图片！";
    else if ($totalCount >= 30) {
        $pageSize = 6;
        $totalPage = 5;
    } else {
        $pageSize = 6;
        $totalPage = (int)(($totalCount % $pageSize == 0) ? ($totalCount / $pageSize) : ($totalCount / $pageSize + 1));
    }
    $mark = ($currentPage - 1) * $pageSize;

    if ($_POST['filter'] == "title") {
        $sql = "select ImageID,Title, Description,PATH from travelimage WHERE Title like '%" . $title . "%'LIMIT" . $mark . ",6 ";
    }
    if ($_POST['filter'] == "description") {
        $sql = "select ImageID,Title, Description,PATH from travelimage WHERE Title like '%" . $description . "%'LIMIT" . $mark . ",6 ";
    }

    //输出结果
    echo ' <tr>
        <td colspan="2" id="result">Result</td>
    </tr>';

    for ($j = 0; $j < $pageSize; $j++) {
        $row = mysqli_fetch_assoc($result);
        if (!$row) break;
        echo '<tr>
        <td><a href="details.php?id=' . $row['ImageID'] . '"><img src="travel-images/medium/' . $row['PATH'] . '" width="300" height="200">' . '</a></td>
               <td><h3>' . $row['Title'] . '</h3>
                <p>' . $row['Description'] . '</p></a></td></tr>
               ';
    }

//打印页码
    echo '<div id="page">
    <a href="search.php?page=1; ?>"><<</a>';
    for ($i = 1; $i < $totalPage + 1; $i++) {
        echo '<a href="search.php?page=' . $i . '">' . $i . '</a>';
    }
    echo '<a href="search.php?page='.$totalPage.'">>></a></div>';

}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>search</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/search.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style>
        input{behavior:url(#default#savehistory);}

    </style>
    <meta name="save" content="history">
</head>
<body>

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
                <li><a href="browser.html">Browse</a></li>
                <li><a href="search.php">Search</a></li>
            </ul>
            <?php
            if (isset($_COOKIE['Username'])) {
                echo '<ul class="nav navbar-nav nav-pills navbar-right">
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="true">My account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="upload.php"><i class="fa fa-upload"></i>Upload</a></li>
                        <li><a href="my_photo.php"><i class="fa fa-photo"></i>My Photo</a></li>
                        <li><a href="favor.php"><i class="fa fa-heart"></i>My Favorite</a></li>
                        <li><a href="logout.php"><i class="fa fa-sign-in"></i>Log Out</a></li></ul></li></ul>';
            } else {
                echo '<ul class="nav navbar-nav nav-pills navbar-right">
        <li><a href="login.html">Log In</a></li></ul>';
            }
            ?>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div id="text">
    <span id="topic">Search</span>
    <form action="search.php" method="post" role="form">
        <label>
            <input type="radio" name="filter" value="title" style="width: 25px;">
            <input type="search" name="title" placeholder="Filter by Title">
        </label><br>
        <label><br>
            <input type="radio" name="filter" value="description" style="width: 25px;">
            <input type="text" name="description" placeholder="Filter by Description">
        </label><br><br>
        <input type="submit" name="go" value="Filter">
    </form>
</div>
<table class="display">

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        displayResult();}
     ?>
</table>

<footer>Privacy Policy丨
    Terms of use丨
    License Agreement丨
    Made with love by zjn No.19302010072
</footer>
</body>
</html>