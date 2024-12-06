<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Manage_Dashboard_Model extends CI_Model
{

    public function totaljob($startDate =null, $endDate=null)
    {
        $conditions = ($this->session->userdata('rolecode') == 3) ?
        ['j.company_id' => $this->session->userdata('user_id')] :
        ['j.company_id >' => 0];

    $conditions['deleted'] = NULL;

    return $this->countWithDateFilter($conditions, $startDate, 'jobs j');

    }

    public function countJob($status,$country,$city) {
        // Apply the condition for approved status
        if ($status === 'approved') {
            $this->db->where('approve', 1);
        }
        if ($country && $city) {
            // Both country and city conditions are provided
            $this->db->where('country', $country);
            $this->db->where('city', $city);
        } elseif ($country) {
            // Only country condition is provided
            $this->db->where('country', $country);
        } elseif ($city) {
            // Only city condition is provided
            $this->db->where('city', $city);
        } 
        $this->db->where('deleted', NULL);
        // Select the count of jobs
        $this->db->select('COUNT(id) as job_count');
        $query = $this->db->get('jobs');
        
        // Return the count value from the result
        return $query->row()->job_count;
    }
    

    public function approvedjob($category_id = 0, $startDate = null) {
        // Determine conditions based on the user's role
        $conditions = ($this->session->userdata('rolecode') == 3) ?
            ['j.company_id' => $this->session->userdata('user_id')] :
            ['j.company_id >' => 0];
    
        // Additional conditions
        $conditions['deleted'] = NULL;
        $conditions['approve'] = 1;
    
        if ($this->session->userdata('rolecode') == 2) {
            $conditions['category'] = (!empty($category_id) && $category_id != 0) ? $category_id : 0;
        }
    
        // Use the reusable function for filtering with dates
        return $this->countWithDateFilter($conditions, $startDate, 'jobs j');
    }
    
    public function pendingjob($startDate = null) {
        $conditions = ($this->session->userdata('rolecode') == 3) ?
            ['j.company_id' => $this->session->userdata('user_id')] :
            ['j.company_id >' => 0];
    
        $conditions['approve'] = 0;
    
        return $this->countWithDateFilter($conditions, $startDate, 'jobs j');
    }
    
    public function appliedjob()
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];

        }
        $this->db->select('count(j.id) as job_count');
        $this->db->where($multipleWhere);
        $this->db->where('j.short_list !=','1');
        $this->db->where('j.short_list !=','11');
        $query = $this->db->get('user_jobs j');
        $cnt2 = $query->row();

        $total = $cnt2->job_count;

        return $total;

    }
    public function Shortlistjob($category_id = 0, $startDate = null) {
        $conditions = ($this->session->userdata('rolecode') == 2) ?
            ['j.user_id' => $this->session->userdata('user_id')] :
            ['j.id >' => 0];
    
        if ($this->session->userdata('rolecode') == 3) {
            $conditions['j.user_id'] = $this->session->userdata('user_id');
        }
    
        $conditions['short_list'] = 1;
    
        return $this->countWithDateFilter($conditions, $startDate, 'user_jobs j');
    }
    
    public function Assignedjob($startDate = null) {
        $conditions = ($this->session->userdata('rolecode') == 2) ?
            ['j.user_id' => $this->session->userdata('user_id')] :
            ['j.id >' => 0];
    
        if ($this->session->userdata('rolecode') == 3) {
            $conditions['j.user_id'] = $this->session->userdata('user_id');
        }
    
        $conditions['short_list'] = 11;
    
        return $this->countWithDateFilter($conditions, $startDate, 'user_jobs j');
    }
    

    public function totalemployee($startDate = null) {
        $conditions = ($this->session->userdata('rolecode') == 2) ?
            ['e.user_id' => $this->session->userdata('user_id')] :
            ['e.user_id >' => 0];
    
        return $this->countWithDateFilter($conditions, $startDate, 'employee_profile e');
    }
    
    public function pendingemployee($startDate = null) {
        $conditions = ($this->session->userdata('rolecode') == 2) ?
            ['e.user_id' => $this->session->userdata('user_id')] :
            ['e.user_id >' => 0];
    
        $conditions['e.status'] = 0;
    
        return $this->countWithDateFilter($conditions, $startDate, 'employee_profile e');
    }
    
    public function totalemployer($dateRange = null) {
        
        $conditions = ($this->session->userdata('rolecode') == 2) ?
            ['e.user_id' => $this->session->userdata('user_id')] :
            ['e.user_id >' => 0];
    
            return $this->countWithDateFilter($conditions, $dateRange, 'employer_profile e', 'created_at','all');
    }
    public function pendingemployer($startDate = null) {
       
        $conditions = ($this->session->userdata('rolecode') == 2) ?
            ['e.user_id' => $this->session->userdata('user_id')] :
            ['e.user_id >' => 0];
    
        return $this->countWithDateFilter($conditions, $startDate,  'employer_profile e','created_at','pending');
    }
    public function approvedemployer($startDate = null) {
        $conditions = ($this->session->userdata('rolecode') == 2) ?
            ['e.user_id' => $this->session->userdata('user_id')] :
            ['e.user_id >' => 0];
    
        return $this->countWithDateFilter($conditions, $startDate,  'employer_profile e','created_at','approved');
    }
    
    
    // public function pendingemployer()
    // {

    //     if ($this->session->userdata('rolecode') == 2) {
    //         $multipleWhere = ['e.user_id' => $this->session->userdata('user_id')];

    //     } else {
    //         $multipleWhere = ['e.user_id>' => 0];
    //     }
    //     $this->db->select('count(e.id) as employer_count');
    //     $this->db->where($multipleWhere);

    //     $query = $this->db->get('employer_profile e');
    //     $cnt2 = $query->row();

    //     $total = $cnt2->employer_count;

    //     return $total;

    // }

    public function approvedemployee($startDate = null) {
        $conditions = ($this->session->userdata('rolecode') == 2) ?
            ['e.user_id' => $this->session->userdata('user_id')] :
            ['e.user_id >' => 0];
    
        $conditions['status >'] = 0;
    
        return $this->countWithDateFilter($conditions, $startDate, 'employee_profile e');
    }
    

    private function countWithDateFilter($conditions = [], $dateRange = null, $table = 'jobs', $dateColumn = 'created_at', $status = null) {
    
        // Select the count of ids
        $this->db->select('count(id) as count');
        
        // Apply the additional conditions if provided
        $this->db->where($conditions);
        
        // If a status is provided, apply status filter
        if ($status === 'approved') { 
            $this->db->where('status', 1);
        } elseif ($status === 'pending') {
            $this->db->where('status', 0);
        }
        
        // If dateRange is provided, parse it and apply date filters
        if ($dateRange) {
            // Split the date range into start and end date
            list($startDate, $endDate) = explode(' - ', $dateRange);
            
            // Trim any spaces
            $startDate = trim($startDate);
            $endDate = trim($endDate);
            
            // Ensure the dates are in the correct format (YYYY-MM-DD)
            // If needed, you can parse these dates and format them correctly here
            if ($startDate) {
                // Apply the start date filter
                $this->db->where("$dateColumn >=", $startDate);
            }

            if ($endDate) {
                // Apply the end date filter with time set to 23:59:59 for the full end day
                $endDate = date('Y-m-d 23:59:59', strtotime($endDate)); // Ensuring the correct time format
                $this->db->where("$dateColumn <=", $endDate);
            }
        }          

    
        // Execute the query and get the result
        $query = $this->db->get($table);
        // Return the count value from the query result
        return $query->row()->count;
    }
    
    

    public function getTotalJob($perPage, $offset, $status, $country, $city)
    {
        if ($this->session->userdata('rolecode') == 3) {
            $multipleWhere = ['j.company_id' => $this->session->userdata('user_id')];
        } else {
            $multipleWhere = ['j.company_id >' => 0];
        }
    
        // Select distinct records to ensure uniqueness
        $this->db->select('j.*, COUNT(uj.id) AS total_applications');
        $this->db->join('user_jobs uj', 'uj.job_id = j.id', 'left'); // Use 'left' join to include jobs without applications
        $this->db->where($multipleWhere);
    
        if ($status === 'approved') {
            $this->db->where('approve', 1);
        }
    
        if ($country && $city) {
            $this->db->where('country', $country);
            $this->db->where('city', $city);
        } elseif ($country) {
            $this->db->where('country', $country);
        } elseif ($city) {
            $this->db->where('city', $city);
        }
    
        $this->db->where('deleted', NULL);
        $this->db->group_by('j.id'); // Group by job ID to ensure distinct records
        $this->db->order_by('j.created_at', 'desc');
        $this->db->limit($perPage, $offset);
    
        $query = $this->db->get('jobs j');
        return $query->result();
    }
    
    public function gettotalemployee($approved,$status=null,$perPage=null,$offset=null)
    {
        $status = $this->input->get('status');
       
        
        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['e.user_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['e.user_id>' => 0];
        }
        if (!empty($approved)) {
            $this->db->where('status>', 0);
        }elseif($status==='pending'){
            $this->db->where('status', 0); 
        }elseif($status === 'approved'){
            $this->db->where('status',1);
        }
        // if ($perPage) {
            $this->db->limit($perPage,$offset);
        // }
        $this->db->select('*');
        $this->db->where($multipleWhere);

        $query = $this->db->get('employee_profile e');

        return $query->result();

    }

    public function countEmploy($status = null) {
    
        // Check user role and set conditions
        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['e.user_id' => $this->session->userdata('user_id')];
        } else {
            $multipleWhere = ['e.user_id>' => 0]; 
        }
    
        // Apply conditions based on the status parameter
        if ($status === 'pending') {
            $this->db->where('status', 0); 
        } else {
            $this->db->where('status>', 0); // Corrected the syntax
        }
    
        // Apply the where conditions
        $this->db->where($multipleWhere);

        // Get the count of matching records
        $count = $this->db->count_all_results('employee_profile e');
 
        // Return the count
        return $count;
    }
    public function getPendingEmployee($approved = null) {
        // Check user role and set conditions
        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['e.user_id' => $this->session->userdata('user_id')];
        } else {
            $multipleWhere = ['e.user_id >' => 0]; // Corrected the syntax
        }
    
        // Check if approved is not empty and set the status condition
     //   if (!empty($approved)) {
            $this->db->where('status', 0); // Corrected the syntax
      //  }
    
        // Select all columns and apply the where conditions
        $this->db->select('*');
        $this->db->where($multipleWhere);
    
        // Execute the query
        $query = $this->db->get('employee_profile e');
     
        // Return the result
        return $query->result();
    }
    public function getshortlistedemployee()
    {    

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.id>' => 0];
        }
        $this->db->select('e.*');
        $this->db->where($multipleWhere);
        if ($this->session->userdata('rolecode') == 3) {
            $this->db->where('j.user_id', $this->session->userdata('user_id'));
        }
        $this->db->join('employee_profile e', 'e.user_id=j.user_id', 'left');
        $this->db->where('j.short_list', 1);
        $query = $this->db->get('user_jobs j');
        // print_r($query->result());
        // die();
        return $query->result();

    }
    public function getassignedemployee($job_id = "")
    {   
        
        if ($job_id <= 0 or $job_id == "") {
            if ($this->session->userdata('rolecode') == 2) {
                $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];

            } else {
                $multipleWhere = ['j.id>' => 0];
            }
            $this->db->select('e.*');
            $this->db->where($multipleWhere);
            if ($this->session->userdata('rolecode') == 3) {
                $this->db->where('j.user_id', $this->session->userdata('user_id'));
            }
            $this->db->join('employee_profile e', 'e.user_id=j.user_id', 'left');
            $this->db->where('j.short_list', 11);
            $query = $this->db->get('user_jobs j');
            //  echo "first";
            //  exit;
            return $query->result();
        } elseif ($this->session->userdata('rolecode') == 2 or $this->session->userdata('rolecode') == 1) {
            if ($this->session->userdata('rolecode') == 2) {
                $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];

            } else {
                $multipleWhere = ['j.id>' => 0];
            }
           
            $this->db->select('e.*');
            $this->db->where($multipleWhere);
            $this->db->where('jobs.id', $job_id);
            $this->db->join('jobs jobs', 'jobs.id=j.job_id', 'left');
            if ($this->session->userdata('rolecode') == 3) {
                $this->db->where('j.user_id', $this->session->userdata('user_id'));
            }
            $this->db->join('employee_profile e', 'e.user_id=j.user_id', 'left');
            $this->db->where('j.short_list', 11);
            $query = $this->db->get('user_jobs j');
            // echo $query->result();
            //   echo "second";
            //   exit;
            return $query->result();
        } else {
            $this->db->select('e.*');
            $this->db->where('jobs.company_id', $this->session->userdata('user_id'));
            $this->db->where('jobs.id', $job_id);
            $this->db->join('employee_profile e', 'e.user_id=j.user_id', 'left');
            $this->db->join('jobs jobs', 'jobs.id=j.job_id', 'left');
            $this->db->where('j.short_list', 11);
            $query = $this->db->get('user_jobs j');
// echo "third";
            return $query->result();
        }

    }

    // get assigned employee count

    public function getassignedemployeeCount($job_id = "")
    {
        if ($this->session->userdata('rolecode') == 2 or $this->session->userdata('rolecode') == 1) {
            if ($this->session->userdata('rolecode') == 2) {
                $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];

            } else {
                $multipleWhere = ['j.id>' => 0];
            }
            $this->db->select('e.*');
            $this->db->where($multipleWhere);
            $this->db->where('jobs.id', $job_id);
            $this->db->join('jobs jobs', 'jobs.id=j.job_id', 'left');
            if ($this->session->userdata('rolecode') == 3) {
                $this->db->where('j.user_id', $this->session->userdata('user_id'));
            }
            $this->db->join('employee_profile e', 'e.user_id=j.user_id', 'left');
            $this->db->where('j.short_list', 11);
            $query = $this->db->get('user_jobs j');

            return $query->num_rows();
        } else {
            $this->db->select('e.*');
            $this->db->where('jobs.company_id', $this->session->userdata('user_id'));
            $this->db->where('jobs.id', $job_id);
            $this->db->join('employee_profile e', 'e.user_id=j.user_id', 'left');
            $this->db->join('jobs jobs', 'jobs.id=j.job_id', 'left');
            $this->db->where('j.short_list', 11);
            $query = $this->db->get('user_jobs j');

            return $query->num_rows();
        }

    }

    public function getapprovedjobs($category_id = 0)
    {
        if ($this->session->userdata('rolecode') == 3) {
            $multipleWhere = ['j.company_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.company_id>' => 0];
        }
        $this->db->select('*');
        $this->db->where($multipleWhere);
        $this->db->where('deleted', NULL);
        if ($this->session->userdata('rolecode') == 2) {
            if (!empty($category_id) && $category_id != 0) {
                $this->db->where('category', $category_id);
            } else {
                $this->db->where('category', $this->session->userdata('category_id'));
            }
        }
        $this->db->where('approve', 1);
        $query = $this->db->get('jobs j');
        return $query->result();

    }
    public function getCategory($user_id)
    {
        $this->db->select('category_id');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get('employee_profile');
        return $query->row();

    }
    public function getpendingjobs()
    {
        if ($this->session->userdata('rolecode') == 3) {
            $multipleWhere = ['j.company_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.company_id>' => 0];
        }
        $this->db->select('*');
        $this->db->where($multipleWhere);
        $this->db->where('approve', 0);
        $query = $this->db->get('jobs j');
        return $query->result();

    }
    public function getuserjobs($id)
    {
        $this->db->select('short_list, COUNT(id) as count');
        $this->db->where('job_id', $id);
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->group_by('short_list'); 
        $query = $this->db->get('user_jobs');
        return $query->result(); 
    }
    
    public function getStatus()
    {
        $this->db->select('status');
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $query = $this->db->get('employee_profile');
        return $query->row();

    }
    public function getCompanyStatus()
    {
        $this->db->select('status');
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $query = $this->db->get('employer_profile');
        return $query->row();

    }
    
    public function getUserCategory(){
        $this->db->select('category_id');
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $query = $this->db->get('employee_profile');
        return $query->row();
    }
    public function getShortlistjob()
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.id>' => 0];
        }
        $this->db->select('jo.*');
        $this->db->where($multipleWhere);
        if ($this->session->userdata('rolecode') == 3) {
            $this->db->where('j.user_id', $this->session->userdata('user_id'));
        }
        $this->db->where('j.short_list', 1);
        $this->db->join('jobs jo', 'jo.id=j.job_id', 'left');
        $query = $this->db->get('user_jobs j');

        return $query->result();

    }
    public function getAssignedjob()
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];
        } else {
            $multipleWhere = ['j.id>' => 0];
        }
        $this->db->select('jo.*');
        $this->db->where($multipleWhere);
        if ($this->session->userdata('rolecode') == 3) {
            $this->db->where('j.user_id', $this->session->userdata('user_id'));
        }
        $this->db->where('j.short_list', 11);
        $this->db->join('jobs jo', 'jo.id=j.job_id', 'left');
        $query = $this->db->get('user_jobs j');

        return $query->result();

    }

}
