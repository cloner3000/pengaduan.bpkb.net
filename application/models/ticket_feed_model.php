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

}
