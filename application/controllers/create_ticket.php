<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Create_ticket extends CI_Controller
{

  public $message;
  private $tipe;

  function __construct() {
    parent::__construct();
    backHandle();
    $c = $this->uri->rsegment(1);
    $this->load->model("$c" . "_model", $c);
  }

  function gettipe() {
    return $this->tipe = $this->session->userdata('tipe');
  }

  function index() {
    $check = $this->userauth->checkmenu();
    $c = $this->uri->rsegment(1);
    $menu = $this->userauth->generate_menu($this->gettipe());
    $data = array("menus" => $menu, "user" => $this->userauth->getdatauser(), "title" => strtoupper(str_replace("_", " ", $c)), "btn" => $check, "priority" => $this->db->get('ticket_priority'), "topic" => $this->db->get('ticket_topic'),);
    $this->template->load("main_template", "page/page_create_ticket", $data);
  }

  function save() {
    $this->userauth->checkmenu();
    methodpage();
    $data = $this->fungsi->accept_data(array_keys($_POST));
    $param = array(
      'title' => $data['title'],
      'topic_id' => $data['topic_id'],
      'priority_id' => $data['priority_id'],
      'question' => $data['question'],
      'uuid' => ''
    );
    $result =  $this->create_ticket->save($param);
    if($result){
      $this->email->from('pengaduan@'.$_SERVER['SERVER_NAME'], 'Pengaduan Polda Metro Jaya');
      $this->email->to( $this->session->userdata('email'));
      $this->email->subject('Pemberitahuan Pengaduan');
      $this->email->message('Pengaduan Anda telah kami terima,Kami akan merespond pengaduan Anda secepatnya. Terima Kasih');
      $this->email->send();
    }
    echo $result;
  }


}
