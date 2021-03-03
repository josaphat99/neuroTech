<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model
{
    public function __construct(){
		parent :: __construct();
    }
    
	public function get_data($table, $clause=[],$ordre=null)
	{
        $this->db->order_by($ordre);
        $this->db->where($clause);
        return $this->db->get($table)->result();
	}
	
	public function get_data_desc($table,$clause=[])
	{
		$this->db->order_by('id','DESC');
        $this->db->where($clause);
        return $this->db->get($table)->result();
	}

	public function get_data_desc_by_field($table,$clause=[],$field)
	{
		$this->db->order_by($field,'DESC');
        $this->db->where($clause);
        return $this->db->get($table)->result();
	}

	public function add_data($table, $data){
		$this->db->insert($table, $data);
	}

	public function delete_data($table, $clause)
	{
		$this->db->where($clause);
		$this->db->delete($table);
	}

	public function update_data($table, $clause, $data)
	{
		$this->db->where($clause);
		$this->db->update($table, $data);
	}

	public function join_data($ind="*", $table, $table2, $join, $clause=[], $ordre=null,$group_by=[] )
	{
        $this->db->select($ind);
		$this->db->from($table);
		$this->db->join($table2, $join);
        $this->db->order_by($ordre);
		$this->db->where($clause);
        $this->db->group_by($group_by);

        return $this->db->get()->result();
	}
}