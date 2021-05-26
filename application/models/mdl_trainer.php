<?php
/**
 * Description of model trainer
 *
 * @author Administrator
 */
class Mdl_trainer extends CI_Model{
    private $table='trainer';
    private $table_observasi='observasi';

    /**
     * CRUD Course
     */
    function get_index($list,$trainer_name,$limit=10,$offset=0)
    {
        if (empty($trainer_name)){
            $trainer_name='';
        }
        if ($list=='no') {
        $this->db->like('no',$trainer_name);            
        }elseif ($list=='name') {
        $this->db->like('name',$trainer_name);    
        }elseif ($list=='core_competence') {
        $this->db->like('core_competence',$trainer_name);    
        }
       

        return $this->db->get($this->table,$limit,$offset);
    }
    
    function get_observasi($limit=10,$offset=0)
    {
        return $this->db->get($this->table_observasi,$limit,$offset);
    }
    
    
     function get_excel($trainer_name)
    {
        if (empty($trainer_name)){
            $trainer_name='';
        }
        $this->db->like('name',$trainer_name);
        return $this->db->get($this->table);
    }
    // Counting Pagination
    function count_all()
    {
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }
    // Counting Pagination
    function observasi_count_all()
    {
	$q=$this->db->get($this->table_observasi);
        return $q->num_rows();
    }

    // Add new course
    function add($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }
    // Add Observasi
    function add_observasi($var)
    {
	$this->db->insert($this->table_observasi,$var);
	return $this->db->insert_id();
    }

    // Delete course
    function delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
    // Delete Observasi
    function delete_observasi($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_observasi);
    }

    // Get course by id
    function get_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
 
    function get_observasi_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table_observasi);
    }

    // Get all
    function get_all()
    {
        return $this->db->get($this->table);
    }

    // Update course
    function update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }

    // Update Observasi
    function update_observasi($data,$id)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table_observasi,$data);
    }
    
            function add_dataexcel($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'no'=> $dataarray[$i]['no'],
                'name' => $dataarray[$i]['name'],
                'gender' => $dataarray[$i]['gender'],
                'education' => $dataarray[$i]['education'],
                'certification' => $dataarray[$i]['certification'],
                'job_experience' => $dataarray[$i]['job_experience'],
                'address' => $dataarray[$i]['address'],
                'phone' => $dataarray[$i]['phone'],
                'fax' => $dataarray[$i]['fax'],
                'email' => $dataarray[$i]['email'],
                'website' => $dataarray[$i]['website'],
                'npwp_no' => $dataarray[$i]['npwp_no'],
                'birth_location' => $dataarray[$i]['birth_location'],
                'birth_date' => join('-', array_reverse(explode('/', $dataarray[$i]['birth_date']))),
                'profession' => $dataarray[$i]['profession'],
                'association' => $dataarray[$i]['association'],
                'core_competence' => $dataarray[$i]['core_competence']
                
            );
            $this->db->insert($this->table, $data);
        }
    }
    
    function lookup_pengajar($keyword) {
        $this->db->like('name', $keyword, 'after');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}

/* End of file mdl_trainer.php */
/* Location: ./application/models/mdl_trainer.php */