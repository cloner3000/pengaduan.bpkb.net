<!DOCTYPE html>
<html lang="en">
<head>
<title>PENGADUAN POLDA METRO JAYA :: <?=$title?></title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-responsive.min.css" />

<link rel="stylesheet" href="<?=base_url();?>assets/css/maruti-style.css" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.css" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/datepicker.css" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/maruti-media.css" class="skin-color" />

<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.ui.custom.js"></script>
<script src="<?=base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/datatables.config.js"></script>
<script src="<?php echo base_url();?>assets/js/numeral.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chart.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $('.datepicker').datepicker({
      todayBtn: "linked",
      format:"yyyy-mm-dd",
      autoclose: true,
      todayHighlight: true
   });
});
</script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="#">PENGADUAN POLDA METRO JAYA</a></h1>
</div>
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
</div>
<div id="search">
</div>
<!--close-top-Header-menu-->

<div id="sidebar">
<ul>
 <li><a href="<?=site_url("front")?>"><i class="icon icon-home"></i> <span>Beranda</span></a></li>
<li><a href="<?=site_url("login")?>"><i class="icon icon-lock"></i> <span>Daftar/Login</span></a></li>
<li><a href="<?=site_url("front/knowledgebases")?>"><i class="icon icon-tags"></i> <span>Pengetahuan</span></a></li>
</ul>
</div>

<div id="content">
  <div id="content-header">
  </div>
  <div class="container-fluid">
    <div class="row-fluid" style="margin-top: 0px!important;">
      <div class="span2">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon"><i class="icon-th-list"></i></span>
          <h5>Menu Pengetahuan</h5>
        </div>
        <div class="widget-content no-padding">
          <ul class="nav nav-tabs nav-stacked">
            <?php foreach($know as $row) :?>
              <li>
                  <a href="<?=site_url("front/knowledgebases/$row->uuid/".url_title($row->title, '_'))?>"><?php echo $row->title; ?></a>
                </li>
            <?php endforeach?>
            <li><a class="see-all" href="<?=site_url("front/knowledgebases")?>">Lihat Semua</a></li>
        </div>
      </div>
      </div>
      <div class="span8">

              <?php echo $contents; ?>
      </div>
    </div>
  </div>
</div>
<div class="row-fluid">
      <div id="footer" class="span12"> 2015 &copy; Aplikasi Pengaduan Polda Metro Jaya page rendered in <strong>{elapsed_time}</strong> s </div>
</div>
<script>
   $('.data-table').dataTable({
     "sDom": '<""r>ti<"F"fp>',
     "bJQueryUI": true,
     "bProcessing": true,
     "oLanguage": {
       "sProcessing": '<div id="page_loader"><img src="<?=base_url("assets/img/loader.gif")?>"/><span class="textload">loading page..</span></div>',
     },
     "iDisplayStart": 0,
     "iDisplayLength": 20,
     "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, 'All']],
     "sPaginationType": "full_numbers",
     "bServerSide": true,
     "bDeferRender": true,
     "sAjaxSource": "<?=base_url("front/dataajax_news")?>",
     "fnServerData": function( sUrl, aoData, fnCallback ) {
       $.ajax( {
                "url": sUrl,
                "data": aoData,
                "type" :"POST",
                "success": fnCallback,
                "dataType": "json",
            } );
        }
  });
</script>

<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/maruti.js"></script>
<script src="<?php echo base_url();?>assets/js/nicEdit.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.autocomplete.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.form.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/pos.js"></script>

</body>
</html>
