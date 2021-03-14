<?php
include("mysql_connect.php");
$id=$_GET["id"];
//儲存
if (isset($_POST['save'])){
    //新增圖檔
    $date=substr(date("ymd"),0,7);
    $c_no=@$_POST['c_no'];
    $cname=mysqli_query($con,"SELECT c_name FROM `client` where c_no='$c_no'");
    while($con_name=mysqli_fetch_array($cname)){
        $c_name=$con_name['c_name'];
    }
    $fimg=mysqli_query($con,"SELECT f_img FROM `fix` where f_no='$id'");
    while($fimg1=mysqli_fetch_array($fimg)){
        $fimg2=$fimg1['f_img'];
        $fimg3=explode("/",$fimg2);
        $fimg35=$fimg3[(count($fimg3)-2)];
        $fimg4=substr(strchr($fimg35,".",-1),-1);  
    }
    if ($fimg2==""){
      $index=1;
    }else{
      $index=((int)$fimg4)+1;
    }
    //if (isset($_POST['f_img']))
    if (is_array($_FILES['f_img']['tmp_name'])){
    foreach(@$_FILES['f_img']['tmp_name'] as $key => $tmp_name){
    $file_name=@$_FILES['f_img']['name'][$key];
    $file_tmp=@$_FILES['f_img']['tmp_name'][$key];
    $file_type=strrchr($file_name, ".");
    $newname=$date.$c_name."維修圖".$index.$file_type;
    $rename=rename($file_name,$newname);
    move_uploaded_file($tmp_name,"../img/".$newname);
    if($file_name==""){
      $fimg2=$fimg2;
      break;
    }else{
      $fimg2=$fimg2.$newname."/";
    }
    $index=$index+1;
    }
    }else{
    $file_name=@$_FILES['f_img']['name'];
    $file_tmp=@$_FILES['f_img']['tmp_name'];
    $file_type=strrchr($file_name, ".");
    $newname=$date.$c_name."維修圖".$index.$file_type;
    $rename=rename($file_name,$newname);
    move_uploaded_file($tmp_name,"../img/".$newname);
    if($file_name==""){
      $fimg2=$fimg2;
    }else{
      $fimg2=$fimg2.$newname."/";
    }
    }
    
    $f_date=@$_POST['f_date'];
    $f_situation=@$_POST['f_situation'];
    $f_reason=@$_POST['f_reason'];
    $f_content=@$_POST['f_content'];
    $f_detail=@$_POST['f_detail'];
    $f_price=@$_POST['f_price'];
    $f_note=@$_POST['f_note'];
    $f_person1=@$_POST['f_person1'];
    $f_person2=@$_POST['f_person2'];
    //$f_price1=@$_POST['f_price1'];
    $f_note1=@$_POST['f_note1'];
    $f_content1=@$_POST['f_content1'];
    $f_snum=@$_POST['f_snum'];
    $f_snum1=@$_POST['f_snum1'];
    $f_snuma=@$_POST['f_snuma'];
    $f_snuma1=@$_POST['f_snuma1'];
    
    
    $f_no=$_GET["id"];
    $f_c_no=@$_POST['f_c_no'];
    $f_co_no=@$_POST['f_co_no'];
    
    
    
    $save=mysqli_query($con,"UPDATE `fix` SET `f_date`='$f_date',`f_situation`='$f_situation',`f_reason`='$f_reason',`f_person1`='$f_person1',`f_person2`='$f_person2',`f_img`='$fimg2'  where `fix`.`f_no` ='$f_no'");
    
    for ($x = 0; $x < count($f_c_no); $x++) {
    $content=mysqli_query($con,"UPDATE `fix_content` SET `f_content` = '$f_content[$x]',`f_snum`='$f_snum[$x]' WHERE `fix_content`.`f_no` = '$f_no' and `fix_content`.`f_c_no` = '$f_c_no[$x]' "); 
    }
    
    for ($z = 0; $z < count($f_content1); $z++) {
    $content1=mysqli_query($con,"INSERT INTO `fix_content` (`f_content`,`f_snum`, `f_no`) VALUES ('$f_content1[$z]','$f_snum1[$z]','$id');");
    }
    
    for ($i = 0; $i < count($f_co_no); $i++) {
    $components=mysqli_query($con,"UPDATE `fix_components` SET `f_detail` = '$f_detail[$i]',`f_price` = '$f_price[$i]',`f_note` = '$f_note[$i]' ,`f_snuma`='$f_snuma[$i]' WHERE `fix_components`.`f_no` = '$f_no' and `fix_components`.`f_co_no` = '$f_co_no[$i]' ");  
    }
    
    for ($y = 0; $y < count($f_detail1); $y++) {
    $components1=mysqli_query($con,"INSERT INTO `fix_components` (`f_detail`, `f_price`, `f_note`, `f_snuma`, `f_no`) VALUES ('$f_detail1[$y]', '$f_price1[$y]', '$f_note1[$y]','$f_snuma1[$y]', '$id');");
    }
    //print_r($_POST['f_detail1']);
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
 <script>
  
function editdata(){
      var edit_elements=document.getElementsByClassName("readonly")
      for (i=0;i<edit_elements.length;i++){
      edit_elements[i].removeAttribute("readonly");
      edit_elements[i].style="border:inline";
      //edit_elements[i].removeAttribute("onclick");
      edit_elements[i].removeAttribute("disabled");  
      };
      $('input[name="f_img[]"]').show();
      document.getElementById('save').style.display = "inline";
      document.getElementById('edit').style.display = "none";
 }
     
//新增項目
function addRow(r) {
   if (r==1){
    $("#components").before("<tr><td><select  name='f_snum1[]' form='form1'></select></td><td colspan='4'><input name='f_content1[]' type='text' form='form1' style='border:0px;outline:none;'></td></tr>");
   var pro_kind = $('#pro_kind').val();//注意:selected前面有個空格！
   var c_no =$('#c_no').val();
   $.ajax({
      url:"deal_detail.php",				
      method:"POST",
      data:{
         pro_kind:pro_kind,
          c_no:c_no
      },					
      success:function(res){
          console.log(res);
          //document.getElementsByName("f_snum").
          $("select[name='f_snum1[]']").html(res);
         //$("select[name='f_snuma[]']").html(res);
          //document.getElementsByName("f_snuma").html(res);
         //處理回吐的資料
      }
   })//end ajax
}else if(r==2){
     $("#staff").before("<tr><td><select  name='f_snuma1[]' form='form1'></select></td><td> <input type='text' name='f_detail1[]' form='form1' style='border:0px;outline:none;' ></td><td><input type='number'  name='f_price1[]'  form='form1' style='border:0px;outline:none;' ></td><td><input class='readonly' name='f_note1[]'  form='form1' style='border:0px;outline:none;' ></td></tr>");} 
    var pro_kind = $('#pro_kind').val();//注意:selected前面有個空格！
   var c_no =$('#c_no').val();
   $.ajax({
      url:"deal_detail.php",				
      method:"POST",
      data:{
         pro_kind:pro_kind,
          c_no:c_no
      },					
      success:function(res){
          console.log(res);
          //document.getElementsByName("f_snum").
          $("select[name='f_snuma1[]']").html(res);
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
              <h3 class='mt-4'><i class="fas fa-hammer"></i>維修詳細</h3>  

<?php 
$data=mysqli_query($con,"SELECT c.c_no,f.f_no,f_date,f_device,f_situation,f_reason,f_person1,f_person2,f_img,c.c_name FROM `fix` f join client c on(f.c_no=c.c_no) where f.f_no ='$id'");
$fc=mysqli_query($con,"SELECT * FROM `fix_components` fc where fc.f_no ='$id' ");
$fco=mysqli_query($con,"SELECT * FROM `fix_content` fco where fco.f_no ='$id'");

while ($rs=mysqli_fetch_array($data)){
$c_no=$rs["c_no"];
$p_device=$rs["f_device"];     
?>

    <table border="1" id="myTable" class="table table-bordered">
        <tr><input  style="display:none;" id="c_no" value="<?php echo $rs["c_no"]?>">
        <td>設備名稱</td><td><input type="text" readonly="readonly" form="form1" style="border:0px;outline:none;"  value="<?php echo $rs["f_device"];?>" id='pro_kind'></td>
        <td>維修日期</td><td><input class="readonly" name="f_date" type="date" readonly="readonly" form="form1" style="border:0px;outline:none;" value="<?php echo $rs["f_date"];?>"></td>
        </tr>
        <tr><td>大樓名稱</td><td colspan="3"><input type="text" readonly="readonly" form="form1" style="border:0px;outline:none;"  value="<?php echo $rs["c_name"];?>"></td></tr>
        <tr><td>故障情形</td><td colspan="3"><textarea class="readonly" name="f_situation" readonly="readonly" form="form1" style="border:0px;outline:none;"><?php echo $rs["f_situation"];?></textarea></td></tr>
        <tr><td>故障原因</td><td colspan="3"><textarea class="readonly" name="f_reason" readonly="readonly" form="form1" style="border:0px;outline:none;"><?php echo $rs["f_reason"];?></textarea></td></tr>
        

        <tr><td colspan="5" style="text-align: center;">維修內容<button onclick="addRow(1)" class="readonly" disabled="disabled">新增維修內容項目</button></td></tr>
<?php
while ($ro=mysqli_fetch_array($fco)){
?>
        <tr>
         <td><?php 
                $snum=mysqli_query($con,"SELECT re_number FROM `client` c JOIN product p on(c.c_no=p.c_no) JOIN region r on(p.pro_no=r.pro_no) WHERE c.c_no = '$c_no' and p.pro_kind = '$p_device'");
                $snum1=array();
                while ($rd=mysqli_fetch_array($snum)){
                    array_push($snum1, $rd['re_number']);
                     
                }
                $rofsnum=$ro['f_snum'];
                echo "<select class='readonly' disabled='disabled' name='f_snum[]' form='form1'>";           if($rofsnum=='全車區'){echo "<option value='$rofsnum'>$rofsnum</option>";}                   
                for($z=0;$z<count($snum1);$z++){
                    $v=$snum1[$z]; 
                    echo "<option value='$v'";
                    echo ($rofsnum==$v)?'selected':'';
                    echo ">$v</option>";}
                    echo "</select>"; //維修內容服務編號
            ?>
            </td><td colspan="4">
            
            <textarea class="readonly" name="f_content[]" readonly="readonly" form="form1" style="border:0px;outline:none;"><?php echo $ro["f_content"];?></textarea>
            <input name="f_c_no[]" value="<?php echo $ro["f_c_no"];?>" form="form1" style="display:none;">
            </td>
        </tr>
<?php } ?>

       <tr id="components"><td colspan="5" style="text-align: center;">更新零件<button onclick="addRow(2)"  class="readonly" disabled="disabled">新增更新零件項目</button></td></tr>
        <tr><td colspan="2">內容</td><td>價格</td><td>備註</td></tr>
        <?php
        while ($rc=mysqli_fetch_array($fc)){
        ?>
        <tr><td>
            <?php 
                $snum=mysqli_query($con,"SELECT * FROM `client` c JOIN product p on(c.c_no=p.c_no) JOIN region r on(p.pro_no=r.pro_no) WHERE c.c_no = '$c_no' and p.pro_kind = '$p_device'");
                $snum1=array();
                while ($rd=mysqli_fetch_array($snum)){
                    array_push($snum1, $rd['re_number']);
                     
                }
                $rcfsnuma=$rc['f_snuma'];
                echo "<select class='readonly' disabled='disabled' name='f_snuma[]' form='form1'>";           if($rcfsnuma=='全車區'){echo "<option value='$rcfsnuma'>$rcfsnuma</option>";}
                for($z=0;$z<count($snum1);$z++){
                    $v=$snum1[$z];   
                    echo "<option value='$v'";
                    echo ($rcfsnuma==$v)?'selected':'';
                    echo ">$v</option>";}
                    echo "</select>"; //零件服務編號
            ?>
            
            </td>
            <td> <input type="text" class="readonly" name="f_detail[]" readonly="readonly" form="form1" style="border:0px;outline:none;" value="<?php echo $rc["f_detail"];?>"></td>
            <td><input type="number" class="readonly" name="f_price[]" readonly="readonly" form="form1" style="border:0px;outline:none;" value="<?php echo $rc["f_price"];?>"></td>
            <td><input class="readonly" name="f_note[]" readonly="readonly" form="form1" style="border:0px;outline:none;" value="<?php echo $rc["f_note"];?>">
            <input name="f_co_no[]" value="<?php echo $rc["f_co_no"];?>" form="form1" style="display:none;">
            </td>
        </tr>
<?php } ?>

         <tr id="staff"><td>服務人員</td><td colspan="3">
           <?php 
                $worker=mysqli_query($con,"SELECT w_name FROM `worker`"); 
                $worker1=array();
                for($i=1;$i<=mysqli_num_rows($worker);$i++){
                $w=mysqli_fetch_array($worker); 
                array_push($worker1, $w["w_name"]);
                } 
                echo "<select class='readonly' disabled='disabled' name='f_person1' form='form1'>";                               
                for($i=0;$i<count($worker1);$i++){
                    $v=$worker1[$i];   
                    echo "<option value='$v'";
                    echo ($rs['f_person1']==$v)?'selected':'';
                    echo ">$v</option>";}
                    echo "</select>";
        
                echo "<select class='readonly' disabled='disabled' name='f_person2' form='form1'>";                               
                for($i=0;$i<count($worker1);$i++){
                    $v=$worker1[$i];   
                    echo "<option value='$v'";
                    echo ($rs['f_person2']==$v)?'selected':'';
                    echo ">$v</option>";}
                    echo "</select>";
 
            ?>
        </td>
        </tr>

        <tr><td>維修圖</td><td colspan="3"><input name="f_img[]" form="form1" type="file" style="display:none" readonly="readonly" multiple />
         <?php
        $st=$rs["f_img"];
        $str_sec=explode("/",$st);
        for($i=0;$i<=(count($str_sec)-2);$i++){
          echo "<a href='img_display.php?name=".$str_sec[$i]."' target='_blank'>";
          echo "<img  src='../img/".$str_sec[$i]."' width='500px' height='500px'></a>";
        }
        ?>
        </td></tr>
    </table>
    <form id="form1" name="form1" method="post" enctype="multipart/form-data"  action="">
          <button id="edit"  name="edit" type="button" onClick="editdata()" style="display:inline" class="btn btn-primary">編輯</button>
          <button id="save" name="save" type="sumbit"  style="display:none" class="btn btn-primary">儲存</button>
        <input type="button" onclick="history.back()" value="返回" class="btn btn-secondary">
    </form>
    <?php } ?>
    </div></main></div></div> 
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../js/scripts.js"></script>        
</body>    
</html>