<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Type_user_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_type_user')->result();
    }

    function dataajax(){
      $this->datatables
        ->select('type_id,name')
        ->from("ticket_type_user")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","type_id");
      return  $this->datatables->generate();
    }

    function save($data){
      if($data['type_id'] != ''){
			$this->db->where('type_id',$data['type_id']);
			$this->db->update('ticket_type_user',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
			$this->db->insert('ticket_type_user',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function detail($id){
      $this->db->select("type_id,name");
      $this->db->where("type_id",$id);
      $query = $this->db->get("ticket_type_user");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function delete($id){
        $this->db->where("type_id",$id);
        $this->db->delete("ticket_type_user");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
