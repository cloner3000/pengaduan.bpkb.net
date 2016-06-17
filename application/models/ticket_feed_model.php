<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticket_feed_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show(){
      return $query = $this->db->get('ticket_notify')->result();
    }

    function dataajax($userid){
      $this->datatables
        ->select('uuid_ticket,ticket_ticket.title,date_feed')
        ->from("ticket_notify")
        ->where('uuid_user',$userid)
        ->where('read',0)
        ->unset_column('ticket_ticket.title')
        ->join("ticket_ticket",'ticket_ticket.uuid = ticket_notify.uuid_ticket','left')
        ->edit_column("uuid_ticket",'<a class="text-error" href="'.site_url("replay_ticket/answer").'/$1">$2 telah dibalas</a>',"uuid_ticket,ticket_ticket.title");
      return  $this->datatables->generate();
    }

    function api($page = 1,$json = false) {
        $userid = $this->session->userdata('userid');
        $total = $this->get_all();
        $perpage = 20;
        $page = empty($page) ? 0 : $page - 1;
        $page = $page*$perpage;
        $this->db
            ->select('uuid_ticket,ticket_ticket.title,date_feed,message')
            ->from("ticket_notify")
            ->order_by('date_feed','DESC')
            ->where('uuid_user',$userid)
            ->where('read',0)
            ->join("ticket_ticket",'ticket_ticket.uuid = ticket_notify.uuid_ticket','left')
            ->limit($perpage,$page);
        $query = $this->db->get();
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }

        $respond = array(
            'notification' => $data,
            'total' => $total
        );

        if ($json) {
            return message_json('',200,$respond);
        } else {
            return $respond;
        }

    }

    function get_all() {
        $userid = $this->session->userdata('userid');
        $total_data = $this->db->where('read','0')
            ->where('uuid_user',$userid)->from("ticket_notify")->get();
        return $total_data->num_rows();
    }

}
