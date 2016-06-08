<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assign_ticket_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_ticket')->result();
    }

    function dataajax(){
      $this->datatables
        ->select('ticket_ticket.uuid,no_ticket,status,title,question,full_name,date,topic,update,user_uuid,priority,departement_name')
        ->join('ticket_status','ticket_status.status_id = ticket_ticket.status_id')
        ->join('ticket_user','ticket_user.uuid = ticket_ticket.user_uuid')
        ->join('ticket_topic','ticket_topic.topic_id = ticket_ticket.topic_id')
        ->join('ticket_priority','ticket_priority.priority_id = ticket_ticket.priority_id')
        ->join('ticket_departement','ticket_departement.departement_id = ticket_ticket.departement_id',"left")
        ->unset_column('question')
        ->unset_column('user_uuid')
        ->from("ticket_ticket")
        ->edit_column('update','$1','ticket_update(ticket_ticket.uuid,user_uuid,update)')
        ->edit_column("ticket_ticket.uuid","<label class='radio'>
        <input type='checkbox' class='data-radio' name='iddata[]' value='$1' />
        </label>","ticket_ticket.uuid")
        ->edit_column('title','<a class="text-error" href="'.site_url("replay_ticket/answer").'/$3">$1</a> <br> $2','title,limitword(question),question,ticket_ticket.uuid')
        
        ->edit_column('date','$1','datetimes(date)')
        ->add_column("delete","<a href='#' class='btn btn-danger deleteticket' data-id='$1'>DELETE</a>","ticket_ticket.uuid");
      return  $this->datatables->generate();
    }

    function delete($id){
        $this->db->where("uuid",$id);
        $this->db->delete("ticket_ticket");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
