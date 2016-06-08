 
<div class="span4">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Formulir Departement</h5>
  </div>
  <div class="widget-content">
  <div id="pesan"></div>
  <form id="fajax" class="form-horizontal" method="post" action="<?php echo site_url("departement/save"); ?>">
  <div class="control-group">
    <label class="control-label">Nama</label>
  <div class="controls">
    <input type="text" data-tag="input" placeholder="nama departement" name="departement_name" required="required" />
    <input type="hidden" data-tag="input" name="departement_id"  />
  </div>
  </div>
  <div class="control-group">
  <label class="control-label">Induk</label>
<div class="controls">
  <select name="parent" data-tag="select" class="select2 span8">
  <option value="-1">-</option>
     <?php
        foreach($departement->result() as $row){
          echo "<option value='$row->departement_id'>$row->departement_name</option>";
        }
      ?>
  </select>
</div>
</div>
  <div class="well well-small">
    <?php echo genbutton("C",$btn['C']); ?>
  </div>
  </form>
  </div>
</div>
</div>
<div class="span4">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Data Departement</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>
      <th width="8%">Check</th>
      <th width="15%">Nama Departement</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="3" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
<?php echo genbutton("U",$btn['U'])." ".genbutton("D",$btn['D']); ?>
</div>
</div>
</div>
</div>
<div class="span4">
<div class="widget-box">
  <div class="widget-title">
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Heararki Departement</h5>
  </div>
  <div class="widget-content">
   <?php
   echo $tree;   
   ?>

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
          getdetail(url+"departement/detail","id="+id);
       }
    });

   $('#bdelete').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       var text = $('.data-table input[name=iddata]:checked').closest("td").next("td").text();
       console.log("text "+text);
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih');
       }else if(confirm("Anda yakin menghapus data '"+text+"' ?")){
         $.post("<?=site_url("departement/delete")?>","id="+id).done(function() { oTable.fnDraw();})

       }
    });

  oTable = $('.data-table').dataTable({
     "sDom": '<""rl>t<"F"fp>',
     "bJQueryUI": true,
     "bProcessing": true,
     "oLanguage": {
       "sProcessing": '<div id="page_loader"><img src="'+url+'assets/img/spinner.gif"/><span class="textload">loading page..</span></div>',
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
     "sAjaxSource": url+"departement/dataajax",
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

 $(".dataTables_filter input[type=text]").keydown(function(e) {
     if(e.keyCode == 13){
      oTable.fnFilter(this.value, null, false);
      return false;
     }
  });
});
</script>
