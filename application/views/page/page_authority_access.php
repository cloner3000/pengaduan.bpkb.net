<div class="span12">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Hak Akses</h5>
  </div>
  <div class="widget-content">
    <div id="pesan"></div>
<form id="fajax" method="post"action="">
    <div class="control-group">
      <label class="control-label" for="inputEmail">Tipe User</label>

      <div class="controls">
        <select name="typeuser" id="typeuser" class="span2">
          <?php
            foreach($tipe_user as $row){
              echo "<option value='$row->type_id'>$row->name</option>";
            }
           ?>
        </select><button type="button" id="bsubmit" class="btn btn-success"> simpan</button>
      </div>
    </div>

  <table class="data-table table table-condensed table-bordered table-hover table-striped">
  <thead>
    <tr>

      <th width="15%">Kategori</th>
      <th width="15%">Modul</th>
      <th width="3%">Lihat</th>
      <th width="3%">Buat</th>
      <th width="3%">Ubah</th>
      <th width="3%">Hapus</th>
      <th width="3%">Cetak</th>
      <th width="3%">Pilih Semua</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="9" class="dataTables_empty">Loading data..</td>
    </tr>
  </tbody>
  </table>
  </form>
</div>
</div>
</div>



<script type="text/javascript">
$(document).ready(function() {
  var url=getBaseURL();

  $("#bsubmit").bind('click',function(){
      var type_user = $("#typeuser").val();
      if(type_user == "" ){
        alert("Tipe User Belum Di pilih");
      }else{
      var sData = oTable.$('input').serialize();
      $.ajax({
         type: "POST",
         url: "<?php echo site_url("authority_access/save"); ?>",
         data:sData+"&typeuser="+$("#typeuser").val(),
         beforeSend :function(){
          $("#pesan").html('<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">loading page..</span></div>');
         },
         success: function(msg){
           $("#pesan").html(msg);
         }
       });
      }
      return false;
  });


  var oTable = $('.data-table').dataTable({
     "sDom": '<""rl>ti<"F"p>',
     "bJQueryUI": true,
     "bProcessing": true,
     "oLanguage": {
       "sProcessing": '<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">loading page..</span></div>',
     },
     "bPaginate": false,
     "aaSorting": [[ 0, "ASC" ],[ 1, "ASC" ]],
     "aoColumnDefs": [ {
          "sClass": "tdcenter",
          "aTargets": [ 2,3,4,5,6,7 ]
     }],
     "bServerSide": true,
     "bDeferRender": true,
     "sAjaxSource": url+"authority_access/mydata",
     "fnServerData": function( sUrl, aoData, fnCallback ) {
       aoData.push( { "name": "typeuser", "value": $("#typeuser").val() });
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
      $(".check-all").bind('click',function(){
        $id = $(this).val();
        if($(this).is(':checked')){
          $(".modul-"+$id).prop('checked', true);
        }else{
          $(".modul-"+$id).prop('checked', false);
        }
      });
    },
    "aoColumnDefs":[
    {
      "aTargets":[2],
      "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
          var val2 = $(nTd).find('input').val();
          if(val2=='y') $(nTd).find('input').prop('checked', true);
      }
    },
    {
      "aTargets":[3],
      "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
          var val2 = $(nTd).find('input').val();
          if(val2=='y') $(nTd).find('input').prop('checked', true);
      }
    },
    {
      "aTargets":[4],
      "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
          var val2 = $(nTd).find('input').val();
          if(val2=='y') $(nTd).find('input').prop('checked', true);
      }
    },
    {
      "aTargets":[5],
      "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
          var val2 = $(nTd).find('input').val();
          if(val2=='y') $(nTd).find('input').prop('checked', true);
      }
    },
    {
      "aTargets":[6],
      "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
          var val2 = $(nTd).find('input').val();
          if(val2=='y') $(nTd).find('input').prop('checked', true);
      }
    },
    {
      "aTargets":[6],
      "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
          var val2 = $(nTd).find('input').val();
          if(val2=='y') $(nTd).find('input').prop('checked', true);
      }
    }

    ]
  });

  $("#typeuser").change(function(){
    oTable.fnDraw();
  });
});
</script>
