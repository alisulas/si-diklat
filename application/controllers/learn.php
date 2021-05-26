<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class learn extends CI_Controller{
    //put your code here
    private $limit=10;

    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_learn');
        $this->load->library('form_validation');
        $this->load->library('session');

    }

    function index($offset=0) {
       $this->session->set_userdata('page',$offset);
        $this->get_index($offset);
    }

    protected function get_index($offset) {
        $data['title']='Data Tugas Belajar';
        $this->load->library('pagination');
        if(empty($offset)){$offset=0;}

        $al=  $this->input->post('alert');
        $pekerja=  $this->input->post('pekerja');
        if ($al==1) {
            $alert=$pekerja;
        }  else {
        $alert=$al;
        }
        $name= $this->input->post('name');



        /* Pagination */
       $config['base_url']=site_url('learn/index/');
	$config['total_rows']=$this->mdl_learn->count_all($alert,$name);
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();
	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    array('data'=>'No','rowspan'=>2),
		    array('data'=>'Nama','rowspan'=>2),
		    array('data'=>'Nopek','rospan'=>2),
		    array('data'=>'Institusi Pendidikan','rowspan'=>2),
		    array('data'=>'Program Study','rowspan'=>2),
		    array('data'=>'GPA','rowspan'=>2),
		    array('data'=>'Perkiraan GPA (1-4)','rowspan'=>2),
		    array('data'=>'Direktorat','rowspan'=>2),
		    array('data'=>'Alert','width'=>'155'),
                array('data'=>'Masa Study','colspan'=>2),
                array('data'=>'Action','colspan'=>3,'rowspan'=>2)
		);

        $this->table->add_row(
                array('data'=>'','colspan'=>9),
                'Start Date',
                'End Date',
                'Status',
                array('data'=>'','colspan'=>3)
		);


        $data['date_add']=$this->mdl_learn->get_index($this->limit,$offset,$alert,$name)->result_array();
	$q=$this->mdl_learn->get_index($this->limit,$offset,$alert,$name)->result_array();
	$i=0+$offset;
        $data['addpayment']='';

        $data['listpayment']='';

	foreach ($q as $row)
	{
        $now_date=date('Y-m-d');
            $masa_study=  strtotime($row['end_date'])-strtotime($row['start_date']);
            $jml_masa_study= intval($masa_study/86400);

            $skr_masa_study=  strtotime($now_date)-strtotime($row['start_date']);
            $jml_skr_masa_study= intval($skr_masa_study/86400);
            if($jml_masa_study==0 || $jml_skr_masa_study==0){
                $status_masa_study='';
            }elseif ($jml_skr_masa_study>$jml_masa_study) {
                $status_masa_study='<span class="label label-info">Selesai</span>';
            }elseif (($jml_masa_study-$jml_skr_masa_study)<31) {
              $status_masa_study='<span class="label label-important">Hampir Selesai</span>';
            }elseif ($jml_skr_masa_study<=$jml_masa_study) {
                    $status_masa_study='<span class="label label-warning">Proses</span>';
                }

                if ($this->mdl_learn->get_payment_count($row['id'])<1) {
               $btn_expired='<button class="btn btn">&nbsp;Belum Lengkap&nbsp;</button>';
              $lbl_payment='';
              $this->mdl_learn->update_alert($row['id'],0);
                }elseif($this->mdl_learn->get_near_date($row['id'])->num_rows()<1){
              $btn_expired='<button class="btn btn-info">&nbsp;&nbsp;Lunas&nbsp;&nbsp;</button>';
              $lbl_payment='<span class="label label-info">Lunas</span>';
              $ex=0;
              $this->mdl_learn->update_alert($row['id'],$ex);

          }else{
            $expired_date=  $this->mdl_learn->get_near_date($row['id'])->row()->payment_date;
            $payment=  $this->mdl_learn->get_near_date($row['id'])->row()->type;
            $lbl_payment='<span class="label label-info">'.$payment.'</span>';

            $conv_expired=  strtotime($expired_date)-strtotime($now_date);
            $ex_pired=  $conv_expired/(60*60*24);
            $expired=$ex_pired;

            $this->mdl_learn->update_alert($row['id'],$expired);

               if($expired>60)
	    {
                $text='Aman';
		$btn_expired=  anchor('learn/sendmail/'.$row['id'].'/'.$payment.'/'.$text, '&nbsp;&nbsp;&nbsp;Aman&nbsp;&nbsp;', array('class'=>'btn btn-primary'));
	    }elseif($expired<=60 && $expired>=31) {
	        $text='Awas';
		$btn_expired=  anchor('learn/sendmail/'.$row['id'].'/'.$payment.'/'.$text, '&nbsp;&nbsp;&nbsp;Awas&nbsp;&nbsp;', array('class'=>'btn btn-success'));
            }
            elseif($expired>0 && $expired<31) {
	        $text='Waspada';
		$btn_expired=  anchor('learn/sendmail/'.$row['id'].'/'.$payment.'/'.$text, 'Waspada', array('class'=>'btn btn-warning'));
	    }else{
                $text='Expired';
		$btn_expired=  anchor('learn/sendmail/'.$row['id'].'/'.$payment.'/'.$text, '&nbsp;Expired&nbsp;', array('class'=>'btn btn-danger'));
            }
          }

          $edit=  anchor('learn/edit/'.$row['id'],'<span class="label label-success">Update</span>',array('rel'=>'tooltip','title'=>'Update'));
            $add=  anchor('#addpayment'.$row['id'],'<span class="label label-success">Tambah</span>',array('rel'=>'tooltip','title'=>'Tambah Pembayaran','data-toggle'=>'modal'));
            $delete=  anchor('learn/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));



            $data['addpayment'].=$this->editor->modal_payment($row['id']);

            $name= anchor('#listpayment'.$row['id'],$row['name'],array('rel'=>'tooltip','title'=>'Lihat Pembayaran','data-toggle'=>'modal'));
           $data['listpayment'].=$this->editor->modal_list_payment($row['id']);
           $this->table->add_row(
		    ++$i,
		    $name,
		    $row['nopek'],
		    $row['institutions'],
		    $row['program_study'],
		    $row['gpa'],
		    $row['perkiraan_gpa'],
		    $row['directorate'],
		    $btn_expired.'&nbsp;'.$lbl_payment,
                    $this->editor->date_correct($row['start_date']),
                    $this->editor->date_correct($row['end_date']),
                    $status_masa_study,
                    array('data'=>$edit,'width'=>10),
                    array('data'=>$add,'width'=>10),
                    array('data'=>$delete,'width'=>10)
	    );

	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $this->template->display('learn/index',$data);
    }

    function add() {
        $data['title']='Tambah Data Peserta';
        $data['stat']='0';
        $data['link_back']=  site_url('learn/index');
        $data['action']='learn/add';
        $this->_set_rules();
        if ($this->form_validation->run()==FALSE){
           $data['learn']['name']='';
           $data['learn']['nopek']='';
           $data['learn']['function']='';
           $data['learn']['institutions']='';
           $data['learn']['program_study']='';
           $data['learn']['gpa']='';
           $data['learn']['perkiraan_gpa']='';
           $data['learn']['directorate']='';
           $data['learn']['payment_date']='';
           $data['learn']['status']='';
           $data['learn']['email']='';
           $data['learn']['start_date']='';
           $data['learn']['end_date']='';

           $this->template->display('learn/form',$data);
        }else{
            $var=array(
                'name'=>  $this->input->post('name'),
                'nopek'=>  $this->input->post('nopek'),
                'function'=>  $this->input->post('function'),
                'institutions'=>  $this->input->post('institutions'),
                'program_study'=>  $this->input->post('program_study'),
                'gpa'=>  $this->input->post('gpa'),
                'perkiraan_gpa'=>  $this->input->post('perkiraan_gpa'),
                'directorate'=>  $this->input->post('directorate'),
                'email'=>  $this->input->post('email'),
                'status'=>  $this->input->post('status'),
                'start_date'=>  $this->input->post('start_date'),
                'end_date'=>  $this->input->post('end_date'),
                'insert_date'=>  date('Y-m-d G:i:s'),
                'update_date'=>  date('Y-m-d G:i:s')
            );
            $id=  $this->mdl_learn->add($var);
            $this->validation->no = $id;
            $this->session->set_flashdata('msg', $this->editor->alert_ok('Data Berhasil Ditambahkan'));
            redirect('learn/index');
        }
    }

    function index_tb($offset=0) {
        $data['title']='Data Tugas Belajar';
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset=0;
        }

        $config['base_url']=  site_url('index_tb/');
        $config['total_rows']=$this->mdl_learn->count_tb();
        $config['per_page']=  $this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=  $this->pagination->create_links();

        /* list table */

        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
        array('data'=>'No','width'=>5),
		    array('data'=>'Nopek','width'=>30),
		    array('data'=>'Nama','width'=>100),
        array('data'=>'Jabatan','width'=>300),
        array('data'=>'Direktorat / AP','width'=>200),
		    'Cost Center',
		    'Universitas',
		    'Program Studi',
		    'Status Keberangkatan',
		    'Start Date',
		    'End Date',
		    'Keterangan',
		    array('data'=>'Action','width'=>50)
                );

$tb=$this->mdl_learn->get_tb($this->limit,$offset)->result_array();
$i=0+$offset;

foreach ($tb as $row) {

    $this->table->add_row(
            ++$i,
            $row['nopek'],
            $row['nama'],
            $row['jabatan'],
            $row['direktorat'],
            $row['cost_center'],
            $row['universitas'],
            $row['program_studi'],
            $row['status_keberangkatan'],
            $row['start_date'],
            $row['end_date'],
            $row['ket'],
            'delete'
            );

}
       $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	    $data['content']=$this->table->generate();
       $this->template->display('learn/index_tb',$data);
    }

    function add_tb() {

        $data['action']='learn/add_tb_post';
        $this->template->display('learn/add_tb',$data);
    }

    function add_tb_post() {
        $var=array(
            'nopek'=>  $this->input->post('nopek'),
            'nama'=>  $this->input->post('nama'),
            'jabatan'=>  $this->input->post('jabatan'),
            'direktorat'=>  $this->input->post('direktorat'),
            'cost_center'=>  $this->input->post('cost_center'),
            'universitas'=>  $this->input->post('universitas'),
            'program_studi'=>  $this->input->post('program_studi'),
            'status_keberangkatan'=>  $this->input->post('status_keberangkatan'),
            'start_date'=>  $this->input->post('start_date'),
            'end_date'=>  $this->input->post('end_date'),
            'ket'=>  $this->input->post('ket'),
            'insert_date'=>  date('Y-m-d G:i:s'),
            'update_date'=>  date('Y-m-d G:i:s')
        );

        $this->mdl_learn->add_tb($var);
        redirect('learn/index_tb');
    }

    function update_payment($id) {
        $var=array(
            'status'=>'1'
        );
        $this->mdl_learn->update_payment($id,$var);
        redirect('learn/index');
    }

    function add_payment($id) {

            $var=array(
                'plc_learn_id'=>$id,
                'type'=>  $this->input->post('type'),
                'payment_date'=>  $this->input->post('payment_date'),
                'cost'=>  $this->input->post('currency').$this->input->post('cost')
            );
            $this->mdl_learn->add_payment($var);
            redirect('learn/index/'.$this->session->userdata('page'));
    }

    function edit($id) {
    $data['title']='Update Data Tugas Belajar';
	$data['link_back']=site_url('learn/index');
        $data['action']='learn/edit/'.$id;
	$this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $data['learn']=$this->mdl_learn->get_by_id($id)->row_array();
	    $data['stat']=$this->mdl_learn->get_by_id($id)->row()->status;

	} else {
	    $learn=array(
		'name'=>$this->input->post('name'),
		'nopek'=>$this->input->post('nopek'),
		'function'=>$this->input->post('function'),
		'institutions'=>$this->input->post('institutions'),
		'program_study'=>$this->input->post('program_study'),
		'gpa'=>$this->input->post('gpa'),
		'perkiraan_gpa'=>$this->input->post('perkiraan_gpa'),
		'directorate'=>$this->input->post('directorate'),
		'email'=>$this->input->post('email'),
		'status'=>$this->input->post('status'),
		'start_date'=>$this->input->post('start_date'),
		'end_date'=>$this->input->post('end_date'),
                'update_date'=>  date('Y-m-d G:i:s')
	    );
	    $this->mdl_learn->update($id,$learn);
	    $this->session->set_flashdata('msg',$this->editor->alert_ok('Tugas Belajar berhasil diperbarui'));
	    $data['learn']=$this->mdl_learn->get_by_id($id)->row_array();
            redirect('learn/index/'.$this->session->userdata('page'));
	}
        $this->template->display('learn/form',$data);
    }

    function sendmail($id,$judul,$status) {
        if (empty($id)||empty($judul)||empty($status)){
            redirect('learn/index/'.$this->session->userdata('page'));
        }
       // $data['title']='Edit Peserta Sertifikasi';
        $update_mail=array(
            'send_mail'=>date('Y-m-d G:i:s')
        );
        $this->mdl_learn->update($id,$update_mail);

        /*

        $this->load->library('email');

$this->email->from('your@example.com', 'Your Name');
$this->email->to('someone@example.com');
$this->email->cc('another@another-example.com');
$this->email->bcc('them@their-example.com');

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

$this->email->send();

echo $this->email->print_debugger();
         */


        $to=$this->mdl_learn->get_by_id($id)->row()->email;
        $subject=$judul.' ('.$status.')';
        $body=$judul.' Anda Dalam Status '.$status;

       header('Location: mailto:'.$to.'?Subject='.$subject.'&body='.$body.'');
        $this->index();

       // $data['content']='Membuka Email';
       // $this->template->display('certificate/index',$data);

    }

    function _set_rules() {
        $this->form_validation->set_rules('name','Nama Peserta','required|trim');
    }
    function openmail() {
        header("Location: mailto:name@example.com");
    }

     function delete($id)
    {
        $this->mdl_learn->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success">Data '.$id.' berhasil dihapus</div>');
        redirect('learn/index/'.$this->session->userdata('page'));
    }

    function delete_payment($id) {
        $this->mdl_learn->delete_payment($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success">Data '.$id.' berhasil dihapus</div>');
        redirect('learn/index/'.$this->session->userdata('page'));

    }

        function to_excel() {
    $month = $this->input->post('month');
    $year = $this->input->post('year');

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
$this->table->set_caption("Data Pembayaran Tugas Belajar");

        $this->table->set_heading(
                'Nama',
                'Nopek',
                'Fungsi',
                'Institusi',
                'Program Study',
                'GPA',
                'Perkiraan GPA',
                'Direktorat',
                'Email',
                'Jenis Pembayaran',
                'Tanggal',
                'Currency',
                'Jumlah',
                'Status'
                );
    $q=$this->mdl_learn->get_exel($month,$year)->result_array();

    	foreach ($q as $row)
	{

        $name=  $this->download_excel($row['plc_learn_id'], 'name');
        $nopek = $this->download_excel($row['plc_learn_id'], 'nopek');
        $fungsi = $this->download_excel($row['plc_learn_id'], 'function');
        $institutions = $this->download_excel($row['plc_learn_id'], 'institutions');
        $program_study = $this->download_excel($row['plc_learn_id'], 'program_study');
        $gpa = $this->download_excel($row['plc_learn_id'], 'gpa');
        $perkiraan_gpa = $this->download_excel($row['plc_learn_id'], 'perkiraan_gpa');
        $directorate = $this->download_excel($row['plc_learn_id'], 'directorate');
        $email = $this->download_excel($row['plc_learn_id'], 'email');

        $cost= explode(' ', $row['cost']);
            setlocale(LC_MONETARY, 'en_US.UTF-8');

        if ($row['status']==1){
            $status='Lunas';
        }else{
            $status='Belum Bayar';
        }
            $this->table->add_row(
                    $name,
                    $nopek,
                    $fungsi,
                    $institutions,
                    $program_study,
                    $gpa,
                    $perkiraan_gpa,
                    $directorate,
                    $email,
                    $row['type'],
                    $this->editor->date_correct($row['payment_date']),
                    $cost[0],
                    $this->formatMoney($cost[1]),
                    $status
                    );

	}
 //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
	$data['content']=$this->table->generate();

  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan-pembayaran-peserta.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


echo $data['content'];

    }
        function to_excel_data_peserta() {

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
$this->table->set_caption("Data Peserta Tugas Belajar");

        $this->table->set_heading(
                'Nama',
                'Nopek',
                'Fungsi',
                'Institusi',
                'Program Study',
                'GPA',
                'Perkiraan GPA',
                'Direktorat',
                'Email',
                'Mulai Masa Study',
                'Selesai Masa Study'
                );
    $q=$this->mdl_learn->get_excel_data_peserta()->result_array();

    	foreach ($q as $row)
	{
            $this->table->add_row(
                    $row['name'],
                    $row['nopek'],
                    $row['function'],
                    $row['institutions'],
                    $row['program_study'],
                    $row['gpa'],
                    $row['perkiraan_gpa'],
                    $row['directorate'],
                    $row['email'],
                    $row['start_date'],
                    $row['end_date']
                    );

	}
 //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
	$data['content']=$this->table->generate();

  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan-data-peserta.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


echo $data['content'];

    }

            function to_excel_laporan_pembayaran() {

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
$this->table->set_caption("Data Peserta Tugas Belajar");

        $this->table->set_heading(
                'Nama',
                'Nopek',
                'Fungsi',
                'Institusi',
                'Program Study',
                'GPA',
                'Perkiraan GPA',
                'Direktorat',
                'Email',
                'Mulai Masa Study',
                'Selesai Masa Study',
                'Jumlah'
                );
    $q=$this->mdl_learn->get_excel_data_peserta()->result_array();

    	foreach ($q as $row)
	{
                if ($this->mdl_learn->get_pembayaran_by_id($row['id'])->num_rows()<1) {
                    $jumlah=0;
                }else{
            $pembayaran=  $this->mdl_learn->get_pembayaran_by_id($row['id'])->result_array();
            $jumlah='';
            foreach ($pembayaran as $baris) {
            $jml= explode(' ', $baris['cost']);
            setlocale(LC_MONETARY, 'en_US.UTF-8');
                $jumlah.=$jml[0].' '.$this->formatMoney($jml[1].'+');
            }
                }


            $this->table->add_row(
                    $row['name'],
                    $row['nopek'],
                    $row['function'],
                    $row['institutions'],
                    $row['program_study'],
                    $row['gpa'],
                    $row['perkiraan_gpa'],
                    $row['directorate'],
                    $row['email'],
                    $row['start_date'],
                    $row['end_date'],
                    $jumlah
                    );

	}
 //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
	$data['content']=$this->table->generate();

  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan-data-peserta.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


echo $data['content'];

    }


    function download_excel($id,$col) {
if (!empty($this->mdl_learn->get_by_id($id)->row()->$col)) {
$name = $this->mdl_learn->get_by_id($id)->row()->$col;
}  else {
$name=' ';
}
return $name;
    }

      // Currency Function
    function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}


}

?>
