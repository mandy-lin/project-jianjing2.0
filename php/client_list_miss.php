<?php
include("mysql_connect.php");
if(isset($_POST['search'])){
  $name=$_POST['c_name'];
  $data=mysqli_query($con,"SELECT * FROM `client` c where c_name like '%$name%' and c.c_status='已流失'");
  }else{
    $data=mysqli_query($con,"SELECT * FROM `client` where c_status='已流失'");
  }
if(isset($_POST['renew'])){
  $id= $_POST['c_no']; 
  $query1=mysqli_query($con,"UPDATE `client` SET `c_status`='進行中' WHERE `c_no`=$id");
echo "<script type=text/javascript>alert('將重新建立合約'); location.href='contract_add.php'</script>";
}
?>
<html>
<head>
<title>健璟內部管理系統</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<meta charset="utf-8">
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
 
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">健璟實業</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button></nav>
<div id="layoutSidenav">
            <div id="layoutSidenav_nav">    
            <?php include("aside.php");?> 
            </div>
<div id="layoutSidenav_content">
    <main>
          <div class="container-fluid">
              <h3 class='mt-4'><i class="fas fa-user-alt-slash"></i>流失客戶列表</h3>          
 <div class="card mb-4">
         <div class="card-header"></div>
              <div class="card-body">              
    <table id="dataTable" class="table table-bordered">
        <thead>
            <th>大樓名稱</th>
            <th>地址</th>
            <th>主委</th>
            <th>電話</th>
            <th>詳細</th>        
        </thead>    
<?php
while($rs=mysqli_fetch_array($data)){
?>
   <tr>
        <td><?php echo $rs['c_name'];?></td>
        <td><?php echo $rs['address'];?></td>
        <td><?php echo $rs['zhu_name'];?></td>
        <td><?php echo $rs['zhu_phone'];?></td>
        <td><input type="button" value="詳細" onclick="location.href='client_miss_detail.php?id=<?php echo $rs['c_no'];?>'">
        <form  name="form2" method="post"><input type="submit" name="renew" value="重新建立合約"><input name='c_no' style="display:none;" value="<?php echo $rs['c_no'];?>"></form>    
        </td>
    </tr>
<?php } ?>
        </table></div></div>
    </div></main></div></div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="../js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>    
<script src="assets/demo/datatables-demo.js"></script>     
</body>    
</html>