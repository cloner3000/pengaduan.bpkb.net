<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Knowledgebase_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show($offset,$page){
      $sql1 = "select * from ticket_knowledgebase
       where ticket_knowledgebase.status = 'y' order by ticket_knowledgebase.create_date DESC";
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
        ->select('uuid,title,created,updated,content')
        ->from("ticket_knowledgebase")
        ->unset_column("uuid")
        ->unset_column("title")
        ->unset_column("created")
        ->unset_column("updated")
        ->edit_column("content",'$1',"format_ticket_knowledgebase(uuid,title,created,updated,content)");
      return  $this->datatables->generate();
    }

    function dataajax(){
      $this->datatables
        ->select('uuid,title,created,updated,content')
        ->from("ticket_knowledgebase")
        ->edit_column("uuid","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' /></label>","uuid")
        ->edit_column("content",'$1',"limitword(content)");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select("uuid,title,created,updated,content");
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_knowledgebase");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function detail_knowledgebase($id){
         $this->db->select("uuid,title,created,updated,content");
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_knowledgebase");
      if($query->num_rows() > 0){
        return $query->row();
      }
        return false;
    }

    function save($data){
      if($data['uuid'] != ''){
        $data['updated'] = date("Y-m-d");
			$this->db->where('uuid',$data['uuid']);
			$this->db->update('ticket_knowledgebase',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
        $data['uuid'] =  $this->uuid->v4();
				$this->db->insert('ticket_knowledgebase',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function delete($id){
        $this->db->where("uuid",$id);
        $this->db->delete("ticket_knowledgebase");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }

    function api($page = 1,$json = false) {
        $total = $this->get_all();
        $perpage = 20;
        $page = empty($page) ? 0 : $page - 1;
        $page = $page*$perpage;
        $this->db
            ->select('uuid,title,created,updated,content')
            ->order_by('created','DESC')
            ->limit($perpage,$page)
            ->from("ticket_knowledgebase");
        $query = $this->db->get();
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }

        $respond = array(
            'knowledge' => $data,
            'total' => $total
        );

        if ($json) {
            return message_json('',200,$respond);
        } else {
            return $respond;
        }
    }

    function get_all() {
        $total_data = $this->db->from("ticket_knowledgebase")->get();
        return $total_data->num_rows();
    }
}
