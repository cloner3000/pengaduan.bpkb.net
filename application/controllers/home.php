<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_Controller {

    public $message;
    private $tipe;

    function __construct() {
        parent::__construct();
        $c = $this->uri->rsegment(1);
        $this->load->model("$c" . "_model", $c);
    }

    function gettipe() {
        return $this->tipe = $this->session->userdata('tipe');
    }

    function index() {
        $this->userauth->restrict();
        $menu = $this->userauth->generate_menu($this->gettipe());
        $data = array(
            "menus"              => $menu,
            "user"               => $this->userauth->getdatauser(),
            'last_ticket'        => $this->home->get_last_ticket(),
            'last_login'         => $this->home->get_last_login(),
            'last_knowledgebase' => $this->home->get_last_knowledge(),
        );
        $this->load->view("home_template", $data);
    }

    function ubahpass() {
        methodpage();
        $data = array(
            "oldpass" => $this->input->post('oldpass'),
            "newpass" => $this->input->post('newpass'),
            "id"      => $this->session->userdata('userid')
        );
        echo $this->home->ubahpass($data);
    }

    function profile() {
        $menu = $this->userauth->generate_menu($this->gettipe());
        $c    = $this->uri->rsegment(1);
        $this->db->where('uuid', $this->session->userdata('userid'));
        $profile = $this->db->get('ticket_user')->row();
        $data    = array(
            "menus"   => $menu,
            "user"    => $this->userauth->getdatauser(),
            "title"   => strtoupper(str_replace("_", " ", $c)),
            "profile" => $profile
        );
        $this->template->load("main_template", "page/page_profile", $data);
    }

    function save_profile() {
        methodpage();
        $data = $this->fungsi->accept_data(array_keys($_POST));
        echo $this->home->save_profile($data);
    }
}
