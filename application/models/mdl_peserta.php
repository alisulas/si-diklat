<?php

/**
 * Description of model peserta
 *
 * @author Administrator
 */

class Mdl_peserta extends CI_Model{
    private $table='peserta';
    private $table_function='function';
    private $table_program='program';

    /**
     * CRUD Activity
     */
    
    function get_index($id_course)
    {
       
        $this->db->where('id_trans_pelatihan',$id_course);
         $this->db->order_by('nama_pekerja','asc');
        return $this->db->get($this->table);
    }
    
    function get_peserta_by_id($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
    
    function get_peserta($id) {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
    
    function get_by_nopek($nopek) {
        $this->db->where('nopek',$nopek);
        return $this->db->get($this->table);
    }
    
    function get_absensi_peserta($id) {
        $this->db->where('id_trans_pelatihan',$id);
        $this->db->where('konfirmasi',1);
        return $this->db->get($this->table);
    }
    
    function update($id,$val) {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$val);
    }
    // Counting Pagination
    function count_all($id_course)
    {
         $this->db->where('id_trans_pelatihan',$id_course);
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }
    
        function cek_kehadiran($id_course,$konfirm)
    {
        $this->db->where('id_trans_pelatihan',$id_course);
        $this->db->where('hadir',$konfirm);
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }
    
    function cek_konfirmasi($id_course,$konfirm) {
        $this->db->where('id_trans_pelatihan',$id_course);
        $this->db->where('konfirmasi',$konfirm);
        $a=  $this->db->get($this->table);
        return $a->num_rows();
    }

    function count_all_hadir($id_course)
    {
         $this->db->where('id_trans_pelatihan',$id_course);
         $this->db->where('hadir',1);
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }
    
        function count_all_konfirmasi($id_course)
    {
         $this->db->where('id_trans_pelatihan',$id_course);
         $this->db->where('konfirmasi',1);
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }

    function add($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }
    // Delete activity
    function delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }

    // Get activity by id
    function get_by_id($id)
    {
        $this->db->where('plc_course_id',$id);
        return $this->db->get($this->table);
    }
    function get_by_id_course($id_course)
    {
        $this->db->where('plc_course_id',$id_course);
        return $this->db->get($this->table);
    }

    function update_one($id,$val)
    {
	$this->db->where('id',$id);
	$data=array('kehadiran'=>$val);
	return $this->db->update($this->table,$data);
    }

    function update_tgl($id)
    {
	$this->db->where('id',$id);
	$data=array('update_date'=>date('Y-m-d G:i:s'),
            'user'=>  $this->session->userdata('user_name'));
	return $this->db->update($this->table,$data);
    }
  
    
    function update_konfirmasi($id,$val) {
        $this->db->where('id',$id);
        $data=array('konfirmasi'=>$val);
        return $this->db->update($this->table,$data);
    }
    
    function update_hadir($id,$val) {
        $this->db->where('id',$id);
        $data=array('hadir'=>$val);
        return $this->db->update($this->table,$data);
    }
    
    function add_excel_pekerja($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'id_trans_pelatihan'=> $dataarray[$i]['id_trans_pelatihan'],
                'nopek'=> $dataarray[$i]['nopek'],
                'nama_pekerja' => $dataarray[$i]['nama_pekerja'],
                'tgl_lahir' => join('-', array_reverse(explode('/', $dataarray[$i]['tgl_lahir']))),
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
                'insert_date' =>  date('Y-m-d G:i:s'),
                'user'=> $this->session->userdata('user_name')
            );
            $this->db->insert($this->table, $data);
        }
    }
    
    function cek_blacklist($nopek) {
        $this->db->where('nopek',$nopek);
        $this->db->where('konfirmasi',NULL);
        $this->db->where('hadir',0);
        $a=  $this->db->get($this->table);
        return $a->num_rows();
    }


}

/* End of file mdl_peserta.php */
/* Location: ./application/models/mdl_peserta.php */
