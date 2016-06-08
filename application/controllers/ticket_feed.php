<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_feed extends CI_Controller{

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
        "btn" =>$check
      );
      $this->template->load("main_template", "page/page_$c", $data);
    }

    function dataajax(){
       $user_uuid = $this->session->userdata('userid');
       echo $this->ticket_feed->dataajax($user_uuid);
    }

}
