<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mdl_fgt_induction extends CI_Model{
    private $table='fgt_induction';
    private $table_sarfas_pelatihan='sarfas_pelatihan';
    private $table_pelatihan_batal='fgt_induction_batal';
    private $table_biaya_pengajar='biaya_pengajar_induction';
    private $table_biaya_provider='biaya_provider_induction';
    private $table_biaya_observer='biaya_observer';
    private $table_peserta='peserta_induction';
    private $table_observer='observer';
    private $table_sarfas='sarfas_pelatihan';
    private $table_user='user';
    private $table_support='support_induction';
            
            
            
    function get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai) {
        if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
  
        
        $this->db->order_by('id','desc');
        return $this->db->get($this->table);
    }
    
       function get_index_canceled($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai) {
        if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
  
        
        $this->db->order_by('id','desc');
        return $this->db->get($this->table_pelatihan_batal);
    }
    
       function get_index_sarfas($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$limit,$offset=0) {
        if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
  
        
        $this->db->order_by('tempat','asc');
        return $this->db->get($this->table,$limit,$offset);
    }
    
     function get_index_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai) {
        if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }

$this->db->order_by('tgl_mulai','desc');
        return $this->db->get($this->table);
    }
    
       function get_index_view_bulan() {
       
$this->db->where('tgl_mulai BETWEEN "'. date('Y-m-01'). '" and "'. date('Y-m-t').'"');
$this->db->order_by('tgl_mulai','desc');
        return $this->db->get($this->table);
    }
    
   function get_plan($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$limit,$offset=0) {
           if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
       $this->db->where('plan_status',0);
       $this->db->order_by('id','desc');
        return $this->db->get($this->table,$limit,$offset);
    }
    
      function count_plan($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai) {
           if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
          $this->db->where('plan_status',0);
       
        return $this->db->get($this->table)->num_rows();
    }
    
    function count_batch($kd_pelatihan) {
        $this->db->where('kd_pelatihan',$kd_pelatihan);
        return $this->db->get($this->table)->num_rows();
    }

    function get_do($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$limit,$offset=0) {
           if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
        $this->db->where('do_status',0);
       $this->db->order_by('id','desc');
        return $this->db->get($this->table,$limit,$offset);
    }
        function count_do($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai) {
       $this->db->where('do_status',0);
           if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
           $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
        return $this->db->get($this->table)->num_rows();
    }
        function get_check($limit,$offset=0) {
       $this->db->where('check_status',0);
       $this->db->order_by('id','desc');
        return $this->db->get($this->table,$limit,$offset);
    }
    
           function count_check() {
       $this->db->where('check_status',0);
        return $this->db->get($this->table)->num_rows();
    }
    
           function get_action($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$limit,$offset=0) {
       $this->db->where('action_status',0);
           if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
       $this->db->order_by('id','desc');
        return $this->db->get($this->table,$limit,$offset);
    }
              function count_action($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai) {
       $this->db->where('action_status',0);
           if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
        return $this->db->get($this->table)->num_rows();
    }
    
    function add($dat) {
        return $this->db->insert($this->table,$dat);
    }
    
    function add_pelatihan_batal($batal) {
        return $this->db->insert($this->table_pelatihan_batal,$batal);
    }
    
    function add_biaya_pengajar($var) {
        return $this->db->insert($this->table_biaya_pengajar,$var);
    }
    
    
    function cek_biaya_pengajar($id) {
        $this->db->where('id_fgt_induction',$id);
        $q=  $this->db->get($this->table_biaya_pengajar);
        return $q->num_rows();
    }
    
        function cek_biaya_provider($id) {
        $this->db->where('id_fgt_induction',$id);
        $q=  $this->db->get($this->table_biaya_provider);
        return $q->num_rows();
    }
    
    function update($id,$dat) {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$dat);
    }
    
    
    function cek_peserta($id) {
        $this->db->where('id_fgt_induction',$id);
        $q=  $this->db->get($this->table_peserta);
        return $q->num_rows();
    }
    
    function update_plan_status($id,$var) {
        $this->db->where('id',$id);
        $dat=array(
            'plan_status'=>$var
        );
        return $this->db->update($this->table,$dat);
    }
    
    
    
       function update_do_status($id,$var) {
        $this->db->where('id',$id);
        $dat=array(
            'do_status'=>$var
        );
        return $this->db->update($this->table,$dat);
    }
    
           function update_action_status($id,$var) {
        $this->db->where('id',$id);
            $dat=array(
            'action_status'=>$var
        );
        return $this->db->update($this->table,$dat);
    }
    
    function count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai) {
    if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
        $this->db->order_by('tgl_mulai','desc');
      
     $q=  $this->db->get($this->table);
     return $q->num_rows();
    }
    
    function count_all_view_canceled($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai) {
    if (!empty($kd_pelatihan)){
            $this->db->where('kd_pelatihan',$kd_pelatihan);
        }
        
        if(!empty($no_tiket)){
            $this->db->like('kd_tiket',$no_tiket);
        }
        
        if(!empty($batch)){
            $this->db->where('batch',$batch);
        }
        
        if (!empty($tgl_awal) && !empty($tgl_selesai)) {
            $this->db->where('tgl_mulai BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_selesai)).'"');
        }
        $this->db->order_by('tgl_mulai','desc');
      
     $q=  $this->db->get($this->table_pelatihan_batal);
     return $q->num_rows();
    }
    
        function count_all_view_bulan() {        
$this->db->where('tgl_mulai BETWEEN "'. date('Y-m-01'). '" and "'. date('Y-m-t').'"');
$this->db->order_by('tgl_mulai','desc');
      
     $q=  $this->db->get($this->table);
     return $q->num_rows();
    }
    
    function get_by_id($id) {
    $this->db->where('id',$id);
    return $this->db->get($this->table);
    }
    

    
        function lookup_pelatihan($keyword) {
        $this->db->like('judul', $keyword, 'after');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
         function lookup_cs($keyword) {
        $this->db->like('nama', $keyword, 'after');
        $query = $this->db->get($this->table_observer);
        return $query->result_array();
    }
    
    function update_biaya_observer($id,$dat) {
        $this->db->where('id_fgt_induction',$id);
        return $this->db->update($this->table_biaya_observer,$dat);
    }
    
       function update_biaya_provider($id,$dat) {
        $this->db->where('id_fgt_induction',$id);
        return $this->db->update($this->table_biaya_provider,$dat);
    }
    
    function add_biaya_observer($obs) {
        return $this->db->insert($this->table_biaya_observer,$obs);
    }
    
       function add_biaya_provider($obs) {
        return $this->db->insert($this->table_biaya_provider,$obs);
    }
    
    function get_last_record() {
        return $this->db->select('id')->order_by('id','desc')->limit(1)->get($this->table)->row('id');
    }
    
        function get_provider_by_pelatihan($id) {
        $this->db->where('id_fgt_induction',$id);
        $q=  $this->db->get($this->table_biaya_provider);
        return $q->num_rows();
    }
    
           function get_pengajar_by_pelatihan($id) {
        $this->db->where('id_fgt_induction',$id);
        $q=  $this->db->get($this->table_biaya_pengajar);
        return $q->num_rows();
    }
    
    function get_biaya_observer($id) {
        $this->db->where('id_fgt_induction',$id);
        return $this->db->get($this->table_biaya_observer);
    }
    
       function get_biaya_pengajar($id) {
        $this->db->where('id_fgt_induction',$id);
        return $this->db->get($this->table_biaya_pengajar);
    }
    
        function get_biaya_provider($id) {
        $this->db->where('id_fgt_induction',$id);
        return $this->db->get($this->table_biaya_provider);
    }
    
    
    function delete($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
    
    function delete_pengajar($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_biaya_pengajar);
    }
    
    function delete_observer($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_biaya_observer);
    }
    
    function count_sarfas($id) {
        $this->db->where('id_fgt_induction',$id);
        return $this->db->get($this->table_sarfas)->num_rows();
    }
    
    function add_sarfas($dat) {
        return $this->db->insert($this->table_sarfas,$dat);
    }
   
    function add_support($dat) {
        return $this->db->insert($this->table_support,$dat);
    }
    
    function get_support() {
        return $this->db->get($this->table_support);
    }
    
    function get_support_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table_support);
    }
    
    function update_support($id,$dat) {
        $this->db->where('id',$id);
        return $this->db->update($this->table_support,$dat);
    }
    
    function get_sarfas_by_pelatihan($id) {
        $this->db->where('id_fgt_induction',$id);
        return $this->db->get($this->table_sarfas);
    }
    
    function update_sarfas_pelatihan($id,$st) {
        $this->db->where('id_fgt_induction',$id);
        $arr=array(
            'status'=>$st
        );
        return $this->db->update($this->table_sarfas_pelatihan,$arr);
    }
    
    function get_pic() {
        $this->db->where('fungsi',4);
        return $this->db->get($this->table_user);
    }
    
}

