<?php
include("mysql_connect.php");

$data=mysqli_query($con,"SELECT c_name,p.p_no,p_num,p_date,p_status FROM `price` p join client c on(c.c_no=p.c_no) ORDER BY `p_date` DESC");
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
              <h3 class='mt-4'><i class="fas fa-calculator"></i>報價列表</h3>
    <!--form id="form1" name="form1" method="post" action="" class='card-header'> 
    <input name="c_name" type="search" placeholder="請輸入大樓名稱" class="card-search"/>
    <input name="p_no" type="search" placeholder="請輸入報價單編號" class="card-search"/>
    <select name="status">
        <option value=''>全部</option>
        <option value='未送出'>未送出</option>
        <option value='已送出'>已送出</option>
        <option value='已簽回'>已簽回</option>
    </select>     
    <input id="search" name="search" type="submit" value="搜尋" class='card-btn'>
    </form-->

     
 <div class="card mb-4">
         <div class="card-header"></div>
              <div class="card-body">
                            
    <table  id="dataTable" class="table table-bordered">
    <!--caption>報價單</caption-->
        <thead>
            <th >報價單編號</th>
            <th>大樓名稱</th>
            <th>報價日期</th>
            <th>未送出</th>
            <th>已送出</th>
            <th>已簽回</th>
            <th>詳細</th>        
        </thead>
<?php
for($i=1;$i<=mysqli_num_rows($data);$i++){
$rs=mysqli_fetch_array($data);
?>          
        <tr>
            <td><?php echo $rs['p_num'];?></td>
            <td><?php echo $rs['c_name'];?></td>
            <td><?php echo $rs['p_date'];?></td>
            <td><?php echo $rs['p_status']=='未送出'?'V'.'<p style="display:none;">未送出</p>':'';?></td>
            <td><?php echo $rs['p_status']=='已送出'?'V'.'<p style="display:none;">已送出</p>':'';?></td>
            <td><?php echo $rs['p_status']=='已簽回'?'V'.'<p style="display:none;">已簽回</p>':'';?></td>
            <td><input type="button" value="詳細" onclick="location.href='price_detail.php?id=<?php echo $rs['p_no'];?>'"></td>
        </tr>
<?php }?>        
    </table></div></div>
    </div></main></div></div>    
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="../js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>    
<script src="assets/demo/datatables-demo.js"></script>    
</body>    
</html>