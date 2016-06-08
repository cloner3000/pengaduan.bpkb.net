<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Assign_ticket extends CI_Controller{

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
      $query = $this->departement->get_tree();
      $option = $this->build_menu($query->result_array());
      $data = array(
        "menus" => $menu,
        "user" =>$this->userauth->getdatauser(),
        "title" =>strtoupper(str_replace("_"," ",$c)),
        "departement" => $this->db->get('ticket_departement'),
        "option" => $option,
        "priority" => $this->db->get('ticket_priority'),
        "btn" =>$check
      );
      $this->template->load("main_template", "page/page_$c", $data);
    }
    
    function test(){
      
      reviewdata($view);
      
    }
    function dataajax(){
       echo $this->assign_ticket->dataajax();
    }

    function detail(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->assign_ticket->detail($id);
      echo json_encode($data);
    }

    function save(){
      $this->userauth->checkmenu();
      methodpage();
      $iddata = $this->input->post("iddata");
      $departement = $this->input->post("departement_id");
      $priority = $this->input->post("priority_id");
      $delete = $this->input->post("delete");

      foreach ($iddata as $row) {
        $this->db->where('uuid',$row);
        $this->db->update('ticket_ticket',array("departement_id" => $departement,"priority_id" => $priority));
        history($row,$this->session->userdata('userid'),"assign","$departement");
      }
      echo setpesan("succes","assign ticket berhasil");
    }

    function delete(){
      $this->userauth->checkmenu();
      methodpage();
      $id = $this->input->post("id");
      $data = $this->assign_ticket->delete($id);
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
     $result = "";
     foreach ($rows as $row)
     {
       if ($row['parent'] == $parent){
         if ($this->has_children($rows,$row['id'])){
           $result.="<optgroup label='$row[name]'>";
           $result.= "<option value='$row[id]'>$row[name]</option>";
           $result.= $this->build_menu($rows,$row['id']);
           $result.="</optgroup>"; 
         }else{
            $result.= "<option value='$row[id]'>$row[name]</option>";
         }
       }
     }
     return $result;
   }
}
