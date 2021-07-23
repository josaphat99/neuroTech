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

	public function join_on_view_result($pass_id)
	{
		$this->db->select("*, question.id as id_question");
		$this->db->from('exercice');
		$this->db->join('passation', 'passation.exercice_id = exercice.id');
		$this->db->join('question', 'exercice.id = question.exercice_id');
		$this->db->where(['passation.id'=>$pass_id]);

        return $this->db->get()->result();
	}
}