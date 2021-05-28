<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdl_pekerja
 *
 * @author admin
 */
class mdl_pekerja extends CI_Model{
    //put your code here
    private $table='pekerja';
    private $table_manager='manager';
    
    function count_all() {
        $a=  $this->db->get($this->table);
        return $a->num_rows();        
    }

    function count_manager() {
        $a=  $this->db->get($this->table);
        return $a->num_rows();        
    }
    
    function get_index($list,$search_name,$limit,$offset) {
        
        if (empty($search_name)){
            $search_name='';
        }
        
        if ($list=='nopek') {
        $this->db->like('nopek',$search_name);            
        }elseif ($list=='nama') {
        $this->db->like('nama',$search_name);            
        }
        
        $this->db->order_by('nama','asc');
        return $this->db->get($this->table,$limit,$offset);
    }
    
    function get_index_manager($limit,$offset) {
        $this->db->order_by('name','asc');
        return $this->db->get($this->table_manager,$limit,$offset);
    }
    
    function get_pekerja_by_id($id) {
    $this->db->where('id',$id);
    return $this->db->get($this->table);
    }
    
    function get_manager_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table_manager);
    }
    
    function delete($id) {
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }

    function delete_manager($id) {
        $this->db->where('id',$id);
        $this->db->delete($this->table_manager);
    }
    
    function edit($id,$pekerja) {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$pekerja);
    }
    function edit_manager($id,$manager) {
        $this->db->where('id',$id);
        return $this->db->update($this->table_manager,$manager);
    }
    
function add_excel_pekerja($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'nopek'=> $dataarray[$i]['nopek'],
                'nama' => $dataarray[$i]['nama'],
                'tgl_lahir' => join('-', array_reverse(explode('/', $dataarray[$i]['tgl_lahir']))),
                'id_position' => $dataarray[$i]['id_position'],
                'position' => $dataarray[$i]['position'],
                'cost_center_code' => $dataarray[$i]['cost_center_code'],
                'cost_center_name' => $dataarray[$i]['cost_center_name'],
                'company_code' => $dataarray[$i]['company_code'],
                'personnel_area' => $dataarray[$i]['personnel_area'],
                'personnel_sub_area' => $dataarray[$i]['personnel_sub_area'],
                'employee_group' => $dataarray[$i]['employee_group'],
                'employee_sub_group' => $dataarray[$i]['employee_sub_group'],
                'layering' => $dataarray[$i]['layering'],
                'direktorat' => $dataarray[$i]['direktorat'],
                'fungsi' => $dataarray[$i]['fungsi'],
                'divisi' => $dataarray[$i]['divisi'],
                'departemen' => $dataarray[$i]['departemen'],
                'insert_date' =>  date('Y-m-d G:i:s')
            );
            $this->db->insert($this->table, $data);
        }
    }
    
    function tambah_manager($dat) {
        $this->db->insert($this->table_manager,$dat);
    }

    function add_excel_manager($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'name'=> $dataarray[$i]['name'],
                'insert_date' =>  date('Y-m-d G:i:s')
            );
            $this->db->insert($this->table_manager, $data);
        }
    }

    function lookup_pekerja($keyword) {
        $this->db->like('nopek', $keyword, 'after');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    function get_by_nopek($nopek) {
        $this->db->where('nopek',$nopek);
        return $this->db->get($this->table);
    }
    
    
    
}