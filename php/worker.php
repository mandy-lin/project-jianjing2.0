<?php
include("mysql_connect.php");
//新增零件
if(isset($_POST['save'])){
$new_w_name=@$_POST['new_w_name'];
$w_name=@$_POST['w_name'];
$w_id=@$_POST['w_id'];
 
   
if($new_w_name[0]!=""){
 for ($i=0;$i<count($new_w_name); $i++){
$query1=mysqli_query($con,"INSERT INTO `worker`( `w_name`) VALUES ('$new_w_name[$i]')");
}}

//更新零件
if ($w_name[0]!=""){
for ($i=0;$i<count($w_name); $i++){
$up=mysqli_query($con,"UPDATE `worker` SET `w_name`=$w_name[$i] WHERE w_id=$w_id[$i]"); 
}}
}


?>
<html>
<head>
<title>健璟內部管理系統</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<meta charset="utf-8">
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>     
    
<script>
function edit(b){
  if ($("#editbutton").prop("style")){
    $("#addnewcom").show();
    $(".deletebt").show();
    $(".editable").removeAttr("readonly");
    $(".editable").removeAttr("style","border-style:none;");
    $("#editbutton").attr("style","display:none;");
    //$("#editbutton").remove();  
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
$("table#newthing tr:last").after("<tr><td class='input-group'>姓名：<input name='new_w_name[]' type='text' class='form-control'><div class='input-group-append'><button id='add' type='button' onclick='addrow(this)' class='btn btn-primary'><i class='fas fa-plus'></i></button></div></td></tr>");
}
//刪除
function delectRow(r){   
    var tr=r.parentNode.parentNode;
    var tbody=tr.parentNode;
    console.log(r.value);
    console.log(tbody);    
    tbody.removeChild(tr);
};  
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
            
<form method="post" enctype="multipart/form-data">
    <h3 class='mt-4'><i class="fas fa-hard-hat"></i>服務人員<button type="button" id="editbutton" onclick="edit()" class="btn btn-primary"><i class="fas fa-edit"></i></button><button name="save" id="save" type="submit"  style="display:none;" class="btn btn-primary"><i class="far fa-save"></i></button></h3>
<?php
$data1=mysqli_query($con,"SELECT * FROM `worker`"); 

while ($rs1=mysqli_fetch_array($data1)){
?>    
<table>
    <tr><td>
    <div class="input-group"><input name="w_name[]" class='editable form-control' type="text" style="border-style:none" readonly="readonly" value="<?php echo $rs1['w_name'];?>">
        <input type="text" style="display:none" name="w_id[]" value="<?php echo $rs1['w_id'];?>" >
        <div class="input-group-append">
            <button class='deletebt btn btn-danger' style="display:none" onclick="location.href='del.php?id=<?php echo $rs1['w_id']; ?>'" ><i class="fas fa-times"></i>
            </button>
        </div>
        </div>
    </td></tr>
</table>
<?php } ?>
<input type="button" id="addnewcom" onclick="adddiv()" style="display:none" value="新增服務人員" name="addnewcom" class="btn btn-secondary">
<div id="newcom" style="display:none">
<h4>新增服務人員</h4>
<table id="newthing">
  <tr>
    <td class="input-group">姓名：<input name="new_w_name[]" type="text" class="form-control">
        <div class="input-group-append">
            <button id="add" type="button" onclick="addrow(this)" class="btn btn-primary"><i class="fas fa-plus"></i></button>
        </div>    
    </td>
  </tr>

</table>
</div>
</form>    
  
 </div></main></div></div>     
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="../js/scripts.js"></script>    
</body>    
</html>