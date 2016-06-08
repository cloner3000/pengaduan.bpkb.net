<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Departement extends CI_Controller{

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
      $menu = $this->userauth->generate_menu($this->gettipe());
      $check = $this->userauth->checkmenu();
      $c = $this->uri->rsegment(1);
      $tree = $this->departement->get_tree();
      $data = array(
        "menus" => $menu,
        "user" =>$this->userauth->getdatauser(),
        "title" =>strtoupper(str_replace("_"," ",$c)),
        "departement" => $this->departement->get(),
        "tree" => $this->build_menu($tree->result_array()),
        "btn" =>$check
      );
      $this->template->load("main_template", "page/page_$c", $data);
    }

    function dataajax(){
       echo $this->departement->dataajax();
    }

    function detail(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->departement->detail($id);
      echo json_encode($data);
    }

    function save(){
      $this->userauth->checkmenu();
      methodpage();
      $data = $this->fungsi->accept_data(array_keys($_POST));
      echo $this->departement->save($data);
    }

    function delete(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->departement->delete($id);
    }
    
    function has_children($rows,$id) {
     foreach ($rows as $row) {
       if ($row['parent'] == $id)
         return true;
     }
     return false;
   }
   
   function build_menu($rows,$parent=-1)
   {  
     $result = "<ul class='easyui-tree'>";
     foreach ($rows as $row)
     {
       if ($row['parent'] == $parent){
         $result.= "<li data-options=\"state:'opened'\"><span>$row[name]</span>";
         if ($this->has_children($rows,$row['id']))
           $result.= $this->build_menu($rows,$row['id']);
         $result.= "</li>";
       }
     }
     $result.= "</ul>";
     return $result;
   }

}
