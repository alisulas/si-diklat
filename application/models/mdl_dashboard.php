<?php
/**
 * Description of course
 *
 * @author Administrator
 */
class Mdl_dashboard extends CI_Model{
    private $table_main='main';
    private $table_course='course';
    private $table_kursil='kursil';
    private $table_provider='provider';
    private $table_trainer='trainer';
    private $table_peserta='peserta';

    /**
     * CRUD Course
     */
    function get_index()
    {
        $this->db->limit(1);
        return $this->db->get($this->table_main);
    }
    
    function get_course_week() {
      $query=  $this->db->query('SELECT * FROM plc_course WHERE start_date BETWEEN curdate() - weekday(curdate()) AND curdate() - weekday(curdate()) + 6');
        return $query;
        
    }

    function update_dashboard($var)
    {
        $this->db->where('id',1);
        $data=array(
            'title'=>$var['title'],
            'subtitle'=>$var['subtitle'],
            'text'=>$var['text']
        );
        $q=  $this->db->update($this->table_main,$data);
        if($q)
            return TRUE;
        else
            return FALSE;
    }

    function get_all()
    {
	return $this->db->get($this->table_course);
    }
    
    function get_course_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table_course) ;
    }
    
    function get_kursil_by($id){
        $this->db->where('plc_course_id',$id);
        return $this->db->get($this->table_kursil) ;
    }
    
    function get_provider_by($id_provider) {
        $this->db->where('id',$id_provider);
        return $this->db->get($this->table_provider) ;
    }
    function get_trainer_by($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table_trainer) ;
    }
    function update_status($id,$status)
    {
	$this->db->where('id',$id);
	return $this->db->update($this->table_course,$status);
    }
    
    function get_peserta_by_course($id) {
        $this->db->where('plc_course_id',$id);
        $q=$this->db->get($this->table_peserta);
        return $q->num_rows();
    }
}

/* End of file course.php */
/* Location: ./application/models/course.php */