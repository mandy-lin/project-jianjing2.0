<?php
include("mysql_connect.php");
$id=$_GET["id"];
if(isset($_POST['insert'])){
date_default_timezone_set("Asia/Taipei");
$cno=substr(date("ymdHis"),0,10);    
$c_no=@$_POST['c_no'];
$con_name=@$_POST['con_name'];
$con_total_amount=@$_POST['con_total_amount'];    
$con_prefer_total=@$_POST['con_prefer_total'];    
$start_date=@$_POST['start_date'];    
$end_date=@$_POST['end_date'];    
$maintimes=@$_POST['maintimes'];    
//$duty=@$_POST['duty'];    
$con_note=@$_POST['con_note'];    
$con_img=@$_POST['con_img'];
$con_file=@$_POST['con_file'];
//$con_tax=@$_POST['contax'];
    
//echo $_POST['contax'];
if(@$_POST['contax']=='未含稅'){
    $con_tax='未含稅';
}else{
    $con_tax='含稅';
}    
  
$query= mysqli_query($con,"INSERT INTO `contract`(`con_no`, `con_name`, `con_total_amount`, `con_prefer_total`, `start_date`, `end_date`, `maintimes`, `con_note`, `con_img`, `con_file`, `con_tax`, `c_no`) VALUES ('$cno','$con_name','$con_total_amount','$con_prefer_total','$start_date','$end_date','$maintimes','$con_note','$con_img','$con_file','$con_tax','$c_no')"); 

echo  $cno.$con_name.$c_no;   
$con_device=@$_POST['con_device'];
$con_date=@$_POST['con_date'];
$con_duty=@$_POST['con_duty'];     
$con_num=@$_POST['con_num'];   
$con_price=@$_POST['con_price'];   
$con_total=@$_POST['con_total'];
for ($i = 0; $i < count($con_device); $i++) { 
$query1=mysqli_query($con,"INSERT INTO `contract_content`( `con_no`,`con_device`, `con_date`, `con_duty`, `con_num`, `con_price`, `con_total`) VALUES ($cno,'$con_device[$i]','$con_date[$i]','$con_duty[$i]','$con_num[$i]','$con_price[$i]','$con_total[$i]')"); 
    echo $con_device[$i].$con_date[$i].$con_num[$i].$con_price[$i].$con_total[$i].$cno;
}
     
include("contract_maintain.php");   

if($query ){
header('location:contract_list.php'); 
}else{ echo 'data nono'.mysqli_error($con);}





    
}
?>
<html>
<head>
<title>健璟內部管理系統</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<meta charset="utf-8">
<script src="../dist/sweetalert.js"></script>
<link rel="stylesheet" href="../dist/sweetalert.css">
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>    
</head>

<script>
//編輯
/*function editdata(){
      var edit_elements=document.getElementsByClassName("readonly")
      for (i=0;i<edit_elements.length;i++){
      edit_elements[i].removeAttribute("readonly");
      edit_elements[i].style="border:inline";
      edit_elements[i].removeAttribute("onclick");
      edit_elements[i].removeAttribute("disabled");      
      };
      document.getElementById('save').style.display = "inline";
      document.getElementById('edit').style.display = "none";
 }
function addRow(r) {
   $("#Total").before("<tr><td><select><option value=''>選擇設備</option><option value='機械式停車設備'>機械式停車設備</option><option value='汽車升降機'>汽車升降機</option><option value='油壓式貨梯'>油壓式貨梯</option><option value='電梯'>電梯</option></select></td><td><select><option value=''>選擇日期</option><option value='每月'>每月</option><option value='單月'>單月</option></select></td><td><input type='number' onchange='Sum(this)' name='amount[]'></td><td><input type='number' onchange='Sum(this)' name='price[]'></td><td><input type='number' name='subtotal[]'></td><td><button onclick='addRow(this)' id='add'>新增</button></td></tr>");
   $("#add").remove();

}
function deleteRow(r){
  var tab = document.getElementById("myTable");
    var i=r.parentNode.parentNode.rowIndex;
  //console.log(i);
    //alert(i);
    tab.deleteRow(i);
    var total=0;
    $('input[name="subtotal[]"]').each(function(){
        total += parseInt($(this).val())
    });
    $('#total').attr("value",total);
    console.log('t',total);
}*/
function Sum(r){
    var i=r.parentNode.parentNode;
    var price=$(i).find('input[name="price[]"]').val();
    console.log('p',price);
    var amount=$(i).find('input[name="amount[]"]').val();
    console.log('a',amount);
    var sum=price*amount;
    console.log('s',sum);
    $(i).find('input[name="subtotal[]"]').attr("value",sum);
    
    var total=0;
    $('input[name="subtotal[]"]').each(function(){
        total += parseInt($(this).val())
    });
    $('#total').attr("value",total);
    console.log('t',total);

}
//續約
function renew(){
    //alert('1');
    swal({
        title: "要續約嗎?",
        text: "將會產生一份新的合約",
        type: "warning",
        showCancelButton: true,
        //confirmButtonClass: "btn-danger",
        confirmButtonText: "續約",
        cancelButtonText: "取消",
        closeOnConfirm: false,
        closeOnCancel: false
    },function(isConfirm) {
        if (isConfirm) {
            swal({
                title:"續_______約!", 
                text:"將會跳轉到續約頁面", 
                type:"success",
                url:location.href='contract_renew.php?id=<?php echo $id;?>'
        });
            
        } else {
            //swal("不再續約", "此客戶將會移失", "warning");
            swal({
                title: "不再續約?",
                text: "此客戶將會移失",
                type: "error",
                showCancelButton: true,
                //confirmButtonClass: "btn-danger",
                confirmButtonText: "不再續約",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                closeOnCancel: false
            })
        }
    });
};    
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
              <h3 class='mt-4'><i class="fas fa-file-signature"></i>續約</h3>
<form method="post" enctype="multipart/form-data">    
<?php
$data=mysqli_query($con,"SELECT * FROM `contract` con  where con.con_no like $id");
while ($rs=mysqli_fetch_array($data)){
?>     
    <table border="1" id="myTable" class="table table-bordered">
        <tr><td >甲方</td>
            <td colspan="5"><input class="readonly" readonly="readonly"  style="border:none;outline:none;" name="con_name" value="<?php echo $rs["con_name"];?>">
            <input name="c_no"  style="border:none;outline:none;display:none;" value="<?php echo $rs["c_no"];?>">
            </td></tr>
        <tr>
            <td>設備名稱</td>
            <td>日期</td>
            <td>責任</td>
            <td>數量</td>
            <td>單價</td>
            <td>總價</td>
        </tr>
<?php
$data1=mysqli_query($con,"SELECT * FROM `contract_content` content  where content.con_no like $id");
$device=['機械式停車設備','汽車升降機','乘客用電梯','油壓式貨梯','貨梯昇降設備','電梯升降設備','服務梯'];
$date=['每月','單月','雙月','半年'];
$duty=['全責','半責','附表全責','除外全責'];                                       
while ($rs1=mysqli_fetch_array($data1)){
//echo $rs1["con_device"];
echo "<tr><td>";
echo"<select name='con_device[]'>";
for ($i=0;$i<count($device);$i++){
    echo "<option value='$device[$i]'";
    echo ($device[$i]==$rs1['con_device'])?'selected':'';
    echo ">$device[$i]</option>";
}
echo"</select></td>" ;
echo"<td><select name='con_date[]'>";
for ($i=0;$i<count($date);$i++){
    echo "<option value='$date[$i]'";
    echo ($date[$i]==$rs1['con_date'])?'selected':'';
    echo ">$date[$i]</option>";
}
echo"</select></td>" ;
echo"<td><select name='con_duty[]'>";
for ($i=0;$i<count($duty);$i++){
    echo "<option value='$duty[$i]'";
    echo ($duty[$i]==$rs1['con_duty'])?'selected':'';
    echo ">$duty[$i]</option>";
}
echo"</select></td>" ;
echo"<td><input type='number' onchange='Sum(this)' name='con_num[]' value='$rs1[con_num]'></td><td><input type='number' onchange='Sum(this)' name='con_price[]' value='$rs1[con_price]'></td><td><input type=number name='con_total[]' value='$rs1[con_total]'></td>";    
echo "</tr>"; 
}
?>         

        <tr id="Total"><td>總金額</td><td colspan="3"><input type="number" id="total" name="con_total_amount" value='<?php echo $rs["con_total_amount"];?>'></td><td colspan="2"><input type="checkbox" name="contax" value="未含稅">未含稅</td>
        </tr>
        <tr><td>優惠總金額</td><td colspan="5"><input type="number" name="con_prefer_total" value='<?php echo $rs["con_prefer_total"];?>'></td>
        </tr>
        
        <tr>
            <td>實施日期</td>
            <td colspan="5"><input  type="date" name="start_date"  value='<?php echo $rs["start_date"];?>'>至<input  type="date"   value='<?php echo $rs["end_date"];?>' name="end_date"></td>
        </tr>
        <tr><td>保養次數</td><td colspan="5">
        
<?php
$times=['每月1次','每月2次','2個月1次','4個月1次','半年1次','1年1次'];
echo"<select name='maintimes'>";
for ($i=0;$i<count($times);$i++){
    echo "<option value='$times[$i]'";
    echo ($times[$i]==$rs['maintimes'])?'selected':'';
    echo ">$times[$i]</option>";
}
echo"</select>" ;                                      
?>    
            </td></tr>
        <!--tr><td>責任</td><td colspan="5">
        <input class="readonly" readonly="readonly"  style="border:none;outline:none;" value='<?php //echo $rs["duty"];?>'></td></tr-->
        <tr><td>備註</td><td colspan="5"><textarea name="con_note"><?php echo $rs["con_note"];?></textarea></td>
        </tr>
        <tr><td>附表全責的圖</td><td colspan="5"><input type="file" ></td></tr>
        <tr><td>合約電子檔</td><td colspan="5"><input type="file" ></td></tr>
       
    </table>

        <!--input type="button" onclick="history.back()" value="返回"-->  
        <input type="submit" name="insert" id="insert" value="續約" class="btn btn-primary">
    </form><?php } ?>
    </div></main></div></div>   
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../js/scripts.js"></script>        
</body>    
</html>