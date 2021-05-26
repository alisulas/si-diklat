<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    

    function __construct() {
	parent::__construct();
	$this->load->model('mdl_dashboard');
        $this->load->model('mdl_fgt_pelatihan');
        $this->load->model('mdl_pelatihan');
	$this->load->model('mdl_course');
    }

       function index($offset=0,$dat=0){
        $this->get_index($offset,$dat);
    }

    protected function get_index($offset,$dat)
    {
	//$data['title']='Progress Pelatihan Bulan '. $this->conv_bulan(date("M"));
       
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
       
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
        if ($dat==1) {
        $data['title']='Data Pelatihan';
        $config['total_rows']=$this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $q=$this->mdl_fgt_pelatihan->get_index_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai)->result_array();
        }  else {
        $data['title']='Data Pelatihan Bulan '. $this->editor->conv_bulan(date("m"));
        $config['total_rows']=$this->mdl_fgt_pelatihan->count_all_view_bulan();
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view_bulan();
        $q=$this->mdl_fgt_pelatihan->get_index_view_bulan()->result_array();            
        }
        
	/* Pagination */
	$config['base_url']=site_url('dashboard/index/');
	        $data['refresh']=anchor('dashboard', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info')); 

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'Judul Pelatihan',
                    'Batch',
		    'Mulai',
                    'Selesai',
                'Kota',
                'Tempat'
		);
        /*
        	$this->table->add_row(
		    array('data'=>'','colspan'=>3),                    
		    'Mulai',
                    'Akhir',
                    'Kota',
                    'Tempat'
		);
                
         * 
         */
	
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;

           $this->table->add_row(
		    ++$i,
                    $judul,
                    $row['batch'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat']
		    );
	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
	$data['content']=$this->table->generate();
        $data['action']='dashboard/index/0/1';
        
        $this->template->display('dashboard/index',$data);
    }
    
        function lookup_pelatihan() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_pelatihan->lookup_pelatihan($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id' => $row['id'],
                    'value' => $row['judul']
                );  //Add a row to array
            }
            echo json_encode($data); //echo json string if ajax request
        } else {
            $datax['response'] = 'true';
            $data['message'] = array();
            $datax['message'][] = array(
                'id' => 0,
                'value' => 'Tidak ditemukan'
            );
            echo json_encode($datax);
        }
    }
    
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */