<?php
/**
 * Description of model schedule
 *
 * @author Administrator
 */
class Mdl_schedule extends CI_Model{
    private $table='schedule';


    /**
     * CRUD Activity
     */
    function get_index($limit=30,$offset=0)
    {
        return $this->db->get($this->table,$limit,$offset);
    }
    // Counting Pagination
    function count_all()
    {
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }

    function add($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }

    // Initiate database
    function init($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }

    // Delete activity
    function delete($id)
    {
        $this->db->where('plc_course_id',$id);
        return $this->db->delete($this->table);
    }

    // Get activity by id
    function get_by_id($id,$w,$d)
    {
        $this->db->where('plc_course_id',$id);
        $this->db->where('w',$w);
        $this->db->where('d',$d);
        return $this->db->get($this->table);
    }

    function get_by_course_id($id)
    {
	$this->db->where('plc_course_id',$id);
	return $this->db->get($this->table);
    }

    function update_schedule($id,$w,$d,$var)
    {
	$this->db->where('plc_course_id',$id);
	$this->db->where('w',$w);
	$this->db->where('d',$d);
	return $this->db->update($this->table,$var);
    }
}

/* End of file mdl_schedule.php */
/* Location: ./application/models/mdl_schedule.php */
