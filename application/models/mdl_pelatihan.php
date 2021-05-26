<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mdl_pelatihan extends CI_Model{
    private $table='pelatihan';
    
    function get_index($list='',$pencarian='',$limit,$offset=0) {
        if(empty($pencarian)){
            $pencarian='';
        }
        if ($list=='kode'){
            $this->db->like('kd_pelatihan',$pencarian);
        }elseif ($list=='judul') {
            $this->db->like('judul',$pencarian);
        }
        return $this->db->get($this->table,$limit,$offset);
    }
    function add($dat) {
        return $this->db->insert($this->table,$dat);
    }
    
    function count_all($list='',$pencarian='') {
         if(empty($pencarian)){
            $pencarian='';
        }
        if ($list=='kode'){
            $this->db->like('kd_pelatihan',$pencarian);
        }elseif ($list=='judul') {
            $this->db->like('judul',$pencarian);
        }
     $q=  $this->db->get($this->table);
     return $q->num_rows();
    }
    
    function get_by_id($id) {
    $this->db->where('id',$id);
    return $this->db->get($this->table);
    }
    
    function update($id,$var) {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$var);
    }
    
        function lookup_pelatihan($keyword) {
        $this->db->like('judul', $keyword, 'after');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    function delete($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
    
    
    function add_excel_pelatihan($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'kd_pelatihan'=> $dataarray[$i]['kd_pelatihan'],
                'judul' => $dataarray[$i]['judul'],
                'ket' => $dataarray[$i]['ket'],
                'insert_date' =>  date('Y-m-d G:i:s')
            );
            $this->db->insert($this->table, $data);
        }
    }
}

