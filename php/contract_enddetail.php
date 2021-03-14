<?php
include("mysql_connect.php");
$id=$_GET["id"];
$query1=mysqli_query($con,"UPDATE `client` SET `c_status`='已流失' WHERE `c_no`=$id");

header( "location:client_list_miss.php");  //回index.php
?>
