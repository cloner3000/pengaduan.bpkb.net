<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_ticket_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_ticket')->result();
    }

    function dataajax(){
      $this->datatables
        ->select('ticket_ticket.uuid,no_ticket,status,title,question,full_name,date,topic,update,user_uuid')
        ->join('ticket_status','ticket_status.status_id = ticket_ticket.status_id')
        ->join('ticket_user','ticket_user.uuid = ticket_ticket.user_uuid')
        ->join('ticket_topic','ticket_topic.topic_id = ticket_ticket.topic_id')
        ->unset_column('question')
        ->unset_column('user_uuid')
        ->unset_column('ticket_ticket.uuid')
        ->from("ticket_ticket")
        ->edit_column('title','<a class="text-error" href="'.site_url("replay_ticket/answer").'/$4">$1</a> <br> $2','title,limitword(question),question,ticket_ticket.uuid')
        ->edit_column('update','$1','ticket_update(ticket_ticket.uuid,user_uuid,update)')
        ->edit_column('date','$1','datetimes(date)')
        ->add_column('link',"<a href='".site_url("replay_ticket/answer")."/$1' class='btn btn-success'>replay</a>","ticket_ticket.uuid");
        $tipe = $this->session->userdata('tipe');
      if($tipe == 1){
        $this->datatables->where('user_uuid',$this->session->userdata('userid'));
      }elseif($tipe == 2){
       
        $this->datatables->or_where('ticket_ticket.departement_id',$this->session->userdata('deptid'));
      }
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select("*");
      $this->db->where("status_id",$id);
      $query = $this->db->get("ticket_ticket");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function delete($id){
        $this->db->where("status_id",$id);
        $this->db->delete("ticket_ticket");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
