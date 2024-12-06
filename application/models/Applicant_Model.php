<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Applicant_Model extends CI_Model
{

        public function getapplicantDetails($limit, $offset)
        {
                $this->db->select('
                e.*, 
                c.category_name, 
                co.country_name as cocountry_name, 
                u.user_source,
                COUNT(CASE WHEN uj.short_list = 1 THEN 1 END) as total_shortlisted_jobs,
                COUNT(CASE WHEN uj.short_list = 11 THEN 1 END) as total_assigned_jobs,
                COUNT(uj.id) as total_applied_jobs  -- Count all jobs the user applied for
            ');
                $this->db->join('job_category c', 'c.id = e.category_id', 'left');
                $this->db->join('country co', 'co.id = e.country', 'left');
                $this->db->join('users u', 'u.id = e.user_id', 'left');
                $this->db->join('user_jobs uj', 'uj.user_id = u.id', 'left');
                $this->db->group_by('e.id'); // Grouping to ensure aggregation works correctly
                $this->db->limit($limit, $offset);
                $query = $this->db->get('employee_profile e');
                return $query->result();
        }


        public function getassignedJob($limit, $offset)
        {
                $this->db->select('*,user_jobs.id as user_job_id,e.id as employee_id');
                $this->db->join('users', 'e.user_id =users.id', 'inner');
                $this->db->join('country c', 'c.id =e.country', 'inner');
                $this->db->join('user_jobs', ' e.user_id = user_jobs.user_id', 'inner');
                $this->db->join('jobs', ' user_jobs.job_id =jobs.id', 'inner');
                $this->db->where('e.status', 1);
                $this->db->limit($limit, $offset);
                $query = $this->db->get('employee_profile e');
                // print_r($this->db->last_query());exit();
                return $query->result();
        }

        public function fetchApplicants($limit, $offset, $searchValue, $orderColumn, $orderDirection, $categoryFilter = null, $countryFilter = null,$townFilter=null)
        {
            // Select the necessary columns
            $this->db->select('
                e.*, 
                c.category_name, 
                co.country_name as cocountry_name, 
                u.user_source,
                COUNT(CASE WHEN uj.short_list = 1 THEN 1 END) as total_shortlisted_jobs,
                COUNT(CASE WHEN uj.short_list = 11 THEN 1 END) as total_assigned_jobs,
                COUNT(uj.id) as total_applied_jobs -- Count all jobs the user applied for
            ');
        
            // Joins to fetch related data
            $this->db->join('job_category c', 'c.id = e.category_id', 'left');
            $this->db->join('country co', 'co.id = e.country', 'left');
            $this->db->join('users u', 'u.id = e.user_id', 'left');
            $this->db->join('user_jobs uj', 'uj.user_id = u.id', 'left');
        
            // Apply search filter
            if (!empty($searchValue)) {
                $this->db->group_start();
                $this->db->like('e.first_name', $searchValue);
                $this->db->or_like('e.last_name', $searchValue);
                $this->db->or_like('u.user_email', $searchValue);
                $this->db->group_end();
            }
        
            // Apply category filter
            if (!empty($categoryFilter)) {
                $this->db->where('c.id', $categoryFilter);
            }
        
            // Apply country filter
            if (!empty($countryFilter)) {
                $this->db->where('co.id', $countryFilter);
            }

            // Apply town filter
            if (!empty($townFilter)) {
                $this->db->where('e.town', $townFilter);
            }
        
            // Group by `e.id` to ensure proper aggregation
            $this->db->group_by('e.id');
        
            // Apply ordering
           $this->db->order_by('created_at', 'desc');
        
            // Apply limit and offset for pagination
            $this->db->limit($limit, $offset);
        
            // Execute the query
            $query = $this->db->get('employee_profile e');
        
            return $query->result_array(); // Return the results as an array
        }
        
        public function countFilteredApplicants($searchValue, $categoryFilter = null, $countryFilter = null,$townFilter=null)
        {
            // Join tables
            $this->db->join('job_category c', 'c.id = e.category_id', 'left');
            $this->db->join('country co', 'co.id = e.country', 'left');
            $this->db->join('users u', 'u.id = e.user_id', 'left');
            $this->db->join('user_jobs uj', 'uj.user_id = u.id', 'left');
      
            // Apply search filter
            if (!empty($searchValue)) {
                $this->db->group_start();
                $this->db->like('e.first_name', $searchValue);
                $this->db->or_like('e.last_name', $searchValue);
                $this->db->or_like('u.user_email', $searchValue);
                $this->db->group_end();
            }
        
            // Apply category filter
            if (!empty($categoryFilter)) {
                $this->db->where('c.id', $categoryFilter);
            }
        
            // Apply country filter
            if (!empty($countryFilter)) {
                $this->db->where('co.id', $countryFilter);
            }

            // Apply town filter
            if (!empty($townFilter)) {
                $this->db->where('e.town', $townFilter);
            }
        
            // Get the count of unique filtered results
            $this->db->distinct();
            $this->db->select('e.id');
            $this->db->from('employee_profile e');
        
            return $this->db->count_all_results();
        }
        



        public function countApplicantDetails()
        {
                return $this->db->count_all('employee_profile');
        }

        public function getIncompleteEmployeeProfiles()
        {

                $query = $this->db->query('SELECT u.id, u.user_email from users u WHERE NOT EXISTS (select epr.user_id from employee_profile epr WHERE u.id=epr.user_id)and u.user_role=2');
                return $query->result();
        }

        public function getIncompleteEmployerProfiles()
        {

                $query = $this->db->query('SELECT u.id, u.user_email from users u WHERE NOT EXISTS (select epr.user_id from employer_profile epr WHERE u.id=epr.user_id)and u.user_role=3');
                return $query->result();
        }

        public function getapplicant($decrypted_id)
        {

                $this->db->select('e.*,c.city_name as ccity_name,co.country_name as cocountry_name,c1.city_name as c1city_name,co1.country_name as co1country_name');
                $this->db->where('e.id', $decrypted_id);
                $this->db->join('city c', 'c.id=e.town', 'left');
                $this->db->join('country co', 'co.id=e.country', 'left');
                $this->db->join('city c1', 'c1.id=e.birth_city', 'left');
                $this->db->join('country co1', 'co1.id=e.nationality', 'left');
                $query = $this->db->get('employee_profile e');
                // print_r($this->db->last_query());exit();
                return $query->row();
        }

        // Function for use deletion
        public function deletecity($uid)
        {
                $sql_query = $this->db->where('id', $uid)
                        ->delete('employee_profile');
                if ($this->db->affected_rows() > 0) {
                        return true;
                } else {
                        return false;
                }
        }

        // Function for use deletion
        public function deletejob($uid)
        {
                $sql_query = $this->db->where('id', $uid);
                      
                if ($this->db->affected_rows() > 0) {
                        return true;
                } else {
                        return false;
                }
        }

        // Function for use deletion
        public function approved($uid)
        {
                $sql_query = $this->db->where('id', $uid)
                        ->delete('employee_profile');
                if ($this->db->affected_rows() > 0) {
                        return true;
                } else {
                        return false;
                }
        }

        public function approve($decrypted_id, $userInfo)
        {
                $this->db->where('id', $decrypted_id);
                $this->db->update('employee_profile', $userInfo);

                return TRUE;
        }
}
