<?php
$con = mysqli_connect('localhost', 'root', '','test');
mysqli_query($con,"set names utf8");
if (!$con) {
　die(' 連線失敗，輸出錯誤訊息 : ' . mysqli_error());
}
//echo ' 連線成功 ';

mysqli_close($con);

?>