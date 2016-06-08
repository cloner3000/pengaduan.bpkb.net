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
      <form id="flogin" method="post" class="form-vertical" action="<?php echo site_url("login/dologin") ?>">
        <div class="control-group normal_text"><h3>Aplikasi Pengaduan Polda Metro Jaya</h3></div>
          <div id="pesan"></div>
        <div class="control-group">
          <div class="controls">
            <div class="main_input_box">
              <span class="add-on"><i class="icon-user"></i></span><input type="text" name="username" required="required" placeholder="Email" />
            </div>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <div class="main_input_box">
              <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password" required="required" placeholder="Password" />
            </div>
          </div>
        </div>
        <div class="control-group register">
        <div class="controls">
            <div class="main_input_box">
                <button type="submit" class="btn btn-success">Login</button>        
                <a class="btn btn-primary" href="<?php echo site_url('register'); ?>">Daftar</a>
          </div>
          </div>
        </div>
        <div class="form-actions">
          <span class="pull-left"><a href="#"><i class="icon-home"></i>Aplikasi Pengaduan Polda Metro Jaya &copy; 2015  </a></span>
          <span class="pull-right">
            
            <a class="btn btn-warning" href="<?php echo site_url('forget_password'); ?>">Lupa password</a>
            
          </span>
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
