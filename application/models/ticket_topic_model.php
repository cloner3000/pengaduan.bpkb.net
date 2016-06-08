<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticket_topic_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_topic')->result();
    }

    function dataajax(){
      $this->datatables
        ->select('topic_id,topic')
        ->from("ticket_topic")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","topic_id");
      return  $this->datatables->generate();
    }

    function save($data){
      if($data['topic_id'] != ''){
			$this->db->where('topic_id',$data['topic_id']);
			$this->db->update('ticket_topic',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
			$this->db->insert('ticket_topic',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function detail($id){
      $this->db->select("topic_id,topic");
      $this->db->where("topic_id",$id);
      $query = $this->db->get("ticket_topic");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function delete($id){
        $this->db->where("topic_id",$id);
        $this->db->delete("ticket_topic");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
