<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template_answer_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }


    function dataajax2(){
      $this->datatables
        ->select('uuid,title,template')
        ->from("ticket_template_answer")
        ->unset_column("uuid")
        ->edit_column("template",'$1',"format_template(uuid,title,template)");
      return  $this->datatables->generate();
    }

    function dataajax(){
      $this->datatables
        ->select('uuid,title,template')
        ->from("ticket_template_answer")
        ->edit_column("uuid","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","uuid")
        ->edit_column("template",'$1',"limitword(template)");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->select('uuid,title,template');
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_template_answer");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function detailtemplate($id){
      $this->select('uuid,title,template');
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_template_answer");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;
      }
    }

    function save($data){
      if($data['uuid'] != ''){
			$this->db->where('uuid',$data['uuid']);
			$this->db->update('ticket_template_answer',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
        $data['uuid'] = $this->uuid->v4();
				$this->db->insert('ticket_template_answer',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function delete($id){
        $this->db->where("uuid",$id);
        $this->db->delete("ticket_template_answer");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
