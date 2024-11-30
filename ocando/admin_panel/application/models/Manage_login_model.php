<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Manage_login_model extends CI_Model {

	public function login($emailid,$password){
		$query=$this->db->where(['username'=>$emailid,'password'=>$password]);
		$account=$this->db->get('admin_user')->row();
		if($account!=NULL){
	
		//return $query->result();  
		//return $account->name;
		$ret=$this->db->select('*')
			->where('username',$emailid)
			->get('admin_user');
				return $ret->row();
		} else {
			return false;
		}
	}
        
	public function loginaccess($emailid){

		$query=$this->db->where(['username'=>$emailid]);
		$account=$this->db->get('admin_user')->row();
		if($account!=NULL){

		//return $query->result();  
		//return $account->name;
		$ret=$this->db->select('password')
		->where('username',$emailid)
		->get('admin_user');
			return $ret->row();
		} else {

		return false;
		}
	}

	
	}