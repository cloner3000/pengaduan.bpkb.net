<div class="span12">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Data Pengetahuan</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table2 table table-condensed table-hover table-striped">
  <tbody>
    <tr>
      <td colspan="5" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
</div>
</div>
</div>
</div>
<script type="text/javascript">
var oTable2;
$(document).ready(function() {
  var url = getBaseURL();
  oTable2 = $('.data-table2').dataTable({
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
     "aaSorting": [[ 3, "DESC" ]],
     "aoColumnDefs": [ {
          "sClass": "tdcenter",
          "aTargets": [0]
     }],
     "bServerSide": true,
     "bDeferRender": true,
     "sAjaxSource": url+"front/dataajax_knowledge",
     "fnServerData": function( sUrl, aoData, fnCallback ) {
       $.ajax( {
                "url": sUrl,
                "data": aoData,
                "type" :"POST",
                "success": fnCallback,
                "dataType": "json",
            } );
        },

  });
});
</script>
