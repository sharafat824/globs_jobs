<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class Job_Model extends CI_Model{
	
public function getAgencyDetails(){
        $query=$this->db->select('*')
                      ->get('agency');
                return $query->result();      
}
public function getApplyjobDetails($decrypted_id){
        $query=$this->db->select('id')
					  ->where('user_id',$this->session->userdata['user_id'])
					  ->where('job_id',$decrypted_id)
                      ->get('user_jobs');
                return $query->result();      
}

public function getJobDetails($uid){
 	$ret=$this->db->select('*')
 	              ->where('id',$uid)
 	              ->get('jobs');
 	                return $ret->row();
 }
 
public function getjobs($uid)
{
	$this->db->select('j.*,c.category_name,co.country_name,ci.city_name');
		$this->db->where("j.deleted",NULL);
		$this->db->where('j.id',$uid);
		$this->db->join('job_category c', 'c.id=j.category', 'left');
		$this->db->join('country co', 'co.id=j.country', 'left');
		$this->db->join('city ci', 'ci.id=j.city', 'left');
		
		$query = $this->db->get('jobs j');
    return $query->row();
}

public function getVerifiedEmployees($cat_id)
{
	$this->db->select('ep.*,u.user_email,u.fcm_token,u.id as user_id');
		$this->db->where("ep.status",1);
		$this->db->where("ep.category_id",$cat_id);
		$this->db->join('users u', 'u.id=ep.user_id', 'left');
		
		$query = $this->db->get('employee_profile ep');
    return $query->result();
}
 
 public function approve($decrypted_id,$userInfo) {
        $this->db->where('id', $decrypted_id);
        $this->db->update('jobs', $userInfo);

        return TRUE;
    }


 // Function for use deletion
 public function deletecity($uid){
$sql_query=$this->db->where('id', $uid)
                ->delete('agency');
if($this->db->affected_rows() > 0)
{
        return true;

}else{
        return false;
}
}
			
public function add_Job($title,$description,$category,$career,$positions,$country,$experience,$address,$apply_date,$type, $city, $job_lat, $job_long,$job_price){
$data = array(
               'title' =>$title,
			   'description' =>$description,
			   'category' =>$category,
			   'career' =>$career,
			   'no_of_postions' =>$positions,
			   'country' =>$country,
			   'city'	=> $city,
			   'experience' =>$experience,
			   'company_id' =>$this->session->userdata['user_id'],
			   'address' =>$address,
			   'apply_date'=>$apply_date,
			   'type' =>$type,
			   'date_time' =>date('Y-m-d'),
			   'job_lat' => $job_lat,
			   'job_long' => $job_long,
			   'job_price' => $job_price
            );
$sql_query=$this->db->insert('jobs', $data); 
if($this->db->affected_rows() > 0)
{
	return true;

}else{
	return false;
}


}

public function apply_job($decrypted_id){
$data = array(
               'user_id' =>$this->session->userdata['user_id'],
			   'job_id' =>$decrypted_id,
            );
//print_r($data);exit();
$sql_query=$this->db->insert('user_jobs', $data); 
if($this->db->affected_rows() > 0)
{
	return true;

}else{
	return false;
}
}

public function edit_agency($userInfo, $cat_id) {
        $this->db->where('id', $cat_id);
        $this->db->update('agency', $userInfo);

        return TRUE;
    }
	
function getjobcategory()
{
    $query = $this->db->select('id, category_name')
            ->get('job_category');
    return $query->result();
}
function getalljobs()
{
	$this->db->select('j.*,c.category_name,co.country_name');
			$this->db->where("j.approve",0);
			$this->db->where("j.deleted",NULL);
            $this->db->join('job_category c', 'c.id=j.category', 'left');
			$this->db->join('country co', 'co.id=j.city', 'left');
            $query = $this->db->get('jobs j');
    return $query->result();
				
    
}

// deleted job function 
function deleteJob($id){
	$this->db->set('deleted', '1');
	$this->db->where('id', $id);
	$this->db->update('jobs');
}

function getapprovedjobs($company_id = '')
{
	$this->db->select('j.*,c.category_name,co.country_name');
	$this->db->where("j.deleted",NULL);
	//$this->db->join('user_jobs u', 'u.job_id=j.id', 'left');
	$this->db->join('job_category c', 'c.id=j.category', 'left');
	$this->db->join('country co', 'co.id=j.city', 'left');
	if($company_id!=''){
		$this->db->where("j.company_id", $company_id);
	}else{
		$this->db->where("j.approve",1);
	}
	$query = $this->db->get('jobs j');
    return $query->result();
				
    
}

public function getapplicantDetails($decrypted_id){
        $this->db->select('e.*,j.job_id,j.short_list');
			$this->db->where('j.short_list', 0);
			$this->db->where('j.job_id', $decrypted_id);
			$this->db->join('user_jobs j', 'j.user_id=e.user_id', 'left');
			$this->db->join('jobs jo', 'jo.id=j.job_id', 'left');
			$this->db->join('country co', 'co.id=jo.city', 'left');
            $query = $this->db->get('employee_profile e');
			return $query->result();      
}

// get applicant counts

public function getapplicantDetailsCount($decrypted_id){
        $this->db->select('e.*,j.job_id,j.short_list');
			$this->db->where('j.short_list', 0);
			$this->db->where('j.job_id', $decrypted_id);
			$this->db->join('user_jobs j', 'j.user_id=e.user_id', 'left');
			$this->db->join('jobs jo', 'jo.id=j.job_id', 'left');
			$this->db->join('country co', 'co.id=jo.city', 'left');
            $query = $this->db->get('employee_profile e');
            // print_r($this->db->last_query());exit();
			return $query->num_rows();      
}

public function shortlist($decrypted_id){
        $this->db->select('e.*,j.job_id,j.short_list');
			if($this->session->userdata['rolecode']==3){
				$this->db->where('j.short_list', 11);
				$this->db->where('j.job_id', $decrypted_id);
				$this->db->join('user_jobs j', 'j.user_id=e.user_id', 'left');
				$query = $this->db->get('employee_profile e');
			}
			else{
			$this->db->where('j.short_list>', 0);
			$this->db->where('j.short_list!=', 11);
			$this->db->where('j.job_id', $decrypted_id);
			$this->db->join('user_jobs j', 'j.user_id=e.user_id', 'left');
			//$this->db->join('country co', 'co.id=j.city', 'left');
            $query = $this->db->get('employee_profile e');
			}
                return $query->result();      
}

// get shorlist count
public function shortlistCount($decrypted_id){
        $this->db->select('e.*,j.job_id,j.short_list');
			if($this->session->userdata['rolecode']==3){
				$this->db->where('j.short_list', 11);
				$this->db->where('j.job_id', $decrypted_id);
				$this->db->join('user_jobs j', 'j.user_id=e.user_id', 'left');
				$query = $this->db->get('employee_profile e');
			}
			else{
			$this->db->where('j.short_list>', 0);
			$this->db->where('j.short_list!=', 11);
			$this->db->where('j.job_id', $decrypted_id);
			$this->db->join('user_jobs j', 'j.user_id=e.user_id', 'left');
			//$this->db->join('country co', 'co.id=j.city', 'left');
            $query = $this->db->get('employee_profile e');
			}
                return $query->num_rows();      
}

public function approveapllicant($decrypted_id,$decrypted_id1,$userInfo) {
        $this->db->where('user_id', $decrypted_id);
		$this->db->where('job_id', $decrypted_id1);
        $this->db->update('user_jobs', $userInfo);

        return TRUE;
    }

}
