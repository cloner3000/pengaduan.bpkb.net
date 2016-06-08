<div class="span8">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Report Bug</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" method="post" action="<?php echo site_url("report_bug/save"); ?>">
<label>Menu Program</label>
  <input type="text" data-tag="input" placeholder="menu" name="menu" required="required" />
  <input type="hidden" data-tag="input" name="id"  />
 <input size="16" type="hidden" data-tag="input" name="create_date" value="<?=date("Y-m-d H:i")?>"/>

<label>Report Bug </label>
<textarea name="report_bug" style="width: 100%;" data-tag="textarea"  id="textarea"></textarea>
<div class="well well-small"><?php echo genbutton("C",$btn['C']); ?></div>
</form>
</div>
</div>
</div>

<div class="span12" style="margin-left: 0 !important;">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Data Bug</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>
      
      <th width="8%">Check</th>
      <th width="10%">Menu</th>
      <th width="10%">User</th>
      <th width="10%">Tanggal</th>
      <th width="60%">report bug</th>
      <th width="10%">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="5" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
<?php echo genbutton("U",$btn['U'])." ".genbutton("D",$btn['D'])." ".genbutton("A","y"); ?>

</div>
</div>
</div>
</div>

<div id="closesesi" class="modal hide fade " role="dialog"  aria-hidden="true" >
<form id="fajaxclose"class="form-horizontal" method="post" action="<?=site_url("report_bug/answer"); ?>">
<div class="modal-header">
  <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
  <h4>Answer</h4>
</div>
<div class="modal-body">
<div id="pesan-close"></div>

<input type="hidden" id="idreport" name="id" />  

  <label >Answer</label>  
  <textarea name="answer" id="answer" style="width: 500px !important;"></textarea>
  <label>Status</label>
    <select name="statusbug">
      <option>pending</option>
      <option>confirmed</option>
      <option>fix</option>
    </select>


</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-primary" onclick="nicEditors.findEditor('answer').saveContent();" >Answer</button>
  
</div>
</form>
</div>


<script type="text/javascript">
var oTable;
$(document).ready(function() {
  var url = getBaseURL();
  var cfajax = fconfig("#pesan",true);
  $('#fajax').ajaxForm(cfajax);
  
  var optionpesan = {
        target:"#pesan-close",         
        clearForm: false,  
        resetForm: false,  
        timeout:   6000,
        beforeSubmit: function(){
          var url = getBaseURL();
          $("#pesan-close").html('<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">sending data..</span></div>');
          
        }
    };
    
  $('#fajaxclose').ajaxForm(optionpesan);
  
  
  $('#bupdate').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih'); 
       }else{
          getdetail(url+"report_bug/detail","id="+id);
       } 
    });
   
    $('#banswer').click(function() {
       var id = $('input[name=iddata]:checked').val();
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih'); 
       }else{
          $("#idreport").val(id);
          $('#closesesi').modal('show');
       } 
    });
   
   $('#bdelete').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       var text = $('.data-table input[name=iddata]:checked').closest("td").next("td").text();
       console.log("text "+text);
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih'); 
       }else if(confirm("Anda yakin menghapus data '"+text+"' ?")){
         $.post("<?=site_url("report_bug/delete")?>","id="+id).done(function() { oTable.fnDraw();})
       } 
    });    
  
  
  
  
   oTable = $('.data-table').dataTable({
     "sDom": "<'row-fluid'<'span6 pull-right'r>>t<'row-fluid'<'span6'i><'span6'p>>",
     "bProcessing": true,
     "oLanguage": {
       "sProcessing": '<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">loading page..</span></div>',
     },
     "iDisplayStart": 0,
     "iDisplayLength": 20,
     "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, 'All']],
     "sPaginationType": "bootstrap",
     "aaSorting": [[ 3, "DESC" ]],
     "aoColumnDefs": [ {
          "sClass": "tdcenter",
          "aTargets": [0]
     }],
     "bServerSide": true,
     "bDeferRender": true,
     "sAjaxSource": url+"report_bug/dataajax",
     "fnServerData": function( sUrl, aoData, fnCallback ) {
       aoData.push(
       {"name": '<?=$this->security->get_csrf_token_name()?>', 
       "value" : "<?=$this->security->get_csrf_hash()?>"}
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