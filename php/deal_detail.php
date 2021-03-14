<?php
$c_no = $_POST['c_no'];
$pro_kind = $_POST['pro_kind'];
include("mysql_connect.php");
$sql=mysqli_query($con,"SELECT * FROM `client` c JOIN product p on(c.c_no=p.c_no) JOIN region r on(p.pro_no=r.pro_no) WHERE c.c_no = '$c_no' and p.pro_kind = '$pro_kind' ");
$res = "";
while($data = mysqli_fetch_array($sql))
{
   $res .= "
      <option value='{$data["re_number"]}'>{$data['re_number']}</option>
   ";//將對應的型號項目遞迴列出
};
echo $res;
?>