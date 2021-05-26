<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class certificate extends Member_Controller{
    //put your code here
    private $limit=10;
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_certificate');
        $this->load->library('form_validation');
       
    }
    
    function index($offset=0) {
        $this->get_index($offset);
    }
    
    protected function get_index($offset) {
        $this->load->helper('dompdf');
        $data['title']='Data Sertifikasi';
        $data['action']='certificate/index';
        $data['download']= anchor('assets/uploads/certificate/certificate.pdf','<button class="btn"><i class="icon-file"></i>Download PDF</button>',array('rel'=>'tooltip','title'=>'Download PDF'));
        $this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        /* Pagination */
       $config['base_url']=site_url('certificate/index/');
	$config['total_rows']=$this->mdl_certificate->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=5;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    'No',
		    'Nama',
		    'Nopek',
		    'Fungsi',
		    'Jenis Sertifikasi',
		    'Direktorat',
		    'Masa Berlaku',
		    'Alert',
		    'Email',
		    'Last Mail',
                array('data'=>'Action','colspan'=>2)
		);
        
        $month=  $this->input->post('month');
        $status=  $this->input->post('status');
        $data['excel']=  anchor('certificate/to_exel/'.$month.'/'.$status, '<i class="icon-list icon-white"></i>&nbsp;Download Excel',array('class'=>'btn btn-success'));
	$q=$this->mdl_certificate->get_index($this->limit,$offset,$month,$status)->result_array();
        
	$i=0+$offset;
	foreach ($q as $row)
	{           
            $expired_date=  $this->mdl_certificate->get_by_id($row['id'])->row()->expired;
            $status=  $this->mdl_certificate->get_by_id($row['id'])->row()->status;
            
            $now_date=date('Y-m-d G:i:s');
            $conv_expired=  strtotime($expired_date)-strtotime($now_date);            
            $expired=  $conv_expired/(60*60*24);
            
          if(!$status==1){
            $this->mdl_certificate->update_expired($row['id'],$expired);  
          }

            if($status==1){
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
            $expired=$this->editor->date_correct($row['expired']);
        }
        
        
	    
           if($this->session->userdata('user_id')==2 || $this->session->userdata('user_id')==1){
            $edit=  anchor('certificate/edit/'.$row['id'],'<span class="label label-success">Update</span>',array('rel'=>'tooltip','title'=>'Update Sertifikat'));
            $delete=  anchor('certificate/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));            
        }else{
            $edit= '<span class="label label-success">Update</span>';
            $delete= '<i class="icon-trash"></i>';

        }    
           $send_mail= anchor('certificate/sendmail/'.$row['id'],'<button class="btn"><i class="icon-envelope"></i></button>',array('rel'=>'tooltip','title'=>'Kirim Email'));
           $date_mail=  $this->mdl_certificate->get_by_id($row['id'])->row()->send_mail; 
           $last_mail=  $this->editor->date_correct($date_mail);
           $this->table->add_row(
		    ++$i,
		    $row['name'],
		    $row['nopek'],
		    $row['function'],
		    $row['certificate'],
		    $row['directorate'],
		     $expired,
		    $btn_expired,
		    $send_mail,
		    $last_mail,
                    array('data'=>$edit,'width'=>10),
                    array('data'=>$delete,'width'=>10)
	    );
	  
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered table-condensed">'));
	$data['content']=$this->table->generate();
              $this->template->display('certificate/index',$data);
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
		    'Nama',
		    'Nopek',
		    'Fungsi',
		    'Jenis Sertifikasi',
		    'Direktorat',
		    'Masa Berlaku'  
		);
        
        $month=  $this->input->post('month');
        $status=  $this->input->post('status');
	$q=$this->mdl_certificate->get_index($this->limit,$offset,$month,$status)->result_array();
        
	$i=0+$offset;
	foreach ($q as $row)
	{           
            $expired_date=  $this->mdl_certificate->get_by_id($row['id'])->row()->expired;
            $status=  $this->mdl_certificate->get_by_id($row['id'])->row()->status;
            
            $now_date=date('Y-m-d G:i:s');
            $conv_expired=  strtotime($expired_date)-strtotime($now_date);            
            $expired=  $conv_expired/(60*60*24);
            
          if(!$status==1){
            $this->mdl_certificate->update_expired($row['id'],$expired);  
          }
            
            
            if($status==1){
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
            $expired=$this->editor->date_correct($row['expired']);
        }
        
        
	
        
        
           $this->table->add_row(
		    ++$i,
		    $row['name'],
		    $row['nopek'],
		    $row['function'],
		    $row['certificate'],
		    $row['directorate'],
		     $expired
	    );
	  
	}
 //       $this->table->set_template(array('table_open'=>'<table border="1" cellspacing="0">'));
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
        pdf_create($datahtml,'certificate');    
   
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
$this->table->set_caption("Daftar Sertifikat");
	$this->table->add_row(
		
		    'Nama',
		    'Nopek',
		    'Fungsi',
		    'Jenis Sertifikasi',
		    'Direktorat',
		    'Masa Berlaku',  
		    'Status'  
		);
        
    $q=$this->mdl_certificate->to_exel($month,$status)->result_array();
    
    	foreach ($q as $row)
	{
            
            $expired_date=  $this->mdl_certificate->get_by_id($row['id'])->row()->expired;
            $status=  $this->mdl_certificate->get_by_id($row['id'])->row()->status;
            
            $now_date=date('Y-m-d G:i:s');
            $conv_expired=  strtotime($expired_date)-strtotime($now_date);            
            $expired=  $conv_expired/(60*60*24);
            
          if(!$status==1){
            $this->mdl_certificate->update_expired($row['id'],$expired);  
          }
            
            
            if($status==1){
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
		$status_expired='<button class="btn btn-warning">Waspada</button>';
	    }else{
                $status_expired='<button class="btn btn-danger">&nbsp;Expired&nbsp;</button>';
            }
            $expired=$this->editor->date_correct($row['expired']);
        }
        
           $this->table->add_row(
		  
		    $row['name'],
		    $row['nopek'],
		    $row['function'],
		    $row['certificate'],
		    $row['directorate'],
		     $expired,
                   $status_expired
	    );
	  
	}
 //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
	$data['content']=$this->table->generate();

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=certificate.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


echo $data['content'];

    
               
    }
 

    function add() {
        $data['title']='Tambah Data Peserta';
        $data['stat']='0';
        $data['link_back']=  site_url('certificatate/index');
        $data['action']='certificate/add';
        $this->_set_rules();
        if ($this->form_validation->run()==FALSE){
           $data['certificate']['name']='';
           $data['certificate']['nopek']='';
           $data['certificate']['function']='';
           $data['certificate']['certificate']='';
           $data['certificate']['directorate']='';
           $data['certificate']['expired']='';
           $data['certificate']['status']='';
           $data['certificate']['hr_area']='';
           
           $this->template->display('certificate/form',$data);
        }else{
            $var=array(
                'name'=>  $this->input->post('name'),
                'nopek'=>  $this->input->post('nopek'),
                'function'=>  $this->input->post('function'),
                'certificate'=>  $this->input->post('certificate'),
                'directorate'=>  $this->input->post('directorate'),
                'expired'=>  $this->input->post('expired'),
                'hr_area'=>  $this->input->post('hr_area'),
                'status'=>  $this->input->post('status'),
                'insert_date'=>  date('Y-m-d G:i:s'),
                'update_date'=>  date('Y-m-d G:i:s')
            );
            $id=  $this->mdl_certificate->add($var);
            $this->validation->no = $id;
            $this->session->set_flashdata('msg', $this->editor->alert_ok('Data Berhasil Ditambahkan'));
            redirect('certificate/index');
        }
    }
    
    function edit($id) {
    $data['title']='Edit Peserta Sertifikasi';
	$data['link_back']=site_url('certificate/index');
        $data['action']='certificate/edit/'.$id;
	$this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $data['certificate']=$this->mdl_certificate->get_by_id($id)->row_array();
	    $data['stat']=$this->mdl_certificate->get_by_id($id)->row()->status;
            
	} else {
	    $certificate=array(
		'name'=>$this->input->post('name'),
		'nopek'=>$this->input->post('nopek'),
		'function'=>$this->input->post('function'),
		'certificate'=>$this->input->post('certificate'),
		'directorate'=>$this->input->post('directorate'),
		'expired'=>$this->input->post('expired'),
		'hr_area'=>$this->input->post('hr_area'),
		'status'=>$this->input->post('status'),
                'update_date'=>  date('Y-m-d G:i:s')
	    );
	    $this->mdl_certificate->update($id,$certificate);
	    $this->session->set_flashdata('msg',$this->editor->alert_ok('Sertifikasi berhasil diperbarui'));
	    $data['certificate']=$this->mdl_certificate->get_by_id($id)->row_array();
            redirect('certificate/index');
	}
        $this->template->display('certificate/form',$data);    
    }
    
    function sendmail($id) {
       // $data['title']='Edit Peserta Sertifikasi';
        $update_mail=array(
            'send_mail'=>date('Y-m-d G:i:s')
        );
        $this->mdl_certificate->update($id,$update_mail);
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
        $to=$this->mdl_certificate->get_by_id($id)->row()->hr_area; 
        $subject='Judul';
        $body='Ini%20Halaman%20Body';
        
       header('Location: mailto:'.$to.'?Subject='.$subject.'&body='.$body.'');
        $this->index();
        
       // $data['content']='Membuka Email';
       // $this->template->display('certificate/index',$data);

    }
    
    function _set_rules() {
        $this->form_validation->set_rules('name','Nama Peserta','required|trim');
    }
    function openmail() {
        header("Location: mailto:name@example.com");
    }
    
     function delete($id)
    {
        $this->mdl_certificate->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success">Course '.$id.' berhasil dihapus</div>');
        redirect('certificate');
    }
    
}

?>
