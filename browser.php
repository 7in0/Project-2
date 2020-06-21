<?php
require_once("mysqli_oop_connect.php");
function outputContent()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT Content, COUNT(Content) AS contentnum FROM travelimage GROUP BY Content ORDER BY contentnum DESC LIMIT 0,4";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo '<li><a href="browser.php?category=content&content=' . $row['Content'] . '">' . $row['Content'] . '</a></li>';
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function outputCountries()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT Country_RegionName,ISO,COUNT(travelimage.Country_RegionCodeISO) AS countrynum FROM geocountries_regions LEFT JOIN travelimage ON travelimage.Country_RegionCodeISO =geocountries_regions.ISO GROUP BY ISO ORDER BY countrynum DESC LIMIT 0,4';
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo '<li><a href="browser.php?category=country&iso=' . $row['ISO'] . '">' . $row['Country_RegionName'] . '</a></li>';
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function outputCities()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT AsciiName,GeoNameID,COUNT(travelimage.CityCode) AS citynum FROM geocities  LEFT JOIN travelimage ON travelimage.CityCode =geocities.GeoNameID GROUP BY GeoNameID ORDER BY citynum DESC LIMIT 0,4";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo '<li><a href="browser.php?category=city&geoNameID=' . $row['GeoNameID'] . '">' . $row['AsciiName'] . '</a></li>';
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function outputFilterResult()
{
    $content=$_GET['content'];
    $category = $_GET['category'];
    $iso = $_GET['iso'];
    $citycode = $_GET['geoNameID'];
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);


    if (isset($_GET['page']))
        $currentPage = $_GET['page'];
    else
        $currentPage = 1;

    if ($category == 'content') {
        $amount = "select ImageID,PATH from travelimage WHERE Content = '$content'";
    } elseif ($category == 'country') {
        $amount = "select ImageID,PATH from travelimage WHERE Country_RegionCodeISO = '$iso'";
    } elseif ($category == 'city') {
        $amount = "select ImageID,PATH from travelimage WHERE cityCode =  ' $citycode'";
//    } elseif ($category == 'Filter') {
//        $sql = 'select ImageID,PATH from travelimage WHERE Title like "%' . $mark . '%" LIMIT ' . $mark . ',16';
    } else {
        $amount = 'select ImageID,PATH from travelimage ORDER BY rand() LIMIT 16';
    }

    //总共数量
    $result = mysqli_query($connection, $amount);
    if ($result)
        $totalCount = $result->num_rows;
    else
        $totalCount = 0;

    if ($totalCount == 0)
        echo "没有相关图片！";
    else if ($totalCount >= 90) {
        $pageSize = 16;
        $totalPage = 5;
    } else {
        $pageSize = 16;
        $totalPage = (int)(($totalCount % $pageSize == 0) ? ($totalCount / $pageSize) : ($totalCount / $pageSize + 1));
    }

    $mark = ($currentPage - 1) * 16;

    if (mysqli_connect_errno()) {
        die(mysqli_connect_error());
    }
    if ($category == 'content') {
        $sql = "select ImageID,PATH from travelimage WHERE Content = '$content'LIMIT  $mark ,16";
    } elseif ($category == 'country') {
        $sql = "select ImageID,PATH from travelimage WHERE Country_RegionCodeISO =  '$iso' LIMIT  $mark ,16";
    } elseif ($category == 'city') {
        $sql = "select ImageID,PATH from travelimage WHERE cityCode =  '$citycode' LIMIT $mark ,16";
    } elseif ($category == 'Filter') {
        $sql = "select ImageID,PATH from travelimage WHERE Title like "%' . $mark . '%" LIMIT ' . $mark . ',16'";
    } else {
        $sql = 'select ImageID,PATH from travelimage ORDER BY rand() LIMIT 16';
    }

    $result = mysqli_query($connection, $sql);

    //打印图片
    for ($j = 0; $j < $pageSize; $j++) {
        $row = mysqli_fetch_assoc($result);
        if(!$row) break;
        echo '<img class="col-lg-3" src="travel-images/square-medium/' . $row['PATH'] . '">';
    }

    //打印页码
    if($category == 'content') {
    echo '<table id="page">
    <a href="browser.php?category=content&content=' . $content .'&page=1"><<</a>';
    for($i=1;$i<$totalPage+1;$i++){
        echo '<a href="browser.php?category=content&content=' . $content .'&page='.$i.'">'.$i.'</a>';
    }
    echo '<a href="browser.php?category=content&content=' . $content .'&page='.$totalPage.'">>></a></table>';
}  else if($category == 'country') {
    echo '<table id="page">
    <a href="browser.php?category=country&iso=' . $iso .'&page=1"><<</a>';
    for($i=1;$i<$totalPage+1;$i++){
        echo '<a href="browser.php?category=country&iso=' . $iso .'&page='.$i.'">'.$i.'</a>';
    }
    echo '<a href="browser.php?category=country&iso=' . $iso .'&page='.$totalPage.'">>></a></table>';
}else if($category == 'city') {
        echo '<table id="page">
    <a href="browser.php?category=city&geoNameID=' . $citycode .'&page=1"><<</a>';
        for($i=1;$i<$totalPage+1;$i++){
            echo '<a href="browser.php?category=city&geoNameID=' . $citycode .'&page='.$i.'">'.$i.'</a>';
        }
        echo '<a href="browser.php?category=city&geoNameID=' . $citycode .'&page='.$totalPage.'">>></a></table>';
    }


} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browser</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/browse.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
    <script src="js/browser.js"></script>
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
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="browser.html">Browse<span class="sr-only">(current)</span></a></li>
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
                        <li><a href="login.php"><i class="fa fa-sign-in"></i>Log In</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="page-sidebar col-lg-3" style="color: white">
        <ul>
            <li><h3><a>Search by Title</a></h3></li>
            <li><a><input type="search" name="searchByTitle" width="20">  <input type="submit" name="search" value="Go"></a></li>
        </ul>
        <ul>
            <li><h3>Hot Country</h3></li>
            <?php outputCountries() ?>

        </ul>
        <ul>
            <li><h3>Hot City</h3></li>
            <?php outputCities(); ?>
        </ul>
        <ul>
            <li><h3>Hot Content</h3></li>
            <?php outputContent() ?>
        </ul>
    </div>
    <div class="col-lg-9">
        <div>
            <select id="content"">
            <option value="0">Filter by Content</option>
            <option>Scenery</option>
            <option>People</option>
            <option>Wonder</option>
            </select>
            <select id="country">
                <option value="0">Filter by Country</option>
                <option value="China">China</option>
                <option value="Japan">Japan</option>
                <option value="Italy">Italy</option>
                <option value="America">America</option>
            </select>
            <select id="city">Filter by City
                <option value="0">Filter by City</option>
            </select>
            <input type="submit" name="filter" value="FILTER">
        </div>
        <?php $url = $_SERVER['REQUEST_URI'];
        $array = parse_url($url);
        if (isset($array['query'])) {
            outputFilterResult();
        } ?>

    </div>
</div>

<footer>Privacy Policy丨
    Terms of use丨
    License Agreement丨
    Made with love by ZJN 19302010072
</footer>
<?php
//mysqli_free_result($result);
//mysqli_close($connection);
//?>
</body>
</html>