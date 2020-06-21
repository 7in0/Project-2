<?php


function outputFavor(){



echo '<tr>
        <td><a href="details.html?' . $row['PATH'] . '"><img src="travel-images/medium/' . $row['PATH'] . '" width="200" height="200">' . '</a></td>
               <td><h3>' . $row['Title'] . '</h3>
                <p>' . $row['Description'] . '</p><button class="delete" type="button" onclick="alert(\'哈哈哈，点不动\')">Delete</button></a></td></tr>
               ';
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>favor</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/favor.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
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
                        <li><a href=""><i class="fa fa-sign-in"></i>Log In</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<span id="topic">My favourite</span>
<table class="display">
    <tr>
        <td><a href="details.html"> <div class="image" style=" background: url(./../images/normal/medium/222222.jpg) no-repeat center;"></div></a></td>
        <td><h3>Title</h3><p>Yellowstone National Park is the centerpiece of the Greater Yellowstone Ecosystem, the largest intact ecosystem in the Earth's northern temperate zone.The park is known for its wildlife and geothermal features; the Old Faithful Geyser is one of the most popular features in the park.</p>
            <button class="delete" type="button" onclick="alert('哈哈哈，点不动')">Delete</button></td>
    </tr>
    <tr>
        <td><div class="image" style=" background: url(../images/normal/medium/222222.jpg) no-repeat center;"></div></td>
        <td><h3>Title</h3><p>Yellowstone National Park is the centerpiece of the Greater Yellowstone Ecosystem, the largest intact ecosystem in the Earth's northern temperate zone.The park is known for its wildlife and geothermal features; the Old Faithful Geyser is one of the most popular features in the park.</p>
            <button class="delete" type="button" onclick="alert('哈哈哈，点不动')">Delete</button></td>
    </tr>
    <tr>
        <td><div class="image" style=" background: url(./../images/normal/medium/222222.jpg) no-repeat center;"></div></td>
        <td><h3>Title</h3><p>Yellowstone National Park is the centerpiece of the Greater Yellowstone Ecosystem, the largest intact ecosystem in the Earth's northern temperate zone.The park is known for its wildlife and geothermal features; the Old Faithful Geyser is one of the most popular features in the park.</p>
            <button class="delete" type="button" onclick="alert('哈哈哈，点不动')">Delete</button></td>
    </tr>
    <tr>
        <td><div class="image" style=" background: url(./../images/normal/medium/222222.jpg) no-repeat center;"></div></td>
        <td><h3>Title</h3><p>Yellowstone National Park is the centerpiece of the Greater Yellowstone Ecosystem, the largest intact ecosystem in the Earth's northern temperate zone.The park is known for its wildlife and geothermal features; the Old Faithful Geyser is one of the most popular features in the park.</p>
            <button class="delete" type="button" onclick="alert('哈哈哈，点不动')">Delete</button></td>
    </tr>
</table>
<div id="page" onclick="alert('Go！')">
    <span><<</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>>></span>
</div>

<footer>Privacy Policy丨
    Terms of use丨
    License Agreement丨
    Made with love by zjn No.19302010072
</footer>
</body>
</html>