<?php
include("mysql_connect.php");
$id=$_GET["id"];

if(isset($_POST['save'])){
$c_name=@$_POST['c_name'];
$c_phone=@$_POST['c_phone'];
$address_num=@$_POST['address_num'];   
$address=@$_POST['address'];
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
$payment=@$_POST['payment'];    
$editor=@$_POST['editor'];    
$invoice=@$_POST['invoice'];
$c_note=@$_POST['c_note']; 

$index=1;
//echo $_FILES['floorplan']['name'];
foreach(@$_FILES['floorplan']['tmp_name'] as $key => $tmp_name){
    $file_name=@$_FILES['floorplan']['name'][$key];
    $file_tmp =@$_FILES['floorplan']['tmp_name'][$key];
  $file_type= strrchr($file_name, ".");
    $newname=@$_POST['con_name']."平面圖".$index.$file_type;
  $rename=rename($file_name,$newname);move_uploaded_file($tmp_name,"../img/".$newname);
    if($file_name==""){
      $imgname="";
      break;
    }else{
      $imgname=$imgname.$newname."/";
      echo $imgname;
    }
    
    $index=$index+1;
}

$update= mysqli_query($con,"UPDATE `client` SET `c_name`='$c_name',`c_phone`='$c_phone',`address_num`='$address_num',`address`='$address',`zhu_name`='$zhu_name',`zhu_phone`='$zhu_phone',`zhu_conn`='$zhu_conn',`cai_name`='$cai_name',`cai_phone`='$cai_phone',`cai_conn`='$cai_conn',`jian_name`='$jian_name',`jian_phone`='$jian_phone',`jian_conn`='$jian_conn',`ganshi_name`='$ganshi_name',`ganshi_phone`='$ganshi_phone',`ganshi_conn`='$ganshi_conn',`admin_name`='$admin_name',`admin_phone`='$admin_phone',`admin_conn`='$admin_conn',`payment`='$payment',`editor`='$editor',`invoice`='$invoice',`c_note`='$c_note',`floorplan`='$imgname' WHERE c_no=$id");

$pro_no=@$_POST['pro_no'];
$pro_kind=@$_POST['pro_kind'];
$pro_num=@$_POST['pro_num'];
$pro_duty=@$_POST['pro_duty'];
$pro_amount=@$_POST['pro_amount'];
$park=@$_POST['p1'].' '.@$_POST['p2'].' '.@$_POST['p3'].' '.@$_POST['p4'].' '.@$_POST['p5'].' '.@$_POST['p6']; 
$drivemethod=@$_POST['d1'].' '.@$_POST['d2'].' '.@$_POST['d3'];
$transmisson=@$_POST['t1'].' '.@$_POST['t2'].' '.@$_POST['t3'];

if(isset($_POST['other_no'])){    
$o_no=@$_POST['other_no'];
$o_name=@$_POST['other_name'];
$o_phone=@$_POST['other_phone'];
$o_conn=@$_POST['other_conn'];
//print_r($_POST['other_no']);
for ($i = 0; $i < count($o_no); $i++) {  
$update2= mysqli_query($con,"UPDATE `contact_person` SET `other_name`='$o_name[$i]',`other_phone`='$o_phone[$i]',`other_conn`='$o_conn[$i]' WHERE other_no='$o_no[$i]'");
//echo $o_no.$o_name[$i];   
}
}
if($update ){
//header('location:contract_add.php'); 
}else{ echo 'data nono'.mysqli_error($con);}
}
if(isset($_POST['save1'])){
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
$year=date("Y");
$update3= mysqli_query($con,"UPDATE `client_connection` SET `zhu_name`='$zhu_name',`zhu_phone`='$zhu_phone',`zhu_conn`='$zhu_conn',`cai_name`='$cai_name',`cai_phone`='$cai_phone',`cai_conn`='$cai_conn',`jian_name`='$jian_name',`jian_phone`='$jian_phone',`jian_conn`='$jian_conn',`ganshi_name`='$ganshi_name',`ganshi_phone`='$ganshi_phone',`ganshi_conn`='$ganshi_conn',`admin_name`='$admin_name',`admin_phone`='$admin_phone',`admin_conn`='$admin_conn' WHERE c_no=$id and co_date=$year");

}

if(isset($_POST['insert1'])){
$zhu_name=@$_POST['zhu_name1'];
$zhu_phone=@$_POST['zhu_phone1'];    
$zhu_conn=@$_POST['zhu_conn1'];    
$cai_name=@$_POST['cai_name1'];    
$cai_phone=@$_POST['cai_phone1'];    
$cai_conn=@$_POST['cai_conn1'];
$jian_name=@$_POST['jian_name1'];    
$jian_phone=@$_POST['jian_phone1'];    
$jian_conn=@$_POST['jian_conn1'];    
$ganshi_name=@$_POST['ganshi_name1'];    
$ganshi_phone=@$_POST['ganshi_phone1'];
$ganshi_conn=@$_POST['ganshi_conn1'];    
$admin_name=@$_POST['admin_name1'];    
$admin_phone=@$_POST['admin_phone1'];    
$admin_conn=@$_POST['admin_conn1'];
$year=@$_POST['co_date'];
$insert1= mysqli_query($con,"INSERT INTO `client_connection`( `zhu_name`, `zhu_phone`, `zhu_conn`, `cai_name`, `cai_phone`, `cai_conn`, `jian_name`, `jian_phone`, `jian_conn`, `ganshi_name`, `ganshi_phone`, `ganshi_conn`, `admin_name`, `admin_phone`, `admin_conn`, `co_date`, `c_no`) VALUES ('$zhu_name','$zhu_phone','$zhu_conn','$cai_name','$cai_phone','$cai_conn','$jian_name','$jian_phone','$jian_conn','$ganshi_name','$ganshi_phone','$ganshi_conn','$admin_name','$admin_phone','$admin_conn','$year','$id')");

}

?>

<html>
<head>
<link rel="icon" href="../img/jj.ico" type="image/x-icon" />
<title>健璟內部管理系統</title>
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style type="text/css">
ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}
ul.pagination li 
{display: inline;}

ul.pagination li a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    font-size: 18px;
}

ul.pagination li a.active {
    background-color: #eee;
    color: black;
    border: 1px solid #ddd;
}

ul.pagination li a:hover:not(.active) {background-color: #ddd;}
</style>
<script>
function one(){   
  if ($("#receipt").prop('disabled') == true){
      $(".editable").removeAttr("readonly");
      $(".editable").removeAttr("style","border-style:none");
      $("#receipt").removeAttr("disabled");
      $("#save").attr("style","display:inline;");
      $("#edit").attr("style","display:none;");
      $("input[floorplan]").removeAttr("style","display:none;");
      
      //t.value="完成";
  }else{
    $(".editable").attr("readonly","readonly");
      $(".editable").attr("style","border-style:none");
      $("#receipt").attr("disabled","disabled");
      //t.value="編輯";
  }
  
}
function loadTab(obj,n){
var layer;
eval('layer=\'S'+n+'\'');

//將 Tab 標籤樣式設成 Blur 型態
var tabsF=document.getElementById('nav').getElementsByTagName('li');
for (var i=0;i<tabsF.length;i++){
    tabsF[i].setAttribute('id',null);
     eval('document.getElementById(\'S'+(i+1)+'\').style.display=\'none\'')
}

//變更分頁標題樣式
obj.parentNode.setAttribute('id','current');
obj.setAttribute('style',' background:#e4e1d8');
document.getElementById(layer).style.display='inline';
 
}

function two(){
if ($(".editable1").prop('readonly') == true){
      $(".editable1").removeAttr("readonly");
      $(".editable1").removeAttr("style","border-style:none");
      $("#save1").attr("style","display:inline;");
      $("#edit1").attr("style","display:none;");

      
  }else{
      alert("save");
      $(".editable1").attr("readonly","readonly");
      $(".editable1").attr("style","border-style:none");
      $("#save1").attr("style","display:none;");
      $("#edit1").attr("style","display:inline;");
      //t.value="編輯";
  }
}
function adddiv(){
  $("div#newcom").show();
  $("#addnewcom").hide();
}
function addrow(i){
//var ii=i.parentNode.parentNode.rowIndex;
$("#add").remove();
$("table#newthing tr:last").after("<tr><td class='input-group'>姓名：<input name='new_w_name[]' type='text' class='form-control'><div class='input-group-append'><button id='add' type='button' onclick='addrow(this)' class='btn btn-primary'><i class='fas fa-plus'></i></button></div></td></tr>");
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
              <h3 class='mt-4'><i class="far fa-address-book"></i>客戶詳細</h3>
<div id="nav">
  <ul class="pagination">
    <li id="current"><a href="javascript://" onclick="loadTab(this,1);"><span>基本資料</span></a></li>
    <li><a href="javascript://" onclick="loadTab(this,2);"><span>聯絡人</span></a></li>
    <li><a href="javascript://" onclick="loadTab(this,3);"><span>合約</span></a></li>
    <li><a href="javascript://" onclick="loadTab(this,4);"><span>產品</span></a></li>
    <li><a href="javascript://" onclick="loadTab(this,5);"><span>維修紀錄</span></a></li>
    <li><a href="javascript://" onclick="loadTab(this,6);"><span>保養紀錄</span></a></li>
    <li><a href="javascript://" onclick="loadTab(this,7);"><span>報價紀錄</span></a></li>
  </ul>
</div>
<div id="tabsC">
<div id="S1" style="display:inline;" >
<?php
    /*if(!$data){
      echo("Error: ".mysqli_error($con));
      exit();
      }*/
$data=mysqli_query($con,"select c_name,max(end_date),c_phone,payment,editor,floorplan,c_note,invoice from client c join contract con on(c.c_no=con.c_no) where c.c_no='$id'"); 
while ($rs=mysqli_fetch_array($data)){
?>  
  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="" >
<div class="card mb-4">
    <div class="card-header">基本資料</div>
    <div class="card-body">
    <p>大樓名稱：<input class="editable" type="text" style="border-style:none" readonly="readonly" name="c_name" value="<?php echo $rs["c_name"];?>"></p>
    <p>合約到期日：<input type="date" style="border-style:none" readonly="readonly" value="<?php echo $rs["max(end_date)"];?>"></p>
    <p>聯絡電話：<input class="editable" type="text" style="border-style:none" readonly="readonly" name="c_phone" value="<?php echo $rs["c_phone"];?>"></p>
<?php
    /*if(!$data){
      echo("Error: ".mysqli_error($con));
      exit();
      }*/
$data05=mysqli_query($con,"select cc.con_device,cc.con_total,cc.con_duty from client c join contract con on (c.c_no=con.c_no) join contract_content cc on (con.con_no=cc.con_no) where c.c_no='$id'");    
while ($rs05=mysqli_fetch_array($data05)){
?>  
    <p>機種:<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs05['con_device'];?>">保養費:<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs05['con_total'];?>">責任:<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs05['con_duty'];?>"></p>
 <?php } 
$data1=mysqli_query($con,"SELECT * FROM `contact_person` where c_no like $id");    
while ($rs1=mysqli_fetch_array($data1)){
?>        
    <p><input  type="text" style="display:none" readonly="readonly" name="other_no[]" value="<?php echo $rs1["other_no"];?>">
    其他負責人：<input class="editable" type="text" style="border-style:none" readonly="readonly" name="other_name[]" value="<?php echo $rs1["other_name"];?>">電話：<input class="editable" type="text" style="border-style:none" readonly="readonly" name="other_phone[]" value="<?php echo $rs1["other_phone"];?>"><br>其他聯絡方式：<textarea class="editable" style="border-style:none" readonly="readonly" name="other_conn[]"><?php echo $rs1["other_conn"];?></textarea></p>
<?php }?>      
    <p>收款方式：<textarea class="editable" style="border-style:none" readonly="readonly" name="payment"><?php echo $rs["payment"];?></textarea></p>
    <p>統編：<input class="editable" type="text" style="border-style:none" readonly="readonly" name="editor" value="<?php echo $rs["editor"];?>"></p>
    <p>發票：
    <?php 
        $recept= array('無','二聯式','三聯式');
        echo "<select name='invoice' id='receipt' disabled='disabled'>";                               
        for($i=0;$i<count($recept);$i++){
          $v=$recept[$i];   
          echo "<option value='$v'";
          echo ($rs['invoice']==$v)?'selected':'';
          echo ">$v</option>";
  
        }echo "</select>";                             
        
    ?>
    </p>
    <p>備註：<textarea class="editable" style="border-style:none" readonly="readonly" name="c_note"><?php echo $rs["c_note"];?></textarea></p>
    <p>平面圖：<input type="file" class="editable" name="floorplan[]" style="display:none" multiple />
    <?php
        $st=$rs["floorplan"];
        $str_sec=explode("/",$st);
        for($i=0;$i<=(count($str_sec)-2);$i++){
          echo "<a href='img_display.php?name=".$str_sec[$i]."' target='_blank'>";
          echo "<img src='../img/".$str_sec[$i]."' width='500px' height='500px'></a>";
        }
        ?>
    </p>
    <p align="right"><input id="edit"  type="button" value="編輯" onclick="one()" class="btn btn-primary">
      <input id="save" name="save" type="submit" value="完成" style="display:none;" class="btn btn-primary">
      </p>
    </div></div>
  </form>
<?php } ?>  
</div>
<div id="S2" style="display:none;">
 <input type="button" id="addnewcom" onclick="adddiv()" value="新增歷年聯絡人" name="addnewcom" class="btn btn-secondary">
<form id="form3" name="form2" method="post" enctype="multipart/form-data" action="" >  
 <div id="newcom" style="display:none" class="card mb-4">   
<div class="card-header">新增歷年聯絡人</div>
<div  class="card-body">
<p>年份<input type="number" name="co_date" min='2000'  max="<?php echo date("Y");?>" step="1" value="<?php echo date("Y");?>"></p>    
<p>主委：<input  type="text"  name="zhu_name1">電話：<input  type="text"  name="zhu_phone1" ><br>其他聯絡方式：<textarea name="zhu_conn1"></textarea></p>
<p>財委：<input  type="text"  name="cai_name1" >電話：<input  type="text"  name="cai_phone1" ><br>其他聯絡方式：<textarea  name="cai_conn1"></textarea></p>
<p>監委：<input  type="text"  name="jian_name1" >電話：<input  type="text" name="jian_phone1"><br>其他聯絡方式：<textarea  name="jian_conn1"></textarea></p>
<p>總幹事：<input  type="text"  name="ganshi_name1" >電話：<input type="text"  name="ganshi_phone1">"><br>其他聯絡方式：<textarea  name="ganshi_conn1"></textarea></p>
<p>管理員：<input type="text"  name="admin_name1" >電話：<input  type="text" name="admin_phone1" ><br>其他聯絡方式：<textarea name="admin_conn1"></textarea></p>
<input  name="insert1" type="submit" value="新增" class="btn btn-primary">    
</div> 
</div>
</form>
<?php
$year=date("Y");
$data2=mysqli_query($con,"SELECT * FROM `client_connection` where c_no like $id and co_date like $year");    
while ($rs2=mysqli_fetch_array($data2)){
?> 
<form id="form2" name="form2" method="post" enctype="multipart/form-data" action="" >   
<div class="card mb-4">    
    <div class="card-header"><?php echo $rs2['co_date'];?></div>
    <div class="card-body">    
    
<p>主委：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="zhu_name" value="<?php echo $rs2["zhu_name"];?>">電話：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="zhu_phone" value="<?php echo $rs2["zhu_phone"];?>"><br>其他聯絡方式：<textarea class="editable1" style="border-style:none" readonly="readonly" name="zhu_conn"><?php echo $rs2["zhu_conn"];?></textarea></p>
<p>財委：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="cai_name" value="<?php echo $rs2["cai_name"];?>">電話：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="cai_phone" value="<?php echo $rs2["cai_phone"];?>"><br>其他聯絡方式：<textarea class="editable1" style="border-style:none" readonly="readonly" name="cai_conn"><?php echo $rs2["cai_conn"];?></textarea></p>
<p>監委：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="jian_name" value="<?php echo $rs2["jian_name"];?>">電話：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="jian_phone" value="<?php echo $rs2["jian_phone"];?>"><br>其他聯絡方式：<textarea class="editable1" style="border-style:none" readonly="readonly" name="jian_conn"><?php echo $rs2["jian_conn"];?></textarea></p>
<p>總幹事：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="ganshi_name" value="<?php echo $rs2["ganshi_name"];?>">電話：<input class="editable1" type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs2["ganshi_phone"];?>" name='ganshi_phone'><br>其他聯絡方式：<textarea class="editable1" style="border-style:none" readonly="readonly" name="ganshi_conn"><?php echo $rs2["ganshi_conn"];?></textarea></p>
<p>管理員：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="admin_name" value="<?php echo $rs2["admin_name"];?>">電話：<input class="editable1" type="text" style="border-style:none" readonly="readonly" name="admin_phone" value="<?php echo $rs2["admin_phone"];?>"><br>其他聯絡方式：<textarea class="editable1" style="border-style:none" readonly="readonly" name="admin_conn"><?php echo $rs2["admin_conn"];?></textarea></p>
<input id="edit1" type="button" value="編輯" onclick="two()" class="btn btn-primary">        
<input id="save1" name="save1" type="submit" value="完成" style="display:none;" class="btn btn-primary">
    </div></div></form>
<?php }
//$year=date("Y");
$data25=mysqli_query($con,"SELECT * FROM `client_connection` where c_no like $id and co_date not in ($year) order by co_date DESC");    
while ($rs25=mysqli_fetch_array($data25)){
?>
<div class="card mb-4">
    <div class="card-header"><?php echo $rs25['co_date'];?></div>
    <div class="card-body">        
<p>主委：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["zhu_name"];?>">電話：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["zhu_phone"];?>"><br>其他聯絡方式：<textarea style="border-style:none" readonly="readonly" ><?php echo $rs25["zhu_conn"];?></textarea></p>
<p>財委：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["cai_name"];?>">電話：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["cai_phone"];?>"><br>其他聯絡方式：<textarea style="border-style:none" readonly="readonly" ><?php echo $rs25["cai_conn"];?></textarea></p>
<p>監委：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["jian_name"];?>">電話：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["jian_phone"];?>"><br>其他聯絡方式：<textarea style="border-style:none" readonly="readonly" ><?php echo $rs25["jian_conn"];?></textarea></p>
<p>總幹事：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["ganshi_name"];?>">電話：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["ganshi_phone"];?>"><br>其他聯絡方式：<textarea style="border-style:none" readonly="readonly" ><?php echo $rs25["ganshi_conn"];?></textarea></p>
<p>管理員：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["admin_name"];?>">電話：<input type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs25["admin_phone"];?>"><br>其他聯絡方式：<textarea style="border-style:none" readonly="readonly"><?php echo $rs25["admin_conn"];?></textarea></p></div></div>
<?php } ?>
</div>
<div id="S3" style="display:none;">
<div class="card mb-4">
     <div class="card-header">合約</div>
     <div class="card-body">
<table id="contract"  class="table table-bordered">
    <tr>
      <th>設備</th>
      <th>到期日</th>
      <th>備註</th>
    </tr>
<?php 
$data3=mysqli_query($con,"SELECT * FROM `contract`con join client c on (con.c_no=c.c_no) join contract_content cc on (con.con_no=cc.con_no) where c.c_no like $id");
$i=1;
while ($rs3=mysqli_fetch_array($data3)){
?>
    <tr>
      <td><?php echo $rs3['con_device'];?></td>
      <td><?php echo $rs3['end_date'];?></td>
      <td><input type="button" value="詳細" onclick="location.href='contract_detail.php?id=<?php echo $rs3['con_no'];?>'"></td>
    </tr>
<?php } ?>
  </table>
    </div></div></div>
<div id="S4" style="display:none;">
<?php
$data4=mysqli_query($con,"select p.pro_kind from client c join product p on (c.c_no=p.c_no) where c.c_no like $id");
while ($rs4=mysqli_fetch_array($data4)){  
    if ($rs4['pro_kind']=="機械式停車設備"){
        echo '<div class="card mb-4"><p class="card-header">機械式停車設備</p><div class="card-body" >'; 
        $data40=mysqli_query($con,"select r.re_name,r.re_number,r.re_no from client c join product p on (c.c_no=p.c_no) join region r on (r.pro_no=p.pro_no) where c.c_no like $id and p.pro_kind='機械式停車設備'");
        $i1=1;
        echo "<table  class='table table-bordered'><tr>";
        echo "<tr><a href='parking_detail.php?cno=$id'>全車區</a></tr>";
        while ($rs40=mysqli_fetch_array($data40)){
            $re_number=$rs40['re_number'];
            $re_no=$rs40['re_no'];
            $re_name=$rs40['re_name'];      
            echo "<td><a href='parking_detail.php?cno=$id&id=$re_number&no=$re_no'>$re_number($re_name)</a></td>";
            if($i%5==0){echo "</tr>";}
            $i=$i+1;
        }echo "</table></div></div>";
    } else if ($rs4['pro_kind']=="電梯"){echo '<div class="card mb-4"><p class="card-header">電梯</p><div class="card-body" >'; 
        $data41=mysqli_query($con,"select r.re_number,r.re_no from client c join product p on (c.c_no=p.c_no) join region r on (r.pro_no=p.pro_no) where c.c_no like $id and p.pro_kind='電梯'");
        echo "<table  class='table table-bordered'><tr>";
        while ($rs41=mysqli_fetch_array($data41)){
            $re_number=$rs41['re_number'];
            $re_no=$rs41['re_no'];
            echo "<td><a href='parking_detail.php?cno=$id&id=$re_number&no=$re_no'>$re_number</a></td>";
            if($i%5==0){echo "</tr>";}
            $i=$i+1;
        }echo "</table></div></div>";
    }else{
        echo '<div class="card mb-4"><p class="card-header">附屬設備</p><div class="card-body" >';
        $data42=mysqli_query($con,"select r.re_number,r.re_no from client c join product p on (c.c_no=p.c_no) join region r on (r.pro_no=p.pro_no) where c.c_no like $id and p.pro_kind not like '電梯' and p.pro_kind not like '機械式停車設備'");
        echo "<table  class='table table-bordered'><tr>";
        while ($rs42=mysqli_fetch_array($data42)){
            $re_number=$rs42['re_number'];
            $re_no=$rs42['re_no'];
            echo "<td><a href='parking_detail.php?cno=$id&id=$re_number&no=$re_no'>$re_number</a></td>";
            if($i%5==0){echo "</tr>";}
            $i=$i+1;
        }echo "</table></div></div>";
    } 
}
?>
</div>
<div id="S5" style="display:none;">
<div class="card mb-4">
     <div class="card-header">維修紀錄</div>
     <div class="card-body">
<table id="contract"  class="table table-bordered">    

    <tr>
      <th>日期</th>
      <th>設備</th>
      <th>負責人員</th>
      <th>備註</th>
    </tr>
<?php
$data5=mysqli_query($con,"SELECT f.f_date,f.f_device,(CONCAT(f.f_person1, ',',f.f_person2)) as f_person,f.f_no FROM `fix` f join client c on (f.c_no=c.c_no) join fix_content fc on (f.f_no=fc.f_no) where c.c_no='$id'");
while ($rs5=mysqli_fetch_array($data5)){
?>
    <tr>
      <td><?php echo $rs5['f_date'];?></td>
      <td><?php echo $rs5['f_device'];?></td>
      <td><?php echo $rs5['f_person'];?></td>
      <td><input type="button" value="詳細" onclick="location.href='fix_detail.php?id=<?php echo $rs5['f_no'];?>'"></td>
    </tr>
    <?php } ?>
  </table>
    </div></div></div>
<div id="S6" style="display:none;">
<div class="card mb-4">
     <div class="card-header">保養紀錄</div>
     <div class="card-body">
<table id="contract"  class="table table-bordered"> 
  <tr>
    <th>日期</th>
    <th>設備</th>
    <th>負責人員</th>
    <th>備註</th>
  </tr>
<?php 
$data6=mysqli_query($con,"SELECT m.m_date,m.m_device,(CONCAT(m.m_person_1, ',',m.m_person_2)) as m_person,m.m_no  FROM `maintain` m join client c on (m.c_no=c.c_no) where c.c_no='$id' and m.m_status='已填單'");
while ($rs6=mysqli_fetch_array($data6)){
?>
  <tr>
    <td><?php echo $rs6['m_date'];?></td>
    <td><?php echo $rs6['m_device'];?></td>
    <td><?php echo $rs6['m_person'];?></td>
    <td><input type="button" value="詳細" onclick="location.href='maintain_detail.php?id=<?php echo $rs6['m_no'];?>'"></td>
  </tr>
<?php }?>
</table>
    </div></div></div>
<div id="S7" style="display:none;">
<div class="card mb-4">
     <div class="card-header">報價紀錄</div>
     <div class="card-body">
<table id="contract"  class="table table-bordered"> 
    <tr>
      <th>日期</th>
      <th>狀態</th>
      <th>金額</th>
      <th>備註</th>
    </tr>
<?php 
$data7=mysqli_query($con,"SELECT p_date,p_status,p_total_amount,p.p_no FROM `price` p join client c on (p.c_no=c.c_no) where c.c_no='$id'");
while ($rs7=mysqli_fetch_array($data7)){
?>
    <tr>
      <td><?php echo $rs7['p_date'];?></td>
      <td><?php echo $rs7['p_status'];?></td>
      <td><?php echo $rs7['p_total_amount'];?></td>
      <td><input type="button" value="詳細" onclick="location.href='price_detail.php?id=<?php echo $rs7['p_no'];?>'"></td>
    </tr>
    <?php } ?>
  </table>

    </div></div></div>

</div>
</div></main></div></div>               

<script src="../js/scripts.js"></script>
</body>
</html>