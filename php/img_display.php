<?php
    
    //從資料庫取得圖片
    
include("mysql_connect.php");
$id=$_GET["name"];
//$sql=mysqli_query($con,"select con_img from contract where con_no = $id");   
//while($rs=mysqli_fetch_array($sql)){
//header("Content-type: image/jpeg"); 
//echo "<img src='C:/xampp/htdocs/1/img/".$rs["con_img"]."'>";
echo "<img src='../img/".$id."'>";

//echo $rs["c_localimg"];

//$data=mysql_fetch_array($sql);
    //顯示圖片
//header("Content-type: image/jpeg"); 

//$base64_string= explode(',', $sql);
//截取data:image/png;base64, 这个逗号后的字符
//$data=base64_decode($base64_string[1]);
//对截取后的字符使用base64_decode进行解码
//echo base64_decode($rs['c_localimg']);
//echo $data;   


?>