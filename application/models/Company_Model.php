<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class Company_Model extends CI_Model{
	
public function getcompanyDetailRow(){
        $query=$this->db->select('*')
        ->where('user_id',$this->session->userdata['user_id'])
                      ->get('employer_profile');
                return $query->row();      
}
public function getcompanyDetails(){
    $query = $this->db->select('e.*, c.city_name as ccity_name, co.country_name as cocountry_name, u.user_source, COUNT(j.id) as job_count')
    ->join('city c', 'c.id = e.c_city', 'left')
    ->join('country co', 'co.id = e.c_country', 'left')
    ->join('users u', 'u.id = e.user_id', 'left')
    ->join('jobs j', 'e.id = j.company_id', 'left')
    ->group_by('e.id') // Group by the employer_profile id to count jobs per employer
    ->get('employer_profile e');
    return $query->result();     
}

public function getcompanydetail($decrypted_id){
	
	$this->db->select('e.*,c.city_name as ccity_name,co.country_name as cocountry_name');
		// $this->db->where('status', 0);
		$this->db->where('e.id',$decrypted_id);
		$this->db->join('city c', 'c.id=e.c_city', 'left');
        $this->db->join('country co', 'co.id=e.c_country', 'left');
            $query = $this->db->get('employer_profile e');
        
        // print_r($this->db->last_query());exit();
                return $query->row();   
 	
 }
		
public function add_company($name,$registration_number,$email,$phone,$website,$about,$country,$city,$address,$new_image_name11,$company_lat, $company_long){
$data = array(
               'user_id' =>$this->session->userdata['user_id'],
			   'company_logo' =>$new_image_name11,
               'company_name' =>$name,
               'registration_number'=>$registration_number,
			   'c_mail' =>$email,
			   'c_phone' =>$phone,
			   'c_website' =>$website,
			   'c_about_company' =>$about,
			   'c_country' =>$country,
			   'c_city' =>$city,
			   'c_address' =>$address,
               'company_lat' => $company_lat,
               'company_long' => $company_long
            );
//print_r($data);exit();
$sql_query=$this->db->insert('employer_profile', $data); 
if($this->db->affected_rows() > 0)
{
	return true;

}else{
	return false;
}


}
public function update_company($name,$registration_number,$email,$phone,$website,$about,$country,$city,$address,$new_image_name11,$company_lat,$company_long){
    $data = array(
                   'user_id' =>$this->session->userdata['user_id'],
                   'company_logo' =>$new_image_name11,
                   'company_name' =>$name,
                   'registration_number'=>$registration_number,
                   'c_mail' =>$email,
                   'c_phone' =>$phone,
                   'c_website' =>$website,
                   'c_about_company' =>$about,
                   'c_country' =>$country,
                   'c_city' =>$city,
                   'c_address' =>$address,
                   'company_lat' => $company_lat,
                   'company_long' =>$company_long
                );
    //print_r($data);exit();
    $this->db->where('user_id',$this->session->userdata['user_id']);
    $sql_query=$this->db->update('employer_profile', $data); 
    return true;
    
    
    }

public function getcompany($decrypted_id){
 	$ret=$this->db->select('*')
 	              ->where('id',$decrypted_id)
 	              ->get('employer_profile');
 	                return $ret->row();
 }

 // Function for use deletion
 public function deletecity($uid){
$sql_query=$this->db->where('id', $uid)
                ->delete('employer_profile');
if($this->db->affected_rows() > 0)
{
        return true;

}else{
        return false;
}
}


public function approve($decrypted_id,$userInfo) {
        $this->db->where('id', $decrypted_id);
        $this->db->update('employer_profile', $userInfo);

        return TRUE;
    }
	
function getcity()
{
    $query = $this->db->select('*')
            ->get('city');
    return $query->result();
}
function getcountry()
{
    $query = $this->db->select('*')
            ->get('country');
    return $query->result();
}
	
function compress_image($source_file, $target_file, $nwidth, $nheight, $quality) {

        //Return an array consisting of image type, height, widh and mime type.
    
        $image_info = getimagesize($source_file);
    
        if(!($nwidth > 0)) $nwidth = $image_info[0];
    
        if(!($nheight > 0)) $nheight = $image_info[1];
    
        
    
    
    
        /*echo '<pre>';
    
        print_r($image_info);*/
    
        if(!empty($image_info)) {
    
            switch($image_info['mime']) {
    
                case 'image/jpeg' :
    
                    if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality
    
                    // Create a new image from the file or the url.
    
                    $image = imagecreatefromjpeg($source_file);
    
                    $thumb = imagecreatetruecolor($nwidth, $nheight);
    
                    //Resize the $thumb image
    
                    imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
    
                    // Output image to the browser or file.
    
                    return imagejpeg($thumb, $target_file, $quality); 
    
                    
    
                    break;
    
                
    
                case 'image/png' :
    
                    if($quality == '' || $quality < 0 || $quality > 9) $quality = 6; //Default quality
    
                    // Create a new image from the file or the url.
    
                    $image = imagecreatefrompng($source_file);
    
                    $thumb = imagecreatetruecolor($nwidth, $nheight);
    
                    //Resize the $thumb image
    
                    imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
    
                    // Output image to the browser or file.
    
                    return imagepng($thumb, $target_file, $quality);
    
                    break;
    
                    
    
                case 'image/gif' :
    
                    if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality
    
                    // Create a new image from the file or the url.
    
                    $image = imagecreatefromgif($source_file);
    
                    $thumb = imagecreatetruecolor($nwidth, $nheight);
    
                    //Resize the $thumb image
    
                    imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
    
                    // Output image to the browser or file.
    
                    return imagegif($thumb, $target_file, $quality); //$success = true;
    
                    break;
    
                    
    
                default:
    
                    echo "<h4>Not supported file type!</h4>";
    
                    break;
    
            }
    
        }
    
    }
    function fetch_city($region_id)
    {
        $this->db->where('region_id', $region_id);
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get('city');
        $output = '<option value="">Select Town/City</option>';
        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->city_name.'</option>';
        }
        return $output;
    }

}
