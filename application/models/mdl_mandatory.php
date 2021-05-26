<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdl_mandatory
 *
 * @author dhecode
 */
class mdl_mandatory extends CI_Model{
    //put your code here
    private $table='mandatory';
    
    
    function add($var) {
      	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }
    
    function count_all() {
        $ade=  $this->db->get($this->table);
        return $ade->num_rows();
    }
    
    function get_index($limit=0,$offset,$tahun,$direktorat,$bln) {
                if (!empty($tahun)) {
            $this->db->where('YEAR(`wkt_buka`)', $tahun);
        }
        
                if (!empty($bln)) {
            $this->db->where('MONTH(`wkt_buka`)', $bln);
        }
        
        if (!empty($direktorat)) {
            $this->db->where('direktorat',$direktorat);
        }
        
        return $this->db->get($this->table,$limit,$offset);
    }

    function get_excel($tahun,$direktorat,$bln) {
                if (!empty($tahun)) {
            $this->db->where('YEAR(`wkt_buka`)', $tahun);
        }
        
                if (!empty($bln)) {
            $this->db->where('MONTH(`wkt_buka`)', $bln);
        }
        
        if (!empty($direktorat)) {
            $this->db->where('direktorat',$direktorat);
        }
        
        return $this->db->get($this->table);
    }
    
    
    function get_count_index($tahun,$direktorat,$bln) {
                if (!empty($tahun)) {
            $this->db->where('YEAR(`wkt_buka`)', $tahun);
        }
        
                if (!empty($bln)) {
            $this->db->where('MONTH(`wkt_buka`)', $bln);
        }
        
        if (!empty($direktorat)) {
            $this->db->where('direktorat',$direktorat);
        }
        $ad=$this->db->get($this->table);
        return $ad->num_rows();
    }
    
    function get_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
    
    function update($id,$var) {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$var);
    }
    
    function delete($id) {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
    
        function add_dataexcel($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'nama_pelatihan'=> $dataarray[$i]['nama_pelatihan'],
                'angkatan' => $dataarray[$i]['angkatan'],
                'tempat' => $dataarray[$i]['tempat'],
                'wkt_buka' => join('-', array_reverse(explode('/', $dataarray[$i]['wkt_buka']))),
                'wkt_tutup' => join('-', array_reverse(explode('/', $dataarray[$i]['wkt_tutup']))),
                'durasi' => $dataarray[$i]['durasi'],
                'rnr' => $dataarray[$i]['rnr'],
                'ihp' => $dataarray[$i]['ihp'],
                'penyelenggara' => $dataarray[$i]['penyelenggara'],
                'nama' => $dataarray[$i]['nama'],
                'nopek' => $dataarray[$i]['nopek'],
                'fungsi' => $dataarray[$i]['fungsi'],
                'direktorat' => $dataarray[$i]['direktorat'],
                'sertifikat' => $dataarray[$i]['sertifikat'],
                'insert_date' =>  date('Y-m-d G:i:s'),
                'update_date' =>  date('Y-m-d G:i:s')
            );
            $this->db->insert($this->table, $data);
        }
    }
    
}

?>
