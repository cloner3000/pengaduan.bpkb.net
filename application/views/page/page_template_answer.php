<div class="span8">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Template</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" method="post" action="<?php echo site_url("template_answer/save"); ?>">
<label>Judul</label>
  <input type="text" data-tag="input" placeholder="title" name="title" required="required" />
  <input type="hidden" data-tag="input" name="uuid"  />
<label>Content </label>
<textarea name="template" style="width: 100%;" data-tag="textarea"  id="textarea"></textarea>
<div class="well well-small"><?php echo genbutton("C",$btn['C']); ?></div>
</form>
</div>
</div>
</div>

<div class="span12" style="margin-left: 0 !important;">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Data Template</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>

      <th width="8%">Check</th>
      <th width="10%">Judul</th>
      <th width="60%">Template</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="5" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
<?php echo genbutton("U",$btn['U'])." ".genbutton("D",$btn['D']) ?>

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
          getdetail(url+"template_answer/detail","id="+id);
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
         $.post("<?=site_url("template_answer/delete")?>","id="+id).done(function() { oTable.fnDraw();})
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
     "sAjaxSource": url+"template_answer/dataajax",
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
