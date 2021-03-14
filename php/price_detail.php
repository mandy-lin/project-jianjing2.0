<?php
include("mysql_connect.php");
$id=$_GET["id"];

if (isset($_POST['save'])){

/*print 'id';print_r(@$_POST['p_id']);
print '編號';print_r(@$_POST['p_snum1']);
print '設備';print_r(@$_POST['p_device1']); 
print '數量';print_r(@$_POST['p_num1']);   
print '單價';print_r(@$_POST['p_price1']);   
print '總價';print_r(@$_POST['p_total1']);
 
echo $_POST['p_date'];
echo $_POST['p_total_amount'];
echo $_POST['p_prefer_total'];
echo $_POST['p_note'];
echo $_POST['p_contont'];*/    

   
$p_date= @$_POST['p_date'];
$p_total_amount= @$_POST['p_total_amount'];
$p_prefer_total= @$_POST['p_prefer_total'];
$p_note= @$_POST['p_note'];
$p_contont= @$_POST['p_contont'];

//update
$p_id=@$_POST['p_id'];
$p_snum=@$_POST['p_snum'];
$p_device=@$_POST['p_device']; 
$p_num=@$_POST['p_num'];   
$p_price=@$_POST['p_price'];   
$p_total=@$_POST['p_total'];
//insert    
$p_snum1=@$_POST['p_snum1'];
$p_device1=@$_POST['p_device1']; 
$p_num1=@$_POST['p_num1'];   
$p_price1=@$_POST['p_price1'];   
$p_total1=@$_POST['p_total1'];    
    
$update=mysqli_query($con,"UPDATE `price` SET `p_date`='$p_date',`p_total_amount`='$p_total_amount',`p_prefer_total`='$p_prefer_total',`p_note`='$p_note',`p_contont`='$p_contont' WHERE p_no='$id'"); 

for ($i = 0; $i < count($p_id); $i++) {    
$update1=mysqli_query($con,"UPDATE `price_content` SET `p_snum`='$p_snum[$i]',`p_device`='$p_device[$i]',`p_num`='$p_num[$i]',`p_price`='$p_price[$i]',`p_total`='$p_total[$i]' WHERE p_id='$p_id[$i]'");     
}
if (isset($_POST['p_device1'])){    
for ($i = 0; $i < count($p_device1); $i++) {     
$query1=mysqli_query($con,"INSERT INTO `price_content`( `p_snum`, `p_device`, `p_num`, `p_price`, `p_total`, `p_no`) VALUES ('$p_snum1[$i]','$p_device1[$i]','$p_num1[$i]','$p_price1[$i]','$p_total1[$i]',$id)");
} 
}
    
if($update ){
//header('location:contract_add.php');
//echo 'success';    
}else{ echo 'data nono'.mysqli_error($con);}
    
}else if (isset($_POST['send'])){
    //echo'送出';
    $update=mysqli_query($con,"UPDATE `price` SET `p_status`='已送出' WHERE p_no='$id'"); 
}else if (isset($_POST['confirm'])){
    //echo'確認';
        $update=mysqli_query($con,"UPDATE `price` SET `p_status`='已簽回' WHERE p_no='$id'");
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
//判斷狀態給button    
$(document).load('input#status', function() {
    var status=document.getElementById('status').value;
    console.log(status);
    if(status=="已簽回"){
       document.getElementById('edit').style.display = "none";
       //document.getElementById('back').style.display = "inline";
    }
});     
//編輯    
function editdata(){
      var edit_elements=document.getElementsByClassName("readonly")
      for (i=0;i<edit_elements.length;i++){
      edit_elements[i].removeAttribute("readonly");
      edit_elements[i].style="border:inline";
      edit_elements[i].removeAttribute("onclick");
      edit_elements[i].removeAttribute("disabled");
      edit_elements[i].style="display:inline";      
      
      };
    document.getElementById('add').style.display = "inline"; 
    document.getElementById('save').style.display = "inline";
    document.getElementById('edit').style.display = "none";
    var status=document.getElementById('status').value;
    console.log(status);
    if(status=="未送出"){
        document.getElementById('sent').style.display = "inline";
        document.getElementById('confirmed').style.display = "inline";    
    }else if(status=="已送出"){
        document.getElementById('confirmed').style.display = "inline";
    }
 }
//新增設備    
function addRow(r) {
   $("#Total").before("<tr><td><select id='re_number' name='p_snum1[]' form='form1'></select><input type='text' form='form1' name='p_device1[]'></td><td><input type='number' onchange='Sum(this)' form='form1' name='p_num1[]'></td><td><input type='number' onchange='Sum(this)' form='form1' name='p_price1[]'></td><td><input type='number' form='form1' name='p_total1[]'><button onclick='deleteRow(this)'>刪除</button></td></tr>"); 
     var pro_kind = $('#pro_kind').val();//注意:selected前面有個空格！
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
          $("select[name='p_snum1[]']").html(res);
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
    
    var price1=$(i).find('input[name="p_price1[]"]').val();
    console.log('p',price1);
    var amount1=$(i).find('input[name="p_num1[]"]').val();
    console.log('a',amount1);
    var sum1=price1*amount1;
    console.log('s',sum1);
    $(i).find('input[name="p_total1[]"]').attr("value",sum1);
    $('input[name="p_total1[]"]').each(function(){
        total += parseInt($(this).val())
    });
    

    $('#total').attr("value",total);
    console.log('t',total);
}      
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
              <h3 class='mt-4'><i class="fas fa-calculator"></i>報價單</h3> 
<?php
$data=mysqli_query($con,"SELECT * FROM `price` p join client c on(p.c_no=c.c_no) where p.p_no like $id");
while ($rs=mysqli_fetch_array($data)){
$c_no=$rs["c_no"];
$p_device=$rs["p_kind"];
?>             
    <table border="1" id="myTable" class="table table-bordered">
        <tr><input  style="display:none;" id="c_no" value="<?php echo $rs["c_no"]?>">
        <td>報價日期</td><td><input  type="date" class="readonly" readonly="readonly" form="form1" style="border:0PX;outline:none;" name="p_date" value="<?php echo $rs["p_date"]?>"></td>
        <td><?php echo $rs["p_num"]?></td><td><input id="status" readonly="readonly" style="border:0PX;outline:none;" name="p_status" value="<?php echo $rs["p_status"]?>"><!--未送出/已送出/已確認-->
        </td>
        </tr>
        <tr>
        <td>大樓名稱</td><td ><input class="readonly" readonly="readonly" style="border:0PX;outline:none;" value="<?php echo $rs["c_name"]?>" form="form1" ></td>
        <td>設備名稱</td><td><input type="text" readonly="readonly" form="form1" id="pro_kind" style="border:0px;outline:none;"  value="<?php echo $rs["p_kind"];?>"></td>    
        </tr>
        <tr>
            <td>設備名稱</td>
            <td>數量</td>
            <td>單價</td>
            <td>總價</td>
        </tr>
<?php
$data1=mysqli_query($con,"SELECT * FROM `price_content` content  where content.p_no like $id");
while ($rs1=mysqli_fetch_array($data1)){
?>         
        <tr>
            <td><input  readonly="readonly" style="border:0;outline:none;display:none;" form="form1" name="p_id[]" value="<?php echo $rs1["p_id"];?>">
            <!--input class="readonly" readonly="readonly" style="border:0;outline:none;" form="form1" name="p_snum[]" value="<?php //echo $rs1["p_snum"];?>"-->
            <?php 
                $snum=mysqli_query($con,"SELECT * FROM `client` c JOIN product p on(c.c_no=p.c_no) JOIN region r on(p.pro_no=r.pro_no) WHERE c.c_no = '$c_no' and p.pro_kind = '$p_device'");
                $snum1=array();
                while ($rd=mysqli_fetch_array($snum)){
                    array_push($snum1, $rd['re_number']);
                     
                }
                $rspsum=$rs1['p_snum'];
                echo "<select class='readonly' disabled='disabled' name='p_snum[]' form='form1'>";           if($rspsum=='全車區'){echo "<option value='$rspsum'>$rspsum</option>";}
                for($z=0;$z<count($snum1);$z++){
                    $v=$snum1[$z];   
                    echo "<option value='$v'";
                    echo ($rspsum==$v)?'selected':'';
                    echo ">$v</option>";}
                    echo "</select>"; //維修內容服務編號
            ?>    
                
            <input class="readonly" readonly="readonly" style="border:0;outline:none;" form="form1" name="p_device[]" value="<?php echo $rs1["p_device"];?>"></td>
            <td><input class="readonly" readonly="readonly" style="border:0;outline:none;" type="number" form="form1"  onchange="Sum(this)" name="p_num[]" value="<?php echo $rs1["p_num"];?>"></td>
            <td><input class="readonly" readonly="readonly" style="border:0;outline:none;" type="number" form="form1"  onchange="Sum(this)" name="p_price[]" value="<?php echo $rs1["p_price"];?>"></td>
            <td><input class="readonly" readonly="readonly" style="border:0;outline:none;" type="number"  form="form1"  name="p_total[]" value="<?php echo $rs1["p_total"];?>"><button onclick="addRow(this)" id="add" style="display:none;">新增</button></td>
        </tr>
<?php }?>        
        <tr id="Total">
        <td>總金額</td>
        <td colspan="3"><input class="readonly" readonly="readonly" style="border:0;outline:none;" type="number" form="form1" id="total" name="p_total_amount" value="<?php echo $rs["p_total_amount"]?>"><?php echo $rs["p_tax"]?></td>
        </tr>
        <tr>
        <td>優惠總金額</td><td colspan="3"><input class="readonly" readonly="readonly" style="border:0;outline:none;" type="number"  form="form1" name="p_prefer_total" value="<?php echo $rs["p_prefer_total"]?>"></td>
        </tr>
        <tr><td>備註</td><td colspan="3" ><textarea class="readonly" readonly="readonly" form="form1" style="border:0;outline:none;resize : none;" name="p_note"><?php echo $rs["p_note"]?></textarea></td></tr>
        <tr><td colspan="4">
                <textarea class="readonly" readonly="readonly" form="form1" style="border:0;outline:none;resize : none;width:100%;height:200px;" name="p_contont"><?php echo $rs["p_contont"]?>
                </textarea>
            </td>
        </tr>
        
    </table>
<?php }?>    
    <form id="form1" name="form1" method="post" action="">
          <button id="edit"  name="edit" type="button" onClick="editdata()" style="display:inline" class="btn btn-primary">編輯</button>
          <button id="save"  name="save" type="sumbit"  style="display:none" class="btn btn-primary">儲存</button>
          <button id="sent"  type="sumbit" name="send" style="display:none" class="btn btn-warning">已送至客戶</button>
          <button id="confirmed"  type="sumbit" name="confirm" style="display:none" class="btn btn-success">客戶已確認</button>
        <input type="button" onclick="history.back()" value="返回" class="btn btn-secondary">
    </form>
</div></main></div></div>
<script src="../js/scripts.js"></script>    
</body>    
</html>