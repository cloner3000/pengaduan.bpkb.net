<div class="span4">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Akses Pengguna</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" class="form-horizontal" method="post" action="<?php echo site_url("access_user/save"); ?>">
<div class="control-group">
  <label class="control-label">Nama</label>
<div class="controls">
  <select name="uuid" data-tag="select" class="select2 span8">
     <?php
        foreach($listusers->result() as $listuser){
          echo "<option value='$listuser->uuid'>$listuser->full_name</option>";
        }
      ?>
  </select>
</div>
</div>
<div class="control-group">
  <label class="control-label">Tipe Pengguna</label>
<div class="controls">
    <select name="type_id" data-tag="select" class="span6">
      <?php
        foreach($usertypes->result() as $usertype){
          echo "<option value='$usertype->type_id'>$usertype->name</option>";
        }
      ?>
    </select>
</div>
</div>

<div class="control-group">
  <label class="control-label">Aktif</label>
<div class="controls">
    <select name="actived" data-tag="select" class="span6">
     <option value="0">Non Aktif</option>
     <option value="1">Aktif</option>
    </select>
</div>
</div>
<div class="well well-small"><?php echo genbutton("C",$btn['C']); ?></div>
</form>
</div>
</div>
</div>
<div class="span8">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Data Akses Pengguna</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>

      <th width="8%">Check</th>
      <th width="15%">Nama </th>
      <th width="15%">Email </th>
      <th width="10%">Tipe</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="8" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
<?php echo genbutton("D",$btn['D']) ; ?>

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
          getdetail(url+"access_user/detail","id="+id);
       }
    });

   $('#bdelete').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       var text = $('.data-table input[name=iddata]:checked').closest("td").next("td").text();
       console.log("text "+text);
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih');
       }else if(confirm("Anda yakin menghapus data '"+text+"' ?")){
         $.post("<?=site_url("access_user/delete")?>","id="+id).done(function() { oTable.fnDraw();})
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
     "sAjaxSource": url+"access_user/dataajax",
     "fnServerData": function( sUrl, aoData, fnCallback ) {
       aoData.push(

       );
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
