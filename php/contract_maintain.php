<?php
include("mysql_connect.php");

/*測試
$con_device=['汽車升降梯'];
$device=['機械停車設備','電梯','附屬設備'];
$start='2020-01-01';
$end='2020-12-31';
$times='1年1次';
$con_date=['每月'];
*/

//保養頭
//$con_device=@$_POST['con_device'];//'汽車升降梯';//['機械式停車設備','乘客用電梯','電梯升降設備','汽車升降梯','油壓式貨梯','貨梯升降設備','服務梯'];
$device=['機械停車設備','電梯','附屬設備'];
//$con_date=@$_POST['con_date'];//'每月';//['每月','單月','雙月','半年'];
$start=$start_date;//'2020-01-01';
$end=$end_date;//'2020-12-31';
$times=$maintimes;//'每月1次';//['每月1次','每月2次','2個月1次','4個月1次','半年1次','1年1次'];
//$c_no=@$_POST['c_no'];//'2004061550';

date_default_timezone_set("Asia/Taipei");    

$mno= date("zB");


//有幾個月份
$dateDifference = abs(strtotime($end) - strtotime($start));
$monthNum = floor(($dateDifference ) / (30 * 60 * 60 * 24));
//echo $monthNum;



//設備
function getDevice( $data ){
if($data=='機械式停車設備'){
    $a=1;
}else if($data=='乘客用電梯' or $data=='電梯升降設備'){
    $a=2;
}else{
    $a=3;
}

switch ($a) {
   case 1:
     return "機械停車設備";
     break;
   case 2:
     return "電梯";
     break;
   case 3:
     return "附屬設備";
     break;

}    
       
}

//$m_device = getDevice( $con_device);
//echo $m_device;


$m_device = array();
for ($x = 0; $x < count($con_device); $x++) {

array_push($m_device, getDevice( $con_device[$x]));

print_r($m_device);   
  
//保養次數
for($i=0;$i<$monthNum;$i++){
    $date = explode('-',$start);
    $d=$date[1]+$i;
    
    $d = str_pad($d,2,'0',STR_PAD_LEFT);
    
    //$m_month=$date[0].'-'.$d;
    
    
    $m_month = date("Y-m",strtotime($start."+$i month"));
    
    
    $xx=$x+1;
    $c = str_pad($i,2,'0',STR_PAD_LEFT);
    $m_no=$mno.$xx.$c;
    //echo $m_no;
    if($con_date[$x]=='每月'){

    /*echo $date[0].'-';
    echo $d;*/
        if($times=='每月1次'){
            
            //print_r($m_no.$m_month.$m_device[$x].$con_device[$x]);
            $insert=mysqli_query($con,"INSERT INTO `maintain`(`m_no`,`m_month`,  `m_device`,`m_device1`,  `m_status`, `c_no`) VALUES ('$m_no','$m_month','$m_device[$x]','$con_device[$x]','未填單','$c_no')");
        }else if($times=='每月2次'){
            for($j=0;$j<2;$j++){
                //print_r($m_no.$m_month.$m_device[$x].$con_device[$x]);
            $insert=mysqli_query($con,"INSERT INTO `maintain`(`m_no`,`m_month`,  `m_device`,  `m_status`, `c_no`) VALUES ('$m_no','$m_month','$m_device[$x]','未填單','$c_no')");
         }
        }else if($times=='1年1次'){
            if($d%12==0){
                //print_r($m_no.$m_month.$m_device[$x].$con_device[$x]);
            $insert=mysqli_query($con,"INSERT INTO `maintain`(`m_no`,`m_month`,  `m_device`,`m_device1`,  `m_status`, `c_no`) VALUES ('$m_no','$m_month','$m_device[$x]','$con_device[$x]','未填單','$c_no')");

         }
        }else if($times=='4個月1次'){
            if($d%4==$date[1]){
                //print_r($m_no.$m_month.$m_device[$x].$con_device[$x]);
            $insert=mysqli_query($con,"INSERT INTO `maintain`(`m_no`,`m_month`,  `m_device`,`m_device1`,  `m_status`, `c_no`) VALUES ('$m_no','$m_month','$m_device[$x]','$con_device[$x]','未填單','$c_no')");

         }

        }

    
        
    }else if($con_date[$x]=='單月'){
       if($d%2==1){    
           //print_r($m_no.$m_month.$m_device[$x].$con_device[$x]);
            $insert=mysqli_query($con,"INSERT INTO `maintain`(`m_no`,`m_month`,  `m_device`,`m_device1`,  `m_status`, `c_no`) VALUES ('$m_no','$m_month','$m_device[$x]','$con_device[$x]','未填單','$c_no')");


     }   
    }else if($con_date[$x]=='雙月'){
    
        if($d%2==0){
            //print_r($m_no.$m_month.$m_device[$x].$con_device[$x]);
            $insert=mysqli_query($con,"INSERT INTO `maintain`(`m_no`,`m_month`,  `m_device`,`m_device1`,  `m_status`, `c_no`) VALUES ('$m_no','$m_month','$m_device[$x]','$con_device[$x]','未填單','$c_no')");


        }
    }
    else if($con_date[$x]=='半年' || $times=='半年1次'){
       if($d%6==0){
            //print_r($m_no.$m_month.$m_device[$x].$con_device[$x]);
            $insert=mysqli_query($con,"INSERT INTO `maintain`(`m_no`,`m_month`,  `m_device`,`m_device1`,  `m_status`, `c_no`) VALUES ('$m_no','$m_month','$m_device[$x]','$con_device[$x]','未填單','$c_no')");

        }
    }

    
    //echo '<br>';
}
}
/*if($insert ){
//header('location:contract_add.php');
echo '成功';    
}else{ echo 'data nono'.mysqli_error($con);}*/

?>
