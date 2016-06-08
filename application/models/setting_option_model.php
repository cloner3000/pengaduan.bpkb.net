<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting_option_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_option')->result();
    }

    function dataajax(){
      $this->datatables
        ->select('id,key,value')
        ->from("ticket_option")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","id");
      return  $this->datatables->generate();
    }

    function save($data){
      if($data['id'] != ''){
			$this->db->where('id',$data['id']);
			$this->db->update('ticket_option',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
			$this->db->insert('ticket_option',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function detail($id){
      $this->db->select("id,name");
      $this->db->where("id",$id);
      $query = $this->db->get("ticket_option");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function delete($id){
        $this->db->where("id",$id);
        $this->db->delete("ticket_option");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
