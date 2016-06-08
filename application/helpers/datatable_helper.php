<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function gencheckbox($class,$name,$value){
    return "<input type='checkbox' class='$class' name='$name'  value='$value'  />";
}

function getakses($id,$usertypeid,$menu){
  $CI =& get_instance();
  $sql = "select * from ticket_auth_user where modul_id ='$id' AND type_id='$usertypeid'";
  $query = $CI->db->query($sql);
  if($query->num_rows()==1){
    switch ($menu){
      case "v":
        return $query->row()->view;
        break;
      case "c":
        return $query->row()->create;
        break;
      case "u":
        return $query->row()->update;
        break;
      case "d":
        return $query->row()->delete;
        break;
      case "p":
        return $query->row()->print;
        break;
    }
  }else{
    switch ($menu){
      case "v":
        return "n";
        break;
      case "c":
        return "n";
        break;
      case "u":
        return "n";
        break;
      case "d":
        return "n";
        break;
      case "p":
        return "n";
        break;
    }
  }

}

function format_ticket_knowledgebase($id,$title,$create_date,$updated,$info){
  $date = ($updated == '0000-00-00') ? datetimes($create_date) : " update ".datetimes($updated);
  $html ="
  <div class='list-info'>
    <div class='list-info-title'>
      <h4><i class='moon-bookmark'></i>$title</h4>
      <div class='postdate'>".$date."</div>
      <p class='main-pesan'>
          ".limitword($info)." <a data-id='$id' class='detail-info' href='".site_url('knowledgebases/detail/'.$id)."'>Read More</a>
      </p>
    </div>
</div>";
  return $html;
}

function format_ticket_news($id,$title,$create_date,$info){
  $date =  datetimes($create_date);
  $html ="
  <div class='list-info'>
    <div class='list-info-title'>
      <h4><i class='moon-bookmark'></i>$title</h4>
      <div class='postdate'>".$date."</div>
      <p class='main-pesan'>
          ".limitword($info)." <a data-id='$id' class='detail-info' href='".site_url('front/news/'.$id)."'>Read More</a>
      </p>
    </div>
</div>";
  return $html;
}

function format_message($title,$full_name,$create_date,$message){
    $html = "
  <div class='list-pesan'>
    <span class='title-pesan'>
      <h4><i class='moon-bookmark'></i>$title</h4></span>
      <span class='author-pesan text-error'><i class='moon-user-4'></i> <strong>from : $full_name</strong></span>
      - <span class='date-pesan text-warning'><strong>".datetimes($create_date,true)." </strong></span>
  <p class='main-pesan'>$message</p></div>";
  return $html;
}
function format_template($id,$title,$message){
    $html ="
  <div class='list-pesan'>
    <input type='hidden' value='$id' class='template_id'/>
    <span class='title-pesan'><h4><i class='moon-bookmark'></i>$title</h4></span>
  <p class='main-pesan'>$message</p></div>";
  return $html;
}

function limitword($text){
  return word_limiter(strip_tags($text),60);
}

function ticket_update($uuid,$user,$update){
   $ci =& get_instance();
   $ci->db->where('uuid_ticket',$uuid);
   $ci->db->where('uuid_user',$ci->session->userdata('userid'));
   $query = $ci->db->get('ticket_notify');


  $update = (is_null($update)) ? "" : datetimes($update);
  if($query->num_rows() > 0){
    if($query->row()->read == 0 ){
      return "<span class='badge badge-info'>".$update."</span>";
    }elseif($query->row()->read == 1 ){
      return "<span class='badge badge-inverse'>read</span>";
    }
  }else{
    return "<span class='badge badge-info'>unread</span>";
  }

}
