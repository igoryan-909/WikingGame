<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class crud extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add($table_name, $data)
    {
        if($this->db->insert($table_name, $data)) return TRUE;
        else return FALSE;
    }
    
    public function edit($table_name, $data, $where)
    {
        if($this->db->update($table_name, $data, $where)) return TRUE;
        else return FALSE;
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