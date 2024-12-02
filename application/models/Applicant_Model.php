<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Applicant_Model extends CI_Model
{

        public function getapplicantDetails($limit, $offset)
        {
                $this->db->select('e.*, category_name, co.country_name as cocountry_name, u.user_source');
                $this->db->join('job_category c', 'c.id = e.category_id', 'left');
                $this->db->join('country co', 'co.id = e.country', 'left');
                $this->db->join('users u', 'u.id = e.user_id', 'left');
                $this->db->limit($limit, $offset);
                $query = $this->db->get('employee_profile e');
                return $query->result();
        }


        public function countApplicantDetails()
        {
                return $this->db->count_all('employee_profile');
        }

        public function getassignedJob()
        {
                $this->db->select('*,user_jobs.id as user_job_id,e.id as employee_id');
                $this->db->join('users', 'e.user_id =users.id', 'inner');
                $this->db->join('user_jobs', ' e.user_id = user_jobs.user_id', 'inner');
                $this->db->join('jobs', ' user_jobs.job_id =jobs.id', 'inner');
                $this->db->where('e.status', 1);
                $query = $this->db->get('employee_profile e');
                // print_r($this->db->last_query());exit();
                return $query->result();
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
                $sql_query = $this->db->where('id', $uid)
                        ->delete('user_jobs');
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
