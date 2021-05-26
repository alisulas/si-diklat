<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of trainer
 *
 * @author Administrator
 */
class Trainer extends CI_Controller {
    private $limit=10;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_trainer');
        $this->load->model('mdl_provider');
        $this->load->model('mdl_course');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
        
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
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
	$data['title']='Daftar pengajar';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('trainer/index/');
	$config['total_rows']=$this->mdl_trainer->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    'No',
		    'Nopek',
		    'Nama Trainer',
		    'Telepon',
		    'Email',
		    'Kompetensi',
                    array('data'=>'Action','colspan'=>3)
		);
        $trainer_name = $this->input->post('trainer_name');
        $list=  $this->input->post('list');
	$q=$this->mdl_trainer->get_index($list,$trainer_name,$this->limit,$offset)->result_array();
               if (empty($trainer_name)){
            $trainer_name='';
        }
        $data['excel']=  anchor('trainer/to_excel/'.$trainer_name, '<i class="icon-list icon-white"></i>&nbsp;Download Excel',array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Download Excel'));
	$i=0+$offset;
	foreach ($q as $row)
	{
            $view=  anchor('trainer/detail/'.$row['id'],'<i class="icon-search"></i>',array('rel'=>'tooltip','title'=>'View'));
            if($this->session->userdata('user_id')==1){
            $edit=  anchor('trainer/edit/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('trainer/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));                
            }else{
                $edit='<i class="icon-wrench"></i>';
                $delete='<i class="icon-trash"></i>';
            }

	    $this->table->add_row(
		    ++$i,
		    $row['no'],
		    $row['name'],
		    $row['phone'],
		    $row['email'],
		    $row['core_competence'],
                    $this->ket($row['ket']),
                    array('data'=>$view,'width'=>10),
                    array('data'=>$edit,'width'=>10),
                    array('data'=>$delete,'width'=>10)
		    );
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $data['tambah']=  anchor('trainer/add', 'Tambah', array('class'=>'btn btn-primary'));
        $this->template->display('trainer/index',$data);
    }
    
        function ket($keterangan) {
        if ($keterangan=='Black List') {
 $ke='Black List';               
}  else {
$ke='White List';     
}
return $ke;
    }
    
        function to_excel($trainer_name=0) {
       
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
$this->table->set_caption("Daftar Provider");

$this->table->set_heading(
		    'No',
		    'Nama Trainer',
		    'Pendidikan Terakhir',
		    'Sertifikasi',
		    'Pengalaman Bekerja',
		    'Alamat',
		    'Telepon',
		    'Email'
		);
    $q=$this->mdl_trainer->get_excel($trainer_name)->result_array();
    $i=0;
    foreach ($q as $row) {
$this->table->add_row(
		    ++$i,
		    $row['name'],
		    $row['education'],
		    $row['certification'],
		    $row['job_experience'],
		    $row['address'],
		    $row['phone'],
		    $row['email']
		    );
    }
    $data['content']=$this->table->generate();
     
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=trainer.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


echo $data['content'];
    }

    /*
     * Create new training
     */
    function add()
    {
	$data['title']='Tambah Trainer Baru';
	$data['link_back']=site_url('trainer/index');
        $data['action']='trainer/add';

        $this->_set_rules();

        if($this->form_validation->run() === FALSE)
	{
	    $data['trainer']['no']='';
	    $data['trainer']['date']='';
	    $data['trainer']['name']='';
	    $data['trainer']['gender']='';
	    $data['trainer']['foto']='profile.gif';
	    $data['trainer']['education']='';
	    $data['trainer']['certification']='';
	    $data['trainer']['job_experience']=
	    $data['trainer']['address']='';
	    $data['trainer']['phone']='';
	    $data['trainer']['fax']='';
	    $data['trainer']['email']='';
	    $data['trainer']['website']='';
	    $data['trainer']['npwp_no']='';
	    $data['trainer']['birth_location']='';
	    $data['trainer']['birth_date']='';
	    $data['trainer']['profession']='';
	    $data['trainer']['association']='';
	    $data['trainer']['provider']='';
	    $data['trainer']['core_competence']=$this->mdl_course->tmpl(5)->row()->text;
	    $data['trainer']['doc_surat_pengantar']='';
	    $data['trainer']['doc_npwp']='';
	    $data['trainer']['doc_ktp']='';
	    $data['trainer']['doc_kta']='';
	    $data['trainer']['doc_ijazah']='';
	    $data['trainer']['doc_sertifikat']='';
	    $data['trainer']['doc_form_kursil']='';
	    $data['trainer']['doc_form_instruktur']='';

	    $cat_list=$this->mdl_provider->get_provider()->result();
	    $data['provider']='<option value="-">-</option>';
	    foreach ($cat_list as $list)
	    {
		$data['provider'].='<option value="'.$list->id.'">'.$list->name.'</option>';
	    }

	    $this->template->display('trainer/form_input',$data);
	} else {
            $this->upload->initialize(array(
                'upload_path' => './assets/uploads/trainer/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
 if(!$this->upload->do_upload('foto'))
            {
                $foto=$this->input->post('foto2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $foto=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_surat_pengantar'))
            {
                $doc_surat_pengantar=$this->input->post('doc_surat_pengantar2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_surat_pengantar=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_npwp'))
            {
                $doc_npwp=$this->input->post('doc_npwp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_npwp=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_ktp'))
            {
                $doc_ktp=$this->input->post('doc_ktp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_ktp=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_kta'))
            {
                $doc_kta=$this->input->post('doc_kta2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_kta=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_ijazah'))
            {
                $doc_ijazah=$this->input->post('doc_ijazah2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_ijazah=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_sertifikat'))
            {
                $doc_sertifikat=$this->input->post('doc_sertifikat2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_sertifikat=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_form_kursil'))
            {
                $doc_form_kursil=$this->input->post('doc_form_kursil2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_form_kursil=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_form_instruktur'))
            {
                $doc_form_instruktur=$this->input->post('doc_form_instruktur2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_form_instruktur=$unggah['file_name'];
            }
            
            
	    $trainer=array(
		'no'=>$this->input->post('no'),
		'date'=>$this->input->post('date'),
		'name'=>$this->input->post('name'),
		'gender'=>$this->input->post('gender'),
                'foto'=>$foto,
		'education'=>$this->input->post('education'),
		'certification'=>$this->input->post('certification'),
		'job_experience'=>$this->input->post('job_experience'),
		'address'=>$this->input->post('address'),
		'phone'=>$this->input->post('phone'),
		'fax'=>$this->input->post('fax'),
		'email'=>$this->input->post('email'),
		'website'=>$this->input->post('website'),
		'npwp_no'=>$this->input->post('npwp_no'),
		'birth_location'=>$this->input->post('birth_location'),
		'birth_date'=>$this->input->post('birth_date'),
		'profession'=>$this->input->post('profession'),
		'association'=>$this->input->post('association'),
		'provider'=>$this->input->post('provider'),
		'core_competence'=>$this->input->post('core_competence'),
                'ket'=>  $this->input->post('ket'),
		'doc_surat_pengantar'=>$doc_surat_pengantar,
		'doc_npwp'=>$doc_npwp,
		'doc_ktp'=>$doc_ktp,
		'doc_kta'=>$doc_kta,
		'doc_ijazah'=>$doc_ijazah,
		'doc_sertifikat'=>$doc_sertifikat,
		'doc_form_kursil'=>$doc_form_kursil,
		'doc_form_instruktur'=>$doc_form_instruktur,
                'insert_date'=>  date('Y-m-d G:i:s'),
                'update_date'=>  date('Y-m-d G:i:s')
	    );

	    $id=$this->mdl_trainer->add($trainer);
	    $this->validation->no = $id;
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Pelatihan baru berhasil ditambahkan</div>');
	    redirect('trainer/index');
	}
    }

   /*
     * Create new training
     */
    function edit($id)
    {
	$data['title']='Edit Trainer';
	$data['link_back']=site_url('trainer/index');
        $data['action']='trainer/edit/'.$id;

	$this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $data['trainer']=$this->mdl_trainer->get_by_id($id)->row_array();
	} else {
            $this->upload->initialize(array(
                'upload_path' => './assets/uploads/trainer/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));

            if(!$this->upload->do_upload('foto'))
            {
                $foto=$this->input->post('foto2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $foto=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_surat_pengantar'))
            {
                $doc_surat_pengantar=$this->input->post('doc_surat_pengantar2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_surat_pengantar=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_npwp'))
            {
                $doc_npwp=$this->input->post('doc_npwp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_npwp=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_ktp'))
            {
                $doc_ktp=$this->input->post('doc_ktp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_ktp=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_kta'))
            {
                $doc_kta=$this->input->post('doc_kta2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_kta=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_ijazah'))
            {
                $doc_ijazah=$this->input->post('doc_ijazah2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_ijazah=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_sertifikat'))
            {
                $doc_sertifikat=$this->input->post('doc_sertifikat2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_sertifikat=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_form_kursil'))
            {
                $doc_form_kursil=$this->input->post('doc_form_kursil2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_form_kursil=$unggah['file_name'];
            }
            
            
            if(!$this->upload->do_upload('doc_form_instruktur'))
            {
                $doc_form_instruktur=$this->input->post('doc_form_instruktur2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_form_instruktur=$unggah['file_name'];
            }
            
	    $trainer=array(
		'no'=>$this->input->post('no'),
		'date'=>$this->input->post('date'),
		'name'=>$this->input->post('name'),
		'gender'=>$this->input->post('gender'),
		'foto'=>$foto,
		'education'=>$this->input->post('education'),
		'certification'=>$this->input->post('certification'),
		'job_experience'=>$this->input->post('job_experience'),
		'address'=>$this->input->post('address'),
		'phone'=>$this->input->post('phone'),
		'fax'=>$this->input->post('fax'),
		'email'=>$this->input->post('email'),
		'website'=>$this->input->post('website'),
		'npwp_no'=>$this->input->post('npwp_no'),
		'birth_location'=>$this->input->post('birth_location'),
		'birth_date'=>$this->input->post('birth_date'),
		'profession'=>$this->input->post('profession'),
		'association'=>$this->input->post('association'),
		'provider'=>$this->input->post('provider'),
		'core_competence'=>$this->input->post('core_competence'),
                'ket'=>  $this->input->post('ket'),
		'doc_surat_pengantar'=>$doc_surat_pengantar,
		'doc_npwp'=>$doc_npwp,
		'doc_ktp'=>$doc_ktp,
		'doc_kta'=>$doc_kta,
		'doc_ijazah'=>$doc_ijazah,
		'doc_sertifikat'=>$doc_sertifikat,
		'doc_form_kursil'=>$doc_form_kursil,
		'doc_form_instruktur'=>$doc_form_instruktur,
                'update_date'=>  date('Y-m-d G:i:s')
	    );
	    $this->mdl_trainer->update($id,$trainer);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Data trainer berhasil diperbarui</div>');
	    $data['trainer']=$this->mdl_trainer->get_by_id($id)->row_array();
            redirect('trainer/detail/'.$id);
	}
	$cat_list=$this->mdl_provider->get_provider()->result();
	$data['provider']='';
	foreach ($cat_list as $list)
	{
	    if($list->id == $data['trainer']['id'])
	    {
		$data['provider'].='<option value="'.$list->id.'" selected="selected">'.$list->name.'</option>';
	    } else {
		$data['provider'].='<option value="'.$list->id.'">'.$list->name.'</option>';
	    }
	}
        $this->template->display('trainer/form',$data);
    }

    // validation rules
    function _set_rules(){
	$this->form_validation->set_rules('no','No','required|trim');
	$this->form_validation->set_rules('name','Nama','required|trim');
	$this->form_validation->set_rules('date','Tanggal','required|trim');
    }

    function delete($id)
    {
        $this->mdl_trainer->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success"">trainer '.$id.' berhasil dihapus</div>');
        redirect('trainer');
    }
    
    function delete_observasi($id)
    {
        $this->mdl_trainer->delete_observasi($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success"">Data berhasil dihapus</div>');
        redirect('trainer/list_observasi');
    }

    function detail($id){
        $data['title']='Formulir CV Instruktur Pembelajaran Pertamina Learning Center ';
        $data['trainer']=$this->mdl_trainer->get_by_id($id)->row_array();
        
        if (empty($data['trainer']['provider']) || $data['trainer']['provider']=='-'){
            $data['provider']='<span class="label label-important">Belum di Masukan</span> '.  anchor('trainer/edit/'.$id, 'Edit', array('class'=>'btn btn-primary'));
        }else{
                $data['provider']=$this->mdl_provider->get_by_id($data['trainer']['provider'])->row()->name;
    
        }
                
        if ($this->session->userdata('user_id')==1){
                 $data['edit']=  anchor('trainer/edit/'.$data['trainer']['id'], '<i class="icon-wrench icon-white"></i> Edit Dokumen', array('class'=>'btn btn-success'));
   
        }  else {
        $data['edit']='';    
        }
        $this->template->display('trainer/detail',$data);
    }
    
    
    //upload excel
    function do_upload() {
        $this->load->library('upload');
        $config['upload_path'] = './assets/uploads/trainer/';
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

               // if ($data['cells'][$i][1] == '')
                //    break;

                $dataexcel[$i - 1]['no'] = rand(1, 1000000);
                $dataexcel[$i - 1]['name'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['gender'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['education'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['certification'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['job_experience'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['address'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['phone'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['fax'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['email'] = $data['cells'][$i][10];
                $dataexcel[$i - 1]['website'] = $data['cells'][$i][11];
                $dataexcel[$i - 1]['npwp_no'] = $data['cells'][$i][12];
                $dataexcel[$i - 1]['birth_location'] = $data['cells'][$i][13];
                $dataexcel[$i - 1]['birth_date'] = $data['cells'][$i][14];
                $dataexcel[$i - 1]['profession'] = $data['cells'][$i][15];
                $dataexcel[$i - 1]['association'] = $data['cells'][$i][16];
                $dataexcel[$i - 1]['core_competence'] = $data['cells'][$i][17];
                            
            }
            



            delete_files($upload_data['file_path']);
            $this->mdl_trainer->add_dataexcel($dataexcel);
        }
        redirect("trainer");
    }
    
    function add_observasi() {
    
	$data['title']='Tambah Observasi';
	$data['link_back']=site_url('trainer/index');
        $data['action']='trainer/add_observasi';

        $this->_set_rules_observasi();

        if($this->form_validation->run() === FALSE)
	{

	    $this->template->display('trainer/add_observasi',$data);
	} else { 
	    $observasi=array(
		'id_trainer'=>$this->input->post('trainer'),
		'id_course'=>$this->input->post('program'),
		'obs1'=>$this->input->post('obs1'),
		'cat1'=>$this->input->post('cat1'),
                'obs2'=>$this->input->post('obs2'),
		'cat2'=>$this->input->post('cat2'),
		'obs3'=>$this->input->post('obs3'),
		'cat3'=>$this->input->post('cat3'),
		'obs4'=>$this->input->post('obs4'),
		'cat4'=>$this->input->post('cat4'),
		'obs5'=>$this->input->post('obs5'),
		'cat5'=>$this->input->post('cat5'),
		'obs6'=>$this->input->post('obs6'),
		'cat6'=>$this->input->post('cat6'),
		'obs7'=>$this->input->post('obs7'),
		'cat7'=>$this->input->post('cat7'),
		'obs8'=>$this->input->post('obs8'),
		'cat8'=>$this->input->post('cat8'),
		'obs9'=>$this->input->post('obs9'),
		'cat9'=>$this->input->post('cat9'),
		'obs10'=>$this->input->post('obs10'),
		'cat10'=>$this->input->post('cat10'),
		'obs11'=>$this->input->post('obs11'),
		'cat11'=>$this->input->post('cat11'),
		'obs12'=>$this->input->post('obs12'),
		'cat12'=>$this->input->post('cat12'),
		'obs13'=>$this->input->post('obs13'),
		'cat13'=>$this->input->post('cat13'),
		'obs14'=>$this->input->post('obs14'),
		'cat14'=>$this->input->post('cat14'),
		'obs15'=>$this->input->post('obs15'),
		'cat15'=>$this->input->post('cat15'),
		'obs16'=>$this->input->post('obs16'),
		'cat16'=>$this->input->post('cat16'),
		'obs17'=>$this->input->post('obs17'),
		'cat17'=>$this->input->post('cat17'),
		'obs18'=>$this->input->post('obs18'),
		'cat18'=>$this->input->post('cat18'),
		'obs19'=>$this->input->post('obs19'),
		'cat19'=>$this->input->post('cat19'),
		'obs20'=>$this->input->post('obs20'),
		'cat20'=>$this->input->post('cat20'),
                'insert_date'=>  date('Y-m-d G:i:s')
	    );

	    $this->mdl_trainer->add_observasi($observasi);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Observasi baru berhasil ditambahkan</div>');
	    redirect('trainer/index');
	}    
    }
    
    function view_observasi($id) {
      $data['title']='Detail Observasi';
      $data['obv']=$this->mdl_trainer->get_observasi_by_id($id)->row_array();
      $data['trainer']=  $this->mdl_trainer->get_by_id($data['obv']['id_trainer'])->row()->name;
      $data['program']=  $this->mdl_course->get_by_id($data['obv']['id_course'])->row()->course_name;
      $this->template->display('trainer/view_observasi',$data);
    }
    
    function edit_observasi($id) {
      $data['title']='Edit Observasi';
      $data['action']='trainer/update_observasi/'.$id;
      $data['obv']=$this->mdl_trainer->get_observasi_by_id($id)->row_array();
      $data['trainer']=  $this->mdl_trainer->get_by_id($data['obv']['id_trainer'])->row()->name;
      $data['program']=  $this->mdl_course->get_by_id($data['obv']['id_course'])->row()->course_name;
                
      $this->template->display('trainer/edit_observasi',$data);
    }
    
        function _set_rules_observasi(){
	$this->form_validation->set_rules('obs1','Id Trainer','required|trim');
    }
    
    function update_observasi($id) {
    	    $observasi=array(
		'obs1'=>$this->input->post('obs1'),
		'cat1'=>$this->input->post('cat1'),
                'obs2'=>$this->input->post('obs2'),
		'cat2'=>$this->input->post('cat2'),
		'obs3'=>$this->input->post('obs3'),
		'cat3'=>$this->input->post('cat3'),
		'obs4'=>$this->input->post('obs4'),
		'cat4'=>$this->input->post('cat4'),
		'obs5'=>$this->input->post('obs5'),
		'cat5'=>$this->input->post('cat5'),
		'obs6'=>$this->input->post('obs6'),
		'cat6'=>$this->input->post('cat6'),
		'obs7'=>$this->input->post('obs7'),
		'cat7'=>$this->input->post('cat7'),
		'obs8'=>$this->input->post('obs8'),
		'cat8'=>$this->input->post('cat8'),
		'obs9'=>$this->input->post('obs9'),
		'cat9'=>$this->input->post('cat9'),
		'obs10'=>$this->input->post('obs10'),
		'cat10'=>$this->input->post('cat10'),
		'obs11'=>$this->input->post('obs11'),
		'cat11'=>$this->input->post('cat11'),
		'obs12'=>$this->input->post('obs12'),
		'cat12'=>$this->input->post('cat12'),
		'obs13'=>$this->input->post('obs13'),
		'cat13'=>$this->input->post('cat13'),
		'obs14'=>$this->input->post('obs14'),
		'cat14'=>$this->input->post('cat14'),
		'obs15'=>$this->input->post('obs15'),
		'cat15'=>$this->input->post('cat15'),
		'obs16'=>$this->input->post('obs16'),
		'cat16'=>$this->input->post('cat16'),
		'obs17'=>$this->input->post('obs17'),
		'cat17'=>$this->input->post('cat17'),
		'obs18'=>$this->input->post('obs18'),
		'cat18'=>$this->input->post('cat18'),
		'obs19'=>$this->input->post('obs19'),
		'cat19'=>$this->input->post('cat19'),
		'obs20'=>$this->input->post('obs20'),
		'cat20'=>$this->input->post('cat20'),
                'insert_date'=>  date('Y-m-d G:i:s')
	    );

	    $this->mdl_trainer->update_observasi($observasi,$id);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Observasi baru berhasil Di Edit</div>');
	    redirect('trainer/index');    
    }
    
    function list_observasi($offset=0) {
        
	$data['title']='Daftar Observasi';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('trainer/index/');
	$config['total_rows']=$this->mdl_trainer->observasi_count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    'No',
		    'Nama Pengajar',
		    'Sertifikasi',
		    'Pengalaman Bekerja',
		    'Telephone/HP',
                    array('data'=>'Action','colspan'=>3)
		);
        
	$q=$this->mdl_trainer->get_observasi($this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
            $view=  anchor('trainer/view_observasi/'.$row['id'],'<i class="icon-search"></i>',array('rel'=>'tooltip','title'=>'View'));
            if($this->session->userdata('user_id')==1){
            $edit=  anchor('trainer/edit_observasi/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('trainer/delete_observasi/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));                
            }else{
                $edit='<i class="icon-wrench"></i>';
                $delete='<i class="icon-trash"></i>';
            }

	    $this->table->add_row(
		    ++$i,
		    $this->mdl_trainer->get_by_id($row['id_trainer'])->row()->name,
		    $this->mdl_trainer->get_by_id($row['id_trainer'])->row()->certification,
		    $this->mdl_trainer->get_by_id($row['id_trainer'])->row()->job_experience,
		    $this->mdl_trainer->get_by_id($row['id_trainer'])->row()->phone,
                    array('data'=>$view,'width'=>10),
                    array('data'=>$edit,'width'=>10),
                    array('data'=>$delete,'width'=>10)
		    );
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $this->template->display('trainer/observasi',$data);
    }
    
    
     
}

/* End of file trainer.php */
/* Location: ./application/controllers/trainer.php */