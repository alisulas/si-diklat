<?php
/**
 * Description of model activity
 *
 * @author Administrator
 */
class Mdl_activity extends CI_Model{
    private $table='activity';
    private $table_function='function';
    private $table_program='program';

    /**
     * CRUD Activity
     */
    function get_function()
    {
        return $this->db->get($this->table_function);
    }

     function get_program()
    {
        return $this->db->get($this->table_program);
    }

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

    // Add new activity
    function add_activity($var)
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
    function get_by_id($id)
    {
        $this->db->where('plc_course_id',$id);
        return $this->db->get($this->table);
    }

     // Get Function by id
    function get_function_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table_function);
    }

     // Get Program by id
    function get_program_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table_program);
    }



    // Update activity
    function update($id,$data)
    {
        $this->db->where('plc_course_id',$id);
        return $this->db->update($this->table,$data);
    }

    // Update one
    function update_one($id,$field,$val)
    {
	$this->db->where('plc_course_id',$id);
	$data=array($field=>$val);
	return $this->db->update($this->table,$data);
    }

    // Upload file
    function upload_file($course_id,$id,$val)
    {
	$this->db->where('plc_course_id',$course_id);
	$data=array($id=>$val);
	return $this->db->update($this->table,$data);
    }

    // Download file
    function download($course_id,$id)
    {
	$this->db->where('plc_course_id',$course_id);
	return $this->db->get($this->table)->row()->$id;
    }
}

/* End of file mdl_activity.php */
/* Location: ./application/models/mdl_activity.php */
