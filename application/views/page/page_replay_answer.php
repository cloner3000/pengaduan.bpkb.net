
<div class="span6">
<div class="span12">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Jawab Pengaduan</h5>
  </div>
  <div class="widget-content">
  <?php
  $date = ($detail->update == '0000-00-00' || is_null($detail->update)) ? "Post : ".datetimes($detail->date) : " update ".datetimes($detail->update);
  ?>
  <h4><i class='moon-bookmark'></i> <?=$detail->title?></h4>
  <div class='postdate'><?=$date?> status : <?=$detail->status?></div>
  <span class='author-pesan text-error'><i class='moon-user-4'></i> <strong>dari : <?=$detail->full_name?></strong></span>
  <p><?=$detail->question?></p>
  <hr>
  <?php
  if($detail->file_name != "")
    echo "klik untuk mendownload file <a class='text-error' href='".site_url("attachment")."/$detail->file_name_encrypt'>$detail->file_name</a>";
  ?>
</div>
<?php if($this->session->userdata('tipe') != '1'): ?>
<form class="form-horizontal" method="post" action="<?=site_url('replay_ticket/change_status')?>">
<div class="control-group">
  <label class="control-label">Status</label>
<div class="controls">
  <input type="hidden" name="id" value="<?=$id?>">
  <select name="status_id" data-tag="select" class="select2 span5">
     <?php
        foreach($status->result() as $list){
          echo "<option value='$list->status_id'>$list->status</option>";
        }
      ?>
  </select> <button type="submit" class="btn btn-success">Update</button>
</div>
</div>
</form>
<?php endif; ?>
</div>
</div>

<?php if($answer): ?>
  <?php foreach ($answer as $list):?>
<div class="clearcol"></div>
<div class="span12 normal-margin">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>oleh :  <?=$list->full_name  ?> tanggal <?=datetimes($list->date)  ?></h5>
  </div>
  <div class="widget-content">
    <p><?=$list->answer?></p>
    <hr>
    <?php
      if($list->user_uuid == $this->session->userdata('userid')){
        echo "<a class='btn btn-inverse' data-uuid='$list->auuid' href='".site_url("replay_ticket/del_answer/".$list->auuid)."'>hapus</a>";
      }
    ?>
  </div>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>
<?php if($this->session->userdata('tipe') == '0' || $detail->status == "open"): ?>
<div class="clearcol"></div>
<div class="span12 normal-margin">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Balas :</h5>
  </div>
  <div class="widget-content">
    <form class="form-horizontal" method="post" action="<?=site_url('replay_ticket/save_answer')?>">
      <input type="hidden" name="ticket_id" value="<?=$id?>">
      <textarea name="answer" id='textarea' style="width: 100%;" placeholder="answer here"></textarea>
      <br/>
      <button type="submit" class="btn btn-primary">Jawab</button>
    </form>
  </div>
</div>
</div>
<?php endif; ?>
</div>
<?php if($this->session->userdata('tipe') != '1'): ?>
<div class="span6">
  <div class="span12">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Alihkan Pengaduan Ke <?php echo $departement?> </h5>
  </div>
  <div class="widget-content">
  <?php
   if($this->session->flashdata('msg')){
    echo $this->session->flashdata('msg');
   }
  ?>
  <form class="form-horizontal" action="<?=site_url("replay_ticket/save_assign_operator")?>" method="post">
  <input type="hidden" name="uuid" value="<?=$id?>"/>
  <div class="control-group">
    <label class="control-label">Departement</label>
  <div class="controls">
    <select name="departement_id" data-tag="select">
    <?php
      echo $option;
     ?>
  </select>
  </div>
  </div>
    <hr/>
    <button type="submit" class='btn btn-primary'>Alihkan Pengaduan</button>
    </form>
  </div>
  </div>
  </div>
  <div class="span12" style="margin-left: 0px !important;">
<div class="widget-box">
  <div class="widget-title">
    <span class="icon"><i class="icon-th-list"></i></span>
    <h5>History Pengaduan</h5>
  </div>
  <div class="widget-content">
  <table class="table table-condensed table-hover table-striped">
    <thead>
      <tr>
        <th>NO</th>
        <th>STATUS</th>
        <th>DEPARTEMENT BARU</th>
        <th>TANGGAL</th>
        <th>OPERATOR</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no=0;
      foreach ($history as $list) {
        $no++;
        echo "<tr>
          <td>$no</td>
          <td>$list->status</td>
          <td>$list->new_departement</td>
          <td>".datetimes($list->date)."</td>
          <td>$list->full_name</td>
        </tr>";
      }
      ?>
    </tbody>
  </table>
  </div>
  </div>
  </div>
</div>
</div>
<?php endif; ?>

<style type="text/css" media="screen">
  label.radio{
    cursor: hand;
  }
  label.radio:hover{
      background-color: #eee;
  }
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $("label.radio").click(function(){
      $(this).find("input").prop('checked',true);
    });
  });
</script>
