<?php
include("mysql_connect.php");
$id=$_GET["id"];




if(isset($_POST['insert'])){
$zhu_name=@$_POST['zhu_name'];
$zhu_phone=@$_POST['zhu_phone'];    
$zhu_conn=@$_POST['zhu_conn'];    
$cai_name=@$_POST['cai_name'];    
$cai_phone=@$_POST['cai_phone'];    
$cai_conn=@$_POST['cai_conn'];
$jian_name=@$_POST['jian_name'];    
$jian_phone=@$_POST['jian_phone'];    
$jian_conn=@$_POST['jian_conn'];    
$ganshi_name=@$_POST['ganshi_name'];    
$ganshi_phone=@$_POST['ganshi_phone'];
$ganshi_conn=@$_POST['ganshi_conn'];    
$admin_name=@$_POST['admin_name'];    
$admin_phone=@$_POST['admin_phone'];    
$admin_conn=@$_POST['admin_conn'];
$co_date=@$_POST['co_date'];
    
$insert= mysqli_query($con,"INSERT INTO `client_connection` ( `zhu_name`, `zhu_phone`, `zhu_conn`, `cai_name`, `cai_phone`, `cai_conn`, `jian_name`, `jian_phone`, `jian_conn`, `ganshi_name`, `ganshi_phone`, `ganshi_conn`, `admin_name`, `admin_phone`, `admin_conn`, `co_date`, `c_no`) VALUES ('$zhu_name', '$zhu_phone', '$zhu_conn', '$cai_name', '$cai_phone', '$cai_conn', '$jian_name', '$jian_phone', '$jian_conn', '$ganshi_name', '$ganshi_phone', '$ganshi_conn', '$admin_name', '$admin_phone', '$admin_conn', '$co_date', '$id');");


if($insert ){
header('location:client_detail.php?id='.$id); 
}else{ echo 'data nono'.mysqli_error($con);}
}

?>

<html>
<head>
<link rel="icon" href="../img/jj.ico" type="image/x-icon" />
<title>健璟內部管理系統</title>
<!--link rel=stylesheet href=/project/css/home.css>
<link rel=stylesheet href=/project/css/table-client.css   
}-->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
<?php 
include("aside.php");
?>



<div>
<p><h2>新增歷年聯絡人</h2>

<form id="form2" name="form2" method="post" enctype="multipart/form-data" action="" >
<input name="co_date" type="number" min="2000" max="<?php echo date("Y");?>" step="1" value="<?php echo date("Y");?>" />年度    
<p>主委：<input name="zhu_name">電話：<input  name="zhu_phone" ><br>其他聯絡方式：<textarea  name="zhu_conn"></textarea></p>
<p>財委：<input name="cai_name" >電話：<input name="cai_phone"><br>其他聯絡方式：<textarea name="cai_conn"></textarea></p>
<p>監委：<input name="jian_name">電話：<input name="jian_phone"><br>其他聯絡方式：<textarea name="jian_conn"></textarea></p>
<p>總幹事：<input name="ganshi_name">電話：<input name="ganshi_phone"><br>其他聯絡方式：<textarea name="ganshi_conn"></textarea></p>
<p>管理員：<input name="admin_name" >電話：<input name="admin_phone"><br>其他聯絡方式：<textarea name="admin_conn"></textarea></p>
<input  type="submit" name='insert' value="新增" >    
</form>
  
</div>

</body>
</html>