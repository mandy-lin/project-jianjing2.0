<html>
<head>
<title>健璟內部管理系統</title>
<meta charset="utf-8">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script>
    
$(document).on('change', 'select#type', function() {
    var type=$(this).val();
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
      $('tbody#elevator1').hide();
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
      $('tbody#elevator1').hide();
      $('tbody#elevator2').hide();
      $('tbody#elevator3').hide();
      $('tbody#parking1').hide();
      break;
      }
case 3:
   if(type==device[2]){
      //alert('電梯');
      $('tbody#elevator1').show();
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
<body>
<aside style="float:left;width:240px;">
<ul>
    <li><a href="contract_list.html">合約</a></li>
        <ul><a href="contract_add.html">新增合約</a></ul>
    <li><a href="client_list.html">客戶</a></li>
        <ul><a href="client_add.html">新增客戶</a></ul>
        <ul><a href="client_list_miss.html">流失客戶</a></ul>
    <li><a href="maintain_list.html">保養</a></li>
        <ul><a href="maintain_add.php">新增保養</a></ul>
    <li><a href="price_list.html">報價</a></li>
        <ul><a href="price_add.html">新增報價</a></ul>
    <li><a href="fix_list.html">維修</a></li>
        <ul><a href="fix_add.html">新增維修</a></ul>
  </ul>
</aside>
<div id="content" style="float:left;width:720px;">
  <form action="" method="post" name="form1">
  <table border="1" id="myTable">
  <caption>新增保養單</caption>
    <tr><td>建築物名稱</td><td colspan="2"><input type="text"></td><td>保養日期</td><td colspan="2"><input type="date"></td>
    </tr>
    <tr><td>設備名稱</td><td colspan="5"><select id="type">
      <option value=''>選擇設備</option>
      <option value='機械停車設備'>機械停車設備</option>
      <option value='附屬設備'>附屬設備</option>
      <option value='電梯'>乘客用電梯</option>
      </select></td>
    </tr>
  <tbody id="parking1" style="display:none">
    <tr><td>機械停車設備</td>
        <td colspan="5"><input type='checkbox'>簡易型單置車板式
          <input type='checkbox'>簡易型雙置車板式
          <input type='checkbox'>簡易型多置車板式<br>
          <input type='checkbox'>多段型升降橫移式
          <input type='checkbox'>平面往後式
          <input type='checkbox'>循環式</td>
    </tr>
    <tr><td>驅動方式</td>
        <td colspan="5"><input type='checkbox'>油壓式
          <input type='checkbox'>電動機
          <input type='checkbox'>臂桿式
        </td>
    </tr>
    <tr><td>傳動元件</td>
        <td colspan="5"><input type='checkbox'>鍊條
          <input type='checkbox'>鋼索
          <input type='checkbox'>油壓缸</td>
    </tr>
    </tbody>
  <tbody id="ancillary1" style="display:none">
    <tr><td>汽(機)車升降機</td>
        <td colspan="5"><input type='checkbox'>升降式
          <input type='checkbox'>升降迴旋式
          <input type='checkbox'>升降橫移式
          </td>
    </tr>
    <tr><td>旋轉台</td>
        <td colspan="5"><input type='checkbox'>迴旋式
          <input type='checkbox'>旋轉移動式
          <input type='checkbox'>貨梯
        </td>
    </tr>
    <tr><td>驅動方式</td>
        <td colspan="5"><input type='checkbox'>油壓缸
          <input type='checkbox'>電動機
          <input type='checkbox'>臂桿式</td>
    </tr>
    <tr><td>傳動元件</td>
        <td colspan="5"><input type='checkbox'>鍊條
          <input type='checkbox'>鋼索
          <input type='checkbox'>油壓缸</td>
    </tr>  
  </tbody>
  <tbody id="elevator1" style="display:none">
         
  </tbody> 
  <tbody id="parking2" style="display:none">
    <tr><td colspan="6">維護檢視項目</td></tr>
    <?php  
      $items = array("V","O","-","X","是","否"); 
      $service= array("注意事項項目","光電開關檢視","機械結構、置車板檢視","乘載存放限制","限動開關檢視","安全扣元件檢視","各式按鈕檢視","驅動元件檢視","油壓防爆閥檢視","設備運轉測試","傳動元件檢視","防落裝置檢視","車台定位檢視","馬達減速機檢視","照明裝置檢視","車台水平檢視","馬達減速機檢視","照明裝置檢視","車台水平檢視","油壓元件檢視","機械室檢視","警(指)示裝置檢視","鏈條檢視","區隔防護規定(護欄、光電)","升降、橫移連鎖裝置檢視","鋼索檢視","機坑積水檢視");   
      
      echo '<tr>'; 
      for($i=1;$i<= count($service);$i++){ 
        echo '<td>'.$service[$i-1].'</td><td>';
        for($j=1;$j<=6;$j++){
          echo "<input type='radio' name='radio2.$i' value='$j'>";
          echo $items[$j-1];
        }echo '</td>';if ($i%3==0){echo '</tr>';}
      }
      ?>         
  </tbody> 
  <tbody id="elevator2" style="display:none">
    <tr><td colspan="6">維護檢視項目</td></tr>
    <?php  
      $items2 = array("V","X","△","N"); 
      $elevator=array("機械式環境狀況","受電盤、制御器、信號盤","電動機、牽引機","電動發電機、啟動盤","車廂行走狀態","對外部聯絡裝置","停電燈裝置","車廂內裝、照明、通風扇","車廂上環境狀況","門之關閉裝置","車廂著床狀態","門開閉狀態","導滑器、導論","給油器","乘車門，門踏板","乘場按鈕、指示燈","車廂操作盤、指示燈","車廂門、門踏板","閉門安全裝置","門手動開放","電磁煞車器","乘場選擇器","調速器","升降路內、機坑內環境狀況","車廂、配重之轉向輪","主鋼索、調速鋼索、檢點","導軌檢點、鋼帶檢點","配重器","DrSW動作、DrLock機構檢點","上、下部極限開關動作確認","緊急停止裝置檢點","移動電纜","緩衝器檢點","各張力輪");    

      echo '<tr>'; 
      for($i=1;$i<= count($elevator);$i++){ 
        echo '<td>'.$elevator[$i-1].'</td><td>';
        for($j=1;$j<=4;$j++){
          echo "<input type='radio' name='radio2.$i' value='$j'>";
          echo $items2[$j-1];
        }echo '</td>';if ($i%3==0){echo '</tr>';}
      }
      ?>         
    </tbody>
    <tbody id="parking3" style="display:none">
      <tr><td>備考紀錄</td><td colspan="5"><textarea></textarea></td></tr>
      <tr><td>建議事項</td><td colspan="5"><textarea></textarea></td></tr>
    </tbody>
    <tbody id="elevator3" style="display:none">
      <tr><td>工作說明與建議事項<td colspan="5"><textarea></textarea></td></tr></tbody>
    <tbody id="all" style="display:none">
      <tr><td>服務人員</td><td colspan="5"><select>
        <option value=''>選擇人員</option>
        <option value='A'>A</option>
        <option value='B'>B</option>
        <option value='C'>C</option>
        <option value='D'>D</option>
        <option value='E'>E</option>
        <option value='F'>F</option>
      </select></td>
      </tr>
      <tr><td>上傳圖片</td><td colspan="5"><input type="image"></tr>
    </tbody>
    </table>
    </form>
    </div> 
</body>    
</html>