<div class="span12">
<h3>Pencarian Pada Data Pengetahuan : "<?=$query?>"</h3>
<?php
if($qknow->num_rows()>0){
    foreach ($qknow->result()  as $list) {
      echo '
  <div class="news">
  <div class="newstitle">
  <a class="newstitlelink" href="'.site_url('front/knowledgebases/'.$list->uuid).'">'.$list->title.'</a>
      <div class="newsinfo">'.datetimes($list->created).'</div>
  </div>
  <div class="newcontent">
  '.limitword($list->content).'
  </div>
  <div class="news-more">
  <a data-id="'.$list->uuid.'" class="detail-info" href="'.site_url('front/knowledgebases/'.$list->uuid).'">Read More</a>
  </div>
  </div>';
    }
}else{
  echo setpesan("error","pencarian tidak ditemukan");
}
?>
<hr>
<h3>Pencarian Pada Berita : "<?=$query?>"</h3>
<?php
if($qnews->num_rows()>0){
    foreach ($qnews->result()  as $list) {
       echo '
  <div class="news">
  <div class="newstitle">
  <a class="newstitlelink" href="'.site_url('front/news/detail/'.$list->uuid).'">'.$list->title.'</a>
      <div class="newsinfo">'.datetimes($list->created).'</div>
  </div>
  <div class="newcontent">
  '.limitword($list->content).'
  </div>
  <div class="news-more">
  <a data-id="'.$list->uuid.'" class="detail-info" href="'.site_url('front/news/detail/'.$list->uuid).'">Read More</a>
  </div>
  </div>';
    }
}else{
  echo setpesan("error","pencarian tidak ditemukan");
}
?>
</div>
