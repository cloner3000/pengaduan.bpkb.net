<div class="span5">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Berita</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" class="form-horizontal" method="post" action="<?php echo site_url("news/save"); ?>">
<div class="control-group">
  <label class="control-label">Judul</label>
  <div class="controls">
    <input type="text" data-tag="input" placeholder="judul" name="title" required="required" />
    <input type="hidden" data-tag="input" placeholder="judul" name="uuid"  />
  </div>
</div>

<div class="control-group">
  <label class="control-label">Tanggal</label>
  <div class="controls">
    <input type="text" data-tag="input" name="created"  class="datepicker" value="<?=date("Y-m-d")?>"  required="required" />
  </div>
</div>
<div class="control-group">
<label class="control-label">Isi </label>
<div class="controls">
<textarea name="content" style="width: 100%;" data-tag="textarea"  id="textarea"></textarea>
</div>
</div>
<div class="well well-small"><?php echo genbutton("C",$btn['C']); ?></div>
</form>
</div>
</div>
</div>

<div class="span7">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Data Berita</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>

      <th width="8%">Check</th>
      <th width="10%">Judul</th>
      <th width="10%">Tanggal</th>
      <th width="60%">Isi Berita</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="5" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
<?php echo genbutton("U",$btn['U'])." ".genbutton("D",$btn['D']); ?>

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
  $('.datepicker').datepicker();
  $('#bupdate').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih');
       }else{
          getdetail(url+"news/detail","id="+id);
       }
    });

   $('#bdelete').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       var text = $('.data-table input[name=iddata]:checked').closest("td").next("td").text();
       console.log("text "+text);
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih');
       }else if(confirm("Anda yakin menghapus data '"+text+"' ?")){
         $.post("<?=site_url("news/delete")?>","id="+id).done(function() { oTable.fnDraw();})

       }
    });

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
     "aaSorting": [[ 3, "DESC" ]],
     "aoColumnDefs": [ {
          "sClass": "tdcenter",
          "aTargets": [0]
     }],
     "bServerSide": true,
     "bDeferRender": true,
     "sAjaxSource": url+"news/dataajax",
     "fnServerData": function( sUrl, aoData, fnCallback ) {
       aoData.push(

       );
       $.ajax( {
                "url": sUrl,
                "data": aoData,
                "type" :"POST",
                "success": fnCallback,
                "dataType": "json",
            } );
        },
    "fnDrawCallback":function(oSettings ){
       $(".data-table tbody tr").click( function( e ) {
          $(this).find('td input:radio').prop('checked', true);
    });
    }
  });
});
</script>
