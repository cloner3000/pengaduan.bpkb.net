<div class="span12">
<div class="widget-box">
  <div class="widget-title">
  <?php if($detail) : ?>
  <span class="icon"><i class="icon-th-list"></i></span>
    <h5>Detail Berita</h5>
  </div>
  <div class="widget-content">
  <?php
  $date = "publish ".datetimes($detail->created);
  $html ="
    <div class='news'>
    <div class='newstitle'>
      <h4 class='newstitlelink'>$detail->title</h4>
      <div class='newsinfo'>".$date."</div>
    </div>
      <div class='newcontent'
        <p>$detail->content</p>
    </div>
  </div>";
  echo $html;
  ?>
  </div>
<?php
  else :
    echo setpesan('error','news tidak ditemukan');
 ?>
<?php endif; ?>

</div>
</div>
