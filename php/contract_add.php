<?php
include("mysql_connect.php");
if(isset($_POST['insert'])){
date_default_timezone_set("Asia/Taipei");    
$cno=date("zB");

//圖片及檔案    
$index=1;
if ((@$_FILES['con_img']['name'][$key])!=NULL ){   
if (is_array($_FILES['con_img']['tmp_name'])){
foreach(@$_FILES['con_img']['tmp_name'] as $key => $tmp_name){
    $file_name=@$_FILES['con_img']['name'][$key];
    $file_tmp =@$_FILES['con_img']['tmp_name'][$key];
  $file_type= strrchr($file_name, ".");
    $newname=@$_POST['con_name']."合約附圖".$index.$file_type;
  $rename=rename($file_name,$newname);move_uploaded_file($tmp_name,"../img/".$newname);
    if($file_name==""){
      $imgname="";
      break;
    }else{
      $imgname=$imgname.$newname."/";
    }
    
    $index=$index+1;
}
}else{
    $file_name=@$_FILES['con_img']['name'];
    $file_tmp=@$_FILES['con_img']['tmp_name'];
    $file_type=strrchr($file_name, ".");
    $newname=@$_POST['con_name']."合約附圖".$index.$file_type;
    $rename=rename($file_name,$newname);
    move_uploaded_file($tmp_name,"../img/".$newname);
    if($file_name==""){
      $imgname="";
    }else{
      $imgname=$imgname.$newname."/";
    }
    }

$sname=@$_FILES['con_file']['name'];
if($sname==""){
  $snewname="";
}else{
  $stmp_name=@$_FILES['con_file']['tmp_name'];
  $sfile_type=strrchr($sname, ".");
  $snewname=@$_POST['con_name']."合約".substr($_POST['start_date'],0,4)."-".substr($_POST['end_date'],0,4).$sfile_type;
  $rename=rename($sname,$snewname);
  move_uploaded_file($stmp_name,"../file/".$snewname);
}}else{
    $imgname=NULL;
    $snewname=NULL;
}


$c_no=@$_POST['c_no'];
$con_name=@$_POST['con_name'];
$con_total_amount=@$_POST['con_total_amount'];    
$con_prefer_total=@$_POST['con_prefer_total'];    
$start_date=@$_POST['start_date'];    
$end_date=@$_POST['end_date'];    
$maintimes=@$_POST['maintimes'];    
$duty=@$_POST['duty'];    
$con_note=@$_POST['con_note'];    
//$con_img=@$_POST['con_img'];
//$con_file=@$_POST['con_file'];
//$con_tax=@$_POST['contax'];
    
//echo $_POST['contax'];
if(@$_POST['contax']=='未含稅'){
    $con_tax='未含稅';
}else{
    $con_tax='含稅';
}    
  
$query= mysqli_query($con,"INSERT INTO `contract`(`con_no`, `con_name`, `con_total_amount`, `con_prefer_total`, `start_date`, `end_date`, `maintimes`, `duty`, `con_note`, `con_img`, `con_file`, `con_tax`, `c_no`, `con_status`) VALUES ('$cno','$con_name','$con_total_amount','$con_prefer_total','$start_date','$end_date','$maintimes','$duty','$con_note','$imgname','$snewname','$con_tax',$c_no,'進行中')"); 

$con_device=@$_POST['con_device'];
$con_date=@$_POST['con_date'];   
$con_num=@$_POST['con_num'];   
$con_price=@$_POST['con_price'];   
$con_total=@$_POST['con_total'];
for ($i = 0; $i < count($con_device); $i++) { 
 
$query1=mysqli_query($con,"INSERT INTO `contract_content`( `con_no`,`con_device`, `con_date`, `con_num`, `con_price`, `con_total`) VALUES ($cno,'$con_device[$i]','$con_date[$i]','$con_num[$i]','$con_price[$i]','$con_total[$i]')"); 
    //echo $con_device[$i].$con_date[$i].$con_num[$i].$con_price[$i].$con_total[$i].$cno;
}
     
//include("contract_maintain.php");   

if($query1){
header('location:contract_add.php'); 
}else{ echo 'data nono'.mysqli_error($con);}


}
?>
<html>
<head>
<title>健璟內部管理系統</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css">
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>    
</head>

      
    

<script>
function addRow(r) {
  //增加一行
   $("#Total").before("<tr><td><select name='con_device[]'><option value=''>選擇設備</option><option value='機械式停車設備'>機械式停車設備</option><option value='汽車升降機'>汽車升降機</option><option value='乘客用電梯'>乘客用電梯</option><option value='油壓式貨梯'>油壓式貨梯</option><option value='貨梯昇降設備'>貨梯昇降設備</option><option value='電梯升降設備'>電梯升降設備</option></select></td><td><select name='con_date[]'><option value=''>選擇日期</option><option value='每月'>每月</option><option value='單月'>單月</option><option value='雙月'>雙月</option><option value='半年'>半年</option></select></td><td><input type='number' onchange='Sum(this)' name='con_num[]'></td><td><input type='number' onchange='Sum(this)' name='con_price[]'></td><td><input type='number' name='con_total[]'></td><td><button onclick='addRow(this)' id='add'>新增</button></td></tr>");
   $("#add").remove();

}
function deleteRow(r){
  var tab = document.getElementById("myTable");
    var i=r.parentNode.parentNode.rowIndex;
  //console.log(i);
    //alert(i);
    tab.deleteRow(i);
    var total=0;
    $('input[name="con_total[]"]').each(function(){
        total += parseInt($(this).val())
    });
    $('#total').attr("value",total);
    console.log('t',total);
}
function Sum(r){
    var i=r.parentNode.parentNode;
    var price=$(i).find('input[name="con_price[]"]').val();
    console.log('p',price);
    var amount=$(i).find('input[name="con_num[]"]').val();
    console.log('a',amount);
    var sum=price*amount;
    console.log('s',sum);
    $(i).find('input[name="con_total[]"]').attr("value",sum);
    
    var total=0;
    $('input[name="con_total[]"]').each(function(){
        total += parseInt($(this).val())
    });
    $('#total').attr("value",total);
    console.log('t',total);

}
//選擇客戶    
$(document).ready(function() {
    $('#clientname').editableSelect().on('select.editable-select', function (e, li) {
        console.log(li.text());
        console.log(li.val());
        $("#myTable").css('display','');
        $('#contractname').val(li.text());
        $('#c_no').val(li.val());
    });
});     

</script> 
  
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
              <h3 class='mt-4'><i class="fas fa-file-signature"></i>新增保養合約</h3>   
    
    

<div >    
<form method="post" enctype="multipart/form-data">
<?php
$data=mysqli_query($con,"SELECT * FROM `client`");
echo '<select id="clientname" >';    
for($i=1;$i<=mysqli_num_rows($data);$i++){
$rs=mysqli_fetch_array($data);
//echo $rs['c_no'];
//echo $rs['c_name'];
echo '<option value="'.$rs['c_no'].'">'.$rs['c_name'].'</option>';    
}
echo '</select>';    
?>
   
<input name="c_no" id="c_no" style="display:none ;">    
    <input type="button" value="新增客戶" onclick="location.href='client_add.php'">    
    <table  id="myTable" style="border:1px solid;display:none ;"  class="table table-bordered">
        <tr><td>甲方</td><td colspan="5"><input id="contractname" name="con_name" value="" style="border:0;outline:none;"></td>
        </tr>
        <tr><td>設備名稱</td><td>日期</td><td>數量</td><td>單價</td><td>總價</td><td></td>
        </tr>
        <tr><td>
        <select name="con_device[]">
            <option value=''>選擇設備</option>
            <option value='機械式停車設備'>機械式停車設備</option>
            <option value='汽車升降機'>汽車升降機</option>
            <option value='乘客用電梯'>乘客用電梯</option>
            <option value='油壓式貨梯'>油壓式貨梯</option>
            <option value='貨梯昇降設備'>貨梯昇降設備</option>
            <option value='電梯升降設備'>電梯升降設備</option>
        </select></td><td><select name="con_date[]">
            <option value=''>選擇日期</option>
            <option value='每月'>每月</option>
            <option value='單月'>單月</option>
            <option value='雙月'>雙月</option>
            <option value='半年'>半年</option>
        </select></td>
            <td><input type="number" onchange="Sum(this)" name="con_num[]"></td>
            <td><input type="number" onchange="Sum(this)" name="con_price[]"></td>
            <td><input type="number" name="con_total[]"></td><td><button onclick="addRow(this)" id="add">新增</button></td>
        </tr>
        <tr id="Total"><td>總金額</td><td colspan="3"><input type="number" id="total" name="con_total_amount"></td><td colspan="2"><input type="checkbox" name="contax" value="未含稅">未含稅</td>
        </tr>
        <tr><td>優惠總金額</td><td colspan="5"><input type="number" name="con_prefer_total"></td>
        </tr>
        <tr><td>實施日期</td><td colspan="5"><input type="date" name="start_date">至<input type="date" name="end_date"></td></tr>
        <tr><td>保養次數</td><td colspan="5">
        <select name="maintimes">
            <option value=''>選擇保養次數</option>
            <option value='每月1次'>每月1次</option>
            <option value='每月2次'>每月2次</option>
             <option value='2個月1次'>2個月1次</option>
            <option value='4個月1次'>4個月1次</option>
            <option value='半年1次'>半年1次</option>
            <option value='1年1次'>1年1次</option>
        </select></td></tr>
        <tr><td>責任</td><td colspan="5">
        <select name="duty">
            <option value=''>選擇責任</option>
            <option value='全責'>全責</option>
            <option value='半責'>半責</option>
             <option value='附表全責'>附表全責</option>
            <option value='除外全責'>除外全責</option>
        </select></td></tr>
        <tr><td>備註</td><td colspan="5"><textarea name="con_note"></textarea></td>
        </tr>
        <tr><td>附表全責的圖</td><td colspan="5"><input type="file" name="con_img[]" multiple /></td></tr>
        <tr><td>合約電子檔</td><td colspan="5"><input type="file" name="con_file"></td></tr>
        <tr><td colspan='6'><button type="submit" name="insert" id="insert" class="btn btn-primary">新增</button></td></tr>
    </table>
    </form>
    </div>   
    
    </div></main></div></div>
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->  
<script src="../js/scripts.js"></script>    
</body>    
</html>