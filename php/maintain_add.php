<?php
include("mysql_connect.php");
$id=$_GET["id"];
if(isset($_POST['insert'])){

echo $_POST['m_date'];
echo $_POST['m_recode'].$_POST['m_recode1'];   
echo $_POST['m_suggest'];
echo $_POST['m_person_1'];
echo $_POST['m_person_2'];
   

$m_date= $_POST['m_date'];
$m_recode= $_POST['m_recode'].$_POST['m_recode1'];     
$m_suggest= $_POST['m_suggest'];
$m_person_1= $_POST['m_person_1'];
$m_person_2= $_POST['m_person_2'];

/*$insert= mysqli_query($con,"INSERT INTO `maintain`(`m_no`, `m_date`, `m_recode`, `m_suggest`, `m_person_1`, `m_person_2`, `m_img`, `m_status`, `c_no`) VALUES ('$mno','$m_date','$m_recode','$m_suggest','$m_person_1','$m_person_2','','','2004061550')");*/
$update= mysqli_query($con,"UPDATE `maintain` SET `m_date`='$m_date',`m_recode`='$m_recode',`m_suggest`='$m_suggest',`m_person_1`='$m_person_1',`m_person_2`='$m_person_2',`m_img`='',`m_status`='已填單' WHERE m_no=$id ");   
    
$m_c_1=@$_POST['m_c_1'];
$m_c_2=@$_POST['m_c_2'];
$m_c_3=@$_POST['m_c_3'];
$m_c_4=@$_POST['m_c_4'];
$m_c_5=@$_POST['m_c_5'];
$m_c_6=@$_POST['m_c_6'];
$m_c_7=@$_POST['m_c_7'];
$m_c_8=@$_POST['m_c_8'];
$m_c_9=@$_POST['m_c_9'];
$m_c_10=@$_POST['m_c_10'];
$m_c_11=@$_POST['m_c_11'];
$m_c_12=@$_POST['m_c_12'];
$m_c_13=@$_POST['m_c_13'];
$m_c_14=@$_POST['m_c_14'];
$m_c_15=@$_POST['m_c_15'];
$m_c_16=@$_POST['m_c_16'];
$m_c_17=@$_POST['m_c_17'];
$m_c_18=@$_POST['m_c_18'];
$m_c_19=@$_POST['m_c_19'];
$m_c_20=@$_POST['m_c_20'];
$m_c_21=@$_POST['m_c_21'];
$m_c_22=@$_POST['m_c_22'];
$m_c_23=@$_POST['m_c_23'];
$m_c_24=@$_POST['m_c_24'];
$m_c_25=@$_POST['m_c_25'];
$m_c_26=@$_POST['m_c_26'];
$m_c_27=@$_POST['m_c_27'];
$m_c_28=@$_POST['m_c_28'];
$m_c_29=@$_POST['m_c_29'];
$m_c_30=@$_POST['m_c_30'];
$m_c_31=@$_POST['m_c_31'];
$m_c_32=@$_POST['m_c_32'];
$m_c_33=@$_POST['m_c_33'];
$m_c_34=@$_POST['m_c_34'];
    
  
$insert= mysqli_query($con,"INSERT INTO `maintain_content`(`m_no`, `m_c_1`, `m_c_2`, `m_c_3`, `m_c_4`, `m_c_5`, `m_c_6`, `m_c_7`, `m_c_8`, `m_c_9`, `m_c_10`, `m_c_11`, `m_c_12`, `m_c_13`, `m_c_14`, `m_c_15`, `m_c_16`, `m_c_17`, `m_c_18`, `m_c_19`, `m_c_20`, `m_c_21`, `m_c_22`, `m_c_23`, `m_c_24`, `m_c_25`, `m_c_26`, `m_c_27`, `m_c_28`, `m_c_29`, `m_c_30`, `m_c_31`, `m_c_32`, `m_c_33`, `m_c_34`) VALUES ('$id','$m_c_1','$m_c_2','$m_c_3','$m_c_4','$m_c_5','$m_c_6','$m_c_7','$m_c_8','$m_c_9','$m_c_10','$m_c_11','$m_c_12','$m_c_13','$m_c_14','$m_c_15','$m_c_16','$m_c_17','$m_c_18','$m_c_19','$m_c_20','$m_c_21','$m_c_22','$m_c_23','$m_c_24','$m_c_25','$m_c_26','$m_c_27','$m_c_28','$m_c_29','$m_c_30','$m_c_31','$m_c_32','$m_c_33','$m_c_34')");

if($update ){
header('location:maintain_list.php'); 
}else{ echo 'data nono'.mysqli_error($con);}
    
}
?>
<html>
<head>
<title>健璟內部管理系統</title>
<meta charset="utf-8">
<link href="../css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>    
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script>
    
/*$(document).on('change', 'select#type', function() {
    var type=$(this).val();*/
$(document).load('input#type', function() { 
    var type=document.getElementById('type').value;  
    console.log(type);
    var device=Array('機械停車設備','附屬設備','電梯');
    var a=0;
    
    if(type==device[0]){
      a=1}
    else if(type==device[1]){
      a=2}
    else if(type==device[2]){
      a=3
    }
switch(a){
case 1:
   if(type==device[0]){
      $('tbody#parking1').show();
      $('tbody#parking2').show();
      $('tbody#parking3').show();
      $('tbody#all').show();
      //$('tbody#elevator1').hide();
      $('tbody#elevator2').hide();
      $('tbody#elevator3').hide();
      $('tbody#ancillary1').hide();
      //alert('機械停車設備');
      break;
      }
case 2:
   if(type==device[1]){
   //alert('附屬設備');
      $('tbody#ancillary1').show();
      $('tbody#parking2').show();
      $('tbody#parking3').show();
      $('tbody#all').show();
      //$('tbody#elevator1').hide();
      $('tbody#elevator2').hide();
      $('tbody#elevator3').hide();
      $('tbody#parking1').hide();
      break;
      }
case 3:
   if(type==device[2]){
      //alert('電梯');
      //$('tbody#elevator1').show();
      $('tbody#elevator2').show();
      $('tbody#elevator3').show();
      $('tbody#all').show();
      $('tbody#parking1').hide();
      $('tbody#parking2').hide();
      $('tbody#parking3').hide();
      $('tbody#ancillary1').hide();
      break;
      }
   }      
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
              <h3 class='mt-4'><i class="far fa-calendar-check"></i>新增保養單</h3>
              
  <form action="" method="post" name="form1">
<?php
$data=mysqli_query($con,"SELECT * FROM `maintain` m join client c on(m.c_no=c.c_no) join product p on(p.c_no=c.c_no) where m.m_no=$id");
for($i=1;$i<=mysqli_num_rows($data);$i++){
$rs=mysqli_fetch_array($data);
$firthday=$rs['m_month'].'-01'; 
$m_device= $rs['m_device1'];  

?>     
  <table border="1" id="myTable" class="table table-bordered">
    <tr><td colspan="2">建築物名稱</td><td><input value='<?php echo $rs['c_name'];?>' style="outline:none;border:0;"></td><td colspan="2">保養日期</td><td ><input type="date" name="m_date" min='<?php echo $firthday;?>' max='<?php echo date('Y-m-t', strtotime($firthday));?>'> </td>
    </tr>
    <tr><td colspan="2">設備名稱</td><td colspan="4">
    <input id="type" value="<?php echo $rs['m_device'];?>" readonly="readonly" style="border:0px;outline:none;"><!--機械停車設備/附屬設備/電梯-->
        </td>
    </tr>
<?php      
$data1=mysqli_query($con,"SELECT * FROM `maintain` m join client c on(m.c_no=c.c_no) join product p on(p.c_no=c.c_no) where m.m_no=$id and pro_kind = '$m_device'");
for($i=1;$i<=mysqli_num_rows($data1);$i++){
$rs1=mysqli_fetch_array($data1);
?>
  <tbody id="parking1" style="display:none">
    <tr><td colspan="2">機械停車設備</td>
        <td colspan="4"><?php echo $rs1['park'];?></td>
    </tr>
    <tr><td colspan="2">驅動方式</td>
        <td colspan="4"><?php echo $rs1['drivemethod'];?></td>
    </tr>
    <tr><td colspan="2">傳動元件</td>
        <td colspan="4"><?php echo $rs1['transmisson'];?></td>
    </tr>
    </tbody>
  <tbody id="ancillary1" style="display:none">
    <tr><td colspan="2">汽(機)車升降機</td>
        <td colspan="4"><?php echo $rs1['elevator'];?></td>
    </tr>
    <tr><td colspan="2">旋轉台</td>
        <td colspan="4"><?php echo $rs1['turntable'];?></td>
    </tr>
    <tr><td colspan="2">驅動方式</td>
        <td colspan="4"><?php echo $rs1['drivemethod'];?></td>
    </tr>
    <tr><td colspan="2">傳動元件</td>
        <td colspan="4"><?php echo $rs1['transmisson'];?></td>
    </tr>  
  </tbody>
  <!--tbody id="elevator1" style="display:none">
         
  </tbody--> 
      <?php }?>
  <tbody id="parking2" style="display:none">
    <tr><td colspan="6">維護檢視項目</td></tr>
    <?php  
      $items = array("V","O","＿","X","是","否"); 
      $service= array("注意事項項目","光電開關檢視","機械結構、置車板檢視","乘載存放限制","限動開關檢視","安全扣元件檢視","各式按鈕檢視","驅動元件檢視","油壓防爆閥檢視","設備運轉測試","傳動元件檢視","防落裝置檢視","車台定位檢視","馬達減速機檢視","照明裝置檢視","車台水平檢視","馬達減速機檢視","照明裝置檢視","車台水平檢視","油壓元件檢視","機械室檢視","警(指)示裝置檢視","鏈條檢視","區隔防護規定(護欄、光電)","升降、橫移連鎖裝置檢視","鋼索檢視","機坑積水檢視");   
      
      echo '<tr>'; 
      for($i=1;$i<= count($service);$i++){ 
        echo '<td>'.$service[$i-1].'</td><td>';
        for($j=1;$j<=6;$j++){
          $n="m_c_".$i;
          $v=$items[$j-1];    
          echo "<input type='radio' name='$n' value='$v' >";   
          echo $v;
        }echo '</td>';if ($i%3==0){echo '</tr>';}
      }
      ?>         
  </tbody> 
  <tbody id="elevator2" style="display:none">
    <tr><td colspan="6">維護檢視項目</td></tr>
    <?php  

      $items2 = array("V","X","△","N");
      $elevator1=array("機械式環境狀況","受電盤、制御器、信號盤","電動機、牽引機","電動發電機、啟動盤","車廂行走狀態","對外部聯絡裝置","停電燈裝置","車廂內裝、照明、通風扇","車廂上環境狀況","門之關閉裝置","車廂著床狀態","門開閉狀態","導滑器、導論","給油器","乘車門，門踏板","乘場按鈕、指示燈");
      $elevator2=array("車廂操作盤、指示燈","車廂門、門踏板","閉門安全裝置","門手動開放","電磁煞車器","乘場選擇器","調速器","升降路內、機坑內環境狀況","車廂、配重之轉向輪","主鋼索、調速鋼索、檢點","導軌檢點、鋼帶檢點","配重器","DrSW動作、DrLock機構檢點","上、下部極限開關動作確認","緊急停止裝置檢點","移動電纜","緩衝器檢點","各張力輪");

      
      for($i=1;$i<= count($elevator2);$i++){
        if($i==1){
        echo '<td rowspan="16" >月<br>保<br>養<br>項<br>目</td>';  
        }else if($i==17){  
        //echo'<td colspan="3" rowspan="2"></td> ';
        }
         
        if($i!=17 and $i!=18){  
        echo '<td>'.$elevator1[$i-1].'</td><td>';
          for($j=1;$j<=4;$j++){
          $n="m_c_".$i;
          $v=$items2[$j-1];     
          echo "<input type='radio' name='$n' value='$v' >";
          echo "&nbsp;".$v;
        }echo '</td>';
        }else if($i==17){
            echo'<td colspan="3" rowspan="2"></td>';
        }
          
         if($i==1){
        echo '<td rowspan="4" >季<br>保<br>養<br>項<br>目</td>';  
        }else if($i==5){  
         echo '<td rowspan="9" >半<br>年<br>保<br>養<br>項<br>目</td>';
        }else if($i==14){  
         echo '<td rowspan="5" >年<br>保<br>養<br>項<br>目</td>';
        }
          
          
        echo '<td>'.$elevator2[$i-1].'</td><td>';
          for($j=1;$j<=4;$j++){
          $a=$i+16;  
          $n="m_c_".$a;
          $v=$items2[$j-1];      
          echo "<input type='radio' name='$n' value='$v' >";
          echo "&nbsp;".$v;
        }echo '</td></tr>';    
      }
      
      ?> 
      
      
      
    </tbody>
    <tbody id="parking3" style="display:none">
      <tr><td colspan="2">備考紀錄</td><td colspan="4"><textarea name="m_recode"></textarea></td></tr>
      <tr><td colspan="2">建議事項</td><td colspan="4"><textarea name="m_suggest"></textarea></td></tr>
    </tbody>
    <tbody id="elevator3" style="display:none">
      <tr><td colspan="2">工作說明與建議事項<td colspan="4"><textarea name="m_recode1"></textarea></td></tr></tbody>
    <tbody id="all" style="display:none">
      <tr><td colspan="2">服務人員</td><td colspan="4">
          <?php
            $worker=mysqli_query($con,"SELECT w_name FROM `worker`"); 
            $worker1=array();
            for($i=1;$i<=mysqli_num_rows($worker);$i++){
                $w=mysqli_fetch_array($worker); 
                array_push($worker1, $w["w_name"]);
            } 
            
            echo "<select name='m_person_1' form='form1'>"; 
            for($z=0;$z<count($worker1);$z++){
                    $v=$worker1[$z];   
                    echo "<option value='$v'";
                    echo ">$v</option>";}
                    echo "</select>";
            
            echo "<select name='m_person_2' form='form1'>"; 
            for($z=0;$z<count($worker1);$z++){
                    $v=$worker1[$z];   
                    echo "<option value='$v'";
                    echo ">$v</option>";}
                    echo "</select>";
            
            ?> 
      
          </td>
      </tr>
      <tr><td colspan="2">上傳圖片</td><td colspan="4"><input type="image"></tr>
    </tbody>
    </table>
      <?php } ?>
     <input type="submit" name="insert" id="insert" value="新增" class="btn btn-primary"> 
    </form>
    </div></main></div></div> 
<script src="../js/scripts.js"></script>
</body>    
</html>