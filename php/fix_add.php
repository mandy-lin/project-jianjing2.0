<?php 
include("mysql_connect.php");
if(isset($_POST['insert'])){
    //新增圖檔 
    $date=substr(date("ymd"),0,7);
    $c_no=@$_POST['c_no'];
    $cname=mysqli_query($con,"SELECT c_name FROM `client` where c_no='$c_no'");
    while($con_name=mysqli_fetch_array($cname)){
        $c_name=$con_name['c_name'];
    }
    //$con_name=mysqli_fetch_array($cname);  
    $index=1;
  
foreach(@$_FILES['f_img']['tmp_name'] as $key => $tmp_name){
    $file_name=@$_FILES['f_img']['name'][$key];
    $file_tmp =@$_FILES['f_img']['tmp_name'][$key];
    $file_type=strrchr($file_name, ".");
    $newname=$date.$c_name."維修圖".$index.$file_type;
    $rename=rename($file_name,$newname);move_uploaded_file($tmp_name,"../img/".$newname);
    if($file_name==""){
      $imgname="";
      break;
    }else{
      $imgname=$imgname.$newname."/";
    }
    
    $index=$index+1;
}
    
    
    date_default_timezone_set("Asia/Taipei");
    $f_no=date("zB");
    $f_date=@$_POST['f_date'];
    $f_device=@$_POST['f_device'];
    $pro_kind=@$_POST['pro_kind'];
    $f_situation=@$_POST['f_situation'];
    $f_reason=@$_POST['f_reason'];
    $f_person1=@$_POST['f_person1'];
    $f_person2=@$_POST['f_person2'];
    $f_content=@$_POST['f_content'];
    $f_detail=@$_POST['f_detail'];
    $f_price=@$_POST['f_price'];
    $f_note=@$_POST['f_note'];
    $f_c_no=@$_POST['f_c_no'];
    $f_co_no=@$_POST['f_co_no'];
    $c_no=@$_POST['c_no'];
    $pro_no=@$_POST['pro_no'];
    $pro_kind=@$_POST['pro_kind'];
    $f_snum=@$_POST['f_snum'];
    $f_snuma=@$_POST['f_snuma'];
    $com_no=@$_POST['com_no'];
    
    $save=mysqli_query($con,"INSERT INTO `fix` (`f_no`,`f_date`,`f_device`,`f_situation`, `f_reason`,`f_person1`,`f_person2`,`f_img`,`c_no`) VALUES ('$f_no','$f_date','$pro_kind','$f_situation','$f_reason','$f_person1','$f_person2','$imgname','$c_no');");
    //print_r($_POST['c_no']);
    for ($z = 0; $z < count($f_content); $z++) {
    $content=mysqli_query($con,"INSERT INTO `fix_content` (`f_content`,`f_snum`, `f_no`,`pro_no`) VALUES ('$f_content[$z]','$f_snum[$z]','$f_no','$pro_no');");
    }

    for ($y = 0; $y < count($f_detail); $y++) {
    $components=mysqli_query($con,"INSERT INTO `fix_components` (`f_no`,`f_snuma`, `f_detail`, `f_price`, `f_note`, `com_no`) VALUES ('$f_no','$f_snuma[$y]','$f_detail[$y]','$f_price[$y]','$f_note[$y]', '$com_no');");
    }
    
/*if($save ){
echo 'a';
//header('location:maintain_list.php'); 
}else{ echo 'data nono'.mysqli_error($con);}*/ 
}

?>
<html>
<head>
<title>健璟內部管理系統</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<meta charset="utf-8">
<link rel="stylesheet" href="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css">
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>    
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>     

<script>    
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
        
 
     console.log($('#c_no').val());
    
        $(document).on('change', '#pro_kind', function(){
   var pro_kind = $('#pro_kind :selected').val();//注意:selected前面有個空格！
   
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
          $("select[name='f_snum[]']").html(res);
          $("select[name='f_snuma[]']").html(res);
          //document.getElementsByName("f_snuma").html(res);
         //處理回吐的資料
      }
   })//end ajax
 });
     });  
});
//

//新增項目
function addRow(r) {
   if (r==1){
    $("#components").before("<tr><td><select  name='f_snum[]' form='form1'></select></td><td colspan='4'><input name='f_content[]' type='text' form='form1' style='border:0px;outline:none;'></td></tr>");
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
          $("select[name='f_snum[]']").html(res);
         //$("select[name='f_snuma[]']").html(res);
          //document.getElementsByName("f_snuma").html(res);
         //處理回吐的資料
      }
   })//end ajax
}else if(r==2){
     $("#staff").before("<tr><td><select  name='f_snuma[]' form='form1'></select></td><td> <input type='text' name='f_detail[]' form='form1' style='border:0px;outline:none;' ></td><td><input type='number'  name='f_price[]'  form='form1' style='border:0px;outline:none;' ></td><td><input class='readonly' name='f_note[]'  form='form1' style='border:0px;outline:none;' ></td></tr>");} 
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
          $("select[name='f_snuma[]']").html(res);
         //$("select[name='f_snuma[]']").html(res);
          //document.getElementsByName("f_snuma").html(res);
         //處理回吐的資料
      }
   })//end ajax
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
              <h3 class='mt-4'><i class="fas fa-wrench"></i>新增維修單</h3>

<?php
$data=mysqli_query($con,"SELECT * FROM `client`");
echo '<select id="clientname" >';    
for($i=1;$i<=mysqli_num_rows($data);$i++){
$cl=mysqli_fetch_array($data);
echo '<option value="'.$cl['c_no'].'">'.$cl['c_name'].'</option>';    
}
echo '</select>';    
?>
    <input name="c_no" id="c_no" form="form1" style="display:none;"> 
    <table border="1" id="myTable" style="border:1px solid;display:none;" class="table table-bordered">
        <tr>
        <td><?php 
                  $data1=mysqli_query($con,"SELECT * FROM `client` c JOIN product p on(c.c_no=p.c_no)");
             ?>
            <input id="contractname" value="" style="border:0;outline:none;"></td>
            <td><select id="pro_kind" name="pro_kind" form="form1">
            <option value=''>選擇產品</option>
            </select></td>
       
        <td>維修日期</td><td colspan="2"><input name="f_date" type="date" form="form1"></td>
        </tr>
        
        <tr><td>故障情形</td><td colspan="4"><textarea name="f_situation" form="form1"></textarea></td></tr>
        
         <tr><td>故障原因</td><td colspan="4"><textarea name="f_reason" form="form1"></textarea></td></tr>
        
        <tr><td colspan="5" style="text-align: center;">維修內容<button onclick="addRow(1)">新增維修內容項目</button></td></tr>
        <tr>
            <td><select id="re_number" name="f_snum[]" form="form1" >
            </select>
            </td><td colspan="4">
            <input type="text" style="width: 100%" name="f_content[]" form="form1"></td>
        </tr>

        <tr id="components">    
        <td colspan="5" style="text-align: center;">更新零件<button onclick="addRow(2)">新增更新零件項目</button></td></tr>
        <tr><td colspan="2">內容</td><td>價格</td><td>備註</td></tr>
        <tr><td><select id="re_numcom" name="f_snuma[]" form="form1">      
            </select>
            </td><td>
            <input type="text" name="f_detail[]" form="form1"></td>
            <td><input type="number" name="f_price[]" form="form1"></td>
            <td><input name="f_note[]" form="form1"></td></tr>
       
        <tr id="staff"><td>服務人員</td>
        <td colspan="4">
            <?php
            $worker=mysqli_query($con,"SELECT w_name FROM `worker`"); 
            $worker1=array();
            for($i=1;$i<=mysqli_num_rows($worker);$i++){
                $w=mysqli_fetch_array($worker); 
                array_push($worker1, $w["w_name"]);
            } 
            
            echo "<select name='f_person1' form='form1'>"; 
            for($z=0;$z<count($worker1);$z++){
                    $v=$worker1[$z];   
                    echo "<option value='$v'";
                    echo ">$v</option>";}
                    echo "</select>";
            
            echo "<select name='f_person2' form='form1'>"; 
            for($z=0;$z<count($worker1);$z++){
                    $v=$worker1[$z];   
                    echo "<option value='$v'";
                    echo ">$v</option>";}
                    echo "</select>";
            
            ?> 
        </td>
        </tr>
    
        <tr><td>維修圖</td><td colspan="4"><input type="file" name="f_img[]" form="form1" multiple /></td></tr>
        <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
            <tr><td colspan="4"><button type="submit" id="insert" name="insert" class="btn btn-primary">新增</button></td></tr>
        </form>
    </table>

    </div>
    </main></div></div>          

<script src="../js/scripts.js"></script>    
</body>    
</html>