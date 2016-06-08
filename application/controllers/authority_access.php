<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authority_access extends CI_Controller{

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
    function mydata(){
      $this->userauth->checkmenu();
      $usertypeid = $_POST['typeuser'];

      $this->datatables
        ->select('ticket_modul.id, modul_cat,modul_name,`modul_name` AS `mview`,
        `modul_name` AS `mcreate`,`modul_name` AS `mupdate`,
            `modul_name` AS `mdelete`,`modul_name` AS `mprint`',false)
        ->from("ticket_modul")
        ->join("ticket_modul_cat","ticket_modul_cat.id = ticket_modul.modul_catid","left")
        ->unset_column("ticket_modul.id")
        ->edit_column("`mview`",gencheckbox("modul-$1","view_$1[]",'$2'),"ticket_modul.id,getakses(ticket_modul.id,$usertypeid,'v')")
        ->edit_column("`mcreate`",gencheckbox("modul-$1","create_$1[]","$2"),"ticket_modul.id,getakses(ticket_modul.id,$usertypeid,'c')")
        ->edit_column("`mupdate`",gencheckbox("modul-$1","update_$1[]","$2"),"ticket_modul.id,getakses(ticket_modul.id,$usertypeid,'u')")
        ->edit_column("`mdelete`",gencheckbox("modul-$1","delete_$1[]","$2"),"ticket_modul.id,getakses(ticket_modul.id,$usertypeid,'d')")
        ->edit_column("`mprint`",gencheckbox("modul-$1","print_$1[]","$2"),"ticket_modul.id,getakses(ticket_modul.id,$usertypeid,'p')")
        ->add_column("checkall","<label class='checkbox'><input type='checkbox' class='check-all' value='$1' />
         <input type='hidden' name='modul[]' value='$1' />
         all</label>","ticket_modul.id");
      echo $this->datatables->generate();

    }

    function index(){
       $this->userauth->checkmenu();
       $arraymenu = $this->session->userdata("menu");
       $user = $this->userauth->getdatauser();
       $menu = $this->userauth->generate_menu($this->gettipe());
       $c = $this->uri->rsegment(1);
       $data = array(
        "user" =>$user,
        "module"=>$this->authority_access->show(),
        "tipe_user"=>$this->authority_access->typeuser(),
        "title" =>strtoupper(str_replace("_"," ",$c)),
        "menus"=>$menu
      );
      $this->template->load("main_template", "page/page_authority_access", $data);
    }

    function save(){
        $this->userauth->checkmenu();
        $typeuser = $this->input->post('typeuser');
        $modulid = $this->input->post('modul');

        foreach($modulid as $i=>$row){
        $view = (isset($_POST["view_$row"]) !="")?"y":"n" ;
        $create = (isset($_POST["create_$row"]) !="")?"y":"n" ;
        $update = (isset($_POST["update_$row"]) !="")?"y":"n" ;
        $delete = (isset($_POST["delete_$row"]) !="")?"y":"n" ;
        $print = (isset($_POST["print_$row"]) !="")?"y":"n" ;
            $param = array(
            "type_id"=> $typeuser,
            "modul_id"=>$row,
            "view"=>$view,
            "create"=>$create,
            "update"=>$update,
            "delete"=>$delete,
            "print"=>$print
            );
            $status  = $this->authority_access->checkdata($row,$typeuser);
            if($status == true){
              $this->db->where("type_id",$typeuser);
              $this->db->where("modul_id",$row);
              $this->db->update("ticket_auth_user",$param);

            }else{
              if($view=="y"){
                $this->db->insert("ticket_auth_user",$param);
              }

            }

        }
            echo setpesan("success","hak akses telah diperbarui");

    }


}
