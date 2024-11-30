<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

Class Category_Model extends CI_Model{
	
    public function getcategories(){
        $this->db->select('*');
        $this->db->where('deleted', NULL);
        $this->db->order_by("category_name", "asc");
        $query = $this->db->get('job_category');
        return $query->result();      
    }
    public function add_category($name, $title, $description){
        $data = array('category_name' =>$name, 'title' =>$title, 'description' =>$description);
        //print_r($data);exit();
        $sql_query=$this->db->insert('job_category', $data); 
        if($this->db->affected_rows() > 0)
        {
            return true;
        
        }else{
            return false;
        }

    }
    public function getcategory($decrypted_id){
        $ret=$this->db->select('*')
                      ->where('id',$decrypted_id)
                      ->get('job_category');
       return $ret->row();
    }
    public function update_category($name, $id, $title, $description){
        $data = array( 'category_name' =>$name, 'title' =>$title, 'description' =>$description );
        //print_r($data);exit();
        $this->db->where('id',$id);
        $sql_query=$this->db->update('job_category', $data); 
        return true;
        
        
     }
     public function deletecategory($uid){
        $sql_query=$this->db->where('id', $uid)
                        ->delete('job_category');
        if($this->db->affected_rows() > 0)
        {
                return true;
        
        }else{
                return false;
        }
        }

}