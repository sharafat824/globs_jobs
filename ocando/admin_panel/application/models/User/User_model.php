<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class User_model extends CI_Model {

    public function getusersdetails() {
				
        $query = $this->db->select('*')
                ->get('admin_user');
        return $query->result();
    }

    public function deleteuser($uid) {
        $sql_query = $this->db->where('id', $uid)
                ->delete('admin_user');
//        $data = array('deleted' =>1);
//        $this->db->where('id', $uid);
//        $this->db->update('user', $data);
    }

    public function getuserdetail($uid) {//
        $ret = $this->db->select('*')
		
                ->where('id', $uid)
                ->get('admin_user');
        return $ret->row();
    }
    public function checkUser($username) {//
        $ret = $this->db->select('id')
                ->where('username', $username)
                ->get('admin_user');
        return $ret->row();
    }
    public function editUser($userInfo, $userId) {        
        $this->db->where('id', $userId);
        $this->db->update('admin_user', $userInfo);

        return TRUE;
    }

    public function addNewUser($userInfo) {
        $this->db->trans_start();
        $this->db->insert('admin_user', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    public function loginaccess($emailid){

            $ret = $this->db->select('password')
		
                ->where('id', $emailid)
                ->get('admin_user');
        return $ret->row();
        }
   
}