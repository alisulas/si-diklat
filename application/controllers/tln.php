<?php

class tln extends CI_Controller {

    //put your code here
    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_tln');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
    }

    function index($offset = 0) {
        $this->get_index($offset);
    }

    protected function get_index($offset) {
        $data['title'] = 'Data Training Luar Negeri';
        $data['tambah']=  anchor('tln/add', '<i class="icon-plus-sign icon-white"></i>&nbsp;Tambah', array('class'=>'btn btn-primary'));
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        
        $month = $this->input->post('month');
        $nama =  $this->input->post('nama');
        $nopek = $this->input->post('nopek');
        $judul = $this->input->post('judul');
        $tahun = $this->input->post('tahun');
        $status = $this->input->post('status');
      
        $config['base_url'] = site_url('tln/index');
        $config['total_rows'] = $this->mdl_tln->count_all($month,$tahun,$nopek,$nama,$judul,$status);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');

                /* Pagination */

      $this->table->set_heading(
              array('data' => 'No', 'width' => '20'), 
              array('data'=>'Nama','width'=>'140'), 
              'Nopek', 
              'Direktorat',
              'Judul', 
              'Lembaga',
              'Lokasi', 
              array('data' => 'Tanggal Pelaksanaan', 'width' => '170'), 
              array('data' => 'Status Pelaksanaan', 'width' => '20'), 
              array('data' => 'Keterangan', 'width' => '20'),
              'SLA Registrasi',
              'SLA Pembayaran',
              'Action'
        );
        $tbl_ln = $this->mdl_tln->get_index($this->limit, $offset, $month,$tahun,$nopek,$nama,$judul,$status)->result_array();
        $data['excel'] = anchor('tln/to_exel/'.$month.'/'.$tahun, '<i class="icon-list icon-white"></i>&nbsp;Download Excel', array('class' => 'btn btn-success'));
        $i = 0 + $offset;

        foreach ($tbl_ln as $row) {
            $edit = anchor('tln/edit/' . $row['id'], '<span class="label"><i class="icon-wrench"></i></span>', array('rel' => 'tooltip', 'title' => 'Edit Data'));
            $delete = anchor('tln/delete/' . $row['id'], '<span class="label"><i class="icon-trash"></i></span>', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')", 'rel' => 'tooltip', 'title' => 'Delete'));
            $view = anchor('tln/detail/' . $row['id'], '<span class="label"><i class="icon-search"></i></span>', array('rel' => 'tooltip', 'title' => 'Lihat Detail'));
        
            
            //---Start SLA
        $data['tln'] = $this->mdl_tln->get_by_id($row['id'])->row_array();
        $tgl_awal = $data['tln']['tgl_dokumen_lengkap'];
        $tgl_ahir = $data['tln']['tgl_registrasi'];
        $libur = $this->mdl_tln->get_libur()->result_array();
        $data_libur = '';
        foreach ($libur as $liburan) {
            $data_libur .= $liburan['date'] . '#';
        }

        $tgl_libur = explode('#', $data_libur);

        //$sla1=  strtotime($data['tln']['chk_reg_tgl']) - strtotime($data['tln']['prm_tgl_lengkap']);
        // $data['sla1'] = $sla1/(60*60*24);
        if ($tgl_awal==0 ||$tgl_ahir==0) {
            $sla1='<span class="label label-important">Belum Lengkap</span>';
        }elseif (strtotime($tgl_awal)>  strtotime($tgl_ahir)) {
         $sla1='<span class="label label-important">Salah Input Tanggal</span>';   
        }  else {
         $sla1 = $this->editor->hitung_sla($tgl_awal, $tgl_ahir, $tgl_libur);   
        }
            
        
            $sla_tgl_awal = $data['tln']['tgl_inv_masuk'];
            $sla_tgl_akhir = $data['tln']['tgl_terima_ls'];
            if ($sla_tgl_awal==0||$sla_tgl_akhir==0) {
            $sla2='<span class="label label-important">Belum Lengkap</span>';
        }elseif (strtotime($sla_tgl_awal)>strtotime($sla_tgl_akhir)) {
            $sla2='<span class="label label-important">Salah Input Tanggal</span>';    
            }  else {
             $sla2 = $this->editor->hitung_sla($sla_tgl_awal, $sla_tgl_akhir, $tgl_libur);    
            }
            
        // ---End SLA
        
            $this->table->add_row(
                    ++$i,
                    array('data'=>$row['nama'],'width'=>'100'), 
                    $row['nopek'], 
                    $row['direktorat'],                      
                    $row['judul'], 
                    $row['lembaga'],
                    $row['lokasi'],
                    $this->editor->date_correct($row['tgl_mulai_tln']) . ' - ' . $this->editor->date_correct($row['tgl_akhir_tln']), 
                    $row['status_pelaksanaan_tln'],
                    $row['ket_pelaksanaan_tln'],  
                    $sla1, 
                    $sla2, 
                    $view.'&nbsp;'.$edit.'&nbsp;'.$delete
            );
        }

        $get_libur = $this->mdl_tln->get_libur()->result_array();
        $a = 0;
        $hari_libur = '';
        foreach ($get_libur as $libur) {
            $hari_libur .='<tr><td>' . ++$a . '</td><td>' . $this->editor->date_correct($libur['date']) . '</td></tr>';
        }
        $data['libur'] = $hari_libur;
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('tln/index', $data);

    }

    function to_exel($month=0, $name=0,$tahun=0) {
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
        $this->table->set_caption("Daftar Training Luar Negeri");

       $this->table->set_heading(
                'Tanggal Permintaan',
                'Memo Permintaan',
                'Terima Permintaan Via',
                'Perencanaan',
                'Nilai Toeic',
                'Ket Toeic',
                'Persetujuan HRBP',
                'Persetujuan HRBP Via',
                'Tanggal Mulai TLN',
                'Tanggal Akhir TLN',
                'SPD',
                'SPD Berangkat',
                'SPD Pulang',
                'Tanggal Konfirmasi Provider',
                'Tanggal Dokumen Lengkap',
                'Tanggal Registrasi',
                'Registrasi Via',
                'Nama',
                'Nopek',
                'Direktorat',
                'Lembaga',
                'Judul',
                'Kontak',
                'Email',
                'Lokasi',
                'Mekanisme Pembayaran',
                'Tgl Invoice Masuk',
                'No Invoice',
                'Mata Uang',
                'Jumlah',
                'Letter Of Guarantee Provider',
                'Tanggal Terima LS',
                'Status Pelaksanaan TLN',
                'Ket Pelaksanaan TLN',
                'SP',
                'Tgl Pembuatan SP',
                'Tgl Pengiriman Reminder',
                'Bukti Kehadiran',
                'Feedback',
                'Tgl Terima Dokumen',
                'Tgl Dokumen ke LS',
                'SLA Registrasi',
                'SLA Pembayaran'                                
        );
       
        $q = $this->mdl_tln->get_exel($month, $name,$tahun)->result_array();

        foreach ($q as $row) {
$bkt_kehadiran = explode('@', $row['bukti_kehadiran']);
$bukti='';
     for ($b=0;$b<count($bkt_kehadiran);$b++){
   $bukti.=$bkt_kehadiran[$b].',';
            }           
            
          //---Start SLA
        $tgl_awal = $row['tgl_dokumen_lengkap'];
        $tgl_ahir = $row['tgl_registrasi'];
        $libur = $this->mdl_tln->get_libur()->result_array();
        $data_libur = '';
        foreach ($libur as $liburan) {
            $data_libur .= $liburan['date'] . '#';
        }

                 $tgl_libur = explode('#', $data_libur);
      if ($tgl_awal==0 ||$tgl_ahir==0) {
            $sla1='<span class="label label-important">Belum Lengkap</span>';
        }elseif (strtotime($tgl_awal)>  strtotime($tgl_ahir)) {
         $sla1='<span class="label label-important">Salah Input Tanggal</span>';   
        }  else {
         $sla1 = $this->editor->hitung_sla($tgl_awal, $tgl_ahir, $tgl_libur);   
        }

            $sla_tgl_awal = $row['tgl_inv_masuk'];
            $sla_tgl_akhir = $row['tgl_terima_ls'];
            if ($sla_tgl_awal==0||$sla_tgl_akhir==0) {
            $sla2='<span class="label label-important">Belum Lengkap</span>';
        }elseif (strtotime($sla_tgl_awal)>strtotime($sla_tgl_akhir)) {
            $sla2='<span class="label label-important">Salah Input Tanggal</span>';    
            }  else {
             $sla2 = $this->editor->hitung_sla($sla_tgl_awal, $sla_tgl_akhir, $tgl_libur);    
            }
            // ---End SLA

            $this->table->add_row(
                    $row['tgl_permintaan'],
 $this->cek_ada($row['memo_permintaan']),
                    $row['terima_permintaan_via'],
 $this->cek_ada($row['perencanaan']),
                    $row['nilai_toeic'],
 $this->cek_memenuhi($row['ket_toeic']),
 $this->cek_ada($row['persetujuan_hrbp']),
                    $row['persetujuan_hrbp_via'],
                    $row['tgl_mulai_tln'],
                    $row['tgl_akhir_tln'],
 $this->cek_ada($row['spd']),
                    $row['spd_berangkat'],
                    $row['spd_pulang'],
                    $row['tgl_konfirmasi_provider'],
                    $row['tgl_dokumen_lengkap'],
                    $row['tgl_registrasi'],
                    $row['reg_via'],
                    $row['nama'],
                    $row['nopek'],
                    $row['direktorat'],
                    $row['lembaga'],
                    $row['judul'],
                    $row['kontak'],
                    $row['email'],
                    $row['lokasi'],
                    $row['mekanisme_pembayaran'],
                    $row['tgl_inv_masuk'],
                    $row['no_inv'],
                    $row['keu_currency'],
                    $row['inv_jumlah'],
 $this->cek_ada($row['log_provider']),
                    $row['tgl_terima_ls'],
                    $row['status_pelaksanaan_tln'],
                    $row['ket_pelaksanaan_tln'],
                    $row['sp'],
                    $row['tgl_pembuatan_sp'],
                    $row['tgl_pengiriman_reminder'],
                    $bukti,
 $this->cek_ada($row['feedback']),
                    $row['tgl_terima_dokumen'],
                    $row['tgl_dokumen_ls'],
                    $sla1,
                    $sla2
            );
        }
        //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=tln.xls");  //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        echo $data['content'];
    }
    
    function cek_ada($dat) {
    if ($dat==1) {
        return 'Ada';
    }  else {
        return 'Tidak Ada'; 
    }
}

    
    function cek_memenuhi($dat) {
    if ($dat==1) {
        return 'Memenuhi';;
    }  else {
        return 'Tidak Memenuhi';;
    }    
    }

    function add() {
        $data['title'] = 'Input Data Training Luar Negeri';
        $data['limk_back'] = site_url('tln/index');
        $data['action'] = 'tln/add';
        $this->_set_rules();

        if ($this->form_validation->run() === FALSE) {
            
            $data['tln']['tgl_permintaan']='';
            $data['tln']['memo_permintaan']='';
            $data['tln']['nilai_toeic']='';
            $data['tln']['ket_toeic']='';
            $data['tln']['persetujuan_hrbp']='';
            $data['tln']['tgl_mulai_tln']='';
            $data['tln']['tgl_akhir_tln']='';
            $data['tln']['spd']='';
            $data['tln']['spd_berangkat']='';
            $data['tln']['spd_pulang']='';
            $data['tln']['tgl_konfirmasi_provider']='';
            $data['tln']['tgl_dokumen_lengkap']='';
            $data['tln']['tgl_registrasi']='';
            $data['tln']['nama']='';
            $data['tln']['nopek']='';
            $data['tln']['direktorat']='';
            $data['tln']['lembaga']='';
            $data['tln']['judul']='';
            $data['tln']['kontak']='';
            $data['tln']['email']='';
            $data['tln']['lokasi']='';
            $data['tln']['tgl_inv_masuk']='';
            $data['tln']['no_inv']='';
            $data['tln']['inv_jumlah']='';
            $data['tln']['keu_currency']='';
            $data['tln']['log_provider']='';
            $data['tln']['tgl_terima_ls']='';
            $data['tln']['ket_pelaksanaan_tln']='';
            $data['tln']['sp']='';
            $data['tln']['tgl_pembuatan_sp']='';
            $data['tln']['tgl_pengiriman_reminder']='';
            $data['tln']['feedback']='';
            $data['tln']['tgl_terima_dokumen']='';
            $data['tln']['tgl_dokumen_ls']='';
            
 
            $opt_terima_permintaan_via = array(
                'e-Corr' => 'e-Corr',
                'e-Mail' => 'e-Mail'
            );
            $opt_persetujuan_hrbp_via = array(
                'Memo' => 'Memo',
                'Form Rekomendasi' => 'Form Rekomendasi',
                'e-Mail'=>'e-Mail'
            );
    
            
            $opt_direktorat = array(
                '-' => '-',
                'Corporate Secretary' => 'Corporate Secretary',
                'Chief Audit Executive' => 'Chief Audit Executive',
                'Chief Legal Councel & Compliance' => 'Chief Legal Councel & Compliance',
                'Integrated Supply Chain' => 'Integrated Supply Chain',
                'Hulu' => 'Hulu',
                'Energi Baru & Terbarukan' => 'Energi Baru & Terbarukan',
                'Pengolahan' => 'Pengolahan',
                'Pemasaran' => 'Pemasaran',
                'Keuangan' => 'Keuangan',
                'SDM & Umum' => 'SDM & Umum'
            );
            
            $opt_perencanaan = array(
                'RKA' => 'RKA',
                'Ad Hoc' => 'Ad Hoc'
            );              
            $opt_reg_via = array(
                'e-Mail' => 'e-Mail',
                'Website' => 'Website',
                'Registrasi Sendiri'=>'Registrasi Sendiri',
                'Undangan'=>'Undangan'
            );  
            $opt_mekanisme_pembayaran = array(
                'Pembayaran Dimuka' => 'Pembayaran Dimuka',
                'Reimbursement' => 'Reimbursement',
                'Penagihan'=>'Penagihan',
                'Gratis'=>'Gratis'
            );  
           $opt_status_pelaksanaan_tln = array(
               'Pending Dokumen'=>'Pending Dokumen',
                'Siap Dilaksanakan' => 'Siap Dilaksanakan',
                'Sudah Dilaksanakan' => 'Sudah Dilaksanakan',
                'Reschedule'=>'Reschedule',
                'Batal'=>'Batal' 
            ); 
           
           $opt_permintaan_dari=array(
               'Fungsi'=>'Fungsi',
               'HRBP'=>'HRBP'
           );
           
            $data['bkt']='add';
            $data['dir']='add';
            $data['permintaan_dari'] = form_dropdown('permintaan_dari', $opt_permintaan_dari);
            $data['terima_permintaan_via'] = form_dropdown('terima_permintaan_via', $opt_terima_permintaan_via);
            $data['reg_via'] = form_dropdown('reg_via', $opt_reg_via);            
            $data['persetujuan_hrbp_via'] = form_dropdown('persetujuan_hrbp_via', $opt_persetujuan_hrbp_via);
            $data['perencanaan'] = form_dropdown('perencanaan', $opt_perencanaan);
            $data['status_pelaksanaan_tln'] = form_dropdown('status_pelaksanaan_tln', $opt_status_pelaksanaan_tln);            
            $data['mekanisme_pembayaran']=  form_dropdown('mekanisme_pembayaran', $opt_mekanisme_pembayaran);
            $data['direktorat'] = form_dropdown('direktorat', $opt_direktorat, '', 'style="width:150px"');

            $this->template->display('tln/form', $data);
        } else {
/*
            $this->upload->initialize(array(
                'upload_path' => './assets/uploads/tln/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));

            if (!$this->upload->do_upload('up_via')) {
                $up_via = $this->input->post('up_via2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $up_via = $unggah['file_name'];
            }
 * 
 */
            $bkt_kehadiran=$this->input->post('bukti_kehadiran');
            for ($b=0;$b<count($bkt_kehadiran);$b++){
            $bukti_kehadiran .= $bkt_kehadiran[$b].'@';    
            }
            
            $tln = array(
                'permintaan_dari'=>  $this->input->post('permintaan_dari'),
                'tgl_permintaan' => $this->input->post('tgl_permintaan'),
                'memo_permintaan' => $this->input->post('memo_permintaan'),
                'terima_permintaan_via' => $this->input->post('terima_permintaan_via'),
                'perencanaan' => $this->input->post('perencanaan'),
                'nilai_toeic' => $this->input->post('nilai_toeic'),
                'ket_toeic' => $this->input->post('ket_toeic'),
                'persetujuan_hrbp' => $this->input->post('persetujuan_hrbp'),
                'persetujuan_hrbp_via' => $this->input->post('persetujuan_hrbp_via'),
                'tgl_mulai_tln' => $this->input->post('tgl_mulai_tln'),
                'tgl_akhir_tln' => $this->input->post('tgl_akhir_tln'),
                'spd' => $this->input->post('spd'),
                'spd_berangkat' => $this->input->post('spd_berangkat'),
                'spd_pulang' => $this->input->post('spd_pulang'),
                'tgl_konfirmasi_provider' => $this->input->post('tgl_konfirmasi_provider'),
                'tgl_dokumen_lengkap' => $this->input->post('tgl_dokumen_lengkap'),
                'tgl_registrasi' => $this->input->post('tgl_registrasi'),
                'reg_via' => $this->input->post('reg_via'),
                'nama' => $this->input->post('nama'),
                'nopek' => $this->input->post('nopek'),
                'direktorat' => $this->input->post('direktorat'),
                'lembaga' => $this->input->post('lembaga'),
                'judul' => $this->input->post('judul'),
                'kontak' => $this->input->post('kontak'),
                'email' => $this->input->post('email'),
                'lokasi' => $this->input->post('lokasi'),
                'mekanisme_pembayaran' => $this->input->post('mekanisme_pembayaran'),
                'tgl_inv_masuk' => $this->input->post('tgl_inv_masuk'),
                'no_inv' => $this->input->post('no_inv'),
                'keu_currency' => $this->input->post('keu_currency'),
                'inv_jumlah' => $this->input->post('inv_jumlah'),
                'log_provider' => $this->input->post('log_provider'),
                'tgl_terima_ls' => $this->input->post('tgl_terima_ls'),
                'status_pelaksanaan_tln' => $this->input->post('status_pelaksanaan_tln'),
                'ket_pelaksanaan_tln' => $this->input->post('ket_pelaksanaan_tln'),
                'sp' => $this->input->post('sp'),
                'tgl_pembuatan_sp'=>  $this->input->post('tgl_pembuatan_sp'),
                'tgl_pengiriman_reminder'=>  $this->input->post('tgl_pengiriman_reminder'),
                'bukti_kehadiran'=>  $bukti_kehadiran,
                'feedback'=>  $this->input->post('feedback'),
                'tgl_terima_dokumen'=>  $this->input->post('tgl_terima_dokumen'),
                'tgl_dokumen_ls'=>  $this->input->post('tgl_dokumen_ls'),
                'insert_date'=>  date('Y-m-d G:i:s'),
                'update_date'=>  date('Y-m-d G:i:s')
            );
            $id = $this->mdl_tln->add($tln);
            $this->validation->no = $id;
            $this->session->set_flashdata('msg', $this->editor->alert_ok('Data Berhasil Ditambahkan'));
            redirect('tln/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Training Luar Negeri';
        $data['link_back'] = site_url('tln/index');
        $data['action'] = 'tln/edit/' . $id;
        $this->_set_rules();
        if ($this->form_validation->run() == FALSE) {
        $data['tln'] = $this->mdl_tln->get_by_id($id)->row_array();
        $data['bukti_kehadiran']=  explode('@', $data['tln']['bukti_kehadiran']);
        $opt_terima_permintaan_via = array(
                'e-Corr' => 'e-Corr',
                'e-Mail' => 'e-Mail'
            );
            $opt_persetujuan_hrbp_via = array(
                'Memo' => 'Memo',
                'Form Rekomendasi' => 'Form Rekomendasi',
                'e-Mail'=>'e-Mail'
            );
            
            $opt_direktorat = array(
                '-' => '-',
                'Corporate Secretary' => 'Corporate Secretary',
                'Chief Audit Executive' => 'Chief Audit Executive',
                'Chief Legal Councel & Compliance' => 'Chief Legal Councel & Compliance',
                'Integrated Supply Chain' => 'Integrated Supply Chain',
                'Hulu' => 'Hulu',
                'Energi Baru & Terbarukan' => 'Energi Baru & Terbarukan',
                'Pengolahan' => 'Pengolahan',
                'Pemasaran' => 'Pemasaran',
                'Keuangan' => 'Keuangan',
                'SDM & Umum' => 'SDM & Umum'
            );
            
            $opt_perencanaan = array(
                'RKA' => 'RKA',
                'Ad Hoc' => 'Ad Hoc'
            );              
            $opt_reg_via = array(
                'e-Mail' => 'e-Mail',
                'Website' => 'Website',
                'Registrasi Sendiri'=>'Registrasi Sendiri',
                'Undangan'=>'Undangan'
            );  
            $opt_mekanisme_pembayaran = array(
                'Pembayaran Dimuka' => 'Pembayaran Dimuka',
                'Reimbursement' => 'Reimbursement',
                'Penagihan'=>'Penagihan',
                'Gratis'=>'Gratis'
            );
               $opt_status_pelaksanaan_tln = array(
               'Pending Dokumen'=>'Pending Dokumen',
                'Siap Dilaksanakan' => 'Siap Dilaksanakan',
                'Sudah Dilaksanakan' => 'Sudah Dilaksanakan',
                'Reschedule'=>'Reschedule',
                'Batal'=>'Batal' 
            ); 
           
           $opt_permintaan_dari = array(
                'Fungsi' => 'Fungsi',
                'HRBP' => 'HRBP'
            );

            $data['dir']='edit';
            $data['bkt']='edit';
            $data['permintaan_dari'] = form_dropdown('permintaan_dari', $opt_permintaan_dari,$this->mdl_tln->get_by_id($id)->row()->permintaan_dari);
            $data['terima_permintaan_via'] = form_dropdown('terima_permintaan_via', $opt_terima_permintaan_via,$this->mdl_tln->get_by_id($id)->row()->terima_permintaan_via);
            $data['reg_via'] = form_dropdown('reg_via', $opt_reg_via,$this->mdl_tln->get_by_id($id)->row()->reg_via);            
            $data['direktorat'] = form_dropdown('direktorat', $opt_direktorat,$this->mdl_tln->get_by_id($id)->row()->direktorat);            
            $data['persetujuan_hrbp_via'] = form_dropdown('persetujuan_hrbp_via', $opt_persetujuan_hrbp_via,$this->mdl_tln->get_by_id($id)->row()->persetujuan_hrbp_via);
            $data['perencanaan'] = form_dropdown('perencanaan', $opt_perencanaan,$this->mdl_tln->get_by_id($id)->row()->perencanaan);
            $data['status_pelaksanaan_tln'] = form_dropdown('status_pelaksanaan_tln', $opt_status_pelaksanaan_tln,$this->mdl_tln->get_by_id($id)->row()->status_pelaksanaan_tln);            
            $data['mekanisme_pembayaran']=  form_dropdown('mekanisme_pembayaran', $opt_mekanisme_pembayaran,$this->mdl_tln->get_by_id($id)->row()->mekanisme_pembayaran);
           
        } else {
            $bkt_kehadiran=$this->input->post('bukti_kehadiran');
            for ($b=0;$b<count($bkt_kehadiran);$b++){
            $bukti_kehadiran .= $bkt_kehadiran[$b].'@';    
            }
            
            $tln = array(
                'permintaan_dari'=>  $this->input->post('permintaan_dari'),
                'tgl_permintaan' => $this->input->post('tgl_permintaan'),
                'memo_permintaan' => $this->input->post('memo_permintaan'),
                'terima_permintaan_via' => $this->input->post('terima_permintaan_via'),
                'perencanaan' => $this->input->post('perencanaan'),
                'nilai_toeic' => $this->input->post('nilai_toeic'),
                'ket_toeic' => $this->input->post('ket_toeic'),
                'persetujuan_hrbp' => $this->input->post('persetujuan_hrbp'),
                'persetujuan_hrbp_via' => $this->input->post('persetujuan_hrbp_via'),
                'tgl_mulai_tln' => $this->input->post('tgl_mulai_tln'),
                'tgl_akhir_tln' => $this->input->post('tgl_akhir_tln'),
                'spd' => $this->input->post('spd'),
                'spd_berangkat' => $this->input->post('spd_berangkat'),
                'spd_pulang' => $this->input->post('spd_pulang'),
                'tgl_konfirmasi_provider' => $this->input->post('tgl_konfirmasi_provider'),
                'tgl_dokumen_lengkap' => $this->input->post('tgl_dokumen_lengkap'),
                'tgl_registrasi' => $this->input->post('tgl_registrasi'),
                'reg_via' => $this->input->post('reg_via'),
                'nama' => $this->input->post('nama'),
                'nopek' => $this->input->post('nopek'),
                'direktorat' => $this->input->post('direktorat'),
                'lembaga' => $this->input->post('lembaga'),
                'judul' => $this->input->post('judul'),
                'kontak' => $this->input->post('kontak'),
                'email' => $this->input->post('email'),
                'lokasi' => $this->input->post('lokasi'),
                'mekanisme_pembayaran' => $this->input->post('mekanisme_pembayaran'),
                'tgl_inv_masuk' => $this->input->post('tgl_inv_masuk'),
                'no_inv' => $this->input->post('no_inv'),
                'keu_currency' => $this->input->post('keu_currency'),
                'inv_jumlah' => $this->input->post('inv_jumlah'),
                'log_provider' => $this->input->post('log_provider'),
                'tgl_terima_ls' => $this->input->post('tgl_terima_ls'),
                'status_pelaksanaan_tln' => $this->input->post('status_pelaksanaan_tln'),
                'ket_pelaksanaan_tln' => $this->input->post('ket_pelaksanaan_tln'),
                'sp' => $this->input->post('sp'),
                'tgl_pembuatan_sp'=>  $this->input->post('tgl_pembuatan_sp'),
                'tgl_pengiriman_reminder'=>  $this->input->post('tgl_pengiriman_reminder'),
                'bukti_kehadiran'=>  $bukti_kehadiran,
                'feedback'=>  $this->input->post('feedback'),
                'tgl_terima_dokumen'=>  $this->input->post('tgl_terima_dokumen'),
                'tgl_dokumen_ls'=>  $this->input->post('tgl_dokumen_ls'),              
                'update_date'=>  date('Y-m-d G:i:s')
            );
            $id = $this->mdl_tln->update($id,$tln);
            $this->validation->no = $id;
            $this->session->set_flashdata('msg', $this->editor->alert_ok('Data Berhasil Ditambahkan'));
            redirect('tln/index');
        }
        $this->template->display('tln/form', $data);
    }

    function detail($id) {
        $data['title'] = 'Detail Training Luar Negeri';
        $data['tln'] = $this->mdl_tln->get_by_id($id)->row_array();
        $data['bukti_kehadiran']=  explode('@', $data['tln']['bukti_kehadiran']);
        
        //---Start SLA
        $data['tln'] = $this->mdl_tln->get_by_id($id)->row_array();
        $tgl_awal = $data['tln']['tgl_dokumen_lengkap'];
        $tgl_ahir = $data['tln']['tgl_registrasi'];
        $libur = $this->mdl_tln->get_libur()->result_array();
        $data_libur = '';
        foreach ($libur as $liburan) {
            $data_libur .= $liburan['date'] . '#';
        }

            $tgl_libur = explode('#', $data_libur);
      if ($tgl_awal==0 ||$tgl_ahir==0) {
            $data['sla1']='<span class="label label-important">Belum Lengkap</span>';
        }elseif (strtotime($tgl_awal)>  strtotime($tgl_ahir)) {
         $data['sla1']='<span class="label label-important">Salah Input Tanggal</span>';   
        }  else {
         $data['sla1'] = $this->editor->hitung_sla($tgl_awal, $tgl_ahir, $tgl_libur);   
        }

            $sla_tgl_awal = $data['tln']['tgl_inv_masuk'];
            $sla_tgl_akhir = $data['tln']['tgl_terima_ls'];
            if ($sla_tgl_awal==0||$sla_tgl_akhir==0) {
            $data['sla2']='<span class="label label-important">Belum Lengkap</span>';
        }elseif (strtotime($sla_tgl_awal)>strtotime($sla_tgl_akhir)) {
            $data['sla2']='<span class="label label-important">Salah Input Tanggal</span>';    
            }  else {
             $data['sla2'] = $this->editor->hitung_sla($sla_tgl_awal, $sla_tgl_akhir, $tgl_libur);    
            }
            // ---End SLA
            
        $this->template->display('tln/detail', $data);
    }

    function _set_rules() {
        $this->form_validation->set_rules('nama', 'Nama Peserta ', 'required|trim');
    }

    function delete($id) {
        $this->mdl_tln->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Data ' . $id . ' berhasil dihapus</div>');
        redirect('tln');
    }

    function cancel($id) {
        $this->upload->initialize(array(
            'upload_path' => './assets/uploads/tln/',
            'allowed_types' => '*',
            'max_size' => 5000, // 5MB
            'remove_spaces' => true,
            'overwrite' => false
        ));

        if (!$this->upload->do_upload('memo')) {
            $data_memo = $this->input->post('memo');
        } else {
            $unggah = $this->upload->data();
            $unggah['file_name'];
            $data_memo = $unggah['file_name'];
        }

        $date_now = $this->editor->date_correct(date('Y-m-d'));
        $data = array(
            'status' => '2#' . $date_now . '#' . $this->input->post('ket') . '#' . $data_memo,
            'update_date' => date('Y-m-d G:i:s')
        );
        $this->mdl_tln->update_status($id, $data);
        redirect('tln');
    }

    function close($id) {
        $date_now = $this->editor->date_correct(date('Y-m-d'));
        $data = array(
            'status' => '1#' . $date_now,
            'update_date' => date('Y-m-d G:i:s')
        );
        $this->mdl_tln->update_status($id, $data);
        redirect('tln');
    }

    function do_upload() {
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls';

        $this->upload->initialize($config);
        $this->load->library('upload');


        if (!$this->upload->do_upload()) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        } else {
            $data = array('error' => false);
            $upload_data = $this->upload->data();

            $this->load->library('spreadsheet_excel_reader');
            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $file = $upload_data['full_path'];
            $this->spreadsheet_excel_reader->read($file);
            error_reporting(E_ALL ^ E_NOTICE);

            // Sheet 1
            $data = $this->spreadsheet_excel_reader->sheets[0];
            $dataexcel = Array();
            for ($i = 1; $i <= $data['numRows']; $i++) {

                if ($data['cells'][$i][1] == '')
                    break;
                $dataexcel[$i - 1]['prm_kegiatan'] = $data['cells'][$i][1];
                $dataexcel[$i - 1]['prm_via'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['prm_tgl'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['prm_tgl_lengkap'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['inf_nama'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['inf_nopek'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['inf_direktorat'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['inf_lembaga'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['inf_judul'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['inf_kontak'] = $data['cells'][$i][10];
                $dataexcel[$i - 1]['inf_email'] = $data['cells'][$i][11];
                $dataexcel[$i - 1]['inf_lokasi'] = $data['cells'][$i][12];
                $dataexcel[$i - 1]['inf_tgl_mulai'] = $data['cells'][$i][13];
                $dataexcel[$i - 1]['inf_tgl_selesai'] = $data['cells'][$i][14];
                $dataexcel[$i - 1]['chk_disposisi'] = $data['cells'][$i][15];
                $dataexcel[$i - 1]['chk_persetujuan'] = $data['cells'][$i][16];
                $dataexcel[$i - 1]['chk_reg_via'] = $data['cells'][$i][17];
                $dataexcel[$i - 1]['chk_reg_tgl'] = $data['cells'][$i][18];
                $dataexcel[$i - 1]['prt_feedback'] = $data['cells'][$i][19];
                $dataexcel[$i - 1]['prt_tgl'] = $data['cells'][$i][20];
                $dataexcel[$i - 1]['keu_inv_no'] = $data['cells'][$i][21];
                $dataexcel[$i - 1]['inv_currency'] = $data['cells'][$i][22];
                $dataexcel[$i - 1]['keu_inv_jumlah'] = $data['cells'][$i][23];
                $dataexcel[$i - 1]['keu_inv_tgl'] = $data['cells'][$i][24];
                $dataexcel[$i - 1]['keu_sp'] = $data['cells'][$i][25];
                $dataexcel[$i - 1]['keu_tgl'] = $data['cells'][$i][26];
                $dataexcel[$i - 1]['keu_prosedur'] = $data['cells'][$i][27];
                $dataexcel[$i - 1]['status_proses'] = $data['cells'][$i][28];
                $dataexcel[$i - 1]['keterangan'] = $data['cells'][$i][29];
            }


            delete_files($upload_data['file_path']);
            $this->mdl_tln->add_dataexcel($dataexcel);
        }
        redirect("tln");
    }

}

?>
