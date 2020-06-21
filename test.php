<?php
require_once ("mysqli_oop_connect.php");
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$sql = "select ImageID,PATH from travelimage WHERE Content = 'scenery'";
$result = mysqli_query($connection, $sql);

