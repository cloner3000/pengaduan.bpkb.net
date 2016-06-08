<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticket_status_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_status')->result();
    }

    function dataajax(){
      $this->datatables
        ->select('status_id,status')
        ->from("ticket_status")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","status_id");
      return  $this->datatables->generate();
    }

    function save($data){
      if($data['status_id'] != ''){
			$this->db->where('status_id',$data['status_id']);
			$this->db->update('ticket_status',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
			$this->db->insert('ticket_status',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function detail($id){
      $this->db->select("status_id,status");
      $this->db->where("status_id",$id);
      $query = $this->db->get("ticket_status");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function delete($id){
        $this->db->where("status_id",$id);
        $this->db->delete("ticket_status");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
