<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App_auth extends CI_Controller {

    public $pesan = "";

    function __construct() {
        parent::__construct();
        $this->load->model('home_model', 'usertype');
    }

    function index() {
        $this->load->view('mobile/page_login');
    }

    function login() {
        methodpage();
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $logged = $this->userauth->login_mobile($user, md5($pass));
        if ($logged == TRUE) {
            $get_user = $this->userauth->getdatauser();
            message_json('login success',200,$get_user);
        }
        else {
            message_json('username atau password salah',400);
        }
    }

    function logout() {
        $this->session->sess_destroy();
        message_json('user logout success',200);
    }

    function view_change_password() {
        $this->load->view("mobile/page_change_password");
    }

    function action_change_password() {
        methodpage();
        $data = array(
            "oldpass" => $this->input->post('oldpass'),
            "newpass" => $this->input->post('newpass'),
            "id"      => $this->session->userdata('userid')
        );
        $query = $this->db->query("select * from ticket_user where uuid = '$data[id]'
      and password='".md5($data['oldpass'])."'");
        $num = $query->num_rows();
        if($num==1){
            $new = md5($data['newpass']);
            $this->db->query("update ticket_user set password ='$new' where uuid='$data[id]'");
            if($this->db->affected_rows()>0){
                message_json('Sukses! password berhasil diperbarui');
            }
        }else{
            message_json('Maaf! password tidak cocok',400);
        }
    }
}