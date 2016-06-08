<div class="span4">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Profil Pengguna</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" class="form-horizontal" method="post" action="<?php echo site_url("home/save_profile"); ?>">
<div class="control-group">
  <label class="control-label">Nama Lengkap</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="nama operator" name="full_name" value="<?=$profile->full_name?>" required="required" />
  <input type="hidden" data-tag="input" name="uuid"value="<?=$profile->uuid?>"  />
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
    <?php
      $data = array("SIM","KTP");
      foreach ($data as $list) {
        if($list == $profile->type_identity){
          echo "<option selected >$list</option>";
        }else{
          echo "<option >$list</option>";
        }
      }
    ?>
  </select>
 <input type="text" data-tag="input" placeholder="no identitas" class="span5" name="identity_no" value="<?=$profile->identity_no?>" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Telp</label>
<div class="controls">
  <input type="number" data-tag="input" placeholder="telp" class="span5" name="phone" value="<?=$profile->phone?>" required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Email</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="email" class="span5" name="email" value="<?=$profile->email?>"  required="required" />
</div>
</div>

<div class="control-group">
  <label class="control-label">Alamat</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="alamat" class="span10" name="address" value="<?=$profile->address?>"  required="required" />
</div>
</div>
<div class="control-group">
  <label class="control-label">RT/RT</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="RT" class="span3" name="rt" required="required" value="<?=$profile->rt?>" />
  <input type="text" data-tag="input" placeholder="RT" class="span3" name="rw" required="required" value="<?=$profile->rw?>" />
  <input type="text" data-tag="input" placeholder="Kelurahan" class="span4" name="village" required="required" value="<?=$profile->village?>" />
</div>
</div>
<div class="control-group">
  <label class="control-label">Kecamatan / Provinsi</label>
<div class="controls">
  <input type="text" data-tag="input" placeholder="Kecamatan" class="span6" name="sub" required="required" value="<?=$profile->sub?>" />
  <input type="text" data-tag="input" placeholder="Provinsi" class="span6" name="province" required="required" value="<?=$profile->province?>" />
</div>
</div>
<div class="well well-small"><button type="submit" class="btn btn-primary">UBAH</button></div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var url = getBaseURL();
  var cfajax = fconfig("#pesan",false);
  $('#fajax').ajaxForm(cfajax);
});
</script>
