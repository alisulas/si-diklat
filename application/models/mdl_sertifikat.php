<?php

class Mdl_sertifikat extends CI_Model{
    //put your code here

    private $table='sertifikat';
    private $table_sertifikat_jabatan='sertifikat_jabatan';
    private $table_pekerja='pekerja';
    private $table_jabatan='jabatan';
    private $table_sertifikat_log='sertifikat_log';
    
    
    function add_sertifikat($var) {
        $this->db->insert($this->table,$var);
        return $this->db->insert_id();
    }
    
    function add_sertifikat_jabatan($var) {
        $this->db->insert($this->table_sertifikat_jabatan,$var);
        return $this->db->insert_id();
    }
    
    function count_all() {
        $a= $this->db->get($this->table);
        return $a->num_rows();
    }
    function count_sertifikat_jabatan_all() {
        $a= $this->db->get($this->table_sertifikat_jabatan);
        return $a->num_rows();
    }
    
    function get_sertifikat($limit=10,$offset=0,$month,$expired) {
        
                if(empty($month) && empty($expired)){
            $month=0;
            $expired='all';
        }
        
        if(!$month==0){
        $this->db->where('MONTH(`waktu`)', $month);
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
        $this->db->where('MONTH(`waktu`)', $month);
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
    
    function get_sertifikat_jabatan($limit=10,$offset=0,$pilihan,$pencarian) {
       if (empty($pilihan) || empty($pencarian)){
           
       }else{
        
        if($pilihan==1){
            $this->db->like('kode',$pencarian);
        }elseif($pilihan==2){
            $this->db->like('name',$pencarian);
        }   
       }
        return $this->db->get($this->table_sertifikat_jabatan,$limit,$offset);
    }
    
    function get_sertifikat_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
    
    function get_sertifikat_jabatan_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table_sertifikat_jabatan);
    }
    
    function update_sertifikat($id,$data) {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }
    
    function update_sertifikat_jabatan($id,$data) {
        $this->db->where('id',$id);
        return $this->db->update($this->table_sertifikat_jabatan,$data);
    }
    
    function delete_sertifikat($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
    
    
    function delete_pekerja($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_pekerja);
    }
    
    function delete_jabatan($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_jabatan);
    }
    
    function delete_sertifikat_jabatan($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_sertifikat_jabatan);
    }
    
        function lookup_sertifikat($keyword){
        $this->db->like('name',$keyword,'after');
        $query = $this->db->get($this->table_sertifikat_jabatan);
        return $query->result_array();
    }
        function lookup_jabatan($keyword){
        $this->db->like('name',$keyword,'after');
        $query = $this->db->get($this->table_jabatan);
        return $query->result_array();
    }
    
        function lookup_pekerja($keyword){
        $this->db->like('name',$keyword,'after');
        $query = $this->db->get($this->table_pekerja);
        return $query->result_array();
    }
    
    function  lookup_sertifikasi_jabatan($keyword){
        $this->db->like('kode',$keyword,'after');
        $query= $this->db->get($this->table_sertifikat_jabatan);
        return $query->result_array();
    }


    function add_jabatan($var) {
        $this->db->insert($this->table_jabatan,$var);
        return $this->db->insert_id();
    }
    
    function count_jabatan() {
       $v= $this->db->get($this->table_jabatan);
       return $v->num_rows();
    }
    
    function get_jabatan($limit=10,$offset=0,$pilihan,$pencarian) {
     if (empty($pilihan) || empty($pencarian)){
           
       }else{
        
        if($pilihan==1){
            $this->db->like('kode',$pencarian);
        }elseif($pilihan==2){
            $this->db->like('name',$pencarian);
        }   
       }
        return $this->db->get($this->table_jabatan,$limit,$offset);
    }
    
    function get_jabatan_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table_jabatan);
    }
    
       function update_jabatan($id,$data) {
        $this->db->where('id',$id);
        return $this->db->update($this->table_jabatan,$data);
    }
    
    function update_pekerja($id,$data) {
        $this->db->where('id',$id);
        return $this->db->update($this->table_pekerja,$data);
    }
    
    function add_pekerja($var) {
             $this->db->insert($this->table_pekerja,$var);
        return $this->db->insert_id();   
    }
    
 
    
    function count_pekerja() {
        $b=  $this->db->get($this->table_pekerja);
        return $b->num_rows();
    }
    
        function get_pekerja($limit=10,$offset=0,$pilihan,$pencarian) {
                 if (empty($pilihan) || empty($pencarian)){
           
       }else{
        
        if($pilihan==1){
            $this->db->like('nopek',$pencarian);
        }elseif($pilihan==2){
            $this->db->like('name',$pencarian);
        }   
       }
        return $this->db->get($this->table_pekerja,$limit,$offset);
    }
    
    function get_pekerja_by_id($id){
        $this->db->where('id',$id);
        return $this->db->get($this->table_pekerja);
    }
    
    function add_log($var) {
        $this->db->insert($this->table_sertifikat_log,$var);
        return $this->db->insert_id();
    }
    
    function get_log_by_id($id) {
        $this->db->where('plc_sertifikat_id',$id);
        return $this->db->get($this->table_sertifikat_log);
    }
    
    function get_log_pekerja_by_id($id) {
        $this->db->where('plc_pekerja_id');
        return $this->db->get($this->table_sertifikat_log);
    }
    
    function get_sertifikat_by_pekerja($id) {
        $this->db->where('plc_pekerja_id',$id);
        return $this->db->get($this->table);
    }
    
    function get_sertifikat_by_kode($id_pekerja,$kode){
        $this->db->where('plc_pekerja_id',$id_pekerja);
        $this->db->where('kode',$kode);
        return $this->db->get($this->table);
    }
    
   function update_expired_left($id,$expired){
        $this->db->where('id',$id);
        return $this->db->update($this->table,array(
            'expired_left'=>$expired
        ));
    }
    
    function update_mail_date($id, $last_mail) {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$last_mail) ;
    }
    
    function get_jabatan_by_kode($kode) {
        $this->db->where('kode',$kode);
        return $this->db->get($this->table_jabatan);
    }
}