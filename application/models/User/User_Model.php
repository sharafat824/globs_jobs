<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class User_Model extends CI_Model {

    public function getusersdetails() {
				
        $query = $this->db->select('*')
                ->where('user_role', 1)
                ->get('users');
        return $query->result();
    }

    public function deleteuser($uid) {
        $sql_query = $this->db->where('id', $uid)
                ->delete('users');
//        $data = array('deleted' =>1);
//        $this->db->where('id', $uid);
//        $this->db->update('user', $data);
    }

    public function getuserdetail($uid) {//
        $ret = $this->db->select('*')
		
                ->where('id', $uid)
                ->get('users');
//        print_r($this->db->last_query());   exit;
        return $ret->row();
    }
    public function checkUser($username) {//
        $ret = $this->db->select('id')
		
                ->where('username', $username)
                ->get('user');
        return $ret->row();
    }
    public function checkEmail($email) {//
        $ret = $this->db->select('id')
		
                ->where('user_email', $email)
                ->get('users');
        return $ret->row();
    }
    public function editUser($userInfo, $userId) {
        
        $this->db->where('id', $userId);
        $this->db->update('user', $userInfo);
        return TRUE;
    }


    public function addNewUser($userInfo) {
        $this->db->trans_start();
        $this->db->insert('users', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getCity()
    {
        $query = $this->db->select('id, city_name')
                ->get('city');
        return $query->result();
    }
    function getRegion()
    {
        $query = $this->db->select('id, region_name')
                ->get('region');
        return $query->result();
    }
	function getRole()
    {
        $query = $this->db->select('role_rolecode, role_rolename')
                ->get('role');
        return $query->result();
    }
    //Fetch Area from City
    function fetch_city($region_id)
    {
        $this->db->where('region_id', $region_id);
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get('city');
        $output = '<option value="">Select City</option>';
        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->city_name.'</option>';
        }
        return $output;
    }
    function getArea()
    {
        $query = $this->db->select('id, area_name')
                ->get('area');
        return $query->result();
    }
    public function loginaccess($emailid){

            $ret = $this->db->select('password')
		
                ->where('id', $emailid)
                ->get('user');
        return $ret->row();
        }
   
}
