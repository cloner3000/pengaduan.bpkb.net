<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_replay_ticket extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("replay_ticket_model","replay_ticket");
    }

    function detail() {
        $this->userauth->restrict_mobile();
        $id = $this->uri->segment(4);
        $name = $this->session->userdata('name');
        $data = array(
            'ticket' => $this->replay_ticket->detail($id),
            'answers' => $this->replay_ticket->get_answer($id),
            'name' => $name
        );
        
        $this->load->view('mobile/page_replay_ticket',$data);
    }

    function replay() {
        $this->userauth->restrict_mobile();
        $uuid        = $this->uuid->v4();
        $ticket_uuid = $this->input->post("ticket_id");
        $answer      = $this->input->post("answer");
        $user_uuid   = $this->session->userdata('userid');
        $date        = date("Y-m-d H:i");
        $param       = array(
            'uuid'        => $uuid,
            'ticket_uuid' => $ticket_uuid,
            'answer'      => $answer,
            'user_uuid'   => $user_uuid,
            'date'        => $date
        );
        $this->db->insert('ticket_answer', $param);
        // make notify
        $this->db->where('uuid', $ticket_uuid);
        $this->db->update("ticket_ticket", array('update' => date("Y-m-d")));
        $this->generate_notify($ticket_uuid,$answer);
        message_json('success replay');
    }

    function generate_notify($ticket_uuid,$answer) {

        $this->db->where('ticket_uuid', $ticket_uuid);
        $this->db->join('ticket_user', 'ticket_user.uuid = ticket_answer.user_uuid', 'LEFT');
        $this->db->group_by("ticket_answer.user_uuid");
        $query = $this->db->get('ticket_answer');

        $detail_ticket                           = $this->get_ticket($ticket_uuid);
        $detail_user                             = $this->get_user($detail_ticket->user_uuid);
        $user_email                              = array();
        $user_email[ $detail_ticket->user_uuid ] = $detail_user->email;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $list) {
                $user_email[ $list->user_uuid ] = $list->email;
            }
            foreach ($user_email as $key => $val) {
                $this->send_email_notif($val, site_url("replay_ticket/answer/" . $ticket_uuid), $answer, $detail_user->full_name);
                $this->notify($ticket_uuid, $key, 0, $detail_ticket->title);
            }
        }
    }

    function send_email_notif($to, $url, $message = '', $full_name = '') {
        $config['charset']  = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $this->email->from('noreply@pengaduan.bpkb.net', 'Pengaduan Polda Metro Jaya');
        $this->email->to($to);
        $this->email->subject('Jawaban Pengaduan');
        $this->email->message(
            'Isi Jawaban dari '.$full_name.': <br/>'
            .$message.
            '<br/>Pengaduan Anda sudah ada balasan lebih lengkapnya silahkan cek di alamat ini ' .
            "<a href='$url'>klik disini</a>"
        );
        $this->email->send();
    }

    function get_ticket($uuid) {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('ticket_ticket')->row();

        return $query;
    }

    function get_user($uuid) {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('ticket_user')->row();

        return $query;
    }

    function notify($ticket_uuid, $user, $read = 1, $title = "") {
        $this->db->where('uuid_ticket', $ticket_uuid);
        $this->db->where('uuid_user', $user);
        $query = $this->db->get('ticket_notify');
        if ($query->num_rows() > 0) {
            $this->db->update('ticket_notify', array("read" => $read));
        }
        else {
            $this->db->insert('ticket_notify',
                array(
                    "uuid_ticket" => $ticket_uuid,
                    "uuid_user"   => $user,
                    "read"        => $read,
                    "title"       => $title,
                    "date_feed"   => date('Y-m-d H:i:s')
                ));
        }
    }
}