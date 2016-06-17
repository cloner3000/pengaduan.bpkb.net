<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App_main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("ticket_feed_model", "ticket_feed");
        $this->load->model("list_ticket_model", "list_ticket");
    }

    function index() {
        $userid = $this->session->userdata('userid');
        $data   = array(
            "user"                => $this->userauth->getdatauser(),
            'datas'               => $this->list_ticket->api(1, FALSE),
            'max_item'            => $this->list_ticket->get_all(),
            'userid'              => $userid,
            "notification_unread" => $this->ticket_feed->get_all($userid)
        );
        $this->load->view("mobile/page_main", $data);
    }

    function data() {
        $page = $this->input->get('page', TRUE);
        $json = $this->input->get('json', TRUE);
        $this->list_ticket->api($page, $json);
    }
}