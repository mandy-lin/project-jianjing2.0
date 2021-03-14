<?php
include("mysql_connect.php");

$data=mysqli_query($con,"SELECT c_name,con_device,start_date,end_date,con.con_no,duty FROM `contract` con join client c on(con.c_no=c.c_no) join contract_content content on(con.con_no=content.con_no) ORDER BY `end_date`"); 
?>
<html>
<head>
<title>健璟內部管理系統</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!--link rel=stylesheet href=/1/css/aside.css-->
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
              <h3 class='mt-4'><i class="fas fa-file-contract"></i>合約列表</h3>      
              
    <!--form id="form1" name="form1" method="post" action=""> 
    <input placeholder="請輸入大樓名稱" name="c_name"/>
    <input type="month" name="end_date">
    <select name="select">
        <option value=''>全部</option>
        <option value='進行中'>進行中</option>
        <option value='已結束'>已結束</option>
    </select>    
    <input type="submit" name="submit" value="搜尋">
    </form-->
     <div class="card mb-4">
         <div class="card-header"></div>
              <div class="card-body">
                            
    <table  id="dataTable" class="table table-bordered">
    <!--caption>合約列表</caption-->
        <thead>
            <th>大樓名稱</th>
            <th>設備名稱</th>
            <th>起始日</th>
            <th>到期日</th>
            <th>責任</th>
            <th>詳細</th>        
        </thead>
<?php
for($i=1;$i<=mysqli_num_rows($data);$i++){
$rs=mysqli_fetch_array($data);
?>         
        <tr>
            <td><?php echo $rs['c_name'];?></td>
            <td><?php echo $rs['con_device'];?></td>
            <td><?php echo $rs['start_date'];?></td>
            <td><?php echo $rs['end_date'];?></td>
            <td><?php echo $rs['duty'];?></td>
            <td><input type="button" value="詳細" onclick="location.href='contract_detail.php?id=<?php echo $rs['con_no'];?>'"></td>
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