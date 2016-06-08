<!DOCTYPE html>
<html lang="en">
<head>
<title>PENGADUAN POLDA METRO JAYA</title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php
echo base_url(); ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php
echo base_url(); ?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php
echo base_url(); ?>assets/css/maruti-style.css" />
<link rel="stylesheet" href="<?php
echo base_url(); ?>assets/css/style.css" />
<link rel="stylesheet" href="<?php
echo base_url(); ?>assets/css/maruti-media.css" class="skin-color" />
</head>
<body>
<div id="header">
  <h1><a href="#">PENGADUAN POLDA METRO JAYA</a></h1>
</div>
<div class="btn-group rightzero">
  <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a>
  <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a>
  <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a>
  <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a>
</div>
<!--close-top-Header-messaages-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
  <li><a href="#ubahpassword" data-toggle="modal" href="#"><i class="icon icon-user"></i> <span class="text"><?php
echo $user['name'] ?></span></a></li>
<li class="dropdown" id="menu-messages"><a href="<?php echo site_url("ticket_feed") ?>"><i class="icon icon-envelope"></i> <span class="text">Pemberitahuan</span>
<span class="label label-important"><?=total_notif()?></span></a></li>
  <li><a href="<?php
echo site_url("login/logout") ?>"><i class="icon icon-share-alt"></i> <span class="text">Keluar</span></a></li>
  </ul>
</div>
<div id="search">
</div>
<!--close-top-Header-menu-->

<div id="sidebar"><ul>
 <li><a href="<?php
echo site_url("home") ?>"><i class="icon icon-home"></i> <span>Beranda</span></a></li>
<?php echo $menus; ?>
<li><a href="<?=site_url("home/profile")?>"><i class="icon icon-tags"></i> <span>Profil</span></a></li>
<li><a href="#ubahpassword" data-toggle="modal"><i class="icon icon-lock"></i> <span>Ubah password</span></a></li>
</ul></div>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="<?php
echo site_url("home") ?>" title="Go to Home" class="tip-bottom">
  <i class="icon-home"></i> Beranda</a></div>
  </div>
  <?php if($this->session->userdata('tipe') == '0'): ?>
  <div  class="quick-actions_homepage">
    <ul class="quick-actions">
      <li> <a href="<?php
echo site_url("knowledgebases") ?>"> <i class="icon-database"></i>Pengetahuan</a> </li>
      <li> <a href="<?php
echo site_url("create_ticket") ?>"> <i class="icon-shopping-bag"></i> Buat Tiket</a> </li>
      <li> <a href="<?php
echo site_url("register_member") ?>"> <i class="icon-people"></i> Pengguna </a> </li>
      <li> <a href="<?php
echo site_url("operator") ?>"> <i class="icon-people"></i> Operator </a> </li>
      <li> <a href="<?php
echo site_url("report_ticket") ?>"> <i class="icon-survey"></i> Laporan </a> </li>
    </ul>
  </div>
<?php endif; ?>
  <div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="row-fluid">
        <div class="span3">
          <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-file"></i></span>
              <h5>Tiket Terakhir</h5>
            </div>
            <div class="widget-content">
            <table class="table table table-condensed table-hover table-striped">
            <thead>
              <tr>
                <th>#NO</th>
                <th>JUDUL</th>
                <th>TANGGAL</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($last_ticket as $row) :?>
                <tr>
                  <td><?php echo $row->no_ticket; ?></td>
                  <td><?php echo $row->title; ?></td>
                  <td><?php echo $row->date; ?></td>
                </tr>
              <?php endforeach?>
            </tbody>
          </table>
            </div>
          </div>
        </div>
        <div class="span3">
         <div class="widget-box">
          <div class="widget-title"> <span class="icon">
            <i class="icon-refresh"></i> </span><h5>Aktifitas Pengguna</h5>
          </div>
          <div class="widget-content">
          <table class="table table table-condensed table-hover table-striped">
            <thead>
              <tr>
                <th>#NO</th>
                <th>NAMA LENGKAP</th>
                <th>LOGIN TERAKHIR</th>
              </tr>
            </thead>
            <tbody>
              <?php $no =0; ?>
              <?php foreach($last_login as $row) :?>
                <?php $no++; ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row->full_name; ?></td>
                  <td><?php echo $row->last_login; ?></td>
                </tr>
              <?php endforeach?>
            </tbody>
          </table>
          </div>
          </div>
        </div>
        <div class="span6">
           <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-refresh"></i> </span>
                <h5>Data Pengetahuan Terakhir</h5>
              </div>
              <div class="widget-content">
                <table class="table table table-condensed table-hover table-striped">
                <tbody>
                  <?php $no =0; ?>
                  <?php foreach($last_knowledgebase as $row) :?>
                    <?php $no++; ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td>
                        <a href="<?=site_url("knowledgebases/$row->uuid/".url_title($row->title, '_'))?>"><strong><?php echo $row->title; ?></strong></a>
                        <br>
                        <?php echo word_limiter($row->content,40); ?>
                      </td>
                    </tr>
                  <?php endforeach?>
                </tbody>
              </table>
              </div>
           </div>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>

<div class="row-fluid">
    <div id="footer" class="span12"> 2015 &copy; Aplikasi Pengaduan Polda Metro Jaya page rendered in
    <strong>{elapsed_time}</strong> s</div>
  </div>

<div class="modal hide fade" id="ubahpassword" class="span4 offset4" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Ubah Password</h4>
  </div>
<div class="modal-body">
  <div id="result"></div>
  <form method="post" id="fubahpass" action="<?php
echo site_url("home/ubahpass"); ?>" >
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
  <button type="submit" class="btn btn-primary">Simpan</button>
</div>
</form>
</div>
<script src="<?php
echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php
echo base_url(); ?>assets/js/jquery.ui.custom.js"></script>
<script src="<?php
echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php
echo base_url(); ?>assets/js/maruti.js"></script>
<script src="<?php
echo base_url(); ?>assets/js/nicEdit.js"></script>
<script src="<?php
echo base_url(); ?>assets/js/jquery.autocomplete.min.js"></script>
<script src="<?php
echo base_url(); ?>assets/js/jquery.form.js"></script>
<script src="<?php
echo base_url(); ?>assets/js/pos.js"></script>
<script type="text/javascript">
   var cfajax = fconfig("#pesan",true);
  $('#fajax').ajaxForm(cfajax);
</script>
</body>
</html>
