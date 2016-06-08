<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller{
    public $message;
    private $tipe;
    function __construct(){
        parent::__construct();
        backHandle();
        $c = $this->uri->rsegment(1);
        $this->load->model("operator"."_model",'operator');
    }

    function gettipe(){
      return $this->tipe = $this->session->userdata('tipe');
    }

    function index(){
      $c = $this->uri->rsegment(1);
      $data = array(
        "title" =>strtoupper(str_replace("_"," ",$c)),
      );
      $this->template->load("register_template", "page/page_$c", $data);
    }

    function save(){
      methodpage();
      $data = $this->fungsi->accept_data(array_keys($_POST));
      $this->db->where("email",$data['email']);
      $check = $this->db->get('ticket_user')->num_rows();
        if($check > 0){
            echo setpesan('error',"Email sudah terdaftar. klik menu lupa password untuk mendapatkan password Anda kembali");
        }else{
            echo $this->operator->save_user($data);
        }

    }

    function activation(){
      $code = $this->uri->segment(3);
      if(empty($code)){
        $data['pesan'] = setpesan('error','code tidak valid');
      }else{
        $this->db->where('uuid',$code);
        $find = $this->db->get('ticket_user')->num_rows();
        if($find == 1 ){
          $this->db->where('uuid',$code);
          $this->db->update('ticket_user',array('actived'=>1));
          $data['pesan'] = setpesan('success','aktivasi berhasil silahkan ke halaman login untuk login ke aplikasi '.
          "<a href='".site_url('login')."'> halaman login</a>");
        }else{
          $data['pesan'] = setpesan('error','code tidak valid');
        }
      }
      $this->template->load("activation_template", "page/login_home", $data);
    }
}
