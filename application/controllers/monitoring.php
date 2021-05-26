<?php

/**
 * Description of monitoring
 *
 * @author dhecode
 */
class monitoring extends CI_Controller{
    //put your code here
    private $limit=10;
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_course');
        $this->load->model('mdl_trainer');
        
        $this->load->library(array('upload', 'session'));

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
    }
    
    function index() {
        
        $data['title']='Dashboard';
        if ($this->session->userdata('user_id')==1) {
        $data['status_pnd']= anchor('monitoring/list_pnd', $this->mdl_course->get_status_pnd());
        $data['status_gft']= $this->mdl_course->get_status_gft();
        $data['status_gsfa']= $this->mdl_course->get_status_gsfa();    
        }elseif ($this->session->userdata('user_id')==2) {
        $data['status_pnd']= $this->mdl_course->get_status_pnd();
        $data['status_gft']= anchor('monitoring/list_gft', $this->mdl_course->get_status_gft());
        $data['status_gsfa']= $this->mdl_course->get_status_gsfa();    
        }elseif ($this->session->userdata('user_id')==5) {
       $data['status_pnd']=$this->mdl_course->get_status_pnd();
        $data['status_gft']=$this->mdl_course->get_status_gft();
        $data['status_gsfa']= anchor('monitoring/list_gsfa', $this->mdl_course->get_status_gsfa());      
        }else{
         $data['status_pnd']= $this->mdl_course->get_status_pnd();
        $data['status_gft']= $this->mdl_course->get_status_gft();
        $data['status_gsfa']=$this->mdl_course->get_status_gsfa();
        }

        $this->template->display('monitoring/index',$data);   
    }
    
    function list_pnd($offset=0) {
        
        $this->load->library('pagination');
           /* Pagination */
        $config['base_url'] = site_url('monitoring/list_pnd/');
        $config['total_rows'] = $this->mdl_course->get_status_pnd();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['title']='Data Program Belum Lengkap';
        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                'No', 
                'Nama Program', 
                'Tempat', 
                'Tanggal', 
                'Sifat'
        );
        
        $i = 0 + $offset;
        $q = $this->mdl_course->get_status_pnd_on($this->limit, $offset)->result_array();
        foreach ($q as $row) {
             if (is_numeric($row['location'])) {
             $lokasi=  $this->mdl_sarfas->get_class_by_id($row['location'])->row()->class_name;
            }else{
                $lokasi=$row['location'];
            }
            $this->table->add_row(
                    ++$i, 
                    anchor('monitoring/chk_pnd/'.$row['id'], $row['course_name']), 
                    $lokasi,
                    $this->editor->date_correct($row['start_date']).' s/d '.$this->editor->date_correct($row['end_date']),
                    $row['sifat']
                    );
            
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
     
        $this->template->display('monitoring/list_pnd', $data);    
    }
    
    
    function list_gft($offset=0) {
        
        $this->load->library('pagination');
           /* Pagination */
        $config['base_url'] = site_url('monitoring/list_gft/');
        $config['total_rows'] = $this->mdl_course->get_status_gft();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['title']='Data Program Belum Lengkap';
        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                'No', 
                'Nama Program', 
                'Tempat', 
                'Tanggal', 
                'Sifat'
        );
        
        $i = 0 + $offset;
        $q = $this->mdl_course->get_status_gft_on($this->limit, $offset)->result_array();
        foreach ($q as $row) {
             if (is_numeric($row['location'])) {
             $lokasi=  $this->mdl_sarfas->get_class_by_id($row['location'])->row()->class_name;
            }else{
                $lokasi=$row['location'];
            }
            $this->table->add_row(
                    ++$i, 
                    anchor('monitoring/chk_gft/'.$row['id'], $row['course_name']), 
                    $lokasi,
                    $this->editor->date_correct($row['start_date']).' s/d '.$this->editor->date_correct($row['end_date']),
                    $row['sifat']
                    );
            
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
     
        $this->template->display('monitoring/list_gft', $data);    
    }
    
    function list_gsfa($offset=0) {
        
        $this->load->library('pagination');
           /* Pagination */
        $config['base_url'] = site_url('monitoring/list_gsfa/');
        $config['total_rows'] = $this->mdl_course->get_status_gsfa();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['title']='Data Program Belum Lengkap';
        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                'No', 
                'Nama Program', 
                'Tempat', 
                'Tanggal', 
                'Sifat'
        );
        
        $i = 0 + $offset;
        $q = $this->mdl_course->get_status_gsfa_on($this->limit, $offset)->result_array();
        foreach ($q as $row) {
             if (is_numeric($row['location'])) {
             $lokasi=  $this->mdl_sarfas->get_class_by_id($row['location'])->row()->class_name;
            }else{
                $lokasi=$row['location'];
            }
            $this->table->add_row(
                    ++$i, 
                    anchor('monitoring/chk_gsfa/'.$row['id'], $row['course_name']), 
                    $lokasi,
                    $this->editor->date_correct($row['start_date']).' s/d '.$this->editor->date_correct($row['end_date']),
                    $row['sifat']
                    );
            
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
     
        $this->template->display('monitoring/list_gsfa', $data);    
    }
    
    function chk_pnd($id) {
        $data['title']='';
        $data['course']['trainer']=  $this->mdl_course->get_chk_pnd($id)->row()->pengajar;
        
                        if ($data['course']['trainer'] == 0) {
                    $data['trainer'] = '<tr id="null_trainer"><td>Tidak ada data pengajar</td></tr>';
                } else {
                    $trainers = explode("#", $data['course']['trainer']);
                    $data['trainer'] = '';
                    foreach ($trainers as $row_trainer) {
                        $tbl_trainer = $this->mdl_trainer->get_by_id($row_trainer)->row();
                        $data['trainer'].= '<tr><td>' . $tbl_trainer->name . anchor('#', '<i class="icon-remove"></i>', 'class="remove_trainer"') . '<input type="hidden" name="trainer[]" value="' . $row_trainer . '"></td></tr>';
                    }
                }
                
        $data['kode']=  $this->mdl_course->get_by_id($id)->row()->code;
        $data['judul']=  $this->mdl_course->get_by_id($id)->row()->course_name;
        $data['id_course']=  $id;
        $id_kelas=  $this->mdl_course->get_by_id($id)->row()->location;
              if (is_numeric($id_kelas)) {
             $lokasi=  $this->mdl_sarfas->get_class_by_id($id_kelas)->row()->class_name;
            }else{
                $lokasi=$this->mdl_course->get_by_id($id)->row()->location;;
            }
           $data['tempat']=$lokasi;
      $data['tanggal']= $this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->start_date).' s/d '.$this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->end_date);        
      $data['sifat']=  $this->mdl_course->get_by_id($id)->row()->sifat;
      
      
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->memo_permintaan)){
        $data['memo_permintaan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#memo_permintaan" data-toggle="modal">Memo Permintaan Training</a></td><td>-</td></tr> ';
       $data['file_memo_permintaan']='';
        }else{
        $data['memo_permintaan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#memo_permintaan" data-toggle="modal">Memo Permintaan Training</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_memo_permintaan).'</td></tr> ';    
        $data['file_memo_permintaan']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_pnd($id)->row()->memo_permintaan, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_memo_permintaan).'</td></tr>';
        
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->kursil)){
        $data['kursil']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#kursil" data-toggle="modal">Kursil</a></td><td>-</td></tr> ';
        $data['file_kursil']='';
        }else{
        $data['kursil']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#kursil" data-toggle="modal">Kursil</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_kursil).'</td></tr> ';    
        $data['file_kursil']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_pnd($id)->row()->kursil, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_kursil).'</td></tr>';
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->pengajar)){
        $data['pengajar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#pengajar" data-toggle="modal">Pengajar</a></td><td>-</td></tr> ';
     $data['file_pengajar']='';
        }else{
        $data['pengajar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#pengajar" data-toggle="modal">Pengajar</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_pengajar).'</td></tr> ';    
                $data['file_pengajar']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_pnd($id)->row()->pengajar, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_pengajar).'</td></tr>';
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->ub_program)){
        $data['ub_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#ub_program" data-toggle="modal">UB Program</a></td><td>-</td></tr> ';
       $data['file_ub_program']='';
        }else{
        $data['ub_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#ub_program" data-toggle="modal">UB Program</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_program).'</td></tr> ';    
               $data['file_ub_program']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_pnd($id)->row()->ub_program, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_program).'</td></tr>';
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->ub_trainer)){
        $data['ub_trainer']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#ub_trainer" data-toggle="modal">UB Trainer</a></td><td>-</td></tr> ';
        $data['file_ub_trainer']='';
        
        }else{
        $data['ub_trainer']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#ub_trainer" data-toggle="modal">UB Trainer</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_trainer).'</td></tr> ';    
        $data['file_ub_trainer']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_pnd($id)->row()->ub_trainer, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_trainer).'</td></tr>';
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->observasi)){
        $data['observasi']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#observasi" data-toggle="modal">Observasi Pengajar</a></td><td>-</td></tr> ';
      $data['file_observasi']='';
        }else{
        $data['observasi']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#observasi" data-toggle="modal">Observasi Pengajar</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_observasi).'</td></tr> ';    
        $data['file_observasi']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_pnd($id)->row()->observasi, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_observasi).'</td></tr>';
        
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->carpar)){
        $data['carpar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#carpar" data-toggle="modal">CAR/PAR</a></td><td>-</td></tr> ';
    $data['file_carpar']='';
        }else{
        $data['carpar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#carpar" data-toggle="modal">CAR/PAR</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_carpar).'</td></tr> ';    
                $data['file_carpar']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_pnd($id)->row()->carpar, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_carpar).'</td></tr>';
        
        }
        
        
        //GFT
        
        if (empty($this->mdl_course->get_chk_gft($id)->row()->memo_sarfas)){
        $data['memo_sarfas']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan Sarana dan Fasilitas</td><td>-</td></tr> ';
        }else{
        $data['memo_sarfas']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan Sarana dan Fasilitas</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_memo_sarfas).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_gft($id)->row()->berkas_tagihan)){
        $data['berkas_tagihan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas Tagihan</td><td>-</td></tr> ';
        }else{
        $data['berkas_tagihan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas Tagihan</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_berkas_tagihan).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->surat_perintah)){
        $data['surat_perintah']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Perintah</td><td>-</td></tr> ';
        }else{
        $data['surat_perintah']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Perintah</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_surat_perintah).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->persiapan_program)){
        $data['persiapan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Checklist Persiapan Program</td><td>-</td></tr> ';
        }else{
        $data['persiapan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Checklist Persiapan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_persiapan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_program)){
        $data['pelaksanaan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Checklist Pelaksanaan Program</td><td>-</td></tr> ';
        }else{
        $data['pelaksanaan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Checklist Pelaksanaan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->data_peserta)){
        $data['data_peserta']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Data Peserta</td><td>-</td></tr> ';
        }else{
        $data['data_peserta']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Data Peserta</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_data_peserta).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->laporan_program)){
        $data['laporan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Laporan Program</td><td>-</td></tr> ';
        }else{
        $data['laporan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Laporan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_laporan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->permintaan_umk)){
        $data['permintaan_umk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan UMK</td><td>-</td></tr> ';
        }else{
        $data['permintaan_umk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan UMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_permintaan_umk).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->rekap_honorarium)){
        $data['rekap_honorarium']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Rekap Honorarium</td><td>-</td></tr> ';
        }else{
        $data['rekap_honorarium']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Rekap Honorarium</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_rekap_honorarium).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->bantuan_mengajar)){
        $data['bantuan_mengajar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Bantuan Mengajar</td><td>-</td></tr> ';
        }else{
        $data['bantuan_mengajar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Bantuan Mengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_bantuan_mengajar).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_pelatihan)){
        $data['pelaksanaan_pelatihan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Pelaksanaan Pelatihan</td><td>-</td></tr> ';
        }else{
        $data['pelaksanaan_pelatihan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Pelaksanaan Pelatihan</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_pelatihan).'</td></tr> ';    
        }

        
        //GSFA
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pr)){
        $data['berkas_pr']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas PR</td><td>-</td></tr> ';
        }else{
        $data['berkas_pr']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas PR</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pr).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_po)){
        $data['berkas_po']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas PO</td><td>-</td></tr> ';
        }else{
        $data['berkas_po']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas PO</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_po).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->sp_pembayaran)){
        $data['sp_pembayaran']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; SP3 Pembayaran</td><td>-</td></tr> ';
        }else{
        $data['sp_pembayaran']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; SP3 Pembayaran</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_sp_pembayaran).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->pjumk)){
        $data['pjumk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; PJUMK</td><td>-</td></tr> ';
        }else{
        $data['pjumk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; PJUMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_pjumk).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->spumk)){
        $data['spumk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; SPUMK</td><td>-</td></tr> ';
        }else{
        $data['spumk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; SPUMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_spumk).'</td></tr> ';    
        }        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pj)){
        $data['berkas_pj']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas PJ</td><td>-</td></tr> ';
        }else{
        $data['berkas_pj']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas PJ</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pj).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->bon_umk)){
        $data['bon_umk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Bon Penerimaan UMK</td><td>-</td></tr> ';
        }else{
        $data['bon_umk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Bon Penerimaan UMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_bon_umk).'</td></tr> ';    
        }        
        
        
        
        $this->template->display('monitoring/chk_page',$data);  
        
    }
    
    function chk_gft($id) {
        $data['title']='';
        $data['trainer'] = '';
        $data['kode']=  $this->mdl_course->get_by_id($id)->row()->code;
        $data['judul']=  $this->mdl_course->get_by_id($id)->row()->course_name;
        $data['id_course']=  $id;
        $id_kelas=  $this->mdl_course->get_by_id($id)->row()->location;
              if (is_numeric($id_kelas)) {
             $lokasi=  $this->mdl_sarfas->get_class_by_id($id_kelas)->row()->class_name;
            }else{
                $lokasi=$this->mdl_course->get_by_id($id)->row()->location;;
            }
           $data['tempat']=$lokasi;
      $data['tanggal']= $this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->start_date).' s/d '.$this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->end_date);        
      $data['sifat']=  $this->mdl_course->get_by_id($id)->row()->sifat;
      
      
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->memo_permintaan)){
        $data['memo_permintaan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan Training</td><td>-</td></tr> ';
        }else{
        $data['memo_permintaan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan Training</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_memo_permintaan).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->kursil)){
        $data['kursil']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Kursil</td><td>-</td></tr> ';
        }else{
        $data['kursil']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Kursil</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_kursil).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->pengajar)){
        $data['pengajar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Pengajar</td><td>-</td></tr> ';
        }else{
        $data['pengajar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Pengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_pengajar).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->ub_program)){
        $data['ub_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; UB Program</td><td>-</td></tr> ';
        }else{
        $data['ub_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; UB Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_program).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->ub_trainer)){
        $data['ub_trainer']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; UB Trainer</td><td>-</td></tr> ';
        }else{
        $data['ub_trainer']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; UB Trainer</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_trainer).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->observasi)){
        $data['observasi']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Observasi Pengajar</td><td>-</td></tr> ';
        }else{
        $data['observasi']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Observasi Pengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_observasi).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->carpar)){
        $data['carpar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; CAR/PAR</td><td>-</td></tr> ';
        }else{
        $data['carpar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; CAR/PAR</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_carpar).'</td></tr> ';    
        }
        
        
        //GFT
        
        if (empty($this->mdl_course->get_chk_gft($id)->row()->memo_sarfas)){
        $data['memo_sarfas']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#memo_sarfas" data-toggle="modal">Memo Permintaan Sarana dan Fasilitas</a></td><td>-</td></tr> ';
        $data['file_memo_sarfas']='';
        
        }else{
        $data['memo_sarfas']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#memo_sarfas" data-toggle="modal">Memo Permintaan Sarana dan Fasilitas</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_memo_sarfas).'</td></tr> ';    
       $data['file_memo_sarfas']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->memo_sarfas, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_memo_sarfas).'</td></tr>';
        }
        
        if (empty($this->mdl_course->get_chk_gft($id)->row()->berkas_tagihan)){
        $data['berkas_tagihan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#berkas_tagihan" data-toggle="modal">Berkas Tagihan</a></td><td>-</td></tr> ';
      $data['file_berkas_tagihan']='';
        }else{
        $data['berkas_tagihan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#berkas_tagihan" data-toggle="modal">Berkas Tagihan</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_berkas_tagihan).'</td></tr> ';    
      $data['file_berkas_tagihan']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->berkas_tagihan, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_berkas_tagihan).'</td></tr>';
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->surat_perintah)){
        $data['surat_perintah']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#surat_perintah" data-toggle="modal">Surat Perintah</a></td><td>-</td></tr> ';
        $data['file_surat_perintah']='';
        
        }else{
        $data['surat_perintah']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#surat_perintah" data-toggle="modal">Surat Perintah</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_surat_perintah).'</td></tr> ';    
        $data['file_surat_perintah']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->surat_perintah, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_surat_perintah).'</td></tr>';     
        
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->persiapan_program)){
        $data['persiapan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#persiapan_program" data-toggle="modal">Checklist Persiapan Program</a></td><td>-</td></tr> ';
      $data['file_persiapan_program']='';
        }else{
        $data['persiapan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#persiapan_program" data-toggle="modal">Checklist Persiapan Program</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_persiapan_program).'</td></tr> ';    
            $data['file_persiapan_program']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->persiapan_program, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_persiapan_program).'</td></tr>';
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_program)){
        $data['pelaksanaan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#pelaksanaan_program" data-toggle="modal">Checklist Pelaksanaan Program</a></td><td>-</td></tr> ';
      $data['file_pelaksanaan_program']='';
        }else{
        $data['pelaksanaan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#pelaksanaan_program data-toggle="modal">Checklist Pelaksanaan Program</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_program).'</td></tr> ';    
        $data['file_pelaksanaan_program']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_program, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_program).'</td></tr>';
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->data_peserta)){
        $data['data_peserta']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#data_peserta" data-toggle="modal">Data Peserta</a></td><td>-</td></tr> ';
   $data['file_data_peserta']='';
        }else{
        $data['data_peserta']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#data_peserta" data-toggle="modal">Data Peserta</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_data_peserta).'</td></tr> ';    
        $data['file_data_peserta']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->data_peserta, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_data_peserta).'</td></tr>';
        
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->laporan_program)){
        $data['laporan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#laporan_program" data-toggle="modal">Laporan Program</a></td><td>-</td></tr> ';
        $data['file_laporan_program']='';
        
        }else{
        $data['laporan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#laporan_program" data-toggle="modal">Laporan Program</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_laporan_program).'</td></tr> ';    
        $data['file_laporan_program']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->laporan_program, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_laporan_program).'</td></tr>';
        
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->permintaan_umk)){
        $data['permintaan_umk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#permintaan_umk" data-toggle="modal">Memo Permintaan UMK</a></td><td>-</td></tr> ';
        $data['file_permintaan_umk']='';
        
        }else{
        $data['permintaan_umk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#permintaan_umk" data-toggle="modal">Memo Permintaan UMK</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_permintaan_umk).'</td></tr> ';    
        $data['file_permintaan_umk']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->permintaan_umk, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_permintaan_umk).'</td></tr>';
        
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->rekap_honorarium)){
        $data['rekap_honorarium']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#rekap_honorarium" data-toggle="modal">Rekap Honorarium</a></td><td>-</td></tr> ';
        $data['file_rekap_honorarium']='';
        }else{
        $data['rekap_honorarium']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#rekap_honorarium" data-toggle="modal">Rekap Honorarium</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_rekap_honorarium).'</td></tr> ';    
        $data['file_rekap_honorarium']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->rekap_honorarium, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_rekap_honorarium).'</td></tr>';
        
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->bantuan_mengajar)){
        $data['bantuan_mengajar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#bantuan_mengajar" data-toggle="modal">Surat Bantuan Mengajar</a></td><td>-</td></tr> ';
       $data['file_bantuan_mengajar']='';
        }else{
        $data['bantuan_mengajar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#bantuan_mengajar" data-toggle="modal">Surat Bantuan Mengajar</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_bantuan_mengajar).'</td></tr> ';    
        $data['file_bantuan_mengajar']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->bantuan_mengajar, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_bantuan_mengajar).'</td></tr>';
        
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_pelatihan)){
        $data['pelaksanaan_pelatihan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#pelaksanaan_pelatihan" data-toggle="modal">Surat Pelaksanaan Pelatihan</a></td><td>-</td></tr> ';
        $data['file_pelaksanaan_pelatihan']='';
        
        }else{
        $data['pelaksanaan_pelatihan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#pelaksanaan_pelatihan" data-toggle="modal">Surat Pelaksanaan Pelatihan</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_pelatihan).'</td></tr> ';    
        $data['file_pelaksanaan_pelatihan']='<tr><td>'.  anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_pelatihan, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_pelatihan).'</td></tr>';
        
        }

        
        //GSFA
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pr)){
        $data['berkas_pr']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas PR</td><td>-</td></tr> ';
        }else{
        $data['berkas_pr']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas PR</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pr).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_po)){
        $data['berkas_po']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas PO</td><td>-</td></tr> ';
        }else{
        $data['berkas_po']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas PO</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_po).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->sp_pembayaran)){
        $data['sp_pembayaran']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; SP3 Pembayaran</td><td>-</td></tr> ';
        }else{
        $data['sp_pembayaran']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; SP3 Pembayaran</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_sp_pembayaran).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->pjumk)){
        $data['pjumk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; PJUMK</td><td>-</td></tr> ';
        }else{
        $data['pjumk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; PJUMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_pjumk).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->spumk)){
        $data['spumk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; SPUMK</td><td>-</td></tr> ';
        }else{
        $data['spumk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; SPUMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_spumk).'</td></tr> ';    
        }        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pj)){
        $data['berkas_pj']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas PJ</td><td>-</td></tr> ';
        }else{
        $data['berkas_pj']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas PJ</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pj).'</td></tr> ';    
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->bon_umk)){
        $data['bon_umk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Bon Penerimaan UMK</td><td>-</td></tr> ';
        }else{
        $data['bon_umk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Bon Penerimaan UMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_bon_umk).'</td></tr> ';    
        }        
        
        
        
        $this->template->display('monitoring/chk_page',$data);  
        
    }
    
    function chk_gsfa($id) {
        $data['title']='';
        $data['trainer'] = '';
        $data['kode']=  $this->mdl_course->get_by_id($id)->row()->code;
        $data['id_course']=  $id;
        $data['judul']=  $this->mdl_course->get_by_id($id)->row()->course_name;
        $data['id_course']=  $id;
        $id_kelas=  $this->mdl_course->get_by_id($id)->row()->location;
              if (is_numeric($id_kelas)) {
             $lokasi=  $this->mdl_sarfas->get_class_by_id($id_kelas)->row()->class_name;
            }else{
                $lokasi=$this->mdl_course->get_by_id($id)->row()->location;;
            }
           $data['tempat']=$lokasi;
      $data['tanggal']= $this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->start_date).' s/d '.$this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->end_date);        
      $data['sifat']=  $this->mdl_course->get_by_id($id)->row()->sifat;
      
      
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->memo_permintaan)){
        $data['memo_permintaan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan Training</td><td>-</td></tr> ';
        }else{
        $data['memo_permintaan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan Training</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_memo_permintaan).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->kursil)){
        $data['kursil']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Kursil</td><td>-</td></tr> ';
        }else{
        $data['kursil']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Kursil</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_kursil).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->pengajar)){
        $data['pengajar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Pengajar</td><td>-</td></tr> ';
        }else{
        $data['pengajar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Pengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_pengajar).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->ub_program)){
        $data['ub_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; UB Program</td><td>-</td></tr> ';
        }else{
        $data['ub_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; UB Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_program).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->ub_trainer)){
        $data['ub_trainer']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; UB Trainer</td><td>-</td></tr> ';
        }else{
        $data['ub_trainer']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; UB Trainer</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_trainer).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->observasi)){
        $data['observasi']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Observasi Pengajar</td><td>-</td></tr> ';
        }else{
        $data['observasi']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Observasi Pengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_observasi).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->carpar)){
        $data['carpar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; CAR/PAR</td><td>-</td></tr> ';
        }else{
        $data['carpar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; CAR/PAR</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_carpar).'</td></tr> ';    
        }
        
        
        //GFT
        
        if (empty($this->mdl_course->get_chk_gft($id)->row()->memo_sarfas)){
        $data['memo_sarfas']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan Sarana dan Fasilitas</td><td>-</td></tr> ';
        }else{
        $data['memo_sarfas']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan Sarana dan Fasilitas</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_memo_sarfas).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_gft($id)->row()->berkas_tagihan)){
        $data['berkas_tagihan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas Tagihan</td><td>-</td></tr> ';
        }else{
        $data['berkas_tagihan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas Tagihan</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_berkas_tagihan).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->surat_perintah)){
        $data['surat_perintah']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Perintah</td><td>-</td></tr> ';
        }else{
        $data['surat_perintah']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Perintah</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_surat_perintah).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->persiapan_program)){
        $data['persiapan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Checklist Persiapan Program</td><td>-</td></tr> ';
        }else{
        $data['persiapan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Checklist Persiapan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_persiapan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_program)){
        $data['pelaksanaan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Checklist Pelaksanaan Program</td><td>-</td></tr> ';
        }else{
        $data['pelaksanaan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Checklist Pelaksanaan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->data_peserta)){
        $data['data_peserta']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Data Peserta</td><td>-</td></tr> ';
        }else{
        $data['data_peserta']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Data Peserta</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_data_peserta).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->laporan_program)){
        $data['laporan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Laporan Program</td><td>-</td></tr> ';
        }else{
        $data['laporan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Laporan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_laporan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->permintaan_umk)){
        $data['permintaan_umk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan UMK</td><td>-</td></tr> ';
        }else{
        $data['permintaan_umk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan UMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_permintaan_umk).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->rekap_honorarium)){
        $data['rekap_honorarium']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Rekap Honorarium</td><td>-</td></tr> ';
        }else{
        $data['rekap_honorarium']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Rekap Honorarium</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_rekap_honorarium).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->bantuan_mengajar)){
        $data['bantuan_mengajar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Bantuan Mengajar</td><td>-</td></tr> ';
        }else{
        $data['bantuan_mengajar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Bantuan Mengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_bantuan_mengajar).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_pelatihan)){
        $data['pelaksanaan_pelatihan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Pelaksanaan Pelatihan</td><td>-</td></tr> ';
        }else{
        $data['pelaksanaan_pelatihan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Pelaksanaan Pelatihan</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_pelatihan).'</td></tr> ';    
        }

        
        //GSFA
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pr)){
        $data['berkas_pr']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#berkas_pr" data-toggle="modal">Berkas PR</a></td><td>-</td></tr> ';
        $data['file_berkas_pr']='';
        
        }else{
        $data['berkas_pr']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#berkas_pr" data-toggle="modal">Berkas PR</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pr).'</td></tr> ';    
        $data['file_berkas_pr']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->berkas_pr, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pr).'</td></tr>';  
        
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_po)){
        $data['berkas_po']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#berkas_po" data-toggle="modal">Berkas PO</a></td><td>-</td></tr> ';
$data['file_berkas_po']='';
        }else{
        $data['berkas_po']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#berkas_po" data-toggle="modal">Berkas PO</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_po).'</td></tr> ';    
        $data['file_berkas_po']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->berkas_po, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_po).'</td></tr>';  
        
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->sp_pembayaran)){
        $data['sp_pembayaran']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#sp_pembayaran" data-toggle="modal">SP3 Pembayaran</a></td><td>-</td></tr> ';
        $data['file_sp_pembayaran']='';
        
        }else{
        $data['sp_pembayaran']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#sp_pembayaran" data-toggle="modal">SP3 Pembayaran</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_sp_pembayaran).'</td></tr> ';    
        $data['file_sp_pembayaran']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->sp_pembayaran, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_sp_pembayaran).'</td></tr>';  
        
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->pjumk)){
        $data['pjumk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#pjumk" data-toggle="modal">PJUMK</a></td><td>-</td></tr> ';
        $data['file_pjumk']='';
        
        }else{
        $data['pjumk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#pjumk" data-toggle="modal">PJUMK</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_pjumk).'</td></tr> ';    
         $data['file_pjumk']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->pjumk, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_pjumk).'</td></tr>';     
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->spumk)){
        $data['spumk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#spumk" data-toggle="modal">SPUMK</a></td><td>-</td></tr> ';
        $data['file_spumk']='';
        
        }else{
        $data['spumk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#spumk" data-toggle="modal">SPUMK</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_spumk).'</td></tr> ';    
        $data['file_spumk']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->spumk, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_spumk).'</td></tr>';         
        
        }        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pj)){
        $data['berkas_pj']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#berkas_pj" data-toggle="modal">Berkas PJ</a></td><td>-</td></tr> ';
       $data['file_berkas_pj']='';
        }else{
        $data['berkas_pj']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#berkas_pj" data-toggle="modal">Berkas PJ</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pj).'</td></tr> ';    
           $data['file_berkas_pj']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->berkas_pj, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pj).'</td></tr>';       
        
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->bon_umk)){
        $data['bon_umk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; <a href="#bon_umk" data-toggle="modal">Bon Penerimaan UMK</a></td><td>-</td></tr> ';
        }else{
        $data['bon_umk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; <a href="#bon_umk" data-toggle="modal">Bon Penerimaan UMK</a></td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_bon_umk).'</td></tr> ';    
        $data['file_bon_umk']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->bon_umk, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_bon_umk).'</td></tr>';         
        }        
        
        $this->template->display('monitoring/chk_page',$data);  
        
    }
    
    function chk_umum($id) {
        $data['title']='Tracking dan Monitoring';
        $data['trainer'] = '';
        $data['kode']=  $this->mdl_course->get_by_id($id)->row()->code;
        $data['id_course']=  $id;
        $data['judul']=  $this->mdl_course->get_by_id($id)->row()->course_name;
        $data['id_course']=  $id;
        $id_kelas=  $this->mdl_course->get_by_id($id)->row()->location;
              if (is_numeric($id_kelas)) {
             $lokasi=  $this->mdl_sarfas->get_class_by_id($id_kelas)->row()->class_name;
            }else{
                $lokasi=$this->mdl_course->get_by_id($id)->row()->location;;
            }
           $data['tempat']=$lokasi;
      $data['tanggal']= $this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->start_date).' s/d '.$this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->end_date);        
      $data['sifat']=  $this->mdl_course->get_by_id($id)->row()->sifat;
      
      /*
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->memo_permintaan)){
        $data['memo_permintaan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan Training</td><td>-</td></tr> ';
        }else{
        $data['memo_permintaan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan Training</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_memo_permintaan).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->kursil)){
        $data['kursil']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Kursil</td><td>-</td></tr> ';
        }else{
        $data['kursil']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Kursil</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_kursil).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->pengajar)){
        $data['pengajar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Pengajar</td><td>-</td></tr> ';
        }else{
        $data['pengajar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Pengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_pengajar).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->ub_program)){
        $data['ub_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; UB Program</td><td>-</td></tr> ';
        }else{
        $data['ub_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; UB Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_program).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->ub_trainer)){
        $data['ub_trainer']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; UB Trainer</td><td>-</td></tr> ';
        }else{
        $data['ub_trainer']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; UB Trainer</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_ub_trainer).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->observasi)){
        $data['observasi']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Observasi Pengajar</td><td>-</td></tr> ';
        }else{
        $data['observasi']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Observasi Pengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_observasi).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_pnd($id)->row()->carpar)){
        $data['carpar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; CAR/PAR</td><td>-</td></tr> ';
        }else{
        $data['carpar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; CAR/PAR</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_pnd($id)->row()->date_carpar).'</td></tr> ';    
        }
        
        
        //GFT
        
        if (empty($this->mdl_course->get_chk_gft($id)->row()->memo_sarfas)){
        $data['memo_sarfas']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan Sarana dan Fasilitas</td><td>-</td></tr> ';
        }else{
        $data['memo_sarfas']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan Sarana dan Fasilitas</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_memo_sarfas).'</td></tr> ';    
        }
        
        if (empty($this->mdl_course->get_chk_gft($id)->row()->berkas_tagihan)){
        $data['berkas_tagihan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas Tagihan</td><td>-</td></tr> ';
        }else{
        $data['berkas_tagihan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas Tagihan</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_berkas_tagihan).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->surat_perintah)){
        $data['surat_perintah']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Perintah</td><td>-</td></tr> ';
        }else{
        $data['surat_perintah']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Perintah</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_surat_perintah).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->persiapan_program)){
        $data['persiapan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Checklist Persiapan Program</td><td>-</td></tr> ';
        }else{
        $data['persiapan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Checklist Persiapan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_persiapan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_program)){
        $data['pelaksanaan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Checklist Pelaksanaan Program</td><td>-</td></tr> ';
        }else{
        $data['pelaksanaan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Checklist Pelaksanaan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->data_peserta)){
        $data['data_peserta']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Data Peserta</td><td>-</td></tr> ';
        }else{
        $data['data_peserta']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Data Peserta</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_data_peserta).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->laporan_program)){
        $data['laporan_program']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Laporan Program</td><td>-</td></tr> ';
        }else{
        $data['laporan_program']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Laporan Program</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_laporan_program).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->permintaan_umk)){
        $data['permintaan_umk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Memo Permintaan UMK</td><td>-</td></tr> ';
        }else{
        $data['permintaan_umk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Memo Permintaan UMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_permintaan_umk).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->rekap_honorarium)){
        $data['rekap_honorarium']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Rekap Honorarium</td><td>-</td></tr> ';
        }else{
        $data['rekap_honorarium']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Rekap Honorarium</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_rekap_honorarium).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->bantuan_mengajar)){
        $data['bantuan_mengajar']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Bantuan Mengajar</td><td>-</td></tr> ';
        }else{
        $data['bantuan_mengajar']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Bantuan Mengajar</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_bantuan_mengajar).'</td></tr> ';    
        }
        if (empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_pelatihan)){
        $data['pelaksanaan_pelatihan']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Surat Pelaksanaan Pelatihan</td><td>-</td></tr> ';
        }else{
        $data['pelaksanaan_pelatihan']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Surat Pelaksanaan Pelatihan</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gft($id)->row()->date_pelaksanaan_pelatihan).'</td></tr> ';    
        }

        
        //GSFA
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pr)){
        $data['berkas_pr']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas PR</td><td>-</td></tr> ';
        $data['file_berkas_pr']='';
        
        }else{
        $data['berkas_pr']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas PR</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pr).'</td></tr> ';    
        $data['file_berkas_pr']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->berkas_pr, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pr).'</td></tr>';  
        
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_po)){
        $data['berkas_po']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; Berkas PO</td><td>-</td></tr> ';
$data['file_berkas_po']='';
        }else{
        $data['berkas_po']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Berkas PO</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_po).'</td></tr> ';    
        $data['file_berkas_po']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->berkas_po, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_po).'</td></tr>';  
        
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->sp_pembayaran)){
        $data['sp_pembayaran']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp;SP3 Pembayaran</td><td>-</td></tr> ';
        $data['file_sp_pembayaran']='';
        
        }else{
        $data['sp_pembayaran']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; SP3 Pembayaran</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_sp_pembayaran).'</td></tr> ';    
        $data['file_sp_pembayaran']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->sp_pembayaran, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_sp_pembayaran).'</td></tr>';  
        
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->pjumk)){
        $data['pjumk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp;PJUMK</td><td>-</td></tr> ';
        $data['file_pjumk']='';
        
        }else{
        $data['pjumk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; PJUMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_pjumk).'</td></tr> ';    
         $data['file_pjumk']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->pjumk, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_pjumk).'</td></tr>';     
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->spumk)){
        $data['spumk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp; SPUMK</td><td>-</td></tr> ';
        $data['file_spumk']='';
        
        }else{
        $data['spumk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; SPUMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_spumk).'</td></tr> ';    
        $data['file_spumk']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->spumk, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_spumk).'</td></tr>';         
        
        }        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pj)){
        $data['berkas_pj']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp;Berkas PJ</td><td>-</td></tr> ';
       $data['file_berkas_pj']='';
        }else{
        $data['berkas_pj']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp;Berkas PJ</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pj).'</td></tr> ';    
           $data['file_berkas_pj']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->berkas_pj, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_berkas_pj).'</td></tr>';       
        
        }        
        
        if (empty($this->mdl_course->get_chk_gsfa($id)->row()->bon_umk)){
        $data['bon_umk']='<tr><td><img src="assets/img/cross.png" width="15" height="15">&nbsp;Bon Penerimaan UMK</td><td>-</td></tr> ';
        }else{
        $data['bon_umk']='<tr><td><img src="assets/img/check.png" width="15" height="15">&nbsp; Bon Penerimaan UMK</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_bon_umk).'</td></tr> ';    
        $data['file_bon_umk']='<tr><td>'.anchor('assets/uploads/chk/'.$this->mdl_course->get_chk_gsfa($id)->row()->bon_umk, 'Download', array('class'=>'label label-info')).'</td><td>'.$this->editor->date_correct($this->mdl_course->get_chk_gsfa($id)->row()->date_bon_umk).'</td></tr>';         
        }        
        
       * 
       */
        $this->template->display('monitoring/chk_umum',$data);  
        
    }
    
    function upload_file($id,$field,$tabel) {
                $this->upload->initialize(array(
                'upload_path' => './assets/uploads/chk/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            
            if(!$this->upload->do_upload('upload_file'))
            {
                $upload_file=$this->input->post('upload_file2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $upload_file=$unggah['file_name'];
            } 
            
         $file=array(
             $field=>$upload_file,
             'date_'.$field=> date('Y-m-d G:i:s')
         );   
         
         if ($tabel==1) {    
         $this->mdl_course->add_chk_pnd($file,$id);
         if (!empty($this->mdl_course->get_chk_pnd($id)->row()->memo_permintaan)&&!empty($this->mdl_course->get_chk_pnd($id)->row()->kursil)&&!empty($this->mdl_course->get_chk_pnd($id)->row()->pengajar)&&!empty($this->mdl_course->get_chk_pnd($id)->row()->ub_program)&&!empty($this->mdl_course->get_chk_pnd($id)->row()->ub_trainer)&&!empty($this->mdl_course->get_chk_pnd($id)->row()->observasi)) {
             $set_status=array(
                 'status_pnd'=>'off'
             );
             $this->mdl_course->update($id,$set_status);
         }
             redirect('monitoring/chk_pnd/'.$id);
         }elseif ($tabel==2) {
         $this->mdl_course->add_chk_gft($file,$id);
         if (!empty($this->mdl_course->get_chk_gft($id)->row()->memo_sarfas)&&!empty($this->mdl_course->get_chk_gft($id)->row()->surat_perintah)&&!empty($this->mdl_course->get_chk_gft($id)->row()->persiapan_program)&&!empty($this->mdl_course->get_chk_gft($id)->row()->pelaksanaan_program)&&!empty($this->mdl_course->get_chk_gft($id)->row()->laporan_program)&&!empty($this->mdl_course->get_chk_gft($id)->row()->permintaan_umk)) {
             $set_status=array(
                 'status_gft'=>'off'
             );
             $this->mdl_course->update($id,$set_status);
         }
             redirect('monitoring/chk_gft/'.$id);
        } elseif ($tabel==3) {
         $this->mdl_course->add_chk_gsfa($file,$id);
        if (!empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pr)&&!empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_po)&&!empty($this->mdl_course->get_chk_gsfa($id)->row()->sp_pembayaran)&&!empty($this->mdl_course->get_chk_gsfa($id)->row()->pjumk)&&!empty($this->mdl_course->get_chk_gsfa($id)->row()->spumk)&&!empty($this->mdl_course->get_chk_gsfa($id)->row()->berkas_pj)&&!empty($this->mdl_course->get_chk_gsfa($id)->row()->bon_umk)) {
             $set_status=array(
                 'status_gsfa'=>'off'
             );
             $this->mdl_course->update($id,$set_status);
         }
             redirect('monitoring/chk_gsfa/'.$id);
    }


    }
    
    function update_trainer($id) {
        
                     $data_act = $this->input->post('trainer');
                if ($data_act != 0) {
                    $act_imp = implode('#', $data_act);
                } else {
                    $act_imp = 0;
                }
                
                $trainer=array(
                    'pengajar'=>$act_imp,
                    'date_pengajar'=> date('Y-m-d G:i:s')
                );
                $this->mdl_course->add_chk_pnd($trainer,$id);
         redirect('monitoring/chk_pnd/'.$id);
    }
    
}

?>
