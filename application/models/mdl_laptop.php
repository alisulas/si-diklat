<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_laptop extends CI_Model {
    public $table='laptop';

    function __construct() {
	parent::__construct();
    }
    
    function get_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
    
    function get_index() {
        $this->db->order_by('id','desc');   
        return $this->db->get($this->table);
    }
    
    function count_all() {
        $q=$this->db->get($this->table);
        return $q->num_rows();
    }
    
    function update($id,$var) {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$var);
    }
    
    function add($var) {
        return $this->db->insert($this->table,$var);
    }
    
    function delete($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
    
       function lookup_laptop($keyword) {
        $this->db->like('no_asset', $keyword, 'after');
        $this->db->where('status',1);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    function update_status($id,$val) {
        $this->db->where('id',$id);
        $var=array(
            'status'=>$val
        );
        return $this->db->update($this->table,$var);
    }
    
}

/* End of file mdl_user.php */
/* Location: ./application/models/mdl_user.php */