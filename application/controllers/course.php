<?php

/**
 * Description of course
 *
 * @author Administrator
 */
class Course extends CI_Controller {

    private $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_course');
        $this->load->model('mdl_sarfas');
        $this->load->model('mdl_dashboard');
        $this->load->model('mdl_trainer');
        $this->load->model('mdl_provider');
        $this->load->model('mdl_activity');
        $this->load->model('mdl_peserta');
        $this->load->model('mdl_schedule');
        $this->load->model('mdl_feedback');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
    }

    function index($offset = 0) {
        $this->get_index($offset);
    }

    /*
     * Get index table
     */

    protected function get_index($offset) {
        $data['title'] = 'Index Pelatihan';
        $this->load->helper('dompdf');
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        /* Pagination */
        $config['base_url'] = site_url('course/index/');
        $config['total_rows'] = $this->mdl_course->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
     //   $data['download_pdf'] = anchor('assets/uploads/course/course.pdf', '<button class="btn"><i class="icon-file"></i>Download PDF</button>', array('rel' => 'tooltip', 'title' => 'Download PDF'));

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                'No', 
                'Program',
                'PIC', 
                'Tanggal',
                'Lokasi',
                'Perencanaan', 
                'Pelaksanaan', 
                'Evaluasi'
        );
        $month=0;
        $course_name=0;
        $name= $this->input->post('course_name');
        $list= $this->input->post('list');
        
        $q = $this->mdl_sarfas->get_index($list,$name,$this->limit,$offset)->result_array();
        $data['excel'] = anchor('course/to_exel/' . $month . '/' . $course_name, '<i class="icon-list icon-white"></i>&nbsp;Download Excel', array('class' => 'btn btn-success', 'rel' => 'tooltip', 'title' => 'Download Excel'));
        $i = 0 + $offset;
        
        foreach ($q as $row) {
            if ($this->session->userdata('user_id') == 1 || $this->session->userdata('user_id') == 2 || $this->session->userdata('user_id') == 4) {
                $edit = anchor('course/edit/' . $row['id'], '<i class="icon-wrench"></i>', array('rel' => 'tooltip', 'title' => 'Edit'));
                $duplicate = anchor('course/duplicate/' . $row['id'], '<i class="icon-plus-sign"></i>');
                $delete = anchor('course/delete/' . $row['id'], '<i class="icon-trash"></i>', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')", 'rel' => 'tooltip', 'title' => 'Delete'));
            } else {
                $edit = '<i class="icon-wrench"></i>';
                $delete = '<i class="icon-trash"></i>';
                $duplicate = '<i class="icon-plus-sign"></i>';
            }

            if (is_numeric($row['class'])){
//             $location=  anchor('#tambah_lokasi'.$row['id'], 'Pilih', array('class'=>'label label-info','data-toggle'=>'modal'));  
               $location=  $this->mdl_sarfas->get_class_by_id($row['class'])->row()->class_name;
               }else{
               $location= $row['class'];
           }
           $jml_peserta=$this->mdl_peserta->count_all($row['id']);
             if ($this->mdl_peserta->count_all($row['id'])<0) {
                $peserta='';
            }  else {
                $peserta=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all($row['id']));                
            }
            
             if ($this->mdl_peserta->count_all_hadir($row['id'])<0) {
                $peserta_hadir='';
            }  else {
                $peserta_hadir=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all_hadir($row['id']));                
            }
            
            if (empty($this->mdl_provider->get_by_id($row['provider'])->row()->name)) {
                $provider='';
            }else{
                $provider=$this->mdl_provider->get_by_id($row['provider'])->row()->name;
            }
            
            if (empty($row['activity']) || empty($row['pic']) || empty($row['jenis']) || empty($row['user_name']) || empty($row['hrbp']) || empty($row['start_date']) || empty($row['end_date']) || $jml_peserta==0 || empty($row['class'])|| empty($row['sifat'])|| empty($row['provider'])|| empty($row['course_steward'])|| empty($row['jml_per_kelas'])|| empty($row['penawaran'])|| empty($row['negosiasi'])|| empty($row['penambahan_peserta'])) {
            $perencanaan=  anchor('course/add', 'Belum Lengkap', array('class'=>'label label-important'));    
            }else{
            $perencanaan='Lengkap';
            }
            
            if (empty($row['memo_panggilan']) || empty($row['sp']) || empty($row['fax_panggilan']) || empty($row['undangan_pengajar']) || empty($row['spk']) || empty($row['memo_sarfas']) || empty($row['sertifikat'])) {
            $pelaksanaan='Belum Lengkap';    
            }else{
            $pelaksanaan='Lengkap';
            }
            
            if (empty($row['koreksi_sp']) || empty($row['inv_masuk']) || empty($row['nilai_inv']) || empty($row['fu_ke_finance']) || empty($row['spk']) || empty($row['memo_sarfas']) || empty($row['sertifikat'])) {
            $evaluasi='Belum Lengkap';    
            }else{
            $evaluasi='Lengkap';
            }            
            
            $this->table->add_row(
                    ++$i, 
                    $row['activity'],
                    $row['pic'],
                    $this->editor->date_correct($row['start_date']).' s/d '.$this->editor->date_correct($row['end_date']), 
                    $location,
                    $perencanaan,
                    $pelaksanaan,
                    $evaluasi);
            
    //        $data['aktifitas'].=$this->editor->modal_aktifitas($row['id'], $view_btn, $lbl_kursil, $kelengkapan_btn, $lbl_activity, $peserta_btn, $lbl_peserta);
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        if ($this->session->userdata('user_id') == 1 || $this->session->userdata('user_id') == 2 || $this->session->userdata('user_id') == 4) {
            $data['tambah'] = anchor('course/add', 'Tambah', array('class' => 'btn btn-primary'));
        } else {
            $data['tambah'] = '';
        }

        $this->template->display('course/index', $data);

/*
        // to PDF        
        $this->table->clear();
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
        $this->table->set_caption("Daftar Pelatihan");

        $this->table->set_heading(
                'Kode', 'Nama Pelatihan', 'Sasaran', 'Materi', 'Persaratan Peserta', 'Durasi', 'PIC'
        );
        $q = $this->mdl_course->get_index($this->limit, $offset, $month, $course_name)->result_array();

        foreach ($q as $row) {
            $this->table->add_row(
                    $row['code'], $row['course_name'], $row['objective'], $row['material'], $row['requirement'], $row['duration'] . ' Hari', $this->session->userdata('user_name')
            );
        }
        //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
        $data['content'] = $this->table->generate();


        $datahtml = '
<html>
<head>
<link type="text/css" href="assets/bootstrap/bootstrap.css" rel="stylesheet">
        <link type="text/css" href="assets/bootstrap/bootstrap-responsive.css" rel="stylesheet">
        <link type="text/css" href="assets/css/style.css" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; font-size: 70%;">
<h3>Data Sertifikat</h3>
' . $data['content'] . '

</body>
</html>
';

        //  $html = $this->load->view('pdf/certificate', $datahtml, true);
        pdf_create($datahtml, 'course');



// End to PDF
 * 
 */
    }

    function to_exel($month = 0, $course_name = 0) {
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
        $this->table->set_caption("Daftar Pelatihan");

        $this->table->set_heading(
                'Kode', 'Nama Pelatihan', 'Tgl Mulai', 'Tgl Selesai', 'Tempat Pelaksanaan', 'Sifat', 'PIC'
        );
        $q = $this->mdl_course->get_exel($month, $course_name)->result_array();

        foreach ($q as $row) {
            $this->table->add_row(
                    $row['code'], $row['course_name'], $row['start_date'], $row['end_date'], $row['location'], $row['sifat'], $this->session->userdata('user_name')
            );
        }
        //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=course.xls");  //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);


        echo $data['content'];
    }

    /*
     * Create new training
     */

    function add() {
        $data['title'] = 'Tambah Course Baru';
        $data['link_back'] = site_url('course/index');
        $data['action'] = 'course/add';
            $tahun=  date('y');
            $bulan=  date('m');
            $ran=rand(1, 100);
            $data['code']=$tahun.$bulan.$ran;
        $this->_set_rules();
        if ($this->form_validation->run() === FALSE) {

                $provider = $this->mdl_provider->get_provider();
                $data['options_provider'] = '';
                foreach ($provider->result_array() as $row_provider) {
                $data['options_provider'].='<option value="' . $row_provider['id'] . '">' . $row_provider['name'] . '</option>';
                }
            $data['course']['pic'] = '';
            $data['course']['kode'] = $data['code'];
            $data['course']['course_name'] = '';
            $data['course']['batch'] = '';
            $data['course']['start_date'] = '';
            $data['course']['end_date'] = '';
            $data['course']['location'] = '';
            $data['trainer'] = '';
            $data['sifat']='<option value="Residensial">Residensial</option><option value="Non Residensial">Non Residensial</option>';
            $data['course']['sifat'] = '';            
            $data['course']['jenis'] = '';
            $data['course']['user_name'] = '';
            $data['course']['user_ref'] = '';
            $data['course']['jml_peserta'] = '';
            $data['course']['provider'] = '';
            $data['course']['course_steward'] = '';
            $data['course']['jumlah_per_kelas'] = '';
            $data['course']['penawaran'] = '';
            $data['course']['negosiasi'] = '';
            $data['course']['penambahan_peserta'] = '';
            $data['course']['memo_panggilan'] = '';
            $data['course']['sp'] = '';
            $data['course']['fax_panggilan'] = '';
            $data['course']['undangan_pengajar'] = '';
            $data['course']['spk'] = '';
            $data['course']['memo_sarfas'] = '';
            $data['course']['sertifikat'] = '';
            $data['course']['koreksi_sp'] = '';
            $data['course']['peserta_hadir'] = '';
            $data['course']['invoice_masuk'] = '';
            $data['course']['nilai_invoice'] = '';
            $data['course']['fu_ke_finance'] = '';
            
            $opt_class=$this->mdl_sarfas->get_class();
            $data['options_class']='';
            foreach ($opt_class->result_array() as $row_class) {
                $data['options_class'].='<option value="'.$row_class['class_name'].'">'.$row_class['class_name'].'</option>';
            }
            $this->template->display('course/form', $data);
            
        } else {
             
             if ($this->input->post('location')==19) {
                $kelas=  $this->input->post('other');
                $status=1;
                }else{
                $kelas=  $this->input->post('location');
                $status=0;
                }   
            $course = array(
                'course_id' => $this->input->post('kode'),                
                'jenis' => $this->input->post('jenis'),                
                'activity' => $this->input->post('course_name'),
                'class' => $kelas,
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'pic' =>  $this->input->post('pic'),
                'user_name' => $this->input->post('user_name'),
                'hrbp' => $this->input->post('user_ref'),
                'jml_peserta' => $this->input->post('jml_peserta'),
                'sifat' => $this->input->post('sifat'),
                'provider' => $this->input->post('provider'),
                'course_steward' => $this->input->post('course_steward'),
                'jml_per_kelas' => $this->input->post('jumlah_per_kelas'),
                'penawaran' => $this->input->post('penawaran'),
                'negosiasi' => $this->input->post('negosiasi'),
                'penambahan_peserta' => $this->input->post('penambahan_peserta'),
                'memo_panggilan' => $this->input->post('memo_panggilan'),
                'sp' => $this->input->post('sp'),
                'fax_panggilan' => $this->input->post('fax_panggilan'),
                'undangan_pengajar' => $this->input->post('undangan_pengajar'),
                'spk' => $this->input->post('spk'),
                'memo_sarfas' => $this->input->post('memo_sarfas'),
                'sertifikat' => $this->input->post('sertifikat'),
                'koreksi_sp' => $this->input->post('koreksi_sp'),
                'peserta_hadir' => $this->input->post('peserta_hadir'),
                'inv_masuk' => $this->input->post('inv_masuk'),
                'nilai_inv' => $this->input->post('nilai_inv'),
                'fu_ke_finance' => $this->input->post('fu_ke_finance'),
                'insert_date' => date('Y-m-d G:i:s'),
                'update_date' => date('Y-m-d G:i:s')
            );

            $this->mdl_sarfas->add_schedule($course);

          //  $this->mdl_course->create_chk_pnd($id_course);
          //  $this->mdl_course->create_chk_gft($id_course);
           // $this->mdl_course->create_chk_gsfa($id_course);
           redirect('course/index');
        }
    }
    
    function view_course($id) {
        $data['title']='Detail Pelatihan';
        $course=  $this->mdl_course->get_by_id($id)->row();
             if (empty($course->kursil)) {
             $kursil='<span class="label label-important">Belum Tersedia</span>';
            }else{
             $kursil= anchor('./assets/uploads/kursil/'.$course->kursil, 'Download', array('class'=>'label label-success'));
            }
            
            if (!empty($course->trainer)) {
            $trainer=  explode('#', $course->trainer);
            $isi_trainer='';
            for ($t=0;$t<count($trainer);$t++){
             $isi_trainer.=$this->mdl_trainer->get_by_id($trainer[$t])->row()->name.'<br>';   
            }
            }  else {
            $isi_trainer='Belum Tersedia';    
            }
            
            if (!empty($course->provider)){
                $provider=$this->mdl_provider->get_by_id($course->provider)->row()->name;
            }else{
                $provider='Belum Tersedia';
            }
            
        $data['code']=$course->code;
        $data['course_name']=$course->course_name;
        $data['tgl_pelaksanaan']=  $this->editor->date_correct($course->start_date).'s/d'.$this->editor->date_correct($course->end_date);
        $data['location']=$course->location;
        $data['kursil']=$kursil;
        $data['provider']=  $provider;
        $data['trainer']=$isi_trainer;
        
        $this->template->display('course/view_course',$data);
    }

    /*
     * Edit
     */

    function edit($id) {
        $data['title'] = 'Edit Course';
        $data['link_back'] = site_url('course/index');
        $data['action'] = 'course/edit/' . $id;
        $data['code']=$this->mdl_course->get_by_id($id)->row()->code;
        $this->_set_rules();
        if ($this->form_validation->run() === FALSE) {
            $data['course'] = $this->mdl_course->get_by_id($id)->row_array();
            $data['course']['kursil2']=  $this->mdl_course->get_by_id($id)->row()->kursil;
            $opt_class=$this->mdl_sarfas->get_class();
            $data['options_class']='';
            foreach ($opt_class->result_array() as $row_class) {               
       
            if($row_class['class_name'] == $data['course']['location'])
	    {
		$data['options_class'].='<option value="'.$row_class['class_name'].'" selected="selected">'.$row_class['class_name'].'</option>';
	    }else{
		$data['options_class'].='<option value="'.$row_class['class_name'].'">'.$row_class['class_name'].'</option>';
	    }
                
            
            }
            
            if ($data['course']['sifat']=='Residensial') {
            $data['sifat']='<option value="Residensial" selected="selected">Residensial</option><option value="Non Residensial">Non Residensial</option>';
            }  else {
            $data['sifat']='<option value="Residensial">Residensial</option><option value="Non Residensial">Non Residensial</option>';                
            }
                $data['pic'] = $this->session->userdata('user_name');            
            /*
                $provider = $this->mdl_provider->get_provider();
                $data['options_provider'] = '';
                foreach ($provider->result_array() as $row_provider) {
            if($row_provider['id'] == $data['course']['provider'])
	    {
		$data['options_provider'].='<option value="'.$row_provider['id'].'" selected="selected">'.$row_provider['name'].'</option>';
	    }else{
		$data['options_provider'].='<option value="'.$row_provider['id'].'">'.$row_provider['name'].'</option>';
	    }
                }
             * 
             */


/*
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
 * 
 */
                
            
        } else {
            
            /*   
           $this->upload->initialize(array(
                'upload_path' => './assets/uploads/kursil/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            
             if(!$this->upload->do_upload('kursil'))
            {
                $kursil=  $this->input->post('kursil2');
            } else {
                $unggah = $this->upload->data();
                $kursil=$unggah['file_name'];
             }
          
                          $data_act = $this->input->post('trainer');
                if ($data_act != 0) {
                    $act_imp = implode('#', $data_act);
                } else {
                    $act_imp = 0;
                }
 * 
 */
                
            if($this->input->post('location')=='other'){
                
            $course = array(
           //     'plc_function_id' => $this->session->userdata('user_id'),
               // 'code' => $this->input->post('code'),
                'course_name' => $this->input->post('course_name'),
                'batch' => $this->input->post('batch'),
              //  'objective' => $this->input->post('objective'),
              //  'material' => $this->input->post('material'),
              //  'requirement' => $this->input->post('requirement'),
              //  'duration' => $this->input->post('duration'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'location' => $this->input->post('other'),
          //      'kursil' => $kursil,
              //  'provider' => $this->input->post('provider'),
              //  'trainer' => $act_imp,
              //  'sifat' => $this->input->post('sifat'),
                'insert_date' => date('Y-m-d G:i:s'),
                'update_date' => date('Y-m-d G:i:s')
            );
            $this->mdl_course->update($id,$course);                
            }else{
                 
      
              //  $location=  $this->mdl_sarfas->get_class_by_id($this->input->post('location'))->row()->class_name;
                            $course = array(
           //     'plc_function_id' => $this->session->userdata('user_id'),
         //       'code' => $this->input->post('code'),
                'course_name' => $this->input->post('course_name'),
                'batch' => $this->input->post('batch'),
              //  'objective' => $this->input->post('objective'),
              //  'material' => $this->input->post('material'),
              //  'requirement' => $this->input->post('requirement'),
              //  'duration' => $this->input->post('duration'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'location' => $this->input->post('location'),
             //   'kursil' => $kursil,
              //  'provider' => $this->input->post('provider'),
              //  'trainer' => $act_imp,
              //  'sifat' => $this->input->post('sifat'),
                'insert_date' => date('Y-m-d G:i:s'),
                'update_date' => date('Y-m-d G:i:s')
            );
            $this->mdl_course->update($id,$course);
 /*           
            Masukan Ke jadwal
                $schedule=array(
                'activity'=>  $this->input->post('course_name'),
                'class'=>  $this->input->post('location'),
                'start_date'=> $this->input->post('start_date'),
                'end_date'=> $this->input->post('end_date'),
                'color'=>  '#ffffff',
                'insert_date'=> date('Y-m-d G:i:s')
                );
                $this->mdl_sarfas->update_schedule($id,$schedule);  
             
  * 
  */   
            }
  
 
            $this->session->set_flashdata('msg', $this->editor->alert_ok('Pelatihan berhasil diperbarui'));
            $data['course'] = $this->mdl_course->get_by_id($id)->row_array();
            if ($this->session->userdata('user_id')==5) {
                redirect('peserta/index_pelatihan');
            }  else {
            redirect('course/index');    
            }
        }
        $cat_list = $this->mdl_course->get_function()->result();
        $data['pic_id'] = $this->session->userdata('user_id');
        $data['pic'] = $this->session->userdata('user_name');
        $this->template->display('course/form', $data);
    }

    function duplicate($id) {
        $data['title'] = 'Tambah Program';
        $data['link_back'] = site_url('course/index');
        $data['action'] = 'course/add';
            $tahun=  date('y');
            $bulan=  date('m');
            $ran=rand(1, 100);
            $data['code']=$tahun.$bulan.$ran;
            $data['course'] = $this->mdl_course->get_by_id($id)->row_array();
            
                      
            if ($data['course']['sifat']=='Residensial') {
            $data['sifat']='<option value="Residensial" selected="selected">Residensial</option><option value="Non Residensial">Non Residensial</option>';
            }  else {
            $data['sifat']='<option value="Residensial">Residensial</option><option value="Non Residensial">Non Residensial</option>';                
            }
            
            $data['course']['kursil2']= '';
            $opt_class=$this->mdl_sarfas->get_class();
            $data['options_class']='';
            foreach ($opt_class->result_array() as $row_class) {               
       
            if($row_class['class_name'] == $data['course']['location'])
	    {
		$data['options_class'].='<option value="'.$row_class['class_name'].'" selected="selected">'.$row_class['class_name'].'</option>';
	    }else{
		$data['options_class'].='<option value="'.$row_class['class_name'].'">'.$row_class['class_name'].'</option>';
	    }
                
            }
            
        $data['pic_id'] = $this->session->userdata('user_id');
        $data['pic'] = $this->session->userdata('user_name');
        $data['trainer'] = NULL;
        $this->template->display('course/form', $data);
    }

    // validation rules
    function _set_rules() {
        $this->form_validation->set_rules('course_name', 'Nama Pelatihan', 'required|trim');
    }

    function delete($id) {
        $this->mdl_schedule->delete($id);
        $this->mdl_peserta->delete($id);
        $this->mdl_activity->delete($id);
        $this->mdl_course->delete_kursil($id);
        $this->mdl_course->delete($id);
        $this->mdl_feedback->delete_course($id);
        $this->mdl_feedback->delete_trainer($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Course ' . $id . ' berhasil dihapus</div>');
        if ($this->session->userdata('user_id')==5) {
        redirect('peserta/index_pelatihan');    
        }  else {
        redirect('course');    
        }
    }

    // Add coursil
    function add_kursil($id) {
        if (empty($id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-error">Terjadi kesalahan</div>');
            redirect('course');
        } else {
            $data['title'] = 'Tambah Kurikulum Silabus';
            $data['action'] = 'course/add_kursil/' . $id;
            $data['course_id'] = $id;
            $data['course_name'] = $this->mdl_course->get_by_id($id)->row()->course_name;

            $this->_set_rules_kursil();
            if ($this->form_validation->run() === FALSE) {
                $provider_name = '';
                $provider = $this->mdl_provider->get_index($provider_name, $limit = 10, $offset = 0);
                $data['options_provider'] = '';
                foreach ($provider->result_array() as $row_provider) {
                    $data['options_provider'].='<option value="' . $row_provider['id'] . '">' . $row_provider['name'] . '</option>';
                }
                $data['kursil']['plc_provider_id'] = '';
                $data['kursil']['purpose'] = $this->mdl_course->tmpl(1)->row()->text;
                $data['kursil']['objective'] = $this->mdl_course->tmpl(2)->row()->text;
                $data['kursil']['lesson_plan'] = $this->mdl_course->tmpl(3)->row()->text;
                $data['kursil']['candidate_requirement'] = '';
                $data['kursil']['candidate_estimation'] = '';
                $data['kursil']['budget'] = $this->mdl_course->tmpl(6)->row()->text;
                $data['kursil']['trainers'] = '';
                $this->template->display('course/form_kursil', $data);
            } else {
                $data_act = $this->input->post('trainer');
                if ($data_act != 0) {
                    $act_imp = implode('#', $data_act);
                } else {
                    $act_imp = 0;
                }

                $kursil = array(
                    'plc_course_id' => $this->input->post('plc_course_id'),
                    'plc_provider_id' => $this->input->post('plc_provider_id'),
                    'purpose' => $this->input->post('purpose'),
                    'objective' => $this->input->post('objective'),
                    'lesson_plan' => $this->input->post('lesson_plan'),
                    'candidate_requirement' => $this->input->post('candidate_requirement'),
                    'candidate_estimation' => $this->input->post('candidate_estimation'),
                    'budget' => $this->input->post('budget'),
                    'trainers' => $act_imp
                );
                $this->mdl_course->add_kursil($kursil);
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Kurikulum Silabus Berhasil Ditambahkan</div>');
                redirect('course/kursil/' . $id);
            }
        }
    }

    //autoComplete Trainer
    function lookup() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_course->lookup_trainer($keyword); //Search DB
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
    //autoComplete Program
    function lookup_course() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_course->lookup_course($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id' => $row['id'],
                    'value' => $row['course_name']
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

    // Edit coursil
    function edit_kursil($id) {
        if (empty($id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-error">Terjadi kesalahan</div>');
            redirect('course/index');
        } else {
            $data['title'] = 'Tambah Kurikulum Silabus';
            $data['action'] = 'course/edit_kursil/' . $id;
            $data['kursil'] = $this->mdl_course->get_kursil_by_id($id)->row_array();
            $this->_set_rules_kursil();
            if ($this->form_validation->run() === FALSE) {
                $provider_name = '';
                $provider = $this->mdl_provider->get_index($provider_name, $limit = 10, $offset = 0);
                $data['pic'] = $this->session->userdata('user_name');
                $data['options_provider'] = '';
                foreach ($provider->result_array() as $row_provider) {
                    $data['options_provider'].='<option value="' . $row_provider['id'] . '">' . $row_provider['name'] . '</option>';
                }


                if ($data['kursil']['trainers'] == 0) {
                    $data['trainer'] = '<tr id="null_trainer"><td>Tidak ada data pengajar</td></tr>';
                } else {
                    $trainers = explode("#", $data['kursil']['trainers']);
                    $data['trainer'] = '';
                    foreach ($trainers as $row_trainer) {
                        $tbl_trainer = $this->mdl_trainer->get_by_id($row_trainer)->row();
                        $data['trainer'].= '<tr><td>' . $tbl_trainer->name . anchor('#', '<i class="icon-remove"></i>', 'class="remove_trainer"') . '<input type="hidden" name="trainer[]" value="' . $row_trainer . '"></td></tr>';
                    }
                }


                $data['course_name'] = $this->mdl_course->get_by_id($data['kursil']['plc_course_id'])->row()->course_name;
                $data['course_id'] = $data['kursil']['plc_course_id'];
                $data['edit_jadwal'] = anchor('jadwal/view/' . $data['course_id'], 'Edit Jadwal', array('class' => 'btn btn-info', 'rel' => 'tooltip', 'title' => 'Edit Jadwal Pembelajaran', 'target' => '_blank'));
                $this->template->display('course/form_edit_kursil', $data);
            } else {
                $data_act = $this->input->post('trainer');
                if (!empty($data_act)) {
                    $act_imp = implode('#', $data_act);
                } else {
                    $act_imp = 0;
                }

                $kursil = array(
                    'plc_course_id' => $this->input->post('plc_course_id'),
                    'plc_provider_id' => $this->input->post('plc_provider_id'),
                    'purpose' => $this->input->post('purpose'),
                    'objective' => $this->input->post('objective'),
                    'lesson_plan' => $this->input->post('lesson_plan'),
                    'candidate_requirement' => $this->input->post('candidate_requirement'),
                    'candidate_estimation' => $this->input->post('candidate_estimation'),
                    'budget' => $this->input->post('budget'),
                    'trainers' => $act_imp
                );
                $this->mdl_course->update_kursil($id, $kursil);
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Kurikulum Silabus Berhasil Diperbarui</div>');
                redirect('course/kursil/' . $data['kursil']['plc_course_id']);
            }
        }
    }

    // Set Rules Kursil
    function _set_rules_kursil() {
        $this->form_validation->set_rules('plc_provider_id', 'Provider', 'required');
    }

    // Detail kursil
    function kursil($id) {
        if ($this->mdl_course->get_kursil_by_course($id)->num_rows() <= 0) {
            $this->session->set_flashdata('msg', $this->editor->alert_warning('Kursil belum tersedia'));
            redirect('course/add_kursil/' . $id);
        } else {
            $data['title'] = 'Kurikulum Silabus (Kursil) Program Pembelajaran Pertamina ';
            $data['kursil'] = $this->mdl_course->get_kursil_by_course($id)->row_array();

            if ($data['kursil']['trainers'] == 0) {
                $data['trainer'] = '';
            } else {
                $trainers = explode("#", $data['kursil']['trainers']);
                $data['trainer'] = '';
                $i = 0;
                foreach ($trainers as $row_trainer) {
                    $tbl_trainer = $this->mdl_trainer->get_by_id($row_trainer)->row();
                    $data['trainer'].='<tr>';
                    $data['trainer'].='<td width="20"><div align="center">' . ++$i . '</div></td>';
                    $data['trainer'].='<td>' . anchor('trainer/detail/' . $tbl_trainer->id, $tbl_trainer->name, array('rel' => 'tooltip', 'title' => 'Lihat data pengajar')) . '</td>';
                    $data['trainer'].='<td>' . $tbl_trainer->job_experience . '</td>';
                    $data['trainer'].='<td>' . $tbl_trainer->certification . '</td>';
                    $data['trainer'].='</tr>';
                }
            }

            $data['program_title'] = $this->mdl_course->get_by_id($data['kursil']['plc_course_id'])->row()->course_name;
            $data['date_start'] = $this->mdl_course->get_by_id($data['kursil']['plc_course_id'])->row()->start_date;
            $data['date_end'] = $this->mdl_course->get_by_id($data['kursil']['plc_course_id'])->row()->end_date;
            $data['plc_function_id'] = $this->mdl_course->get_by_id($data['kursil']['plc_course_id'])->row()->plc_function_id;
            $data['start_date'] = $this->editor->date_correct($this->mdl_course->get_by_id($data['kursil']['plc_course_id'])->row()->start_date);
            $data['end_date'] = $this->editor->date_correct($this->mdl_course->get_by_id($data['kursil']['plc_course_id'])->row()->end_date);
            $data['location'] = $this->mdl_course->get_by_id($data['kursil']['plc_course_id'])->row()->location;
            $data['company'] = $this->mdl_course->get_provider_by_id($data['kursil']['plc_provider_id'])->row()->name;
            $data['pic'] = $this->mdl_course->get_provider_by_id($data['kursil']['plc_provider_id'])->row()->pic;
            $data['phone'] = $this->mdl_course->get_provider_by_id($data['kursil']['plc_provider_id'])->row()->phone;
            $data['fax'] = $this->mdl_course->get_provider_by_id($data['kursil']['plc_provider_id'])->row()->fax;
            $data['email'] = $this->mdl_course->get_provider_by_id($data['kursil']['plc_provider_id'])->row()->email;

            $data['pic'] = $this->mdl_course->get_function_by_id($data['plc_function_id'])->row()->name;
            $data['tambah_jadwal'] = anchor('jadwal/view/' . $id, 'Tambah Jadwal', array('class' => 'btn btn-info', 'rel' => 'tooltip', 'title' => 'Tambah Jadwal Pembelajaran'));
            $days = $this->getDatesBetween2Dates($data['date_start'], $data['date_end']);
            $data['jadwal'] = '';
            $data['lihat_jadwal'] = '';
            foreach ($days as $key => $value) {

                $data['jadwal'] .= anchor('#lihat_jadwal' . $value, $this->editor->date_correct($value), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'rel' => 'tooltip', 'title' => 'Lihat Jadwal Pembelajaran')) . ' ';
                $data['lihat_jadwal'].=$this->editor->modal_jadwal($id, $value);
            }

            $this->template->display('course/kursil', $data);
        }
    }

    function delete_kursil($id) {
        if (!isset($id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-error">Terjadi kesalahan</div>');
            redirect('course');
        } else {
            $this->mdl_course->delete_kursil($id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Data berhasil dihapus</div>');
            redirect('course');
        }
    }

    protected function explode_s($r) {
        $s = explode("#", $r);
        if (!empty($s[1])) {
            $q = $this->mdl_trainer->get_by_id($s[1])->row()->name;
            $jdw = anchor('trainer/detail/' . $s[1], $q, array('rel' => 'tooltip', 'title' => 'Klik untuk melihat detail pemateri'));
            return $s[0] . '<br />(' . $jdw . ')';
        } else {
            return $s[0];
        }
    }

    protected function cek_kelengkapan($id) {
        $q = $this->mdl_course->get_activity_by_course($id);
        $val = TRUE;
        if ($q->num_rows() <= 0) {
            return FALSE;
        } else {
            for ($i = 1; $i < 22; $i++) {
                $act = 'act' . $i;
                if (($q->row()->$act != NULL)) {
                    $val = $val && TRUE;
                } else {
                    $val = $val && FALSE;
                }
            }
            return $val;
        }
    }

    function cancel($id) {
        $date_now = $this->editor->date_correct(date('Y-m-d'));
        $data = array(
            'status' => '2#' . $date_now . '#' . $this->input->post('ket'),
            'update_date' => date('Y-m-d G:i:s')
        );
        $this->mdl_dashboard->update_status($id, $data);
        redirect('course');
    }

    function close($id) {
        $date_now = $this->editor->date_correct(date('Y-m-d'));
        $data = array(
            'status' => '1#' . $date_now,
            'update_date' => date('Y-m-d G:i:s')
        );
        $this->mdl_dashboard->update_status($id, $data);
        redirect('course');
    }

    function tambah_jadwal($course_id) {
        $data = array(
            'plc_course_id' => $course_id,
            'tanggal' => $this->input->post('tanggal'),
            'waktu' => $this->input->post('waktu'),
            'kegiatan' => $this->input->post('kegiatan')
        );
        $this->mdl_course->add_jadwal($data);
        redirect('course/kursil/' . $course_id);
    }

    function getDatesBetween2Dates($startTime, $endTime) {
        $day = 86400;
        $format = 'Y-m-d';
        $startTime = strtotime($startTime);
        $endTime = strtotime($endTime);
        $numDays = round(($endTime - $startTime) / $day) + 1;
        $days = array();

        for ($i = 0; $i < $numDays; $i++) {
            $days[] = date($format, ($startTime + ($i * $day)));
        }

        return $days;
    }

//upload excel
    function do_upload() {
        $this->load->library('upload');
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls';
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        } else {

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

                $dataexcel[$i-1]['plc_function_id'] = $this->session->userdata('user_id') ;
                $dataexcel[$i - 1]['code'] = $data['cells'][$i][1];
                $dataexcel[$i - 1]['course_name'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['objective'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['material'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['requirement'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['duration'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['start_date'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['end_date'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['location'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['sifat'] = $data['cells'][$i][10];
            
            }
            



            delete_files($upload_data['file_path']);
            $this->mdl_course->add_dataexcel($dataexcel);
        }
        redirect("course");
    }
    
    
    function search($offset=0) {
        $data['title'] = 'Pencarian Program';
        $this->load->helper('dompdf');
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        /* Pagination */
        $config['base_url'] = site_url('course/search/');
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
          //      'Sasaran', 
            //    'Materi', 
             //   'Persaratan Peserta', 
                array('data' => 'Tanggal Pelaksanaan', 'width' => '180'), 
             //   'Durasi', 
                'Lokasi', 
             //   'Kursil', 
             //   array('data' => 'Status', 'width' => '90'), 
             //   array('data' => 'Tanggal Inisiasi', 'width' => '90'), 
             //   array('data' => 'Update Terakhir', 'width' => '90'), 
             //   array('data'=>'Aktifitas','width'=>'30'), 
                array('data' => 'Action', 'colspan' => 3, 'width' => '10')
        );
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $course_name = $this->input->post('course_name');
        $location = $this->input->post('location');
        $q = $this->mdl_course->get_index($this->limit, $offset, $month,$year, $course_name,$location)->result_array();
        $data['excel'] = anchor('course/to_exel/' . $month . '/' . $course_name, '<i class="icon-list icon-white"></i>&nbsp;Download Excel', array('class' => 'btn btn-success', 'rel' => 'tooltip', 'title' => 'Download Excel'));
        $i = 0 + $offset;
        $data['aktifitas'] = '';
        $data['cancel'] = '';
        $data['popup'] = '';
        foreach ($q as $row) {
 //           $start_date = $this->mdl_course->get_by_id($row['id'])->row()->start_date;
  //          $end_date = $this->mdl_course->get_by_id($row['id'])->row()->end_date;
  //          $selisih = strtotime($end_date) - strtotime($start_date);
/*
            $data['jml_date'] = $selisih / (60 * 60 * 24);
            if ($this->mdl_course->get_kursil_by_course($row['id'])->num_rows() <= 0) {
                $lbl_kursil = '<span class="label label-error">Belum Lengkap</span>';
                $rel_kursil = 'Klik untuk menambahkan kursil';
                $peserta_btn = anchor('peserta/view/' . $row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary'));
            } else {
                $lbl_kursil = '<span class="label label-success">Lengkap</span>';
                $rel_kursil = 'Klik untuk melihat kursil';
                $peserta_btn = anchor('peserta/view/' . $row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary'));
            }
            if ($this->mdl_course->get_peserta_by_course($row['id'])->num_rows() <= 0) {
                $lbl_peserta = '<span class="label label-error">Belum Lengkap</span>';
                $rel_peserta = 'Klik untuk menambahkan peserta';
                $kelengkapan_btn = '<button class="btn"><i class="icon-search icon-white"></i></button>';
            } else {
                $lbl_peserta = '<span class="label label-success">Lengkap</span>';
                $rel_peserta = 'Klik untuk melihat peserta';
                $kelengkapan_btn = anchor('activity/edit/' . $row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary'));
            }
            if (!$this->cek_kelengkapan($row['id'])) {
                $lbl_activity = '<span class="label label-error">Belum Lengkap</span>';
                $rel_activity = 'Klik untuk menambah kelengkapan';
            } else {
                $lbl_activity = '<span class="label label-success">Lengkap</span>';
                $rel_activity = 'Klik untuk melihat kelengkapan';
            }

            if ($this->mdl_course->get_by_id($row['id'])->row()->status == NULL) {
                if ($this->session->userdata('user_id') == 1 || $this->session->userdata('user_id') == 2 || $this->session->userdata('user_id') == 4) {
                    $status = anchor('course/close/' . $row['id'], 'Close', 'class="label label-info"') . '&nbsp;' . anchor('#popup' . $row['id'], 'Cancel', array('class' => 'label label-warning', 'data-toggle' => 'modal'));
                } else {
                    $status = '<span class="label label-info">Close</span>&nbsp;' . '<span class="label label-warning">Cancel</span>';
                }
                $data['popup'].=$this->editor->course_cancel($row['id']);
            } else {

                $ex_status = $this->mdl_course->get_by_id($row['id'])->row()->status;
                $ket_status = explode("#", $ex_status);
                if ($ket_status[0] == 1) {
                    $status = 'Closed <br>' . $ket_status[1];
                } else {

                    $status = anchor('#cancel' . $row['id'], 'Canceled', array('data-toggle' => 'modal')) . '<br>' . $ket_status[1];
                    $data['cancel'].=$this->editor->modal_cancel($row['id'], $ket_status[2]);
                }
            }
 * 
 */
            if ($this->session->userdata('user_id') == 1 || $this->session->userdata('user_id') == 2 || $this->session->userdata('user_id') == 4) {
                $edit = anchor('course/edit/' . $row['id'], '<i class="icon-wrench"></i>', array('rel' => 'tooltip', 'title' => 'Edit'));
                $duplicate = anchor('course/duplicate/' . $row['id'], '<i class="icon-plus-sign"></i>');
                $delete = anchor('course/delete/' . $row['id'], '<i class="icon-trash"></i>', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')", 'rel' => 'tooltip', 'title' => 'Delete'));
            } else {
                $edit = '<i class="icon-wrench"></i>';
                $delete = '<i class="icon-trash"></i>';
                $duplicate = '<i class="icon-plus-sign"></i>';
            }
//            $kursil_btn = anchor('course/kursil/' . $row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary', 'rel' => 'tooltip', 'title' => $rel_kursil));
  //          $view_btn = anchor('course/view_course/' . $row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary', 'rel' => 'tooltip', 'title' => $rel_kursil));

            if (is_numeric($row['location'])) {
                $lokasi=  $this->mdl_sarfas->get_class_by_id($row['location'])->row()->class_name;
            }else{
                $lokasi=$row['location'];
            }
            if (empty($row['kursil'])) {
                $kursil='<span class="label label-important">Belum Tersedia</span>';
            }  else {
                $kursil=  anchor('./assets/uploads/kursil/'.$row['kursil'], 'Download', array('class'=>'label label-success'));
            }

            $data['pic'] = $this->mdl_course->get_function_by_id($row['plc_function_id'])->row()->name;
            if ($this->session->userdata('chk')==NULL) {
                $chk='chk_umum';

            }else{
                $chk=$this->session->userdata('chk');                
            }
            $this->table->add_row(
                    ++$i, 
                    $row['code'], 
 anchor('monitoring/'.$chk.'/'.$row['id'], $row['course_name'].' '.$row['batch']), 
                   // $row['objective'], 
                   // $row['material'], 
                   // $row['requirement'], 
                    $this->editor->date_correct($row['start_date']).' s/d '.$this->editor->date_correct($row['end_date']), 
                    $lokasi, 
               //     $kursil, 
                   // $row['duration'] . ' Hari', 
                   // $data['pic'], 
                   // $status, 
                   // $this->editor->date_correct($row['insert_date']), 
                   // $this->editor->date_correct($row['update_date']), 
                 //   anchor('#aktifitas' . $row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-success', 'rel' => 'tooltip', 'title' => 'Klik untuk melihat aktifitas', 'data-toggle' => 'modal')), 
                    array('data' => $edit, 'width' => 10), 
                    array('data' => $delete, 'width' => 10), 
                    array('data' => $duplicate, 'width' => 10));
            
  //          $data['aktifitas'].=$this->editor->modal_aktifitas($row['id'], $view_btn, $lbl_kursil, $kelengkapan_btn, $lbl_activity, $peserta_btn, $lbl_peserta);
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('course/search', $data);


    }

}

/* End of file course.php */
/* Location: ./application/controllers/course.php */
