<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Manage_Login_Model extends CI_Model {


public function commonModules(){
		$query=$this->db->select('*')
			->order_by('mod_modulegroupcode','asc')
			->order_by('mod_moduleorder','asc')
			->group_by('mod_modulegroupcode')
			  ->get('module');
		return $query->result();  
}
	
public function register($emailid,$password,$btnradio,$verification_code){
$data = array(
               'user_email' =>$emailid,
			   'password' =>$password,
			   'user_role' =>$btnradio,
			   'verification_code' => $verification_code,
			   'user_source' => 0,
			   
            );
//print_r($data);exit();
$sql_query=$this->db->insert('users', $data); 
if($this->db->affected_rows() > 0)
{
	return true;

}else{
	return false;
}
}
				
				
	public function allModules(){
		$query=$this->db->select('*')
			->order_by('mod_modulegrouporder','asc')
			->order_by('mod_moduleorder','asc')
			  ->get('module');
		return $query->result();  
	}
	
	
	
	public function userRights($rr_rolecode){
		$query=$this->db->select('*')
		    ->where('rr_rolecode',$rr_rolecode)
			->order_by('rr_modulecode','asc')
			->get('role_rights');
		return $query->result();  
	}
	
public function login($emailid,$password){

$query=$this->db->where(['user_email'=>$emailid,'password'=>$password]);
	$account=$this->db->get('users')->row();
	if($account!=NULL){
 
	//return $query->result();  
	//return $account->name;
	$ret=$this->db->select('*')
        ->where('user_email',$emailid)
        ->get('users');
            return $ret->row();
	} else {
		
	return false;
	}
}

public function verifyEmail($email, $verification_code){
	$query=$this->db->where(['user_email'=>$email,'verification_code'=>$verification_code]);
	$account=$this->db->get('users')->row();
	if($account!=NULL){
		$userInfo = array('verified_at'=> date('Y-m-d'));
		$this->db->where('user_email',$email);
		$this->db->update('users',$userInfo);
		return true;
	} else {
		return false;
	}
}

public function get_user_profile($user_id)
{
	$ret=$this->db->select('*')
        ->where('user_id',$user_id)
        ->get('employer_profile');
            return $ret->row();
} 
        public function loginaccess($emailid){

            $query=$this->db->where(['user_email'=>$emailid]);
            $account=$this->db->get('users')->row();
            if($account!=NULL){

            //return $query->result();  
            //return $account->name;
            $ret=$this->db->select('password')
            ->where('user_email',$emailid)
            ->get('users');
                return $ret->row();
            } else {

            return false;
            }
        }
	
	 /*$sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module "

                . " WHERE 1 GROUP BY `mod_modulegroupcode` "

                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";*/
	
	public function loginLog($data){
		$this->db->insert('login_log',$data);
                $insert_id = $this->db->insert_id();

                return  $insert_id;
	}
        public function loginOut($data,$id){
            
                $this->db->where('id',$id);
                
		$this->db->update('login_log',$data);
	}
	public function getlogdetails(){
		$query=$this->db->select('*')
			->order_by('login_time','desc')
			  ->get('login_log');
		return $query->result();  
}
public function checkUser($emailid){

	$ret=$this->db->select('*')->where('user_email',$emailid)->get('users');
	$query = $ret->row();
	if($query){
		return true;
	} else {

	return false;
	}
}
public function checkApiKey($apiKey){

	$ret=$this->db->select('*')->where('passwordChangeApiKey',$apiKey)->get('users');
	$query = $ret->row();
	if($query){
		return true;
	} else {

	return false;
	}
}
 public function checkApiKey2($apiKey){

	$ret=$this->db->select('*')->where('passwordChangeApiKey',$apiKey)->get('users');
	$query = $ret->row();
	if($query){
		return $query;
	} else {

	return false;
	}
}
public function updateUser($emailid,$data){

	$this->db->where('user_email',$emailid);
	$this->db->update('users',$data);
	return true;
	
}
	
	}