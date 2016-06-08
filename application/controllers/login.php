<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    public $pesan="";
    function __construct()
    {
        parent::__construct();
        $this->load->model('modul_cat_model','cat');
        $this->load->model('type_user_model','usertype');
    }

    function index(){
        $tipe = $this->session->userdata('tipe');
        if($this->userauth->is_logged_in()==true){
            $this->userauth->gotomenu();
        }
        $data = array(
        "error" =>$this->pesan,
        "usertypes" =>$this->usertype->show()
        );
        $this->template->load("login_template", "page/login_home", $data);

    }

    function dologin(){
        methodpage();
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $logged = $this->userauth->login_user($user,md5($pass));
        if($logged==true){
            $tipe = $this->session->userdata('tipe');
            echo "
            <script type='text/javascript'>
            setTimeout(function () {
                window.location.href = '".site_url("home")."';
            }, 2000);
            </script>
            ".setpesan("info","Berhasil.Anda akan diarahkan pada halaman utama");
        }else{
            echo setpesan("error","username dan password salah");

        }
    }

    function logout(){
        $this->userauth->logout();
    }
}
