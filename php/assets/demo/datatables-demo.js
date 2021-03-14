// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable( {
    //"paging":   false,
    "ordering": false,
    "info":     false,
    stateSave: true,
    "scrollX": false,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "全部"]],  
     "language": {
         "decimal":        "",
        "emptyTable":     "無資料",
        "info":           "顯示_TOTAL_的_START_ 到 _END_",
        "infoEmpty":      "顯示0筆的0到0",
        "infoFiltered":   "(從_MAX_個中篩選出)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "顯示 _MENU_ 筆",
        "loadingRecords": "載入中...",
        "processing":     "處理中...",
        "search":         "搜尋:",
        "zeroRecords":    "未能找到符合的記錄",
        "paginate": {
            "first":      "第一頁",
            "last":       "前一頁",
            "next":       "下一頁",
            "previous":   "最後一頁"
        },
        "aria": {
            "sortAscending":  ": 升序進行排序",
            "sortDescending": ": 降序進行排序"
        }
         
        },

      
      

    
    
  });
    $('table.disPlay').DataTable({
    //"paging":   false,
    "ordering": false,
    "info":     false,
    stateSave: true,
    "scrollX": false,
    "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "全部"]],  
     "language": {
         "decimal":        "",
        "emptyTable":     "無資料",
        "info":           "顯示_TOTAL_的_START_ 到 _END_",
        "infoEmpty":      "顯示0筆的0到0",
        "infoFiltered":   "(從_MAX_個中篩選出)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "顯示 _MENU_ 筆",
        "loadingRecords": "載入中...",
        "processing":     "處理中...",
        "search":         "搜尋:",
        "zeroRecords":    "未能找到符合的記錄",
        "paginate": {
            "first":      "第一頁",
            "last":       "前一頁",
            "next":       "下一頁",
            "previous":   "最後一頁"
        },
        "aria": {
            "sortAscending":  ": 升序進行排序",
            "sortDescending": ": 降序進行排序"
        }
         
        },

      
      

    
    
  });
    
});
