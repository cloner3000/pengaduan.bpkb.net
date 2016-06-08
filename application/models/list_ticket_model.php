<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class List_ticket_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_status')->result();
    }

    function dataajax($dept_id,$status_id){
      $this->datatables
        ->select('update,ticket_ticket.uuid,no_ticket,title,question,full_name,departement_name,status,date,user_uuid,priority,')
        ->join('ticket_status','ticket_status.status_id = ticket_ticket.status_id')
        ->join('ticket_user','ticket_user.uuid = ticket_ticket.user_uuid')
        ->join('ticket_topic','ticket_topic.topic_id = ticket_ticket.topic_id')
        ->join('ticket_priority','ticket_priority.priority_id = ticket_ticket.priority_id')
        ->join('ticket_departement','ticket_departement.departement_id = ticket_ticket.departement_id',"left")
        ->unset_column('question')
        ->unset_column('ticket_ticket.uuid')
        ->unset_column('user_uuid')
        ->from("ticket_ticket")
        ->edit_column('update','$1','ticket_update(ticket_ticket.uuid,user_uuid,update)')
        ->edit_column('title','<a class="text-error" href="'.site_url("replay_ticket/answer").'/$3">$1</a> <br> $2','title,question,ticket_ticket.uuid')
        ->edit_column('date','$1','datetimes(date)')
        ->add_column('link',"<a href='".site_url("replay_ticket/answer")."/$1' class='btn btn-success'>detail</a>","ticket_ticket.uuid");
      if($dept_id != "-"){
        $this->datatables->where('ticket_ticket.departement_id',$dept_id);
      }
      if($status_id != "-"){
        $this->datatables->where('ticket_ticket.status_id',$status_id);
      }
      return  $this->datatables->generate();
    }
}
