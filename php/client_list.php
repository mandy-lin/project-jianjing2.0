<?php
include("mysql_connect.php");
    $name=@$_POST['c_name'];
    $address=@$_POST['c_address'];
    $number=@$_POST['re_number'];
if(isset($_POST['search']) ){
    if((isset($name))||(isset($address))||(isset($number))){
    $data=mysqli_query($con,"SELECT DISTINCT c.c_no, c.c_name,con.admin_name,con.admin_phone,con.admin_conn,con.ganshi_name,con.ganshi_phone,con.ganshi_conn,address_num,address FROM `client` c join client_connection con on(c.c_no=con.c_no) join product p on (c.c_no=p.c_no) join region r on (p.pro_no=r.pro_no) where c.c_name like '%$name%' and c.address like '%$address%' and r.re_number like '%$number%' and c.c_status='進行中'");
    }
}else{
    $data=mysqli_query($con,"SELECT DISTINCT c.c_no, c.c_name,con.admin_name,con.admin_phone,con.admin_conn,con.ganshi_name,con.ganshi_phone,con.ganshi_conn,address_num,address FROM `client` c  join client_connection con on(c.c_no=con.c_no) where c_status='進行中'"); 
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
              <h3 class='mt-4'><i class="far fa-address-book"></i>客戶列表</h3> 
    <form id="form1" name="form1" method="post" action="" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"> 
    <div class="input-group">    
    <input class="form-control" type="search" placeholder="請輸入大樓名稱" name="c_name">
    <input class="form-control" type="search" placeholder="請輸入大樓地址" name="c_address">    
    <input class="form-control" type="search" placeholder="請輸入服務編碼" name="re_number">    
    <div class="input-group-append">
         <button class="btn btn-primary" type="submit" name="search"><i class="fas fa-search"></i></button>
     </div>    
        </div></form></div>
              
 <div class="container-fluid">
 <?php
for($i=1;$i<=mysqli_num_rows($data);$i++){
$rs=mysqli_fetch_array($data);
?>    

          <div class="card mb-4">
               <div class="card-header"><i class="fas fa-user"></i><?php echo $rs['c_name'];?></div>
               <div class="card-body"><div id="myAreaChart" width="100%" height="50">管理室:<?php echo $rs['admin_name'].$rs['admin_phone'];?><br>
            <?php echo $rs['admin_conn'];?><br>
            總幹事:<?php echo $rs['ganshi_name'].$rs['ganshi_phone'];?><br>
            <?php echo $rs['ganshi_conn'];?><br>
            地址:<?php echo $rs['address_num'].$rs['address'];?><br></div></div>
               <div class="card-footer d-flex align-items-center justify-content-between">
                   <a class="small text-secondary stretched-link" href="client_detail.php?id=<?php echo $rs['c_no'];?>">查看詳細</a>
                     <div class="small text-secondary"><i class="fas fa-angle-right"></i></div>
          </div>
         </div>

     

<?php } ?>     
     
     
    
    
 </div></main></div></div>      
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="../js/scripts.js"></script>    
</body>    
</html>