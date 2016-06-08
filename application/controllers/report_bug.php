<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class report_bug extends CI_Controller{

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
      //reviewdata($check);
      $c = $this->uri->rsegment(1);
      $menu = $this->userauth->generate_menu($this->gettipe());
      $data = array(
        "menus" => $menu,
        "user" =>$this->userauth->getdatauser(),
        "title" =>strtoupper(str_replace("_"," ",$c)),
        "btn" =>$check
        
      );
      $this->template->load("main_template", "page/page_report_bug", $data);
    }
    
    function dataajax(){
       echo $this->report_bug->dataajax();
    }
    
    function detail(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->report_bug->detail($id);
      echo json_encode($data);
    }
    
    function save(){
      $this->userauth->checkmenu();
      methodpage();
      $data = $this->fungsi->accept_data(array_keys($_POST));
      $data['user_id'] =  $this->session->userdata('userid');
      $data['statusbug']="pending";
      echo $this->report_bug->save($data);
    }
    
    function delete(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->report_bug->delete($id); 
    }
    
    function answer(){
      $data = $this->fungsi->accept_data(array_keys($_POST));
      echo $this->report_bug->save($data);
    }
}   