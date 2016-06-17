<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Replay_ticket_model extends CI_Model{

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
        ->edit_column("ticket_ticket.uuid","<a href='".site_url("replay_ticket/answer")."/$1' class='btn btn-success'>replay</a>","ticket_ticket.uuid")
        ->edit_column('title','<a class="text-error" href="'.site_url("replay_ticket/answer").'/$3">$1</a> <br> $2','title,limitword(question),question,ticket_ticket.uuid')
        ->edit_column('date','$1','datetimes(date)');
      return  $this->datatables->generate();
    }
    
    function save($data){
      if($data['status_id'] != ''){
			$this->db->where('status_id',$data['status_id']);
			$this->db->update('ticket_ticket',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
			$this->db->insert('ticket_ticket',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function detail($id){
      $query = $this->db
        ->select('ticket_ticket.uuid,no_ticket,status,title,question,full_name,date,topic,update,user_uuid,priority,departement_name,file_name,file_name_encrypt,operator_uuid')
        ->join('ticket_status','ticket_status.status_id = ticket_ticket.status_id')
        ->join('ticket_file','ticket_file.ticket_uuid = ticket_ticket.uuid',"left")
        ->join('ticket_user','ticket_user.uuid = ticket_ticket.user_uuid')
        ->join('ticket_topic','ticket_topic.topic_id = ticket_ticket.topic_id')
        ->join('ticket_priority','ticket_priority.priority_id = ticket_ticket.priority_id')
        ->join('ticket_departement','ticket_departement.departement_id = ticket_ticket.departement_id',"left")
        ->from("ticket_ticket")
        ->where('ticket_ticket.uuid',$id)->get();
        if($query->num_rows() > 0 ){
          return $query->row();
        }
        return false;
    }

    function get_answer($ticket_uuid){
        $this->db->select("*, ticket_answer.uuid as auuid");
        $query = $this->db->join('ticket_user',"ticket_user.uuid = ticket_answer.user_uuid")
        ->order_by("date","ASC")
        ->where('ticket_uuid',$ticket_uuid)->get("ticket_answer");
        if($query->num_rows() > 0 ){
          return $query->result();
        }
        return false;
    }

    function delete($id){
        $this->db->where("status_id",$id);
        $this->db->delete("ticket_ticket");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }

    function get_operator($dept_id){
        $this->db->where('departement_id',$dept_id);
        $this->db->where('type_id',2);
        return $this->db->get("ticket_user")->result();
    }
}
