<?php
/**
 * Description of model peserta
 *
 * @author Administrator
 */
class Mdl_libur extends CI_Model{
    private $table='libur';


    /**
     * CRUD Libur
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
    // Delete activity
    function delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
    
       function get_libur() {
        return $this->db->get($this->table);
    }

}

/* End of file mdl_libur.php */
/* Location: ./application/models/mdl_libur.php */
