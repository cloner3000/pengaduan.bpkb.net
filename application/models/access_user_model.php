<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Access_user_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
       return $query = $this->db->query("select uuid,full_name from ticket_user where uuid <> '23546' order by full_name ASC");
    }

    function gettype(){
      return $this->db->get("ticket_type_user");
    }

    function save($data){
      if($data['uuid'] != ''){
			$this->db->where('uuid',$data['uuid']);
			$this->db->update('ticket_user',$data);
      $this->db->where('uuid',$data['uuid']);
      $user = $this->db->get('ticket_user')->row();
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
	   }
    }

    function delete($id){
        $this->db->where("uuid",$id);
        $this->db->update("ticket_user",array("actived"=>"0"));
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }

    function dataajax(){
      $this->datatables
        ->select('uuid,full_name,email,name')
        ->from("ticket_user")
        ->join("ticket_type_user","ticket_type_user.type_id = ticket_user.type_id")
        ->where("actived","1")
        ->edit_column("uuid","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","uuid");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select('uuid,type_id,email,password');
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_user");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    private function mail($email,$password,$code){
      $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'smtp.mandrillapp.com',
        'smtp_port' => 587,
        'smtp_user' => 'master.ardani@gmail.com',
        'smtp_pass' => 'xR770McfBCG4cqWLvyMM0A',
        'smtp_timeout' => '4',
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1'
    );

    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from('admin@supportticket.com', 'admin');
    $this->email->to("$email");

     $this->email->subject('Email Corfirmation User Access');
     $this->email->message("
     Kepada $email \n
     ini adalah email konfirmasi user akses pada system.\n
     berikut detail data anda \n
     email : $email \n
     password : $password \n
     untuk mengaktifasi account anda klik link dibawah ini \n
     <a href='".site_url("register/activation/$code")."'>".site_url("register/activation/$code")."</a> \n
     setelah berhasil lakukan perubahan password.
     terima kasih.
     ");

     $this->email->send();
    }
}
