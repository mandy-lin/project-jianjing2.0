<?php
include("mysql_connect.php");
$time=date('Y-m');

$data=mysqli_query($con,"SELECT m.m_no,m_date,m_device,c_name,m_status,m_month FROM `maintain` m join client c on(m.c_no=c.c_no) and m_month<='$time' ORDER BY `m_month` DESC"); 
$data1=mysqli_query($con,"SELECT m.m_no,m_date,m_device,c_name,m_status,m_month FROM `maintain` m join client c on(m.c_no=c.c_no) and m_month<='$time' ORDER BY `m_month` DESC"); 
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
              <h3 class='mt-4'><i class="far fa-calendar-check"></i>保養列表</h3>
    <!--form id="form1" name="form1" method="post" action="" class='card-header'> 
    <input type="search" name="c_name" placeholder="請輸入大樓名稱">
    <input type=month name="m_month">
    <select name="status">
        <option value=''>全部</option>
        <option value='已填單'>已填單</option>
        <option value='未填單'>未填單</option>
    </select>     
    <input  type="submit" name="serch" value="搜尋" >
    </form-->


              
    <div class="card mb-4">
         <div class="card-header"><marquee behavior="behavior" width="1000" loop="5" style="color:red;">
<?php
for($i=1;$i<=mysqli_num_rows($data1);$i++){
$rs=mysqli_fetch_array($data1);
    if ($rs['m_status']=='未填單'){
                //echo '未填單';
                echo $rs['c_name'].' ';
    }
}
?>未填單</marquee></div>
              <div class="card-body">      
    <table  id="dataTable" class="table table-bordered">
    <!--caption>保養列表</caption-->
        <thead>
            <th>保養日期</th>
            <th>大樓名稱</th>
            <th>設備名稱</th>
            <th>詳細</th>        
        </thead>
<?php
for($i=1;$i<=mysqli_num_rows($data);$i++){
$rs=mysqli_fetch_array($data);
?>          
        <tr>
            <td><?php
            if ($rs['m_status']=='未填單'){
                //echo '未填單';
                echo $rs['m_month'];
            }else{
                //echo '已填單';
                echo $rs['m_date'];
            }
            ?></td>
            <td><?php echo $rs['c_name'];?></td>
            <td><?php echo $rs['m_device'];?></td>
            <td>
            <?php
            if ($rs['m_status']=='未填單'){
                echo '未填單';
                echo '<input  type="button"  value="詳細 " onclick=location.href="maintain_add.php?id='. $rs['m_no'] . '">';
            }else{
                echo '已填單';
                echo '<input  type="button"  value="詳細 " onclick=location.href="maintain_detail.php?id='. $rs['m_no'] . '">';
            }
            ?>
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