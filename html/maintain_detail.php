<html>
<head>
<title>健璟內部管理系統</title>
<meta charset="utf-8">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script>
$(document).load('input#type', function() {
    //var type=$(this).value;
    var type=document.getElementById('type').value;
    
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
  <caption>保養單</caption>
    <tr><td>建築物名稱</td><td colspan="2">XX大樓</td><td>保養日期</td><td colspan="2"><input type="date" class="readonly" readonly="readonly"></td>
    </tr>
    <tr><td>設備名稱</td><td colspan="5">
    <input id="type" value="機械停車設備" readonly="readonly"  style="border:0px;outline:none;">
        </td>
    </tr>
  <tbody id="parking1" style="display:none">
    <tr><td>機械停車設備</td>
        <td colspan="5">簡易型單置車板式</td>
    </tr>
    <tr><td>驅動方式</td>
        <td colspan="5">油壓式</td>
    </tr>
    <tr><td>傳動元件</td>
        <td colspan="5">鍊條</td>
    </tr>
    </tbody>
  <tbody id="ancillary1" style="display:none">
    <tr><td>汽(機)車升降機</td>
        <td colspan="5">升降式</td>
    </tr>
    <tr><td>旋轉台</td>
        <td colspan="5">迴旋式</td>
    </tr>
    <tr><td>驅動方式</td>
        <td colspan="5">油壓缸</td>
    </tr>
    <tr><td>傳動元件</td>
        <td colspan="5">鍊條</td>
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
          echo "<input type='radio' name='radio2.$i' value='$j' class='readonly' 
          disabled='disabled'>";
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
          echo "<input type='radio' name='radio2.$i' value='$j' class='readonly' disabled='disabled'>";
          echo $items2[$j-1];
        }echo '</td>';if ($i%3==0){echo '</tr>';}
      }
      ?>         
    </tbody>
    <tbody id="parking3" style="display:none">
      <tr><td>備考紀錄</td><td colspan="5"><textarea class="readonly" readonly="readonly"></textarea></td></tr>
      <tr><td>建議事項</td><td colspan="5"><textarea class="readonly" readonly="readonly"></textarea></td></tr>
    </tbody>
    <tbody id="elevator3" style="display:none">
      <tr><td>工作說明與建議事項<td colspan="5"><textarea class="readonly" readonly="readonly"></textarea></td></tr></tbody>
    <tbody id="all" style="display:none">
      <tr><td>服務人員</td><td colspan="5">
      <select class="readonly" disabled="disabled">
        <option value=''>選擇人員</option>
        <option value='A'>A</option>
        <option value='B'>B</option>
        <option value='C'>C</option>
        <option value='D'>D</option>
        <option value='E'>E</option>
        <option value='F'>F</option>
      </select><select class="readonly" disabled="disabled">
        <option value=''>選擇人員</option>
        <option value='A'>A</option>
        <option value='B'>B</option>
        <option value='C'>C</option>
        <option value='D'>D</option>
        <option value='E'>E</option>
        <option value='F'>F</option>
      </select></td>
      </tr>
      <tr><td>上傳圖片</td><td colspan="5"><input type="file" class="readonly" disabled="disabled"></tr>
    </tbody>
    </table>
    <button id="edit"  name="edit" type="button" onClick="editdata()" style="display:inline" >編輯</button>
    <button id="save"  name="save" type="sumbit"  style="display:none">儲存</button>  
    <input type="button" onclick="history.back()" value="返回">
    </form>
    </div> 
</body>    
</html>