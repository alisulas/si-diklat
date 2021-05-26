<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pkl
 *
 * @author adehermawan
 */
class pkl extends CI_Controller{
    //put your code here
    private $limit=10;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_sarfas');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');  
        
    }
         //Tambah Form PKL    
    function add_pkl() {
     $data['title']='Tambah Data PKL';
     $data['link_back']=site_url('pkl/list_pkl');
     $data['action']='pkl/add_pkl';
     $this->__set_rules_pkl();
     if ($this->form_validation->run()==FALSE) {
         $data['pkl']['nama']='';
         $data['pkl']['fakultas']='';
         $data['pkl']['jurusan']='';
         $data['pkl']['perguruan_tinggi']='';
         $data['pkl']['program']='';
         $data['pkl']['surat_perguruan_tinggi']='';
         $data['pkl']['upload_surat_perguruan_tinggi']='';
         $data['pkl']['memo_gsfa']='';
         $data['pkl']['upload_memo_gsfa']='';
         $data['pkl']['memo_balasan_fungsi']='';
         $data['pkl']['upload_memo_balasan_fungsi']='';
         $data['pkl']['surat_gsfa']='';
         $data['pkl']['upload_surat_gsfa']='';
         $data['pkl']['tempat_pelaksanaan']='';
         $data['pkl']['durasi']='';
         $data['pkl']['tgl_mulai']='';
         $data['pkl']['tgl_selesai']='';
         $data['pkl']['upload_persyaratan']='';
         $data['pkl']['upload_laporan']='';
         $data['pkl']['upload_sk']='';
         $data['pkl']['ket']='';
         $data['pkl']['tujuan']='';
         $data['pkl']['jenis']='';
         $data['pkl']['ref']='';
         $data['pkl']['status']='';

    $opt_program=array(
     'D3'=>'D3',
     'D4'=>'D4',
     'S1'=>'S1',
     'S2'=>'S2',
     'S3'=>'S3'
    );
    $opt_jenis=array(
     'PKL'=>'PKL',
     'Penelitian'=>'Penelitian'
    );
    
               $data['tempat_pelaksanaan']='';
 
 $data['options_program']= form_dropdown('program', $opt_program);
 $data['options_jenis']= form_dropdown('jenis', $opt_jenis);
 
 $this->template->display('pkl/form_input_pkl',$data);
     }  else {
                 $this->upload->initialize(array(
                'upload_path' => './assets/uploads/pkl/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            
            if(!$this->upload->do_upload('upload_persyaratan'))
            {
                $upload_persyaratan=$this->input->post('upload_persyaratan2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_persyaratan=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('upload_laporan'))
            {
                $upload_laporan=$this->input->post('upload_laporan2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_laporan=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_sk'))
            {
                $upload_sk=$this->input->post('upload_sk2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_sk=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_surat_perguruan_tinggi'))
            {
                $upload_surat_perguruan_tinggi=$this->input->post('upload_surat_perguruan_tinggi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_surat_perguruan_tinggi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_memo_gsfa'))
            {
                $upload_memo_gsfa=$this->input->post('upload_memo_gsfa2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_memo_gsfa=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_memo_balasan_fungsi'))
            {
                $upload_memo_balasan_fungsi=$this->input->post('upload_memo_balasan_fungsi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_memo_balasan_fungsi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_surat_gsfa'))
            {
                $upload_surat_gsfa=$this->input->post('upload_surat_gsfa2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_surat_gsfa=$unggah['file_name'];
            }

         $pkl=array(
             'nama'=>$this->input->post('nama'),
             'fakultas'=>  $this->input->post('fakultas'),
             'jurusan'=>  $this->input->post('jurusan'),
             'perguruan_tinggi'=>  $this->input->post('perguruan_tinggi'),
             'program'=>  $this->input->post('program'),
             'surat_perguruan_tinggi'=>  $this->input->post('surat_perguruan_tinggi'),
             'upload_surat_perguruan_tinggi'=>  $upload_surat_perguruan_tinggi,
             'memo_gsfa'=>  $this->input->post('memo_gsfa'),
             'upload_memo_gsfa'=>  $upload_memo_gsfa,
             'memo_balasan_fungsi'=>  $this->input->post('memo_balasan_fungsi'),
             'upload_memo_balasan_fungsi'=>  $upload_memo_balasan_fungsi,
             'surat_gsfa'=>  $this->input->post('surat_gsfa'),
             'upload_surat_gsfa'=>  $upload_surat_gsfa,
             'tempat_pelaksanaan'=>  $this->input->post('tempat_pelaksanaan'),
             'durasi'=>  $this->input->post('durasi'),
             'tgl_mulai'=>  $this->input->post('tgl_mulai'),
             'tgl_selesai'=>  $this->input->post('tgl_selesai'),
             'upload_persyaratan'=>  $upload_persyaratan,
             'upload_laporan'=>$upload_laporan,
             'upload_sk'=>$upload_sk,
             'tujuan'=>  $this->input->post('tujuan'),
             'jenis'=>  $this->input->post('jenis'),
             'ref'=>  $this->input->post('ref'),
             'ket'=>  $this->input->post('ket'),
             'status'=>  $this->input->post('status'),
             'progress'=>0
         );
         $this->mdl_sarfas->add_pkl($pkl);
         $this->session->set_flashdata('msg','<div class="alert alert-success">Provider baru berhasil ditambahkan</div>');
	 redirect('pkl/list_pkl');
     }
    }
    
    function edit_pkl($id) {
     $data['title']='Edit Data PKL';
     $data['link_back']=site_url('pkl/list_pkl');
     $data['action']='pkl/edit_pkl/'.$id;
     $this->__set_rules_pkl();
     if ($this->form_validation->run()==FALSE) {

         $data['pkl']=$this->mdl_sarfas->get_pkl_by_id($id)->row_array();
     
      $opt_program=array(
     'D3'=>'D3',
     'S1'=>'S1',
     'S2'=>'S2',
     'S3'=>'S3'
 ); 
    $opt_jenis=array(
     'PKL'=>'PKL',
     'Penelitian'=>'Penelitian'
    );
    
                 if ($data['pkl']['tempat_pelaksanaan'] == 0) {
                    $data['tempat_pelaksanaan'] = '<tr id="null_trainer"><td>Tidak ada data lokasi</td></tr>';
                } else {
                    $tbl_manager = $this->mdl_sarfas->get_manager_by_id($data['pkl']['tempat_pelaksanaan'])->row();
                    $data['tempat_pelaksanaan']= '<tr><td>' . $tbl_manager->name . anchor('#', '<i class="icon-remove"></i>', 'class="remove_lokasi"') . '<input type="hidden" name="tempat_pelaksanaan" value="' . $tbl_manager->id . '"></td></tr>';                    
                }
     
 $data['options_jenis']= form_dropdown('jenis', $opt_jenis,$data['pkl']['jenis']);   
 $data['options_program']= form_dropdown('program', $opt_program, $data['pkl']['program']);
         $this->template->display('pkl/form_input_pkl',$data);
     }  else {
                 $this->upload->initialize(array(
                'upload_path' => './assets/uploads/pkl/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            
            if(!$this->upload->do_upload('upload_persyaratan'))
            {
                $upload_persyaratan=$this->input->post('upload_persyaratan2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_persyaratan=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('upload_laporan'))
            {
                $upload_laporan=$this->input->post('upload_laporan2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_laporan=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_sk'))
            {
                $upload_sk=$this->input->post('upload_sk2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_sk=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_surat_perguruan_tinggi'))
            {
                $upload_surat_perguruan_tinggi=$this->input->post('upload_surat_perguruan_tinggi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_surat_perguruan_tinggi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_memo_gsfa'))
            {
                $upload_memo_gsfa=$this->input->post('upload_memo_gsfa2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_memo_gsfa=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_memo_balasan_fungsi'))
            {
                $upload_memo_balasan_fungsi=$this->input->post('upload_memo_balasan_fungsi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_memo_balasan_fungsi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('upload_surat_gsfa'))
            {
                $upload_surat_gsfa=$this->input->post('upload_surat_gsfa2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_surat_gsfa=$unggah['file_name'];
            }
            
         $pkl=array(
             'nama'=>$this->input->post('nama'),
             'fakultas'=>  $this->input->post('fakultas'),
             'jurusan'=>  $this->input->post('jurusan'),
             'perguruan_tinggi'=>  $this->input->post('perguruan_tinggi'),
             'program'=>  $this->input->post('program'),
             'surat_perguruan_tinggi'=>  $this->input->post('surat_perguruan_tinggi'),
             'upload_surat_perguruan_tinggi'=>  $upload_surat_perguruan_tinggi,
             'memo_gsfa'=>  $this->input->post('memo_gsfa'),
             'upload_memo_gsfa'=>  $upload_memo_gsfa,
             'memo_balasan_fungsi'=>  $this->input->post('memo_balasan_fungsi'),
             'upload_memo_balasan_fungsi'=>  $upload_memo_balasan_fungsi,
             'surat_gsfa'=>  $this->input->post('surat_gsfa'),
             'upload_surat_gsfa'=>  $upload_surat_gsfa,
             'tempat_pelaksanaan'=>  $this->input->post('tempat_pelaksanaan'),
             'durasi'=>  $this->input->post('durasi'),
             'tgl_mulai'=>  $this->input->post('tgl_mulai'),
             'tgl_selesai'=>  $this->input->post('tgl_selesai'),
             'upload_persyaratan'=>  $upload_persyaratan,
             'upload_laporan'=>$upload_laporan,
             'upload_sk'=>$upload_sk,
             'jenis'=>  $this->input->post('jenis'),
             'tujuan'=>  $this->input->post('tujuan'),
             'ref'=>  $this->input->post('ref'),
             'ket'=>  $this->input->post('ket'),
             'status'=>  $this->input->post('status'),
             'progress'=> 0
         );
         
         $this->mdl_sarfas->update_pkl($id,$pkl);
         $this->session->set_flashdata('msg','<div class="alert alert-success">Provider baru berhasil ditambahkan</div>');
	 redirect('pkl/list_pkl');

     }
    }
    
    function detail($id) {
     $data['pkl']=$this->mdl_sarfas->get_pkl_by_id($id)->row_array();
     $this->template->display("pkl/detail",$data);
    }
    
    function __set_rules_pkl() {
        $this->form_validation->set_rules('nama','Nama','required|trim');
    }
    
      function list_pkl($offset=0)
    {
	$data['title']='Data Peserta';
	$data['tambah']=  anchor('pkl/add_pkl', 'Tambah', array('class'=>'btn btn-success'));
	$data['download']=  anchor('pkl/download_laporan_pkl', 'Download', array('class'=>'btn btn-success'));
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('pkl/list_pkl/');
	$config['total_rows']=$this->mdl_sarfas->count_pkl();
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
		 'Perguruan Tinggi',
                 'Jurusan',
		 'Durasi<br>(Bulan)',
		 'Tujuan',
		 array('data'=>'Uang Saku','width'=>15),
                 array('data'=>'Status','width'=>15),
                 array('data'=>'','width'=>10)
		);
        
        $pkl_name= $this->input->post('pkl_name');
        $list= $this->input->post('list');
        if ($list=='progress') {
            if ($pkl_name=='proses') {
                $pkl_name=0;
            }  else {
            $pkl_name=1;    
            }
        }
	$q=$this->mdl_sarfas->get_pkl($list,$pkl_name,$this->limit,$offset)->result_array();
         if (empty($pkl_name)){
            $pkl_name='';
        }
        $i=0+$offset;
        
        $data['add_uang_saku']='';
        $data['lihat_uang_saku']='';
        
	foreach ($q as $row)
	{
            $edit=  anchor('pkl/edit_pkl/'.$row['id'],'<i class="icon-wrench icon-white"></i>',array('class'=>'label label-info','rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('sarfas/delete_pkl/'.$row['id'],'<i class="icon-trash icon-white"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','class'=>'label label-important','title'=>'Delete'));
          //  $uang_saku=  anchor('sarfas/uang_saku', 'Tambah', array('class'=>'label'));
          if ($row['progress']==0) {
            $progress=anchor('pkl/progress_pkl/'.$row['id'].'/1','Proses',array('onclick'=>"return confirm('Apakah Progress sudah selesai?')",'rel'=>'tooltip','title'=>'Selesai','class'=>'label label-success'));              
          }  else {
           $progress=anchor('pkl/progress_pkl/'.$row['id'].'/0','Selesai',array('onclick'=>"return confirm('Apakah Progress belum selesai?')",'rel'=>'tooltip','title'=>'Proses','class'=>'label label-important'));    
          }
            
            if (empty($row['status'])) {
                $status='';
            }elseif ($row['status']=='antri') {
                $status='<span class="label">Antri</span>';
            } elseif ($row['status']=='ditolak') {
                $status='<span class="label label-important">Ditolak</span>';            
            }elseif ($row['status']=='proses') {
               $status='<span class="label label-warning">Proses</span>';                                                    
            }  elseif ($row['status']=='pkl') {
               $status='<span class="label label-info">PKL</span>';                                                    
            } else{
               $status='<span class="label label-success">Diterima</span>';                                    
            }
            
        $data['add_uang_saku'].=$this->editor->add_uang_saku($row['id']);
        $data['lihat_uang_saku'].=$this->editor->lihat_uang_saku($row['id'],$row['us_dasar'],$row['us_pph'],$row['us_diterimakan'],$row['us_an'],$row['us_norek'],$row['us_bank'],$row['us_cabang']);

            if (empty($row['us_dasar'])) {
        $uang_saku=  anchor('#add_uang_saku'.$row['id'], 'Tambah',array('class'=>'label','data-toggle'=>'modal'));                            
            }else{
        $uang_saku=  anchor('#lihat_uang_saku'.$row['id'], 'Lihat',array('class'=>'label label-warning','data-toggle'=>'modal'));                                            
            }
              
            $this->table->add_row(
		    ++$i,
                    $row['nama'],
                    $row['perguruan_tinggi'],
		    $row['jurusan'],
                    $row['durasi'],
                    $row['tujuan'],
		    $uang_saku,
		    $status,
                    $edit.'&nbsp;'.
                    $delete
		    );
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">','width'=>'100%'));
	$data['content']=$this->table->generate();
        $this->template->display('pkl/list_pkl',$data);
    }
    
    function add_uang_saku($id) {
        $us_dasar=  $this->input->post('us_dasar');
        $pph=(6/100)*$us_dasar;
        $us_diterimakan=$us_dasar-$pph;
      $uang_saku=array(
          'us_dasar'=>$us_dasar,
          'us_pph'=>$pph,
          'us_diterimakan'=>$us_diterimakan,
          'us_an'=>  $this->input->post('us_an'),
          'us_norek'=>  $this->input->post('us_norek'),
          'us_bank'=>  $this->input->post('us_bank'),
          'us_cabang'=>  $this->input->post('us_cabang'),
      );  
      $this->mdl_sarfas->update_uang_saku($id,$uang_saku);
      redirect('sarfas/list_pkl');
      
    }
    function progress_pkl($id,$dat) {
      $uang_saku=array(
          'progress'=>  $dat
      );  
      $this->mdl_sarfas->update_uang_saku($id,$uang_saku);
      redirect('sarfas/list_pkl');
      
    }
    
    function delete_pkl($id) {
        $this->mdl_sarfas->delete_pkl($id);
        redirect('sarfas/list_pkl');
    }
    
    function update_uang_saku($id) {
       $us_dasar=  $this->input->post('us_dasar');
        $pph=(6/100)*$us_dasar;
        $us_diterimakan=$us_dasar-$pph;
      $uang_saku=array(
          'us_dasar'=>$us_dasar,
          'us_pph'=>$pph,
          'us_diterimakan'=>$us_diterimakan,
          'us_an'=>  $this->input->post('us_an'),
          'us_norek'=>  $this->input->post('us_norek'),
          'us_bank'=>  $this->input->post('us_bank'),
          'us_cabang'=>  $this->input->post('us_cabang'),
      );  
      $this->mdl_sarfas->update_uang_saku($id,$uang_saku);
        redirect('sarfas/list_pkl');
    }
    
        function download_laporan_pkl() {
       $bulan=  $this->input->post('bulan');
       $tahun=  $this->input->post('tahun');
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
$this->table->set_caption("Laporan PKL");

	$this->table->set_heading(
		 'No',
                 'Nama',
                 'Fakultas',
                 'Jurusan',
		 'Perguruan Tinggi',
		 'Program',
		 'Surat PT',
		 'Memo GSFA',
		 'Memo Fungsi',
		 'Surat GSFA ke PT',
		 'Lokasi',
		 'Durasi(Bulan)',
		 'Tgl Mulai',
		 'Tgl Selesai',
		 'Keterangan'
		);
        
	$q=$this->mdl_sarfas->get_pkl_laporan($bulan,$tahun)->result_array();
	$i=0;
 	foreach ($q as $row)
	{
                        if (!empty($row['tempat_pelaksanaan'])) {
$lokasi=  $this->mdl_sarfas->get_manager_by_id($row['tempat_pelaksanaan'])->row()->name;                
            }  else {
            $lokasi='';    
            }
            $this->table->add_row(
		    ++$i,
                    $row['nama'],
                    $row['fakultas'],
		    $row['jurusan'],
		    $row['perguruan_tinggi'],
		    $row['program'],
		    $row['surat_perguruan_tinggi'],
		    $row['memo_gsfa'],
		    $row['memo_balasan_fungsi'],
		    $row['surat_gsfa'],
		    $lokasi,
		    $row['durasi'],
		    $this->editor->date_correct($row['tgl_mulai']),
		    $this->editor->date_correct($row['tgl_selesai']),
		    $row['ket']
		    );
	}
    $data['content']=$this->table->generate();
     
  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan-pkl.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


echo $data['content'];
    }
    
    
        function lookup_manager() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_sarfas->lookup_manager($keyword); //Search DB
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
