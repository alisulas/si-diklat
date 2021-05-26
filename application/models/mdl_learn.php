<?php
/**
 * Description of course
 *
 * @author Administrator
 */
class Mdl_learn extends CI_Model{
    private $table='learn';
    private $table_tb='tugas_belajar';
    private $table_payment='payment';


    /**
     * CRUD Course
     */
    function get_index($limit=10,$offset=0,$alert,$name)
    {
                    $this->db->order_by('id', 'desc');
        if (empty($alert) && empty($name)){
            $alert=='all';
            $name=0;
        }
 //         if(!$name==0){
   //         $this->db->like('name',$name);
     //   }
               if($alert=='all'){    
        }elseif ($alert=='nama') {
            $this->db->like('name',$name);
        }elseif ($alert=='nopek') {
            $this->db->like('nopek',$name);
        }elseif ($alert=='institusi') {
            $this->db->like('institutions',$name);
        }elseif ($alert=='direktorat') {
            $this->db->like('directorate',$name);
        }else{
            if ($alert==0) {
                $this->db->where('`alert` = 0',NULL,FALSE );
            }
            elseif($alert>60)
	    {
            $this->db->where('`alert` > 60',NULL,FALSE );
	    } elseif($alert<=60 && $alert>=31) {
	$this->db->where('`alert` <= 60',NULL,FALSE );
	$this->db->where('`alert` >= 31',NULL,FALSE );
	    }
            elseif($alert>0 && $alert<31) {
		$this->db->where('`alert` > 0',NULL,FALSE );
		$this->db->where('`alert` < 31',NULL,FALSE );
	    }elseif($alert<0){
$this->db->where('`alert`<0',NULL,FALSE );
            }

            }


        return $this->db->get($this->table,$limit,$offset);
    }

    function get_tb($limit=10,$offset=0) {
        return $this->db->get($this->table_tb,$limit,$offset);
    }

    function get_excel_data_peserta() {
        $this->db->order_by('name', 'asc');
       return $this->db->get($this->table);
    }

    // Counting Pagination
    function count_all($alert,$name)
  {
        if (empty($alert) && empty($name)){
            $alert=='all';
            $name=0;
        }
 //         if(!$name==0){
   //         $this->db->like('name',$name);
     //   }
               if($alert=='all'){

        }elseif ($alert=='nama') {
            $this->db->like('name',$name);
        }elseif ($alert=='nopek') {
            $this->db->like('nopek',$name);
        }elseif ($alert=='institusi') {
            $this->db->like('institutions',$name);
        }elseif ($alert=='direktorat') {
            $this->db->like('directorate',$name);
        }else{
                        if ($alert=='0') {
                $this->db->where('`alert` = 0',NULL,FALSE );
            }elseif($alert>60)
	    {
            $this->db->where('`alert` > 60',NULL,FALSE );
	    } elseif($alert<=60 && $alert>=31) {
	$this->db->where('`alert` <= 60',NULL,FALSE );
	$this->db->where('`alert` >= 31',NULL,FALSE );
	    }
            elseif($alert>0 && $alert<31) {
		$this->db->where('`alert` > 0',NULL,FALSE );
		$this->db->where('`alert` < 31',NULL,FALSE );
	    }elseif($alert<0){
$this->db->where('`alert`<0',NULL,FALSE );
            }

            }

            $this->db->order_by('id', 'desc');
        return $this->db->get($this->table)->num_rows();
    }

    function count_tb() {
              $this->db->order_by('id', 'desc');
        return $this->db->get($this->table_tb)->num_rows();

    }

    // Add new Certificate
    function add($var)
    {
	$this->db->insert($this->table,$var);
	return $this->db->insert_id();
    }

    function add_tb($var) {
        $this->db->insert($this->table_tb,$var);
        return $this->db->insert_id();
    }

    function add_payment($var)
    {
	$this->db->insert($this->table_payment,$var);
	return $this->db->insert_id();
    }

    // Delete Certificate
    function delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }

    function delete_payment($id){
        $this->db->where('id',$id);
        return $this->db->delete($this->table_payment);
    }

    // Get Certificate by id
    function get_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }

    function get_by_learn_id($id)
    {
         $this->db->where('plc_learn_id',$id);
        $this->db->order_by('payment_date','asc');

        return $this->db->get($this->table_payment);
    }
    // Update Certificate
    function update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }

    function update_alert($id,$expired){
        $this->db->where('id',$id);
         return $this->db->update($this->table,array(
            'alert'=>$expired
        ));
    }


    function update_payment($id,$var){
        $this->db->where('id',$id);
        return $this->db->update($this->table_payment,$var);
    }

    function get_near_date($id){
        $this->db->where(array('plc_learn_id'=>$id,'status'=>0));
        $this->db->order_by('payment_date','asc');
        $this->db->limit(1);
        return $this->db->get($this->table_payment);
    }

    function get_payment_count($id) {
        $this->db->where('plc_learn_id',$id);
        return $this->db->get($this->table_payment)->num_rows();
    }


        function get_exel($month,$year)
    {
         if (empty($month)){
            $month=0;
        }

         if (empty($year)){
            $year=0;
        }

        if(!$month==0){
        $this->db->where('MONTH(`payment_date`)', $month);
        }
        if(!$year==0){
        $this->db->where('YEAR(`payment_date`)', $year);
        }
        $this->db->order_by('plc_learn_id', 'asc');
        return $this->db->get($this->table_payment);
    }

        function get_pembayaran_by_id($id)
    {
        $this->db->where('plc_learn_id',$id);
        return $this->db->get($this->table_payment);
    }

}

/* End of file certificate.php */
/* Location: ./application/models/mdl_certificate.php */
