<div class="span6">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Buat Tiket</h5>
  </div>
  <div class="widget-content">
<div id="pesan"></div>
<form id="fajax" class="form-horizontal" method="post" action="<?php echo site_url("create_ticket/save"); ?>">
<div class="control-group">
  <label class="control-label">Judul</label>
  <div class="controls">
    <input type="text" data-tag="input" placeholder="judul" name="title" required="required" />
    <input type="hidden" data-tag="input" placeholder="judul" name="uuid"  />
  </div>
</div>
<div class="control-group">
  <label class="control-label">Topik</label>
<div class="controls">
  <select name="topic_id" data-tag="select" class="select2 span5">
     <?php
        foreach($topic->result() as $list){
          echo "<option value='$list->topic_id'>$list->topic</option>";
        }
      ?>
  </select>
</div>
</div>
<?php if($this->session->userdata('tipe') != '2'): ?>
<div class="control-group">
  <label class="control-label">Prioritas</label>
<div class="controls">
  <select name="priority_id" data-tag="select" class="select2 span5">
     <?php
        foreach($priority->result() as $list){
          echo "<option value='$list->priority_id'>$list->priority</option>";
        }
      ?>
  </select>
</div>
</div>
<?php endif; ?>
<div class="control-group">
<label class="control-label">Isi </label>
<div class="controls">
<textarea name="question" style="width: 100%;" data-tag="textarea"  id="textarea"></textarea>
</div>
</div>
<div class="control-group">
<label class="control-label">Lampiran : </label>
<div class="controls">
<input type="file" name='attachment'>
  <br>
  <small>berkas maksimal ukuran 1 mb dan tipe jpeg, png, pdf</small>
</div>
</div>
<div class="well well-small"><?php echo genbutton("C",$btn['C']); ?></div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
var oTable;
$(document).ready(function() {
  var url = getBaseURL();
  var cfajax = fconfig("#pesan",false);
  $('#fajax').ajaxForm(cfajax);
});
</script>
