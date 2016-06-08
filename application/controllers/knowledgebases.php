<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Knowledgebases extends CI_Controller{

    public $message;
    private $tipe;

    function __construct(){
        parent::__construct();
        backHandle();
        $c = $this->uri->rsegment(1);
        $this->load->model("knowledgebase"."_model","knowledgebase");
    }

    function gettipe(){
      return $this->tipe = $this->session->userdata('tipe');
    }

    function index(){
      $check = $this->userauth->checkmenu();
      $c = $this->uri->rsegment(1);
      $menu = $this->userauth->generate_menu($this->gettipe());
      $data = array(
        "menus" => $menu,
        "user" =>$this->userauth->getdatauser(),
        "title" =>strtoupper(str_replace("_"," ",$c)),
        "btn" =>$check

      );
      $this->template->load("main_template", "page/page_knowledgebases", $data);
    }

    function dataajax(){
       echo $this->knowledgebase->dataajax2();
    }

    function detail(){
      $this->userauth->checkmenu();
      $c = $this->uri->rsegment(1);
      $menu = $this->userauth->generate_menu($this->gettipe());

      $id = $this->uri->segment("3");
      $data = array(
        "menus" => $menu,
        "user" =>$this->userauth->getdatauser(),
        "title" =>strtoupper(str_replace("_"," ",$c)),
        "detail" => $this->knowledgebase->detail_knowledgebase($id)
      );
      $this->template->load("main_template", "page/page_detail_knowledgebases", $data);
    }
}
