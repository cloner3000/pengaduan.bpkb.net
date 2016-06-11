<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller
{
  function __construct() {
    parent::__construct();
    $c = $this->uri->rsegment(1);
    $this->load->model("home" . "_model", "home");
    $this->load->model("news" . "_model", "news");
    $this->load->model("knowledgebase" . "_model", "knowledgebase");
  }

  function index() {
    $data = array(
        "contents" => "",
        "know" => $this->home->get_last_knowledge(20),
        "title" => "Front"
      );
    $this->template->load("front_template","page/page_front" ,$data);
  }


  function news($id){
    if($id == ""){
      return redirect("front");
    }else{
      $data = array(
        "title" =>strtoupper("News Detail"),
        "detail" => $this->news->detail_news($id),
        "know" => $this->home->get_last_knowledge(20),
      );
      $this->template->load("front_template", "page/page_detail_news", $data);
    }
  }

  function knowledgebases($id=""){
    if($id == ""){
      $data = array(
        "title" =>strtoupper("knowledgebase"),
        "know" => $this->home->get_last_knowledge(20),
      );
      $this->template->load("front_template", "page/page_front_knowledgebases", $data);
    }else{
      $data = array(
        "title" =>strtoupper("knowledgebase"),
        "detail" => $this->knowledgebase->detail_knowledgebase($id),
        "know" => $this->home->get_last_knowledge(20),
      );
      $this->template->load("front_template", "page/page_detail_knowledgebases", $data);
    }
  }

  function search(){
    $query = cleanString($_REQUEST['query']);
    $q_know = $this->db->query(
      "select * from ticket_knowledgebase where content like '%$query%' OR title like '%$query%'"
    );
    $q_news = $this->db->query(
      "select * from ticket_news where content like '%$query%' OR title like '%$query%'"
    );
    $data = array(
        "title" =>strtoupper("pencarian : $query"),
        "qnews" => $q_news,
        "qknow" => $q_know,
        "know" => $this->home->get_last_knowledge(20),
        "query" => $query
      );
    $this->template->load("front_template", "page/page_search", $data);
  }

  function dataajax_news(){
     echo $this->news->dataajax2();
  }

  function dataajax_knowledge(){
     echo $this->knowledgebase->dataajax2();
  }

  /*function send_mail(){
    $this->load->library('email');
    $this->email->from('your@example.com', 'Your Name');
    $this->email->to('master.ardani@gmail.com');
    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');
    $this->email->send();
    echo $this->email->print_debugger();
  }*/

}
