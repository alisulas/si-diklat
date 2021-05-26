<?php

/**
 * Description of course
 *
 * @author Administrator
 */
class Mdl_course extends CI_Model {

    private $table = 'course';
    private $table_kursil = 'kursil';
    private $table_provider = 'provider';
    private $table_activity = 'activity';
    private $table_function = 'function';
    private $table_trainer = 'trainer';
    private $table_peserta = 'peserta';
    private $table_jadwal = 'jadwal';
    private $table_memo = 'memo';
    private $table_chk_pnd = 'chk_pnd';
    private $table_chk_gft = 'chk_gft';
    private $table_chk_gsfa = 'chk_gsfa';

    /**
     * CRUD Course
     */
    function get_index($limit = 10, $offset = 0, $month,$year, $course_name,$location) {
        if (empty($month) && empty($year) && empty($course_name)&& empty($location)) {
            $month = 0;
            $year = 0;
            $course_name = 0;
            $location = 0;
        }

        if (!$course_name == 0) {
            $this->db->like('course_name', $course_name);
        }
        
        if (!$location == 0) {
            $this->db->like('location', $location,'both');
        }
        /*
        if (!$month == 0) {
            $this->db->where('MONTH(`start_date`)', $month);
            $this->db->where('YEAR(`start_date`)',$year);
            $this->db->or_where('MONTH(`end_date`)', $month);
            $this->db->or_where('YEAR(`end_date`)',$year);
        }
        
         * 
         */
        if (!$month == 0) {
            $this->db->like('start_date', $year.'-'.$month,'after');
            $this->db->like('end_date', $year.'-'.$month,'after');
        }
        
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->table, $limit, $offset);
    }
    
    function get_course($list='',$name='',$limit = 10, $offset = 0) {
                if (empty($name)){
            $name='';
        }
        if ($list=='kode') {
        $this->db->like('code',$name);            
        }elseif ($list=='name') {
        $this->db->like('course_name',$name);            
        }  
        $this->db->order_by('start_date', 'desc');
        return $this->db->get($this->table, $limit, $offset);
    }

    function get_exel($month, $course_name) {
        if (empty($month) && empty($course_name)) {
            $month = 0;
            $course_name = 0;
        }

        if (!$course_name == 0) {
            $this->db->like('course_name', $course_name);
        }
        if (!$month == 0) {
            $this->db->where('MONTH(`start_date`)', $month);
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->table);
    }

    function get_function() {
        return $this->db->get($this->table_function);
    }

    function get_function_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table_function);
    }

    // Counting Pagination
    function count_all() {
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }

    // Add new course
    function add_course($var) {
        $this->db->insert($this->table, $var);
        return $this->db->insert_id();
    }

    // Add new jadwal
    function add_jadwal($var) {
        $this->db->insert($this->table_jadwal, $var);
        return $this->db->insert_id();
    }

    // Delete course
    function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Get course by id
    function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    // Get course by id
    function get_provider_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table_provider);
    }

    // Update course
    function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function get_kursil_by_course($id) {
        $this->db->where('plc_course_id', $id);
        return $this->db->get($this->table_kursil);
    }

    function get_activity_by_course($id) {
        $this->db->where('plc_course_id', $id);
        return $this->db->get($this->table_activity);
    }

    function get_kursil_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table_kursil);
    }

    function get_peserta_by_course($id) {
        $this->db->where('plc_course_id', $id);
        return $this->db->get($this->table_peserta);
    }

    // Add new course syllabus
    function add_kursil($var) {
        $this->db->insert($this->table_kursil, $var);
        return $this->db->insert_id();
    }

    // Update course syllabus
    function update_kursil($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table_kursil, $data);
    }

    // Delete course syllabus
    function delete_kursil($id) {
        $this->db->where('plc_course_id', $id);
        return $this->db->delete($this->table_kursil);
    }

    function tmpl($id) {
        $this->db->where('id', $id);
        return $this->db->get('template');
    }

    function lookup_trainer($keyword) {
        $this->db->like('name', $keyword, 'after');
        $query = $this->db->get($this->table_trainer);
        return $query->result_array();
    }

    function lookup_course($keyword) {
        $this->db->like('course_name', $keyword, 'after');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    function add_dataexcel($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'plc_function_id'=> $dataarray[$i]['plc_function_id'],
                'code' => $dataarray[$i]['code'],
                'course_name' => $dataarray[$i]['course_name'],
                'objective' => $dataarray[$i]['objective'],
                'material' => $dataarray[$i]['material'],
                'requirement' => $dataarray[$i]['requirement'],
                'duration' => $dataarray[$i]['duration'],
                'start_date' => join('-', array_reverse(explode('/', $dataarray[$i]['start_date']))),
                'end_date' => join('-', array_reverse(explode('/', $dataarray[$i]['end_date']))),
                'location' => $dataarray[$i]['location'],
                'sifat' => $dataarray[$i]['sifat'],
                'insert_date' =>  date('Y-m-d G:i:s')
            );
            $this->db->insert($this->table, $data);
        }
    }
    
    function get_course_by_class($id_class) {
        $this->db->where('location',$id_class);
        return $this->db->get($this->table);
    }
    
        function add_memo($var)
    {
	$this->db->insert($this->table_memo,$var);
	return $this->db->insert_id();
    }
    
    function get_memo_by_course($id,$status) {
        $this->db->where('course_id',$id);
        $this->db->where('memo_sarfas_status',$status);
        return $this->db->get($this->table_memo);
    }
    
    function get_status_pnd() {
        $this->db->where('status_pnd','on');
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }
    
    function get_status_pnd_on($limit=10,$offset=0) {
        $this->db->where('status_pnd','on');
        $this->db->order_by('YEAR(`insert_date`)','desc');
      return $this->db->get($this->table, $limit, $offset);
    }
    
    function get_status_gft() {
        $this->db->where('status_gft','on');
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }
    
    function get_status_gft_on($limit=10,$offset=0) {
        $this->db->where('status_gft','on');
        $this->db->order_by('YEAR(`insert_date`)','desc');
      return $this->db->get($this->table, $limit, $offset);
    }
    
    function get_status_gsfa() {
        $this->db->where('status_gsfa','on');
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }
    
    function get_status_gsfa_on($limit=10,$offset=0) {
        $this->db->where('status_gsfa','on');
        $this->db->order_by('YEAR(`insert_date`)','desc');
      return $this->db->get($this->table, $limit, $offset);
    }
    
    function get_chk_pnd($course_id) {
        $this->db->where('course_id',$course_id);
        return $this->db->get($this->table_chk_pnd);
    }
    function get_chk_gft($course_id) {
        $this->db->where('course_id',$course_id);
        return $this->db->get($this->table_chk_gft);
    }
    function get_chk_gsfa($course_id) {
        $this->db->where('course_id',$course_id);
        return $this->db->get($this->table_chk_gsfa);
    }
    
    function add_chk_pnd($data, $id) {
        $this->db->where('course_id', $id);
        return $this->db->update($this->table_chk_pnd, $data);
    }
    
    function add_chk_gft($data, $id) {
        $this->db->where('course_id', $id);
        return $this->db->update($this->table_chk_gft, $data);
    }
    
    function add_chk_gsfa($data, $id) {
        $this->db->where('course_id', $id);
        return $this->db->update($this->table_chk_gsfa, $data);
    }
    
    
    function create_chk_pnd($id) {
        return $this->db->insert($this->table_chk_pnd, array('course_id'=>$id));
    }
    function create_chk_gft($id) {
        return $this->db->insert($this->table_chk_gft, array('course_id'=>$id));
    }
    function create_chk_gsfa($id) {
        return $this->db->insert($this->table_chk_gsfa, array('course_id'=>$id));
    }
    
    
    function get_last_course()
    {
        $this->db->order_by('id','desc');
       
        return $this->db->get($this->table);
    }

}

/* End of file course.php */
/* Location: ./application/models/course.php */
