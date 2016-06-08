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
echo base_url(); ?>assets/css/maruti-login.css" />
<meta content="Supporting Ticket Application v 1.0" name="description" />
<meta content="ardani rohman - master.ardani@gmail.com" name="author" />
</head>
  <body>
    <div id="logo">
    </div>
    <div id="loginbox">

<form id="flogin" class="form-horizontal" method="post" action="<?php
echo site_url("register/save"); ?>">
<div class="control-group normal_text"><h3>Daftar</h3></div>
 <div id="pesan"></div>
<div class="control-group">
  <label class="control-label">Nama Lengkap</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="nama pengguna" name="full_name" required="required" />
  <input type="hidden" data-tag="input" name="uuid"  />
</div>
</div>
<div class="control-group">
  <label class="control-label">Jenis Kelamin</label>
<div class="controls">
    <select name="gender" data-tag="select" class="span2">
      <option value="L">Laki Laki</option>
      <option value="P">Perempuan</option>
    </select>
</div>
</div>
<div class="control-group">
  <label class="control-label">Identitas</label>
<div class="controls">
  <select name="type_identity" data-tag="select" class="span2" >
    <option value="KTP">KTP</option>
    <option value="SIM">SIM</option>
  </select>
 <input type="text" data-tag="input" placeholder="no identitas" class="span2" name="identity_no" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Telp</label>
<div class="controls">
  <input type="number" data-tag="input" placeholder="telp" class="span2" name="phone" required="required" />
  <input type="hidden" data-tag="input" name="type_id" value="1"/>
</div>
</div>
<div class="control-group">
  <label class="control-label">Email</label>
<div class="controls">
  <input type="email" data-tag="input" placeholder="email" class="span2" name="email" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Password</label>
<div class="controls">
  <input type="password" data-tag="input" placeholder="password" class="span2" name="password" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Alamat</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="alamat" class="span4" name="address" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">RT/RT</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="RT" class="span1" name="rt" required="required" />
  <input type="text" data-tag="input" placeholder="RT" class="span1" name="rw" required="required" />
  <input type="text" data-tag="input" placeholder="Kelurahan" class="span2" name="village" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Kec.Kab / Provinsi</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="Kecamatan" class="span2" name="sub" required="required" />
  <input type="text" data-tag="input" placeholder="Provinsi" class="span2" name="province" required="required" />
</div>
</div>
  <div class="form-actions">
      <span class="pull-left"><a href="#"><i class="icon-home"></i>2015 &copy; Aplikasi Pengaduan Polda Metro Jaya </a></span>
      <span class="pull-right"><input type="submit" class="btn btn-success" value="Register" /></span>
    </div>
</form>
    </div>
    <script src="<?php
echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php
echo base_url(); ?>assets/js/nicEdit.js"></script>
    <script src="<?php
echo base_url(); ?>assets/js/jquery.form.js"></script>
    <script src="<?php
echo base_url(); ?>assets/js/maruti.login.js"></script>
    <script src="<?php
echo base_url(); ?>assets/js/pos.js"></script>
  </body>
</html>
