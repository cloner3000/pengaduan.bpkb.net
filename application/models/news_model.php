<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show($offset,$page){
      $sql1 = "select * from ticket_news
        order by created DESC";
       $sql2 = " limit $offset,$page";
       $query = $this->db->query($sql1.$sql2);
       return array(
          "data"=>$query->result(),
          "count"=>$this->db->query($sql1)->num_rows(),
          "result"=>$query->num_rows()
       );
    }

    function dataajax2(){
      $this->datatables
        ->select('uuid,title,created,content')
        ->from("ticket_news")
        ->unset_column("uuid")
        ->unset_column("title")
        ->unset_column("created")
        ->edit_column("content",'$1',"format_ticket_news(uuid,title,created,content)");
      return  $this->datatables->generate();
    }

    function dataajax(){
      $this->datatables
        ->select('uuid,title,created,content')
        ->from("ticket_news")
        ->edit_column("uuid","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' /></label>","uuid")
        ->edit_column("content",'$1',"limitword(content)");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select("uuid,title,created,content");
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_news");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function detail_news($id){
         $this->db->select("uuid,title,created,content");
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_news");
      if($query->num_rows() > 0){
        return $query->row();
      }
        return false;
    }

    function save($data){
      if($data['uuid'] != ''){
			$this->db->where('uuid',$data['uuid']);
			$this->db->update('ticket_news',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
        $data['uuid'] =  $this->uuid->v4();
				$this->db->insert('ticket_news',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function delete($id){
        $this->db->where("uuid",$id);
        $this->db->delete("ticket_news");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
