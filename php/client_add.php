<?php 
include("mysql_connect.php");
if(isset($_POST['insert'])){
date_default_timezone_set("Asia/Taipei");    
$cno=date("zB");
    
$c_name=$_POST['c_name'];
$c_phone=$_POST['c_phone'];
$address_num=$_POST['address_num'];   
$address=$_POST['address'];
$zhu_name=$_POST['zhu_name'];
$zhu_phone=$_POST['zhu_phone'];    
$zhu_conn=$_POST['zhu_conn'];    
$cai_name=$_POST['cai_name'];    
$cai_phone=$_POST['cai_phone'];    
$cai_conn=$_POST['cai_conn'];
$jian_name=$_POST['jian_name'];    
$jian_phone=$_POST['jian_phone'];    
$jian_conn=$_POST['jian_conn'];    
$ganshi_name=$_POST['ganshi_name'];    
$ganshi_phone=$_POST['ganshi_phone'];
$ganshi_conn=$_POST['ganshi_conn'];    
$admin_name=$_POST['admin_name'];    
$admin_phone=$_POST['admin_phone'];    
$admin_conn=$_POST['admin_conn'];
$payment=$_POST['payment'];    
$editor=$_POST['editor'];    
$invoice=$_POST['invoice'];
$c_note=$_POST['c_note'];
$year=date("Y");
$query=mysqli_query($con,"INSERT INTO `client`(`c_no`,`c_name`, `c_phone`, `address_num`, `address`, `payment`, `editor`, `invoice`, `c_note`, `c_status`) VALUES ('$cno','$c_name','$c_phone','$address_num','$address','$payment','$editor','$invoice','$c_note','進行中')");

$query1=mysqli_query($con,"INSERT INTO `client_connection`(`zhu_name`, `zhu_phone`, `zhu_conn`, `cai_name`, `cai_phone`, `cai_conn`, `jian_name`, `jian_phone`, `jian_conn`, `ganshi_name`, `ganshi_phone`, `ganshi_conn`, `admin_name`, `admin_phone`, `admin_conn`,`co_date`,`c_no`) VALUES ('$zhu_name','$zhu_phone','$zhu_conn','$cai_name','$cai_phone','$cai_conn','$jian_name','$jian_phone','$jian_conn','$ganshi_name','$ganshi_phone','$ganshi_conn','$admin_name','$admin_phone','$admin_conn','$year','$cno')");

$pro_no1=@$_POST['pro_no1'];
$pro_no2=@$_POST['pro_no2'];
$pro_no3=@$_POST['pro_no3'];    
$pro_kind=@$_POST['pro_kind'];
$pro_num=@$_POST['pro_num'];
$pro_price=@$_POST['pro_price'];    
$pro_duty=@$_POST['pro_duty'];
$pro_amount=@$_POST['pro_amount'];
$pro_park=@$_POST['pro_park'];
$park= is_array(@$_POST['park']) ?  @$_POST['park']:[]; 
$park= implode (" ", $park);
$drivemethod1= is_array(@$_POST['d1']) ?  @$_POST['d1']:[];     
$drivemethod1= implode (" ", $drivemethod1);
$transmisson1= is_array(@$_POST['t1']) ?  @$_POST['t1']:[];     
$transmisson1= implode (" ", $transmisson1);
 

$dr1=@$_POST['dr1'];
$tr1=@$_POST['tr1'];    
$e1=@$_POST['e1'];
$u1=@$_POST['u1'];    


    
//附屬設備    
function delByValue($arr){
  if(!is_array($arr)){
    return $arr;
  }
  foreach($arr as $k=>$v){
    if($v == '機械式停車設備'){
      unset($arr[$k]);
    }else if($v == '電梯'){
      unset($arr[$k]);
    }
  }
  return $arr;
}    

$testArr = delByValue($pro_kind);

$dr3= is_array(@$_POST['dr1']) ?  @$_POST['dr1']:[];   
$dr3=implode(' ',$dr3);
$tr3= is_array(@$_POST['tr1']) ?  @$_POST['tr1']:[];    
$tr3=implode(' ',$tr3);
$e3= is_array(@$_POST['e1']) ?  @$_POST['e1']:[];    
$e3=implode(' ',$e3);
$u3= is_array(@$_POST['u1']) ?  @$_POST['u1']:[];    
$u3=implode(' ',$u3);    
  
  

/*print_r($dr3);    
print_r($tr3);
print_r($e3); 
print_r($u3);     
print_r($pro_no2);*/    
$is= date('is');
$x=0;
print_r($pro_kind);    
for($i=0;$i<count($pro_kind);$i++){
$isi=$is.$i;    
if($pro_kind[$i]=='機械式停車設備'){
    
    echo $pro_kind[$i];
    $query2=mysqli_query($con,"INSERT INTO `product`(`c_no`, `pro_no`, `pro_kind`, `pro_num`, `pro_price`, `pro_duty`, `pro_amount`, `park`, `drivemethod`, `transmisson`) VALUES ('$cno','$isi','$pro_kind[$i]','$pro_num[$i]','$pro_price[$i]','$pro_duty[$i]','$pro_amount','$park','$drivemethod1','$transmisson1')");

    
    for($j=0;$j<$pro_amount;$j++){
        
        $query3=mysqli_query($con,"INSERT INTO `region`( `re_number`,`re_name`, `pro_no`) VALUES ('$pro_no1[$j]','$pro_park[$j]','$isi')");        
        echo $pro_no1[$j];
        //echo $pro_no1[$j],'</br>';
    }
}else if($pro_kind[$i]=='電梯'){
    echo $pro_kind[$i];
    $query2=mysqli_query($con,"INSERT INTO `product`(`c_no`, `pro_no`, `pro_kind`, `pro_num`, `pro_price`, `pro_duty` ) VALUES ('$cno','$isi','$pro_kind[$i]','$pro_num[$i]','$pro_price[$i]','$pro_duty[$i]')");
    for($j=0;$j<$pro_num[$i];$j++){
        $query3=mysqli_query($con,"INSERT INTO `region`( `re_number`, `pro_no`) VALUES ('$pro_no3[$j]','$isi')");
        echo $pro_no3[$j];
        //echo $pro_no3[$j],'</br>';
    }
    
}else{
    //$x=$i-(count($pro_kind)-count($testArr));
    //echo $x;
    $query2=mysqli_query($con,"INSERT INTO `product`(`c_no`, `pro_no`, `pro_kind`, `pro_num`, `pro_price`, `pro_duty`, `drivemethod`, `transmisson`, `elevator`, `turntable`) VALUES ('$cno','$isi','$pro_kind[$i]','$pro_num[$i]','$pro_price[$i]','$pro_duty[$i]','$dr3','$tr3','$e3','$u3')");

        echo $pro_kind[$i].$dr3[$j].$tr3[$j].$e3[$j].$u3[$j],'<br />';
    for($j=0;$j<$pro_num[$i];$j++){
        if($i!=0){
        $y=$pro_num[$i-1]+$j;    
            
            $query3=mysqli_query($con,"INSERT INTO `region`( `re_number`, `pro_no`) VALUES ('$pro_no2[$y]','$isi')");
        //echo $is.$i;
        //echo $pro_no2[$pro_num[$i-1]+$j],'</br>';
            
        }else{
            $query3=mysqli_query($con,"INSERT INTO `region`( `re_number`, `pro_no`) VALUES ('$pro_no2[$j]','$isi')");
        //echo $is.$i;
        //echo $pro_no2[$j],'</br>';
        }
    }
    
$x=$x+1;
   
}
}
  
    
$o_name=@$_POST['other_name'];
$o_phone=@$_POST['other_phone'];
$o_conn=@$_POST['other_conn'];    
for ($i = 0; $i < count($o_name); $i++) {      
$query3=mysqli_query($con,"INSERT INTO `contact_person`(`c_no`,`other_name`, `other_phone`, `other_conn`) VALUES ('$cno','$o_name[$i]','$o_phone[$i]','$o_conn[$i]')");
 //echo   $o_name[$i]. $o_phone[$i].$o_conn[$i];
}
    
//$result = mysqli_query($con,$query);
//$result3 = mysqli_query($con,$query3);    
if($query2){
header('location:client_add.php'); 
}else{ echo 'data nono'.mysqli_error($con);}
}
?>
<html>
<head>
<title>健璟內部管理系統</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script> 
<script>
$(document).ready(function(){
	$("#education").addClass('main-hide');
	$("#work").addClass('main-hide');
	$("#social").addClass('main-hide');
	$('#previous_step').hide();
	/*上一步*/
	$('#previous_step').bind('click', function () {
		index--;
		ControlContent(index);
	});
	/*下一步*/
	$('#next_step').bind('click', function () {
		index++;
		ControlContent(index);
	});
});
var index=0;
function ControlContent(index) {
    var stepContents = ["basicInfo","education","work","social"];
    var key;//数组中元素的索引值
    for (key in stepContents) {
      var stepContent = stepContents[key];//获得元素的值
      if (key == index) {
        if(stepContent=='basicInfo'){
          $('#previous_step').hide();
        }else{
          $('#previous_step').show();
        }
        if(stepContent=='social'){
          $('#next_step').hide();
        }else{
          $('#next_step').show();
        }
        $('#'+stepContent).removeClass('main-hide');
        $('#point'+key).addClass('c-select');
        $('#line'+key).removeClass('b-select');
      }else {
        $('#'+stepContent).addClass('main-hide');
        if(key>index){
          $('#point'+key).removeClass('c-select');
          $('#line'+key).removeClass('b-select');
        }else if(key<index){
          $('#point'+key).addClass('c-select');
          $('#line'+key).addClass('b-select');
        }
      }
    }

};
$(document).on('change', 'select#type', function() {
//更改設備顯示驅動傳動   
    var type=$(this).val();
    //var i=r.parentNode.parentNode.rowIndex;
    console.log(type);
    var device=Array('機械式停車設備','電梯');
    var a=0;
    
    if(type==device[0]){
      a=1}
    else if(type==device[1]){
      a=3}
    else{
      a=2
    }
    
switch(a){
case 1:
   if(type==device[0]){
      //$('tb ody#parking1').show();
      //$('tbody#ancillary1').hide();
      //alert('機械停車設備');
     var s='tr:gt('+$(this).parent().parent().index()+')';
     console.log(s);
     //$("#product tr:gt(s)").remove();
     $("#product").find(s).remove();
      var a="#product tr:eq("+$(this).parent().parent().index()+")";
     //$("#product tr:gt(tr)").remove();
      $(a).after("<tr><td>控制器數量</td><td><input type='number' id='num'  min='1'  style='width:30%;' name='pro_amount'></td><td colspan='4' id='b'><p>例:設備代號+郵遞區號+客戶編號+控制器數</p></td></tr><tr><td>機械停車設備</td><td colspan='5'><input type='checkbox' name='park[]' value='簡易型單置車板式'>簡易型單置車板式<input type='checkbox' name='park[]' value='簡易型雙置車板式'>簡易型雙置車板式<input type='checkbox' name='park[]' value='簡易型多置車板式'>簡易型多置車板式<br><input type='checkbox' name='park[]' value='多段型升降橫移式'>多段型升降橫移式<input type='checkbox' name='park[]' value='平面往後式'>平面往後式<input type='checkbox' name='park[]' value='循環式'>循環式</td></tr><tr><td>驅動方式</td><td colspan='5'><input type='checkbox' name='d1[]' value='油壓式'>油壓式<input type='checkbox' name='d1[]'value='電動機'>電動機<input type='checkbox' name='d1[]' value='臂桿式'>臂桿式</td></tr><tr><td>傳動元件</td><td colspan='5'><input type='checkbox' name='t1[]' value='鍊條'>鍊條<input type='checkbox' name='t1[]' value='鋼索'>鋼索<input type='checkbox' name='t1[]' value='油壓缸'>油壓缸</td></tr>"); 
      $(document).on('change', 'input#num', function() {
          var n=$(this).val();
          var i=1;
          $("#b").html("<p>例:設備代號+郵遞區號+客戶編號+控制器數</p>");
          for(i=1; i<=n; i++){
              $("#b").append("<input placeholder='服務編號' name='pro_no1[]'><input placeholder='車位' name='pro_park[]' ></br>");
          }
      }); 
      break;
      }
case 2:
   //if(type==device[1]){
   //alert('附屬設備');
      //$('tbody#ancillary1').show();
      //$('tbody#parking1').hide();
      var s='tr:gt('+$(this).parent().parent().index()+')';
     var  i= $(this).parent().parent().index();    
     console.log(s);
      console.log(i);  
     //$("#product tr:gt(s)").remove();
     $("#product").find(s).remove();
     var a="#product tr:eq("+$(this).parent().parent().index()+")";
     //$("#product tr:gt(tr)").remove();
      $(a).after("<tr><td>服務編號</td><td colspan='5' id='a'><p>例:設備代號+郵遞區號+客戶編號+控制器數</p><input placeholder='服務編號' name='pro_no[]'></td></tr><tr><td>汽(機)車升降機</td><td colspan='5'><input type='checkbox' name='e1[]' value='升降式'>升降式<input type='checkbox' name='e1[]' value='升降迴旋式'>升降迴旋式<input type='checkbox' name='e1[]' value='升降橫移式'>升降橫移式</td></tr><tr><td>旋轉台</td><td colspan='5'><input type='checkbox' name='u1[]' value='迴旋式'>迴旋式<input type='checkbox' name='u1[]' value='旋轉移動式'>旋轉移動式<input type='checkbox' name='u1[]' value='貨梯'>貨梯</td></tr><tr><td>驅動方式</td><td colspan='5'><input type='checkbox' name='dr1[]' value='油壓缸'>油壓缸<input type='checkbox' name='dr1[]' value='電動機'>電動機<input type='checkbox' name='dr1[]' value='臂桿式'>臂桿式</td></tr><tr><td>傳動元件</td><td colspan='5' ><input type='checkbox' name='tr1[]' value='鍊條'>鍊條<input type='checkbox' name='tr1[]' value='鋼索'>鋼索<input type='checkbox' name='tr1[]' value='油壓缸'>油壓缸</td></tr>");
      $(document).on('change', 'input#number', function() {
          var n=$(this).val();
          var i=1;
          $("#a").html("<p>例:設備代號+郵遞區號+客戶編號+控制器數</p>");
          for(i=1; i<=n; i++){
              $("#a").append("<input placeholder='服務編號' name='pro_no2[]'></br>");
      }
      });       
       break;
      //}
case 3:
var s='tr:gt('+$(this).parent().parent().index()+')';
     console.log(s);
     //$("#product tr:gt(s)").remove();
     $("#product").find(s).remove();
   if(type==device[1]){
      //alert('電梯');
       var a="#product tr:eq("+$(this).parent().parent().index()+")";
      $(a).after("<tr><td>服務編號</td><td colspan='5'  id='c'><p>例:設備代號+郵遞區號+客戶編號+控制器數</p><input placeholder='服務編號' name='pro_no[]'></td></tr>");   
      $(document).on('change', 'input#number', function() {
          var n=$(this).val();
          var i=1;
          $("#c").html("<p>例:設備代號+郵遞區號+客戶編號+控制器數</p>");
          for(i=1; i<=n; i++){
              $("#c").append("<input placeholder='服務編號' name='pro_no3[]'></br>");
      }
      });       
       break;
      }
   }      
});
        
function addRow(r){
//增加機種
  //$("#addbt").attr("display","none");
    
 if (r==1){
  $("#addbt").remove();
  $("#type").attr("disabled","disabled");
  $("#type").removeAttr("id");
  $("#a").removeAttr("id");     
  $("#b").removeAttr("id");
  $("#c").removeAttr("id");     
  $("#num").removeAttr("id");
  $("#number").removeAttr("id");  
  $('#product tr:last').after("<tr><td>機種</td><td><select  id='type' name='pro_kind[]'><option value=''>選擇設備</option><option value='機械式停車設備'>機械式停車設備</option><option value='汽車升降機'>汽車升降機</option><option value='電梯'>電梯</option><option value='貨梯'>貨梯</option><option value='服務梯'>服務梯</option></select><input type='number' id='number' min='1' value='1' style='width: 30%;' name='pro_num[]'></td><td>保養費</td><td><input type='text' name='pro_price[]'></td><td >責任</td><td><select name='pro_duty[]'><option value=''>選擇責任</option><option value='半責'>半責</option><option value='全責'>全責</option><option value='附表全責'>附表全責</option><option value='除外全責'>除外全責</option></select><button id='addbt' onclick='addRow(1)'>新增</button></td></tr>");

 // $("#principal").removeAttr("id");
  //$("#addd").setAttribute("id","principal");
  
}else if(r==2){
    $('#Contact tr:last').after("<tr><td>其他負責人</td><td colspan='2'><input type='text' name='other_name[]'></td><td>電話</td><td colspan='2'><input type='text' name='other_phone[]'><button onclick='delectRow(this)'>刪除</button></td></tr><tr><td>其他聯絡方式</td><td colspan='5'><textarea name='other_conn[]'></textarea></td></tr>");
}
};
//刪除其他聯絡人
function delectRow(r){   
  var tab = document.getElementById("Contact");
    var i=r.parentNode.parentNode.rowIndex;
  //console.log(i);
    //alert(i);
    tab.deleteRow(i+1);
    tab.deleteRow(i);
    
};        
$(document).on('click', 'button#submit', function() {
//表單送出前 關掉disabled
//alert($('select').val);    
$("input").prop("disabled",false);
$("select").prop("disabled",false);
});
</script></head>
<style>
    .processBar{
      float: left;
      width: 200px;
      margin-top: 15px;
    }
    .processBar .bar{
      background: #D2F4F9;
      height: 3px;
      position: relative;
      width: 185px;
      margin-left: 10px;  
    }
    .processBar .b-select{
      
      background-color: #17a2b8;   
    }
    .processBar .bar .c-step{
      position: absolute;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #D2F4F9;
      left: -12px;
      top: 50%;
      margin-top: -4px;
    }
    .processBar .bar .c-select{
      width: 10px;
      height: 10px;
      margin: -5px -1px;
      background-color: #17a2b8;

    }
    .main-hide {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }
    .poetry{
    	color: #0C545F; 
    	font-family: KaiTi_GB2312, KaiTi, STKaiti; 
    	font-size: 16px; 
    	background-color: transparent; 
    	font-weight: bold; 
    	font-style: normal; 
    	text-decoration: none;
    }
    /*button{
    	width: 80px;
	    line-height: 30px;	    
	    font-size: 11px;
	    color: rgb(116, 42, 149);
	    text-align: center;
	    border-radius: 6px;
	    border: 1px solid #e2e2e2;	    
	    cursor: pointer;
	    background-color: #fff;
	    outline:none;
    }
    button:hover{
      border: 1px solid rgb(179, 161, 200);
    }*/</style>    
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
              <h3 class='mt-4'><i class="fas fa-user-plus"></i>新增客戶</h3> 
	<!--  标题进度条 start-->
	<div class="content" style="margin: 2% 20%;width: 80%;">
		<div class="processBar">
			<div id="line0" class="bar">
				<div id="point0" class="c-step c-select"></div>
			</div>
			<div class="text" style="margin: 10px -25px;"><span class='poetry'>基本資料</span></div>
		</div>
		<div class="processBar">
			<div id="line1" class="bar">
				<div id="point1" class="c-step"></div>
			</div>
			<div class="text" style="margin: 10px -30px;"><span class='poetry'>產品資料</span></div>
		</div>
		<div class="processBar">
			<div id="line2" class="bar">
				<div id="point2" class="c-step"></div>
			</div>
			<div class="text" style="margin: 10px -30px;"><span class='poetry'>連絡方式</span></div>
		</div>
		<div class="processBar">
			<div id="line3" class="bar" style="width: 0;">
				<div id="point3" class="c-step"></div>
			</div>
			<div class="text" style="margin: 10px -15px;"><span class='poetry'>收款方式</span></div>
		</div>
	</div>
	<!--  标题进度条 end-->
    
	<!--div style="clear: both;"></div-->
	<div id="MainContent" style="margin: 2% 0%;">
    <form method="post" enctype="multipart/form-data">    
        <div class="content" id="basicInfo">
			<span class='poetry'>
                <table border="1" class="table table-bordered">
                <tr><td>大樓名稱</td><td colspan="2"><input type="text" name="c_name"></td>           
                    <td>電話</td><td colspan="2"><input type="text" name="c_phone"></td></tr>
                <tr><td>地址</td><td colspan="5"><select name="address_num">
            <option value=''>郵遞區號</option>
            <option value='400'>400</option>
            <option value='401'>401</option>
            <option value='402'>402</option>
            <option value='403'>403</option>
            <option value='404'>404</option>
            <option value='405'>405</option>
            <option value='406'>406</option>
            <option value='407'>407</option>
            <option value='408'>408</option>
            <option value='411'>411</option>
            <option value='412'>412</option>
            <option value='413'>413</option>
            <option value='414'>414</option>
            <option value='420'>420</option>
            <option value='421'>421</option>
            <option value='423'>423</option>
            <option value='424'>424</option>
            <option value='426'>426</option>
            <option value='427'>427</option>
            <option value='428'>428</option>
            <option value='429'>429</option>
            <option value='432'>432</option>
            <option value='433'>433</option>
            <option value='434'>434</option>
            <option value='435'>435</option>
            <option value='436'>436</option>
            <option value='437'>437</option>
            <option value='438'>438</option>
            <option value='439'>439</option>
        </select><input type="text" name="address"></td>
            </tr></table>
			</span>
		</div>
		<div class="content" id="education">
			<span class='poetry'>
                <table id="product" border="1" class="table table-bordered">
				<tr><td>機種</td><td><select  id="type" name="pro_kind[]">
            <option value=''>選擇設備</option>
            <option value='機械式停車設備'>機械式停車設備</option>
            <option value='汽車升降機'>汽車升降機</option>
            <option value='電梯'>電梯</option>
            <option value='貨梯'>貨梯</option>
            <option value='服務梯'>服務梯</option>        
        </select><input id='number' type="number" min="1"  style="width: 30%;" name="pro_num[]"></td>
            <td>保養費</td><td><input type="text" name="pro_price[]"></td>
            <td >責任</td><td><select name="pro_duty[]">
            <option value=''>選擇責任</option>
            <option value='半責'>半責</option>
            <option value='全責'>全責</option>
            <option value='附表全責'>附表全責</option>
            <option value='除外全責'>除外全責</option>
        </select>
            <input type="button" value="新增" id="addbt" onclick="addRow(1)">      
            </td>
                    </tr></table><br/>
			</span>
		</div>
		<div class="content" id="work">
			<span class='poetry'>
				<table border="1" id="Contact" class="table table-bordered">
                <tr><td>主委</td><td colspan="2"><input type="text" name="zhu_name"></td>
            <td>電話</td><td colspan="2"><input type="text" name="zhu_phone"></td>
        </tr>
        <tr><td>其他聯絡方式</td><td colspan="5"><textarea name="zhu_conn"></textarea></td>
        </tr>
        <tr><td>財委</td><td colspan="2"><input type="text" name="cai_name"></td>
            <td>電話</td><td colspan="2"><input type="text" name="cai_phone"></td>
        </tr>
        <tr><td>其他聯絡方式</td><td colspan="5"><textarea name="cai_conn"></textarea></td>
        </tr>
        <tr><td>監委</td><td colspan="2"><input type="text" name="jian_name"></td>
            <td>電話</td><td colspan="2"><input type="text" name="jian_phone"></td>
        </tr>
        <tr><td>其他聯絡方式</td><td colspan="5"><textarea name="jian_conn"></textarea></td>
        </tr>
        <tr><td>總幹事</td><td colspan="2"><input type="text" name="ganshi_name"></td>
            <td>電話</td><td colspan="2"><input type="text" name="ganshi_phone"></td>
        </tr>
        <tr><td>其他聯絡方式</td><td colspan="5"><textarea name="ganshi_conn"></textarea></td>
        </tr>
        <tr><td>管理員</td><td colspan="2"><input type="text" name="admin_name"></td>
            <td>電話</td><td colspan="2"><input type="text" name="admin_phone"></td>
        </tr>
        <tr><td>其他聯絡方式</td><td colspan="5"><textarea name="admin_conn"></textarea></td>
        </tr>
    
        <tr><td>其他負責人</td><td colspan="2"><input type="text" name="other_name[]"></td>
            <td>電話</td><td colspan="2"><input type="text" name="other_phone[]"></td>
        </tr>
        <tr><td>其他聯絡方式</td><td colspan="5"><textarea name="other_conn[]"></textarea><input type="button" value="新增" onclick="addRow(2)"></td>
        </tr>
        </table><br/>
			</span>
		</div>
		<div class="content" id="social">
			<span class='poetry'>
				<table border="1" class="table table-bordered">
                <tr><td>收款方式</td><td colspan="6"><textarea name="payment"></textarea></td>
        </tr>
         <tr><td>統編</td><td colspan="2"><input type="text" name="editor"></td>
            <td>發票</td><td colspan="2"><select name="invoice">
            <option value='無'>選擇發票類型</option>
            <option value='二聯式'>二聯式</option>
            <option value='三聯式'>三聯式</option>
        </select></td>
        </tr>
        <tr><td>備註</td><td colspan="6"><textarea name="c_note"></textarea></td>
        </tr>
        <tr><td>平面圖</td><td colspan="6"><input type="file" ></td>
        </tr>
                </table>
                <button type="submit" id="submit" name="insert" class='btn btn-primary'>新增</button>
			</span>
        </div>
          
        </form> 
        </div>
	<!--div style="clear: both;"></div-->
	<div style="text-align: center;">
			<button id="previous_step" class='btn btn-secondary'>上一步</button>
			<button id="next_step" class='btn btn-secondary'>下一步</button>
            
	</div>
    </div></main></div></div>
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->  
<script src="../js/scripts.js"></script>    
</body>
</html>