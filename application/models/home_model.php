<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function show_message($n=30,$o=""){
      $this->db->where('read','n');
      $this->db->limit($n,$o);
      $this->db->join("user","user.id = message.user_id","left");
      return $this->db->get('message');

    }


    function ubahpass($data){
    $query = $this->db->query("select * from ticket_user where uuid = '$data[id]'
      and password='".md5($data['oldpass'])."'");
    $num = $query->num_rows();
    if($num==1){
        $new = md5($data['newpass']);
        $this->db->query("update ticket_user set password ='$new' where uuid='$data[id]'");
        if($this->db->affected_rows()>0){
        return  setpesan("success","<strong>Sukses!</strong> Password Berhasil Diubah");
        }
    }else{
        return setpesan("error","<strong>Maaf!</strong> Password Lama Tidak cocok");
        }
    }

    function get_last_login(){
      $tipe = $this->session->userdata('tipe');
      if($tipe  != 0 ){
        $this->db->where('uuid',$this->session->userdata('id'));
      }
      $this->db->order_by('last_login','DESC');
      $this->db->limit(10);
      return $this->db->get('ticket_user')->result();
    }

    function get_last_ticket(){
      $tipe = $this->session->userdata('tipe');
      if($tipe  != 0 ){
        $this->db->where('user_uuid',$this->session->userdata('id'));
      }
      $this->db->order_by('date','DESC');
      $this->db->limit(10);
      return $this->db->get('ticket_ticket')->result();
    }

    function get_last_knowledge(){
      $tipe = $this->session->userdata('tipe');
      $this->db->order_by('created','DESC');
      $this->db->limit(10);
      return $this->db->get('ticket_knowledgebase')->result();
    }

    function save_profile($data){
      if($data['uuid'] != ''){
      $this->db->where('uuid',$data['uuid']);
      $this->db->update('ticket_user',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
    }
    }
}
