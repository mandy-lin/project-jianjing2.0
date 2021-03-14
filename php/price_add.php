<?php
include("mysql_connect.php");
if(isset($_POST['insert'])){
date_default_timezone_set("Asia/Taipei");

 

  
   
/*$today=date("d").'1'.date("m").'1'.date("y");
$today1 = intval($today);    
$pid = mysqli_query($con,"SELECT `p_no` FROM `price` WHERE p_no like '$today1%'");
$cou=0;
    
while ($rs=mysqli_fetch_array($pid)){
   $cou=$cou+1; 
}

$p_no=date("d").'1'.date("m").'1'.date("y").($cou+1);*/

   
    
$pno=date("zB");


$p_tax= @$_POST['p_tax'];
$c_no= @$_POST['c_no'];    
$p_date= @$_POST['p_date'];
$p_status= @$_POST['p_status'];
$p_total_amount= @$_POST['p_total_amount'];
$p_prefer_total= @$_POST['p_prefer_total'];
$p_note= @$_POST['p_note'];
$p_contont= @$_POST['p_contont'];
$pro_kind= @$_POST['pro_kind'];


//報價流水號      
$Arr=array("A"=>"機械式停車設備","B"=>"汽車升降機","C"=>"電梯","D"=>"貨梯","E"=>"服務梯");
$key = array_search($pro_kind,$Arr);
$a=$key.date("m");  
$pid = mysqli_query($con,"SELECT `p_num` FROM `price` WHERE p_num like '$a%'");
$cou='0'; 
while ($rs=mysqli_fetch_array($pid)){
   $cou=$cou+1; 
}
$value = str_pad($cou+1,2,'0',STR_PAD_LEFT);
$p_num=$a.$value;
//echo $p_num;   
    
    
//echo $_POST['p_tax'];
if(@$_POST['p_tax']=='未含稅'){
    $p_tax='未含稅';
}else{
    $p_tax='含稅';
}    


    
$query= mysqli_query($con,"INSERT INTO `price`( `p_no`,`p_num`,`p_date`, `p_status`, `p_kind`, `p_total_amount`, `p_prefer_total`, `p_tax`, `p_note`, `p_contont`, `c_no`) VALUES ('$pno','$p_num','$p_date','$p_status','$pro_kind','$p_total_amount','$p_prefer_total','$p_tax','$p_note','$p_contont',$c_no)"); 

$p_snum=@$_POST['p_snum'];    
$p_device=@$_POST['p_device'];
$p_num=@$_POST['p_num'];   
$p_price=@$_POST['p_price'];   
$p_total=@$_POST['p_total'];   

for ($i = 0; $i < count($p_device); $i++) {     
$query1=mysqli_query($con,"INSERT INTO `price_content`( `p_snum`, `p_device`, `p_num`, `p_price`, `p_total`, `p_no`) VALUES ('$p_snum[$i]','$p_device[$i]','$p_num[$i]','$p_price[$i]','$p_total[$i]','$pno')"); 
   // echo $p_snum[$i].$p_device[$i].$p_num[$i].$p_price[$i].$p_total[$i];
}
     
   

if($query){
//header('location:contract_add.php'); 
}else{ echo 'data nono'.mysqli_error($con);
}
}
?>
<html>
<head>
<title>健璟內部管理系統</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css">
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>      
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>  
    
<script>
function addRow(r) {
    $('#add').remove();
   $("#Total").before("<tr><td><select id='re_number' name='p_snum[]' ></select><input type='text' name='p_device[]'></td><td><input type='number' onchange='Sum(this)' name='p_num[]'></td><td><input type='number' onchange='Sum(this)' name='p_price[]'></td><td><input type='number' name='p_total[]'><input type='button' id='add' onclick='addRow(this)' value='新增'></td></tr>");
    var pro_kind = $('#pro_kind :selected').val();//注意:selected前面有個空格！
   var c_no =$('#c_no').val();
   $.ajax({
      url:"deal_num.php",				
      method:"POST",
      data:{
         pro_kind:pro_kind,
          c_no:c_no
      },					
      success:function(res){
          console.log(res);
          //document.getElementsByName("f_snum").
          $("select[name='p_snum[]']").html(res);
         //$("select[name='f_snuma[]']").html(res);
          //document.getElementsByName("f_snuma").html(res);
         //處理回吐的資料
      }
   })//end ajax
}
//新增一行
function deleteRow(r){
  var tab = document.getElementById("myTable");
    var i=r.parentNode.parentNode.rowIndex;
    tab.deleteRow(i);
    var total=0;
    $('input[name="p_total[]"]').each(function(){
        total += parseInt($(this).val())
    });
    $('#total').attr("value",total);
    console.log('t',total);
}
//加總
function Sum(r){
    var i=r.parentNode.parentNode;
    var price=$(i).find('input[name="p_price[]"]').val();
    
    console.log('p',price);
    var amount=$(i).find('input[name="p_num[]"]').val();
    console.log('a',amount);
    var sum=price*amount;
    console.log('s',sum);
    $(i).find('input[name="p_total[]"]').attr("value",sum);
    
    var total=0;
    $('input[name="p_total[]"]').each(function(){
        total += parseInt($(this).val())
    });
    $('#total').attr("value",total);
    console.log('t',total);
}
//選擇客戶    
$(document).ready(function() {
    $('#clientname').editableSelect().on('select.editable-select', function (e, li) {
        console.log(li.text());
        $("#myTable").css('display','');
        $('#contractname').val(li.text());
        $('#c_no').val(li.val());
        
            var c_no = li.val();//注意:selected前面有個空格！ 客戶產品
   $.ajax({
      url:"deal.php",				
      method:"POST",
      data:{
         c_no:c_no
      },					
      success:function(res){
          console.log(res)
          $('#pro_kind').html(res);
         //處理回吐的資料
      }
   })//end ajax 
        
        
        $(document).on('change', '#pro_kind', function(){
    //alert('a');
   var pro_kind = $('#pro_kind :selected').val();//注意:selected前面有個空格！
     //var c_no = $('#clientname :selected').val();
    console.log(pro_kind);
   $.ajax({
      url:"deal_num.php",				
      method:"POST",
      data:{
         pro_kind:pro_kind,
          c_no:c_no
      },					
      success:function(res){
          console.log(res)
          $('#re_number').html(res);
         //處理回吐的資料
      }
   })//end ajax
});
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
              <h3 class='mt-4'><i class="fas fa-hand-holding-usd"></i>新增報價單</h3>
<?php
$data=mysqli_query($con,"SELECT * FROM `client`");
echo '<select id="clientname" >';    
for($i=1;$i<=mysqli_num_rows($data);$i++){
$rs=mysqli_fetch_array($data);
echo '<option value="'.$rs['c_no'].'">'.$rs['c_name'].'</option>';    
}
echo '</select>';    
?>
<form method="post" enctype="multipart/form-data">   
<input name="c_no" id="c_no" style="display:none ;"> 
    <table border="1" id="myTable" style="display: none;" class="table table-bordered">
        <tr>
        <td>報價日期</td><td><input type="date" name="p_date"></td>
        <td>狀態</td><td><select name="p_status">
            <option value='未送出'>未送出</option>
            <option value='已送出'>已送出</option>
            <option value='已簽回'>已簽回</option>
            </select>
        </td>
        </tr>
        <tr>
        <td>大樓名稱</td><td><input id="contractname" value="" readonly="readonly" style="border:0px;outline:none;"></td><td>設備名稱</td><td><select id="pro_kind" name="pro_kind" >
            <option value=''>選擇產品</option>
            </select></td>
        </tr>
        <tr><td>報價內容</td>
            <td>數量</td>
            <td>單價</td>
            <td>總價</td>
        </tr>
        <tr><td>
            <select id='re_number' name='p_snum[]' >
            </select><input type="text" name="p_device[]"></td>
            <td><input type="number" onchange="Sum(this)" name="p_num[]"></td>
            <td><input type="number" onchange="Sum(this)" name="p_price[]"></td>
            <td><input type="number" name="p_total[]"><input type="button" id="add" onclick="addRow(this)" value="新增"></td>
        </tr>
        <tr id="Total">
        <td >總金額</td>
        <td colspan="3"><input type="number" id="total" name="p_total_amount"><input type="checkbox" name="p_tax" value="未含稅">未含稅</td>
        </tr>
        <tr>
        <td>優惠總金額</td><td  colspan="4"><input type="number" name="p_prefer_total"></td>
        </tr>
        <tr><td>備註</td><td colspan="4" ><textarea name="p_note"></textarea></td></tr>
        <tr><td colspan="5"><textarea style="border:0;outline:none;resize : none;width:100%;height:200px;" name="p_contont">一、本報價單有效期限10天。
二、更新之零組件均享有一年保固服務。
三、上列報價之內容為現場之缺失，為維護設備使用之安全，建議管委會、設備所有權人同意予以修繕，以避免因零件故障老化導致損害。
四、付款方式：完工驗收以現金支付。
五、經辦人:
六、如同意施工請簽名確認後，傳真或寄回本公司，以便本公司作業，謝謝!
   公司地址:台中市太平區長安路233巷6號
   電　　話:(04)2391-3013
   傳　　真:(04)2391-3010
                </textarea>
            </td>
        </tr>
        <tr><td colspan="5"><input type="submit" name="insert" value="新增"></td></tr>
    </table>
    </form>    
 
    </div></main></div></div>
<script src="../js/scripts.js"></script>   
</body>    
</html>