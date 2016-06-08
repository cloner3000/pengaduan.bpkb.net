<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forget_password extends CI_Controller
{
  public $message;
  private $tipe;
  function __construct() {
    parent::__construct();
    backHandle();
  }

  function index() {
    $c = $this->uri->rsegment(1);
    $data = array("title" => strtoupper(str_replace("_", " ", $c)),);
    $this->template->load("forget_password_template", "page/login_home", $data);
  }

  function reset() {
    $email = $this->input->post('email');
    if (empty($email)) {
      $data['pesan'] = setpesan('error', 'email tidak valid');
    }
    else {
      $this->db->where('email', $email);
      $find = $this->db->get('ticket_user')->num_rows();
      if ($find == 1) {
        $this->db->where('email', $email);
        $newpass = generateRandomString();
        $this->db->update('ticket_user', array('password' => md5($newpass)));
        send_mail_password($email,$newpass);
        $data['pesan'] = setpesan('success', 'Reset password telah dikirim ke email anda.');
      }
      else {
        $data['pesan'] = setpesan('error', 'email user tidak ditemukan');
      }
    }
    echo $data['pesan'];
  }
}
