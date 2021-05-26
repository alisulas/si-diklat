<?php
/**
 * Description of mdl_calendar_course
 *
 * @author Ade Hermawan
 */
class mdl_calendar_course extends CI_Model{
    //put your code here
    private $table_course='course';

    
       function get_jadwal_course($limit,$offset=0,$bulan,$tahun) {
       // die($bulan.$tahun);
       $this->db->where('MONTH(`start_date`)', $bulan);
       $this->db->where('YEAR(`start_date`)', $tahun);
       $this->db->or_where('MONTH(`end_date`)', $bulan);
       $this->db->where('YEAR(`end_date`)', $tahun);
   //    $this->db->order_by('start_date','asc');
       return $this->db->get($this->table_course,$limit,$offset);
   }
       // Counting Pagination
    function count_all($bulan,$tahun) {
       $this->db->where('MONTH(`start_date`)', $bulan);
       $this->db->where('YEAR(`start_date`)', $tahun);
           $this->db->where('MONTH(`end_date`)', $bulan);
       $this->db->where('YEAR(`end_date`)', $tahun);
 //      $this->db->order_by('start_date','asc');    
        $q = $this->db->get($this->table_course);
        return $q->num_rows();
    }
   
}

?>
