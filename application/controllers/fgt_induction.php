<?php
/**
 * Description of memo
 *
 * @author Administrator
 */
class Fgt_induction extends Member_Controller{
    //put your code here
    private $limit=15;
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_fgt_induction');
        $this->load->model('mdl_pelatihan');
        $this->load->model('mdl_trainer');
        $this->load->model('mdl_provider');
        $this->load->model('mdl_observer');
        $this->load->model('mdl_sarfas');
        $this->load->model('mdl_libur');
        $this->load->model('mdl_peserta_induction');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));

    }
    
    function index($offset=0,$dat=0){
        $this->get_index($offset,$dat);
    }

    protected function get_index($offset,$dat)
    {
	//$data['title']='Progress Pelatihan Bulan '. $this->conv_bulan(date("M"));
        $data['title']='Progress Pelatihan';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
       
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $q=$this->mdl_fgt_induction->get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai)->result_array();
        
	$data['pagination']='';
        
        $data['refresh']=anchor('fgt_induction', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info')); 

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    'Mulai',
                    'Selesai',
                    'Kota',
                    'Tempat',
                    'PLAN',
                    'DO',
                    'CHECK',
                    'ACTION'
		);
        	
                
	
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status_plan=  $this->cek_plan($row['id']);
           $status_do=$this->cek_do($row['id']);
           $status_action=  $this->cek_action($row['id']);
           $status_check=  $this->cek_check($row['id']);
           $this->table->add_row(
		    ++$i,
                    $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat'],
                    $status_plan,
                    $status_do,
                   $status_check,
                   $status_action
		    );
	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
	$data['content']=$this->table->generate();
        $data['action']='fgt_induction/index/0/1';
        
        $this->template->display('fgt_induction/index_view',$data);
    }

    function plan($offset=0) {
	$data['title']='PLAN';
        $data['refresh']=anchor('fgt_induction/plan', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info')); 
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
	/* Pagination */
	$config['base_url']=site_url('fgt_induction/plan/');
	$config['total_rows']=$this->mdl_fgt_induction->count_plan($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_plan($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    array('data'=>'Tanggal','colspan'=>2),
                    array('data'=>'Lokasi','colspan'=>2),
                    'Status'
		);
        	$this->table->add_row(
		    array('data'=>'','colspan'=>4),                    
		    'Mulai',
                    'Akhir',
                    'Kota',
                    'Tempat',
                    array('data'=>'')
		);
                
	$q=$this->mdl_fgt_induction->get_plan($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_plan($row['id']);
            
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat'],
                    $status
		    );
	}
        
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['tambah']=  anchor('fgt_induction/add_plan', 'Tambah', array('class'=>'btn btn-success'));
        $data['content']='<br><br>'.$data['tambah'].'<br>'.$this->table->generate();
        $data['action']='fgt_induction/plan';
        
        $this->template->display('fgt_induction/index',$data);
    }   
         function add_plan() {
        $data['title']='Tambah Plan Induction';
        $data['action']='fgt_induction/add_plan';
        $this->__set_rules_add_plan();
        if ($this->form_validation->run()==FALSE) {
            $cat_list=$this->mdl_fgt_induction->get_pic()->result();
	    $data['pic']='';
	    foreach ($cat_list as $list)
	    {
		$data['pic'].='<option value="'.ucwords(strtolower($list->nama)).'">'.ucwords(strtolower($list->nama)).'</option>';
	    }
            
            $this->template->display('fgt_induction/add_plan',$data);
        }  else {
        
     $last_record= $this->mdl_fgt_induction->get_last_record();
     if (empty($last_record)){
         $last_record=1;
     }  else {
     $last_record++;    
     }
     
     $tahun=  date('Y');
     $kd_tiket=$last_record.'/IND/'.$tahun;
     $reference=  $this->input->post('ref_user').'#'.  $this->input->post('ref_memo').'#'.  $this->input->post('ref_tgl');
     $reference_rec=  $this->input->post('ref_rec').'#'.  $this->input->post('ref_rec_memo').'#'.  $this->input->post('ref_rec_tgl');
     $batch=  $this->mdl_fgt_induction->count_batch($this->input->post('kd_pelatihan')); 
     $plan=array(
                    'kd_tiket'=>$kd_tiket,
                    'pic'=>  $this->input->post('pic'),
                    'kd_pelatihan'=>  $this->input->post('kd_pelatihan'),
                    'batch'=> $this->input->post('batch'),
                    'reference'=>  $reference,
                    'reference_rec'=>  $reference_rec,
                    'sifat'=> $this->input->post('sifat'),
                    'jml_min_peserta'=> $this->input->post('jml_min_peserta'),
                    'tgl_mulai'=>  $this->input->post('tgl_mulai'),
                    'tgl_selesai'=>  $this->input->post('tgl_selesai'),
                    'lokasi_kota'=> $this->input->post('lokasi_kota'),
                    'insert_date'=> date('Y-m-d G:i:s'),
                    'plan_user'=> $this->session->userdata('user_name')
                    
                );
                $this->mdl_fgt_induction->add($plan);
               redirect('fgt_induction/plan');
                
        }
        
    }
        
    function edit_plan($id) {
     $data['title']='Edit PLAN Induction';   
     $data['action']='fgt_induction/edit_plan/'.$id;
     $this->__set_rules_edit_plan();
     if ($this->form_validation->run()==FALSE){
          
                
           //Tabel Plan
           $data['plan']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
         if (empty($data['plan']['lokasi_kota'])){
             $data['kota']='<div id="null_kota">Tidak ada data kota</div>';             
         }else{
             $data['kota']="<div><input type='hidden' value='".$data['plan']['lokasi_kota']."' name='lokasi_kota'/>".$data['plan']['lokasi_kota']."<a href='#' class='remove_kota'><i class='icon-remove'></i></a></div>";
         }
         
         $opt_sifat=array(
             'Residential'=>'Residential',
             'Non Residential'=>'Non Residential'
         );
         
         $data['sifat']=  form_dropdown('sifat', $opt_sifat, $data['plan']['sifat']);
         
         $cat_list=$this->mdl_fgt_induction->get_pic()->result();
	    $data['pic']='';
	    foreach ($cat_list as $list)
	    {
                if($data['plan']['pic']==ucwords(strtolower($list->nama))){
                    $data['pic'].='<option value="'.ucwords(strtolower($list->nama)).'" selected="selected">'.ucwords(strtolower($list->nama)).'</option>';
                }else{
                    $data['pic'].='<option value="'.ucwords(strtolower($list->nama)).'" >'.ucwords(strtolower($list->nama)).'</option>';
                }
	    }
            
         $data['ref']=  explode('#', $data['plan']['reference']);
         $data['ref_rec']=  explode('#', $data['plan']['reference_rec']);
         $data['judul']=  $this->mdl_pelatihan->get_by_id($data['plan']['kd_pelatihan'])->row()->judul;
         $this->template->display('fgt_induction/edit_plan',$data);  
     }else{
  
      $reference=  $this->input->post('ref_user').'#'.  $this->input->post('ref_memo').'#'.  $this->input->post('ref_tgl');
      $reference_rec=  $this->input->post('ref_rec').'#'.  $this->input->post('ref_rec_memo').'#'.  $this->input->post('ref_rec_tgl');
                $plan=array(
                    'pic'=>  $this->input->post('pic'),
                    'batch'=>  $this->input->post('batch'),
                    'reference'=>  $reference,
                    'reference_rec'=>  $reference_rec,
                    'sifat'=> $this->input->post('sifat'),
                    'jml_min_peserta'=> $this->input->post('jml_min_peserta'),
                    'tgl_mulai'=>  $this->input->post('tgl_mulai'),
                    'tgl_selesai'=>  $this->input->post('tgl_selesai'),
                    'lokasi_kota'=> $this->input->post('lokasi_kota'),
                    'update_date'=> date('Y-m-d G:i:s'),
                    'plan_user'=> $this->session->userdata('user_name')
                    
                );
                $this->mdl_fgt_induction->update($id,$plan);
                
            
                redirect('fgt_induction/plan');
     }
     
    }
    
    
     function cek_sarfas($id) {
         if($this->mdl_fgt_induction->get_sarfas_by_pelatihan($id)->row()->status==1){
         $sarfas=anchor('fgt_induction/view_sarfas/'.$id,'Detail',array('class'=>'label label-success'));   
         }  else {
         $sarfas=anchor('fgt_induction/view_sarfas/'.$id,'Detail',array('class'=>'label label-warning'));    
         }   
         return $sarfas;
        }
    
    
    function delete_pengajar($id_pelatihan,$id_pengajar) {
        $this->mdl_fgt_induction->delete_pengajar($id_pengajar);
        redirect('fgt_induction/edit_plan/'.$id_pelatihan);
        
    }
    
    function delete_observer($id_pelatihan,$id_observer) {
        $this->mdl_fgt_induction->delete_observer($id_observer);
        redirect('fgt_induction/edit_do/'.$id_pelatihan);
    }
       
    function list_do($offset=0) {
	$data['title']='DO';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
	/* Pagination */
	$config['base_url']=site_url('fgt_induction/list_do/');
	$config['total_rows']=$this->mdl_fgt_induction->count_do($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_do($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['refresh']=anchor('fgt_induction/list_do', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info'));
	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    array('data'=>'Tanggal','colspan'=>2),
                    array('data'=>'Lokasi','colspan'=>2),
                    'Status'
		);
        	$this->table->add_row(
		    array('data'=>'','colspan'=>4),                    
		    'Mulai',
                    'Akhir',
                    'Kota',
                    'Tempat',
                    ''
		);
                
	$q=$this->mdl_fgt_induction->get_do($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_do($row['id']);            
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat'],
                    $status
		    );
           
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $data['action']='fgt_induction/list_do';
        $this->template->display('fgt_induction/index',$data);
    }
    
    function edit_do($id) {
        $data['action']='fgt_induction/edit_do/'.$id;
        $data['title']='DO';
        $this->__set_rules_edit_do();
        if ($this->form_validation->run()==FALSE) {
      $data['do']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();  
      if (!empty($data['do']['memo_panggilan_peserta'])){
          $memo_panggilan_peserta=  explode('#', $data['do']['memo_panggilan_peserta']);
          $data['no_memo_peserta']=$memo_panggilan_peserta[0];
          $data['tgl_memo_peserta']=$memo_panggilan_peserta[1];
          
      }else{
          $data['no_memo_peserta']='';
          $data['tgl_memo_peserta']=''; 
      }
      
      if (!empty($data['do']['fax_panggilan_peserta'])){
          $fax_panggilan_peserta=  explode('#', $data['do']['fax_panggilan_peserta']);
          $data['no_fax_peserta']=$fax_panggilan_peserta[0];
          $data['tgl_fax_peserta']=$fax_panggilan_peserta[1];
          
      }else{
          $data['no_fax_peserta']='';
          $data['tgl_fax_peserta']=''; 
      }
      
      $this->template->display('fgt_induction/form_do',$data);
        } else {
            
        $do=array(
            'memo_panggilan_peserta'=> $this->cek_input($this->input->post('no_memo_peserta'), $this->input->post('tgl_memo_peserta')),
            'fax_panggilan_peserta'=> $this->cek_input($this->input->post('no_fax_peserta'),$this->input->post('tgl_fax_peserta')),
            'do_user'=> $this->session->userdata('user_name')
        ); 
        $this->mdl_fgt_induction->update($id,$do);            
         redirect('fgt_induction/list_do');
        }

    }
    
        function list_check($offset=0) {
	$data['title']='CHECK PESERTA';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
	/* Pagination */
	$config['base_url']=site_url('fgt_induction/list_check/');
	$config['total_rows']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['action']='fgt_induction/list_check';
        $data['refresh']=anchor('fgt_induction/list_check', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info')); 

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    array('data'=>'Tanggal','colspan'=>2),
                    array('data'=>'Peserta','colspan'=>3),
                    'Rek'
		);
        	$this->table->add_row(
		    array('data'=>'','colspan'=>4),                    
		    'Mulai',
                    'Akhir',               
                    'Undangan',
                    'Konfirmasi',
                    'Hadir',
                    array('data'=>'','colspan'=>3)
		);
                
	$q=$this->mdl_fgt_induction->get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_check($row['id']);   
           
            if ($this->mdl_peserta_induction->count_all($row['id'])<=0) {
            $jml_peserta=anchor('peserta_induction/view/'.$row['id'],$this->mdl_peserta_induction->count_all($row['id']).' Orang');
            $konfirmasi=0;
            $hadir=0;
            
            }  else {
            $jml_peserta=anchor('peserta_induction/view/'.$row['id'],$this->mdl_peserta_induction->count_all($row['id']).' Orang'); 
            $konfirmasi=  $this->mdl_peserta_induction->count_all_konfirmasi($row['id']).' Orang';
            $hadir=  $this->mdl_peserta_induction->count_all_hadir($row['id']).' Orang';
            }
            
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $jml_peserta,
                    $konfirmasi,
                   $hadir,
                    $status
		    );
           
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $this->template->display('fgt_induction/index_view',$data);
    }
    
    function send_mail_ls($id) {
        $pelatihan=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
        $subject= 'Kebutuhan Sarana Untuk Pelatihan '.$this->mdl_pelatihan->get_by_id($pelatihan['kd_pelatihan'])->row()->judul.'  '.$pelatihan['batch'];
        $body='No Tiket :'.$pelatihan['kd_tiket'].' untuk kebutuhan sarana seperti pada tautan berikut : '. base_url().'fgt_induction/view_sarfas/'.$id; 
        header('Location: mailto:sriyono@pertamina.com?body='.$body.'&subject='.$subject);
        $this->plan();
    }
    
    
        function list_action($offset=0) {
	$data['title']='ACTION';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
	/* Pagination */
	$config['base_url']=site_url('fgt_induction/list_action/');
	$config['total_rows']=$this->mdl_fgt_induction->count_action($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_action($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['refresh']=anchor('fgt_induction/list_action', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info'));
	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    array('data'=>'Tanggal','colspan'=>2),
                    array('data'=>'Lokasi','colspan'=>2),
                    'Sarfas','status'
		);
        	$this->table->add_row(
		    array('data'=>'','colspan'=>4),                    
		    'Mulai',
                    'Akhir',
                    'Kota',
                    'Tempat','',''
		);
                
	$q=$this->mdl_fgt_induction->get_action($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_action($row['id']);   
           if ($row['action_status']==1){
               $pembatalan='';
           }else{
               $pembatalan=  anchor('fgt_induction/action_batal/'.$row['id'], 'Batalkan', array('class'=>'btn btn-mini btn-danger'));
           }
            
            if ($this->mdl_fgt_induction->count_sarfas($row['id'])<=0) {
            $sarfas=  anchor('fgt_induction/add_sarfas/'.$row['id'], 'Tambah', array('class'=>'label label-important'));
            }  else {
            $sarfas=$this->cek_sarfas($row['id']);                
            }
            
            if (empty($row['tempat'])){
                $tempat=  anchor('fgt_induction/tempat/'.$row['id'],'Tambah', array('class'=>'label label-important'));
            }  else {
                $tempat=  anchor('fgt_induction/tempat/'.$row['id'], $row['tempat'], array('class'=>'label label-info'));
            }
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $tempat,
                   $sarfas,
                    $status.'&nbsp;'.$pembatalan
		    );
           
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $data['action']='fgt_induction/list_action';
        $this->template->display('fgt_induction/index',$data);
    }
    
        function edit_action($id) {
        $data['act']='fgt_induction/edit_action/'.$id;
        $data['title']='ACTION';
        $this->__set_rules_edit_action();
        if ($this->form_validation->run()==FALSE) {
      $data['action']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();  
      
      $data['provider']='';
         // Tabel Biaya Provider
              $provider=  $this->mdl_fgt_induction->get_provider_by_pelatihan($id);
              if ($provider<= 0) {
                    $data['provider'] = '<div id="null_provider">Tidak ada data provider</div>';
                } else {                  
                        $tbl_provider = $this->mdl_fgt_induction->get_biaya_provider($id)->row();
                        $data['provider'].=$this->mdl_provider->get_by_id($tbl_provider->id_provider)->row()->name.'<br>';
                        
                }
                
                  // Tabel Biaya Pengajar
              $pengajar=  $this->mdl_fgt_induction->get_pengajar_by_pelatihan($id);
              if ($pengajar<= 0) {
                    $data['pengajar'] = '<tr id="null_pengajar"><td colspan="3">Tidak ada data pengajar</td></tr>';
                } else {                  
                        $tbl_pengajar = $this->mdl_fgt_induction->get_biaya_pengajar($id)->result_array();
                        $data['pengajar']='';
                        foreach ($tbl_pengajar as $row) {
                    $data['pengajar'].='<tr><td>'.anchor('trainer/detail/'.$row['id_pengajar'],$this->mdl_trainer->get_by_id($row['id_pengajar'])->row()->name, array('target'=>'_blank')).'</td><td>'.$row['jml_sesi'].'</td><td>'.$row['honor_sesi'].'</td><td>'.  anchor('fgt_induction/delete_pengajar/'.$id.'/'.$row['id'], 'Hapus').'</td></tr>';        
                        }
                    
                }   
      
      if (!empty($data['action']['cetak_sertifikat'])){
          $cetak_sertifikat=  explode('#', $data['action']['cetak_sertifikat']);
          $data['no_sertifikat']=$cetak_sertifikat[0];
          $data['tgl_sertifikat']=$cetak_sertifikat[1];
          
      }else{
          $data['no_sertifikat']='';
          $data['tgl_sertifikat']=''; 
      }
      
      if (!empty($data['action']['invoice_diterima'])){
          $invoice_diterima=  explode('#', $data['action']['invoice_diterima']);
          $data['no_invoice_diterima']=$invoice_diterima[0];
          $data['tgl_invoice_diterima']=$invoice_diterima[1];
          
      }else{
          $data['no_invoice_diterima']='';
          $data['tgl_invoice_diterima']=''; 
      }
      
      if (!empty($data['action']['invoice_dikirim'])){
          $invoice_dikirim=  explode('#', $data['action']['invoice_dikirim']);
          $data['no_invoice_dikirim']=$invoice_dikirim[0];
          $data['tgl_invoice_dikirim']=$invoice_dikirim[1];
          
      }else{
          $data['no_invoice_dikirim']='';
          $data['tgl_invoice_dikirim']=''; 
      }
      
      if (!empty($data['action']['memo_pembayaran_honor'])){
          $memo_pembayaran_honor=  explode('#', $data['action']['memo_pembayaran_honor']);
          $data['no_memo_honor']=$memo_pembayaran_honor[0];
          $data['tgl_memo_honor']=$memo_pembayaran_honor[1];
          
      }else{
          $data['no_memo_honor']='';
          $data['tgl_memo_honor']=''; 
      }
      
      
        if (!empty($data['action']['memo_bantuan_mengajar'])){
          $memo_bantuan_mengajar=  explode('#', $data['action']['memo_bantuan_mengajar']);
          $data['no_memo_mengajar']=$memo_bantuan_mengajar[0];
          $data['tgl_memo_mengajar']=$memo_bantuan_mengajar[1];
          
      }else{
          $data['no_memo_mengajar']='';
          $data['tgl_memo_mengajar']=''; 
      }
      
        if (!empty($data['action']['fax_bantuan_mengajar'])){
          $fax_bantuan_mengajar=  explode('#', $data['action']['fax_bantuan_mengajar']);
          $data['no_fax_mengajar']=$fax_bantuan_mengajar[0];
          $data['tgl_fax_mengajar']=$fax_bantuan_mengajar[1];
          
      }else{
          $data['no_fax_mengajar']='';
          $data['tgl_fax_mengajar']=''; 
      }
      
      if (!empty($data['action']['surat_bantuan_mengajar'])){
          $surat_bantuan_mengajar=  explode('#', $data['action']['surat_bantuan_mengajar']);
          $data['no_surat_mengajar']=$surat_bantuan_mengajar[0];
          $data['tgl_surat_mengajar']=$surat_bantuan_mengajar[1];
          
      }else{
          $data['no_surat_mengajar']='';
          $data['tgl_surat_mengajar']=''; 
      }

      if (!empty($data['action']['spk'])){
          $spk=  explode('#', $data['action']['spk']);
          $data['no_spk']=$spk[0];
          $data['tgl_spk']=$spk[1];
          
      }else{
          $data['no_spk']='';
          $data['tgl_spk']=''; 
      }
      
      $this->template->display('fgt_induction/form_action',$data);
        } else {
            
      $provider=  $this->mdl_fgt_induction->get_provider_by_pelatihan($id);
      if ($provider<=0){
      if ($this->input->post('provider')!=''){
      $prov=array(
          'id_provider'=>  $this->input->post('provider'),
          'id_fgt_induction'=>  $id,
          'ket'=>  $this->input->post('ket'),
          'harga_penawaran'=>  $this->input->post('harga_penawaran'),
          'harga_negosiasi'=>  $this->input->post('harga_negosiasi'),
          'jml_peserta'=>  $this->input->post('jml_peserta'),
          'harga_tambahan_peserta'=>  $this->input->post('harga_tambahan_peserta'),
          'ket2'=>  $this->input->post('ket2'),
          'harga_penawaran2'=>  $this->input->post('harga_penawaran2'),
          'harga_negosiasi2'=>  $this->input->post('harga_negosiasi2'),
          'jml_peserta2'=>  $this->input->post('jml_peserta2'),
          'harga_tambahan_peserta2'=>  $this->input->post('harga_tambahan_peserta2'),
          'ket3'=>  $this->input->post('ket3'),
          'harga_penawaran3'=>  $this->input->post('harga_penawaran3'),
          'harga_negosiasi3'=>  $this->input->post('harga_negosiasi3'),
          'jml_peserta3'=>  $this->input->post('jml_peserta3'),
          'harga_tambahan_peserta3'=>  $this->input->post('harga_tambahan_peserta3'),
          'insert_date'=>  date('Y-m-d G:i:s'),
          'user'=> $this->session->userdata('user_name')
      );
      $this->mdl_fgt_induction->add_biaya_provider($prov);          
      }
  }else{
      $prov=array(
          'id_provider'=>  $this->input->post('provider'),
          'id_fgt_induction'=>  $id,
          'ket'=>  $this->input->post('ket'),
          'harga_penawaran'=>  $this->input->post('harga_penawaran'),
          'harga_negosiasi'=>  $this->input->post('harga_negosiasi'),
          'jml_peserta'=>  $this->input->post('jml_peserta'),
          'harga_tambahan_peserta'=>  $this->input->post('harga_tambahan_peserta'),
          'ket2'=>  $this->input->post('ket2'),
                    'harga_penawaran2'=>  $this->input->post('harga_penawaran2'),
                    'harga_negosiasi2'=>  $this->input->post('harga_negosiasi2'),
                    'jml_peserta2'=>  $this->input->post('jml_peserta2'),
                    'harga_tambahan_peserta2'=>  $this->input->post('harga_tambahan_peserta2'),
                    'ket3'=>  $this->input->post('ket3'),
                    'harga_penawaran3'=>  $this->input->post('harga_penawaran3'),
                    'harga_negosiasi3'=>  $this->input->post('harga_negosiasi3'),
                    'jml_peserta3'=>  $this->input->post('jml_peserta3'),
                    'harga_tambahan_peserta3'=>  $this->input->post('harga_tambahan_peserta3'),
          'update_date'=>  date('Y-m-d G:i:s'),
          'user'=> $this->session->userdata('user_name')
      );
      $this->mdl_fgt_induction->update_biaya_provider($id,$prov);
  }
  
      $pengajar=  $this->input->post('pengajar');
                if (!empty($pengajar)) {
                $jml_sesi=  $this->input->post('jml_sesi');
                $honor_sesi=  $this->input->post('honor_sesi');
                for ($a=0;$a<count($pengajar);$a++){
                $biaya_pengajar=array(
                    'id_pengajar'=>$pengajar[$a],
                    'id_fgt_induction'=>$id,
                    'jml_sesi'=>$jml_sesi[$a],
                    'honor_sesi'=>$honor_sesi[$a],
                    'insert_date'=>  date('Y-m-d G:i:s'),
                    'user'=> $this->session->userdata('user_name')
                );
                $this->mdl_fgt_induction->add_biaya_pengajar($biaya_pengajar);
                 }                 
                }
            
        $action=array(
            'memo_bantuan_mengajar'=> $this->cek_input($this->input->post('no_memo_mengajar'),$this->input->post('tgl_memo_mengajar')),
            'fax_bantuan_mengajar'=> $this->cek_input($this->input->post('no_fax_mengajar'),$this->input->post('tgl_fax_mengajar')),
            'surat_bantuan_mengajar'=> $this->cek_input($this->input->post('no_surat_mengajar'),$this->input->post('tgl_surat_mengajar')),
            'spk'=> $this->cek_input($this->input->post('no_spk'),$this->input->post('tgl_spk')),
            'cetak_sertifikat'=> $this->cek_input($this->input->post('no_sertifikat'), $this->input->post('tgl_sertifikat')),
            'invoice_diterima'=> $this->cek_input($this->input->post('no_invoice_diterima'), $this->input->post('tgl_invoice_diterima')),
            'invoice_dikirim'=> $this->cek_input($this->input->post('no_invoice_dikirim'), $this->input->post('tgl_invoice_dikirim')),
            'memo_pembayaran_honor'=> $this->cek_input($this->input->post('no_memo_honor'), $this->input->post('tgl_memo_honor')),
            'action_user'=> $this->session->userdata('user_name')
        ); 
        $this->mdl_fgt_induction->update($id,$action);        
       
  redirect('fgt_induction/list_action');
        }
    }
    
    
    function cek_input($no,$tgl) {
        if (!empty($no)){
            $inputan=$no.'#'.$tgl;
        }else{
            $inputan='';
        }
        return $inputan;
    }
    
        function cek_output($var) {
        if (!empty($var)){
            $cek=  explode('#', $var);
            $output='No : '.$cek[0].'<br> Tanggal : '.$this->editor->date_correct($cek[1]);
        }else{
            $output='';
        }
        return $output;
    }
    
        function action_batal($id) {
        $data['act']='fgt_induction/action_batal/'.$id;
        $data['title']='Pembatalan Training';
        $this->__set_rules_batal_action();
        if ($this->form_validation->run()==FALSE) {
        $data['batal']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();        
        $this->template->display('fgt_induction/form_batal',$data);
        } else {
        $data['btl']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
        $batal=array(
                'id_fgt_induction'=>$data['btl']['id'],
                'kd_tiket'=>$data['btl']['kd_tiket'],
                'pic'=>$data['btl']['pic'],
                'kd_pelatihan'=>$data['btl']['kd_pelatihan'],
                'batch'=>$data['btl']['batch'],
                'reference'=>$data['btl']['reference'],
                'sifat'=>$data['btl']['sifat'],
                'jml_min_peserta'=>$data['btl']['jml_min_peserta'],
                'tgl_mulai'=>$data['btl']['tgl_mulai'],
                'tgl_selesai'=>$data['btl']['tgl_selesai'],
                'lokasi_kota'=>$data['btl']['lokasi_kota'],
                'tempat'=>$data['btl']['tempat'],
                'ruangan'=>$data['btl']['ruangan'],
                'memo_bantuan_mengajar'=>$data['btl']['memo_bantuan_mengajar'],
                'fax_bantuan_mengajar'=>$data['btl']['fax_bantuan_mengajar'],
                'surat_bantuan_mengajar'=>$data['btl']['surat_bantuan_mengajar'],
                'memo_panggilan_peserta'=>$data['btl']['memo_panggilan_peserta'],
                'fax_panggilan_peserta'=>$data['btl']['fax_panggilan_peserta'],
                'spk'=>$data['btl']['spk'],
                'memo_pembatalan_training'=>$this->input->post('no_memo_batal').'#'.$this->input->post('tgl_memo_batal'),
                'fax_pembatalan_training'=>  $this->input->post('no_fax_batal').'#'.$this->input->post('tgl_fax_batal'),
                'memo_pembatalan_pengajar'=>  $this->input->post('no_memo_mengajar').'#'.$this->input->post('tgl_memo_mengajar'),
                'fax_pembatalan_pengajar'=>  $this->input->post('no_fax_mengajar').'#'.$this->input->post('tgl_fax_mengajar'),
                'invoice_diterima'=>  $this->input->post('no_spk').'#'.$this->input->post('tgl_spk'),
                'invoice_dikirim'=>  $this->input->post('no_invoice_dikirim').'#'.$this->input->post('tgl_invoice_dikirim'),
                'user'=> $this->session->userdata('user_name')
            );
        $this->mdl_fgt_induction->add_pelatihan_batal($batal);        
        $this->mdl_fgt_induction->delete($id);
        redirect('fgt_induction/list_canceled');
        }
    }
    
        function list_result($offset=0) {
	$data['title']='RESULT';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	$kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
        /* Pagination */
        
	$config['base_url']=site_url('fgt_induction/list_result/');
	$config['total_rows']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['action']='fgt_induction/list_result';
        $data['refresh']=anchor('fgt_induction/list_result', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info')); 
        
	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    array('data'=>'Tanggal','colspan'=>2),
                    array('data'=>'Lokasi','colspan'=>2),
                'status',
                'SLA Pengajar',
                'SLA Peserta'
		);
        	$this->table->add_row(
		    array('data'=>'','colspan'=>4),                    
		    'Mulai',
                    'Akhir',
                    'Kota',
                    'Tempat',
                    array('data'=>'','colspan'=>6)
		);
                
	$q=$this->mdl_fgt_induction->get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_result($row['id']);   

           


$jml_hadir=  $this->mdl_peserta_induction->cek_kehadiran($row['id'],1);           
$or=($jml_hadir/10)*100;

if ($this->mdl_fgt_induction->get_biaya_provider($row['id'])->num_rows()>0){
    $provider=  $this->mdl_fgt_induction->get_biaya_provider($row['id'])->row_array();
$harga_penawaran=($provider['harga_penawaran']+$provider['harga_penawaran2']+$provider['harga_penawaran3']);
$harga_negosiasi=($provider['harga_negosiasi']+$provider['harga_negosiasi2']+$provider['harga_negosiasi3']);
    $ce=(($harga_penawaran-$harga_negosiasi)/$harga_penawaran)*100;    

}else{
    $ce=0;
}


if (empty($row['tgl_mulai']) || empty($row['memo_bantuan_mengajar'])){
$sla_pengajar='0'; 
}else{
$memo_bantuan_mengajar=  explode("#", $row['memo_bantuan_mengajar']);
$sla=$this->sla($row['tgl_mulai'],$memo_bantuan_mengajar[1]); 
$sla_pengajar=$sla/5;
}
 
if (empty($row['tgl_mulai']) || empty($row['memo_panggilan_peserta'])){
$sla_peserta='0'; 
}else{
$memo_panggilan_peserta=  explode("#", $row['memo_panggilan_peserta']);
$sla=$this->sla($row['tgl_mulai'],$memo_panggilan_peserta[1]); 
$sla_peserta=$sla/8;
}
 
        
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat'],
                    $status,
                    $sla_pengajar.' %',
                    $sla_peserta.' %'
		    );
           
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $this->template->display('fgt_induction/index_view',$data);
    }
    
        function list_report($offset=0) {
	$data['title']='Report';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
	/* Pagination */
	$config['base_url']=site_url('fgt_induction/list_report/');
	$config['total_rows']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['action']='fgt_induction/list_report';
        $data['refresh']=anchor('fgt_induction/list_report', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info')); 

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    array('data'=>'Tanggal','colspan'=>2),
                    array('data'=>'Lokasi','colspan'=>2),
                    'Status'
		);
        	$this->table->add_row(
		    array('data'=>'','colspan'=>4),                    
		    'Mulai',
                    'Akhir',
                    'Kota',
                    'Tempat',
                    array('data'=>'','colspan'=>3)
		);
                
	$q=$this->mdl_fgt_induction->get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_result($row['id']);   
           $detail=  anchor('fgt_induction/detail/'.$row['id'], '<i class="icon icon-zoom-in icon-white"></i>Detail', array('class'=>'label label-info'));
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat'],
                    $status.' '.$detail
		    );
           
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $this->template->display('fgt_induction/index_view',$data);
    }
    
    
        function list_canceled($offset=0) {
	$data['title']='Pembatalan Pelatihan';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
	/* Pagination */
	$config['base_url']=site_url('fgt_induction/list_canceled/');
	$config['total_rows']=$this->mdl_fgt_induction->count_all_view_canceled($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_all_view_canceled($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['action']='fgt_induction/list_report';
        $data['refresh']=anchor('fgt_induction/list_report', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info')); 

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    array('data'=>'Tanggal','colspan'=>2),
                    array('data'=>'Lokasi','colspan'=>2),
                    'Status'
		);
        	$this->table->add_row(
		    array('data'=>'','colspan'=>4),                    
		    'Mulai',
                    'Akhir',
                    'Kota',
                    'Tempat',
                    array('data'=>'','colspan'=>3)
		);
                
	$q=$this->mdl_fgt_induction->get_index_canceled($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_result($row['id']);   
           $detail=  anchor('fgt_induction/detail/'.$row['id'], '<i class="icon icon-zoom-in icon-white"></i>Detail', array('class'=>'label label-info'));
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat'],
                    $status.' '.$detail
		    );
           
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $this->template->display('fgt_induction/index_view',$data);
    }
    
    function list_support($offset=0) {
	$data['title']='Support';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket'); 
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');
        
	/* Pagination */
	$config['base_url']=site_url('fgt_induction/list_support/');
	$config['total_rows']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_induction->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['action']='fgt_induction/list_support';
        $data['refresh']=anchor('fgt_induction/list_support', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info')); 


	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'PIC',
		    array('data'=>'Tanggal','colspan'=>2),
                    array('data'=>'Lokasi','colspan'=>2),
                ''
		);
        	$this->table->add_row(
		    array('data'=>'','colspan'=>4),                    
		    'Mulai',
                    'Akhir',
                    'Kota',
                    'Tempat',
                    array('data'=>'','colspan'=>1)
		);
                
	$q=$this->mdl_fgt_induction->get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	     
           $detail=  anchor('fgt_induction/support/'.$row['id'], '<i class="icon icon-zoom-in icon-white"></i>Lihat', array('class'=>'label label-info'));
           $this->table->add_row(
		    ++$i,
                    $row['kd_tiket'],
                    $judul.' '.$row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat'],
                    $detail
		    );
           
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $this->template->display('fgt_induction/index_view',$data);
    }
    
    function support() {
        $data['title']='Template Support';
        
        /* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
        
            $q=  $this->mdl_fgt_induction->get_support()->result_array();        
            $i=0;
            foreach ($q as $row) {
                $this->table->add_row(
                        ++$i,
                        array('data'=>'<b>'.$row['title'].'</b><br>'.  anchor('fgt_induction/add_support/'.$row['id'], 'Ubah', array('class'=>'btn btn-success')),'colspan'=>2)
                        );
                    $this->table->add_row(
                            '',
                        array('data'=>$row['template'],'colspan'=>2)
                        );
            }
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $this->template->display('fgt_induction/support',$data);
    }
    
    function add_support($id=0) {
        $data['title']='Support';
        $data['action']='fgt_induction/add_support/'.$id;
        $this->__set_rule_add_support();
        if ($this->form_validation->run()==FALSE) {
            if ($id==0) {
                $data['judul']='';
            $data['template']='';
            }  else {
            $data['judul']=  $this->mdl_fgt_induction->get_support_by_id($id)->row()->title;
            $data['template']=$this->mdl_fgt_induction->get_support_by_id($id)->row()->template;    
            }
            
            $this->template->display('fgt_induction/add_support',$data);
        }  else {
            $support=array(
                'title'=>  $this->input->post('judul'),
                'template'=>  $this->input->post('template'),
                'insert_date'=> date('Y-m-d G:i:s'),
                'update_date'=> date('Y-m-d G:i:s')
            );
            if ($id==0) {
                $this->mdl_fgt_induction->add_support($support);
            }  else {
            $this->mdl_fgt_induction->update_support($id,$support);    
            }
            redirect('fgt_induction/support');
        }
    }
    
     function __set_rule_add_support() {
        $this->form_validation->set_rules('judul','Judul Template','required|trim');
    }
    
    function detail($id) {
        $data['title']='Detail Pelatihan';
        $data['detail']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
        $data['judul']=  $this->mdl_pelatihan->get_by_id($data['detail']['kd_pelatihan'])->row()->judul;
        if(!empty($data['detail']['reference'])){
            $data['ref']= explode('#', $data['detail']['reference']);
            $data['reference']='User : '.$data['ref'][0].'<br>No Ref : '.$data['ref'][1].'<br>Tanggal : '.$data['ref'][2];
        }else{
            $data['reference']='';
        }
        $data['memo_bantuan_mengajar']=  $this->cek_output($data['detail']['memo_bantuan_mengajar']);
        $data['fax_bantuan_mengajar']=  $this->cek_output($data['detail']['fax_bantuan_mengajar']);
        $data['surat_bantuan_mengajar']=  $this->cek_output($data['detail']['surat_bantuan_mengajar']);
        $data['memo_panggilan_peserta']=  $this->cek_output($data['detail']['memo_panggilan_peserta']);
        $data['fax_panggilan_peserta']=  $this->cek_output($data['detail']['fax_panggilan_peserta']);
        $data['spk']=  $this->cek_output($data['detail']['spk']);
        $data['cetak_sertifikat']=  $this->cek_output($data['detail']['cetak_sertifikat']);
        $data['invoice_diterima']=  $this->cek_output($data['detail']['invoice_diterima']);
        $data['invoice_dikirim']=  $this->cek_output($data['detail']['invoice_dikirim']);
        $data['memo_pembayaran_honor']=  $this->cek_output($data['detail']['memo_pembayaran_honor']);
        
        if ($this->mdl_fgt_induction->get_biaya_pengajar($id)->num_rows()>0){
        $peng=  $this->mdl_fgt_induction->get_biaya_pengajar($id)->result_array();
        $data['pengajar']='';
        foreach ($peng as $row) {
        $data['pengajar'].='<tr><th>Nama</th><th>Jml Sesi</th><th>Honor Per Sesi</th></tr>';
        $data['pengajar'].='<tr><td>'.$this->mdl_trainer->get_by_id($row['id_pengajar'])->row()->name.'</td><td>'.$row['jml_sesi'].'</td><td>'.$row['honor_sesi'].'</td></tr>';
        }
        }else{
        $data['pengajar']='Tidak Ada Pengajar';            
        }
        
        if ($this->mdl_fgt_induction->get_biaya_provider($id)->num_rows()>0){
        $prov=  $this->mdl_fgt_induction->get_biaya_provider($id)->result_array();
        $data['provider']='';
        foreach ($prov as $row) {
        $data['provider'].=$this->mdl_provider->get_by_id($row['id_provider'])->row()->name;    
        $data['provider'].='<table border="1"><tr><th>Ket</th><th>Harga Penawaran</th><th>Harga Negosiasi</th><th>Jumlah Peserta</th><th>Harga Tambahan Peserta</th></tr>';
       $data['provider'].='<tr><td>'.$row['ket'].'</td><td>'.  number_format($row['harga_penawaran'], 0, '', '.').'</td><td>'.  number_format($row['harga_negosiasi'], 0, '', '.').'</td><td>'.$row['jml_peserta'].'</td><td>'.  number_format($row['harga_tambahan_peserta'], 0, '', '.').'</td></tr>';
        $data['provider'].='<tr><td>'.$row['ket2'].'</td><td>'.  number_format($row['harga_penawaran2'], 0, '', '.').'</td><td>'.  number_format($row['harga_negosiasi2'], 0, '', '.').'</td><td>'.$row['jml_peserta2'].'</td><td>'.  number_format($row['harga_tambahan_peserta2'], 0, '', '.').'</td></tr>';
        $data['provider'].='<tr><td>'.$row['ket3'].'</td><td>'.  number_format($row['harga_penawaran3'], 0, '', '.').'</td><td>'.  number_format($row['harga_negosiasi3'], 0, '', '.').'</td><td>'.$row['jml_peserta3'].'</td><td>'.  number_format($row['harga_tambahan_peserta3'], 0, '', '.').'</td></tr>';
          $data['provider'].='<tr><td></td><td>'.number_format( ($row['harga_penawaran']+$row['harga_penawaran2']+$row['harga_penawaran3']), 0 , '' , '.' ).'</td><td>'.  number_format(($row['harga_negosiasi']+$row['harga_negosiasi2']+$row['harga_negosiasi3']), 0, '','.').'</td><td></td><td>'.  number_format(($row['harga_tambahan_peserta']+$row['harga_tambahan_peserta2']+$row['harga_tambahan_peserta3']), 0, '', '.').'</td></tr>';
        $data['provider'].='</table>';
        
        }
        }else{
        $data['provider']='Tidak Ada Provider';            
        }
           
      	   $data['status']=  $this->cek_result($id);   

$jml_hadir=  $this->mdl_peserta_induction->cek_kehadiran($id,1);           
$data['or']=($jml_hadir/10)*100;

if ($this->mdl_fgt_induction->get_biaya_provider($id)->num_rows()>0){
$provider=  $this->mdl_fgt_induction->get_biaya_provider($id)->row_array();
$harga_penawaran=($provider['harga_penawaran']+$provider['harga_penawaran2']+$provider['harga_penawaran3']);
$harga_negosiasi=($provider['harga_negosiasi']+$provider['harga_negosiasi2']+$provider['harga_negosiasi3']);
    $data['ce']=(($harga_penawaran-$harga_negosiasi)/$harga_penawaran)*100;    
}else{
    $data['ce']=0;
}


if (empty($data['detail']['invoice_dikirim']) || empty($data['detail']['reference'])){
$data['sla']='0'; 
}else{
$invoice_dikirim= explode("#", $data['detail']['invoice_dikirim']);
$ref=  explode("#", $data['detail']['reference']);
$data['sla']=$this->sla($ref[2],$invoice_dikirim[1]); 
}
      
        $this->template->display('fgt_induction/detail',$data);
    }
    
    function add_sarfas($id) {
        $data['title']='Kebutuhan Sarfas';
        $this->__set_rules_sarfas();
        
        if ($this->form_validation->run()==FALSE){
        $data['sarfas']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
        $data['judul']=  $this->mdl_pelatihan->get_by_id($data['sarfas']['kd_pelatihan'])->row()->judul;
        $data['jml_peserta']=$this->mdl_peserta_induction->count_all($data['sarfas']['id']);
        $data['action']='fgt_induction/add_sarfas/'.$id;
        
        $this->template->display('fgt_induction/add_sarfas',$data);    
        }else{
          $item_paket=  implode('<br>', $this->input->post('item_paket'));
          
          $type=  $this->input->post('type');
          $kelas=  $this->input->post('kelas');
          $jml=  $this->input->post('jml');
          $checkin=  $this->input->post('checkin');
          $checkout=  $this->input->post('checkout');
          $notes=  $this->input->post('notes');
          
          $ruangan='';
          for ($i=0;$i<count($type);$i++){
          $ruangan.='<b>Type : </b>'.$type[$i].'&nbsp;'.$kelas[$i].'&nbsp;<b>Jumlah : </b>'.$jml[$i].'&nbsp;<b>CheckIn : </b>'.$checkin[$i].'&nbsp;<b>CheckOut : </b>'.$checkout[$i].'&nbsp; <b>Notes : </b>'.$notes[$i].'<br>';    
          }
          
          
          if ($this->input->post('layout')=='other'){
              $layout=  $this->input->post('layout2');
          }else{
              $layout= $this->input->post('layout');
          }
         
          $sarfas=array(
             'id_fgt_induction'=>$id,
             'kd_tiket'=>$this->mdl_fgt_induction->get_by_id($id)->row()->kd_tiket,
             'jumlah'=>  $this->input->post('jml_paket'),
             'nama_paket'=>  $this->input->post('paket'),
             'item_paket'=>$item_paket,
             'layout'=>  $layout,
             'catatan_paket_meeting'=>  $this->input->post('catatan'),
             'ruangan'=>$ruangan,
             'special_request'=>  $this->input->post('special_request'),
             'status'=>0,
             'insert_date'=>  date('Y-m-d G:i:s'),
              'user'=> $this->session->userdata('user_name')
         );  
         
         
         $this->mdl_fgt_induction->add_sarfas($sarfas);
         redirect('fgt_induction/view_sarfas/'.$id);
        }
    }
    
       function view_sarfas($id) {
        $data['title']='Kebutuhan Sarfas';        
        $data['sarfas']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
        $data['detail']=  $this->mdl_fgt_induction->get_sarfas_by_pelatihan($id)->row_array();
        $data['judul']=  $this->mdl_pelatihan->get_by_id($data['sarfas']['kd_pelatihan'])->row()->judul;
        $data['jml_peserta']=$this->mdl_peserta_induction->count_all($data['sarfas']['id']);
        $data['kirim_email']=  anchor('fgt_induction/send_mail_ls/'.$id, '<i class="icon-envelope"></i>&nbsp;Kirim Email', array('class'=>'btn btn-warning'));
        
        $this->template->display('fgt_induction/view_sarfas',$data);    
        
    } 
    
    function __set_rules_sarfas() {
        $this->form_validation->set_rules('jml_paket','Jumlah Paket','required|trim');
    }
    
    
    function sla($tgl_awal,$tgl_ahir) {
        //---Start SLA
 
        $libur = $this->mdl_libur->get_libur()->result_array();
        $data_libur = '';
        foreach ($libur as $liburan) {
        $data_libur .= $liburan['date'] . '#';
        }
        $tgl_libur = explode('#', $data_libur);
        $sla = $this->editor->hitung_sla($tgl_awal, $tgl_ahir, $tgl_libur);
        return $sla;
    }
    
    function __set_rules_add_plan() {
        $this->form_validation->set_rules('kd_pelatihan','Judul','required|trim');
    }
    
        function __set_rules_edit_plan() {
        $this->form_validation->set_rules('pic','PIC','required|trim');
    }
    
    function __set_rules_edit_do() {
        $this->form_validation->set_rules('id_fgt_induction','ID Trans Pelatihan','required|trim');
    }    
    
    function __set_rules_edit_action() {
        $this->form_validation->set_rules('id_fgt_induction','ID Trans Pelatihan','required|trim');
    }    
    
    function __set_rules_batal_action() {
        $this->form_validation->set_rules('no_memo_batal','ID Trans Pelatihan','required|trim');
    }    
    
    function cek_plan($id) {
        $plan=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
        if (empty($plan['pic'])||empty($plan['kd_pelatihan'])||empty($plan['tgl_mulai'])||empty($plan['tgl_selesai'])||empty($plan['jml_min_peserta'])) {
        $status= anchor('fgt_induction/edit_plan/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));    
        $this->mdl_fgt_induction->update_plan_status($id,0);
        }else{
        $status= anchor('fgt_induction/edit_plan/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap'));    
        $this->mdl_fgt_induction->update_plan_status($id,1);  
        }
        return $status;
    }

function cek_do($id) {
        
 $plan=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
if ($this->mdl_fgt_induction->cek_biaya_provider($id)<=0){
$provider=0;
}else{
$provider=$this->mdl_fgt_induction->get_biaya_provider($id)->row()->id_provider;
}
        if (empty($plan['memo_panggilan_peserta']) && empty($plan['fax_panggilan_peserta'])) {
        $status= anchor('fgt_induction/edit_do/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-danger','rel'=>'tooltip','title'=>'Belum Di Isi'));    
        }else{
        $status=  anchor('fgt_induction/edit_do/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap'));                
        $this->mdl_fgt_induction->update_do_status($id,1);
        }
     return $status;
    }
    
    function cek_check($id) {
        $check=  $this->mdl_peserta_induction->cek_konfirmasi($id,1);
        if ($check>=10) {
            $rekomend=  anchor('peserta_induction/view/'.$id, '<i class="icon icon-bell">', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Konfirmasi Peserta Lebih dari 10 Orang'));             
        }elseif ($check<10) {
            $rekomend=  anchor('peserta_induction/view/'.$id, '<i class="icon icon-bell">', array('class'=>'btn btn-danger','rel'=>'tooltip','title'=>'Konfirmasi Peserta Kurang dari 10 Orang'));            
        }
        return $rekomend;
    }
    
        function cek_action($id) {
        $provider=  $this->mdl_fgt_induction->cek_biaya_provider($id);
        $plan=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
        if((empty($plan['cetak_sertifikat'])&& empty($plan['invoice_diterima']) && empty($plan['invoice_dikirim']) && empty($plan['memo_pembayaran_honor'])) || $provider<=0){
       $status= anchor('fgt_induction/edit_action/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-danger','rel'=>'tooltip','title'=>'Belum Di Isi'));                
        }else
        {
            switch ($this->mdl_fgt_induction->get_biaya_provider($id)->row()->id_provider) {
                case 661:
if (empty($plan['cetak_sertifikat'])||empty($plan['memo_pembayaran_honor'])) {
        $status= anchor('fgt_induction/edit_action/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));    
        $this->mdl_fgt_induction->update_action_status($id,0);
        }else{
        $status=  anchor('fgt_induction/edit_action/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap',));                
        $this->mdl_fgt_induction->update_action_status($id,1);        
        }
            break;

                default:
if (empty($plan['cetak_sertifikat'])||empty($plan['invoice_diterima'])||empty($plan['invoice_dikirim'])) {
        $status= anchor('fgt_induction/edit_action/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));    
        $this->mdl_fgt_induction->update_action_status($id,0);
        }else{
        $status=  anchor('fgt_induction/edit_action/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap',));                
        $this->mdl_fgt_induction->update_action_status($id,1);        
        }                    
                    break;
            }
        }
        return $status;
    }
    
  function cek_result($id) {
        $plan=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
 if ($plan['plan_status']==1 && $plan['do_status']==1 && $plan['action_status']==1){
     $status='<span class="label label-success">Selesai</span>';
 }else{
     $status='<span class="label label-warning">Belum Selesai</span>';     
 }
        return $status;
    }
    
    function _set_rules(){
	$this->form_validation->set_rules('subject','Judul','required|trim');

    }
    
function post_tempat($id) {
        
        if($this->input->post('tempat')==1){
            $dat=array(
            'tempat'=> 'PCU-Pertamina Corporate University',
            'ruangan'=>$this->input->post('ruangan')
        );
        $this->mdl_fgt_induction->update($id,$dat);
        }elseif ($this->input->post('tempat')==2) {
            $dat=array(
            'tempat'=> $this->input->post('tempat_lain'),
            'ruangan'=>$this->input->post('ruangan_lain')
        );
        $this->mdl_fgt_induction->update($id,$dat);
        }

        redirect('fgt_induction/list_action');
    }
    
    function tempat($id) {
        $data['title']='Tempat Pelatihan';       
        $data['sarfas']=  $this->mdl_fgt_induction->get_by_id($id)->row_array();
        $data['detail']=  $this->mdl_fgt_induction->get_sarfas_by_pelatihan($id)->row_array();
        $data['judul']=  $this->mdl_pelatihan->get_by_id($data['sarfas']['kd_pelatihan'])->row()->judul;
        $data['jml_peserta']=$this->mdl_peserta_induction->count_all($data['sarfas']['id']);       
        $data['action']='fgt_induction/post_tempat/'.$id;       
        $data['tempat']=  $this->cek_tempat($data['sarfas']['tempat']);
        $data['ruangan']=  $this->cek_tempat($data['sarfas']['ruangan']);
        $data['kota']=  $this->cek_tempat($data['sarfas']['lokasi_kota']);
         $opt_class=$this->mdl_sarfas->get_class();
            $data['options_class']='';
            foreach ($opt_class->result_array() as $row_class) {
                $data['options_class'].='<option value="'.$row_class['class_name'].'">'.$row_class['class_name'].'</option>';
            }
      
        $this->template->display('sarfas/tempat',$data);           
        
    }
    
      function cek_tempat($dat) {
        if (empty($dat)){
            $tmp='<span class="label label-important">Belum Dimasukan</span>';
        }  else {
        $tmp='<span class="label label-info">'.$dat.'</span>';    
        }
        return $tmp;
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
    
           function lookup_kota() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_sarfas->lookup_kota($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id' => $row['id'],
                    'value' => $row['nama']
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
    
       function lookup_provider() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_provider->lookup_provider($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id' => $row['id'],
                    'value' => $row['name']
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
 
           function lookup_cs() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_fgt_induction->lookup_cs($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id' => $row['id'],
                    'value' => $row['nama']
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
    
       function lookup_pengajar() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_trainer->lookup_pengajar($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id' => $row['id'],
                    'value' => $row['name']
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

?>