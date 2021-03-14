<?php
$c_no = $_POST['c_no'];
include("mysql_connect.php");
$sql=mysqli_query($con,"SELECT * FROM `client` c JOIN product p on(c.c_no=p.c_no) WHERE c.c_no = '$c_no'");
$res = "";
$res .= "<option value=''>選擇產品</option>";
while($data = mysqli_fetch_array($sql))
{
   
    $res .= "
      <option value='{$data["pro_kind"]}'>{$data['pro_kind']}</option>
   ";//將對應的型號項目遞迴列出
};
echo $res;
?>