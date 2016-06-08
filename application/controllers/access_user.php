<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Access_user extends CI_Controller{

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
        "usertypes" =>$this->access_user->getType(),
        "listusers" => $this->access_user->show(),
        "user" =>$this->userauth->getdatauser(),
        "btn" =>$check,
        "title" =>strtoupper(str_replace("_"," ",$c))
      );
      $this->template->load("main_template", "page/page_$c", $data);
    }

    function dataajax(){
       echo $this->access_user->dataajax();
    }

    function detail(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->access_user->detail($id);
      echo json_encode($data);
    }

    function save(){
      $this->userauth->checkmenu();
      methodpage();
      $data = $this->fungsi->accept_data(array_keys($_POST));
      echo $this->access_user->save($data);
    }

    function delete(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->access_user->delete($id);
      echo $data;
    }
}
