<?php
include("mysql_connect.php");
$cno=@$_GET["cno"];
$id=@$_GET["id"];
$re_no=@$_GET["no"];

if(isset($_POST['save'])){
$new_com_name=@$_POST['new_com_name'];
$new_com_size=@$_POST['new_com_size'];
$com_name=@$_POST['com_name'];
$com_size=@$_POST['com_size'];
$com_no=@$_POST['com_no'];

//新增零件
if (isset($new_com_name)){
 for ($i=0;$i<count($new_com_name); $i++){
$query1=mysqli_query($con,"INSERT INTO `region_components`( `com_name`, `com_size`, `re_no`) VALUES ('$new_com_name[$i]','$new_com_size[$i]','$re_no')");
}
}
//更新零件
if (isset($com_name)){
for ($i=0;$i<count($com_name); $i++){
$up=mysqli_query($con,"UPDATE `region_components` SET `com_name`='$com_name[$i]', `com_size`='$com_size[$i]' where`re_no`='$re_no' and `com_no`='$com_no[$i]'"); 
}

}


}


?>
<html>
<head>
<title>健璟內部管理系統</title>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<meta charset="utf-8">
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>    
<script>
function edit(b){
  if ($("#editbutton").prop("style")){
    $("#addnewcom").show();
    $(".editable").removeAttr("readonly");
    $(".editable").removeAttr("style","border-  style:none");
    $("#editbutton").attr("style","display:none;");
    $("#save").removeAttr("style","display:none;");
    
  }else{
    $(".editable").attr("readonly","readonly");
    $(".editable").attr("style","border-style:none");
    $("#save").attr("style","display:none;");
  }
  
}

function adddiv(){
  $("div#newcom").show();
  $("#addnewcom").hide();
}

function deletework(r){
var ii=r.parentNode.parentNode.rowIndex;
var s=document.getElementById("work").rows[ii].cells[6];
var change=s.innerHTML="<button onclick='addwork(this)'>+</button>";
var a=document.getElementById("work").rows[ii]
$('#waitmaintaintitle').after(a);
}

function addrow(i){
//var ii=i.parentNode.parentNode.rowIndex;
$("#add").remove();
$("table#newthing tr:last").after("<tr><td>零件名稱：<input name='new_com_name[]' type='text'></td><td>尺寸：<input name='new_com_size[]' type='text'></td><td><input id='add' type='button' value='新增' onclick='addrow(this)'></td></tr>");
}

</script>
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
              <h3 class='mt-4'><i class="fas fa-address-book"></i>產品詳細</h3>
<?php
$data=mysqli_query($con,"SELECT * FROM `region` where re_number = '$id'"); 
while ($rs=mysqli_fetch_array($data)){
?>
<h2><?php echo $rs['re_name'];?></h2>
<p>服務編碼：<?php echo $rs['re_number'];?></p>
<hr>
<?php } ?>
<form method="post" enctype="multipart/form-data">
<?php
if(isset($_GET["id"])){echo '<h3>規格</h3><input id="editbutton" type="button" value="編輯" onclick="edit()" class="btn btn-primary"><input name="save" id="save" type="submit" value="完成" style="display:none;" class="btn btn-primary">';}

$data1=mysqli_query($con,"SELECT * FROM `region` re join region_components rec on (re.re_no=rec.re_no) where re.re_number = '$id'"); 

while ($rs1=mysqli_fetch_array($data1)){
?>
<p><input name="com_name[]" class='editable' type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs1['com_name'];?>">:<input class='editable' type="text" style="border-style:none" readonly="readonly" name="com_size[]" value="<?php echo $rs1['com_size'];?>"><input type="text" style="display:none" name="com_no[]" value="<?php echo $rs1['com_no'];?>"></p>
<?php } ?>
<input type="button" id="addnewcom" onclick="adddiv()" style="display:none" value="新增零件" name="addnewcom">
<div id="newcom" style="display:none">
<h4>新增零件</h4>
<table id="newthing">
  <tr>
    <td>零件名稱：<input name="new_com_name[]" type="text"> </td>
    <td>尺寸：<input name="new_com_size[]" type="text"></td>
    <td><input id="add" type="button" value="新增" onclick="addrow(this)"></td>
  </tr>

</table>
</div>
</form>
<hr>
<h3>更新零件表</h3>
<table border="1px" id="" class="disPlay table table-bordered">
<?php 
if(isset($id)){    
    $data2=mysqli_query($con,"SELECT f.f_date,fc.f_detail,fc.f_price,fc.f_no,f_note from client c join fix f on (c.c_no=f.c_no) join fix_components fc on (f.f_no=fc.f_no) where c.c_no='$cno' and  fc.f_snuma='$id'");
    echo'<thead><th>日期</th><th>更新項目</th><th>價錢</th><th>備註</th></thead>';    
    while ($rs2=mysqli_fetch_array($data2)){
    
    echo '<tr><td>'.$rs2['f_date'].'</td><td>'.$rs2['f_detail'].'</td><td>'.$rs2['f_price'].'</td><td>'.$rs2['f_note'].'</td></tr>';
    } 
}else{
  $data2=mysqli_query($con,"SELECT f.f_date,fc.f_detail,fc.f_price,fc.f_no,f_note,f_snuma from client c join fix f on (c.c_no=f.c_no) join fix_components fc on (f.f_no=fc.f_no) where c.c_no='$cno' ");
    echo'<thead><th>日期</th><th>服務編號</th><th>更新項目</th><th>價錢</th><th>備註</th></thead>';    
    while ($rs2=mysqli_fetch_array($data2)){
    
    echo '<tr><td>'.$rs2['f_date'].'</td><td>'.$rs2['f_snuma'].'</td><td>'.$rs2['f_detail'].'</td><td>'.$rs2['f_price'].'</td><td>'.$rs2['f_note'].'</td></tr>';
    }   
}
    ?>
</table>
<hr>
<h3>維修</h3>
<table border="1px"  class="disPlay table table-bordered">

<?php 
if(isset($id)){     
    $data3=mysqli_query($con,"SELECT f.f_date,fc.f_content,f.f_no from client c join fix f on (c.c_no=f.c_no) join fix_content fc on (f.f_no=fc.f_no) where c.c_no='$cno' and fc.f_snum='$id'");
    echo '<thead><th>日期</th><th>維修原因</th><th>備註</th></thead>';
    while ($rs3=mysqli_fetch_array($data3)){
    
    echo '<td>'.$rs3["f_date"].'</td><td>'.$rs3["f_content"].'</td><td><input type="button" value="查看維修單" onclick=location.href='.'"fix_detail.php?id='.$rs3["f_no"].'"></td></tr>';
    }
}else{
    $data3=mysqli_query($con,"SELECT f.f_date,fc.f_content,f.f_no from client c join fix f on (c.c_no=f.c_no) join fix_content fc on (f.f_no=fc.f_no) where c.c_no='$cno'");
    echo '<thead><th>日期</th><th>故障情形</th><th>備註</td></thead>';
    while ($rs3=mysqli_fetch_array($data3)){
    
    echo '<td>'.$rs3["f_date"].'</td><td>'.$rs3["f_content"].'</td><td><input type="button" value="查看維修單" onclick=location.href='.'"fix_detail.php?id='.$rs3["f_no"].'"></td></tr>';
    }    
}
    
    ?>
</table>
<hr>
<h3>報價</h3>
<table border="1px" id="" class="disPlay table table-bordered">
<?php
if(isset($id)){      
    $data4=mysqli_query($con,"SELECT DISTINCT p.p_no,p.p_date,pc.p_device,pc.p_price FROM `price_content`pc join price p on (pc.p_no=p.p_no) where p.c_no='$cno' and pc.p_snum='$id'");
    echo '<thead><th>日期</th><th>報價項目</th><th>價格</th><th>備註</th></thead>';
    while ($rs4=mysqli_fetch_array($data4)){
    echo '<tr><td>'.$rs4["p_date"].'</td><td>'.$rs4["p_device"].'</td><td>'.$rs4["p_price"].'</td><td><input type="button" value="查看報價單" onclick=location.href='.'"price_detail.php?id='.$rs4["p_no"].'"></td></tr>'; 
    }
}else{
    $data4=mysqli_query($con,"SELECT DISTINCT p.p_no,p_date,p.p_total_amount,p.p_prefer_total FROM price p where p.c_no='$cno' and p_kind='機械式停車設備'");
    echo '<thead><th>日期</th><th>總金額</th><th>優惠總金額</th><th>備註</th></thead>';
    while ($rs4=mysqli_fetch_array($data4)){
    echo '<tr><td>'.$rs4["p_date"].'</td><td>'.$rs4["p_total_amount"].'</td><td>'.$rs4["p_prefer_total"].'</td><td><input type="button" value="查看報價單" onclick=location.href='.'"price_detail.php?id='.$rs4["p_no"].'"></td></tr>'; 
    }    
} 
    
    
    ?>
</table>
    <input type="button" onclick="history.back()" value="返回" class="btn btn-secondary">
</div></main></div></div>
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="../js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>    
<script src="assets/demo/datatables-demo.js"></script>    
</body>
</html>