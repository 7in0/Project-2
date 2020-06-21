<?php
require_once("mysqli_oop_connect.php");
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}
$id = $_GET['id'];
$sql = "SELECT * from travelimage NATURAL JOIN traveluser JOIN geocountries_regions ON geocountries_regions.ISO= travelimage.Country_RegionCodeISO JOIN geocities ON geocities.GeoNameID=travelimage.CityCode WHERE travelimage.ImageId ='$id'";
$sqlFavor = "SELECT COUNT(*) AS favornum FROM travelimagefavor WHERE ImageID = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

$resultFavor = mysqli_query($connection, $sqlFavor);
$favornum = mysqli_fetch_assoc($resultFavor);


function likeOrnot()
{
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    $username = $_COOKIE['Username'];
    $id = $_GET['id'];
    if (mysqli_connect_errno()) {
        die(mysqli_connect_error());
    }
    $sql = "SELECT * FROM travelimagefavor NATURAL JOIN traveluser WHERE traveluser.UserName = '$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    //判定是否已经收藏
    if (!$row['ImageID']) {
        echo '<a href="like.php"><button>like</button>';
        return;
    }
    else if (in_array($id, $row)) {
        echo '<a href="dislike.php"><button>Dislike</button>';
    } else {
        echo '<a href="like.php"><button>like</button>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>details</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/details.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
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
                <li><a href="index.php">Home </a></li>
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
                        <li><a href=""><i class="fa fa-sign-in"></i>Log In</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<span id="topic"><?php echo $row['Title']; ?></span>
<div class="details">

    <table class="details">
        <tr>
            <td rowspan="6" width="70%"><?php echo '
        <img src="travel-images/large/' . $row['PATH'] . '" width="750" height="450">'; ?></td>
        <tr height="30%">
            <td class="like">Like Number:<br><?php echo $favornum['favornum']; ?></td>
            <td><?php likeOrnot() ?></td>
        </tr>

        <tr>
            <td colspan="2">ImageDetails</td>
        </tr>

        <tr>
            <td>Content:</td>
            <td><?php echo $row['Content']; ?></td>
        </tr>
        <tr>
            <td>Country:</td>
            <td><?php echo $row['Country_RegionName']; ?></td>
        </tr>
        <tr>
            <td>City:</td>
            <td><?php echo $row['AsciiName']; ?></td>
        </tr>
    </table>
</div>
<div class="description"><?php echo $row['Description']; ?></p></div>

<footer>Privacy Policy丨
    Terms of use丨
    License Agreement丨
    Made with love by zjn No.19302010072
</footer>
</body>
</html>