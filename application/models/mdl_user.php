<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_user extends CI_Model {
    public $table_user='user';
    public $table_function='function';


    function __construct() {
	parent::__construct();
    }

    function get_login_info($username){
        $this->db->where('status',1);
	$this->db->where('username',$username);
	return $this->db->get($this->table_user);
    }
    
    function get_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table_user);
    }
    
    function get_index() {
        $this->db->order_by('id','desc');   
        return $this->db->get($this->table_user);
    }
    
    function count_all() {
        $q=$this->db->get($this->table_user);
        return $q->num_rows();
    }

    function get_function()
    {
	return $this->db->get($this->table_function);
    }
    
    function update_user($id,$var) {
        $this->db->where('id',$id);
        return $this->db->update($this->table_user,$var);
    }
    
    function last_login($id) {
        $this->db->where('id',$id);
        $tgl_login=array(
            'last_login'=>date('Y-m-d G:i:s')
        );
        return $this->db->update($this->table_user,$tgl_login);
    }
    
        function get_function_by_id($id)
    {
            $this->db->where('id',$id);
	return $this->db->get($this->table_function);
    }
    
    function add($var) {
        return $this->db->insert($this->table_user,$var);
    }
    
    function delete($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_user);
    }
    
}

/* End of file mdl_user.php */
/* Location: ./application/models/mdl_user.php */