<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function get(){
      return $this->db->query("select * from ticket_user where type_id = '2'");
    }

    function save($data){
      if($data['uuid'] != ''){
         $data['password_original'] = $data['password'];
         $data['password'] = md5($data['password']);
			$this->db->where('uuid',$data['uuid']);
			$this->db->update('ticket_user',$data);
        if($this->db->affected_rows()>0){
          return setpesan('success',"Data Berhasil Diubah");
        }
		}else{
        $data['uuid'] = $this->uuid->v4();
        $data['password_original'] = $data['password'];
        $data['password'] = md5($data['password']);
				$this->db->insert('ticket_user',$data);
        if($this->db->affected_rows()>0){
        return setpesan('success',"Data Berhasil Disimpan");
        }
			}
    }

    function delete($id){
        $this->db->where("uuid",$id);
        $this->db->delete("ticket_user");
        if($this->db->affected_rows()>0){
            echo 'success';
        }
    }

    function dataajax(){
      $this->datatables
        ->select('ticket_user.uuid,email,full_name,phone,gender,identity_no,address,ticket_user.departement_id,
          type_identity,actived,rt,rw,village,sub,province,departement_name')
        ->from("ticket_user")
        ->join("ticket_departement","ticket_departement.departement_id = ticket_user.departement_id")
        ->unset_column("type_identity")
        ->unset_column("ticket_user.departement_id")
        ->unset_column("rt")
        ->unset_column("email")
        ->unset_column("rw")
        ->unset_column("village")
        ->unset_column("sub")
        ->unset_column("province")
        ->where("type_id","2")
        ->edit_column("address","$1,$2/$3 ,$4 $5 $6,","address,rt,rw,village,sub,province")
        ->edit_column("identity_no","$1-$2,","type_identity,identity_no")
        ->edit_column("uuid","<label class='radio'>
        <input type='radio' class='data-radio' name='iddata' value='$1' />$2
        </label>","ticket_user.uuid,email");
      return  $this->datatables->generate();
    }

    function detail($id){
      $this->db->select('ticket_user.uuid,email,full_name,phone,gender,identity_no,address,ticket_user.departement_id,
          type_identity,actived,rt,rw,village,sub,province,password_original as password');
      $this->db->where("uuid",$id);
      $query = $this->db->get("ticket_user");
      if ($query->num_rows > 0) {
          return $data[] = $query->row_array() ;
      }
    }
}
