<div class="span4">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Form Registrasi Operator</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" class="form-horizontal" method="post" action="<?php echo site_url("employee/save"); ?>">
<div class="control-group">
  <label class="control-label">Nama Lengkap</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="nama operator" name="full_name" required="required" />
  <input type="hidden" data-tag="input" name="uuid"  />
</div>
</div>
<div class="control-group">
  <label class="control-label">Jenis Kelamin</label>
<div class="controls">
    <select name="gender" data-tag="select">
      <option value="L">Laki Laki</option>
      <option value="P">Perempuan</option>
    </select>
</div>
</div>
<div class="control-group">
  <label class="control-label">Identitas</label>
<div class="controls">
  <select name="type_identity" data-tag="select" class="span4" >
    <option value="SIM">SIM</option>
    <option value="KTP">KTM</option>
  </select>
 <input type="text" data-tag="input" placeholder="no identitas" class="span5" name="identity_no" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Telp</label>
<div class="controls">
  <input type="number" data-tag="input" placeholder="telp" class="span5" name="phone" required="required" />
  <input type="hidden" data-tag="input" name="type_id" value="2"/>
</div>
</div>
<div class="control-group">
  <label class="control-label">Email</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="email" class="span5" name="email" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Password</label>
<div class="controls">
  <input type="password" data-tag="input" placeholder="password" class="span5" name="password" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Alamat</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="alamat" class="span10" name="address" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">RT/RT</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="RT" class="span3" name="rt" required="required" />
  <input type="text" data-tag="input" placeholder="RT" class="span3" name="rw" required="required" />
  <input type="text" data-tag="input" placeholder="Kelurahan" class="span4" name="village" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Kecamatan / Provinsi</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="Kecamatan" class="span6" name="sub" required="required" />
  <input type="text" data-tag="input" placeholder="Provinsi" class="span6" name="province" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Departement</label>
<div class="controls">
  <select name="departement_id" data-tag="select">
    <?php
      foreach($departements->result() as $list){
        echo "<option value='$list->departement_id'>$list->departement_name</option>";
      }
     ?>
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
    <h5>Data Karyawan</h5>
  </div>
  <div class="widget-content nopadding">
  <table class="data-table table table-condensed table-hover table-striped">
  <thead>
    <tr>

      <th width="8%">Check</th>
      <th width="15%">Nama Lengkap</th>
      <th width="10%">Telp</th>
      <th width="5%">L/P</th>
      <th width="5%">Identitas</th>
      <th width="20%">Alamat</th>
      <th width="20%">aktif</th>
      <th width="10%">Departement</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="8" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
<div class="well well-small">
<?php echo genbutton("U",$btn['U'])." ".genbutton("D",$btn['D']) ; ?>
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
          getdetail(url+"employee/detail","id="+id);
       }
    });

   $('#bdelete').click(function() {
       var id = $('.data-table input[name=iddata]:checked').val();
       var text = $('.data-table input[name=iddata]:checked').closest("td").next("td").text();
       console.log("text "+text);
       if(typeof(id) ==='undefined'){
            alert('data belum dipilih');
       }else if(confirm("Anda yakin menghapus data '"+text+"' ?")){
         $.post("<?=site_url("employee/delete")?>","id="+id).done(function() { oTable.fnDraw();})

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
     "sAjaxSource": url+"employee/dataajax",
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
