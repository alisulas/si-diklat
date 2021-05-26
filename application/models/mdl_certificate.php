<?php
/**
 * Description of course
 *
 * @author Administrator
 */
class Mdl_certificate extends CI_Model{
    private $table='certificate';
    

    /**
     * CRUD Course
     */
    function get_index($limit=10,$offset=0,$month,$expired)
    {
        if(empty($month) && empty($expired)){
            $month=0;
            $expired='all';
        }
        
        if(!$month==0){
        $this->db->where('MONTH(`expired`)', $month);
        }
        
        if($expired=='all'){
            
        }else{
            if($expired=='un'){
             $this->db->where('status',1);
            }
        elseif($expired>90)
	    {
            $this->db->where('`expired_left` > 90',NULL,FALSE );
	    } elseif($expired<=90 && $expired>=60) {
	$this->db->where('`expired_left` <= 90',NULL,FALSE );
	$this->db->where('`expired_left` >= 60',NULL,FALSE );
	    }
            elseif($expired>0 && $expired<60) {
		$this->db->where('`expired_left` > 0',NULL,FALSE );
		$this->db->where('`expired_left` < 60',NULL,FALSE );
	    }elseif($expired<0){
$this->db->where('`expired_left`<0',NULL,FALSE );
            }
            
            }
            
        
        
        return $this->db->get($this->table,$limit,$offset);
    }
    
    function to_exel($month,$expired) {
           if(empty($month) && empty($expired)){
            $month=0;
            $expired='all';
        }
        
        if(!$month==0){
        $this->db->where('MONTH(`expired`)', $month);
        }
        
        if($expired=='all'){
            
        }else{
            if($expired=='un'){
             $this->db->where('status',1);
            }
        elseif($expired>90)
	    {
            $this->db->where('`expired_left` > 90',NULL,FALSE );
	    } elseif($expired<=90 && $expired>=60) {
	$this->db->where('`expired_left` <= 90',NULL,FALSE );
	$this->db->where('`expired_left` >= 60',NULL,FALSE );
	    }
            elseif($expired>0 && $expired<60) {
		$this->db->where('`expired_left` > 0',NULL,FALSE );
		$this->db->where('`expired_left` < 60',NULL,FALSE );
	    }elseif($expired<0){
$this->db->where('`expired_left`<0',NULL,FALSE );
            }
            
            }
            
        
        
        return $this->db->get($this->table);     
    }
    
    function update_expired($id,$expired){
        $this->db->where('id',$id);
        return $this->db->update($this->table,array(
            'expired_left'=>$expired
        ));
    }
    // Counting Pagination
    function count_all()
    {
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }

    // Add new Certificate
    function add($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }

    // Delete Certificate
    function delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }

    // Get Certificate by id
    function get_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
    // Update Certificate
    function update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }
}

/* End of file certificate.php */
/* Location: ./application/models/mdl_certificate.php */
