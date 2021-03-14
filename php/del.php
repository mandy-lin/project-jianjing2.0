<?php
include("mysql_connect.php");
$id=$_GET["id"];
$query1=mysqli_query($con,"DELETE FROM `worker` WHERE w_id=$id");

header( "location:worker.php");  //回index.php
?>