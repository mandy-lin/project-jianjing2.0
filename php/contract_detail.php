<?php
include("mysql_connect.php");
$id=$_GET["id"];
$data2=mysqli_query($con,"SELECT * FROM `contract` con  where con.con_no like $id");
while ($rs=mysqli_fetch_array($data2)){ $c_no=$rs["c_no"];}

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
function editdata(){
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
}
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
            },function(isConfirm){
               if (isConfirm) {
            swal({
                url:location.href='contract_enddetail.php?id=<?php echo $c_no;?>'
     });
     } 
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
              <h3 class='mt-4'><i class="fas fa-file-signature"></i>保養合約</h3>  
<?php
$data=mysqli_query($con,"SELECT * FROM `contract` con  where con.con_no like $id");
while ($rs=mysqli_fetch_array($data)){
?>     
    <table border="1" id="myTable" class="table table-bordered">
    
        <tr><td>甲方</td>
            <td colspan="4"><input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs["con_name"];?>"></td></tr>
        <tr>
            <td>設備名稱</td>
            <td>日期</td>
            <td>數量</td>
            <td>單價</td>
            <td>總價</td>
        </tr>
<?php
$data1=mysqli_query($con,"SELECT * FROM `contract_content` content  where content.con_no like $id");
while ($rs1=mysqli_fetch_array($data1)){
?>         
        <tr><td>
        <input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs1["con_device"];?>"></td><td><input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs1["con_date"];?>"></td>
        <td><input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs1["con_num"];?>"></td>
        <td><input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs1["con_price"];?>"></td>
        <td><input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs1["con_total"];?>"></td> 
        </tr>
<?php }?>        
        <tr id="Total">
            <td>總金額</td>
            <td colspan="3"><input class="readonly" readonly="readonly"  style="border:none;outline:none;" id="total" value="<?php echo $rs["con_total_amount"];?>"></td>
            <td colspan="1"><?php echo $rs["con_tax"];?></td>
        </tr>
        <tr>
            <td>優惠總金額</td>
            <td colspan="4"><input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs["con_prefer_total"];?>"></td>
        </tr>
        <tr>
            <td>實施日期</td>
            <td colspan="4"><input class="readonly" type="date" readonly="readonly" form="form1" style="border:inline" value='<?php echo $rs["start_date"];?>'>至<input class="readonly" type="date" readonly="readonly" form="form1" style="border:inline" value="<?php echo $rs["end_date"];?>"></td>
        </tr>
        <tr><td>保養次數</td><td colspan="4">
        <input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs["maintimes"];?>"></td></tr>
        <tr><td>責任</td><td colspan="4">
        <input class="readonly" readonly="readonly"  style="border:none;outline:none;" value="<?php echo $rs["duty"];?>"></td></tr>
        <tr><td>備註</td><td colspan="4"><textarea class="readonly" readonly="readonly" form="form1" style="border:inline"><?php echo $rs["con_note"];?></textarea></td>
        </tr>
        <tr><td>附表全責的圖</td><td colspan="4"><input id="con_img" name="con_img" type="file" class="readonly" style="display:none">
        <?php
        $st=$rs["con_img"];
        $str_sec=explode("/",$st);
        for($i=0;$i<=(count($str_sec)-2);$i++){
          echo "<a href='img_display.php?name=".$str_sec[$i]."' target='_blank'>";
          echo "<img  src='../img/".$str_sec[$i]."' width='500px' height='500px'></a>";
        }
        ?></td></tr>
        <tr><td>合約電子檔</td><td colspan="4"><input type="file" class="readonly" style="display:none"><a href="../file/<?php echo $rs['con_file'];?>" target="_blank"><?php echo $rs['con_file'];?></a></td></tr>
       
    </table>
    <form id="form1" name="form1" method="post" action="">
          <!--button id="edit"  name="edit" type="button" onClick="editdata()" style="display:inline" >編輯</button-->
        <button type="button" onclick="history.back()" class="btn btn-secondary">返回</button>  
        <!--button id="save"  name="save" type="sumbit"  style="display:none" class="btn btn-primary">儲存</button-->
          <button id="edit"  type="button"  style="display:inline" onclick="renew()" class="btn btn-danger">續約</button>
    </form><?php } ?>
    </div></main></div></div>    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../js/scripts.js"></script>    
</body>    
</html>