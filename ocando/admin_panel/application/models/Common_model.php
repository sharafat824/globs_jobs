<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Common_model extends CI_Model
{
    public function getDetails($table,$join)
    {   
        if(!empty($join)){
            $query = $this->db->select('t.*,m.display_name')
            ->join('modules m','t.module=m.id')
            ->get($table.' t');
        }else{
            $query = $this->db->select('*')
            ->get($table);
        }
        
        return $query->result();
    }
    public function getDetailsByID($uid, $table)
    {
        $ret = $this->db->select('*')
            ->where('id', $uid)
            ->get($table);
        return $ret->row();
    }
    public function getDetailsByIDType($uid, $where_field ,$table)
    {
        $ret = $this->db->select('*')
            ->where($where_field, $uid)
            ->get($table);
        return $ret->result();
    }
    public function deleteDetailsByID($uid, $table)
    {
        $sql_query = $this->db->where('id', $uid)
            ->delete($table);
        if ($this->db->affected_rows() > 0) {
            return true;

        } else {
            return false;
        }
    }
    public function addDetails($data, $table)
    {
        $sql_query = $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            return true;

        } else {
            return false;
        }

    }
    public function updateDetails($data, $id, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);

        return true;
    }
}