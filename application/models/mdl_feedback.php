<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mdl_feedback extends CI_Model{
    //put your code here
    private $table='feedback';
    private $feedback_trainer='feedback_trainer';
    private $table_peserta='peserta';
    private $table_course='course';
    private $table_kursil='kursil';

    function get_index($limit=30,$offset=0)
    {
        return $this->db->get($this->table,$limit,$offset);
    }
    // Counting Pagination
    function count_all($id)
    {
        $this->db->where('plc_course_id',$id);
        $this->db->where('kehadiran',1);
	$q=$this->db->get($this->table_peserta);
        return $q->num_rows();
    }

    function add($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }
    function add_trainer($var){
        $this->db->insert($this->feedback_trainer,$var);
        return $this->db->insert_id();
    }
    // Delete activity
    function delete_course($id)
    {
        $this->db->where('plc_course_id',$id);
        return $this->db->delete($this->table);
    }
    // Delete activity
    function delete_trainer($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->feedback_trainer);
    }
    function delete_fb_peserta($id)
    {
        $this->db->where('plc_course_id',$id);
        return $this->db->delete($this->table);
    }

    // Get activity by id
    function get_by_course_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table_course);
    }
     function get_fb_by_course($id)
    {
        $this->db->where('plc_course_id',$id);
        return $this->db->get($this->table);
    }
    function get_by_id($id)
    {
        $this->db->where('plc_course_id',$id);
        return $this->db->get($this->table);
    }

    function get_fb_by($id_course,$id_trainer){
        $this->db->where('plc_course_id',$id_course);
        $this->db->where('plc_trainer_id',$id_trainer);
        return $this->db->get($this->feedback_trainer) ;
    }
    
    function get_feedbackpeserta_by_course($id){
        $this->db->where('plc_course_id',$id);
        return $this->db->get($this->table);
    }
    
    function get_kursil_by_course($id){
        $this->db->where('plc_course_id',$id);
        return $this->db->get($this->table_kursil);
    }
    
    function get_trainer_by_course($id){
        $this->db->where('plc_course_id',$id);
        return $this->db->get($this->feedback_trainer);
    }

}

?>
