<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tugas_belajar
 *
 * @author adehermawan
 */
class tugas_belajar extends CI_Controller{
    //put your code here
    private $limit=10;
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mdl_tugas_belajar');
        $this->load->library(array('upload', 'session'));
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');

    }

    function index($offset=0) {
        $data['title']='Data Tugas Belajar';
        $this->load->library('pagination');

        // Pagination
        $config['base_url']=site_url('tugas_belajar/index/');
      	$config['total_rows']=$this->mdl_tugas_belajar->count_all();
      	$config['per_page']=$this->limit;
      	$config['uri_segment']=3;
      	$this->pagination->initialize($config);
      	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		 'No',
     'Nama',
		 'No Pekerja',
     'Universitas',
		 'Program - Jurusan',
		 'Masa Study',
     'SLA',
     'Data Pembayaran',
     'Alert Pembayaran',
     array('data'=>'Action','width'=>75)
		);


    $tb=$this->mdl_tugas_belajar->get_index($this->limit,$offset)->result_array();
    $i=0+$offset;

    foreach ($tb as $row) {
      $edit=  anchor('tugas_belajar/edit/'.$row['id'],'<i class="icon-wrench icon-white"></i>',array('class'=>'label label-info','rel'=>'tooltip','title'=>'Edit'));
      $detail=  anchor('tugas_belajar/detail/'.$row['id'],'<i class="icon-zoom-in icon-white"></i>',array('class'=>'label label-info','rel'=>'tooltip','title'=>'Detail'));
      $delete=  anchor('tugas_belajar/delete/'.$row['id'],'<i class="icon-trash icon-white"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','class'=>'label label-important','title'=>'Delete'));

        $this->table->add_row(
                ++$i,
                $row['nama'],
                $row['nopek'],
                $row['universitas'],
                $row['jurusan'],
                $this->editor->date_correct($row['masa_study_awal']).' s/d '.$this->editor->date_correct($row['masa_study_akhir']),
                '',
                '',
                '',
                $detail.' '.$edit.' '.$delete
                );

    }
           $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
    	    $data['content']=$this->table->generate();
           $this->template->display('tugas_belajar/index',$data);

    }

    function add() {
     $data['title']='Tambah Data Peserta Tugas Belajar';
     $data['link_back']=site_url('tugas_belajar/add');
     $data['action']='tugas_belajar/add';
     $this->__set_rules_tb();
     if ($this->form_validation->run()==FALSE) {
     $this->template->display('tugas_belajar/form_peserta',$data);
     }  else {

       $this->upload->initialize(array(
      'upload_path' => './assets/uploads/tugas_belajar/',
      'allowed_types' => '*',
      'max_size' => 5000, // 5MB
      'remove_spaces' => true,
      'overwrite' => false
  ));

  if(!$this->upload->do_upload('ijazah'))
  {
      $file_ijazah=$this->input->post('ijazah2');
  } else {
      $unggah = $this->upload->data();
      $unggah['file_name'];
      $file_ijazah=$unggah['file_name'];
  }
     $smt_no=implode('#',$this->input->post('smt_no'));
     $smt_ipk=implode('#',$this->input->post('smt_ipk'));

     $peserta = array(
       'nama' =>$this->input->post('nama'),
       'nopek'=>$this->input->post('nopek'),
       'keterangan'=>$this->input->post('keterangan'),
       'yudisium'=>$this->input->post('yudisium'),
       'awal_fungsi'=>$this->input->post('awal_fungsi'),
       'awal_jabatan'=>$this->input->post('awal_jabatan'),
       'skr_fungsi'=>$this->input->post('skr_fungsi'),
       'skr_jabatan'=>$this->input->post('skr_jabatan'),
       'tpa'=>$this->input->post('tpa'),
       'toefl'=>$this->input->post('toefl'),
       'psikotest'=>$this->input->post('psikotest'),
       'mcu'=>$this->input->post('mcu'),
       'program_tugas_belajar'=>$this->input->post('program_tugas_belajar'),
       'lokasi'=>$this->input->post('lokasi'),
       'jenjang_pendidikan'=>$this->input->post('jenjang_pendidikan'),
       'bidang_pendidikan'=>$this->input->post('bidang_pendidikan'),
       'jurusan'=>$this->input->post('jurusan'),
       'universitas'=>$this->input->post('universitas'),
       'email_pertamina'=>$this->input->post('email_pertamina'),
       'email_pribadi'=>$this->input->post('email_pribadi'),
       'alamat_indonesia'=>$this->input->post('alamat_indonesia'),
       'alamat_ln'=>$this->input->post('alamat_ln'),
       'paspor_no'=>$this->input->post('paspor_no'),
       'paspor_berlaku'=>$this->input->post('paspor_berlaku'),
       'no_telp_ln'=>$this->input->post('no_telp_ln'),
       'kontak_indonesia'=>$this->input->post('kontak_indonesia'),
       'cp_universitas'=>$this->input->post('cp_universitas'),
       'email_universitas'=>$this->input->post('email_universitas'),
       'masa_study_awal'=>$this->input->post('masa_study_awal'),
       'masa_study_akhir'=>$this->input->post('masa_study_akhir'),
       'status_keberangkatan'=>$this->input->post('status_keberangkatan'),
       'ket_lulus'=>$this->input->post('ket_lulus'),
       'ijazah'=>$file_ijazah,
       'smt_no'=>$smt_no,
       'smt_ipk'=>$smt_ipk,
       'ipk_akhir'=>$this->input->post('ipk_akhir'),
       'ipk'=>$this->input->post('ipk'),
       'start_date'=>date('Y-m-d G:i:s'),
       'update_date'=>date('Y-m-d G:i:s')
      );
      $this->mdl_tugas_belajar->add_peserta($peserta);
      redirect('tugas_belajar/index');
     }
    }

    function edit($id) {
     $data['title']='Edit Data Peserta Tugas Belajar';
     $data['link_back']=site_url('tugas_belajar/add_peserta');
     $data['action']='tugas_belajar/edit/'.$id;
     $this->__set_rules_tb();
     if ($this->form_validation->run()==FALSE) {
       $data['tb']=$this->mdl_tugas_belajar->get_by_id($id)->row_array();
       $opt_email_universitas= array('TBDN' =>'TBDN','TBLN'=>'TBLN');
       $opt_psikotest=array('Dipertimbangkan'=>'Dipertimbangkan','Diragukan'=>'Diragukan','Disarankan'=>'Disarankan','Disarankan dengan Catatan','Tidak Disarankan');
       $opt_status_keberangkatan=array('Belum Berangkat'=>'Belum Berangkat','Sudah Berangkat'=>'Sudah Berangkat');
       $opt_ket_lulus=array('Lulus'=>'Lulus','Drop Out'=>'Drop Out','Resign'=>'Resign');
       $opt_lokasi=array('TBDN'=>'TBDN','TBLN'=>'TBLN');
       $opt_jenjang_pendidikan=array('D3'=>'D3','D4'=>'D4','S1'=>'S1','S2'=>'S2','S3'=>'S3');
       $opt_smt=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');

       $data['email_universitas']=form_dropdown('email_universitas',$opt_email_universitas ,$data['tb']['email_universitas']);
       $data['psikotest']=form_dropdown('psikotest',$opt_psikotest ,$data['tb']['psikotest']);
       $data['status_keberangkatan']=form_dropdown('status_keberangkatan',$opt_status_keberangkatan ,$data['tb']['status_keberangkatan']);
       $data['ket_lulus']=form_dropdown('ket_lulus',$opt_ket_lulus,$data['tb']['ket_lulus']);
       $data['lokasi']=form_dropdown('lokasi',$opt_lokasi,$data['tb']['lokasi']);
       $data['jenjang_pendidikan']=form_dropdown('jenjang_pendidikan',$opt_jenjang_pendidikan,$data['tb']['jenjang_pendidikan']);
       $smt_no=explode('#',$data['tb']['smt_no']);
       $smt_ipk=explode('#',$data['tb']['smt_no']);
       $data['semester']='';
       for ($i = 0; $i < count($smt_no); $i++) {
         # code...
         $data['semester'].='<div>Semester '.form_dropdown('smt_no[]',$opt_smt,$smt_no[$i],'class="input input-small"').'<input type="text" name="smt_ipk[]" class="input input-small" value="'.$smt_ipk[$i].'"> <a href="#" class="btn btn-mini btn-danger remove_field">Hapus</a></div>';
       }

       $this->template->display('tugas_belajar/form_edit_peserta',$data);
     }  else {
       $this->upload->initialize(array(
      'upload_path' => './assets/uploads/tugas_belajar/',
      'allowed_types' => '*',
      'max_size' => 5000, // 5MB
      'remove_spaces' => true,
      'overwrite' => false
  ));

  if(!$this->upload->do_upload('ijazah'))
  {
      $file_ijazah=$this->input->post('ijazah2');
  } else {
      $unggah = $this->upload->data();
      $unggah['file_name'];
      $file_ijazah=$unggah['file_name'];
  }
     $smt_no=implode('#',$this->input->post('smt_no'));
     $smt_ipk=implode('#',$this->input->post('smt_ipk'));

     $peserta = array(
       'nama' =>$this->input->post('nama'),
       'nopek'=>$this->input->post('nopek'),
       'keterangan'=>$this->input->post('keterangan'),
       'yudisium'=>$this->input->post('yudisium'),
       'awal_fungsi'=>$this->input->post('awal_fungsi'),
       'awal_jabatan'=>$this->input->post('awal_jabatan'),
       'skr_fungsi'=>$this->input->post('skr_fungsi'),
       'skr_jabatan'=>$this->input->post('skr_jabatan'),
       'tpa'=>$this->input->post('tpa'),
       'toefl'=>$this->input->post('toefl'),
       'psikotest'=>$this->input->post('psikotest'),
       'mcu'=>$this->input->post('mcu'),
       'program_tugas_belajar'=>$this->input->post('program_tugas_belajar'),
       'lokasi'=>$this->input->post('lokasi'),
       'jenjang_pendidikan'=>$this->input->post('jenjang_pendidikan'),
       'bidang_pendidikan'=>$this->input->post('bidang_pendidikan'),
       'jurusan'=>$this->input->post('jurusan'),
       'universitas'=>$this->input->post('universitas'),
       'email_pertamina'=>$this->input->post('email_pertamina'),
       'email_pribadi'=>$this->input->post('email_pribadi'),
       'alamat_indonesia'=>$this->input->post('alamat_indonesia'),
       'alamat_ln'=>$this->input->post('alamat_ln'),
       'paspor_no'=>$this->input->post('paspor_no'),
       'paspor_berlaku'=>$this->input->post('paspor_berlaku'),
       'no_telp_ln'=>$this->input->post('no_telp_ln'),
       'kontak_indonesia'=>$this->input->post('kontak_indonesia'),
       'cp_universitas'=>$this->input->post('cp_universitas'),
       'email_universitas'=>$this->input->post('email_universitas'),
       'masa_study_awal'=>$this->input->post('masa_study_awal'),
       'masa_study_akhir'=>$this->input->post('masa_study_akhir'),
       'status_keberangkatan'=>$this->input->post('status_keberangkatan'),
       'ket_lulus'=>$this->input->post('ket_lulus'),
       'ijazah'=>$file_ijazah,
       'smt_no'=>$smt_no,
       'smt_ipk'=>$smt_ipk,
       'ipk_akhir'=>$this->input->post('ipk_akhir'),
       'ipk'=>$this->input->post('ipk'),
       'start_date'=>date('Y-m-d G:i:s'),
       'update_date'=>date('Y-m-d G:i:s')
      );
      $this->mdl_tugas_belajar->update($id,$peserta);
      redirect('tugas_belajar/index');
     }
    }

    function detail($id)
    {
      $data['title']='Detail';
      $data['link_back']=site_url('tugas_belajar/index');
      $data['tb']=$this->mdl_tugas_belajar->get_by_id($id)->row_array();
      $smt_no=explode('#',$data['tb']['smt_no']);
      $smt_ipk=explode('#',$data['tb']['smt_no']);
      $data['semester']='';
      for ($i = 0; $i < count($smt_no); $i++) {
        # code...
        $data['semester'].='<div>Semester '.$smt_no[$i].' = '.$smt_ipk[$i].'</div>';
      }
       $this->template->display('tugas_belajar/detail',$data);

    }

        function __set_rules_tb() {
        $this->form_validation->set_rules('nama','Nama','required|trim');
    }
}
