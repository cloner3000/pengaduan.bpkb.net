<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_notification extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ticket_feed_model','ticket_feed');
    }

    function index() {
        $this->userauth->restrict_mobile();
        $data = array(
            'max_item' => $this->ticket_feed->get_all(),
            'datas' => $this->ticket_feed->api(1)
        );
        $this->load->view('mobile/page_notification',$data);
    }

    function data() {
        $this->userauth->restrict_mobile();
        $page = $this->input->get('page',TRUE);
        $json = $this->input->get('json',TRUE);
        $this->ticket_feed->api($page,$json);
    }
}