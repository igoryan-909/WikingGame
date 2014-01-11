<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class crud extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add($table_name, $data)
    {
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }
    
    public function edit($table_name, $data, $where)
    {
        $this->db->update($table_name, $data, $where);
    }
    
    public function get($table_name, $where)
    {
        $query = $this->db->get_where($table_name, $where);
        return $query->result_array();
    }
    
    public function delete($table_name, $where)
    {
        $this->db->delete($table_name, $where);
    }
}