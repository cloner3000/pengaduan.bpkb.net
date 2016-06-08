<div class="span4">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Formulir Tipe Pengguna</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" method="post" action="<?php echo site_url("type_user/save"); ?>">
<label>Tipe Pengguna</label>
  <input type="text" data-tag="input" placeholder="tipe user" name="name" required="required" />
  <input type="hidden" data-tag="input" name="type_id"  />

<div class="well well-small"><?php echo genbutton("C",$btn['C']); ?></div>
</form>
</div>
</div>
</div>
<div class="span7">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Data Tipe Pengguna</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>
      <th width="8%">Check</th>
      <th width="60%">Tipe Pengguna</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="2" class="dataTables_empty">Loading data..</td>
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

  $('#bupdate').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih');
       }else{
          getdetail(url+"type_user/detail","id="+id);
       }
    });

   $('#bdelete').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       var text = $('.data-table input[name=iddata]:checked').closest("td").next("td").text();
       console.log("text "+text);
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih');
       }else if(confirm("Anda yakin menghapus data '"+text+"' ?")){
         $.post("<?=site_url("type_user/delete")?>","id="+id).done(function() { oTable.fnDraw();})

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
     "aaSorting": [[ 1, "ASC" ]],
     "aoColumnDefs": [ {
          "sClass": "tdcenter",
          "aTargets": [0]
     }],
     "bServerSide": true,
     "bDeferRender": true,
     "sAjaxSource": url+"type_user/dataajax",
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

});
</script>
