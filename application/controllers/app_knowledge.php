<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_knowledge extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('knowledgebase_model','knowledgebase');
    }

    function index() {
        $this->userauth->restrict_mobile();
        $data = array(
            'max_item' => $this->knowledgebase->get_all(),
            'datas' => $this->knowledgebase->api(1)
        );
        $this->load->view('mobile/page_knowledge',$data);
    }

    function data() {
        $this->userauth->restrict_mobile();
        $page = $this->input->get('page',TRUE);
        $json = $this->input->get('json',TRUE);
        $this->knowledgebase->api($page,$json);
    }
}