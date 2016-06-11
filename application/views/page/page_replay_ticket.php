<div class="span12">
<div id="pesan"></div>
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>BALAS TIKET</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>
      <th width="8%">Check</th>
      <th width="8%">No Pengaduan</th>
      <th width="8%">Pengaduan status</th>
      <th width="">Isi</th>
      <th width="8%">Terbit</th>
      <th width="8%">Tanggal</th>
      <th width="8%">Topik</th>
      <th width="8%">Pembaruan</th>
      <th width="8%">Prioritas</th>
      <th width="8%">Departement</th>
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
  var cfajax = fconfig("#pesan",false);
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
     "sAjaxSource": url+"replay_ticket/dataajax",
     "fnServerData": function( sUrl, aoData, fnCallback ) {
       aoData.push();
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
       $(".data-table tbody tr").click( function( e ) {
          $(this).find('td input:radio').prop('checked', true);
    });
    }
  });

 $(".dataTables_filter input[type=text]").keydown(function(e) {
     if(e.keyCode == 13){
      oTable.fnFilter(this.value, null, false);
      return false;
     }
  });
$(".data-table tbody").on("click", "tr", function(event){

  $(this).find("td input:radio").prop('checked',true);
});
});
</script>
