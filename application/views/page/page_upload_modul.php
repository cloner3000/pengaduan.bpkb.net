<div class="span4">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Formulir Unggah Modul</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" method="post" action="<?php echo site_url("upload_modul/save"); ?>">
<label>Nama Modul</label>
  <input type="text" data-tag="input" placeholder="modul" name="modul_name" required="required" />
  <input type="hidden" data-tag="input" name="id"  />
  
<label>Modul Kategori</label>
  <select name="modul_catid" data-tag="select" class="span6">
    <?php foreach($modulcat as $row){
      echo "<option value='$row->id'>$row->modul_cat</option>";
      
    } ?>
  </select>
<label>Url</label>
  <input type="text" data-tag="input" placeholder="url" name="url" required="required" />
<label>Icon</label>
  <input type="text" data-tag="input" placeholder="icon" name="icon" required="required" />
<div class="well well-small"><?php echo genbutton("C",$btn['C']); ?></div>
</form>
</div>
</div> 
</div>
<div class="span8">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Data Modul</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>
      
      <th width="4%">Check</th>
      <th width="10%">Modul Kategori</th>
      <th width="15%">Modul</th>
      <th width="10%">Url</th>
      <th width="10%">Icon</th>
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
  
  $('#bupdate').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih'); 
       }else{
          getdetail(url+"upload_modul/detail","id="+id);
       } 
    });
   
   $('#bdelete').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       var text = $('.data-table input[name=iddata]:checked').closest("td").next("td").text();
       console.log("text "+text);
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih'); 
       }else if(confirm("Anda yakin menghapus data '"+text+"' ?")){
          $.post("<?=site_url("upload_modul/delete")?>","id="+id).done(function() { oTable.fnDraw();})
          
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
     "aaSorting": [[ 1, "ASC" ],[ 2, "ASC" ]],
     "aoColumnDefs": [ {
          "sClass": "tdcenter",
          "aTargets": [0]
     }],
     "bServerSide": true,
     "bDeferRender": true,
     "sAjaxSource": url+"upload_modul/dataajax",
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
});
</script>
