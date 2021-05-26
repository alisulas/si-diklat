<?php
class Mdl_finance extends CI_Model{
   private $table_finance = 'finance';
   private $table_finance_kelengkapan = 'finance_kelengkapan';
   private $table_course = 'course';

   
   function get_index($limit=10,$offset=0){
       $this->db->order_by('id','desc');
       return $this->db->get($this->table_finance,$limit, $offset) ;
   }
   
   function get_course($limit=10,$offset=0) {
       $this->db->order_by('id','desc');
       return $this->db->get($this->table_course,$limit,$offset);
   }
   
   function get_course_by_id($id) {
       $this->db->where('id',$id);
       return $this->db->get($this->table_course);
   }
      
   function count_all(){
       $q=  $this->db->get($this->table_course);
       return $q->num_rows();
   }
   
    function add_post_page($var)
    {
	$this->db->insert($this->table_finance_kelengkapan,$var);
	return $this->db->insert_id();
    }
    function get_kelengkapan($id) {
        $this->db->where('course_id',$id);
        return $this->db->get($this->table_finance_kelengkapan);
    }
    
    function update_kelengkapan($var,$id) {
        $this->db->where('course_id',$id);
        $this->db->update($this->table_finance_kelengkapan,$var);
    }
    
    function update_status($var,$id) {
        $this->db->where('id',$id);
        $this->db->update($this->table_finance_kelengkapan,$var);
    }
    
    function delete_kelengkapan($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_finance_kelengkapan);
    }
      
}