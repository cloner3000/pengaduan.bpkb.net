<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class backup_restore extends CI_Controller{

    public $message;
    private $tipe;
    
    function __construct(){
        parent::__construct();
        backHandle();
        $c = $this->uri->rsegment(1);
        $this->load->model("$c"."_model",$c);
        
        
    }
    
    function backup(){
    $check = $this->userauth->checkmenu();  
        $this->load->helper('download');
        $tanggal=date('d-m-Y H i');
        $namaFile="backup_".$tanggal.'.sql';
        $this->load->dbutil();
        $prefs = array( 
        'ignore'      => array(),          
        'format'      => 'txt',            
        'filename'    => 'mybackup.sql',   
        'add_drop'    => TRUE,             
        'add_insert'  => TRUE,             
        'newline'     => "\n"              
        );
        $this->load->helper('file');
        $backup =& $this->dbutil->backup($prefs);
        write_file(APPPATH."backup/$namaFile", $backup);
        force_download($namaFile, $backup);
        
      
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
    
    function restore(){
     $status = "";
     $msg = "";
     $file_element_name = 'restore';
     if($status != "error"){
      $config['upload_path'] = APPPATH.'backup/upload/';
      $config['allowed_types'] = 'sql';
      
 
     $this->load->library('upload', $config);
     if(!$this->upload->do_upload($file_element_name)){
         $status = 'error';
         $msg = $this->upload->display_errors('', '');
     }else{
        $data = $this->upload->data();
        //$status = "success";
        //$msg = "<strong>Sukses</strong> Database Telah Berhasil Direstore";
        $error = array();
        $isi_file=file_get_contents( APPPATH."backup/upload/$data[orig_name]");
        $string_query = preg_split('/;[\n\r]+/',$isi_file);
        reset($string_query);
        
        // $array_query=explode(";", $string_query);
        while (list($key,$value)=each($string_query)) {
          if (trim($value)!="") {
            if (!mysql_query($value)){
                $error[] = mysql_error();
            }
          }
        }
        
        $num = count($error);
        if($num >0){
          $status = "error";
          $msg ="";
          foreach($error as $row){
            $msg .=$row."<br/> ";
          }
        }else{
          $status = "success";
          $msg = "<strong>Sukses</strong> Database Telah Berhasil Direstore";
        }
         
          /*foreach($array_query as $query){ 
              $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
              $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
          }*/
           
    }
    }
    
    echo setpesan($status,"$msg"); 
    }
    
    function save(){
      $this->userauth->checkmenu();
      methodpage();

      $data = $this->fungsi->accept_data(array_keys($_POST));
      echo $this->backup_restore->save($data);
    }
    
}   