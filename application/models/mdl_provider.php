<?php
/**
 * Description of model provider
 *
 * @author Administrator
 */
class Mdl_provider extends CI_Model{
    private $table='provider';

    /**
     * CRUD Course
     */
    function get_index($list='',$provider_name='',$limit=10,$offset=0)
    {
        if (empty($provider_name)){
            $provider_name='';
        }
        if ($list=='no') {
        $this->db->like('no',$provider_name);            
        }elseif ($list=='name') {
        $this->db->like('name',$provider_name);            
        }elseif ($list=='learning_competence') {
        $this->db->like('learning_competence',$provider_name);            
        }        
        return $this->db->get($this->table,$limit,$offset);
    }
    
    function get_provider() {
        return $this->db->get($this->table);
    }
    function get_excel($provider_name)
    {
        if (empty($provider_name)){
            $provider_name='';
        }
        $this->db->like('name',$provider_name);
        return $this->db->get($this->table);
    }
    // Counting Pagination
    function count_all()
    {
	$q=$this->db->get($this->table);
        return $q->num_rows();
    }

    // Add provider
    function add($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }

    // Delete course
    function delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }

    // Get course by id
    function get_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }

    // Update course
    function update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }
    
    
        function add_dataexcel($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'no'=> $dataarray[$i]['no'],
                'name' => $dataarray[$i]['name'],
                'address' => $dataarray[$i]['address'],
                'phone' => $dataarray[$i]['phone'],
                'fax' => $dataarray[$i]['fax'],
                'email' => $dataarray[$i]['email'],
                'website' => $dataarray[$i]['website'],
                'npwp_no' => $dataarray[$i]['npwp_no'],
                'akte_no' => $dataarray[$i]['akte_no'],
                'akte_date' => join('-', array_reverse(explode('/', $dataarray[$i]['akte_date']))),
                'siup_no' => $dataarray[$i]['siup_no'],
                'siup_date' =>join('-', array_reverse(explode('/', $dataarray[$i]['siup_date']))),
                'pkp_no' => $dataarray[$i]['pkp_no'],
                'pkp_date' => join('-', array_reverse(explode('/', $dataarray[$i]['pkp_date']))),
                'association' => $dataarray[$i]['association'],
                'learning_competence' => $dataarray[$i]['learning_competence']
                
            );
            $this->db->insert($this->table, $data);
        }
    }
    
        function lookup_provider($keyword) {
        $this->db->like('name', $keyword, 'after');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    

}

/* End of file mdl_provider.php */
/* Location: ./application/models/mdl_provider.php */
