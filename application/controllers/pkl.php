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
        $this->load->model('mdl_pkl');
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
     $this->template->display('pkl/form_input_pkl',$data);
     }  else {
                 $this->upload->initialize(array(
                'upload_path' => './assets/uploads/pkl/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));

            if(!$this->upload->do_upload('file_surat_pengantar'))
            {
                $file_surat_pengantar=$this->input->post('file_surat_pengantar2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_surat_pengantar=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('form_a'))
            {
                $form_a=$this->input->post('form_a2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $form_a=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('proposal'))
            {
                $proposal=$this->input->post('proposal2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $proposal=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('cv'))
            {
                $cv=$this->input->post('cv2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $cv=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_ecorr_fungsi'))
            {
                $file_ecorr_fungsi=$this->input->post('file_ecorr_fungsi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_ecorr_fungsi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_memo_balasan_fungsi'))
            {
                $file_memo_balasan_fungsi=$this->input->post('file_memo_balasan_fungsi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_memo_balasan_fungsi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_panggilan'))
            {
                $file_panggilan=$this->input->post('file_panggilan2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_panggilan=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_spkp'))
            {
                $file_spkp=$this->input->post('file_spkp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_spkp=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_surat_ket_pkl'))
            {
                $file_surat_ket_pkl=$this->input->post('file_surat_ket_pkl2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_surat_ket_pkl=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_norek'))
            {
                $file_norek=$this->input->post('file_norek2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_norek=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_absensi'))
            {
                $file_absensi=$this->input->post('file_absensi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_absensi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_ktm'))
            {
                $file_ktm=$this->input->post('file_ktm2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_ktm=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_sp3'))
            {
                $file_sp3=$this->input->post('file_sp32');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_sp3=$unggah['file_name'];
            }


         $pkl=array(
             'nama'=>$this->input->post('nama'),
             'nim'=>  $this->input->post('nim'),
             'hp'=>  $this->input->post('hp'),
             'email'=>  $this->input->post('email'),
             'perguruan_tinggi'=>  $this->input->post('perguruan_tinggi'),
             'alamat_pt'=>  $this->input->post('alamat_pt'),
             'akreditasi_pt'=> $this->input->post('akreditasi_pt'),
             'fakultas'=>  $this->input->post('fakultas'),
             'prodi'=> $this->input->post('prodi'),
             'akreditasi_prodi'=>  $this->input->post('akreditasi_prodi'),
             'jenjang'=> $this->input->post('jenjang'),
             'jml_sks'=> $this->input->post('jml_sks'),
             'ipk'=>  $this->input->post('ipk'),
             'no_surat_pengantar'=> $this->input->post('no_surat_pengantar'),
             'file_surat_pengantar'=>  $file_surat_pengantar,
             'tgl_surat_pengantar'=>  $this->input->post('tgl_surat_pengantar'),
             'tgl_surat_pengantar_diterima'=>  $this->input->post('tgl_surat_pengantar_diterima'),
             'jenis'=>  $this->input->post('jenis'),
             'form_a'=>  $form_a,
             'proposal'=>  $proposal,
             'cv'=>$cv,
             'no_identitas_memo_ls'=>  $this->input->post('no_identitas_memo_ls'),
             'no_ecorr_fungsi'=>  $this->input->post('no_ecorr_fungsi'),
             'tgl_ecorr_fungsi'=>  $this->input->post('tgl_ecorr_fungsi'),
             'file_ecorr_fungsi'=>  $file_ecorr_fungsi,
             'tujuan_fungsi'=>  $this->input->post('tujuan_fungsi'),
             'durasi'=>  $this->input->post('durasi'),
             'tgl_mulai'=>  $this->input->post('tgl_mulai'),
             'tgl_selesai'=>  $this->input->post('tgl_selesai'),
             'file_memo_balasan_fungsi'=>  $file_memo_balasan_fungsi,
             'no_ecorr_respon_fungsi'=>  $this->input->post('no_ecorr_respon_fungsi'),
             'respon_persetujuan_pkl'=>  $this->input->post('respon_persetujuan_pkl'),
             'ket_fungsi_ecorr'=>  $this->input->post('ket_fungsi_ecorr'),
             'no_surat_ref_gabungan'=>  $this->input->post('no_surat_ref_gabungan'),
             'tgl_surat_keluar'=>  $this->input->post('tgl_surat_keluar'),
             'no_panggilan'=>  $this->input->post('no_panggilan'),
             'file_panggilan'=>  $file_panggilan,
             'no_spkp'=>  $this->input->post('no_spkp'),
             'file_spkp'=>  $file_spkp,
             'no_surat_ket_pkl'=>  $this->input->post('no_surat_ket_pkl'),
             'file_surat_ket_pkl'=>  $file_surat_ket_pkl,
             'norek'=>  $this->input->post('norek'),
             'file_norek'=>  $file_norek,
             'bank'=>  $this->input->post('bank'),
             'file_absensi'=>  $file_absensi,
             'file_ktm'=>  $file_ktm,
             'file_sp3'=>  $file_sp3,
             'status'=>  $this->input->post('status'),
             'ket'=>  $this->input->post('ket'),
             'insert_date'=> date('Y-m-d G:i:s'),
             'user'=> $this->session->userdata('user_name')
         );
         $nim=$this->input->post('nim');
         if($this->mdl_pkl->get_by_nim($nim)<1){
           $this->mdl_pkl->add_pkl($pkl);
           $this->session->set_flashdata('msg','<div class="alert alert-success">Data baru berhasil ditambahkan</div>');
     redirect('pkl/list_pkl');
   }else {
     echo "<script type='text/javascript'>alert('NIM yang Anda masukan sudah terdaftar');window.history.back()</script>";
   }

     }
    }

    function edit_pkl($id) {
     $data['title']='Edit Data PKL';
     $data['link_back']=site_url('pkl/list_pkl');
     $data['action']='pkl/edit_pkl/'.$id;
     $this->__set_rules_pkl();
     if ($this->form_validation->run()==FALSE) {
        $data['pkl']=$this->mdl_pkl->get_pkl_by_id($id)->row_array();
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
    $opt_akreditasi=array(
     'A'=>'A',
     'B'=>'B',
     'C'=>'C'
    );

    $data['akreditasi_pt']=  form_dropdown('akreditasi_pt',$opt_akreditasi ,$data['pkl']['akreditasi_pt']);
    $data['akreditasi_prodi']=  form_dropdown('akreditasi_prodi',$opt_akreditasi ,$data['pkl']['akreditasi_prodi']);
    $data['jenis']= form_dropdown('jenis', $opt_jenis,$data['pkl']['jenis']);
    $data['jenjang']= form_dropdown('jenjang', $opt_program, $data['pkl']['jenjang']);

        $this->template->display('pkl/form_edit_pkl',$data);
     }  else {
                 $this->upload->initialize(array(
                'upload_path' => './assets/uploads/pkl/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));

            if(!$this->upload->do_upload('file_surat_pengantar'))
            {
                $file_surat_pengantar=$this->input->post('file_surat_pengantar2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_surat_pengantar=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('form_a'))
            {
                $form_a=$this->input->post('form_a2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $form_a=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('proposal'))
            {
                $proposal=$this->input->post('proposal2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $proposal=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('cv'))
            {
                $cv=$this->input->post('cv2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $cv=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_ecorr_fungsi'))
            {
                $file_ecorr_fungsi=$this->input->post('file_ecorr_fungsi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_ecorr_fungsi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_memo_balasan_fungsi'))
            {
                $file_memo_balasan_fungsi=$this->input->post('file_memo_balasan_fungsi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_memo_balasan_fungsi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_panggilan'))
            {
                $file_panggilan=$this->input->post('file_panggilan2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_panggilan=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_spkp'))
            {
                $file_spkp=$this->input->post('file_spkp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_spkp=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_surat_ket_pkl'))
            {
                $file_surat_ket_pkl=$this->input->post('file_surat_ket_pkl2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_surat_ket_pkl=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_norek'))
            {
                $file_norek=$this->input->post('file_norek2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_norek=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_absensi'))
            {
                $file_absensi=$this->input->post('file_absensi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_absensi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_ktm'))
            {
                $file_ktm=$this->input->post('file_ktm2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_ktm=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_sp3'))
            {
                $file_sp3=$this->input->post('file_sp32');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_sp3=$unggah['file_name'];
            }


         $pkl=array(
             'nama'=>$this->input->post('nama'),
             'nim'=>  $this->input->post('nim'),
             'hp'=>  $this->input->post('hp'),
             'email'=>  $this->input->post('email'),
             'perguruan_tinggi'=>  $this->input->post('perguruan_tinggi'),
             'alamat_pt'=>  $this->input->post('alamat_pt'),
             'akreditasi_pt'=> $this->input->post('akreditasi_pt'),
             'fakultas'=>  $this->input->post('fakultas'),
             'prodi'=> $this->input->post('prodi'),
             'akreditasi_prodi'=>  $this->input->post('akreditasi_prodi'),
             'jenjang'=> $this->input->post('jenjang'),
             'jml_sks'=> $this->input->post('jml_sks'),
             'ipk'=>  $this->input->post('ipk'),
             'no_surat_pengantar'=> $this->input->post('no_surat_pengantar'),
             'file_surat_pengantar'=>  $file_surat_pengantar,
             'tgl_surat_pengantar'=>  $this->input->post('tgl_surat_pengantar'),
             'tgl_surat_pengantar_diterima'=>  $this->input->post('tgl_surat_pengantar_diterima'),
             'jenis'=>  $this->input->post('jenis'),
             'form_a'=>  $form_a,
             'proposal'=>  $proposal,
             'cv'=>$cv,
             'no_identitas_memo_ls'=>  $this->input->post('no_identitas_memo_ls'),
             'no_ecorr_fungsi'=>  $this->input->post('no_ecorr_fungsi'),
             'tgl_ecorr_fungsi'=>  $this->input->post('tgl_ecorr_fungsi'),
             'file_ecorr_fungsi'=>  $file_ecorr_fungsi,
             'tujuan_fungsi'=>  $this->input->post('tujuan_fungsi'),
             'durasi'=>  $this->input->post('durasi'),
             'tgl_mulai'=>  $this->input->post('tgl_mulai'),
             'tgl_selesai'=>  $this->input->post('tgl_selesai'),
             'file_memo_balasan_fungsi'=>  $file_memo_balasan_fungsi,
             'no_ecorr_respon_fungsi'=>  $this->input->post('no_ecorr_respon_fungsi'),
             'respon_persetujuan_pkl'=>  $this->input->post('respon_persetujuan_pkl'),
             'ket_fungsi_ecorr'=>  $this->input->post('ket_fungsi_ecorr'),
             'no_surat_ref_gabungan'=>  $this->input->post('no_surat_ref_gabungan'),
             'tgl_surat_keluar'=>  $this->input->post('tgl_surat_keluar'),
             'no_panggilan'=>  $this->input->post('no_panggilan'),
             'file_panggilan'=>  $file_panggilan,
             'no_spkp'=>  $this->input->post('no_spkp'),
             'file_spkp'=>  $file_spkp,
             'no_surat_ket_pkl'=>  $this->input->post('no_surat_ket_pkl'),
             'file_surat_ket_pkl'=>  $file_surat_ket_pkl,
             'norek'=>  $this->input->post('norek'),
             'file_norek'=>  $file_norek,
             'bank'=>  $this->input->post('bank'),
             'file_absensi'=>  $file_absensi,
             'file_ktm'=>  $file_ktm,
             'file_sp3'=>  $file_sp3,
             'status'=>  $this->input->post('status'),
             'ket'=>  $this->input->post('ket'),
             'insert_date'=> date('Y-m-d G:i:s'),
             'user'=> $this->session->userdata('user_name')
         );
         $this->mdl_pkl->update_pkl($id,$pkl);
         $this->session->set_flashdata('msg','<div class="alert alert-success">Data baru berhasil diubah</div>');
	 redirect('pkl/list_pkl');

     }
    }

    function duplicate_pkl($id) {
     $data['title']='Tambah Data PKL';
     $data['link_back']=site_url('pkl/list_pkl');
     $data['action']='pkl/duplicate_pkl/'.$id;
     $this->__set_rules_pkl();
     if ($this->form_validation->run()==FALSE) {
        $data['pkl']=$this->mdl_pkl->get_pkl_by_id($id)->row_array();
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
    $opt_akreditasi=array(
     'A'=>'A',
     'B'=>'B',
     'C'=>'C'
    );

    $data['akreditasi_pt']=  form_dropdown('akreditasi_pt',$opt_akreditasi ,$data['pkl']['akreditasi_pt']);
    $data['akreditasi_prodi']=  form_dropdown('akreditasi_prodi',$opt_akreditasi ,$data['pkl']['akreditasi_prodi']);
    $data['jenis']= form_dropdown('jenis', $opt_jenis,$data['pkl']['jenis']);
    $data['jenjang']= form_dropdown('jenjang', $opt_program, $data['pkl']['jenjang']);

        $this->template->display('pkl/form_duplicate_pkl',$data);
     }  else {
                 $this->upload->initialize(array(
                'upload_path' => './assets/uploads/pkl/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));

            if(!$this->upload->do_upload('file_surat_pengantar'))
            {
                $file_surat_pengantar=$this->input->post('file_surat_pengantar2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_surat_pengantar=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('form_a'))
            {
                $form_a=$this->input->post('form_a2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $form_a=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('proposal'))
            {
                $proposal=$this->input->post('proposal2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $proposal=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('cv'))
            {
                $cv=$this->input->post('cv2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $cv=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_ecorr_fungsi'))
            {
                $file_ecorr_fungsi=$this->input->post('file_ecorr_fungsi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_ecorr_fungsi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_memo_balasan_fungsi'))
            {
                $file_memo_balasan_fungsi=$this->input->post('file_memo_balasan_fungsi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_memo_balasan_fungsi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_panggilan'))
            {
                $file_panggilan=$this->input->post('file_panggilan2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_panggilan=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_spkp'))
            {
                $file_spkp=$this->input->post('file_spkp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_spkp=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_surat_ket_pkl'))
            {
                $file_surat_ket_pkl=$this->input->post('file_surat_ket_pkl2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_surat_ket_pkl=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_norek'))
            {
                $file_norek=$this->input->post('file_norek2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_norek=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_absensi'))
            {
                $file_absensi=$this->input->post('file_absensi2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_absensi=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_ktm'))
            {
                $file_ktm=$this->input->post('file_ktm2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_ktm=$unggah['file_name'];
            }

            if(!$this->upload->do_upload('file_sp3'))
            {
                $file_sp3=$this->input->post('file_sp32');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $file_sp3=$unggah['file_name'];
            }


         $pkl=array(
             'nama'=>$this->input->post('nama'),
             'nim'=>  $this->input->post('nim'),
             'hp'=>  $this->input->post('hp'),
             'email'=>  $this->input->post('email'),
             'perguruan_tinggi'=>  $this->input->post('perguruan_tinggi'),
             'alamat_pt'=>  $this->input->post('alamat_pt'),
             'akreditasi_pt'=> $this->input->post('akreditasi_pt'),
             'fakultas'=>  $this->input->post('fakultas'),
             'prodi'=> $this->input->post('prodi'),
             'akreditasi_prodi'=>  $this->input->post('akreditasi_prodi'),
             'jenjang'=> $this->input->post('jenjang'),
             'jml_sks'=> $this->input->post('jml_sks'),
             'ipk'=>  $this->input->post('ipk'),
             'no_surat_pengantar'=> $this->input->post('no_surat_pengantar'),
             'file_surat_pengantar'=>  $file_surat_pengantar,
             'tgl_surat_pengantar'=>  $this->input->post('tgl_surat_pengantar'),
             'tgl_surat_pengantar_diterima'=>  $this->input->post('tgl_surat_pengantar_diterima'),
             'jenis'=>  $this->input->post('jenis'),
             'form_a'=>  $form_a,
             'proposal'=>  $proposal,
             'cv'=>$cv,
             'no_identitas_memo_ls'=>  $this->input->post('no_identitas_memo_ls'),
             'no_ecorr_fungsi'=>  $this->input->post('no_ecorr_fungsi'),
             'tgl_ecorr_fungsi'=>  $this->input->post('tgl_ecorr_fungsi'),
             'file_ecorr_fungsi'=>  $file_ecorr_fungsi,
             'tujuan_fungsi'=>  $this->input->post('tujuan_fungsi'),
             'durasi'=>  $this->input->post('durasi'),
             'tgl_mulai'=>  $this->input->post('tgl_mulai'),
             'tgl_selesai'=>  $this->input->post('tgl_selesai'),
             'file_memo_balasan_fungsi'=>  $file_memo_balasan_fungsi,
             'no_ecorr_respon_fungsi'=>  $this->input->post('no_ecorr_respon_fungsi'),
             'respon_persetujuan_pkl'=>  $this->input->post('respon_persetujuan_pkl'),
             'ket_fungsi_ecorr'=>  $this->input->post('ket_fungsi_ecorr'),
             'no_surat_ref_gabungan'=>  $this->input->post('no_surat_ref_gabungan'),
             'tgl_surat_keluar'=>  $this->input->post('tgl_surat_keluar'),
             'no_panggilan'=>  $this->input->post('no_panggilan'),
             'file_panggilan'=>  $file_panggilan,
             'no_spkp'=>  $this->input->post('no_spkp'),
             'file_spkp'=>  $file_spkp,
             'no_surat_ket_pkl'=>  $this->input->post('no_surat_ket_pkl'),
             'file_surat_ket_pkl'=>  $file_surat_ket_pkl,
             'norek'=>  $this->input->post('norek'),
             'file_norek'=>  $file_norek,
             'bank'=>  $this->input->post('bank'),
             'file_absensi'=>  $file_absensi,
             'file_ktm'=>  $file_ktm,
             'file_sp3'=>  $file_sp3,
             'status'=>  $this->input->post('status'),
             'ket'=>  $this->input->post('ket'),
             'insert_date'=> date('Y-m-d G:i:s'),
             'user'=> $this->session->userdata('user_name')
         );
         $nim=$this->input->post('nim');
         if($this->mdl_pkl->get_by_nim($nim)<1){
           $this->mdl_pkl->add_pkl($pkl);
           $this->session->set_flashdata('msg','<div class="alert alert-success">Data baru berhasil ditambahkan</div>');
     redirect('pkl/list_pkl');
   }else {
     echo "<script type='text/javascript'>alert('NIM yang Anda masukan sudah terdaftar');window.history.back()</script>";
   }
     }
    }

    function detail($id) {
        $data['title']='Detail';
     $data['pkl']=$this->mdl_pkl->get_pkl_by_id($id)->row_array();

     $this->template->display("pkl/detail",$data);
    }

    function __set_rules_pkl() {
        $this->form_validation->set_rules('nama','Nama','required|trim');
    }

    function list_pkl($offset=0)
    {
	$data['title']='Data Peserta Magang / PKL';
	$data['tambah']=  anchor('pkl/add_pkl', 'Tambah', array('class'=>'btn btn-success'));
	//$data['download']=  anchor('pkl/download_laporan_pkl', 'Download', array('class'=>'btn btn-success'));
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('pkl/list_pkl/');
	$config['total_rows']=$this->mdl_pkl->count_pkl();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		'No',
    'Tanggal SP',
    'Nama',
		'Perguruan Tinggi',
    'Jurusan',
		'Durasi<br>(Bulan)',
		'Jenis',
    'Status',
    ''
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
	$q=$this->mdl_pkl->get_pkl($list,$pkl_name)->result_array();
        if (empty($pkl_name)){
            $pkl_name='';
        }
        $i=0+$offset;

	foreach ($q as $row)
	{
            $edit=  anchor('pkl/edit_pkl/'.$row['id'],'<i class="icon-wrench icon-white"></i>',array('class'=>'label label-info','rel'=>'tooltip','title'=>'Edit'));
            $duplicate=  anchor('pkl/duplicate_pkl/'.$row['id'],'<i class="icon-plus-sign icon-white"></i>',array('class'=>'label label-info','rel'=>'tooltip','title'=>'Duplicate'));
            $detail=  anchor('pkl/detail/'.$row['id'],'<i class="icon-zoom-in icon-white"></i>',array('class'=>'label label-info','rel'=>'tooltip','title'=>'Detail'));
            $delete=  anchor('pkl/delete_pkl/'.$row['id'],'<i class="icon-trash icon-white"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','class'=>'label label-important','title'=>'Delete'));

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

            $this->table->add_row(
		    ++$i,
                    $this->editor->date_correct($row['tgl_surat_pengantar_diterima']),
                    $row['nama'],
                    $row['perguruan_tinggi'],
		                $row['prodi'],
                    $row['durasi'],
                    $row['jenis'],
		                $status.'<br>'.$row['ket'],
                    $detail.'&nbsp'.
                    $edit.'&nbsp;'.
                    $duplicate.'&nbsp;'.
                    $delete
		    );
	}
  $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
  $this->table->set_template($tmpl);
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
      $this->mdl_pkl->update_uang_saku($id,$uang_saku);
      redirect('sarfas/list_pkl');
    }

    function progress_pkl($id,$dat) {
      $uang_saku=array(
          'progress'=>  $dat
      );
      $this->mdl_pkl->update_uang_saku($id,$uang_saku);
      redirect('sarfas/list_pkl');
    }

    function delete_pkl($id) {
        $this->mdl_pkl->delete_pkl($id);
        redirect('pkl/list_pkl');
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
      $this->mdl_pkl->update_uang_saku($id,$uang_saku);
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

	$q=$this->mdl_pkl->get_pkl_laporan($bulan,$tahun)->result_array();
	$i=0;
 	foreach ($q as $row)
	{
                        if (!empty($row['tempat_pelaksanaan'])) {
$lokasi=  $this->mdl_pkl->get_manager_by_id($row['tempat_pelaksanaan'])->row()->name;
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
        $query = $this->mdl_pkl->lookup_manager($keyword); //Search DB
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
