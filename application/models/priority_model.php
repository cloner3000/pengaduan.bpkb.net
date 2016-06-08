<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Priority_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_priority')->result();
    }

    function dataajax(){
      $this->datatables
        ->select('priority_id,priority')
        ->from("ticket_priority")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","priority_id");
      return  $this->datatables->generate();
    }

    function save($data){
      if($data['priority_id'] != ''){
			$this->db->where('priority_id',$data['priority_id']);
			$this->db->update('ticket_priority',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
			$this->db->insert('ticket_priority',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function detail($id){
      $this->db->select("priority_id,priority");
      $this->db->where("priority_id",$id);
      $query = $this->db->get("ticket_priority");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function delete($id){
        $this->db->where("priority_id",$id);
        $this->db->delete("ticket_priority");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
