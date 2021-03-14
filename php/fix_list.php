<?php
include("mysql_connect.php");

$data=mysqli_query($con,"SELECT f.f_no,f_date,f_device,c.c_name FROM `fix` f join client c on(f.c_no=c.c_no) ORDER BY `f_date` DESC");
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
               <h3 class='mt-4'><i class="fas fa-hammer"></i>維修列表</h3>      

                   

    
    <div class="card mb-4">
         <div class="card-header"></div>
              <div class="card-body">
                             
    <table  id="dataTable" class="table table-bordered">
        <thead>
            <th>維修日期</th>
            <th>大樓名稱</th>
            <th>設備名稱</th>
            <th>詳細</th>        
        </thead>
<?php
for($i=1;$i<=mysqli_num_rows($data);$i++){
$rs=mysqli_fetch_array($data);
?>  
        <tr>
            <td><?php echo $rs['f_date'];?></td>
            <td><?php echo $rs['c_name'];?></td>
            <td><?php echo $rs['f_device'];?></td>
            <td><input type="button" value="詳細" onclick="location.href='fix_detail.php?id=<?php echo $rs['f_no'];?>'"></td>
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