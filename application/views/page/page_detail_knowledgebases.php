<div class="span12">
<div class="widget-box">
  <div class="widget-title">
  <?php if($detail) : ?>
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5><?php echo $detail->title ?></h5>
  </div>
  <div class="widget-content nopadding">
  <?php
  $date = ($detail->updated == '0000-00-00') ? "publish ".datetimes($detail->created) : " update ".datetimes($detail->updated);
  $html ="
    <div class='list-info'>
      <div class='list-info-title'>
        <div class='postdate'>".$date."</div>
        <p class='main-pesan'>
            $detail->content
        </p>
      </div>
  </div>";
  echo $html;
  ?>
  </div>
<?php
  else :
    echo setpesan('error','Pengetahuan tidak ditemukan');
 ?>
<?php endif; ?>

</div>
</div>
