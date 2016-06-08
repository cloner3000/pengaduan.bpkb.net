<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class create_ticket_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show($offset,$page){
      $sql1 = "select * from ticket_ticket
       where ticket_create_ticket.status = 'y' order by ticket_ticket.create_date DESC";
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
        ->select('uuid,title,created,updated,question')
        ->from("ticket_ticket")
        ->unset_column("uuid")
        ->unset_column("title")
        ->unset_column("created")
        ->unset_column("updated")
        ->edit_column("question",'$1',"format_ticket_create_ticket(uuid,title,created,updated,question)");
      return  $this->datatables->generate();
    }

    function dataajax(){
      $this->datatables
        ->select('uuid,title,created,updated,question')
        ->from("ticket_ticket")
        ->edit_column("uuid","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' /></label>","uuid")
        ->edit_column("question",'$1',"limitword(question)");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select("uuid,title,created,updated,question");
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_ticket");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function detailticket_create_ticket($id){
      $this->db->select("uuid,title,date,updated,question");
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_ticket");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function save($data){
      if($data['uuid'] != ''){
  			$this->db->where('uuid',$data['uuid']);
  			$this->db->update('ticket_ticket',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
        $data['uuid'] =  $this->uuid->v4();
        $data['date'] = date("Y-m-d");
        $data['user_uuid'] = $this->session->userdata('userid');
        if(!empty($_FILES)){
          $result = $this->do_upload($data['uuid']);
          if(!is_array($result)){
            return '<div class="alert alert-warning">'.$result.'</div>';
          }
        }

				$this->db->insert('ticket_ticket',$data);
        if($this->db->affected_rows()>0){
          history($data['uuid'],$this->session->userdata('userid'),"open");
          return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function do_upload($uuid) {
      $config['upload_path'] = './attachment/';
      $config['allowed_types'] = 'gif|jpg|png|pdf';
      $config['max_size'] = '1024';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      $data = array();

      if (!$this->upload->do_upload("attachment")) {
        $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
        return $data['msg'] =  $this->upload->display_errors();
      }
      else {
        $data = $this->upload->data();
        $param = array(
          'uuid' => $this->uuid->v4(),
          'file_name' => 'Attachment',
          'file_name_encrypt' => $data['file_name'],
          'file_type' =>$data['file_ext'],
          'file_size' => $data['file_size'],
          'ticket_uuid' => $uuid
        );
        $this->db->insert('ticket_file',$param);
        return $data;
      }
  }

    function delete($id){
        $this->db->where("uuid",$id);
        $this->db->delete("ticket_ticket");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
