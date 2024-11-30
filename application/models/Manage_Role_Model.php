<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class Manage_Role_Model extends CI_Model{
	
	public function getroledetails(){
		$query=$this->db->select('role_rolecode,role_rolename,description')
		              ->get('role');
		        return $query->result();      
	}
//Getting particular user deatials on the basis of id	
 public function getroledetail($uid){
 	$ret=$this->db->select('id,name')
 	              ->where('id',$uid)
 	              ->get('category');
 	                return $ret->row();
 }

 // Function for use deletion
 public function deletecategory($uid){
$sql_query=$this->db->where('id', $uid)
                ->delete('category');
		if($this->db->affected_rows() > 0)
{
					return true;

				}else{
					return false;
				}
            }
			
public function add_role($role_rolecode,$role_rolename,$description){
$data = array(
               'role_rolecode' =>$role_rolecode,
			   'role_rolename' =>$role_rolename,
			   'description' =>$description,
            );
//print_r($data);exit();
$sql_query=$this->db->insert('role', $data); 
if($this->db->affected_rows() > 0)
{
	return true;

}else{
	return false;
}


}
public function add_RoleRight($data){

$sql_query=$this->db->insert('module', $data); 
if($this->db->affected_rows() > 0)
{
	return true;

}else{
	return false;
}


}
public function getModuleDetails(){
    $ret=$this->db->select('*')
        ->get('module');
          return $ret->result();
 }
 
 public function viewRight($rolecode,$modulecode){
 	$ret=$this->db->select('*')
                    ->where('rr_rolecode',$rolecode)
                    ->where('rr_modulecode',$modulecode)
                    ->where('rr_view','yes')
                    ->get('role_rights');
//        echo $this->db->last_query();exit;
	return $ret->num_rows();
 }
 public function addRight($rolecode,$modulecode){
 	$ret=$this->db->select('*')
                    ->where('rr_rolecode',$rolecode)
                    ->where('rr_modulecode',$modulecode)
                    ->where('rr_create','yes')
                    ->get('role_rights');
//        echo $this->db->last_query();exit;
	return $ret->num_rows();
 }
 public function editRight($rolecode,$modulecode){
 	$ret=$this->db->select('*')
                    ->where('rr_rolecode',$rolecode)
                    ->where('rr_modulecode',$modulecode)
                    ->where('rr_edit','yes')
                    ->get('role_rights');
//        echo $this->db->last_query();exit;
	return $ret->num_rows();
 }
 public function deleteRight($rolecode,$modulecode){
 	$ret=$this->db->select('*')
                    ->where('rr_rolecode',$rolecode)
                    ->where('rr_modulecode',$modulecode)
                    ->where('rr_delete','yes')
                    ->get('role_rights');
//        echo $this->db->last_query();exit;
	return $ret->num_rows();
 }

 public function deleteRoleRights($role){
    $sql_query=$this->db->where('rr_rolecode', $role)
                ->delete('role_rights');
    }
public function add_right($role_rolecode,$assign_app,$add_is,$update_is,$delete_is,$view_is){
    $data = array(
        'rr_rolecode' =>$role_rolecode,
        'rr_modulecode' =>$assign_app,
        'rr_create' =>$add_is,
        'rr_edit' =>$update_is,
        'rr_delete' =>$delete_is,
        'rr_view' =>$view_is
    );
    
    $sql_query=$this->db->insert('role_rights', $data); 
//    echo $this->db->last_query();exit;

     }
    
    
    
}
