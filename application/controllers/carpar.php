<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Carpar extends CI_Controller {
    private $limit=10;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_carpar');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));        
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
    }
    
    function index($offset=0){
        $this->get_index($offset);
    }

    protected function get_index($offset)
    {
	$data['title']='Index CAR/PAR Report';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('carpar/index/');
	$config['total_rows']=$this->mdl_carpar->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    array('data'=>'No','width'=>10),
                 'Nama Program',
                 'PIC',
                 'Tgl Target',
                 'Ket Verifikasi',
                 'Status',
                 'Email',
                'Aksi'
		);
                $cari = $this->input->post('cari');
                $list= $this->input->post('list');
         if (empty($cari)){
            $cari='';
        }
	$q=$this->mdl_carpar->get_index($list,$cari,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
            if ($this->mdl_carpar->get_carpar_log_status($row['id'])->num_rows()<1) {
                 $new_verifikasi='';   
            }  else {
                $new_verifikasi='<span class="label label-warning">baru</span>';
            }
            
            $verifikasi=  anchor('carpar/verifikasi/'.$row['id'],'Verifikasi',array('rel'=>'tooltip','title'=>'Verifikasi','class'=>'btn btn-success'));
            $lihat_verifikasi=  anchor('carpar/verifikasi/'.$row['id'],'Lihat',array('rel'=>'tooltip','title'=>'Verifikasi','class'=>'btn btn-primary'));
            $review=  anchor('carpar/review/'.$row['id'],'Review',array('rel'=>'tooltip','title'=>'Review','class'=>'btn btn-info'));
            $tindakan=anchor('carpar/tindakan/'.$row['id'],'Review',array('rel'=>'tooltip','title'=>'Review','class'=>'label label-warning'));

            if ($this->session->userdata('user_id')==1) {
            $delete=  anchor('carpar/delete/'.$row['id'],'Hapus',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete','class'=>'label label-important'));        
            $edit=  anchor('carpar/edit/'.$row['id'],'Edit',array('rel'=>'tooltip','title'=>'Edit','class'=>'label label-success'));        
            }  else {
            $delete='';    
            $edit='';    
            }
            
            
            if ($row['review']==0) {
            $status=$review;                
            }  else {
                if ($row['verifikasi']==1) {
                    $status=$lihat_verifikasi;
                }  else {
            $status=$verifikasi.'&nbsp;'.$new_verifikasi;                        
                }
            }
            
            if ($row['verifikasi']==1) {
                $verifikasi='<span class="label label-success">Selesai</span>';
            }  else {
                $verifikasi='<span class="label label-important">Belum</span>';                
            }
              

	    $this->table->add_row(
		    ++$i,
                    $row['nama_program'],
                    $this->mdl_carpar->get_pic($row['pic'])->row()->name,
                    $this->editor->date_correct($row['tgl_target_penyelesaian']),
                    $verifikasi,
                    $status,
                    anchor('carpar/sendmail/'.$row['id'], 'Kirim', array('class'=>'btn btn-warning')),
                    $delete.'&nbsp;'.$edit
		    );
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $this->template->display('carpar/index',$data);
    }
    
        function sendmail($id) {
       $to=  $this->mdl_carpar->get_by_id($id)->row()->email_pic;     
       $subject= '[Notifikasi CAR/PAR]'. $this->mdl_carpar->get_by_id($id)->row()->nama_program;     
       header('Location: mailto:'.$to.'?Subject='.$subject.'&body=');
        $this->index();        
    }
    
        function sendmail_user($id) {
       $to= 'fardi@pertamina.com';     
       $subject= '[Notifikasi Update Tindakan] '. $this->mdl_carpar->get_by_id($id)->row()->nama_program;     
       header('Location: mailto:'.$to.'?Subject='.$subject.'&body=');
        $this->index_user();        
    }
    
    function index_user($offset=0)
    {
	$data['title']='Index CAR/PAR Report';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('carpar/index_user/');
	$config['total_rows']=$this->mdl_carpar->count_all_user();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    array('data'=>'No','width'=>10),
                 'Nama Program',
                 'PIC',
                 'Verifikasi',
                 'Aksi'
		);
                $cari = $this->input->post('cari');
                $list= $this->input->post('list');
         if (empty($cari)){
            $cari='';
        }
        $pic=$this->session->userdata('user_id');
	$q=$this->mdl_carpar->get_index_user($pic,$list,$cari,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
            if ($this->mdl_carpar->get_carpar_log_status($row['id'])->num_rows()<1) {
                 $new_verifikasi='';   
            }  else {
                $new_verifikasi='<span class="label label-warning">baru</span>';
            }
            if ($row['verifikasi']==1) {
            $tindakan=anchor('carpar/verifikasi/'.$row['id'],'Lihat',array('rel'=>'tooltip','title'=>'Lihat','class'=>'btn btn-success'));
            }  else {
            $tindakan=anchor('carpar/tindakan/'.$row['id'],'Tindakan',array('rel'=>'tooltip','title'=>'Tindakan','class'=>'btn btn-primary'));
                
            }            

            
            if ($row['verifikasi']==1) {
                $verifikasi='<span class="label label-success">Selesai</span>';
            }  else {
                $verifikasi='<span class="label label-important">Belum</span>';                
            }
              

	    $this->table->add_row(
		    ++$i,
                    $row['nama_program'],
                    $this->mdl_carpar->get_pic($row['pic'])->row()->name,
                    $verifikasi,
                    $tindakan.'&nbsp;'.$new_verifikasi
		    );
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $this->template->display('carpar/index_user',$data);
    }    
       function add_carpar() {
    
	$data['title']='Tambah CAR/PAR';
	$data['link_back']=site_url('carpar/index');
        $data['action']='carpar/add_carpar';

        $this->_set_rules_carpar();

        if($this->form_validation->run() === FALSE)
	{
          $data['carpar']['tempat']='<input type="radio" name="tempat" value="Internal"> Internal &nbsp;<input type="radio" name="tempat" value="User/ Keluhan pelanggan"> User/ Keluhan pelanggan';  
	    $this->template->display('carpar/add_carpar',$data);
            
	} else {
            
	    $carpar=array(
		'tempat'=>$this->input->post('tempat'),
		'nama_program'=>$this->input->post('nama_program'),
		'kode_program'=>$this->input->post('kode_program'),
		'temuan'=>$this->input->post('temuan'),
		'pic'=>$this->input->post('pic'),
		'email_pic'=>$this->input->post('email'),
		'analisa'=>$this->input->post('analisa'),
		'penyelidikan'=>$this->input->post('penyelidikan'),
                'insert_date'=>  date('Y-m-d G:i:s')
	    );
$to='fardi@pertamina.com';
$subject='[Review CAR/PAR] '.$this->input->post('nama_program');
$body='';
	    $this->mdl_carpar->add_carpar($carpar);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Data baru berhasil ditambahkan</div>');
         header('Location: mailto:'.$to.'?Subject='.$subject.'&body='.$body.'');        
         $this->index();
	}    
    }
        function _set_rules_carpar() {
        $this->form_validation->set_rules('tempat','tempat','required|trim');
    }
    
function verifikasi($id) {
$data['title']='Verifikasi CAR/PAR';
$data['action']='carpar/verifikasi/'.$id;
$this->_set_rules_verifikasi();
$this->update_status_carpar_log($id); //update status log carpar

if ($this->form_validation->run()==FALSE) {
$q=$this->mdl_carpar->get_carpar_log_by_id($id)->result_array();
$tindakan='';
$file_tindakan='';
foreach ($q as $row) {
    if (!empty($row['tindakan'])) {
        $tindakan.=$row['tindakan'].'<br>'.$row['date_tindakan'].'<hr>';
    }
    
    if (!empty($row['file_evidence'])) {
        $file_tindakan.=anchor('../plc/assets/uploads/file_carpar/'.$row['file_evidence'], 'Download', array('class'=>'label label-success')).'&nbsp'.$row['date_tindakan'].'<hr>';
    }    
}


$data['no_report']= $id;
$data['tempat']=  $this->mdl_carpar->get_by_id($id)->row()->tempat;
$data['nama_program']=  $this->mdl_carpar->get_by_id($id)->row()->nama_program;
$data['kode_program']=  $this->mdl_carpar->get_by_id($id)->row()->kode_program;
$data['temuan']=  $this->mdl_carpar->get_by_id($id)->row()->temuan;
$data['analisa']=  $this->mdl_carpar->get_by_id($id)->row()->analisa;
$data['penyelidikan']=  $this->mdl_carpar->get_by_id($id)->row()->penyelidikan;
$data['tgl_target_penyelesaian']= $this->editor->date_correct($this->mdl_carpar->get_by_id($id)->row()->tgl_target_penyelesaian);
$data['tindakan']= $tindakan;
$data['file_tindakan']=$file_tindakan;
if ($this->mdl_carpar->get_by_id($id)->row()->verifikasi==1) {
 $this->template->display('carpar/verifikasi_selesai',$data);   
}  else {
 $this->template->display('carpar/verifikasi',$data);   
}
    
}  else {
    if ($this->input->post('verifikasi')==1) {
    $verifikasi=array(
        'verifikasi'=>  $this->input->post('verifikasi'),
        'date_verifikasi'=>  date('Y-M-d G:i:s')
    );
    $this->mdl_carpar->update($id,$verifikasi);
    }  else {
    $verifikasi=array(
    'id_carpar'=>$id,
    'verifikasi'=>  $this->input->post('verifikasi'),
    'date_verifikasi'=> date('Y-m-d G:i:s'),
    'ket_verifikasi'=>  $this->input->post('ket_verifikasi'),
    'status'=>  1
);      
$this->mdl_carpar->add_carpar_log($verifikasi);
    }
        $to=$this->mdl_carpar->get_by_id($id)->row()->email_pic;
        $subject='[Notifikasi CAR/PAR] '.$this->mdl_carpar->get_by_id($id)->row()->nama_program;
        $body='';
        header('Location: mailto:'.$to.'?Subject='.$subject.'&body='.$body.'');        
        $this->index();
}


    }
    
    function update_status_carpar_log($id) {
        $data=array(
            'status'=>0
        );
        $this->mdl_carpar->update_log($id,$data);
    }
    
     function _set_rules_verifikasi() {
        $this->form_validation->set_rules('verifikasi','verifikasi','required|trim');
    }
    
   function review($id){
        $data['title']='Review Carpar';
	$data['link_back']=site_url('carpar/index');
        $data['action']='carpar/review/'.$id;
        $this->_set_rules_carpar();
	if($this->form_validation->run() === FALSE)
	{
	    $data['carpar']=$this->mdl_carpar->get_by_id($id)->row_array();
            $data['no_report']=  $this->mdl_carpar->get_by_id($id)->row()->id;
            
            if ($this->mdl_carpar->get_by_id($id)->row()->tempat=='Internal') {
             $data['carpar']['tempat']='<input type="radio" name="tempat" value="Internal" checked> Internal &nbsp;<input type="radio" name="tempat" value="User/ Keluhan pelanggan"> User/ Keluhan pelanggan';   
            }else{
             $data['carpar']['tempat']='<input type="radio" name="tempat" value="Internal"> Internal &nbsp;<input type="radio" name="tempat" value="User/ Keluhan pelanggan" checked> User/ Keluhan pelanggan';   
            }
            
            $this->template->display('carpar/review',$data);
	}else{
            $carpar = array(
                'tempat'=>$this->input->post('tempat'),
                'nama_program'=>$this->input->post('nama_program'),
                'kode_program'=>$this->input->post('kode_program'),
                'temuan'=>$this->input->post('temuan'),
                'analisa'=>$this->input->post('analisa'),
                'penyelidikan'=>$this->input->post('penyelidikan'),
                'review'=>$this->input->post('review'),
                'date_review'=>date('Y-m-d G:i:s'),
                'update_date'=>date('Y-m-d G:i:s')
            );
            $this->mdl_carpar->update($id,$carpar);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Memo baru berhasil di ubah</div>');
	    redirect('carpar/index');
        }

    }
    
   function edit($id){
        $data['title']='Edit Carpar';
	$data['link_back']=site_url('carpar/index');
        $data['action']='carpar/edit/'.$id;
        $this->_set_rules_carpar();
	if($this->form_validation->run() === FALSE)
	{
	    $data['carpar']=$this->mdl_carpar->get_by_id($id)->row_array();
           
            $data['no_report']=  $this->mdl_carpar->get_by_id($id)->row()->id;
            
            if ($this->mdl_carpar->get_by_id($id)->row()->tempat=='Internal') {
             $data['carpar']['tempat']='<input type="radio" name="tempat" value="Internal" checked> Internal &nbsp;<input type="radio" name="tempat" value="User/ Keluhan pelanggan"> User/ Keluhan pelanggan';   
            }else{
             $data['carpar']['tempat']='<input type="radio" name="tempat" value="Internal"> Internal &nbsp;<input type="radio" name="tempat" value="User/ Keluhan pelanggan"> User/ Keluhan pelanggan';   
            }
            
            $this->template->display('carpar/edit',$data);
	}else{
            $carpar = array(
                'tempat'=>$this->input->post('tempat'),
                'nama_program'=>$this->input->post('nama_program'),
                'kode_program'=>$this->input->post('kode_program'),
                'email_pic'=>$this->input->post('email_pic'),
                'temuan'=>$this->input->post('temuan'),
                'analisa'=>$this->input->post('analisa'),
                'penyelidikan'=>$this->input->post('penyelidikan'),
                'update_date'=>date('Y-m-d G:i:s')
            );
            $this->mdl_carpar->update($id,$carpar);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Memo baru berhasil di ubah</div>');
	    redirect('carpar/index');
        }

    }
    
function tindakan($id) {
  
$data['title']='Tindakan CAR/PAR';
$data['action']='carpar/tindakan/'.$id;
$this->update_status_carpar_log($id);
$this->_set_rules_tindakan();
if ($this->form_validation->run()==FALSE) {
$q=$this->mdl_carpar->get_carpar_log_by_id($id)->result_array();
$tindakan='';
$file_tindakan='';
$verifikasi='';
foreach ($q as $row) {
    if (!empty($row['tindakan'])) {
        $tindakan.=$row['tindakan'].'<br>'.$row['date_tindakan'].'<hr>';
    }
    
    if (!empty($row['file_evidence'])) {
        $file_tindakan.=anchor('../plc/assets/uploads/file_carpar/'.$row['file_evidence'], 'Download', array('class'=>'label label-success')).'&nbsp'.$row['date_tindakan'].'<hr>';
    }
    
    if ($row['verifikasi']==2) {
        $verifikasi.='<tr><td>'.$row['date_verifikasi'].'</td><td></td><td>'.$row['ket_verifikasi'].'</td></tr>';
    }    
}

$data['no_report']= $id;
$data['tempat']=  $this->mdl_carpar->get_by_id($id)->row()->tempat;
$data['nama_program']=  $this->mdl_carpar->get_by_id($id)->row()->nama_program;
$data['kode_program']=  $this->mdl_carpar->get_by_id($id)->row()->kode_program;
$data['temuan']=  $this->mdl_carpar->get_by_id($id)->row()->temuan;
$data['analisa']=  $this->mdl_carpar->get_by_id($id)->row()->analisa;
$data['penyelidikan']=  $this->mdl_carpar->get_by_id($id)->row()->penyelidikan;
if (empty($this->mdl_carpar->get_by_id($id)->row()->tgl_target_penyelesaian)) {
$data['target']='<input type="text" name="target" id="tindakan">';    
}  else {
$data['target']=  $this->editor->date_correct($this->mdl_carpar->get_by_id($id)->row()->tgl_target_penyelesaian);    
}

$data['tindakan']= $tindakan;
$data['verifikasi']= $verifikasi;
$data['file_tindakan']=$file_tindakan;
$this->template->display('carpar/tindakan',$data);

    
} else {
                $this->upload->initialize(array(
                'upload_path' => './assets/uploads/file_carpar/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            if(!$this->upload->do_upload('file_tindakan'))
            {
                $data_file='';
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $data_file=$unggah['file_name'];
            }
            
    $tindakan=array(
    'id_carpar'=>$id,
    'tindakan'=>  $this->input->post('tindakan'),    
    'file_evidence'=> $data_file,
    'date_tindakan'=> date('Y-m-d G:i:s'),
    'insert_date'=> date('Y-m-d G:i:s'),
    'status'=> 1
);

    if (empty($this->mdl_carpar->get_by_id($id)->row()->tgl_target_penyelesaian)) {
$target=array(
    'tgl_target_penyelesaian'=>  $this->input->post('target')
);
$this->mdl_carpar->update($id,$target);
}
$this->mdl_carpar->add_carpar_log($tindakan);
$this->sendmail_user($id);
}    
    }
    
    function _set_rules_tindakan() {
        $this->form_validation->set_rules('tindakan','tindakan','required|trim');
    }
    
        function delete($id)
    {
        $this->mdl_carpar->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success"">data berhasil dihapus</div>');
        redirect('carpar/index');
    }
    
    
    }