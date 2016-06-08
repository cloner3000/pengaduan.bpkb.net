<div class="span2">
  <div class="widget-box">
    <div class="widget-title">
      <span class="icon"><i class="icon-th-list"></i></span>
      <h5>MENU</h5>
    </div>
    <div class="widget-content nopadding">
    <ul class="nav nav-list">
      <li class="nav-header">Departement</li>
      <?php
        foreach ($departement as $list) {
          echo "<li>
          <a href='#' class='filter' data-deptid='$list->departement_id' data-status='-'><strong>
          $list->departement_name ".total_ticket($list->departement_id)."</strong></a>";
          foreach ($status as $val) {
            echo "<li>  <a href='#' class='filter' data-deptid='$list->departement_id' data-status='$val->status_id'>$val->status ".total_ticket_status($list->departement_id,$val->status_id)."</a></li>";
          }
          echo "</li>";
        }
      ?>
    </ul>
    </div>
  </div>
</div>
<div class="span10">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>DAFTAR TIKET</h5>
  </div>
  <div class="widget-content nopadding">
  <input type="hidden" id="dept_id" value="-">
  <input type="hidden" id="status_id" value="-">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>
      <th width="8%">S</th>
      <th width="8%">ID Tiket</th>
      <th width="">Judul</th>
      <th width="8%">Operator</th>
      <th width="8%">Departement</th>
      <th width="8%">Status</th>
      <th width="8%">Tanggal</th>
      <th width="8%">Prioritas</th>
      <th width="8%">Detail</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="2" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
</div>
</div>
</div>
</div>



<script type="text/javascript">
var oTable;
$(document).ready(function() {
  var url = getBaseURL();
  var cfajax = fconfig("#pesan",true);
  $('#fajax').ajaxForm(cfajax);


  oTable = $('.data-table').dataTable({
     "sDom": '<""rl>ti<"F"fp>',
     "bJQueryUI": true,
     "bProcessing": true,
     "oLanguage": {
       "sProcessing": '<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">loading page..</span></div>',
     },
     "iDisplayStart": 0,
     "iDisplayLength": 20,
     "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, 'All']],
     "sPaginationType": "full_numbers",
     "aaSorting": [[ 1, "ASC" ]],
     "aoColumnDefs": [ {
          "sClass": "tdcenter",
          "aTargets": [0]
     }],
     "bServerSide": true,
     "bDeferRender": true,
     "sAjaxSource": url+"list_ticket/dataajax",
     "fnServerData": function( sUrl, aoData, fnCallback ) {
       aoData.push({"name":"dept_id" ,"value" : $("#dept_id").val()});
       aoData.push({"name":"status_id" ,"value" : $("#status_id").val()});
       $.ajax( {
                "url": sUrl,
                "data": aoData,
                "type" :"POST",
                "success": fnCallback,
                "dataType": "json",
                "cache": false

            } );
        },
    "fnDrawCallback":function(oSettings ){

    }
  });

 $(".dataTables_filter input[type=text]").keydown(function(e) {
     if(e.keyCode == 13){
      oTable.fnFilter(this.value, null, false);
      return false;
     }
  });
$('.filter').click(function(){
  $('.filter').parent('li').removeClass('active');
  $(this).parent('li').addClass('active');
  var dept_id = $(this).data('deptid');
  var status_id =  $(this).data('status');
  $("#dept_id").val(dept_id);
  $("#status_id").val(status_id);
  oTable.fnDraw();
});
});
</script>
