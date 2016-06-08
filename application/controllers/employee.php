<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller{
    public $message;
    private $tipe;
    function __construct(){
        parent::__construct();
        backHandle();
        $c = $this->uri->rsegment(1);
        $this->load->model("$c"."_model",$c);
        $this->load->model("departement"."_model","departement");
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
        "btn" =>$check,
        "departements"=> $this->departement->get(),

      );
      $this->template->load("main_template", "page/page_$c", $data);
    }

    function dataajax(){
       echo $this->employee->dataajax();
    }

    function detail(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->employee->detail($id);
      echo json_encode($data);
    }

    function save(){
      $this->userauth->checkmenu();
      methodpage();
      $data = $this->fungsi->accept_data(array_keys($_POST));
      echo $this->employee->save($data);
    }

    function delete(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->employee->delete($id);
    }
}
