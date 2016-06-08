<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_modul_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show($page,$offset,$search){
       $sql1 = "select *,ticket_modul.id as modulid from ticket_modul
       LEFT JOIN ticket_modul_cat ON (`ticket_modul`.`modul_catid` = `ticket_modul_cat`.`id`)
       where modul like '%$search%' order by id ";
       $sql2 = "limit $page,$offset";
       $query = $this->db->query($sql1.$sql2);
       return array(
          "data"=>$query->result(),
          "count"=>$this->db->query($sql1)->num_rows(),
          "result"=>$query->num_rows()
       );
    }

    function modul_cat(){
       return $query = $this->db->query("select * from ticket_modul_cat order by modul_cat ASC")->result();

    }

    function save($data){
      if($data['id'] != ''){
			$this->db->where('id',$data['id']);
			$this->db->update('ticket_modul',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
				$this->db->insert('ticket_modul',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function delete($id){
        $this->db->where("id",$id);
        $this->db->delete("ticket_modul");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }


      function dataajax(){
      $this->datatables
        ->select('ticket_modul.id,modul_cat,modul_name,url,ticket_modul.icon')
        ->from("ticket_modul")
        ->join("ticket_modul_cat","ticket_modul_cat.id = ticket_modul.modul_catid","left")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","ticket_modul.id");
      return  $this->datatables->generate();
    }


    function detail($id){
      $this->db->select("ticket_modul.id,modul_name,icon,url,modul_catid");
      $this->db->where("ticket_modul.id",$id);
      $query = $this->db->get("ticket_modul");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }
}
