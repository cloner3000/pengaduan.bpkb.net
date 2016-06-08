<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_ticket extends CI_Controller{

    public $message;
    private $tipe;

    function __construct(){
        parent::__construct();
        backHandle();
        $c = $this->uri->rsegment(1);
        $this->load->model("$c"."_model",$c);
    }

    function gettipe(){
      return $this->tipe = $this->session->userdata('tipe');
    }

    function index(){
      $check = $this->userauth->checkmenu();
      $menu = $this->userauth->generate_menu($this->gettipe());
      $c = $this->uri->rsegment(1);
      $data = array(
        "menus" => $menu,
        "user" =>$this->userauth->getdatauser(),
        "title" =>strtoupper(str_replace("_"," ",$c)),
        "getbulan" => getbulan(),
        "btn" =>$check,
        "dept_id"=>"",
        "bulan" => date("m"),
        "tahun" => date("Y"),
        "proses_departement" => "Semua Departement",
        "departement" => $this->db->get('ticket_departement')->result_array(),
        "proses" => $this->report_ticket->get_all_status( date("m"),date("Y"))
      );
      $this->template->load("main_template", "page/page_$c"."_all", $data);
    }

    function proses(){
      $bulan = $this->input->post('bulan');
      $tahun =$this->input->post('tahun');
      $check = $this->userauth->checkmenu("report_ticket");
      $menu = $this->userauth->generate_menu($this->gettipe());
      $c = $this->uri->rsegment(1);
      $data = array(
        "menus" => $menu,
        "user" =>$this->userauth->getdatauser(),
        "title" =>strtoupper(str_replace("_"," ",$c)),
        "btn" =>$check,
        "getbulan" => getbulan(),
        "dept_id"=>"",
        "bulan" => "$bulan",
        "tahun" => "$tahun",
        "proses_departement" => "Semua Departement",
        "departement" => $this->db->get('ticket_departement')->result_array(),
        "proses" => $this->report_ticket->get_all_status( $bulan,$tahun)
      );
      $this->template->load("main_template", "page/page_$c"."_all", $data);
    }
}
