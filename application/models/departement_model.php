<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Departement_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function get(){
       $query = $this->db->query("select * from ticket_departement order by departement_name");
       return $query;
    }
    function get_tree(){
       $query = $this->db->query("select departement_id as id,departement_name as name,parent
       from ticket_departement order by departement_name");
       return $query;
    }
    
    function show($id){
      $this->db->where("departement_id",$id);
      $query = $this->db->get("ticket_departement")->row();
      return $query;
    }

    function save($data){
      if($data['departement_id'] != ''){
			$this->db->where('departement_id',$data['departement_id']);
			$this->db->update('ticket_departement',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
				$this->db->insert('ticket_departement',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function delete($id){
        $this->db->where("departement_id",$id);
        $this->db->delete("ticket_departement");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }

    function dataajax(){
      $this->datatables
        ->select('departement_id,departement_name')
        ->from("ticket_departement")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","departement_id");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select("departement_id,departement_name,parent");
      $this->db->where("departement_id",$id);
      $query = $this->db->get("ticket_departement");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }
}
