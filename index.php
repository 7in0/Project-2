<?php
require_once('mysqli_oop_connect.php');
function outputHomephoto()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT ImageID,PATH, COUNT(travelimagefavor.ImageID) AS favor FROM travelimage LEFT JOIN travelimagefavor ON travelimage.ImageID =travelimagefavor.ImageID GROUP BY travelimage.ImageID ORDER BY favor DESC LIMIT 0,1";
        $mysqli = $pdo->query($sql);
        while ($row = $mysqli->fetch()) {
            echo '<a href="details.html?id=' . $row['ImageID'] . '"><img src="travel-images/large/' . $row['PATH'] . '">';
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


function outputSixphotos()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "SELECT Title, Description,PATH,travelimage.ImageID, COUNT(travelimagefavor.ImageID) AS favor FROM travelimage LEFT JOIN travelimagefavor ON travelimage.ImageID =travelimagefavor.ImageID GROUP BY travelimage.ImageID ORDER BY favor DESC LIMIT 0,3";
    $result1 = $pdo->query($sql1);
    echo '<tr>';
    while ($row = $result1->fetch()) {
        echo '
        <td><a href="details.html?id=' . $row['ImageID'] . '"><img src="travel-images/square-medium/' . $row['PATH'] . '" width="200" height="200">' . '
                <h3>' . $row['Title'] . '</h3>
                <p>' . $row['Description'] . '</p></a></td>
                <td width="10%"></td>';
    }
    echo '</tr><tr>';
    $sql2 = "SELECT Title, Description,PATH,travelimage.ImageID, COUNT(travelimagefavor.ImageID) AS favor FROM travelimage LEFT JOIN travelimagefavor ON travelimage.ImageID =travelimagefavor.ImageID GROUP BY travelimage.ImageID ORDER BY favor DESC LIMIT 3,3";
    $result2 = $pdo->query($sql2);
    while ($row = $result2->fetch()) {
        echo '
        <td><a href="details.html?id=' . $row['ImageID'] . '"><img src="travel-images/square-medium/' . $row['PATH'] . '" width="200" height="200">' . '
                <h3>' . $row['Title'] . '</h3>
                <p>' . $row['Description'] . '</p></a></td>
                <td width="10%"></td>';
    }
    echo '</tr>';
}

function randomPhotos()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "SELECT * FROM travelimage ORDER BY rand() limit 3";
    $result1 = $pdo->query($sql1);
    echo '<tr>';
    while ($row = $result1->fetch()) {
        echo '
        <td><a href="details.html?' . $row['PATH'] . '"><img src="travel-images/square-medium/' . $row['PATH'] . '" width="200" height="200">' . '
                <h3>' . $row['Title'] . '</h3>
                <p>' . $row['Description'] . '</p></a></td>
                <td width="10%"></td>';
    }
    echo '</tr><tr>';
    $sql2 = "SELECT * FROM travelimage ORDER BY rand() limit 3";
    $result2 = $pdo->query($sql2);
    while ($row = $result2->fetch()) {
        echo '
        <td><a href="details.html?' . $row['PATH'] . '"><img src="travel-images/square-medium/' . $row['PATH'] . '" width="200" height="200">' . '
                <h3>' . $row['Title'] . '</h3>
                <p>' . $row['Description'] . '</p></a></td>
                <td width="10%"></td>';
    }
    echo '</tr>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>home</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/home.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</head>
<body>
<a name="top"></a>

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


<div class="icon">
    <a href="index.php?if=1"> <img src="../images/icon/刷新.png" width="45"><br></a>
    <a href="#top"><img src="../images/icon/置顶.png" class="top" width="40"></a>
</div>

<div class="homepage">
    <a href="details.php">
        <?php
        outputHomephoto();
        ?>
    </a>
</div>


<table class="pictures">
    <?php
    $url = $_SERVER['REQUEST_URI'];
    $array = parse_url($url);
    if (isset($array['query'])) {
        outputSixphotos();
    }else{randomPhotos();}
    ?>
</table>


<footer><p>© 2020-2520 Thanks for watching!<br>
        Privacy Policy<br>
        Terms of use<br></p>
    <p>About this website：<br>Sharing beautiful pictures all over the world.Scenery, people, cities,
        wonder......We need your contribution!</p>
    <p>If you have any questions,please contact: <br><strong>875628109@qq.com</strong><br>Made with love by zjn</p>

</footer>
</body>