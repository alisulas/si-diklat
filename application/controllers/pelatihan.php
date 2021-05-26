<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pelatihan
 *
 * @author adehermawan
 */
class pelatihan extends Member_Controller{
    //put your code here
    private $limit=10;
    public function __construct() {
        parent::__construct();
        
        $this->load->model('mdl_pelatihan');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
        $this->load->library('Datatables');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');        
    }
    
    function index($offset=0) {
       $data['title']='Data Pelatihan';
       $data['tambah']=  anchor('pelatihan/add', '<i class="icon-plus-sign icon-white"></i>&nbsp;Tambah', array('class'=>'btn btn-primary'));
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        $list=  $this->input->post('list');
        $pencarian=  $this->input->post('pencarian');
        
	/* Pagination */
	$config['base_url']=site_url('pelatihan/index/');
	$config['total_rows']=$this->mdl_pelatihan->count_all($list,$pencarian);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		array('data'=>'No','width'=>10),
                array('data'=>'Kode','width'=>15),
                'Judul',
		array('data'=>'Kursil','width'=>20),
                'Ket',
                array('data'=>'Action','colspan'=>2)
		);
	$q=$this->mdl_pelatihan->get_index($list,$pencarian,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
            $edit=  anchor('pelatihan/edit/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('pelatihan/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));
if (!empty($row['kursil'])) {
    $kursil= anchor('./assets/uploads/kursil/'.$row['kursil'], 'Download', array('class'=>'label label-info'));
}  else {
    $kursil= anchor('#'.$row['kursil'], 'Tidak ada File', array('class'=>'label label-important'));    
}
            $this->table->add_row(
		    ++$i,
                    $row['kd_pelatihan'],
                    $row['judul'],
		    $kursil,
                    $row['ket'],
                    array('data'=>$edit,'width'=>10),
                    array('data'=>$delete,'width'=>10)
		    );
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $this->template->display('pelatihan/index',$data); 
    }
    
    
    function add() {
        $data['title'] = 'Tambah Pelatihan Baru';
        $data['link_back'] = site_url('pelatihan/index');
        $data['action'] = 'pelatihan/add';
        $this->__set_rule_add_pelatihan();
        
        if ($this->form_validation->run()==FALSE){
            $data['plt']['kd_pelatihan']='';
            $data['plt']['judul']='';
            $data['plt']['kursil']='';
            $data['plt']['ket']='';
            
            $this->template->display('pelatihan/form',$data);
        }  else {
            
            $this->upload->initialize(array(
                'upload_path' => './assets/uploads/kursil/',
                'allowed_types' => '*',
                'max_size' => 5000,
                'remove_spaces' => true,
                'overwrite' => false
            ));
            
            if (!$this->upload->do_upload('kursil')){
                $data_kursil=  $this->input->post('kursil2');                
            } else {
                $unggah=  $this->upload->data();
                $unggah['file_name'];
                $data_kursil=$unggah['file_name'];
            }
            
            $pelatihan=array(
                'kd_pelatihan'=>  $this->input->post('kd_pelatihan'),
                'judul'=>  $this->input->post('judul'),
                'kursil'=>$data_kursil,
                'ket'=>  $this->input->post('ket'),
                'insert_date'=>date('Y-m-d G:i:s'),
                'update_date'=>date('Y-m-d G:i:s')
            );
        
            $this->mdl_pelatihan->add($pelatihan);
            redirect('pelatihan');
            
        }
        
        
    }
    
    function __set_rule_add_pelatihan() {
        $this->form_validation->set_rules('judul','Judul Pelatihan','required|trim');
    }
    
    function edit($id) {
        $data['title'] = 'Edit Data Pelatihan';
        $data['link_back'] = site_url('pelatihan/index');
        $data['action'] = 'pelatihan/edit/'.$id;
        $this->__set_rule_add_pelatihan();
        
        if ($this->form_validation->run()==FALSE){
            $data['plt']=  $this->mdl_pelatihan->get_by_id($id)->row_array();
            
            $this->template->display('pelatihan/form',$data);
        }  else {
            
            $this->upload->initialize(array(
                'upload_path' => './assets/uploads/kursil/',
                'allowed_types' => '*',
                'max_size' => 5000,
                'remove_spaces' => true,
                'overwrite' => false
            ));
            
            if (!$this->upload->do_upload('kursil')){
                $data_kursil=  $this->input->post('kursil2');                
            } else {
                $unggah=  $this->upload->data();
                $unggah['file_name'];
                $data_kursil=$unggah['file_name'];
            }
            
            $pelatihan=array(
                'kd_pelatihan'=>  $this->input->post('kd_pelatihan'),
                'judul'=>  $this->input->post('judul'),
                'kursil'=>$data_kursil,
                'ket'=>  $this->input->post('ket'),
                'update_date'=>date('Y-m-d G:i:s')
            );
        
            $this->mdl_pelatihan->update($id,$pelatihan);
            redirect('pelatihan');
            
        }
        
    
    }
    
        function delete($id) {
            $this->mdl_pelatihan->delete($id);
            redirect('pelatihan');
        }
        
        
                    //upload excel
    function do_upload() {
        $this->load->library('upload');
        $config['upload_path'] = './assets/uploads/excel/';
        $config['allowed_types'] = 'xls';
        $config['max_size'] = '999999999999999999999';
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        } else{
            $data = array('error' => false);
            $upload_data = $this->upload->data();
            $this->load->library('spreadsheet_excel_reader');
            //         include_once ( APPPATH."libraries/excel_reader2.php");

            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $file = $upload_data['full_path'];
           
            $this->spreadsheet_excel_reader->read($file);
            error_reporting(E_ALL ^ E_NOTICE);

            // Sheet 1
          $data=  $this->spreadsheet_excel_reader->sheets[0];
            $dataexcel = Array();
            for ($i = 1; $i <= $data['numRows']; $i++) {

                if ($data['cells'][$i][1] == '')
                    break;

                $dataexcel[$i - 1]['kd_pelatihan'] = $data['cells'][$i][1] ;
                $dataexcel[$i - 1]['judul'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['ket'] = $data['cells'][$i][3];
            }

            delete_files($upload_data['file_path']);
            $this->mdl_pelatihan->add_excel_pelatihan($dataexcel);
        }
        redirect("pelatihan");
    }
    
    
}
