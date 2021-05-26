<?php
/**
 * Description of course
 *
 * @author Administrator
 */
class Provider extends CI_Controller {
    private $limit=10;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_provider');
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
	$data['title']='Daftar Provider';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('provider/index/');
	$config['total_rows']=$this->mdl_provider->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading('No',
		    'No Provider',
		    'Nama',
		    'Telp',
		    'Email',
		    'Kompetensi',
		    'Keterangan',

                    array('data'=>'Action','rowspan'=>3)
		);
        $provider_name= $this->input->post('provider_name');
        $list= $this->input->post('list');
	$q=$this->mdl_provider->get_index($list,$provider_name,$this->limit,$offset)->result_array();
         if (empty($provider_name)){
            $provider_name='';
        }
        $data['excel']=  anchor('provider/to_excel/'.$provider_name, '<i class="icon-list icon-white"></i>&nbsp;Download Excel',array('class'=>'btn btn-success','rel'=>'tooltip','title'=>'Download Excel'));
	$i=0+$offset;
	foreach ($q as $row)
	{
             
            $edit=  anchor('provider/edit/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('provider/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));                
          
           	    $detail=  anchor('provider/detail/'.$row['id'],'<i class="icon-search"></i>',array('rel'=>'tooltip','title'=>'Lihat detail'));
            $this->table->add_row(
		    ++$i,
		    $row['no'],
		    $row['name'],
		    $row['phone'],
		    $row['email'],
		    $row['learning_competence'],
                    $this->ket($row['ket']),
                    array('data'=>$detail,'width'=>10),
                    array('data'=>$edit,'width'=>10),
                    array('data'=>$delete,'width'=>10)
		    );
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $data['tambah']=  anchor('provider/add', '<i class="icon-plus-sign icon-white"></i>&nbsp;Tambah', array('class'=>'btn btn-primary'));
        $this->template->display('provider/index',$data);
    }
    
    function ket($keterangan) {
        if ($keterangan=='Black List') {
 $ke='Black List';               
}  else {
$ke='White List';     
}
return $ke;
    }
    
    function to_excel($provider_name=0) {
       
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

	$this->table->set_heading('No',
		    'Name',
		    'Address',
		    'Phone',
		    'Fax',
		    'Email',
		    'Website'
		);
    $q=$this->mdl_provider->get_excel($provider_name)->result_array();
    $i=0;
    foreach ($q as $row) {
    $this->table->add_row(
		    ++$i,
		    $row['name'],
		    $row['address'],
		    $row['phone'],
		    $row['fax'],
		    $row['email'],
		    $row['website']
		    );    
    }
    $data['content']=$this->table->generate();
     
  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=provider.xls");  //File name extension was wrong
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
	$data['title']='Tambah Provider Baru';
	$data['link_back']=site_url('provider/index');
        $data['action']='provider/add';
        $data['jml']=$this->mdl_provider->count_all()+1;
	$this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $data['provider']['no']='';
	    $data['provider']['name']='';
	    $data['provider']['address']='';
	    $data['provider']['phone']='';
	    $data['provider']['fax']='';
	    $data['provider']['email']='';
	    $data['provider']['website']='';
            $data['provider']['npwp_no']='';
            $data['provider']['akte_no']='';
            $data['provider']['akte_date']='';
            $data['provider']['siup_no']='';
            $data['provider']['siup_date']='';
            $data['provider']['pkp_no']='';
            $data['provider']['pkp_date']='';
            $data['provider']['association']='';
            $data['provider']['learning_competence']='';
            $data['provider']['doc_surat']='';
            $data['provider']['doc_npwp']='';
            $data['provider']['doc_akte']='';
            $data['provider']['doc_siup']='';
            $data['provider']['doc_pkp']='';
            $data['provider']['doc_kursil']='';
            $data['provider']['doc_cp']='';
            $data['provider']['doc_cv']='';
	    $this->template->display('provider/form_input',$data);
	} else {
            
            $this->upload->initialize(array(
                'upload_path' => './assets/uploads/provider/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            
            if(!$this->upload->do_upload('doc_surat'))
            {
                $doc_surat=$this->input->post('doc_surat2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_surat=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_npwp'))
            {
                $doc_npwp=$this->input->post('doc_npwp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_npwp=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_akte'))
            {
                $doc_akte=$this->input->post('doc_akte2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_akte=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_siup'))
            {
                $doc_siup=$this->input->post('doc_siup2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_siup=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_pkp'))
            {
                $doc_pkp=$this->input->post('doc_pkp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_pkp=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_kursil'))
            {
                $doc_kursil=$this->input->post('doc_kursil2');
            } else {
                $masuk = $this->upload->data();
                $masuk['file_name'];
                $doc_kursil=$masuk['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_cp'))
            {
                $doc_cp=$this->input->post('doc_cp2');
            } else {
                $masuk = $this->upload->data();
                $masuk['file_name'];
                $doc_cp=$masuk['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_cv'))
            {
                $doc_cv=$this->input->post('doc_cv2');
            } else {
                $masuk = $this->upload->data();
                $masuk['file_name'];
                $doc_cv=$masuk['file_name'];
            }
            
	    $provider=array(
		'no'=>$this->input->post('no'),
		'name'=>$this->input->post('name'),
		'address'=>$this->input->post('address'),
		'phone'=>$this->input->post('phone'),
		'fax'=>$this->input->post('fax'),
		'email'=>$this->input->post('email'),
		'website'=>$this->input->post('website'),
                'npwp_no'=>$this->input->post('npwp_no'),
                'akte_no'=>$this->input->post('akte_no'),
                'akte_date'=>$this->input->post('akte_date'),
                'siup_no'=>$this->input->post('siup_no'),
                'siup_date'=>$this->input->post('siup_date'),
                'pkp_no'=>$this->input->post('pkp_date'),
                'association'=>$this->input->post('association'),
                'learning_competence'=>$this->input->post('learning_competence'),
                'ket'=>  $this->input->post('ket'),
                'catatan'=>  $this->input->post('catatan'),
                'doc_surat'=>$doc_surat,
                'doc_npwp'=>$doc_npwp,
                'doc_akte'=>$doc_akte,
                'doc_siup'=>$doc_siup,
                'doc_pkp'=>$doc_pkp,
                'doc_kursil'=>$doc_kursil,
                'doc_cp'=>$doc_cp,
                'doc_cv'=>$doc_cv,
                'insert_date'=>  date('Y-m-d G:i:s')
	    );
	    $id=$this->mdl_provider->add($provider);
	    $this->validation->no = $id;
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Provider baru berhasil ditambahkan</div>');
	    redirect('provider/index');
	}
    }

   /*
     * Create new training
     */
    function edit($id)
    {
	$data['title']='Edit Course';
	$data['link_back']=site_url('provider/index');
        $data['action']='provider/edit/'.$id;
	$this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $data['provider']=$this->mdl_provider->get_by_id($id)->row_array();
	} else {
                $this->upload->initialize(array(
                'upload_path' => './assets/uploads/provider/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            if(!$this->upload->do_upload('doc_surat'))
            {
                $doc_surat=$this->input->post('doc_surat2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_surat=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_npwp'))
            {
                $doc_npwp=$this->input->post('doc_npwp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_npwp=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_akte'))
            {
                $doc_akte=$this->input->post('doc_akte2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_akte=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_siup'))
            {
                $doc_siup=$this->input->post('doc_siup2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_siup=$unggah['file_name'];
            }
            if(!$this->upload->do_upload('doc_pkp'))
            {
                $doc_pkp=$this->input->post('doc_pkp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_pkp=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_kursil'))
            {
                $doc_kursil=$this->input->post('doc_kursil2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_kursil=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_cp'))
            {
                $doc_cp=$this->input->post('doc_cp2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_cp=$unggah['file_name'];
            }
            
            if(!$this->upload->do_upload('doc_cv'))
            {
                $doc_cv=$this->input->post('doc_cv2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $doc_cv=$unggah['file_name'];
            }

            $provider=array(
		'no'=>$this->input->post('no'),
		'name'=>$this->input->post('name'),
		'address'=>$this->input->post('address'),
		'phone'=>$this->input->post('phone'),
		'fax'=>$this->input->post('fax'),
		'email'=>$this->input->post('email'),
		'website'=>$this->input->post('website'),
                'npwp_no'=>$this->input->post('npwp_no'),
                'akte_no'=>$this->input->post('akte_no'),
                'akte_date'=>$this->input->post('akte_date'),
                'siup_no'=>$this->input->post('siup_no'),
                'siup_date'=>$this->input->post('siup_date'),
                'pkp_no'=>$this->input->post('pkp_no'),
                'pkp_date'=>$this->input->post('pkp_date'),
                'association'=>$this->input->post('association'),
                'learning_competence'=>$this->input->post('learning_competence'),
                'ket'=>  $this->input->post('ket'),
                'catatan'=>  $this->input->post('catatan'),
                'doc_surat'=>$doc_surat,
                'doc_npwp'=>$doc_npwp,
                'doc_akte'=>$doc_akte,
                'doc_siup'=>$doc_siup,
                'doc_pkp'=>$doc_pkp,
                'doc_kursil'=>$doc_kursil,
                'doc_cp'=>$doc_cp,
                'doc_cv'=>$doc_cv,
               'update_date'=>  date('Y-m-d G:i:s')
	    );
	    $this->mdl_provider->update($id,$provider);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Provider berhasil diperbarui</div>');
	    $data['provider']=$this->mdl_provider->get_by_id($id)->row_array();
            redirect('provider/detail/'.$id);
	}
        $this->template->display('provider/form',$data);
    }

    // validation rules
    function _set_rules(){
		$this->form_validation->set_rules('name','Nama Provider','required|trim');
    }

    function delete($id)
    {
        $this->mdl_provider->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success">Provider '.$id.' berhasil dihapus</div>');
        redirect('provider');
    }

    function detail($id){
     $data['title']='Formulir  Provider Pembelajaran Pertamina Learning Center';
	$data['provider']=$this->mdl_provider->get_by_id($id)->row_array();
if ($this->session->userdata('user_id')==1){
                 $data['edit']=  anchor('provider/edit/'.$data['provider']['id'], '<i class="icon-wrench icon-white"></i> Edit Dokumen', array('class'=>'btn btn-success'));
   
        }  else {
        $data['edit']='';    
        }
        $this->template->display('provider/detail',$data);
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

//                if ($data['cells'][$i][1] == '')
 //                   break;

                $dataexcel[$i - 1]['no'] = rand(1, 1000000);
                $dataexcel[$i - 1]['name'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['pic'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['address'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['phone'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['fax'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['email'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['website'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['npwp_no'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['akte_no'] = $data['cells'][$i][10];
                $dataexcel[$i - 1]['akte_date'] = $data['cells'][$i][11];
                $dataexcel[$i - 1]['siup_no'] = $data['cells'][$i][12];
                $dataexcel[$i - 1]['siup_date'] = $data['cells'][$i][13];
                $dataexcel[$i - 1]['pkp_no'] = $data['cells'][$i][14];
                $dataexcel[$i - 1]['pkp_date'] = $data['cells'][$i][15];
                $dataexcel[$i - 1]['association'] = $data['cells'][$i][16];
                $dataexcel[$i - 1]['learning_competence'] = $data['cells'][$i][17];
                $dataexcel[$i - 1]['insert_date'] = date('Y-m-d G:i:s');
                            
            }
            



            delete_files($upload_data['file_path']);
            $this->mdl_provider->add_dataexcel($dataexcel);
        }
        redirect("provider");
    }
    

}

/* End of file course.php */
/* Location: ./application/controllers/provider.php */
