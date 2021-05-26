<?php

class Sertifikat extends CI_Controller{
    //put your code here
    private $limit=10;
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_sertifikat');
        $this->load->library('form_validation');
    }
   
    function add_sertifikat() {
  	$data['title']='Tambah Sertifikasi Baru';
	$data['link_back']=site_url('sertifikat/index');
        $data['action']='sertifikat/add_sertifikat';
        $this->_set_rules();
        
        if ($this->form_validation->run()==FALSE){
            $data['sertifikat']['kode']='';
            $data['sertifikat']['name']='';
            $data['sertifikat']['waktu']='';
            $data['sertifikat']['pekerja']='';
            $data['sertifikat']['status']='';
            $data['pekerja']=null;
            $this->template->display('sertifikat/form_sertifikat',$data);
        }else{
                 $data_act=  $this->input->post('pekerja');
                if($data_act!=0)
		{
		    $act_imp= $data_act;
		} else {
		    $act_imp=0;
		}
                
                $data_sert = $this->input->post('name');
                if (empty($data_sert)){
                    $name_sertifikat=  $this->input->post('name_result');
                }else{
                   $name_sertifikat=$data_sert; 
                }
            $sertifikat=array(
                'plc_pekerja_id'=>$act_imp,
                'kode'=>  $this->input->post('kode'),
                'name'=>  $name_sertifikat,
                'waktu'=>  $this->input->post('waktu'),                
                'status'=>  $this->input->post('status'),                
               'insert_date'=>  date('Y-m-d G:i:s'),
                'update_date'=>  date('Y-m-d G:i:s')              
            );
            
            $this->mdl_sertifikat->add_sertifikat($sertifikat);
            redirect('sertifikat/list_sertifikat');
        }
    }
    
    function insert_sertifikasi_jabatan($id_pekerja,$id_sertifikasi) {
 $data['title']='Tambah Sertifikasi Baru';       
            $data['action']='sertifikat/add_sertifikat';
            $data['sertifikat']['kode']= $this->mdl_sertifikat->get_sertifikat_jabatan_by_id($id_sertifikasi)->row()->kode ;
            $data['sertifikat']['name']=$this->mdl_sertifikat->get_sertifikat_jabatan_by_id($id_sertifikasi)->row()->name;
            $data['sertifikat']['waktu']='';
            $data['sertifikat']['pekerja']=$id_pekerja;
            $data['sertifikat']['status']='';
            $data['pekerja']=$this->mdl_sertifikat->get_pekerja_by_id($id_pekerja)->row()->name;
            $this->template->display('sertifikat/form_insert_sertifikat',$data);    
    }
    
        function add_sertifikat_jabatan() {
  	$data['title']='Tambah Sertifikat Jabatan';
	$data['link_back']=site_url('sertifikat/list_sertiifkat_jabatan');
        $data['action']='sertifikat/add_sertifikat_jabatan';
        $this->_set_rules();
        
        if ($this->form_validation->run()==FALSE){
            $data['sertifikat']['kode']='';
            $data['sertifikat']['name']='';
            $this->template->display('sertifikat/form_sertifikat_jabatan',$data);
        }else{
            $sertifikat=array(
                'kode'=>  $this->input->post('kode'),
                'name'=>  $this->input->post('name')
                
            );
            
            $this->mdl_sertifikat->add_sertifikat_jabatan($sertifikat);
            redirect('sertifikat/list_sertifikat_jabatan');
        }
    }
    
    function list_sertifikat($offset=0) {
        if (empty($offset)){$offset=0;}
        $data['title']='Data Sertifikasi';
        $this->load->library('pagination');
               $this->load->helper('dompdf');
        $config['base_url']=  site_url('sertifikat/list_sertifikat');
        $config['total_rows']=  $this->mdl_sertifikat->count_all();
        $config['per_page']=  $this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
       $data['pagination']=$this->pagination->create_links();
        
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                'No',
                'Nama Pekerja',
                'Jabatan',
                'Fungsi / Direktorat',
                'Area Kerja',
                'Kode Sertifikasi',
                'Nama Sertifikasi',
                'Masa Berlaku',
                'Alert',
                'Email',
                'Email Terakhir',
                array('data'=>'Action','colspan'=>2,'width'=>'10')
                );
        
                $month=  $this->input->post('month');
        $status=  $this->input->post('status');
        $data['excel']=  anchor('sertifikat/to_exel/'.$month.'/'.$status, '<i class="icon-list icon-white"></i>&nbsp;Download Excel',array('class'=>'btn btn-success'));
        $data['download']= anchor('assets/uploads/certificate/sertifikasi.pdf','<button class="btn"><i class="icon-file"></i>Download PDF</button>',array('rel'=>'tooltip','title'=>'Download PDF'));
        $c = $this->mdl_sertifikat->get_sertifikat($this->limit,$offset,$month,$status)->result_array();
        $i=0;

        foreach ($c as $row) {
        $expired_date= $row['waktu'];
        $now_date=date('Y-m-d G:i:s');
            $conv_expired=  strtotime($expired_date)-strtotime($now_date);            
            $expired=  $conv_expired/(60*60*24);

          if(!$row['status']==1){
            $this->mdl_sertifikat->update_expired_left($row['id'],$expired);  
          }

            if($row['status']==1){
            $btn_expired='<button class="btn btn-inverse">Unlimited</button>';
            $expired='Unlimited';
            }else{
	    if($expired>90)
	    {
		$btn_expired='<button class="btn btn-primary">&nbsp;&nbsp;&nbsp;Aman&nbsp;&nbsp;</button>';
	    } elseif($expired<=90 && $expired>=60) {
		$btn_expired='<button class="btn btn-success">&nbsp;&nbsp;&nbsp;Awas&nbsp;&nbsp;</button>';
	    }
            elseif($expired>0 && $expired<60) {
		$btn_expired='<button class="btn btn-warning">Waspada</button>';
	    }else{
                $btn_expired='<button class="btn btn-danger">&nbsp;Expired&nbsp;</button>';
            }
            }
            


        $nama_pekerja= $this->mdl_sertifikat->get_pekerja_by_id($row['plc_pekerja_id'])->row()->name;
        $id_jabatan= $this->mdl_sertifikat->get_pekerja_by_id($row['plc_pekerja_id'])->row()->plc_jabatan_id;
        $nama_jabatan= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->name;
        $fungsi= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->function;
        $area_kerja= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->area_kerja;
 
        $last_mail=  $this->editor->date_correct($row['last_mail']);
        
        if ($this->session->userdata('user_id')==2 || $this->session->userdata('user_id')==1){
        $edit=  anchor('sertifikat/edit_sertifikat/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
        $delete=  anchor('sertifikat/delete_sertifikat/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));                     
        $send_mail= anchor('sertifikat/sendmail/'.$row['id'].'/'.$id_jabatan,'<button class="btn"><i class="icon-envelope"></i></button>',array('rel'=>'tooltip','title'=>'Kirim Email'));         
        }else{
        $edit=  '<i class="icon-wrench"></i>';
        $delete=  '<i class="icon-trash"></i>';   
        $send_mail='<button class="btn"><i class="icon-envelope"></i></button>';         
        }  
        
        $this->table->add_row(
             ++$i,
                    $nama_pekerja,
                    $nama_jabatan,
                    $fungsi,
                    $area_kerja,
                    $row['kode'],
                    $row['name'],
                    $this->editor->date_correct($row['waktu']),
                    $btn_expired,
                    $send_mail,
                    $last_mail,
                    $edit,
                    $delete
                    );
            
        }
        
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=  $this->table->generate();
        $data['tambah']=  anchor('sertifikat/add_sertifikat','Tambah',array('class'=>'btn btn-primary'));
       
        $this->template->display('sertifikat/list_sertifikat',$data);
        
        $this->table->clear();
        
        
        
                	$this->table->set_empty('&nbsp;');
                $tmpl = array (
  'table_open'          => '<table border="1" cellpadding="0" cellspacing="0">',
  'heading_row_start'   => '<tr class="heading">',
  'heading_row_end'     => '</tr>',
  'heading_cell_start'  => '<th>',
  'heading_cell_end'    => '</th>',
  'row_start'           => '<tr>',
  'row_end'             => '</tr>',
  'cell_start'          => '<td>',
  'cell_end'            => '</td>',
  'row_alt_start'       => '<tr class="alt">',
  'row_alt_end'         => '</tr>',
  'cell_alt_start'      => '<td>',
  'cell_alt_end'        => '</td>',
  'table_close'         => '</table>'
);
$this->table->set_template($tmpl);      
$this->table->set_caption("Daftar Sertifikat");
	$this->table->add_row(
                'No',
                'Nama Pekerja',
                'Jabatan',
                'Fungsi / Direktorat',
                'Area Kerja',
                'Kode Sertifikasi',
                'Nama Sertifikasi',
                'Masa Berlaku',
                'Alert',
                'Email'
		);
        
            $q = $this->mdl_sertifikat->get_sertifikat($this->limit,$offset,$month,$status)->result_array();
    $i=0;
    	foreach ($q as $row)
	{
            
            $expired_date=  $row['waktu'];
            
            $now_date=date('Y-m-d G:i:s');
            $conv_expired=  strtotime($expired_date)-strtotime($now_date);            
            $expired=  $conv_expired/(60*60*24);
            
          if(!$row['status']==1){
           $this->mdl_sertifikat->update_expired_left($row['id'],$expired);  
          }
            
            
            if($row['status']==1){
            $status_expired='<span style="color:#000000">Unlimited</span>';
            $expired='Unlimited';
            }else{
	    if($expired>90)
	    {
		$status_expired='<span style="color:#888888">Aman</span>';
	    } elseif($expired<=90 && $expired>=60) {
		$status_expired='<span style="color:#BD362F"><b>Awas</b></span>';
	    }
            elseif($expired>0 && $expired<60) {
		$status_expired='<span style="color:#BD362F"><b>Waspada</b></span>';
	    }else{
                $status_expired='<span style="color:#BD362F"><b>Expired</b></span>';
            }
            
        }
        
        $nama_pekerja= $this->mdl_sertifikat->get_pekerja_by_id($row['plc_pekerja_id'])->row()->name;
        $id_jabatan= $this->mdl_sertifikat->get_pekerja_by_id($row['plc_pekerja_id'])->row()->plc_jabatan_id;
        $nama_jabatan= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->name;
        $fungsi= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->function;
        $area_kerja= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->area_kerja;
        $email=  $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->email_hr;
        
           $this->table->add_row(
                    ++$i,
		  $nama_pekerja,
                    $nama_jabatan,
                    $fungsi,
                    $area_kerja,
                    $row['kode'],
                    $row['name'],
                    $this->editor->date_correct($row['waktu']),
                    $status_expired,
                    $email
	    );
	  
	}
 //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
	$data['pdf']=$this->table->generate();
        
                
        $datahtml = '
<html>
<head>
<link type="text/css" href="assets/bootstrap/bootstrap.css" rel="stylesheet">
        <link type="text/css" href="assets/bootstrap/bootstrap-responsive.css" rel="stylesheet">
        <link type="text/css" href="assets/css/style.css" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; font-size: 70%;">
<h3>Data Sertifikat</h3>
'.$data['pdf'].'

</body>
</html>
';
  
 //  $html = $this->load->view('pdf/certificate', $datahtml, true);
        pdf_create($datahtml,'sertifikasi');    
        
    }
    
    
    
 function to_exel($month=0,$status=0) {
    $this->load->library('table');
	$this->table->set_empty('&nbsp;');
        //-- Table Initiation
$tmpl = array (
  'table_open'          => '<table border="1" cellpadding="0" cellspacing="0">',
  'heading_row_start'   => '<tr class="heading">',
  'heading_row_end'     => '</tr>',
  'heading_cell_start'  => '<th>',
  'heading_cell_end'    => '</th>',
  'row_start'           => '<tr>',
  'row_end'             => '</tr>',
  'cell_start'          => '<td>',
  'cell_end'            => '</td>',
  'row_alt_start'       => '<tr class="alt">',
  'row_alt_end'         => '</tr>',
  'cell_alt_start'      => '<td>',
  'cell_alt_end'        => '</td>',
  'table_close'         => '</table>'
);
$this->table->set_template($tmpl);      
$this->table->set_caption("Daftar Sertifikasi");
	$this->table->add_row(
                'No',
                'Nama Pekerja',
                'Jabatan',
                'Fungsi / Direktorat',
                'Area Kerja',
                'Kode Sertifikasi',
                'Nama Sertifikasi',
                'Masa Berlaku',
                'Alert',
                'Email'
		);
        
    $q=$this->mdl_sertifikat->to_exel($month,$status)->result_array();
    $i=0;
    	foreach ($q as $row)
	{
            
            $expired_date=  $row['waktu'];
            
            $now_date=date('Y-m-d G:i:s');
            $conv_expired=  strtotime($expired_date)-strtotime($now_date);            
            $expired=  $conv_expired/(60*60*24);
            
          if(!$row['status']==1){
           $this->mdl_sertifikat->update_expired_left($row['id'],$expired);  
          }
            
            
            if($row['status']==1){
            $status_expired='<button class="btn btn-inverse">Unlimited</button>';
            $expired='Unlimited';
            }else{
	    if($expired>90)
	    {
		$status_expired='<span style="color:#888888">Aman</span>';
	    } elseif($expired<=90 && $expired>=60) {
		$status_expired='<span style="color:#BD362F"><b>Awas</b></span>';
	    }
            elseif($expired>0 && $expired<60) {
		$status_expired='<span style="color:#BD362F"><b>Waspada</b></span>';
	    }else{
                $status_expired='<span style="color:#BD362F"><b>Expired</b></span>';
            }
            
        }
        
        $nama_pekerja= $this->mdl_sertifikat->get_pekerja_by_id($row['plc_pekerja_id'])->row()->name;
        $id_jabatan= $this->mdl_sertifikat->get_pekerja_by_id($row['plc_pekerja_id'])->row()->plc_jabatan_id;
        $nama_jabatan= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->name;
        $fungsi= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->function;
        $area_kerja= $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->area_kerja;
        $email=  $this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->email_hr;
        
           $this->table->add_row(
                    ++$i,
		  $nama_pekerja,
                    $nama_jabatan,
                    $fungsi,
                    $area_kerja,
                    $row['kode'],
                    $row['name'],
                    $this->editor->date_correct($row['waktu']),
                    $status_expired,
                    $email
	    );
	  
	}
 //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
	$data['content']=$this->table->generate();

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=sertifikasi.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


echo $data['content'];

    
               
    }
    
        function list_sertifikat_jabatan($offset=0) {
        if (empty($offset)){$offset=0;}
        $data['title']='Data Sertifikasi Jabatan';
        $data['action']='sertifikat/list_sertifikat_jabatan';
        $this->load->library('pagination');
        
        $config['base_url']=  site_url('sertifikat/list_sertifikat_jabatan');
        $config['total_rows']=  $this->mdl_sertifikat->count_sertifikat_jabatan_all();
        $config['per_page']=  $this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
       $data['pagination']=$this->pagination->create_links();
        
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                array('data'=>'No','width'=>'3%'),
                array('data'=>'Kode','width'=>'7%'),
                array('data'=>'Nama Sertifikasi','width'=>'80%'),
                array('data'=>'Action','colspan'=>'2','width'=>'5%')
                );
        $pilihan= $this->input->post('pilihan');
        $pencarian= $this->input->post('pencarian');
        $c = $this->mdl_sertifikat->get_sertifikat_jabatan($this->limit,$offset,$pilihan,$pencarian)->result_array();
        $i=0;

        foreach ($c as $row) {
            if ($this->session->userdata('user_id')==2 || $this->session->userdata('user_id')==1){
        $edit=  anchor('sertifikat/edit_sertifikat_jabatan/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
        $delete=  anchor('sertifikat/delete_sertifikat_jabatan/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));                         
            }else{
         $edit= '<i class="icon-wrench"></i>';
        $delete='<i class="icon-trash"></i>';         
            }

            $this->table->add_row(
             ++$i,
                    $row['kode'],
                    $row['name'],
                    $edit,
                    $delete
                    );
            
        }
        
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=  $this->table->generate();
        $data['tambah']=  anchor('sertifikat/add_sertifikat_jabatan','Tambah',array('class'=>'btn btn-primary'));
       
        $this->template->display('sertifikat/list_sertifikat_jabatan',$data);
        
    }
    
    function edit_sertifikat($id) {
        $data['title']='Edit Sertifikat';
        $data['link_back']='sertifikat/list_sertifikat';
        $data['action']='sertifikat/edit_sertifikat/'.$id;
        $this->_set_rules();
        if ($this->form_validation->run()==FALSE){
            $data['sertifikat']= $this->mdl_sertifikat->get_sertifikat_by_id($id)->row_array();
            $data['sertifikat']['pekerja']='';
$data['pekerja']=$this->mdl_sertifikat->get_pekerja_by_id($data['sertifikat']['plc_pekerja_id'])->row()->name;
           
            $this->template->display('sertifikat/form_insert_sertifikat',$data);
        }else{

            $sertifikat=array(
                'waktu'=>  $this->input->post('waktu'),                
                 'update_date'=>  date('Y-m-d G:i:s')               
            );
            $this->mdl_sertifikat->update_sertifikat($id,$sertifikat);
            redirect('sertifikat/list_sertifikat');
        }
    }
    
        function edit_sertifikat_jabatan($id) {
        $data['title']='Edit Sertifikat Jabatan';
        $data['link_back']='sertifikat/list_sertifikat_jabatan';
        $data['action']='sertifikat/edit_sertifikat_jabatan/'.$id;
        $this->_set_rules();
        if ($this->form_validation->run()==FALSE){
            $data['sertifikat']= $this->mdl_sertifikat->get_sertifikat_jabatan_by_id($id)->row_array();
            $this->template->display('sertifikat/form_sertifikat_jabatan',$data);
        }else{
            $sertifikat=array(
                'kode'=>  $this->input->post('kode'),
                'name'=>  $this->input->post('name')
                
            );
            $this->mdl_sertifikat->update_sertifikat_jabatan($id,$sertifikat);
            redirect('sertifikat/list_sertifikat_jabatan');
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('kode','Kode Serifikat','required|trim');
    }
    function _set_rules_pekerja(){
        $this->form_validation->set_rules('nopek','Nopek Pegawai','required|trim');
    }
    
    function delete_sertifikat($id) {
        $this->mdl_sertifikat->delete_sertifikat($id);
         $this->session->set_flashdata('msg','<div class="alert alert-success">Sertifikat '.$id.' berhasil dihapus</div>');
         redirect('sertifikat/list_sertifikat');
    }
    
    function delete_sertifikat_jabatan($id) {
        $this->mdl_sertifikat->delete_sertifikat_jabatan($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success">Sertifikat'.$id.'berhasil dihapus</div>');
        redirect('sertifikat/list_sertifikat_jabatan');
        }
        
        function delete_jabatan($id) {
            $this->mdl_sertifikat->delete_jabatan($id);
            $this->session->set_flashdata('msg','<div class="alert alert-success">Sertifikat'.$id.'berhasil dihapus</div>');
            redirect('sertifikat/list_jabatan');
            
        }
    
    
    // Jabatan
    
        function add_jabatan() {
  	$data['title']='Tambah Jabatan Baru';
	$data['link_back']=site_url('sertifikat/index');
        $data['action']='sertifikat/add_jabatan';
        $this->_set_rules();
        
        if ($this->form_validation->run()==FALSE){
            $data['jabatan']['kode']='';
            $data['jabatan']['name']='';
            $data['jabatan']['function']='';
            $data['jabatan']['area_kerja']='';
            $data['jabatan']['sertifikat']='';
            $data['jabatan']['email_hr']='';
            $data['sertifikat']=null;
            $this->template->display('sertifikat/form_jabatan',$data);
        }else{
               $data_act=  $this->input->post('sertifikat');
                if($data_act!=0)
		{
		    $act_imp= implode('#', $data_act);
		} else {
		    $act_imp=0;
		}
                
            $jabatan=array(
                'kode'=>  $this->input->post('kode'),
                'name'=>  $this->input->post('name'),
                'function'=>  $this->input->post('function'),
                'area_kerja'=>  $this->input->post('area_kerja'),
                'sertifikat'=>  $act_imp,
                'email_hr'=> $this->input->post('email_hr')
                
            );
            
            $this->mdl_sertifikat->add_jabatan($jabatan);
            redirect('sertifikat/list_jabatan');
        }
    }
    
    
        function list_jabatan($offset=0) {
        if (empty($offset)){$offset=0;}
        $data['title']='Data Jabatan';
        $data['action']='sertifikat/list_jabatan';
        
        $this->load->library('pagination');
        
        $config['base_url']=  site_url('sertifikat/list_jabatan');
        $config['total_rows']=  $this->mdl_sertifikat->count_jabatan();
        $config['per_page']=  $this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                array('data'=>'No','width'=>'3%'),
                array('data'=>'Kode','width'=>'7%'),
                array('data'=>'Nama Jabatan','width'=>'25%'),
                array('data'=>'Fungsi / Direktorat','width'=>'20%'),
                array('data'=>'Area Kerja','width'=>'30%'),
                array('data'=>'Sertifikasi','width'=>'5%'),
                array('data'=>'Email HR','width'=>'10%'),
                array('data'=>'Action','colspan'=>2,'width'=>'5')
                );
        $pilihan=  $this->input->post('pilihan');
        $pencarian=  $this->input->post('pencarian');
        
        $c = $this->mdl_sertifikat->get_jabatan($this->limit,$offset,$pilihan,$pencarian)->result_array();
        $i=0;
$data['sertifikat_jabatan']='';
        foreach ($c as $row) {
        if ($this->session->userdata('user_id')==2 || $this->session->userdata('user_id')==1){
        $edit=  anchor('sertifikat/edit_jabatan/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
        $delete=  anchor('sertifikat/delete_jabatan/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));                     
        }else{
       $edit= '<i class="icon-wrench"></i>';
        $delete='<i class="icon-trash"></i>';             
        }    

        $sertifikat= anchor('#sertifikat_jabatan'.$row['id'],'Lihat',array('rel'=>'tooltip','title'=>'Lihat Sertifikat','data-toggle'=>'modal','class'=>'label label-info')); 
$data['sertifikat_jabatan'].=$this->editor->modal_sertifikat_jabatan($row['id']);       
        $this->table->add_row(
             ++$i,
                    $row['kode'],
                    $row['name'],
                    $row['function'],
                    $row['area_kerja'],
                    $sertifikat,
                $row['email_hr'],
                    $edit,
                    $delete
                    );
            
        }
        
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=  $this->table->generate();
        $data['tambah']=  anchor('sertifikat/add_jabatan','Tambah',array('class'=>'btn btn-primary'));
       
        $this->template->display('sertifikat/list_jabatan',$data);
        
    }
    
        function edit_jabatan($id) {
        if(empty($id)){
            $this->session->set_flashdata('msg','<div class="alert alert-error">Terjadi kesalahan</div>');
            redirect('sertifikat/list_jabatan');
        } else {
        $data['title']='Edit Jabatan';
        $data['link_back']='sertifikat/list_jabatan';
        $data['action']='sertifikat/edit_jabatan/'.$id;

        $this->_set_rules();
        if ($this->form_validation->run()==FALSE){
            $data['jabatan']= $this->mdl_sertifikat->get_jabatan_by_id($id)->row_array();
            
                if($data['jabatan']['sertifikat']==0)
		{
		    $data['sertifikat']='<tr id="null_sertifikat"><td>Tidak ada data Sertifikat</td></tr>';
		} else {
		    $sertifikat=explode("#", $data['jabatan']['sertifikat']);
		    $data['sertifikat']='';
		    foreach ($sertifikat as $row_sertifikat)
		    {
			$tbl_sertifikat=$this->mdl_sertifikat->get_sertifikat_jabatan_by_id($row_sertifikat)->row();
			$data['sertifikat'].= '<tr><td>'.$tbl_sertifikat->name.anchor('#','<i class="icon-remove"></i>','class="remove_sertifikat"').'<input type="hidden" name="sertifikat[]" value="'.$row_sertifikat.'"></td></tr>';
		    }
		}
                
            $this->template->display('sertifikat/form_jabatan',$data);
        }else{

                            $data_act=  $this->input->post('sertifikat');
                if($data_act!=0)
		{
		    $act_imp= implode('#', $data_act);
		} else {
		    $act_imp=0;
		}
                
            $update_jabatan=array(
                'kode'=>  $this->input->post('kode'),
                'name'=>  $this->input->post('name'),
                'function'=>  $this->input->post('function'),
                'area_kerja'=>  $this->input->post('area_kerja'),
                'sertifikat'=>  $act_imp,
                'email_hr'=>  $this->input->post('email_hr')
                
            );
            
            $this->mdl_sertifikat->update_jabatan($id,$update_jabatan);
            redirect('sertifikat/list_jabatan');
        }            
        }    

    }
    

    function add_pekerja() {
  	$data['title']='Tambah Pekerja Baru';
	$data['link_back']=site_url('sertifikat/list_pekerja');
        $data['action']='sertifikat/add_pekerja';
        $this->_set_rules_pekerja();
        
        if ($this->form_validation->run()==FALSE){
            
            $data['pekerja']['name']='';
            $data['pekerja']['nopek']='';
            $data['pekerja']['waktu']='';
            $data['jabatan']=null;
            $this->template->display('sertifikat/form_pekerja',$data);
        }else{
                                        $data_act=  $this->input->post('jabatan');
                if($data_act!=0)
		{
		    $act_imp= $data_act;
		} else {
		    $act_imp=0;
		}
                
            $pekerja=array(
                'plc_jabatan_id'=>  $act_imp,
                'name'=>  $this->input->post('name'),
                'nopek'=>  $this->input->post('nopek')
                
            );
            
            $this->mdl_sertifikat->add_pekerja($pekerja);
            redirect('sertifikat/list_pekerja');
        }
    }
    
    function edit_pekerja($id) {
    if (empty($id)){
        $this->session->set_flashdata('msg','<div class="alert alert-error"> Terjadi Kesalahan </div>');
        redirect('sertifikat/list_pekerja');
    }else{
        $data['title']='Edit Pekerja';
        $data['link_back']='sertifikat/list_pekerja';
        $data['action']='sertifikat/edit_pekerja/'.$id;
        $this->_set_rules_pekerja();
        if ($this->form_validation->run()==FALSE){
            $data['pekerja']=  $this->mdl_sertifikat->get_pekerja_by_id($id)->row_array();
            $data['jabatan']= $this->mdl_sertifikat->get_jabatan_by_id($data['pekerja']['plc_jabatan_id'])->row()->name;
            $data['jabatan_id']= $this->mdl_sertifikat->get_jabatan_by_id($data['pekerja']['plc_jabatan_id'])->row()->id;
        $this->template->display('sertifikat/form_pekerja',$data);
            
        }else{
               $data_act=  $this->input->post('jabatan');
                if($data_act!=0)
		{
		    $act_imp= $data_act;
		} else {
		    $act_imp=  $this->input->post('jabatan_id');
		}
                
            $pekerja=array(
                'plc_jabatan_id'=>  $act_imp,
                'name'=>  $this->input->post('name'),
                'nopek'=>  $this->input->post('nopek')
                
            );
            $this->mdl_sertifikat->update_pekerja($id,$pekerja);
            redirect('sertifikat/list_pekerja');
        }
    }
    
    
    }
    
    function delete_pekerja($id) {
        $this->mdl_sertifikat->delete_pekerja($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success">Pekerja Berhasil di Hapus</div>');
        redirect('sertifikat/list_pekerja');
    }
    
function list_pekerja($offset=0) {
        if (empty($offset)){$offset=0;}
        $data['title']='Data Pekerja';
        $data['action']='sertifikat/list_pekerja';
        $this->load->library('pagination');
        
        $config['base_url']=  site_url('sertifikat/list_pekerja');
        $config['total_rows']=  $this->mdl_sertifikat->count_pekerja();
        $config['per_page']=  $this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                'No',
                'Nopek',
                'Nama',
                'Jabatan',
                'Fungsi / Direaktorat',
                'Area Kerja',
                'Sertifikasi',
                array('data'=>'Action','colspan'=>2,'width'=>'10')
                );
        $pilihan = $this->input->post('pilihan');
        $pencarian = $this->input->post('pencarian');
        $c = $this->mdl_sertifikat->get_pekerja($this->limit,$offset,$pilihan,$pencarian)->result_array();
        $i=0;
$data['sertifikat_jabatan']='';
$data['sertifikat']='';
        foreach ($c as $row) {
            if($this->session->userdata('user_id')==2 || $this->session->userdata('user_id')==1){
        $edit=  anchor('sertifikat/edit_pekerja/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
        $delete=  anchor('sertifikat/delete_pekerja/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));                         
            }else{
                $edit='<i class="icon-wrench"></i>';
                $delete='<i class="icon-trash"></i>';
            }

$jabatan_name= $this->mdl_sertifikat->get_jabatan_by_id($row['plc_jabatan_id'])->row()->name;

$jabatan= anchor('#sertifikat_jabatan'.$row['plc_jabatan_id'],$jabatan_name,array('rel'=>'tooltip','title'=>'Lihat Jabatan','data-toggle'=>'modal','class'=>'label label-info')); 
$data['sertifikat_jabatan'].=$this->editor->modal_sertifikat_jabatan($row['plc_jabatan_id']);   
        $fungsi= $this->mdl_sertifikat->get_jabatan_by_id($row['plc_jabatan_id'])->row()->function;
$area_kerja= $this->mdl_sertifikat->get_jabatan_by_id($row['plc_jabatan_id'])->row()->area_kerja;
$sertifikasi= anchor('#sertifikat'.$row['plc_jabatan_id'],'Lihat',array('rel'=>'tooltip','title'=>'Lihat Jabatan','data-toggle'=>'modal','class'=>'label label-info')); 
$data['sertifikat'].=$this->editor->modal_sertifikat($row['plc_jabatan_id'],$row['id']);
        $this->table->add_row(
             ++$i,
                    $row['nopek'],
                    $row['name'],
                $jabatan,
                $fungsi,
                    $area_kerja,
                    $sertifikasi,
                    $edit,
                    $delete
                    );
            
        }
        
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=  $this->table->generate();
        $data['tambah']=  anchor('sertifikat/add_pekerja','Tambah',array('class'=>'btn btn-primary'));
       
        $this->template->display('sertifikat/list_pekerja',$data);
        
    }
    
    function add_sertifikasi_log($id_pekerja,$id_sertifikat) {
        $id_jabatan= $this->mdl_sertifikat->get_pekerja_by_id($id_pekerja)->row()->plc_jabatan_id;
        $masa_berlaku= $this->mdl_sertifikat->get_sertifikat_by_id($id_sertifikat)->row()->waktu;
        
        $tgl = date("Y-m-d");// current date
       
        $end_date = date('Y-m-d', strtotime($Date. ' + '.$masa_berlaku.' days'));
        $add_log = array(
            'plc_pekerja_id'=>$id_pekerja,
            'plc_sertifikat_id'=>$id_sertifikat,
            'plc_jabatan_id'=>$id_jabatan,
            'expired_date'=>$end_date
            
        );
        
        $this->mdl_sertifikat->add_log($add_log);
        redirect('sertifikat/list_pekerja');
    }
    
    
    
       //autoComplete Sertifikat
        function lookup(){
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_sertifikat->lookup_sertifikat($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>$row['id'],
                                        'value' => $row['name']
                                     );  //Add a row to array
            }
            echo json_encode($data); //echo json string if ajax request
        } else {
            $datax['response'] = 'true';
            $data['message'] = array();
            $datax['message'][] = array(
                                        'id'=>0,
                                        'value' => 'Tidak ditemukan'
                                     );
            echo json_encode($datax);
        }
    }
    
        function lookup_sertifikasi_jabatan(){
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_sertifikat->lookup_sertifikasi_jabatan($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>$row['id'],
                                        'value' => $row['kode'],
                                        'name' => $row['name']
                                     );  //Add a row to array
            }
            echo json_encode($data); //echo json string if ajax request
        } else {
            $datax['response'] = 'true';
            $data['message'] = array();
            $datax['message'][] = array(
                                        'id'=>0,
                                        'value' => 'Tidak ditemukan'
                                     );
            echo json_encode($datax);
        }
    }
    

    
       //autoComplete Jabatan
        function lookup_jabatan(){
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_sertifikat->lookup_jabatan($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>$row['id'],
                                        'value' => $row['name']
                                     );  //Add a row to array
            }
            echo json_encode($data); //echo json string if ajax request
        } else {
            $datax['response'] = 'true';
            $data['message'] = array();
            $datax['message'][] = array(
                                        'id'=>0,
                                        'value' => 'Tidak ditemukan'
                                     );
            echo json_encode($datax);
        }
    }    

    
       //autoComplete Pekerja
        function lookup_pekerja(){
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_sertifikat->lookup_pekerja($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array(
                                        'id'=>$row['id'],
                                        'value' => $row['name']
                                     );  //Add a row to array
            }
            echo json_encode($data); //echo json string if ajax request
        } else {
            $datax['response'] = 'true';
            $data['message'] = array();
            $datax['message'][] = array(
                                        'id'=>0,
                                        'value' => 'Tidak ditemukan'
                                     );
            echo json_encode($datax);
        }
    }
    
        function sendmail($id,$id_jabatan) {
       // $data['title']='Edit Peserta Sertifikasi';
        $update_mail=array(
            'last_mail'=>date('Y-m-d G:i:s')
        );
        $this->mdl_sertifikat->update_mail_date($id,$update_mail);
        $this->session->set_flashdata('msg',$this->editor->alert_ok('Sertifikasi berhasil diperbarui'));
        /*
        
        $this->load->library('email');

$this->email->from('your@example.com', 'Your Name');
$this->email->to('someone@example.com');
$this->email->cc('another@another-example.com');
$this->email->bcc('them@their-example.com');

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

$this->email->send();

echo $this->email->print_debugger();
         
         */
        $to=$this->mdl_sertifikat->get_jabatan_by_id($id_jabatan)->row()->email_hr; 
        $subject='Judul';
        $body='Ini%20Halaman%20Body';
        
       header('Location: mailto:'.$to.'?Subject='.$subject.'&body='.$body.'');
        $this->list_sertifikat();
        
       // $data['content']='Membuka Email';
       // $this->template->display('certificate/index',$data);

    }
    
}
