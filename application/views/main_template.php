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
<link href="<?=base_url();?>assets/themes/easyui.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>assets/themes/icon.css" rel="stylesheet" type="text/css"/>
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.ui.custom.js"></script>
<script src="<?=base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/datatables.config.js"></script>
<script src="<?php echo base_url();?>assets/js/numeral.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chart.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easyui.min.js"></script>
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
<!--close-Header-part-->
<!--top-Header-messaages-->
<div class="btn-group rightzero">
  <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a>
  <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a>
  <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a>
  <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a>
</div>
<!--close-top-Header-messaages-->
<?php

?>
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li><a href="#ubahpassword" data-toggle="modal" href="#"><i class="icon icon-user"></i> <span class="text"><?=$user['name']?></span></a></li>
    <li class="dropdown" id="menu-messages"><a href="<?php echo site_url("ticket_feed") ?>" ><i class="icon icon-envelope"></i> <span class="text">Pemberitahuan</span> <span class="label label-important"><?=total_notif()?></span></a></li>
    <li><a href="<?=site_url("login/logout")?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<div id="search">
</div>
<!--close-top-Header-menu-->
<div id="sidebar"><ul>
 <li><a href="<?=site_url("home")?>"><i class="icon icon-home"></i> <span>Beranda</span></a></li>
<?php  echo $menus;?>
<li><a href="<?=site_url("home/profile")?>"><i class="icon icon-tags"></i> <span>Profil</span></a></li>
<li><a  href="#ubahpassword" data-toggle="modal"><i class="icon icon-lock"></i> <span>Ubah password</span></a></li>
</ul></div>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url("home")?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Beranda</a></div>

  </div>

  <div class="container-fluid">
    <div class="row-fluid" style="margin-top: 0px!important;">
      <div class="span12">
        <div class="row-fluid">

              <?php echo $contents; ?>

        </div>
      </div>
    </div>

  </div>
</div>
<div class="row-fluid">
      <div id="footer" class="span12"> 2015 &copy; Aplikasi Pengaduan Polda Metro Jaya page rendered in <strong>{elapsed_time}</strong> s </div>
</div>
<div class="modal hide fade" id="ubahpassword" class="span4 offset4" >
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4>Ubah Password</h4>
</div>
<div class="modal-body">
  <div id="result"></div>
<form method="post" id="fubahpass" action="<?php echo site_url("home/ubahpass"); ?>" >
  <div class="control-group">
    <label class="control-label" for="input01">password lama</label>
  <div class="controls">
    <input placeholder="password lama" name="oldpass" class="input-large" type="password"/>
  </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="input01">password baru</label>
  <div class="controls">
    <input placeholder="password baru" name="newpass" class="input-large" type="text"/>
  </div>
  </div>

</div>
<div class="modal-footer">
  <<button type="submit" class="btn btn-primary">Simpan</button>
</div>
</form>
</div>


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
