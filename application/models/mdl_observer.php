<?php
/**
 * Description of model Observer
 *
 * @author Administrator
 */
class Mdl_observer extends CI_Model{
    private $table='observer';

    /**
     * CRUD Course
     */
    function get_index()
    {
        
        return $this->db->get($this->table);
    }
    
    function get_observer() {
        return $this->db->get($this->table);
    }
    function get_excel($observer_name)
    {
        if (empty($observer_name)){
            $observer_name='';
        }
        $this->db->like('nama',$observer_name);
        return $this->db->get($this->table);
    }
    // Counting Pagination
    function count_all()
    {
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }

    // Add provider
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

    // Update course
    function update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }
    

    

}

/* End of file mdl_provider.php */
/* Location: ./application/models/mdl_provider.php */
