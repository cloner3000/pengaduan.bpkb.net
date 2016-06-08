<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class authority_access_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
       $this->db->join("ticket_modul_cat","ticket_modul_cat.id = ticket_modul.modul_catid","LEFT");
       $this->db->order_by("ticket_modul_cat.id","ASC");
       $query = $this->db->get("ticket_modul");
       return array(
          "data"=>$query->result(),
          "result"=>$query->num_rows()
       );
    }

    function load_authority_access($typeuser,$idmenu){
      $this->db->where("type_id = '$typeuser'");
      $this->db->where("modul_id = '$idmenu'");
      $query = $this->db->get("ticket_auth_user");

      if($query->num_rows()>0){
        $data = $query->row();
        return array(
        "v"=> ($data->view =="y")   ? "checked ='checked'":"",
        "c"=> ($data->create =="y") ? "checked ='checked'":"",
        "u"=> ($data->update =="y") ? "checked ='checked'":"",
        "d"=> ($data->delete =="y") ? "checked ='checked'":"",
        "p"=> ($data->print =="y")  ? "checked ='checked'":""
        );
      }else{
        return array(
        "v"=> "",
        "c"=> "",
        "u"=> "",
        "d"=> "",
        "p"=> ""
        );
      }
    }

    function save(){
				$this->db->insert('ticket_modul',$data);
    }

    function delete($id){
        $this->db->where("id",$id);
        $this->db->delete("ticket_modul");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }

    function checkdata($modul_id,$typeuser){
      $this->db->where("modul_id",$modul_id);
      $this->db->where("type_id",$typeuser);
      $num = $this->db->get("ticket_auth_user")->num_rows();
      if($num == 1){
        return true;
      }else return false;
    }

    function typeuser(){
      return $query = $this->db->get('ticket_type_user')->result();
    }

}
