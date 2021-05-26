<?php

class Mdl_memo extends CI_Model {
    private $table='memo';
    private $table_function='function';

    function get_index($limit=10,$offset=0)
    {
        return $this->db->get($this->table,$limit,$offset);
    }
    // Counting Pagination
    function count_all()
    {
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }

    // Add new course
    function add($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }

    // Delete course
    function delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }

    // Get course by id
    function get_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
    
    function get_function()
    {
        return $this->db->get($this->table_function);
    }

    // Update course
    function update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }
    
}
?>
