<!DOCTYPE html>
<html lang="en">
<head>
<title>PENGADUAN POLDA METRO JAYA</title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/maruti-login.css" />
<meta content="Supporting Ticket Application v 1.0" name="description" />
<meta content="ardani rohman - master.ardani@gmail.com" name="author" />
</head>
  <body>
    <div id="logo">
    </div>
    <div id="loginbox">
      <form id="flogin" method="post" class="form-vertical" action="<?php echo site_url("forget_password/reset") ?>">
        <div class="control-group normal_text"><h3>Lupa Password</h3></div>
          <div id="pesan"></div>
        <div class="control-group">
          <div class="controls">
            <div class="main_input_box">
              <span class="add-on"><i class="icon-user"></i></span><input type="email" name="email" required="required" placeholder="Email" />
            </div>
          </div>
        </div>
        <div class="form-actions">
          <span class="pull-left"><a href="#"><i class="icon-home"></i>Aplikasi Pengaduan Polda Metro Jaya &copy; 2015 </a></span>
          <span class="pull-right"><input type="submit" class="btn btn-success" value="Reset" /></span>
        </div>
      </form>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/nicEdit.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/maruti.login.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pos.js"></script>
  </body>
</html>
