<?php

/**
 * Description of course
 *
 * @author Administrator
 */
class Peserta extends Member_Controller {

    private $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_peserta');
        $this->load->model('mdl_fgt_pelatihan');
        $this->load->model('mdl_pelatihan');
        $this->load->model('mdl_pekerja');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
    }

    /*
     * Create new training
     */
    
    function index_pelatihan($offset=0) {
        $data['title'] = 'Index Pelatihan';
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        /* Pagination */
        $config['base_url'] = site_url('peserta/index_pelatihan/');
        $config['total_rows'] = $this->mdl_course->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                'No', 
                'Kode', 
                'Nama Pelatihan', 
                array('data' => 'Tanggal Pelaksanaan', 'width' => '180'), 
                'Lokasi',
                'Peserta',
                array('data' => 'Action', 'colspan' => 2, 'width' => '10')
        );
        $name= $this->input->post('course_name');
        $list= $this->input->post('list');
        
        $q = $this->mdl_sarfas->get_schedule($list,$name,$this->limit, $offset)->result_array();
        $i = 0 + $offset;
        foreach ($q as $row) {
            
            if (is_numeric($row['class'])) {
                $lokasi=  $this->mdl_sarfas->get_class_by_id($row['class'])->row()->class_name;
            }else{
                $lokasi=$row['class'];
            }
            
            if ($this->mdl_peserta->count_all($row['id'])<0) {
                $peserta='';
            }  else {
                $peserta=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all($row['id']));                
            }
            
            $delete=  anchor('course/delete/'.$row['id'],'<span class="label label-important">Hapus</span>');
            $edit=  anchor('course/edit/'.$row['id'],'<span class="label label-info">Edit</span>');
            

            $this->table->add_row(
                    ++$i, 
                    $row['course_id'], 
                    $row['activity'], 
                    $this->editor->date_correct($row['start_date']).' s/d '.$this->editor->date_correct($row['end_date']), 
                    $lokasi,
                    $peserta,
                    $delete,
                    $edit);
         }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        $this->template->display('peserta/index_pelatihan', $data);
    }
    
    
    function view($id=null,$offset=0)
    {
	if($id==null)
	{
	    $this->session->set_flashdata('msg',  $this->editor->alert_error('Terjadi kesalahan'));
	} else {
	    $data['title']='Data Peserta';
	    $data['action']='peserta/add/'.$id;
            $data['action_manual']='peserta/add_manual/'.$id;
	    $data['course_id']=$id;
	    $this->load->library('pagination');
	    if(empty($offset)){$offset=0;}
	    /* Pagination */
	    $config['base_url']=site_url('peserta/view/'.$id);
	    $config['total_rows']=$this->mdl_peserta->count_all($id);
	    $config['per_page']=$this->limit;
	    $config['uri_segment']=4;
	    $this->pagination->initialize($config);
	    $data['pagination']=$this->pagination->create_links();
            $data['kirim_email']='peserta/kirim_email/'.$id;
            $data['pelatihan']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
            $data['jml_peserta']=$this->mdl_peserta->count_all($id);
            $data['jml_konfirmasi']=$this->mdl_peserta->count_all_konfirmasi($id);
            $data['jml_hadir']=$this->mdl_peserta->count_all_hadir($id);
	    /* List Table */
	    $this->load->library('table');
	    $this->table->set_empty('&nbsp;');
	    $this->table->set_heading(
		    array('data'=>'No','width'=>5),
		    array('data'=>'','width'=>5),
		    array('data'=>'Nopek','width'=>60),
                    array('data'=>'Nama','width'=>250),
                    'Jabatan',
		    'Konfirmasi',
                    'Absensi',
		    'Last Update',
                    'Ket'
		    );

	    $peserta=$this->mdl_peserta->get_index($id)->result_array();
	    $i=0+$offset;
            $data['edit_peserta']='';
            $data['history_peserta']='';
	    foreach ($peserta as $row)
	    {    
              $check_box='<input type="checkbox" name="check[]" value="'.$row['id'].'">';
            
              $data['edit_peserta'].=$this->editor->edit_peserta($row['id'],$offset);
              $data['history_peserta'].=$this->editor->history_peserta($row['nopek'],$data['pelatihan']['tgl_mulai']);
              $this->table->add_row(
			++$i,
                        $check_box,
			$row['nopek'].'<br>'.$this->cek_kategori($row['nopek']),
                        anchor('#edit_peserta'.$row['id'],$row['nama_pekerja'], array('data-toggle'=>'modal')),
                        $row['position'],		
                        $this->cek_konfirmasi($row['konfirmasi']),
                        $this->cek_kehadiran($row['hadir']),
                        $this->editor->date_correct($row['update_date']).'<br>'.$row['user'],
                        $this->cek_peserta($row['nopek'])
			);
                
	    }
            $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl); 
	    $data['content']=$this->table->generate();
            
            //Update status
            $this->table->set_template(array('table_open'=>'<table class="table table-striped">'));
            $this->table->set_heading(
                     '',
		    'Konfirmasi',
                    'Absensi'
		    );
                     $this->table->add_row(
                    array('data'=>'<b><input type="checkbox" name="select-all" id="select-all" class="input input-mini"/>&nbsp;Pilih Semua </b>','width'=>100),
                    array('data'=>'<input type="radio" name="konfirmasi" value="konfirm_hadir">&nbsp;<span class="label label-success">Hadir</span><br><input type="radio" name="konfirmasi" value="konfirm_tdk_hadir">&nbsp;<span class="label label-important">Tidak Hadir</span><br>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-info" value="Proses">','width'=>100),
                    array('data'=>'<input type="radio" name="konfirmasi" value="absen_hadir">&nbsp;<span class="label label-success">Hadir</span><br><input type="radio" name="konfirmasi" value="absen_tdk_hadir">&nbsp;<span class="label label-important">Tidak Hadir</span><br>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-info" value="Proses">'));
                      $data['update']=$this->table->generate();
            
	    $data['tiket']=$data['pelatihan']['kd_tiket'];
            $data['nama_pelatihan']= $this->mdl_pelatihan->get_by_id($data['pelatihan']['kd_pelatihan'])->row()->judul.'&nbsp; Batch &nbsp;'.$this->mdl_fgt_pelatihan->get_by_id($id)->row()->batch;
            $data['lokasi']=$data['pelatihan']['lokasi_kota'];
            $data['tgl_pelaksanaan']=  $this->editor->date_correct($data['pelatihan']['tgl_mulai']).' s/d '.$this->editor->date_correct($data['pelatihan']['tgl_selesai']);
            $data['download_absensi']= anchor('peserta/absensi_peserta/'.$id.'/'.$data['pelatihan']['kd_pelatihan'], 'Download Absensi', array('class'=>'btn btn-success'));           
            $this->template->display('peserta/index',$data);
	}
    }
    
    
    function cek_peserta($nopek) {
    $peserta=$this->mdl_peserta->get_by_nopek($nopek)->result_array();
   $pst=0;
    foreach ($peserta as $row) {
      $tgl_mulai=  $this->mdl_fgt_pelatihan->get_by_id($row['id_trans_pelatihan'])->row()->tgl_mulai; 
      if ($tgl_mulai>=date('Y-m-d G:i:s')) {
      $pst= $pst+1;  
      }              
    }
          if ($pst>1) {
      $status= anchor('#history_peserta'.$row['nopek'], '<i class="icon icon-exclamation-sign icon-white"></i>', array('class'=>'btn btn-warning','data-toggle'=>'modal'));  
      }  else {
      $status= anchor('#history_peserta'.$row['nopek'], '<i class="icon icon-ok-sign icon-white"></i>', array('class'=>'btn btn-success','data-toggle'=>'modal'));   
      }
    return $status;
    }
    
    function cek_konfirmasi($val) {
     if ($val==NULL){
            $dat='<span class="label label-warning">Belum Konfirmasi</span>';
        }elseif($val==1){
         $dat='<span class="label label-success">Hadir</span>';
     }else{
         $dat='<span class="label label-important">Tidak Hadir</span>';
     }
        return $dat;
    }
    
    function cek_kehadiran($val) {
        if ($val==NULL){
            $dat='-';
        }elseif($val==1){
            $dat='<span class="label label-success">Hadir</span>';
        }else{
            $dat='<span class="label label-important">Tidak Hadir</span>';
        }
        return $dat;
    }
    
    function cek_kategori($nopek) {
        if ($this->mdl_peserta->cek_blacklist($nopek)>=2){
            $kategori=  anchor('peserta/history/'.$nopek,'BlackList',array('class'=>'label label-important'));
        }elseif ($this->mdl_peserta->cek_blacklist($nopek)==1) {
            $kategori=anchor('peserta/history/'.$nopek,'GreyList',array('class'=>'label label-warning'));
        }  else {
            $kategori=anchor('peserta/history/'.$nopek,'WhiteList',array('class'=>'label label-success'));
        }
        return $kategori;
    }
    
        function history($nopek) {
	$data['title']='Riwayat Pelatihan Peserta';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('peserta/history/');
	// $config['total_rows']=$this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_peserta->get_by_nopek($nopek)->num_rows();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Pelatihan',
                    'Batch',
                    'Tgl Mulai',
                    'Tgl Selesai',
                    'Konfirmasi',
                    'Absensi'
		);
                
	$q=$this->mdl_peserta->get_by_nopek($nopek)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $data['trans_pelatihan']= $this->mdl_fgt_pelatihan->get_by_id($row['id_trans_pelatihan'])->row_array();            
           $judul= $this->mdl_pelatihan->get_by_id($data['trans_pelatihan']['kd_pelatihan'])->row()->judul;	   
                       
           $this->table->add_row(
		    ++$i,
                    $data['trans_pelatihan']['kd_tiket'],
                    $judul,
                    $data['trans_pelatihan']['batch'],
                    $this->editor->date_correct($data['trans_pelatihan']['tgl_mulai']),
                    $this->editor->date_correct($data['trans_pelatihan']['tgl_selesai']),
                    $this->cek_konfirmasi($row['konfirmasi']),
                    $this->cek_kehadiran($row['hadir'])
		    );
           
	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
        $data['content']=$this->table->generate();
        $data['peserta']=$this->mdl_peserta->get_by_nopek($nopek)->row_array();
        $this->template->display('peserta/history',$data);
    }
    
        function absensi_peserta($id,$kd_pelatihan) {
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        //-- Table Initiation
        $tmpl = array(
            'table_open' => '<table border="1" cellpadding="0" cellspacing="0">',
            'heading_row_start' => '<tr class="heading">',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr class="alt">',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );
        $this->table->set_template($tmpl);
        $this->table->set_caption("ABSENSI PESERTA<br>".$this->mdl_pelatihan->get_by_id($kd_pelatihan)->row()->judul.'&nbsp; Batch '.$this->mdl_fgt_pelatihan->get_by_id($id)->row()->batch.'<br>'.$this->mdl_fgt_pelatihan->get_by_id($id)->row()->lokasi_kota.', '.$this->mdl_fgt_pelatihan->get_by_id($id)->row()->tempat.'<br>'.$this->editor->date_correct($this->mdl_fgt_pelatihan->get_by_id($id)->row()->tgl_mulai).' s/d '.$this->editor->date_correct($this->mdl_fgt_pelatihan->get_by_id($id)->row()->tgl_selesai).'<br>');
     
        $this->table->set_heading(
               'No',
               'Nopek',
               'Nama Pekerja',
               'Jabatan',
               'Fungsi',
               'Direktorat',
               'Konfirmasi',
               'Absensi',
               'TTD'
        );
       
        $q = $this->mdl_peserta->get_absensi_peserta($id)->result_array();
        $i=0;
        foreach ($q as $row) {

            $this->table->add_row(
                    ++$i,
                    $row['nopek'],
                    $row['nama_pekerja'],
                    $row['position'],
                    $row['departemen'],
                    $row['direktorat'],
                    $this->cek_konfirmasi($row['konfirmasi']),
                    $this->cek_kehadiran($row['hadir']),
                    ''
            );
        }
        //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=Absensi-Peserta-".$this->mdl_pelatihan->get_by_id($kd_pelatihan)->row()->judul.".xls");  //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        echo $data['content'];
    }
    
    function kirim_email($id) {
          $id_peserta=  $this->input->post('check');
     /*   if ($this->input->post('pilihan')=='mail') {
      $kd_pelatihan=  $this->mdl_fgt_pelatihan->get_by_id($id)->row()->kd_pelatihan;
      $batch= $this->mdl_fgt_pelatihan->get_by_id($id)->row()->batch;
     $to='';
     $cc='';
     $subject='Pemanggilan Peserta Program '.$this->mdl_pelatihan->get_by_id($kd_pelatihan)->row()->judul.' Batch '.$batch;
     foreach ($id_peserta as $key => $peserta) {
         $this->update_tgl($peserta);
     $to.=$this->mdl_peserta->get_peserta($peserta)->row()->email.';';    
     $cc.=$this->mdl_peserta->get_peserta($peserta)->row()->email_atasan.';'.$this->mdl_peserta->get_peserta($peserta)->row()->email_hr_area.';';    
     }
     header('Location: mailto:'.$to.'?cc='.$cc.'&subject='.$subject.'');
        }else
           
      * 
      */ 
          if (empty($id_peserta)){
    $this->session->set_flashdata('msg',$this->editor->alert_error('Silahkan Pilih Salahsatu Data'));   
      
          }else{
                  
                        if ($this->input->post('konfirmasi')=='konfirm_hadir') {
           
            foreach ($id_peserta as $key => $row) {
                $this->mdl_peserta->update_konfirmasi($row,1);
                $this->update_tgl($row);
            }
        }elseif ($this->input->post('konfirmasi')=='konfirm_tdk_hadir') {
           
            foreach ($id_peserta as $key => $row) {
                $this->mdl_peserta->update_konfirmasi($row,0);
                $this->update_tgl($row);
            }
        }elseif ($this->input->post('konfirmasi')=='absen_hadir') {
                       
            foreach ($id_peserta as $key => $row) {
                $this->mdl_peserta->update_hadir($row,1);
                $this->update_tgl($row);
            }
        }elseif ($this->input->post('konfirmasi')=='absen_tdk_hadir') {
            foreach ($id_peserta as $key => $row) {
                $this->mdl_peserta->update_hadir($row,0); 
                $this->update_tgl($row);
            }
        }
        
          }
           
     $this->view($id);
    }
    
    function update_tgl($id) {
        $this->mdl_peserta->update_tgl($id);
    }
    
     function add_manual($id)
    {        
       $peserta=array(
                    'id_trans_pelatihan'=>$id,
                    'nopek'=> $this->input->post('nopek'),
                    'nama_pekerja'=>$this->input->post('nama_pekerja'),
                    'position'=>$this->input->post('position'),
                    'company_code'=>$this->input->post('company_code'),
                    'direktorat'=>$this->input->post('direktorat'),
                    'fungsi'=>$this->input->post('fungsi'),
                    'email'=>$this->input->post('email'),
                    'insert_date'=>  date('Y-m-d G:i:s'),
                    'update_date'=>  date('Y-m-d G:i:s'),
                    'user'=> $this->session->userdata('user_name')
                );
            
            $this->mdl_peserta->add($peserta);
	    $this->session->set_flashdata('msg',$this->editor->alert_ok('Data peserta berhasil dimasukan'));
	    redirect('peserta/view/'.$id);
	
    }

    function add($id)
    {        
        $nopek=  $this->input->post('nopek');
        $email = $this->input->post('email');
        if (!empty($nopek)) {
            for ($a=0;$a<count($nopek);$a++){
                $peserta=array(
                    'id_trans_pelatihan'=>$id,
                    'nopek'=>  $nopek[$a],
                    'nama_pekerja'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->nama,
                    'tgl_lahir'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->tgl_lahir,
                    'position'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->position,
                    'cost_center_code'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->cost_center_code,
                    'cost_center_name'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->cost_center_name,
                    'company_code'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->company_code,
                    'personnel_area'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->personnel_area,
                    'personnel_sub_area'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->personnel_sub_area,
                    'employee_group'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->employee_group,
                    'employee_sub_group'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->employee_sub_group,
                    'layering'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->layering,
                    'direktorat'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->direktorat,
                    'fungsi'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->fungsi,
                    'divisi'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->divisi,
                    'departemen'=>$this->mdl_pekerja->get_by_nopek($nopek[$a])->row()->departemen,
                    'email'=>$email[$a],
                    'insert_date'=>  date('Y-m-d G:i:s'),
                    'update_date'=>  date('Y-m-d G:i:s'),
                    'user'=> $this->session->userdata('user_name')
                );
            
                $this->mdl_peserta->add($peserta);
            }
        }else {
        redirect('peserta/view/'.$id);
        }	    
	    $this->session->set_flashdata('msg',$this->editor->alert_ok('Data peserta berhasil dimasukkan'));
	    redirect('peserta/view/'.$id);
	
    }
    // validation rules
    function _set_rules() {
        $this->form_validation->set_rules('course_id', 'Nama Program', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Peserta', 'required|trim');
        $this->form_validation->set_rules('nopek', 'Nopek', 'required|trim');
        $this->form_validation->set_rules('direktorat', 'Direktorat', 'required|trim');
    }

    function delete($id,$course_id) {
        $this->mdl_peserta->delete($id);
        $this->session->set_flashdata('msg',$this->editor->alert_ok('Data berhasil dihapus'));
        redirect('peserta/view/'.$course_id);
    }
    
    function edit_peserta($id,$id_pelatihan) {
        $peserta=array(
        
                    'nopek'=>  $this->input->post('nopek'),
                    'nama_pekerja'=>$this->input->post('nama_pekerja'),
                    'position'=>$this->input->post('position'),
                    'cost_center_code'=>$this->input->post('cost_center_code'),
                    'cost_center_name'=>$this->input->post('cost_center_name'),
                    'company_code'=>$this->input->post('company_code'),
                    'direktorat'=>$this->input->post('direktorat'),
                    'fungsi'=>$this->input->post('fungsi'),
                    'divisi'=>$this->input->post('divisi'),
                    'departemen'=>$this->input->post('departemen'),
                    'email'=>$this->input->post('email'),
                    'update_date'=>  date('Y-m-m G:i:s'),
                    'user'=> $this->session->userdata('user_name')
                );
    
        $this->mdl_peserta->update($id,$peserta);
        redirect('peserta/view/'.$id_pelatihan);
    }
    
    
    
        function lookup_pekerja() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_pekerja->lookup_pekerja($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id'=>$row['nopek'],
                    'value' => $row['nopek']." | ".$row['nama']." | ".$row['position']." | ".$row['company_code']
                );  //Add a row to array
            }
            echo json_encode($data); //echo json string if ajax request
        } else {
            $datax['response'] = 'true';
            $data['message'] = array();
            $datax['message'][] = array(
                'id'=>0,
                'value' => 'Tidak Ditemukan'
                );
            echo json_encode($datax);
        }
    }
    
                //upload excel
    function do_upload($id) {
        $this->load->library('upload');
        $config['upload_path'] = './assets/uploads/';
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

                $dataexcel[$i - 1]['id_trans_pelatihan'] = $id ;
                $dataexcel[$i - 1]['nopek'] = $data['cells'][$i][1] ;
                $dataexcel[$i - 1]['nama_pekerja'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->nama;
                $dataexcel[$i - 1]['tgl_lahir'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->tgl_lahir;
                $dataexcel[$i - 1]['position'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->position;
                $dataexcel[$i - 1]['cost_center_code'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->cost_center_code;
                $dataexcel[$i - 1]['cost_center_name'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->cost_center_name;
                $dataexcel[$i - 1]['company_code'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->company_code;
                $dataexcel[$i - 1]['personnel_area'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->personnel_area;
                $dataexcel[$i - 1]['personnel_sub_area'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->personnel_sub_area;
                $dataexcel[$i - 1]['employee_group'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->employee_group;
                $dataexcel[$i - 1]['employee_sub_group'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->employee_sub_group;
                $dataexcel[$i - 1]['layering'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->layering;
                $dataexcel[$i - 1]['direktorat'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->direktorat;
                $dataexcel[$i - 1]['fungsi'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->fungsi;
                $dataexcel[$i - 1]['divisi'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->divisi;
                $dataexcel[$i - 1]['departemen'] = $this->mdl_pekerja->get_by_nopek($data['cells'][$i][1])->row()->departemen;
                
                
            }

            delete_files($upload_data['file_path']);
            $this->mdl_peserta->add_excel_pekerja($dataexcel);
            redirect("peserta/view/".$id);
        }
        
    }
    
}

/* End of file activity.php */
/* Location: ./application/controllers/activity.php */
