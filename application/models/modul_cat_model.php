<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modul_cat_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show($page,$offset,$search){
       $query = $this->db->query("select * from ticket_modul_cat where ticket_modul_cat like '%$search%' order by id limit $page,$offset");
       return array(
          "data"=>$query->result(),
          "count"=>$this->db->query("select * from ticket_modul_cat where ticket_modul_cat like '%$search%'")->num_rows(),
          "result"=>$query->num_rows()
       );
    }

    function save($data){
      if($data['id'] != ''){
			$this->db->where('id',$data['id']);
			$this->db->update('ticket_modul_cat',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
				$this->db->insert('ticket_modul_cat',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function delete($id){
        $this->db->where("id",$id);
        $this->db->delete("ticket_modul_cat");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }

    function dataajax(){
      $this->datatables
        ->select('ticket_modul_cat.id,modul_cat,icon')
        ->from("ticket_modul_cat")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","ticket_modul_cat.id");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select("ticket_modul_cat.id,modul_cat,icon");
      $this->db->where("ticket_modul_cat.id",$id);
      $query = $this->db->get("ticket_modul_cat");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }
}
