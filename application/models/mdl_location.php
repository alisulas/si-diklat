<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdl_location
 *
 * @author adehermawan
 */
class mdl_location extends CI_Model{
    //put your code here
    private $table_location='lokasi';
    
    function get_city(){                        
       return $this->db->get($this->table_location) ;
   }
   
   function delete_city($id) {
       $this->db->where('id',$id);
       return $this->db->delete($this->table_location);
   }
   
   function edit_city($id,$var) {
        $this->db->where('id',$id);
        return $this->db->update($this->table_location,$var);
    }
    
    function count_all_location(){
       $q=  $this->db->get($this->table_location);
       return $q->num_rows();
   }
   
      function add_city($city) {
        $this->db->insert($this->table_location,$city);
    }
    
    function get_city_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table_location);
    }
   
   
}
