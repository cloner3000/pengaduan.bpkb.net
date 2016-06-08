<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class report_bug_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }


    function dataajax2(){
      $this->datatables
        ->select('report_bug.id,menu,full_name,report_bug.create_date,report_bug')
        ->from("report_bug")
        ->unset_column("report_bug.id")
        ->unset_column("menu")
        ->unset_column("full_name")
        ->unset_column("report_bug.create_date")
        ->join("ticket_user","report_bug.user_id = ticket_user.uuid","left")
        ->edit_column("report_bug",'$1',"format_report_bug(report_bug.id,menu,full_name,report_bug.create_date,report_bug)");
      return  $this->datatables->generate();
    }

    function dataajax(){
      $this->datatables
        ->select('report_bug.id,menu,full_name,report_bug.create_date,report_bug,statusbug,answer')
        ->from("report_bug")
        ->unset_column("answer")
        ->join("ticket_user","report_bug.user_id = ticket_user.uuid","left")
        ->edit_column("id","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />
        </label>","report_bug.id")
        ->edit_column("report_bug",'$1<strong> jawaban :</strong><br/>$2',"report_bug,answer");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select("report_bug.id,menu,report_bug.create_date,report_bug");
      $this->db->where("report_bug.id",$id);
      $this->db->join("ticket_user","ticket_user.uuid = report_bug.user_id");
      $query = $this->db->get("report_bug");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function detailreport_bug($id){
      $this->db->select("report_bug.id,full_name,menu,report_bug.create_date,report_bug");
      $this->db->where("report_bug.id",$id);
      $this->db->join("ticket_user","ticket_user.uuid = report_bug.user_id");
      $query = $this->db->get("report_bug");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;

      }
    }

    function save($data){
      if($data['id'] != ''){
			$this->db->where('id',$data['id']);
			$this->db->update('report_bug',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
				$this->db->insert('report_bug',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function delete($id){
        $this->db->where("id",$id);
        $this->db->delete("report_bug");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }
}
