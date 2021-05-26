<?php
class Finance extends CI_Controller {
    private $limit=10;


    function __construct() {
        parent::__construct();
        
        $this->load->model('mdl_finance'); 
        $this->load->model('mdl_sarfas'); 
    }
    
function index($offset=0)
    {
	$this->get_index($offset);
    }

    /*
     * Get index table
     */
    protected function get_index($offset)
    {
	$data['title']='Kelengkapan Finance';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('finance/index/');
	$config['total_rows']=$this->mdl_finance->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                'No', 
                'Kode', 
                'Nama Pelatihan', 
                array('data' => 'Tanggal Pelaksanaan', 'width' => '180'),  
                'Lokasi', 
                'Jenis Pembayaran   '
        );
        
        $q = $this->mdl_finance->get_course($this->limit,$offset)->result_array();
        $i = 0 + $offset;

        foreach ($q as $row) {
            
            if ($this->mdl_finance->get_kelengkapan($row['id'])->num_rows()<=0) {
             $pembayaran='';   
            }else{
                $pembayaran='';
            foreach ($this->mdl_finance->get_kelengkapan($row['id'])->result_array() as $baris) {
                if ($this->session->userdata('user_id')==5) {
                    if ($baris['status']==0) {
                        $pembayaran .=anchor('finance/lihat_page_f/'.$row['id'], $baris['jenis'], array('class'=>'label label-important')).'<br>';  
                    }else{
                        $pembayaran .=anchor('finance/lihat_page_f/'.$row['id'], $baris['jenis'], array('class'=>'label label-success')).'<br>';  
                    }                  
                }  else {
                $pembayaran .=anchor('finance/lihat_page_u/'.$row['id'], $baris['jenis'], array('class'=>'label label-success')).'<br>';                    
                }
                
                }                 
            }


            if (is_numeric($row['location'])) {
                $lokasi=  $this->mdl_sarfas->get_class_by_id($row['location'])->row()->class_name;
            }else{
                $lokasi=$row['location'];
            }


            $this->table->add_row(
                    ++$i, 
                    $row['code'], 
                    $row['course_name'], 
                    $this->editor->date_correct($row['start_date']).' s/d '.$this->editor->date_correct($row['end_date']), 
                    $lokasi,
                    $pembayaran.'<br>'.anchor('finance/add_page/'.$row['id'], 'Tambah', array('class'=>'label label-info')));            
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        if ($this->session->userdata('user_id') == 1 || $this->session->userdata('user_id') == 2 || $this->session->userdata('user_id') == 4) {
            $data['tambah'] = anchor('course/add', 'Tambah', array('class' => 'btn btn-primary'));
        } else {
            $data['tambah'] = '';
        }

        $this->template->display('finance/index', $data);
    }
    
    function add_page($id) {
      $data['action']='finance/post_add_page';
      $data['title']='Kelengkapan Keuangan';
      $data['kode']= $this->mdl_finance->get_course_by_id($id)->row()->code.'<input type="hidden" name="course_id" value="'.$id.'">';
      $data['judul']= $this->mdl_finance->get_course_by_id($id)->row()->course_name;
      $data['tempat']=  $this->mdl_finance->get_course_by_id($id)->row()->location;
      $data['tanggal']= $this->editor->date_correct($this->mdl_finance->get_course_by_id($id)->row()->start_date).' s/d '.$this->editor->date_correct($this->mdl_finance->get_course_by_id($id)->row()->end_date);
      $data['sifat']=  $this->mdl_finance->get_course_by_id($id)->row()->sifat;
      $data['jenis_pembayaran']= '<select name="jenis"><option value="UMK">UMK</option><option value="PJ UMK">PJ UMK</option><option value="TAGIHAN P3">TAGIHAN P3</option><option value="REIMBURSEMENT">REIMBURSEMENT</option><option value="UANG SAKU / HONOR PEMBIMBING">UANG SAKU / HONOR PEMBIMBING</option><option value="PENDIDIKAN">PENDIDIKAN</option></select>';
      $data['st_invoice']='<input type="radio" name="st_invoice" value="1">Ada <input type="radio" name="st_invoice" value="0">Tidak Ada';
      $data['st_daftar_hadir_inst']='<input type="radio" name="st_daftar_hadir_inst" value="1">Ada <input type="radio" name="st_daftar_hadir_inst" value="0">Tidak Ada';
      $data['st_daftar_hadir_peserta']='<input type="radio" name="st_daftar_hadir_peserta" value="1">Ada <input type="radio" name="st_daftar_hadir_peserta" value="0">Tidak Ada';
      $data['st_penawaran_harga']='<input type="radio" name="st_penawaran_harga" value="1">Ada <input type="radio" name="st_penawaran_harga" value="0">Tidak Ada';
      $data['st_surat_perintah']='<input type="radio" name="st_surat_perintah" value="1">Ada <input type="radio" name="st_surat_perintah" value="0">Tidak Ada';
      $data['st_surat_perjanjian']='<input type="radio" name="st_surat_perjanjian" value="1">Ada <input type="radio" name="st_surat_perjanjian" value="0">Tidak Ada';
      $data['st_surat_pendukung']='<input type="radio" name="st_surat_pendukung" value="1">Ada <input type="radio" name="st_surat_pendukung" value="0">Tidak Ada';
      $data['st_sertifikat']='<input type="radio" name="st_sertifikat" value="1">Ada <input type="radio" name="st_sertifikat" value="0">Tidak Ada';
      $data['st_spd']='<input type="radio" name="st_spd" value="1">Ada <input type="radio" name="st_spd" value="0">Tidak Ada';
      $data['st_faktur_pajak']='<input type="radio" name="st_faktur_pajak" value="1">Ada <input type="radio" name="st_faktur_pajak" value="0">Tidak Ada';
      $data['st_nota_permintaan']='<input type="radio" name="st_nota_permintaan" value="1">Ada <input type="radio" name="st_nota_permintaan" value="0">Tidak Ada';
      $data['st_rincian_umk']='<input type="radio" name="st_rincian_umk" value="1">Ada <input type="radio" name="st_rincian_umk" value="0">Tidak Ada';
      $data['st_rincian_honor']='<input type="radio" name="st_rincian_honor" value="1">Ada <input type="radio" name="st_rincian_honor" value="0">Tidak Ada';    
      $data['tgl_kirim']='';
      $data['pengirim']='';
      $data['tgl_terima']='';
      $data['penerima']='';
      $data['ket']='';
      
      $this->template->display('finance/add_page', $data); 
    }
    
    function post_add_page() {
     $finance=array(
         'course_id' => $this->input->post('course_id'),
         'jenis'=>  $this->input->post('jenis'),
         'invoice'=>  $this->input->post('st_invoice'),
         'daftar_hadir_inst'=>  $this->input->post('st_daftar_hadir_inst'),
         'daftar_hadir_peserta'=>  $this->input->post('st_daftar_hadir_peserta'),
         'penawaran_harga'=>  $this->input->post('st_penawaran_harga'),
         'surat_perintah'=>  $this->input->post('st_surat_perintah'),
         'surat_perjanjian'=>  $this->input->post('st_surat_perjanjian'),
         'surat_pendukung'=>  $this->input->post('st_surat_pendukung'),
         'sertifikat'=>  $this->input->post('st_sertifikat'),
         'spd'=>  $this->input->post('st_spd'),
         'faktur_pajak'=>  $this->input->post('st_faktur_pajak'),
         'nota_permintaan'=>  $this->input->post('st_nota_permintaan'),
         'rincian_umk'=>  $this->input->post('st_rincian_umk'),
         'rincian_honor'=>  $this->input->post('st_rincian_honor'),
         'tgl_kirim'=>  $this->input->post('tgl_kirim'),
         'pengirim'=>  $this->input->post('pengirim'),
         'tgl_terima'=>  $this->input->post('tgl_terima'),
         'penerima'=>  $this->input->post('penerima'),
         'ket'=>  $this->input->post('ket'),
         'insert_date'=> date('Y-m-d G:i:s'),
         'update_date'=> date('Y-m-d G:i:s')
     );   
     
     $this->mdl_finance->add_post_page($finance);
     redirect('finance');
    }
    
    function lihat_page_u($id) {
      $data['title']='Kelengkapan Keuangan';
      $data['action']='finance/post_page_u/'.$id;
      $data['kode']= $this->mdl_finance->get_course_by_id($id)->row()->code;
      $data['judul']= $this->mdl_finance->get_course_by_id($id)->row()->course_name;
      $data['tempat']=  $this->mdl_finance->get_course_by_id($id)->row()->location;
      $data['tanggal']= $this->editor->date_correct($this->mdl_finance->get_course_by_id($id)->row()->start_date).' s/d '.$this->editor->date_correct($this->mdl_finance->get_course_by_id($id)->row()->end_date);
      $data['sifat']=  $this->mdl_finance->get_course_by_id($id)->row()->sifat;
      $data['jenis_pembayaran']= '<span class="label label-info">'.$this->mdl_finance->get_kelengkapan($id)->row()->jenis.'</span>';
      $data['f_invoice']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_invoice);
      $data['f_daftar_hadir_inst']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_daftar_hadir_inst);
      $data['f_daftar_hadir_peserta']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_daftar_hadir_peserta);
      $data['f_penawaran_harga']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_penawaran_harga);
      $data['f_surat_perintah']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_perintah);
      $data['f_surat_perjanjian']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_perjanjian);
      $data['f_surat_pendukung']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_pendukung);
      $data['f_sertifikat']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_sertifikat);
      $data['f_spd']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_spd);
      $data['f_faktur_pajak']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_faktur_pajak);
      $data['f_nota_permintaan']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_nota_permintaan);
      $data['f_rincian_umk']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_rincian_umk);
      $data['f_rincian_honor']=$this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->st_rincian_honor);
    
      $data['tgl_kirim']='<input type="text" id="tgl_kirim" name="tgl_kirim" value="'.$this->mdl_finance->get_kelengkapan($id)->row()->tgl_kirim.'">';
      $data['pengirim']='<input type="text" name="pengirim" value="'.$this->mdl_finance->get_kelengkapan($id)->row()->pengirim.'">';
      $data['tgl_terima']=$this->mdl_finance->get_kelengkapan($id)->row()->tgl_terima;
      $data['penerima']=$this->mdl_finance->get_kelengkapan($id)->row()->penerima;
      $data['ket']=$this->mdl_finance->get_kelengkapan($id)->row()->ket;
      
      $data['hapus']=anchor('finance/delete_page_u/'.$this->mdl_finance->get_kelengkapan($id)->row()->id, 'Hapus', array('class'=>'btn btn-danger','onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')"));
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->invoice==0) {
          $data['st_invoice']='<input type="radio" name="st_invoice" value="1">Lengkap <input type="radio" name="st_invoice" value="0" checked>Belum Lengkap <input type="radio" name="st_invoice" value="2">Dikembalikan';
      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->invoice==1) {
      $data['st_invoice']='<input type="radio" name="st_invoice" value="1" checked>Lengkap <input type="radio" name="st_invoice" value="0">Belum Lengkap <input type="radio" name="st_invoice" value="2">Dikembalikan';    
      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->invoice==2) {
          $data['st_invoice']='<input type="radio" name="st_invoice" value="1">Lengkap <input type="radio" name="st_invoice" value="0">Belum Lengkap <input type="radio" name="st_invoice" value="2" checked>Dikembalikan';
      }

      if ($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst==0) {
      $data['st_daftar_hadir_inst']='<input type="radio" name="st_daftar_hadir_inst" value="1">Lengkap <input type="radio" name="st_daftar_hadir_inst" value="0" checked>Belum Lengkap <input type="radio" name="st_daftar_hadir_inst" value="2">Dikembalikan';
      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst==1) {
      $data['st_daftar_hadir_inst']='<input type="radio" name="st_daftar_hadir_inst" value="1" checked>Lengkap <input type="radio" name="st_daftar_hadir_inst" value="0">Belum Lengkap <input type="radio" name="st_daftar_hadir_inst" value="2">Dikembalikan';
      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst==2) {
      $data['st_daftar_hadir_inst']='<input type="radio" name="st_daftar_hadir_inst" value="1">Lengkap <input type="radio" name="st_daftar_hadir_inst" value="0">Belum Lengkap <input type="radio" name="st_daftar_hadir_inst" value="2" checked>Dikembalikan';
      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_peserta==0) {
      $data['st_daftar_hadir_peserta']='<input type="radio" name="st_daftar_hadir_peserta" value="1">Lengkap <input type="radio" name="st_daftar_hadir_peserta" value="0" checked>Belum Lengkap <input type="radio" name="st_daftar_hadir_peserta" value="2">Dikembalikan';
      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_peserta==1) {
      $data['st_daftar_hadir_peserta']='<input type="radio" name="st_daftar_hadir_peserta" value="1" checked>Lengkap <input type="radio" name="st_daftar_hadir_peserta" value="0">Belum Lengkap <input type="radio" name="st_daftar_hadir_peserta" value="2">Dikembalikan';
      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_peserta==2) {
      $data['st_daftar_hadir_peserta']='<input type="radio" name="st_daftar_hadir_peserta" value="1">Lengkap <input type="radio" name="st_daftar_hadir_peserta" value="0">Belum Lengkap <input type="radio" name="st_daftar_hadir_peserta" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->penawaran_harga==0) {
      $data['st_penawaran_harga']='<input type="radio" name="st_penawaran_harga" value="1">Lengkap <input type="radio" name="st_penawaran_harga" value="0" checked>Belum Lengkap <input type="radio" name="st_penawaran_harga" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->penawaran_harga==1) {
      $data['st_penawaran_harga']='<input type="radio" name="st_penawaran_harga" value="1" checked>Lengkap <input type="radio" name="st_penawaran_harga" value="0">Belum Lengkap <input type="radio" name="st_penawaran_harga" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->penawaran_harga==2) {
      $data['st_penawaran_harga']='<input type="radio" name="st_penawaran_harga" value="1">Lengkap <input type="radio" name="st_penawaran_harga" value="0">Belum Lengkap <input type="radio" name="st_penawaran_harga" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->surat_perintah==0) {
      $data['st_surat_perintah']='<input type="radio" name="st_surat_perintah" value="1">Lengkap <input type="radio" name="st_surat_perintah" value="0" checked>Belum Lengkap <input type="radio" name="st_surat_perintah" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->surat_perintah==1) {
      $data['st_surat_perintah']='<input type="radio" name="st_surat_perintah" value="1" checked>Lengkap <input type="radio" name="st_surat_perintah" value="0">Belum Lengkap <input type="radio" name="st_surat_perintah" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->surat_perintah==2) {
      $data['st_surat_perintah']='<input type="radio" name="st_surat_perintah" value="1">Lengkap <input type="radio" name="st_surat_perintah" value="0">Belum Lengkap <input type="radio" name="st_surat_perintah" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->surat_perjanjian==0) {
      $data['st_surat_perjanjian']='<input type="radio" name="st_surat_perjanjian" value="1">Lengkap <input type="radio" name="st_surat_perjanjian" value="0" checked>Belum Lengkap <input type="radio" name="st_surat_perjanjian" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->surat_perjanjian==1) {
      $data['st_surat_perjanjian']='<input type="radio" name="st_surat_perjanjian" value="1" checked>Lengkap <input type="radio" name="st_surat_perjanjian" value="0">Belum Lengkap <input type="radio" name="st_surat_perjanjian" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->surat_perjanjian==2) {
      $data['st_surat_perjanjian']='<input type="radio" name="st_surat_perjanjian" value="1">Lengkap <input type="radio" name="st_surat_perjanjian" value="0">Belum Lengkap <input type="radio" name="st_surat_perjanjian" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->surat_pendukung==0) {
      $data['st_surat_pendukung']='<input type="radio" name="st_surat_pendukung" value="1">Lengkap <input type="radio" name="st_surat_pendukung" value="0" checked>Belum Lengkap <input type="radio" name="st_surat_pendukung" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->surat_pendukung==1) {
      $data['st_surat_pendukung']='<input type="radio" name="st_surat_pendukung" value="1" checked>Lengkap <input type="radio" name="st_surat_pendukung" value="0">Belum Lengkap <input type="radio" name="st_surat_pendukung" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->surat_pendukung==2) {
      $data['st_surat_pendukung']='<input type="radio" name="st_surat_pendukung" value="1">Lengkap <input type="radio" name="st_surat_pendukung" value="0">Belum Lengkap <input type="radio" name="st_surat_pendukung" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->sertifikat==0) {
      $data['st_sertifikat']='<input type="radio" name="st_sertifikat" value="1">Lengkap <input type="radio" name="st_sertifikat" value="0" checked>Belum Lengkap <input type="radio" name="st_sertifikat" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->sertifikat==1) {
      $data['st_sertifikat']='<input type="radio" name="st_sertifikat" value="1" checked>Lengkap <input type="radio" name="st_sertifikat" value="0">Belum Lengkap <input type="radio" name="st_sertifikat" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->sertifikat==2) {
      $data['st_sertifikat']='<input type="radio" name="st_sertifikat" value="1">Lengkap <input type="radio" name="st_sertifikat" value="0">Belum Lengkap <input type="radio" name="st_sertifikat" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->spd==0) {
      $data['st_spd']='<input type="radio" name="st_spd" value="1">Lengkap <input type="radio" name="st_spd" value="0" checked>Belum Lengkap <input type="radio" name="st_spd" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->spd==1) {
      $data['st_spd']='<input type="radio" name="st_spd" value="1" checked>Lengkap <input type="radio" name="st_spd" value="0">Belum Lengkap <input type="radio" name="st_spd" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->spd==2) {
      $data['st_spd']='<input type="radio" name="st_spd" value="1">Lengkap <input type="radio" name="st_spd" value="0">Belum Lengkap <input type="radio" name="st_spd" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->faktur_pajak==0) {
      $data['st_faktur_pajak']='<input type="radio" name="st_faktur_pajak" value="1">Lengkap <input type="radio" name="st_faktur_pajak" value="0" checked>Belum Lengkap <input type="radio" name="st_faktur_pajak" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->faktur_pajak==1) {
      $data['st_faktur_pajak']='<input type="radio" name="st_faktur_pajak" value="1" checked>Lengkap <input type="radio" name="st_faktur_pajak" value="0">Belum Lengkap <input type="radio" name="st_faktur_pajak" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->faktur_pajak==2) {
      $data['st_faktur_pajak']='<input type="radio" name="st_faktur_pajak" value="1">Lengkap <input type="radio" name="st_faktur_pajak" value="0">Belum Lengkap <input type="radio" name="st_faktur_pajak" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->nota_permintaan==0) {
      $data['st_nota_permintaan']='<input type="radio" name="st_nota_permintaan" value="1">Lengkap <input type="radio" name="st_nota_permintaan" value="0" checked>Belum Lengkap <input type="radio" name="nota_permintaan" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->nota_permintaan==1) {
      $data['st_nota_permintaan']='<input type="radio" name="st_nota_permintaan" value="1" checked>Lengkap <input type="radio" name="st_nota_permintaan" value="0">Belum Lengkap <input type="radio" name="nota_permintaan" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->nota_permintaan==2) {
      $data['st_nota_permintaan']='<input type="radio" name="st_nota_permintaan" value="1">Lengkap <input type="radio" name="st_nota_permintaan" value="0">Belum Lengkap <input type="radio" name="nota_permintaan" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->rincian_umk==0) {
      $data['st_rincian_umk']='<input type="radio" name="st_rincian_umk" value="1">Lengkap <input type="radio" name="st_rincian_umk" value="0" checked>Belum Lengkap <input type="radio" name="st_rincian_umk" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->rincian_umk==1) {
      $data['st_rincian_umk']='<input type="radio" name="st_rincian_umk" value="1" checked>Lengkap <input type="radio" name="st_rincian_umk" value="0">Belum Lengkap <input type="radio" name="st_rincian_umk" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->rincian_umk==2) {
      $data['st_rincian_umk']='<input type="radio" name="st_rincian_umk" value="1">Lengkap <input type="radio" name="st_rincian_umk" value="0">Belum Lengkap <input type="radio" name="st_rincian_umk" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->rincian_honor==0) {
      $data['st_rincian_honor']='<input type="radio" name="st_rincian_honor" value="1">Lengkap <input type="radio" name="st_rincian_honor" value="0" checked>Belum Lengkap <input type="radio" name="st_rincian_honor" value="2">Dikembalikan';
      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->rincian_honor==1) {
      $data['st_rincian_honor']='<input type="radio" name="st_rincian_honor" value="1" checked>Lengkap <input type="radio" name="st_rincian_honor" value="0">Belum Lengkap <input type="radio" name="st_rincian_honor" value="2">Dikembalikan';
      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->rincian_honor==2) {
      $data['st_rincian_honor']='<input type="radio" name="st_rincian_honor" value="1">Lengkap <input type="radio" name="st_rincian_honor" value="0">Belum Lengkap <input type="radio" name="st_rincian_honor" value="2" checked>Dikembalikan';
      }
      
      $this->template->display('finance/u_page',$data); 
    }
    
  
    
    function lihat_page_f($id) {
        $update_status=array(
            'status'=>1
        );
      $this->mdl_finance->update_status($update_status,$this->mdl_finance->get_kelengkapan($id)->row()->id);
      $data['title']='Kelengkapan Keuangan';
      $data['action']='finance/post_page_f/'.$id;
      $data['kode']= $this->mdl_finance->get_course_by_id($id)->row()->code;
      $data['judul']= $this->mdl_finance->get_course_by_id($id)->row()->course_name;
      $data['tempat']=  $this->mdl_finance->get_course_by_id($id)->row()->location;
      $data['tanggal']= $this->editor->date_correct($this->mdl_finance->get_course_by_id($id)->row()->start_date).' s/d '.$this->editor->date_correct($this->mdl_finance->get_course_by_id($id)->row()->end_date);
      $data['sifat']=  $this->mdl_finance->get_course_by_id($id)->row()->sifat;
      $data['jenis_pembayaran']= '<span class="label label-info">'.$this->mdl_finance->get_kelengkapan($id)->row()->jenis.'</span>';
      $data['st_invoice']=  $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->invoice);
      $data['st_daftar_hadir_inst']=  $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_daftar_hadir_peserta']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_penawaran_harga']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_surat_perintah']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_surat_perjanjian']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_surat_pendukung']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_sertifikat']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_spd']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_faktur_pajak']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_nota_permintaan']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_rincian_umk']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
      $data['st_rincian_honor']= $this->set_status($this->mdl_finance->get_kelengkapan($id)->row()->daftar_hadir_inst);
    
      $data['tgl_kirim']=$this->mdl_finance->get_kelengkapan($id)->row()->tgl_kirim;
      $data['pengirim']=$this->mdl_finance->get_kelengkapan($id)->row()->pengirim;
      $data['tgl_terima']=$this->mdl_finance->get_kelengkapan($id)->row()->tgl_terima;
      $data['penerima']=$this->mdl_finance->get_kelengkapan($id)->row()->penerima;
      $data['ket']=$this->mdl_finance->get_kelengkapan($id)->row()->ket;
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_invoice==0) {
          $data['f_invoice']='<input type="radio" name="f_invoice" value="1">Lengkap <input type="radio" name="f_invoice" value="0" checked>Belum Lengkap <input type="radio" name="f_invoice" value="2">Dikembalikan';
      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_invoice==1) {
      $data['f_invoice']='<input type="radio" name="f_invoice" value="1" checked>Lengkap <input type="radio" name="f_invoice" value="0">Belum Lengkap <input type="radio" name="f_invoice" value="2">Dikembalikan';    
      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_invoice==2) {
          $data['f_invoice']='<input type="radio" name="f_invoice" value="1">Lengkap <input type="radio" name="f_invoice" value="0">Belum Lengkap <input type="radio" name="f_invoice" value="2" checked>Dikembalikan';
      }

      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_daftar_hadir_inst==0) {
      $data['f_daftar_hadir_inst']='<input type="radio" name="f_daftar_hadir_inst" value="1">Lengkap <input type="radio" name="f_daftar_hadir_inst" value="0" checked>Belum Lengkap <input type="radio" name="f_daftar_hadir_inst" value="2">Dikembalikan';
      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_daftar_hadir_inst==1) {
      $data['f_daftar_hadir_inst']='<input type="radio" name="f_daftar_hadir_inst" value="1" checked>Lengkap <input type="radio" name="f_daftar_hadir_inst" value="0">Belum Lengkap <input type="radio" name="f_daftar_hadir_inst" value="2">Dikembalikan';
      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_daftar_hadir_inst==2) {
      $data['f_daftar_hadir_inst']='<input type="radio" name="f_daftar_hadir_inst" value="1">Lengkap <input type="radio" name="f_daftar_hadir_inst" value="0">Belum Lengkap <input type="radio" name="f_daftar_hadir_inst" value="2" checked>Dikembalikan';
      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_daftar_hadir_peserta==0) {
      $data['f_daftar_hadir_peserta']='<input type="radio" name="f_daftar_hadir_peserta" value="1">Lengkap <input type="radio" name="f_daftar_hadir_peserta" value="0" checked>Belum Lengkap <input type="radio" name="f_daftar_hadir_peserta" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_daftar_hadir_peserta==1) {
      $data['f_daftar_hadir_peserta']='<input type="radio" name="f_daftar_hadir_peserta" value="1" checked>Lengkap <input type="radio" name="f_daftar_hadir_peserta" value="0">Belum Lengkap <input type="radio" name="f_daftar_hadir_peserta" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_daftar_hadir_peserta==2) {
      $data['f_daftar_hadir_peserta']='<input type="radio" name="f_daftar_hadir_peserta" value="1">Lengkap <input type="radio" name="f_daftar_hadir_peserta" value="0">Belum Lengkap <input type="radio" name="f_daftar_hadir_peserta" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_penawaran_harga==0) {
      $data['f_penawaran_harga']='<input type="radio" name="f_penawaran_harga" value="1">Lengkap <input type="radio" name="st_penawaran_harga" value="0" checked>Belum Lengkap <input type="radio" name="f_penawaran_harga" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_penawaran_harga==1) {
      $data['f_penawaran_harga']='<input type="radio" name="f_penawaran_harga" value="1" checked>Lengkap <input type="radio" name="st_penawaran_harga" value="0">Belum Lengkap <input type="radio" name="f_penawaran_harga" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_penawaran_harga==2) {
      $data['f_penawaran_harga']='<input type="radio" name="f_penawaran_harga" value="1">Lengkap <input type="radio" name="st_penawaran_harga" value="0">Belum Lengkap <input type="radio" name="f_penawaran_harga" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_perintah==0) {
      $data['f_surat_perintah']='<input type="radio" name="f_surat_perintah" value="1">Lengkap <input type="radio" name="f_surat_perintah" value="0" checked>Belum Lengkap <input type="radio" name="f_surat_perintah" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_perintah==1) {
      $data['f_surat_perintah']='<input type="radio" name="f_surat_perintah" value="1" checked>Lengkap <input type="radio" name="f_surat_perintah" value="0">Belum Lengkap <input type="radio" name="f_surat_perintah" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_perintah==2) {
      $data['f_surat_perintah']='<input type="radio" name="f_surat_perintah" value="1">Lengkap <input type="radio" name="f_surat_perintah" value="0">Belum Lengkap <input type="radio" name="f_surat_perintah" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_perjanjian==0) {
      $data['f_surat_perjanjian']='<input type="radio" name="st_surat_perjanjian" value="1">Lengkap <input type="radio" name="st_surat_perjanjian" value="0" checked>Belum Lengkap <input type="radio" name="st_surat_perjanjian" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_perjanjian==1) {
      $data['f_surat_perjanjian']='<input type="radio" name="st_surat_perjanjian" value="1" checked>Lengkap <input type="radio" name="st_surat_perjanjian" value="0">Belum Lengkap <input type="radio" name="st_surat_perjanjian" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_perjanjian==2) {
      $data['f_surat_perjanjian']='<input type="radio" name="st_surat_perjanjian" value="1">Lengkap <input type="radio" name="st_surat_perjanjian" value="0">Belum Lengkap <input type="radio" name="st_surat_perjanjian" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_pendukung==0) {
      $data['f_surat_pendukung']='<input type="radio" name="f_surat_pendukung" value="1">Lengkap <input type="radio" name="f_surat_pendukung" value="0" checked>Belum Lengkap <input type="radio" name="f_surat_pendukung" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_pendukung==1) {
      $data['f_surat_pendukung']='<input type="radio" name="f_surat_pendukung" value="1" checked>Lengkap <input type="radio" name="f_surat_pendukung" value="0">Belum Lengkap <input type="radio" name="f_surat_pendukung" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_surat_pendukung==2) {
      $data['f_surat_pendukung']='<input type="radio" name="f_surat_pendukung" value="1">Lengkap <input type="radio" name="f_surat_pendukung" value="0">Belum Lengkap <input type="radio" name="f_surat_pendukung" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_sertifikat==0) {
      $data['f_sertifikat']='<input type="radio" name="f_sertifikat" value="1">Lengkap <input type="radio" name="f_sertifikat" value="0" checked>Belum Lengkap <input type="radio" name="f_sertifikat" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_sertifikat==1) {
      $data['f_sertifikat']='<input type="radio" name="f_sertifikat" value="1" checked>Lengkap <input type="radio" name="f_sertifikat" value="0">Belum Lengkap <input type="radio" name="f_sertifikat" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_sertifikat==2) {
      $data['f_sertifikat']='<input type="radio" name="f_sertifikat" value="1">Lengkap <input type="radio" name="f_sertifikat" value="0">Belum Lengkap <input type="radio" name="f_sertifikat" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_spd==0) {
      $data['f_spd']='<input type="radio" name="f_spd" value="1">Lengkap <input type="radio" name="f_spd" value="0" checked>Belum Lengkap <input type="radio" name="f_spd" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_spd==1) {
      $data['f_spd']='<input type="radio" name="f_spd" value="1" checked>Lengkap <input type="radio" name="f_spd" value="0">Belum Lengkap <input type="radio" name="f_spd" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_spd==2) {
      $data['f_spd']='<input type="radio" name="f_spd" value="1">Lengkap <input type="radio" name="f_spd" value="0">Belum Lengkap <input type="radio" name="f_spd" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_faktur_pajak==0) {
      $data['f_faktur_pajak']='<input type="radio" name="f_faktur_pajak" value="1">Lengkap <input type="radio" name="f_faktur_pajak" value="0" checked>Belum Lengkap <input type="radio" name="f_faktur_pajak" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_faktur_pajak==1) {
      $data['f_faktur_pajak']='<input type="radio" name="f_faktur_pajak" value="1" checked>Lengkap <input type="radio" name="f_faktur_pajak" value="0">Belum Lengkap <input type="radio" name="f_faktur_pajak" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_faktur_pajak==2) {
      $data['f_faktur_pajak']='<input type="radio" name="f_faktur_pajak" value="1">Lengkap <input type="radio" name="f_faktur_pajak" value="0">Belum Lengkap <input type="radio" name="f_faktur_pajak" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_nota_permintaan==0) {
      $data['f_nota_permintaan']='<input type="radio" name="f_nota_permintaan" value="1">Lengkap <input type="radio" name="f_nota_permintaan" value="0" checked>Belum Lengkap <input type="radio" name="nota_permintaan" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_nota_permintaan==1) {
      $data['f_nota_permintaan']='<input type="radio" name="f_nota_permintaan" value="1" checked>Lengkap <input type="radio" name="f_nota_permintaan" value="0">Belum Lengkap <input type="radio" name="nota_permintaan" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_nota_permintaan==2) {
      $data['f_nota_permintaan']='<input type="radio" name="f_nota_permintaan" value="1">Lengkap <input type="radio" name="f_nota_permintaan" value="0">Belum Lengkap <input type="radio" name="nota_permintaan" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_rincian_umk==0) {
      $data['f_rincian_umk']='<input type="radio" name="f_rincian_umk" value="1">Lengkap <input type="radio" name="f_rincian_umk" value="0" checked>Belum Lengkap <input type="radio" name="f_rincian_umk" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_rincian_umk==1) {
      $data['f_rincian_umk']='<input type="radio" name="f_rincian_umk" value="1" checked>Lengkap <input type="radio" name="f_rincian_umk" value="0">Belum Lengkap <input type="radio" name="f_rincian_umk" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_rincian_umk==2) {
      $data['f_rincian_umk']='<input type="radio" name="f_rincian_umk" value="1">Lengkap <input type="radio" name="f_rincian_umk" value="0">Belum Lengkap <input type="radio" name="f_rincian_umk" value="2" checked>Dikembalikan';

      }
      
      if ($this->mdl_finance->get_kelengkapan($id)->row()->st_rincian_honor==0) {
      $data['f_rincian_honor']='<input type="radio" name="f_rincian_honor" value="1">Lengkap <input type="radio" name="f_rincian_honor" value="0" checked>Belum Lengkap <input type="radio" name="f_rincian_honor" value="2">Dikembalikan';

      }  elseif($this->mdl_finance->get_kelengkapan($id)->row()->st_rincian_honor==1) {
      $data['f_rincian_honor']='<input type="radio" name="f_rincian_honor" value="1" checked>Lengkap <input type="radio" name="f_rincian_honor" value="0">Belum Lengkap <input type="radio" name="f_rincian_honor" value="2">Dikembalikan';

      }  elseif ($this->mdl_finance->get_kelengkapan($id)->row()->st_rincian_honor==2) {
      $data['f_rincian_honor']='<input type="radio" name="f_rincian_honor" value="1">Lengkap <input type="radio" name="f_rincian_honor" value="0">Belum Lengkap <input type="radio" name="f_rincian_honor" value="2" checked>Dikembalikan';

      }
      
      
      $this->template->display('finance/f_page', $data); 
    }
    
    function post_page_f($id) {
     $post_page_f=array(
         'st_invoice'=>  $this->input->post('f_invoice'),
         'st_daftar_hadir_inst'=>  $this->input->post('f_daftar_hadir_inst'),
         'st_daftar_hadir_peserta'=>  $this->input->post('f_daftar_hadir_peserta'),
         'st_penawaran_harga'=>  $this->input->post('f_penawaran_harga'),
         'st_surat_perintah'=>  $this->input->post('f_surat_perintah'),
         'st_surat_perjanjian'=>  $this->input->post('f_surat_perjanjian'),
         'st_surat_pendukung'=>  $this->input->post('f_surat_pendukung'),
         'st_sertifikat'=>  $this->input->post('f_sertifikat'),
         'st_spd'=>  $this->input->post('f_spd'),
         'st_faktur_pajak'=>  $this->input->post('f_faktur_pajak'),
         'st_nota_permintaan'=>  $this->input->post('f_nota_permintaan'),
         'st_rincian_umk'=>  $this->input->post('f_rincian_umk'),
         'st_rincian_honor'=>  $this->input->post('f_rincian_honor'),
         'tgl_terima'=>  $this->input->post('tgl_terima'),
         'penerima'=>  $this->input->post('penerima'),
         'ket'=>  $this->input->post('ket'),
         'update_date'=>  date('Y-m-d G:i:s')
     );   
     
     $this->mdl_finance->update_kelengkapan($post_page_f,$id);
     redirect('finance');
    }
    
    function post_page_u($id) {
     $post_page_u=array(
         'invoice'=>  $this->input->post('invoice'),
         'daftar_hadir_inst'=>  $this->input->post('st_daftar_hadir_inst'),
         'daftar_hadir_peserta'=>  $this->input->post('st_daftar_hadir_peserta'),
         'penawaran_harga'=>  $this->input->post('st_penawaran_harga'),
         'surat_perintah'=>  $this->input->post('st_surat_perintah'),
         'surat_perjanjian'=>  $this->input->post('st_surat_perjanjian'),
         'surat_pendukung'=>  $this->input->post('st_surat_pendukung'),
         'sertifikat'=>  $this->input->post('st_sertifikat'),
         'spd'=>  $this->input->post('st_spd'),
         'faktur_pajak'=>  $this->input->post('st_faktur_pajak'),
         'nota_permintaan'=>  $this->input->post('st_nota_permintaan'),
         'rincian_umk'=>  $this->input->post('st_rincian_umk'),
         'rincian_honor'=>  $this->input->post('st_rincian_honor'),
         'tgl_kirim'=>  $this->input->post('tgl_kirim'),
         'pengirim'=>  $this->input->post('pengirim'),
         'update_date'=>  date('Y-m-d G:i:s')
     );   
     
     $this->mdl_finance->update_kelengkapan($post_page_u,$id);
     redirect('finance');
    }
    
      function set_status($var) {
        if ($var==0) {
            $st='<span class="label label-important">Tidak Ada</span>';

        } elseif ($var==1) {
            $st='<span class="label label-info">Ada</span>';        
    } else{
          $st='<span class="label label-warning">Dikembalikan</span>';   
        }
        return $st;
    }
    
    function delete_page_u($id) {
        $this->mdl_finance->delete_kelengkapan($id);
        redirect('finance');
    }
    
}
