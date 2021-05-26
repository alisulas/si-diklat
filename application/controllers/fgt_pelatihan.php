<?php
/**
 * Description of memo
 *
 * @author Administrator
 */
class Fgt_pelatihan extends Member_Controller{
    //put your code here
    private $limit=15;
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_fgt_pelatihan');
        $this->load->model('mdl_pelatihan');
        $this->load->model('mdl_trainer');
        $this->load->model('mdl_provider');
        $this->load->model('mdl_observer');
        $this->load->model('mdl_sarfas');
        $this->load->model('mdl_libur');
        $this->load->model('mdl_peserta');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
    }

    function index($offset=0,$dat=0){
        $this->get_index($offset,$dat);
    }

    protected function get_index($offset,$dat)
    {
	//$data['title']='Progress Pelatihan Bulan '. $this->conv_bulan(date("M"));
        $data['title']='Data Pelatihan Bulan '. $this->editor->conv_bulan(date("m"));
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}

        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket');
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');

        if ($dat==1) {
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $q=$this->mdl_fgt_pelatihan->get_index_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai)->result_array();
        } else {

        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view_bulan();
        $q=$this->mdl_fgt_pelatihan->get_index_view_bulan()->result_array();
        }

	$data['pagination']='';
        $data['refresh']=anchor('fgt_pelatihan', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info'));

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Program',
                    'Batch',
                    'PIC',
		    'Mulai',
                    'Selesai',
                    'Kota',
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
                    $judul,
                    $row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $status_plan,
                    $status_do,
                   $status_check,
                   $status_action
		    );
	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
	$data['content']=$this->table->generate();
        $data['action']='fgt_pelatihan/index/0/1';

        $this->template->display('fgt_pelatihan/index_view',$data);
    }

    function plan() {
	$data['title']='PLAN';
  $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_plan();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		                'Judul Program',
                    'Akt',
                    'PIC',
		                'Mulai',
                    'Selesai',
                    'Kota',
                    'Tempat',
                    'Status',
                    'Peserta',
                    'Sarfas'
		);


	$q=$this->mdl_fgt_pelatihan->get_plan()->result_array();
	$i=0;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_plan($row['id']);

            if ($this->mdl_peserta->count_all($row['id'])<0) {
            $peserta='';
            }  else {
            $peserta=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all($row['id']));
            }

            if ($this->mdl_fgt_pelatihan->count_sarfas($row['id'])<=0) {
            $sarfas=  anchor('fgt_pelatihan/add_sarfas/'.$row['id'], 'Tambah', array('class'=>'label label-important'));
            }  else {
            $sarfas=$this->cek_sarfas($row['id']);;
            }

                if (empty($row['tempat'])){
                $tempat=  anchor('sarfas/tempat/'.$row['id'],'Tambah', array('class'=>'label label-important'));
            }  else {
                $tempat=  anchor('sarfas/tempat/'.$row['id'], $row['tempat'].'<br>'.$row['ruangan'], array('class'=>'label label-info'));
            }

           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul,
                    $row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $tempat,
                    $status,
                    $peserta,
                    $sarfas
		    );
	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
	$data['tambah']=  anchor('fgt_pelatihan/add_plan', 'Tambah', array('class'=>'btn btn-success'));
        $data['content']=$this->table->generate();

        $this->template->display('fgt_pelatihan/index_plan',$data);
    }

     function cek_sarfas($id) {
         if($this->mdl_fgt_pelatihan->get_sarfas_by_pelatihan($id)->row()->status==1){
          $sarfas=anchor('sarfas/view_sarfas/'.$id,'Detail',array('class'=>'label label-success'));
         }  else {
         $sarfas=anchor('sarfas/view_sarfas/'.$id,'Detail',array('class'=>'label label-warning'));
         }
         return $sarfas;
        }

    function edit_plan($id) {
     $data['title']='Edit PLAN';
     $data['action']='fgt_pelatihan/edit_plan/'.$id;
     $this->__set_rules_edit_plan();
     if ($this->form_validation->run()==FALSE){
             if (empty($this->mdl_fgt_pelatihan->get_by_id($id)->row()->tempat)){
                $data['tempat']=  anchor('sarfas/tempat/'.$id,'Tambah', array('class'=>'label label-important'));
            }  else {
                $data['tempat']=  anchor('sarfas/tempat/'.$id,$this->mdl_fgt_pelatihan->get_by_id($id)->row()->tempat.'<br>'.$this->mdl_fgt_pelatihan->get_by_id($id)->row()->ruangan, array('class'=>'label label-info'));
            }

         $data['provider']='';
         // Tabel Biaya Provider
              $provider=  $this->mdl_fgt_pelatihan->get_provider_by_pelatihan($id);
              if ($provider<= 0) {
                    $data['provider'] = '<div id="null_provider">Tidak ada data provider</div>';
                } else {
                        $tbl_provider = $this->mdl_fgt_pelatihan->get_biaya_provider($id)->row();
                        $data['provider'].=$this->mdl_provider->get_by_id($tbl_provider->id_provider)->row()->name.'<br>';
                        $data['provider'].='<tr><th>Keterangan</th><th>Harga Penawaran</th><th>Harga Negosiasi</th><th>Jumlah Peserta</th><th>Harga Tambahan Peserta</th></tr>';
                        $data['provider'].= '<tr><td>'.$tbl_provider->ket.'</td><td>' . $this->editor->formatMoney($tbl_provider->harga_penawaran).'</td><td>' . $this->editor->formatMoney($tbl_provider->harga_negosiasi).'</td><td>' .$tbl_provider->jml_peserta.'</td><td>' .$this->editor->formatMoney($tbl_provider->harga_tambahan_peserta).'</td>'.'<input type="hidden" name="provider" value="' . $tbl_provider->id_provider . '"><input type="hidden" name="ket" value="' . $tbl_provider->ket . '"><input type="hidden" name="harga_penawaran" value="' . $tbl_provider->harga_penawaran . '"><input type="hidden" name="harga_negosiasi" value="' . $tbl_provider->harga_negosiasi . '"><input type="hidden" name="jml_peserta" value="'.$tbl_provider->jml_peserta.'"><input type="hidden" name="harga_tambahan_peserta" value="' . $tbl_provider->harga_tambahan_peserta.'"></tr>';
                        $data['provider'].= '<tr><td>'.$tbl_provider->ket2.'</td><td>' . $this->editor->formatMoney($tbl_provider->harga_penawaran2).'</td><td>' .$this->editor->formatMoney($tbl_provider->harga_negosiasi2).'</td><td>' .$tbl_provider->jml_peserta2.'</td><td>' .$this->editor->formatMoney($tbl_provider->harga_tambahan_peserta2).'</td>'.'<input type="hidden" name="ket" value="' . $tbl_provider->ket2 . '"><input type="hidden" name="harga_penawaran" value="' . $tbl_provider->harga_penawaran2 . '"><input type="hidden" name="harga_negosiasi" value="' . $tbl_provider->harga_negosiasi2 . '"><input type="hidden" name="jml_peserta" value="'.$tbl_provider->jml_peserta2.'"><input type="hidden" name="harga_tambahan_peserta" value="' . $tbl_provider->harga_tambahan_peserta2.'"></tr>';
                        $data['provider'].= '<tr><td>'.$tbl_provider->ket3.'</td><td>' . $this->editor->formatMoney($tbl_provider->harga_penawaran3).'</td><td>' .$this->editor->formatMoney($tbl_provider->harga_negosiasi3).'</td><td>' .$tbl_provider->jml_peserta3.'</td><td>' .$this->editor->formatMoney($tbl_provider->harga_tambahan_peserta3).'</td>'.'<input type="hidden" name="ket" value="' . $tbl_provider->ket3 . '"><input type="hidden" name="harga_penawaran" value="' . $tbl_provider->harga_penawaran3 . '"><input type="hidden" name="harga_negosiasi" value="' . $tbl_provider->harga_negosiasi3 . '"><input type="hidden" name="jml_peserta" value="'.$tbl_provider->jml_peserta3.'"><input type="hidden" name="harga_tambahan_peserta" value="' . $tbl_provider->harga_tambahan_peserta3.'"></tr>';
                        $data['provider'].='<tr><td><b>Total</b></td><td><b>'.number_format(floatval(($tbl_provider->harga_penawaran+$tbl_provider->harga_penawaran2+$tbl_provider->harga_penawaran3)), 0 , '' , '.' ).'</b></td><td><b>'.  number_format(floatval(($tbl_provider->harga_negosiasi+$tbl_provider->harga_negosiasi2+$tbl_provider->harga_negosiasi3)), 0, '','.').'</b></td><td><b>'.number_format(floatval(($tbl_provider->jml_peserta+$tbl_provider->jml_peserta2+$tbl_provider->jml_peserta3)), 0, '','.').'</b></td><td><b>'.  number_format(floatval(($tbl_provider->harga_tambahan_peserta+$tbl_provider->harga_tambahan_peserta2+$tbl_provider->harga_tambahan_peserta3)), 0, '', '.').'</b></td></tr>';

                }

                  // Tabel Biaya Pengajar
              $pengajar=  $this->mdl_fgt_pelatihan->get_pengajar_by_pelatihan($id);
              if ($pengajar<= 0) {
                    $data['pengajar'] = '<tr id="null_pengajar"><td colspan="3">Tidak ada data pengajar</td></tr>';
                } else {
                        $tbl_pengajar = $this->mdl_fgt_pelatihan->get_biaya_pengajar($id)->result_array();
                        $data['pengajar']='';
                        foreach ($tbl_pengajar as $row) {
                    $data['pengajar'].='<tr><td>'.anchor('trainer/detail/'.$row['id_pengajar'],$this->mdl_trainer->get_by_id($row['id_pengajar'])->row()->name, array('target'=>'_blank')).'</td><td>'.$row['jml_sesi'].'</td><td>'.$row['honor_sesi'].'</td><td>'.  anchor('fgt_pelatihan/delete_pengajar/'.$id.'/'.$row['id'], 'Hapus').'</td></tr>';
                        }

                }

           //Tabel Plan
           $data['plan']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
         if (empty($data['plan']['lokasi_kota'])){
             $data['kota']='<div id="null_kota">Tidak ada data kota</div>';
         }else{
             $data['kota']="<div><input type='hidden' value='".$data['plan']['lokasi_kota']."' name='lokasi_kota'/>".$data['plan']['lokasi_kota']."<a href='#' class='remove_kota'><i class='icon-remove'></i></a></div>";
         }


         $opt_jenis=array(
             'Inhouse'=>'Inhouse',
             'Public'=>'Public'
         );
         $opt_dasar=array(
             'Reguler'=>'Reguler',
             'Adhoc'=>'Adhoc'
         );

         $opt_sifat=array(
             'Residential'=>'Residential',
             'Non Residential'=>'Non Residential'
         );

         $data['jenis']=  form_dropdown('jenis', $opt_jenis, $data['plan']['jenis']);
         $data['dasar']=  form_dropdown('dasar', $opt_dasar, $data['plan']['dasar']);
         $data['sifat']=  form_dropdown('sifat', $opt_sifat, $data['plan']['sifat']);

         $cat_list=$this->mdl_fgt_pelatihan->get_pic()->result();
	    $data['pic']='';
	    foreach ($cat_list as $list)
	    {
                if($data['plan']['pic']==ucwords(strtolower($list->nama))){
                    $data['pic'].='<option value="'.ucwords(strtolower($list->nama)).'" selected="selected">'.ucwords(strtolower($list->nama)).'</option>';
                }else{
                    $data['pic'].='<option value="'.ucwords(strtolower($list->nama)).'" >'.ucwords(strtolower($list->nama)).'</option>';
                }

	    }
         if ($this->mdl_fgt_pelatihan->count_sarfas($id)<=0) {
            $data['sarfas']=  anchor('fgt_pelatihan/add_sarfas/'.$id, 'Tambah', array('class'=>'label label-important'));
            }  else {
            $data['sarfas']=$this->cek_sarfas($id);
            }

         $data['ref']=  explode('#', $data['plan']['reference']);
         $data['ref_hrbp']=  explode('#', $data['plan']['reference_hrbp']);
         $data['judul']=  $this->mdl_pelatihan->get_by_id($data['plan']['kd_pelatihan'])->row()->judul;
         $this->template->display('fgt_pelatihan/edit_plan',$data);
     }else{

      $provider=  $this->mdl_fgt_pelatihan->get_provider_by_pelatihan($id);
      if ($provider<=0){
      if ($this->input->post('provider')!=''){
      $prov=array(
          'id_provider'=>  $this->input->post('provider'),
          'id_trans_pelatihan'=>  $id,
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
      $this->mdl_fgt_pelatihan->add_biaya_provider($prov);
      }
  }else{
      $prov=array(
          'id_provider'=>  $this->input->post('provider'),
          'id_trans_pelatihan'=>  $id,
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
      $this->mdl_fgt_pelatihan->update_biaya_provider($id,$prov);
  }

      $reference=  $this->input->post('ref_user').'#'.  $this->input->post('ref_memo').'#'.  $this->input->post('ref_tgl');
      $reference_hrbp=  $this->input->post('ref_hrbp').'#'.  $this->input->post('ref_hrbp_memo').'#'.  $this->input->post('ref_hrbp_tgl');
                $plan=array(
                    'pic'=>  $this->input->post('pic'),
                    'dasar'=> $this->input->post('dasar'),
                    'reference'=>  $reference,
                    'reference_hrbp'=>  $reference_hrbp,
                    'sifat'=> $this->input->post('sifat'),
                    'kuota_kelas'=> $this->input->post('kuota_kelas'),
                    'tgl_mulai'=>  $this->input->post('tgl_mulai'),
                    'tgl_selesai'=>  $this->input->post('tgl_selesai'),
                    'lokasi_kota'=> $this->input->post('lokasi_kota'),
                    'update_date'=> date('Y-m-d G:i:s'),
                    'plan_user'=> $this->session->userdata('user_name')

                );
                $this->mdl_fgt_pelatihan->update($id,$plan);

                $pengajar=  $this->input->post('pengajar');
                if (!empty($pengajar)) {
                $jml_sesi=  $this->input->post('jml_sesi');
                $honor_sesi=  $this->input->post('honor_sesi');
                for ($a=0;$a<count($pengajar);$a++){
                $biaya_pengajar=array(
                    'id_pengajar'=>$pengajar[$a],
                    'id_trans_pelatihan'=>$id,
                    'jml_sesi'=>$jml_sesi[$a],
                    'honor_sesi'=>$honor_sesi[$a],
                    'insert_date'=>  date('Y-m-d G:i:s'),
                    'user'=> $this->session->userdata('user_name')
                );
                $this->mdl_fgt_pelatihan->add_biaya_pengajar($biaya_pengajar);
                 }
                }
                redirect('fgt_pelatihan/plan');
     }

    }


    function delete_pengajar($id_pelatihan,$id_pengajar) {
        $this->mdl_fgt_pelatihan->delete_pengajar($id_pengajar);
        redirect('fgt_pelatihan/edit_plan/'.$id_pelatihan);

    }

    function delete_observer($id_pelatihan,$id_observer) {
        $this->mdl_fgt_pelatihan->delete_observer($id_observer);
        redirect('fgt_pelatihan/edit_do/'.$id_pelatihan);
    }

        function add_plan() {
        $data['title']='Tambah Plan';
        $data['action']='fgt_pelatihan/add_plan';
        $this->__set_rules_add_plan();
        if ($this->form_validation->run()==FALSE) {
            $cat_list=$this->mdl_fgt_pelatihan->get_pic()->result();
	    $data['pic']='';
	    foreach ($cat_list as $list)
	    {
		$data['pic'].='<option value="'.ucwords(strtolower($list->nama)).'">'.ucwords(strtolower($list->nama)).'</option>';
	    }


            $this->template->display('fgt_pelatihan/add_plan',$data);
        }  else {
                $pengajar = $this->input->post('pengajar');
                if ($pengajar != 0) {
                    $pengajar = implode('#', $pengajar);
                } else {
                    $pengajar = '';
                }
     $last_record= $this->mdl_fgt_pelatihan->get_last_record();
     if (empty($last_record)){
         $last_record=1;
     }  else {
     $last_record++;
     }

     if ($this->input->post('jenis')=='Inhouse') {
         $jenis='IN';
     }else{
         $jenis='PUB';
     }

     $tahun=  date('Y');
     $kd_tiket=$last_record.'/'.$jenis.'/'.$tahun;
     $reference=  $this->input->post('ref_user').'#'.  $this->input->post('ref_memo').'#'.  $this->input->post('ref_tgl');
     $reference_hrbp=  $this->input->post('ref_hrbp').'#'.  $this->input->post('ref_hrbp_memo').'#'.  $this->input->post('ref_hrbp_tgl');
     $batch=  $this->mdl_fgt_pelatihan->count_batch($this->input->post('kd_pelatihan'));
     $plan=array(
                    'kd_tiket'=>$kd_tiket,
                    'pic'=>  $this->input->post('pic'),
                    'kd_pelatihan'=>  $this->input->post('kd_pelatihan'),
                    'batch'=>  $batch+1,
                    'dasar'=> $this->input->post('dasar'),
                    'reference'=>  $reference,
                    'reference_hrbp'=>  $reference_hrbp,
                    'jenis'=>  $this->input->post('jenis'),
                    'sifat'=> $this->input->post('sifat'),
                    'kuota_kelas'=> $this->input->post('kuota_kelas'),
                    'tgl_mulai'=>  $this->input->post('tgl_mulai'),
                    'tgl_selesai'=>  $this->input->post('tgl_selesai'),
                    'lokasi_kota'=> $this->input->post('lokasi_kota'),
                    'insert_date'=> date('Y-m-d G:i:s'),
                    'plan_user'=> $this->session->userdata('user_name')

                );
                $this->mdl_fgt_pelatihan->add($plan);

                $pengajar=  $this->input->post('pengajar');
                if (!empty($pengajar)) {
                $jml_sesi=  $this->input->post('jml_sesi');
                $honor_sesi=  $this->input->post('honor_sesi');
                for ($a=0;$a<count($pengajar);$a++){
                $biaya_pengajar=array(
                    'id_pengajar'=>$pengajar[$a],
                    'id_trans_pelatihan'=>$last_record,
                    'jml_sesi'=>$jml_sesi[$a],
                    'honor_sesi'=>$honor_sesi[$a],
                    'insert_date'=>  date('Y-m-d G:i:s')
                );
                $this->mdl_fgt_pelatihan->add_biaya_pengajar($biaya_pengajar);
                 }
                }

                $provider=  $this->input->post('provider');
                if (!empty($provider)){
                $provider=array(
                    'id_provider'=>  $this->input->post('provider'),
                    'id_trans_pelatihan'=>$last_record,
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
                $this->mdl_fgt_pelatihan->add_biaya_provider($provider);
                }
               redirect('fgt_pelatihan/plan');

        }

    }


    function list_do() {
	$data['title']='DO';
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_do();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Program',
                    'Akt',
                    'PIC',
		    'Mulai',
                    'Selesai',
                    'Kota',
                    'Status'
		);

	$q=$this->mdl_fgt_pelatihan->get_do()->result_array();
	$i=0;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_do($row['id']);
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul,
                    $row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $status
		    );

	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);

        $data['content']=$this->table->generate();
        $this->template->display('fgt_pelatihan/index_do',$data);
    }

    function edit_do($id) {
        $data['action']='fgt_pelatihan/edit_do/'.$id;
        $data['title']='DO';
        $this->__set_rules_edit_do();
        if ($this->form_validation->run()==FALSE) {
      $data['do']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
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

      if (!empty($data['do']['memo_bantuan_mengajar'])){
          $memo_bantuan_mengajar=  explode('#', $data['do']['memo_bantuan_mengajar']);
          $data['no_memo_mengajar']=$memo_bantuan_mengajar[0];
          $data['tgl_memo_mengajar']=$memo_bantuan_mengajar[1];

      }else{
          $data['no_memo_mengajar']='';
          $data['tgl_memo_mengajar']='';
      }

        if (!empty($data['do']['fax_bantuan_mengajar'])){
          $fax_bantuan_mengajar=  explode('#', $data['do']['fax_bantuan_mengajar']);
          $data['no_fax_mengajar']=$fax_bantuan_mengajar[0];
          $data['tgl_fax_mengajar']=$fax_bantuan_mengajar[1];

      }else{
          $data['no_fax_mengajar']='';
          $data['tgl_fax_mengajar']='';
      }

      if (!empty($data['do']['surat_bantuan_mengajar'])){
          $surat_bantuan_mengajar=  explode('#', $data['do']['surat_bantuan_mengajar']);
          $data['no_surat_mengajar']=$surat_bantuan_mengajar[0];
          $data['tgl_surat_mengajar']=$surat_bantuan_mengajar[1];

      }else{
          $data['no_surat_mengajar']='';
          $data['tgl_surat_mengajar']='';
      }

      if (!empty($data['do']['spk'])){
          $spk=  explode('#', $data['do']['spk']);
          $data['no_spk']=$spk[0];
          $data['tgl_spk']=$spk[1];

      }else{
          $data['no_spk']='';
          $data['tgl_spk']='';
      }

           if (!empty($data['do']['input_tem'])){
          $spk=  explode('#', $data['do']['input_tem']);
          $data['no_tem']=$spk[0];
          $data['tgl_tem']=$spk[1];

      }else{
          $data['no_tem']='';
          $data['tgl_tem']='';
      }

      $observer=  $this->mdl_fgt_pelatihan->get_observer_by_pelatihan($id);
            if ($observer<= 0) {
                    $data['observer'] = '<tr id="null_cs"><td>Tidak ada data observer</td></tr>';
                } else {

                        $tbl_observer = $this->mdl_fgt_pelatihan->get_biaya_observer($id)->row();
                        $data['observer']= '<tr><td>' . $this->mdl_observer->get_by_id($tbl_observer->id_observer)->row()->nama .' | ' .$tbl_observer->biaya .anchor('fgt_pelatihan/delete_observer/'.$id.'/'.$tbl_observer->id, '<i class="icon-remove"></i>') . '<input type="hidden" name="observer" value="' . $tbl_observer->id_observer . '"><input type="hidden" name="biaya" value="' . $tbl_observer->biaya . '"></td></tr>';

                }

      $this->template->display('fgt_pelatihan/form_do',$data);
        } else {

        $do=array(
            'memo_panggilan_peserta'=> $this->cek_input($this->input->post('no_memo_peserta'), $this->input->post('tgl_memo_peserta')),
            'fax_panggilan_peserta'=> $this->cek_input($this->input->post('no_fax_peserta'),$this->input->post('tgl_fax_peserta')),
            'memo_bantuan_mengajar'=> $this->cek_input($this->input->post('no_memo_mengajar'),$this->input->post('tgl_memo_mengajar')),
            'fax_bantuan_mengajar'=> $this->cek_input($this->input->post('no_fax_mengajar'),$this->input->post('tgl_fax_mengajar')),
            'surat_bantuan_mengajar'=> $this->cek_input($this->input->post('no_surat_mengajar'),$this->input->post('tgl_surat_mengajar')),
            'spk'=> $this->cek_input($this->input->post('no_spk'),$this->input->post('tgl_spk')),
            'input_tem'=> $this->cek_input($this->input->post('no_tem'),$this->input->post('tgl_tem')),
            'do_user'=> $this->session->userdata('user_name')
        );
        $this->mdl_fgt_pelatihan->update($id,$do);
        $observer=  $this->mdl_fgt_pelatihan->get_observer_by_pelatihan($id);
  if ($observer<=0){
      if ($this->input->post('observer')!=''){
      $obs=array(
          'id_trans_pelatihan'=>$id,
          'id_observer'=>  $this->input->post('observer'),
          'biaya'=>  $this->input->post('biaya'),
          'insert_date'=>  date('Y-m-d G:i:s'),
          'user'=> $this->session->userdata('user_name')
      );
      $this->mdl_fgt_pelatihan->add_biaya_observer($obs);
      }

  }else{
          $obs=array(
          'id_observer'=>  $this->input->post('observer'),
          'biaya'=>  $this->input->post('biaya'),
          'update_date'=>  date('Y-m-d G:i:s'),
          'user'=> $this->session->userdata('user_name')
      );
      $this->mdl_fgt_pelatihan->update_biaya_observer($id,$obs);
  }
  redirect('fgt_pelatihan/list_do');
        }

    }

        function list_check($dat=0) {
	$data['title']='CHECK PESERTA';
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket');
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');

 //       $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['action']='fgt_pelatihan/list_check/1';
        $data['refresh']=anchor('fgt_pelatihan/list_check', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info'));

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Program',
                    'Akt',
                    'PIC',
		    'Mulai',
                    'Selesai',
                    'Undangan',
                    'Konfirmasi',
                    'Hadir',
                    'Rek'
		);


     if ($dat==1) {
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $q=$this->mdl_fgt_pelatihan->get_index_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai)->result_array();
        } else {
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view_bulan();
        $q=$this->mdl_fgt_pelatihan->get_index_view_bulan()->result_array();
        }
// 	$q=$this->mdl_fgt_pelatihan->get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_check($row['id']);

            if ($this->mdl_peserta->count_all($row['id'])<=0) {
            $jml_peserta=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all($row['id']).' Orang');
            $konfirmasi=0;
            $hadir=0;

            }  else {
            $jml_peserta=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all($row['id']).' Orang');
            $konfirmasi=  $this->mdl_peserta->count_all_konfirmasi($row['id']).' Orang';
            $hadir=  $this->mdl_peserta->count_all_hadir($row['id']).' Orang';
            }

           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul,
                    $row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $jml_peserta,
                    $konfirmasi,
                    $hadir,
                    $status
		    );

	}

       $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
        $data['content']=$this->table->generate();
        $this->template->display('fgt_pelatihan/index_check',$data);
    }

    function send_mail_ls($id) {
        $pelatihan=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        $subject= 'Kebutuhan Sarana Untuk Pelatihan '.$this->mdl_pelatihan->get_by_id($pelatihan['kd_pelatihan'])->row()->judul.' Batch '.$pelatihan['batch'];
        $body='No Tiket :'.$pelatihan['kd_tiket'].' untuk kebutuhan sarana seperti pada tautan berikut : '. base_url().'sarfas/view_sarfas/'.$id;
        header('Location: mailto:sriyono@pertamina.com?body='.$body.'&subject='.$subject);
        $this->plan();
    }


        function list_action() {
	$data['title']='ACTION';
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_action();
	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Program',
                    'Akt',
                    'PIC',
		    'Mulai',
                    'Selesai',
                    'Kota',
                    'status',
                    'Pembatalan'
		);

	$q=$this->mdl_fgt_pelatihan->get_action()->result_array();
	$i=0;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	   $status=  $this->cek_action($row['id']);
           if ($row['action_status']==1){
               $pembatalan='';
           }else{
               $pembatalan=  anchor('fgt_pelatihan/action_batal/'.$row['id'], 'Batalkan', array('class'=>'btn btn-mini btn-danger'));
           }
            if ($this->mdl_peserta->count_all($row['id'])<0) {
            $peserta='';
            }  else {
            $peserta=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all($row['id']));
            }
           $this->table->add_row(
		    ++$i,
                   $row['kd_tiket'],
                    $judul,
                    $row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $status,
                   $pembatalan
		    );

	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
        $data['content']=$this->table->generate();
        $this->template->display('fgt_pelatihan/index_action',$data);
    }

        function edit_action($id) {
        $data['act']='fgt_pelatihan/edit_action/'.$id;
        $data['title']='ACTION';
        $this->__set_rules_edit_action();
        if ($this->form_validation->run()==FALSE) {
      $data['action']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
      if (!empty($data['action']['bap_pelatihan'])){
          $bap_pelatihan=  explode('#', $data['action']['bap_pelatihan']);
          $data['no_bap']=$bap_pelatihan[0];
          $data['tgl_bap']=$bap_pelatihan[1];

      }else{
          $data['no_bap']='';
          $data['tgl_bap']='';
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


      if (!empty($data['action']['hasil_evaluasi'])){
          $hasil_evaluasi=  explode('#', $data['action']['hasil_evaluasi']);
          $data['nilai_evaluasi']=$hasil_evaluasi[0];
          $data['upload']=$hasil_evaluasi[1];
          $data['download_evaluasi']=  anchor('./assets/uploads/evaluasi/'.$hasil_evaluasi[1], $hasil_evaluasi[1],array('class'=>'label label-info','target'=>'_blank'));
      }else{
          $data['nilai_evaluasi']='';
          $data['upload']='';
          $data['download_evaluasi']='';
      }

      $this->template->display('fgt_pelatihan/form_action',$data);
        } else {
                    $this->upload->initialize(array(
                'upload_path' => './assets/uploads/evaluasi/',
                'allowed_types' => '*',
                'max_size' => 50000,
                'remove_spaces' => true,
                'overwrite' => false
            ));

            if (!$this->upload->do_upload('upload_evaluasi')){
                $data_evaluasi=  $this->input->post('upload_evaluasi2');
            } else {
                $unggah=  $this->upload->data();
                $unggah['file_name'];
                $data_evaluasi=$unggah['file_name'];
            }

        $action=array(
            'bap_pelatihan'=> $this->cek_input($this->input->post('no_bap'), $this->input->post('tgl_bap')),
            'cetak_sertifikat'=> $this->cek_input($this->input->post('no_sertifikat'), $this->input->post('tgl_sertifikat')),
            'invoice_diterima'=> $this->cek_input($this->input->post('no_invoice_diterima'), $this->input->post('tgl_invoice_diterima')),
            'invoice_dikirim'=> $this->cek_input($this->input->post('no_invoice_dikirim'), $this->input->post('tgl_invoice_dikirim')),
            'memo_pembayaran_honor'=> $this->cek_input($this->input->post('no_memo_honor'), $this->input->post('tgl_memo_honor')),
            'hasil_evaluasi'=> $this->cek_input($this->input->post('nilai_evaluasi'), $data_evaluasi),
            'action_user'=> $this->session->userdata('user_name')
        );
        $this->mdl_fgt_pelatihan->update($id,$action);

  redirect('fgt_pelatihan/list_action');
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
            $output='No : - <br> Tanggal : -';
        }
        return $output;
    }

        function action_batal($id) {
        $data['act']='fgt_pelatihan/action_batal/'.$id;
        $data['title']='Pembatalan Training';
        $this->__set_rules_batal_action();
        if ($this->form_validation->run()==FALSE) {
        $data['batal']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        $this->template->display('fgt_pelatihan/form_batal',$data);
        } else {
        $data['btl']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        $batal=array(
                'id_trans_pelatihan'=>$data['btl']['id'],
                'kd_tiket'=>$data['btl']['kd_tiket'],
                'pic'=>$data['btl']['pic'],
                'id_pelatihan'=>$data['btl']['kd_pelatihan'],
                'batch'=>$data['btl']['batch'],
                'dasar'=>$data['btl']['dasar'],
                'reference'=>$data['btl']['reference'],
                'jenis'=>$data['btl']['jenis'],
                'sifat'=>$data['btl']['sifat'],
                'kuota_kelas'=>$data['btl']['kuota_kelas'],
                'tgl_mulai'=>$data['btl']['tgl_mulai'],
                'tgl_selesai'=>$data['btl']['tgl_selesai'],
                'lokasi_kota'=>$data['btl']['lokasi_kota'],
                'tempat'=>$data['btl']['tempat'],
                'ruangan'=>$data['btl']['ruangan'],
                'input_tem'=>$data['btl']['input_tem'],
                'memo_bantuan_mengajar'=>$data['btl']['memo_bantuan_mengajar'],
                'fax_bantuan_mengajar'=>$data['btl']['fax_bantuan_mengajar'],
                'surat_bantuan_mengajar'=>$data['btl']['surat_bantuan_mengajar'],
                'memo_panggilan_peserta'=>$data['btl']['memo_panggilan_peserta'],
                'fax_panggilan_peserta'=>$data['btl']['fax_panggilan_peserta'],
                'spk'=>$data['btl']['spk'],
                'memo_pembatalan_training'=>$this->input->post('no_memo_batal').'#'.$this->input->post('tgl_memo_batal'),
                'fax_pembatalan_training'=>  $this->input->post('no_fax_batal').'#'.$this->input->post('tgl_fax_batal'),
                'memo_pembatalan_mengajar'=>  $this->input->post('no_memo_mengajar').'#'.$this->input->post('tgl_memo_mengajar'),
                'fax_pembatalan_mengajar'=>  $this->input->post('no_fax_mengajar').'#'.$this->input->post('tgl_fax_mengajar'),
                'surat_pembatalan_kerja'=>  $this->input->post('no_spk').'#'.$this->input->post('tgl_spk'),
                'invoice_diterima'=>  $this->input->post('no_spk').'#'.$this->input->post('tgl_spk'),
                'invoice_dikirim'=>  $this->input->post('no_invoice_dikirim').'#'.$this->input->post('tgl_invoice_dikirim'),
                'user'=> $this->session->userdata('user_name')
            );
        $this->mdl_fgt_pelatihan->add_pelatihan_batal($batal);
        $this->mdl_fgt_pelatihan->delete($id);
        redirect('fgt_pelatihan/list_canceled');
        }
    }

        function list_report($dat=0) {
	$data['title']='REPORT';
	$kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket');
        $dasar=$this->input->post('dasar');
        $jenis=$this->input->post('jenis');
        $sifat=$this->input->post('sifat');
        $kota=$this->input->post('kota');
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');

        $data['action']='fgt_pelatihan/list_report/1';
        $data['refresh']=anchor('fgt_pelatihan/list_report', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info'));

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
		    'Judul Program',
                    'Akt',
		    'Tanggal Mulai',
                    'Tanggal Selesai',
                    'Kota',
                    'Undangan Peserta',
                    'Konfirmasi Peserta',
                    'Kehadiran Peserta',
                    'SLA',
                    'Occupancy Rate',
                    'Cost Efficiency',
                    'Effectiviness',
                    ''
		);
   if ($dat==1) {
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view_report($kd_pelatihan,$batch,$no_tiket,$dasar,$jenis,$sifat,$kota,$tgl_awal,$tgl_selesai);
        $q=$this->mdl_fgt_pelatihan->get_index_view_report($kd_pelatihan,$batch,$no_tiket,$dasar,$jenis,$sifat,$kota,$tgl_awal,$tgl_selesai)->result_array();
        } else {
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view_bulan();
        $q=$this->mdl_fgt_pelatihan->get_index_view_bulan()->result_array();
        }
	// $q=$this->mdl_fgt_pelatihan->get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0;
        $data['jml_peserta']=0;
        $data['jml_konfirmasi']=0;
        $data['jml_hadir']=0;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
	 //  $status=  $this->cek_result($row['id']);
            $detail=  anchor('fgt_pelatihan/detail/'.$row['id'], '<i class="icon icon-zoom-in icon-white"></i>', array('class'=>'label label-success'));

$jml_hadir=  $this->mdl_peserta->cek_kehadiran($row['id'],1);
$or=($jml_hadir/10)*100;

    if ($this->mdl_fgt_pelatihan->get_biaya_provider($row['id'])->num_rows()>0){
    $provider=  $this->mdl_fgt_pelatihan->get_biaya_provider($row['id'])->row_array();
    $harga_penawaran=($provider['harga_penawaran']+$provider['harga_penawaran2']+$provider['harga_penawaran3']);
    if($harga_penawaran==0){
    $harga_penawaran=1;
    }

$harga_negosiasi=($provider['harga_negosiasi']+$provider['harga_negosiasi2']+$provider['harga_negosiasi3']);
$ce=(($harga_penawaran-$harga_negosiasi)/$harga_penawaran)*100;

}else{
    $ce=0;
}


if (empty($row['invoice_dikirim']) || empty($row['reference'])){
$sla='0';
}else{
$invoice_dikirim=  explode("#", $row['invoice_dikirim']);
$ref=  explode("#", $row['reference']);
$sla=$this->sla($ref[2],$invoice_dikirim[1]);
}

if (!empty($row['hasil_evaluasi'])){
    $evaluasi=  explode('#', $row['hasil_evaluasi']);
    $nilai_evaluasi=$evaluasi[0];
}else{
    $nilai_evaluasi='';
}
//Peserta
if ($this->mdl_peserta->count_all($row['id'])<=0) {
            $jml_peserta=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all($row['id']).' Orang');
            $konfirmasi=0;
            $hadir=0;

            }  else {
            $jml_peserta=anchor('peserta/view/'.$row['id'],$this->mdl_peserta->count_all($row['id']).' Orang');
            $konfirmasi=  $this->mdl_peserta->count_all_konfirmasi($row['id']).' Orang';
            $hadir=  $this->mdl_peserta->count_all_hadir($row['id']).' Orang';

            $data['jml_peserta']+=$this->mdl_peserta->count_all($row['id']);
            $data['jml_konfirmasi']+=$this->mdl_peserta->count_all_konfirmasi($row['id']);
            $data['jml_hadir']+=$this->mdl_peserta->count_all_hadir($row['id']);
            }

    $this->table->add_row(
		    ++$i,
                    $judul,
                    $row['batch'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
            $jml_peserta,
            $konfirmasi,
            $hadir,
                    $sla.' Hari',
                    $or.' %',
                    round($ce, 0).' %',
                    $nilai_evaluasi,
                    $detail
		    );

	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
        $data['content']=$this->table->generate();
        $this->template->display('fgt_pelatihan/index_report',$data);
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
	$config['base_url']=site_url('fgt_pelatihan/list_canceled/');
	$config['total_rows']=$this->mdl_fgt_pelatihan->count_all_view_canceled($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view_canceled($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $data['action']='fgt_pelatihan/list_canceled';
        $data['refresh']=anchor('fgt_pelatihan/list_canceled', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info'));

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Program',
                    'Akt',
                    'PIC',
		    'Mulai',
                    'Selesai',
                    'Kota',
                    ''
		);

	$q=$this->mdl_fgt_pelatihan->get_index_canceled($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,  $this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['id_pelatihan'])->row()->judul;

           $detail=  anchor('fgt_pelatihan/detail_canceled/'.$row['id'], '<i class="icon icon-zoom-in icon-white"></i>', array('class'=>'label label-info'));
           $this->table->add_row(
		    ++$i,
                    $row['kd_tiket'],
                    $judul,
                    $row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $detail
		    );

	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
        $data['content']=$this->table->generate();
        $this->template->display('fgt_pelatihan/index_canceled',$data);
    }

 /*
        function export_excel($kd_pelatihan=0,$batch=0,$no_tiket=0,$tgl_awal=0,$tgl_selesai=0) {
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
        $this->table->set_caption("Course Report<br>");

        $this->table->set_heading(
                'No',
                'No Tiket',
                'Judul Program',
                'Akt',
                'PIC',
                'Mulai',
                'Selesai',
                'Kota',
                'Dasar',
                'Reference',
                'Jenis',
                'Sifat',
                'Kuota Kelas',
                'SLA',
                'Occupancy Rate',
                'Cost Efficiency'
        );

        $q=$this->mdl_fgt_pelatihan->to_excel($kd_pelatihan=0,$batch=0,$no_tiket=0,$tgl_awal=0,$tgl_selesai=0)->result_array();
        $i=0;
        foreach ($q as $row) {
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;

    $jml_hadir=  $this->mdl_peserta->cek_kehadiran($row['id'],1);
    $or=($jml_hadir/10)*100;

    if ($this->mdl_fgt_pelatihan->get_biaya_provider($row['id'])->num_rows()>0){
    $provider=  $this->mdl_fgt_pelatihan->get_biaya_provider($row['id'])->row_array();
    $harga_penawaran=($provider['harga_penawaran']+$provider['harga_penawaran2']+$provider['harga_penawaran3']);
    if($harga_penawaran==0){
    $harga_penawaran=1;
    }

    $harga_negosiasi=($provider['harga_negosiasi']+$provider['harga_negosiasi2']+$provider['harga_negosiasi3']);
    $ce=(($harga_penawaran-$harga_negosiasi)/$harga_penawaran)*100;

    }else{
    $ce=0;
    }

    if (empty($row['invoice_dikirim']) || empty($row['reference'])){
    $sla='0';
    }else{
    $invoice_dikirim=  explode("#", $row['invoice_dikirim']);
    $ref=  explode("#", $row['reference']);
    $sla=$this->sla($ref[2],$invoice_dikirim[1]);
    }
            $this->table->add_row(
		    ++$i,
                    $row['kd_tiket'],
                    $judul,
                    $row['batch'],
		    $row['pic'],
                    $row['tgl_mulai'],
                    $row['tgl_selesai'],
                    $row['lokasi_kota'],
                    $row['dasar'],
                    $row['reference'],
                    $row['jenis'],
                    $row['sifat'],
                    $row['kuota_kelas'],
                    $sla.' Hari',
                    $or.' %',
                    round($ce, 0).' %'
		    );
        }

        //$this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=Pelatihan.xls");  //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        echo $data['content'];
    }
    */

    function list_support($dat=0) {
	$data['title']='Support';
        $kd_pelatihan=$this->input->post('kd_pelatihan');
        $batch=  $this->input->post('batch');
        $no_tiket=$this->input->post('no_tiket');
        $tgl_awal=  $this->input->post('tgl_awal');
        $tgl_selesai=  $this->input->post('tgl_selesai');

        $data['action']='fgt_pelatihan/list_support/1';
        $data['refresh']=anchor('fgt_pelatihan/list_support', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class'=>'btn btn-info'));

	/* List Table */

	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    'No',
                    'No Tiket',
		    'Judul Program',
                    'Akt',
                    'PIC',
		    'Mulai',
                    'Selesai',
                    'Kota',
                    'Tempat',
                ''
		);
     if ($dat==1) {
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai);
        $q=$this->mdl_fgt_pelatihan->get_index_view($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai)->result_array();
        } else {
        $data['jml_pelatihan']=$this->mdl_fgt_pelatihan->count_all_view_bulan();
        $q=$this->mdl_fgt_pelatihan->get_index_view_bulan()->result_array();
        }

    // $q=$this->mdl_fgt_pelatihan->get_index($kd_pelatihan,$batch,$no_tiket,$tgl_awal,$tgl_selesai,$this->limit,$offset)->result_array();
	$i=0;
	foreach ($q as $row)
	{
           $judul=  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
           $detail=  anchor('fgt_pelatihan/support/'.$row['id'], '<i class="icon icon-zoom-in icon-white"></i>Lihat', array('class'=>'label label-info'));
           $this->table->add_row(
		    ++$i,
                    $row['kd_tiket'],
                    $judul,
                    $row['batch'],
		    $row['pic'],
                    $this->editor->date_correct($row['tgl_mulai']),
                    $this->editor->date_correct($row['tgl_selesai']),
                    $row['lokasi_kota'],
                    $row['tempat'],
                    $detail
		    );

	}
       $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
        $data['content']=$this->table->generate();
        $this->template->display('fgt_pelatihan/index_support',$data);
    }

    function support($id) {
        $data['title']="Support";
        $data['support']=$this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        $data['judul']=  $this->mdl_pelatihan->get_by_id($data['support']['kd_pelatihan'])->row()->judul.' Batch '.$data['support']['batch'];
        $data['reference']=  explode("#", $data['support']['reference_hrbp']);

        if ($this->mdl_fgt_pelatihan->get_biaya_provider($id)->num_rows()>0){
        $prov=  $this->mdl_fgt_pelatihan->get_biaya_provider($id)->result_array();
        $data['provider']='';
        $data['harga_penawaran']='';
        $data['harga_negosiasi']='';

        foreach ($prov as $row) {
        $data['provider'].=$this->mdl_provider->get_by_id($row['id_provider'])->row()->name;
        $data['harga_penawaran'].=$row['harga_penawaran'];
        $data['harga_negosiasi'].=$row['harga_negosiasi'];

        }
        }else{
        $data['provider']='';
        $data['harga_penawaran']='';
        $data['harga_negosiasi']='';

        }

        if ($this->mdl_peserta->count_all($id)<=0) {
            $data['jml_peserta']='0 Orang';
            }  else {
            $data['jml_peserta']=$this->mdl_peserta->count_all($id).' Orang';
            }

        $this->template->display('fgt_pelatihan/support',$data);
    }

    function detail($id) {
        $data['title']='Detail Pelatihan';
        $data['detail']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
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
        $data['bap_pelatihan']=  $this->cek_output($data['detail']['bap_pelatihan']);
        $data['cetak_sertifikat']=  $this->cek_output($data['detail']['cetak_sertifikat']);
        $data['invoice_diterima']=  $this->cek_output($data['detail']['invoice_diterima']);
        $data['invoice_dikirim']=  $this->cek_output($data['detail']['invoice_dikirim']);
        $data['memo_pembayaran_honor']=  $this->cek_output($data['detail']['memo_pembayaran_honor']);
        $data['input_tem']=  $this->cek_output($data['detail']['input_tem']);

        if ($this->mdl_fgt_pelatihan->get_biaya_pengajar($id)->num_rows()>0){
        $peng=  $this->mdl_fgt_pelatihan->get_biaya_pengajar($id)->result_array();
        $data['pengajar']='';
        foreach ($peng as $row) {
        $data['pengajar'].='<tr><th>Nama</th><th>Jml Sesi</th><th>Honor Per Sesi</th></tr>';
        $data['pengajar'].='<tr><td>'.$this->mdl_trainer->get_by_id($row['id_pengajar'])->row()->name.'</td><td>'.$row['jml_sesi'].'</td><td>'.$row['honor_sesi'].'</td></tr>';
        }
        }else{
        $data['pengajar']='Tidak Ada Pengajar';
        }

        if ($this->mdl_fgt_pelatihan->get_biaya_provider($id)->num_rows()>0){
        $prov=  $this->mdl_fgt_pelatihan->get_biaya_provider($id)->result_array();
        $data['provider']='';
        foreach ($prov as $row) {
        $data['provider'].=$this->mdl_provider->get_by_id($row['id_provider'])->row()->name;
        $data['provider'].='<table border="1"><tr><th>Ket</th><th>Harga Penawaran</th><th>Harga Negosiasi</th><th>Jumlah Peserta</th><th>Harga Tambahan Peserta</th></tr>';
        $data['provider'].='<tr><td>'.$row['ket'].'</td><td>'.  number_format(floatval($row['harga_penawaran']), 0, '', '.').'</td><td>'.  number_format(floatval($row['harga_negosiasi']), 0, '', '.').'</td><td>'.$row['jml_peserta'].'</td><td>'.number_format(floatval($row['harga_tambahan_peserta']), 0, '', '.').'</td></tr>';
        $data['provider'].='<tr><td>'.$row['ket2'].'</td><td>'.  number_format(floatval($row['harga_penawaran2']), 0, '', '.').'</td><td>'.  number_format(floatval($row['harga_negosiasi2']), 0, '', '.').'</td><td>'.$row['jml_peserta2'].'</td><td>'.  number_format(floatval($row['harga_tambahan_peserta2']),0, '', '.').'</td></tr>';
        $data['provider'].='<tr><td>'.$row['ket3'].'</td><td>'.  number_format(floatval($row['harga_penawaran3']), 0, '', '.').'</td><td>'.  number_format(floatval($row['harga_negosiasi3']), 0, '', '.').'</td><td>'.$row['jml_peserta3'].'</td><td>'.  number_format(floatval($row['harga_tambahan_peserta3']), 0, '', '.').'</td></tr>';
        $data['provider'].='<tr><td><b>Total</b></td><td><b>'.number_format(floatval(($row['harga_penawaran']+$row['harga_penawaran2']+$row['harga_penawaran3'])), 0 , '' , '.' ).'</b></td><td><b>'.number_format(floatval(($row['harga_negosiasi']+$row['harga_negosiasi2']+$row['harga_negosiasi3'])), 0, '','.').'</b></td><td><b>'.number_format(floatval(($row['jml_peserta']+$row['jml_peserta2']+$row['jml_peserta3'])), 0, '','.').'</b></td><td><b>'.number_format(floatval(($row['harga_tambahan_peserta']+$row['harga_tambahan_peserta2']+$row['harga_tambahan_peserta3'])), 0, '', '.').'</b></td></tr>';
        $data['provider'].='</table>';
        }
        }else{
        $data['provider']='Tidak Ada Provider';
        }

        if ($this->mdl_fgt_pelatihan->get_biaya_observer($id)->num_rows()>0){
        $obs=  $this->mdl_fgt_pelatihan->get_biaya_observer($id)->result_array();
        $data['observer']='';
        foreach ($obs as $row) {
        $data['observer'].='<tr><th>Nama</th><th>Biaya</th></tr>';
        $data['observer'].='<tr><td>'.$this->mdl_observer->get_by_id($row['id_observer'])->row()->nama.'</td><td>'.$row['biaya'].'</td></tr>';
        }
        }else{
        $data['observer']='Tidak Ada Observer';
        }

        if (!empty($data['detail']['hasil_evaluasi'])){
          $hasil_evaluasi=  explode('#', $data['detail']['hasil_evaluasi']);
          $data['nilai_evaluasi']=$hasil_evaluasi[0];
          $data['download_evaluasi']=  anchor('./assets/uploads/evaluasi/'.$hasil_evaluasi[1], $hasil_evaluasi[1],array('class'=>'label label-info','target'=>'_blank'));
      }else{
          $data['nilai_evaluasi']='';
          $data['download_evaluasi']='';
      }
            $data['status']=  $this->cek_result($id);

$jml_hadir=  $this->mdl_peserta->cek_kehadiran($id,1);
$data['or']=($jml_hadir/10)*100;

if ($this->mdl_fgt_pelatihan->get_biaya_provider($id)->num_rows()>0){
$provider=  $this->mdl_fgt_pelatihan->get_biaya_provider($id)->row_array();
$harga_penawaran=($provider['harga_penawaran']+$provider['harga_penawaran2']+$provider['harga_penawaran3']);
$harga_negosiasi=($provider['harga_negosiasi']+$provider['harga_negosiasi2']+$provider['harga_negosiasi3']);

if ($harga_penawaran==0){
    $harga_penawaran=1;
}

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
            $data['jml_peserta']=  anchor('peserta/view/'.$id, $this->mdl_peserta->count_all($id).' Orang');
            $data['jml_konfirmasi']=$this->mdl_peserta->count_all_konfirmasi($id);
            $data['jml_hadir']=$this->mdl_peserta->count_all_hadir($id);

        $this->template->display('fgt_pelatihan/detail',$data);
    }

        function detail_canceled($id) {
        $data['title']='Detail Pelatihan';
        $data['detail']=  $this->mdl_fgt_pelatihan->get_by_id_canceled($id)->row_array();
        $data['judul']=  $this->mdl_pelatihan->get_by_id($data['detail']['id_pelatihan'])->row()->judul;
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
        $data['memo_pembatalan_training']=  $this->cek_output($data['detail']['memo_pembatalan_training']);
        $data['fax_pembatalan_training']=  $this->cek_output($data['detail']['fax_pembatalan_training']);
        $data['memo_pembatalan_mengajar']=  $this->cek_output($data['detail']['memo_pembatalan_mengajar']);
        $data['fax_pembatalan_mengajar']=  $this->cek_output($data['detail']['fax_pembatalan_mengajar']);
        $data['surat_pembatalan_kerja']=  $this->cek_output($data['detail']['surat_pembatalan_kerja']);
        $data['invoice_diterima']=  $this->cek_output($data['detail']['invoice_diterima']);
        $data['invoice_dikirim']=  $this->cek_output($data['detail']['invoice_dikirim']);


        $data['jml_peserta']=$this->mdl_peserta->count_all($id);
            $data['jml_konfirmasi']=$this->mdl_peserta->count_all_konfirmasi($id);
            $data['jml_hadir']=$this->mdl_peserta->count_all_hadir($id);
        if ($this->mdl_fgt_pelatihan->get_biaya_pengajar($id)->num_rows()>0){
        $peng=  $this->mdl_fgt_pelatihan->get_biaya_pengajar($id)->result_array();
        $data['pengajar']='';
        foreach ($peng as $row) {
        $data['pengajar'].='<tr><th>Nama</th><th>Jml Sesi</th><th>Honor Per Sesi</th></tr>';
        $data['pengajar'].='<tr><td>'.$this->mdl_trainer->get_by_id($row['id_pengajar'])->row()->name.'</td><td>'.$row['jml_sesi'].'</td><td>'.$row['honor_sesi'].'</td></tr>';
        }
        }else{
        $data['pengajar']='Tidak Ada Pengajar';
        }

        if ($this->mdl_fgt_pelatihan->get_biaya_provider($id)->num_rows()>0){
        $prov=  $this->mdl_fgt_pelatihan->get_biaya_provider($id)->result_array();
        $data['provider']='';
        foreach ($prov as $row) {
        $data['provider'].=$this->mdl_provider->get_by_id($row['id_provider'])->row()->name;
        $data['provider'].='<table border="1"><tr><th>Ket</th><th>Harga Penawaran</th><th>Harga Negosiasi</th><th>Jumlah Peserta</th><th>Harga Tambahan Peserta</th></tr>';
        $data['provider'].='<tr><td>'.$row['ket'].'</td><td>'.$row['harga_penawaran'].'</td><td>'.$row['harga_negosiasi'].'</td><td>'.$row['jml_peserta'].'</td><td>'.$row['harga_tambahan_peserta'].'</td></tr>';
        $data['provider'].='<tr><td>'.$row['ket2'].'</td><td>'.$row['harga_penawaran2'].'</td><td>'.$row['harga_negosiasi2'].'</td><td>'.$row['jml_peserta2'].'</td><td>'.$row['harga_tambahan_peserta2'].'</td></tr>';
        $data['provider'].='<tr><td>'.$row['ket3'].'</td><td>'.$row['harga_penawaran3'].'</td><td>'.$row['harga_negosiasi3'].'</td><td>'.$row['jml_peserta3'].'</td><td>'.$row['harga_tambahan_peserta3'].'</td></tr>';
        $data['provider'].='<tr><td></td><td>'.number_format( ($row['harga_penawaran']+$row['harga_penawaran2']+$row['harga_penawaran3']), 0 , '' , '.' ).'</td><td>'.  number_format(($row['harga_negosiasi']+$row['harga_negosiasi2']+$row['harga_negosiasi3']), 0, '','.').'</td><td></td><td>'.  number_format(($row['harga_tambahan_peserta']+$row['harga_tambahan_peserta2']+$row['harga_tambahan_peserta3']), 0, '', '.').'</td></tr>';
        $data['provider'].='</table>';

        }
        }else{
        $data['provider']='Tidak Ada Provider';
        }

        if ($this->mdl_fgt_pelatihan->get_biaya_observer($id)->num_rows()>0){
        $obs=  $this->mdl_fgt_pelatihan->get_biaya_observer($id)->result_array();
        $data['observer']='';
        foreach ($obs as $row) {
        $data['observer'].='<tr><th>Nama</th><th>Biaya</th></tr>';
        $data['observer'].='<tr><td>'.$this->mdl_observer->get_by_id($row['id_observer'])->row()->nama.'</td><td>'.$row['biaya'].'</td></tr>';
        }
        }else{
        $data['observer']='Tidak Ada Observer';
        }

        $this->template->display('fgt_pelatihan/detail_canceled',$data);
    }

    function add_sarfas($id) {
        $data['title']='Kebutuhan Sarfas';
        $this->__set_rules_sarfas();

        if ($this->form_validation->run()==FALSE){
        $data['sarfas']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        $data['judul']=  $this->mdl_pelatihan->get_by_id($data['sarfas']['kd_pelatihan'])->row()->judul;
        $data['jml_peserta']=$this->mdl_peserta->count_all($data['sarfas']['id']);
        $data['action']='fgt_pelatihan/add_sarfas/'.$id;

        $this->template->display('fgt_pelatihan/add_sarfas',$data);
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
             'id_trans_pelatihan'=>$id,
             'kd_tiket'=>$this->mdl_fgt_pelatihan->get_by_id($id)->row()->kd_tiket,
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


         $this->mdl_fgt_pelatihan->add_sarfas($sarfas);
         redirect('fgt_pelatihan/view_sarfas/'.$id);
        }
    }

       function view_sarfas($id) {
        $data['title']='Kebutuhan Sarfas';
        $data['sarfas']=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        $data['detail']=  $this->mdl_fgt_pelatihan->get_sarfas_by_pelatihan($id)->row_array();
        $data['judul']=  $this->mdl_pelatihan->get_by_id($data['sarfas']['kd_pelatihan'])->row()->judul;
        $data['jml_peserta']=$this->mdl_peserta->count_all($data['sarfas']['id']);
        $data['kirim_email']=  anchor('fgt_pelatihan/send_mail_ls/'.$id, '<i class="icon-envelope"></i>&nbsp;Kirim Email', array('class'=>'btn btn-warning'));

        $this->template->display('fgt_pelatihan/view_sarfas',$data);

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
        $this->form_validation->set_rules('id_trans_pelatihan','ID Trans Pelatihan','required|trim');
    }

    function __set_rules_edit_action() {
        $this->form_validation->set_rules('id_trans_pelatihan','ID Trans Pelatihan','required|trim');
    }

    function __set_rules_batal_action() {
        $this->form_validation->set_rules('id_trans_pelatihan','ID Trans Pelatihan','required|trim');
    }

    function cek_plan($id) {
        $trainer=  $this->mdl_fgt_pelatihan->cek_biaya_pengajar($id);
        $provider=  $this->mdl_fgt_pelatihan->cek_biaya_provider($id);
        $peserta=  $this->mdl_fgt_pelatihan->cek_peserta($id);
        $plan=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        if (empty($plan['pic'])||empty($plan['kd_pelatihan'])||empty($plan['reference_hrbp'])||empty($plan['tgl_mulai'])||empty($plan['tgl_selesai'])||empty($plan['kuota_kelas'])||$peserta<=0||$provider<=0) {
        $status= anchor('fgt_pelatihan/edit_plan/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));
        $this->mdl_fgt_pelatihan->update_plan_status($id,0);
        }else{
            if ($this->mdl_fgt_pelatihan->get_biaya_provider($id)->row()->id_provider==661 && $trainer<=0){
        $status= anchor('fgt_pelatihan/edit_plan/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));
        $this->mdl_fgt_pelatihan->update_plan_status($id,0);
            }else{
        $status= anchor('fgt_pelatihan/edit_plan/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap'));
        $this->mdl_fgt_pelatihan->update_plan_status($id,1);
            }

        }
        return $status;
    }

        function cek_do($id) {
        $observer=  $this->mdl_fgt_pelatihan->cek_biaya_observer($id);
        $plan=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
if ($this->mdl_fgt_pelatihan->cek_biaya_provider($id)<=0){
$provider=0;
}else{
$provider=$this->mdl_fgt_pelatihan->get_biaya_provider($id)->row()->id_provider;
}
        if (empty($plan['memo_panggilan_peserta']) && empty($plan['fax_panggilan_peserta']) && empty($plan['spk']) && empty($plan['input_tem']) && $observer<=0) {
        $status= anchor('fgt_pelatihan/edit_do/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-danger','rel'=>'tooltip','title'=>'Belum Di Isi'));
        }else{
            switch ($provider) {
                case 661:
   if (empty($plan['memo_bantuan_mengajar'])||empty($plan['fax_bantuan_mengajar'])||empty($plan['surat_bantuan_mengajar'])||empty($plan['memo_panggilan_peserta'])||empty($plan['fax_panggilan_peserta'])||empty($plan['spk']) || empty($plan['input_tem'])) {
        $status= anchor('fgt_pelatihan/edit_do/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));
        $this->mdl_fgt_pelatihan->update_do_status($id,0);
        }else{
        $status=  anchor('fgt_pelatihan/edit_do/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap'));
        $this->mdl_fgt_pelatihan->update_do_status($id,1);

        }
         break;

         default:
    if (empty($plan['memo_panggilan_peserta'])||empty($plan['fax_panggilan_peserta']) || empty($plan['input_tem'])) {
        $status= anchor('fgt_pelatihan/edit_do/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));
        $this->mdl_fgt_pelatihan->update_do_status($id,0);
        }else{
        $status=  anchor('fgt_pelatihan/edit_do/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap'));
        $this->mdl_fgt_pelatihan->update_do_status($id,1);

        }

                    break;
            }
        }
     return $status;
    }

    function cek_check($id) {
        $check=  $this->mdl_peserta->cek_konfirmasi($id,1);
        if ($check>=20){
            $rekomend=  anchor('peserta/view/'.$id, '<i class="icon icon-bell">', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Konfirmasi Peserta Lebih dari 20 Orang'));
        }elseif ($check>=10) {
            $rekomend=  anchor('peserta/view/'.$id, '<i class="icon icon-bell">', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Konfirmasi Peserta Lebih dari 10 Orang'));
        }elseif ($check<10) {
            $rekomend=  anchor('peserta/view/'.$id, '<i class="icon icon-bell">', array('class'=>'btn btn-danger','rel'=>'tooltip','title'=>'Konfirmasi Peserta Kurang dari 10 Orang'));
        }
        return $rekomend;
    }

        function cek_action($id) {
        $provider=  $this->mdl_fgt_pelatihan->cek_biaya_provider($id);
        $plan=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        if((empty($plan['bap_pelatihan']) && empty($plan['cetak_sertifikat'])&& empty($plan['invoice_diterima']) && empty($plan['invoice_dikirim']) && empty($plan['memo_pembayaran_honor'])) || $provider<=0){
       $status= anchor('fgt_pelatihan/edit_action/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-danger','rel'=>'tooltip','title'=>'Belum Di Isi'));
        }else
        {
            switch ($this->mdl_fgt_pelatihan->get_biaya_provider($id)->row()->id_provider) {
                case 661:
if (empty($plan['bap_pelatihan'])||empty($plan['cetak_sertifikat'])||empty($plan['memo_pembayaran_honor'])) {
        $status= anchor('fgt_pelatihan/edit_action/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));
        $this->mdl_fgt_pelatihan->update_action_status($id,0);
        }else{
        $status=  anchor('fgt_pelatihan/edit_action/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap',));
        $this->mdl_fgt_pelatihan->update_action_status($id,1);
        }
            break;

                default:
if (empty($plan['bap_pelatihan'])||empty($plan['cetak_sertifikat'])||empty($plan['invoice_diterima'])||empty($plan['invoice_dikirim'])) {
        $status= anchor('fgt_pelatihan/edit_action/'.$id, '<i class="icon icon-remove-circle icon-white"></i>', array('class'=>'btn btn-warning','rel'=>'tooltip','title'=>'Belum Lengkap'));
        $this->mdl_fgt_pelatihan->update_action_status($id,0);
        }else{
        $status=  anchor('fgt_pelatihan/edit_action/'.$id, '<i class="icon icon-check icon-white"></i>', array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Lengkap',));
        $this->mdl_fgt_pelatihan->update_action_status($id,1);
        }
                    break;
            }
        }
        return $status;
    }

  function cek_result($id) {
    $plan=  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
    if ($plan['plan_status']==1 && $plan['do_status']==1 && $plan['action_status']==1){
     $status='<span class="label label-success">Lengkap</span>';
    }else{
     $status='<span class="label label-warning">Belum Lengkap</span>';
    }
        return $status;
    }

    function _set_rules(){
	$this->form_validation->set_rules('subject','Judul','required|trim');

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
        $query = $this->mdl_fgt_pelatihan->lookup_cs($keyword); //Search DB
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
