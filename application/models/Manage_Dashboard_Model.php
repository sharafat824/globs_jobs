<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Manage_Dashboard_Model extends CI_Model
{

    public function totaljob()
    {

        if ($this->session->userdata('rolecode') == 3) {
            $multipleWhere = ['j.company_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.company_id>' => 0];
        }
        $this->db->select('count(j.id) as job_count');
        $this->db->where($multipleWhere);
        $this->db->where('deleted', NULL);
        $query = $this->db->get('jobs j');
        $cnt2 = $query->row();

        $total = $cnt2->job_count;

        return $total;

    }
    public function approvedjob($category_id = 0)
    {

        if ($this->session->userdata('rolecode') == 3) {
            $multipleWhere = ['j.company_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.company_id>' => 0];
        }
        $this->db->select('count(j.id) as job_count');
        $this->db->where($multipleWhere);
        $this->db->where('deleted', NULL);
        if ($this->session->userdata('rolecode') == 2) {
            if (!empty($category_id) && $category_id!= 0) {
                $this->db->where('category', $category_id);
            } else {
                $this->db->where('category', 0);
            }
        }
        $this->db->where('approve', 1);
        $query = $this->db->get('jobs j');
        $cnt2 = $query->row();

        $total = $cnt2->job_count;

        return $total;

    }
    public function pendingjob()
    {

        if ($this->session->userdata('rolecode') == 3) {
            $multipleWhere = ['j.company_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.company_id>' => 0];
        }
        $this->db->select('count(j.id) as job_count');
        $this->db->where($multipleWhere);
        $this->db->where('approve', 0);
        $query = $this->db->get('jobs j');
        $cnt2 = $query->row();

        $total = $cnt2->job_count;

        return $total;

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
    public function Shortlistjob($category_id = 0)
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.id>' => 0];
        }
        $this->db->select('count(j.id) as job_count');
        $this->db->where($multipleWhere);
        if ($this->session->userdata('rolecode') == 3) {
            $this->db->where('j.user_id', $this->session->userdata('user_id'));
        }
        $this->db->where('short_list', 1);
        $query = $this->db->get('user_jobs j');
        $cnt2 = $query->row();

        $total = $cnt2->job_count;

        return $total;

    }
    public function Assignedjob($category_id = 0)
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['j.user_id' => $this->session->userdata('user_id')];
        } else {
            $multipleWhere = ['j.id>' => 0];
        }
        $this->db->select('count(j.id) as job_count');
        $this->db->where($multipleWhere);
        if ($this->session->userdata('rolecode') == 3) {
            $this->db->where('j.user_id', $this->session->userdata('user_id'));
        }
        $this->db->where('short_list', 11);
        $query = $this->db->get('user_jobs j');
        $cnt2 = $query->row();

        $total = $cnt2->job_count;

        return $total;

    }

    public function totalemployee()
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['e.user_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['e.user_id>' => 0];
        }
        $this->db->select('count(e.id) as employee_count');
        $this->db->where($multipleWhere);

        $query = $this->db->get('employee_profile e');
        $cnt2 = $query->row();

        $total = $cnt2->employee_count;

        return $total;

    }

    public function totalemployer()
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['e.user_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['e.user_id>' => 0];
        }
        $this->db->select('count(e.id) as employer_count');
        $this->db->where($multipleWhere);

        $query = $this->db->get('employer_profile e');
        $cnt2 = $query->row();

        $total = $cnt2->employer_count;

        return $total;

    }

    public function approvedemployee()
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['e.user_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['e.user_id>' => 0];
        }
        $this->db->select('count(e.id) as employee_count');
        $this->db->where($multipleWhere);
        $this->db->where('status>', 0);
        $query = $this->db->get('employee_profile e');
        $cnt2 = $query->row();

        $total = $cnt2->employee_count;

        return $total;

    }

    public function gettotaljob()
    {

        if ($this->session->userdata('rolecode') == 3) {
            $multipleWhere = ['j.company_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['j.company_id>' => 0];
        }
        $this->db->select('*');
        $this->db->where($multipleWhere);
        $this->db->where('deleted', NULL);
        $query = $this->db->get('jobs j');
        return $query->result();

    }
    public function gettotalemployee($approved)
    {

        if ($this->session->userdata('rolecode') == 2) {
            $multipleWhere = ['e.user_id' => $this->session->userdata('user_id')];

        } else {
            $multipleWhere = ['e.user_id>' => 0];
        }
        if (!empty($approved)) {
            $this->db->where('status>', 0);
        }
        $this->db->select('*');
        $this->db->where($multipleWhere);

        $query = $this->db->get('employee_profile e');

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
