<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_ticket_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function get_all_status($bln,$thn,$dept = ""){
      if($dept == ""){
        $dept = $this->db->get("ticket_departement")->result();
      }else{
        $this->db->where("departement_id",$dept);
        $dept = $this->db->get("ticket_departement")->result();
      }
      $data = array();
      $label = array();
      foreach ($dept as $list) {
        $open = "SELECT
        COUNT(*) AS `open`
      FROM
        ticket_ticket
      WHERE departement_id = '$list->departement_id'
        AND MONTH(DATE) = '$bln'
        AND YEAR(DATE) = '$thn'
        AND status_id = '1'";

        $close = "SELECT
        COUNT(*) AS `close`
      FROM
        ticket_ticket
      WHERE departement_id = '$list->departement_id'
        AND MONTH(DATE) = '$bln'
        AND YEAR(DATE) = '$thn'
        AND status_id = '2'";
        $qopen = $this->db->query($open)->row()->open;
        $qclose = $this->db->query($close)->row()->close;
        $data["$list->departement_name"] = array("open" => $qopen,"close"=> $qclose);
        $label[] = $list->departement_name;
      }
        $txtlabel ='"'. implode('","', $label).'"';
        return array
        (
          "data" => $data,
          "label" => $txtlabel
        );
    }
}
