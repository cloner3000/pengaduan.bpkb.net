<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Userauth extends CI_Model
{
  var $CI = NULL;
  function __construct() {
    // Call the Model constructor
    parent::__construct();
    $this->CI = & get_instance();
  }

  function login_user($username, $pass) {
    $log_user = $this->CI->db->query("SELECT * FROM ticket_user
        WHERE email = '$username' AND password ='$pass' AND actived='1'");
    if ($log_user->num_rows() == 1) {
      foreach ($log_user->result() as $row) {
        $id = $row->uuid;
        $nama = $row->full_name;
        $tipe = $row->type_id;
        $deptid = $row->departement_id;
      }
      $this->db->where('uuid',$row->uuid);
      $this->db->update('ticket_user',array('last_login' => date('Y-m-d H:i')));
      $user_ses = array('userid' => $id, 'name' => $nama, 'tipe' => $tipe,'deptid' => $deptid,'email'=>$username);
      $this->CI->session->set_userdata($user_ses);
      return true;
    }
    else {
      return false;
    }
  }

  function logout() {
    $this->session->sess_destroy();
    redirect('login');
  }

  function is_logged_in() {
    if ($this->CI->session->userdata('userid') == '') {
      return false;
    }
    return true;
  }

  function restrict() {
    if ($this->is_logged_in() == false) {
      redirect('login');
    }
  }

  function gotomenu() {
    redirect('home');
  }

  function checkmenu($url = "", $action = "") {
    $checkurl = ($url == "") ? $this->uri->rsegment(1) : $url;
    $arraymenu = $this->session->userdata("menus");
    if (array_key_exists($checkurl, $arraymenu)) {
      if ($arraymenu[$checkurl]['view'] == "y") {
        $edit = ($arraymenu[$checkurl]['update'] == "y") ? "y" : "n";
        $del = ($arraymenu[$checkurl]['delete'] == "y") ? "y" : "n";
        $print = ($arraymenu[$checkurl]['print'] == "y") ? "y" : "n";
        $create = ($arraymenu[$checkurl]['create'] == "y") ? "y" : "n";
        return array("P" => $print, "D" => $del, "U" => $edit, "C" => $create);
      }
      else {
        redirect('login');
      }
    }
    else {
      redirect('login');
    }
  }

  function getdatauser() {
    $data = array('userid' => $this->session->userdata("userid"), 'name' => $this->session->userdata("name"), 'tipe' => $this->session->userdata("tipe"));
    return $data;
  }

  function generate_menu($user_type) {
    $menu = '';
    $listmenu = array();
    $this->db->select('*,ticket_modul_cat.id as modulcatid');
    $this->db->from('ticket_auth_user');
    $this->db->join('ticket_modul', 'ticket_modul.id = ticket_auth_user.modul_id', 'LEFT');
    $this->db->join('ticket_modul_cat', 'ticket_modul_cat.id = ticket_modul.modul_catid', 'LEFT');
    $this->db->where('ticket_auth_user.type_id', $user_type);
    $this->db->where('ticket_auth_user.view', "y");
    $this->db->group_by("modul_catid");

    $qmodul_cat = $this->db->get();
    $cmodul = $qmodul_cat->num_rows();
    $modul_cats = $qmodul_cat->result();

    foreach ($modul_cats as $modul_cat) {
      $menu.= '
            <li class="submenu">
                 <a href="#"><i class="icon ' . $modul_cat->icon . '"></i><span>' . $modul_cat->modul_cat . '</span></a>
                 <ul>';
      $this->db->select('*');
      $this->db->from('ticket_auth_user');
      $this->db->where('ticket_auth_user.type_id', $user_type);
      $this->db->join('ticket_modul', 'ticket_modul.id = ticket_auth_user.modul_id', 'LEFT');
      $this->db->where('ticket_modul.modul_catid', $modul_cat->modulcatid);
      $this->db->where('view', "y");
      $this->db->order_by('ticket_modul.id asc');
      $qmodul = $this->db->get();
      $moduls = $qmodul->result();

      $no = 0;
      foreach ($moduls as $modul) {
        $no++;
        $list = "$modul->url";
        $menu.= " <li><a href='" . base_url($modul->url) . "'><i class='$modul->icon'></i><span>$modul->modul_name</span></a></li>";
        $listmenu[$list] = array("url" => $modul->url, "view" => $modul->view, "create" => $modul->create,
          "update" => $modul->update, "delete" => $modul->delete, "print" => $modul->print);
      }
      $menu.= "</ul>
            </li>";
    }
    $menulist = array("menus" => $listmenu);
    $this->session->set_userdata($menulist);
    if ($cmodul > 0) {
      return $menu;
    }
    else return ' ';
  }
}
