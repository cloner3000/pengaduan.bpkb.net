<form id="fajax" method="post" class="form-horizontal" action="<?=site_url("assign_ticket/save")?>">
<div class="span12">
<div id="pesan"></div>
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Alihkan Tiket</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>
      <th width="8%">Check</th>
      <th width="8%">No Tiket</th>
      <th width="8%">Tiket status</th>
      <th width="">Isi</th>
      <th width="8%">Terbitkan</th>
      <th width="8%">Tanggal</th>
      <th width="8%">Topik</th>
      <th width="8%">Update</th>
      <th width="8%">Prioritas</th>
      <th width="8%">Departement</th>
      <th width="8%">Hapus</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="2" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
  <div class="control-group">
    <label class="control-label">Departement</label>
  <div class="controls">
    <select name="departement_id" data-tag="select">
    <?php
      echo $option;
     ?>
  </select>
  </div>
  </div>
  <div class="control-group">
    <label class="control-label">Prioritas</label>
  <div class="controls">
    <select name="priority_id" data-tag="select">
    <?php
      foreach($priority->result() as $list){
        echo "<option value='$list->priority_id'>$list->priority</option>";
      }
     ?>
  </select>
  </div>
  </div>
  <button class="btn btn-primary" type="submit">ALIHKAN</button>
   
</div>
</div>
</div>
</div>
</form>


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
     "sAjaxSource": url+"assign_ticket/dataajax",
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
  var  checkBoxes = $(this).find("td input:checkbox")
  $(this).find("td input:checkbox").prop('checked',!checkBoxes.prop("checked"));
});

$(".data-table tbody").on("click", ".deleteticket", function(event){
  var  id = $(this).data("id");
  console.log(id);
  if(confirm("Anda yakin menghapus ticket ?")){
   $.post("<?=site_url("assign_ticket/delete")?>","id="+id).done(function() { oTable.fnDraw();})
   console.log("do delete");
  }
  
});

});
</script>
