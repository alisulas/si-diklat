<?php
class Agenda extends CI_Controller {
    private $limit=100;


    function __construct() {
        parent::__construct();
        
        $this->load->model('mdl_sarfas');
        
        $this->load->model('mdl_pelatihan');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');              
    }
    
function index($offset=0)
    {
	$this->get_index($offset);
    }

    /*
     * Get index table
     */
    protected function get_index($offset)
    {
	$data['title']='';
	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');

        
/* Pilihan Kelas */
	$q=$this->mdl_sarfas->get_index_agenda($this->limit,$offset)->result_array();
        
//	$i=0+$offset;  
         $data['list']=''; 
         $data['location']=''; 
	foreach ($q as $row)
	{  
           if (is_numeric($row['class'])){
//             $location=  anchor('#tambah_lokasi'.$row['id'], 'Pilih', array('class'=>'label label-info','data-toggle'=>'modal'));  
               $location=  $this->mdl_sarfas->get_class_by_id($row['class'])->row()->class_name;
               }else{
               $location= $row['class'];
           }

            $data['list'].='<li><span class="judul">'.$row['activity'].'</span><br><br><span class="tanggal">( '.$this->editor->date_correct($row['start_date']).' - '.$this->editor->date_correct($row['end_date']).' )</span><br><span class="tempat">'.$location.'</span>';
            
	}
        
       // $this->table->set_template(array('table_open'=>'<table class="table table-bordered table-condensed table-striped">'));
	// $data['course']=$this->table->generate();
       
        $this->load->view('sarfas/agenda',$data);
        
    }            
    
}
