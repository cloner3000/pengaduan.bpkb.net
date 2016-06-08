<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Replay_ticket extends CI_Controller
{

  public $message;
  private $tipe;

  function __construct() {
    parent::__construct();
    backHandle();
    $c = $this->uri->rsegment(1);
    $this->load->model("$c" . "_model", $c);
    $this->load->model("departement" . "_model", "departement");
    $this->load->library('user_agent');
  }

  function gettipe() {
    return $this->tipe = $this->session->userdata('tipe');
  }

  function index() {
    $check = $this->userauth->checkmenu();
    $menu = $this->userauth->generate_menu($this->gettipe());
    $c = $this->uri->rsegment(1);
    $query = $this->departement->get_tree();
    $option = $this->build_menu($query->result_array());
    $data = array(
    "menus" => $menu,
    "option" => $option,
    "user" => $this->userauth->getdatauser(),
    "title" => strtoupper(str_replace("_", " ", $c)), "btn" => $check);
    $this->template->load("main_template", "page/page_$c", $data);
  }

  function dataajax() {
    echo $this->replay_ticket->dataajax();
  }

  function answer() {
    $this->userauth->checkmenu("replay_ticket");
    $id = $this->uri->segment("3");    
    $this->db->where('uuid',$id);
    $query = $this->db->get('ticket_ticket');
    if($query->num_rows() == 0){
       return redirect($this->agent->referrer(), 'refresh');
    }
    $departement = $this->departement->show($query->row()->departement_id);
    $option = $this->build_menu($this->departement->get_tree()->result_array());
    $menu = $this->userauth->generate_menu($this->gettipe());
    $c = $this->uri->rsegment(1);
    $this->notify($id,$this->session->userdata('userid'),1);
    $data = array(
      "menus" => $menu,
      "user" => $this->userauth->getdatauser(), 
      "title" => strtoupper(str_replace("_", " ", $c)),
      "detail" => $this->replay_ticket->detail($id),
      "status" => $this->db->get('ticket_status'),
      "answer" => $this->replay_ticket->get_answer($id), 
      "id" => $id,
      "option" => $option,
      "departement"=>$departement->departement_name,
      "history" => $this->get_history($id)
      );
    $this->template->load("main_template", "page/page_replay_answer", $data);
  }

  function save_answer() {
    methodpage();
    $uuid = $this->uuid->v4();
    $ticket_uuid = $this->input->post("ticket_id");
    $answer = $this->input->post("answer");
    $user_uuid = $this->session->userdata('userid');
    $date = date("Y-m-d H:i");
    $param = array('uuid' => $uuid, 'ticket_uuid' => $ticket_uuid, 'answer' => $answer, 'user_uuid' => $user_uuid, 'date' => $date);
    $this->db->insert('ticket_answer', $param);

    // make notify
    $this->db->where('uuid',$ticket_uuid);
    $this->db->update("ticket_ticket",array('update' => date("Y-m-d")));
    $this->generate_notify($ticket_uuid);
    $url = site_url("replay_ticket/answer/" . $ticket_uuid);
    return redirect($url,'refresh');
  }

  function change_status() {
    methodpage();
    $id = $this->input->post("id");
    $status_id = $this->input->post("status_id");
    $this->db->where('status_id', $status_id);
    $status = $this->db->get('ticket_status')->row();
    $this->db->where('uuid', $id);
    $this->db->update('ticket_ticket', array('status_id' => $status_id));
    history($id,$this->session->userdata('userid'),$status->status);
    $url = site_url("replay_ticket/answer/" . $id);
    return redirect($url, 'refresh');
  }

  function del_answer() {
    $this->userauth->checkmenu("replay_ticket");
    $id = $this->uri->segment("3");
    $this->db->where('uuid', $id);
    $this->db->delete('ticket_answer');
    return redirect($this->agent->referrer(), 'refresh');
  }

  function save() {
    $this->userauth->checkmenu();
    methodpage();
    $iddata = $this->input->post("iddata");
    $departement = $this->input->post("departement_id");
    $priority = $this->input->post("priority_id");

   foreach ($iddata as $row) {
      $this->db->where('uuid', $row);
      $this->db->update('ticket_ticket', array("departement_id" => $departement, "priority_id" => $priority));
    }
    echo setpesan("succes", "assign ticket berhasil");
  }

  function delete() {
    $this->userauth->checkmenu();
    methodpage();
    $id = $this->input->post("id");
    $data = $this->replay_ticket->delete($id);
  }

  function save_assign_operator(){
    methodpage();
    $departement_id = $this->input->post("departement_id");
    $departement_name = $this->departement->show($departement_id)->departement_name;
    $id = $this->input->post("uuid");
    $this->db->where('uuid', $id);
    $this->db->update('ticket_ticket', array('departement_id' => $departement_id));

    $this->session->set_flashdata('msg', setpesan('success',"assign ticket telah disimpan"));
    history($id,$this->session->userdata('userid'),"assign to departement",$departement_name);

    $url = site_url("replay_ticket/answer/" . $id);
    return redirect($url, 'refresh');
  }

  function notify($ticket_uuid,$user,$read=1,$title="") {
    $this->db->where('uuid_ticket', $ticket_uuid);
    $this->db->where('uuid_user', $user);
    $query = $this->db->get('ticket_notify');
    if ($query->num_rows() > 0) {
      $this->db->update('ticket_notify', array("read" => $read));
    }
    else {
      $this->db->insert('ticket_notify',
        array(
          "uuid_ticket" => $ticket_uuid,
          "uuid_user"   => $user,
          "read"        => $read,
          "title"       => $title,
          "date_feed"   => date('Y-m-d H:i:s')
        ));
    }
  }

  function get_history($ticketid){
    $this->db->where('ticket_history.uuid',$ticketid);
    $this->db->order_by('date','ASC');
    $this->db->join('ticket_user','ticket_user.uuid = ticket_history.user_uuid','left');
    return $this->db->get('ticket_history')->result();
  }
  
  function has_children($rows,$id) {
     foreach ($rows as $row) {
       if ($row['parent'] == $id)
         return true;
     }
     return false;
   }
   
   function build_menu($rows,$parent=-1)
   {  
     $result = "";
     foreach ($rows as $row)
     {
       if ($row['parent'] == $parent){
         if ($this->has_children($rows,$row['id'])){
           $result.="<optgroup label='$row[name]'>";
           $result.= "<option value='$row[id]'>$row[name]</option>";
           $result.= $this->build_menu($rows,$row['id']);
           $result.="</optgroup>"; 
         }else{
            $result.= "<option value='$row[id]'>$row[name]</option>";
         }
       }
     }
     return $result;
   }

  function get_ticket($uuid)
  {
    $this->db->where('uuid',$uuid);
    $query = $this->db->get('ticket_ticket')->row();
    return $query;
  }

  function get_user($uuid)
  {
    $this->db->where('uuid',$uuid);
    $query = $this->db->get('ticket_user')->row();
    return $query;
  }

  function generate_notify($ticket_uuid){
    $this->db->where('ticket_uuid',$ticket_uuid);
    $this->db->join('ticket_user','ticket_user.uuid = ticket_answer.user_uuid','LEFT');
    $this->db->group_by("ticket_answer.user_uuid");
    $query = $this->db->get('ticket_answer');

    $detail_ticket = $this->get_ticket($ticket_uuid);
    $detail_user = $this->get_user($detail_ticket->user_uuid);
    $user_email  = array();
    $user_email[$detail_ticket->user_uuid] = $detail_user->email;

    if($query->num_rows() > 0){
      foreach ($query->result() as $list) {
        $user_email[$list->user_uuid] = $list->email;
      }
      foreach($user_email as $key => $val){
        $this->send_email_notif($val,site_url("replay_ticket/answer/" . $ticket_uuid));
        $this->notify($ticket_uuid,$key,0,$detail_ticket->title);
      }
    }
  }

  function send_email_notif($to,$url){
    $config['charset'] = 'utf-8';
    $config['wordwrap'] = TRUE;
    $config['mailtype'] = 'html';
    $this->email->initialize($config);

    $this->email->from('pengaduan@'.$_SERVER['SERVER_NAME'], 'Pengaduan Polda Metro Jaya');
    $this->email->to($to);
    $this->email->subject('Jawaban Tiket Pengaduan');
    $this->email->message('Tiket pengaduan Anda sudah ada balasan silahkan cek di alamat ini '."<a href='$url'>klik disini</a>");
    $this->email->send();
  }
}
