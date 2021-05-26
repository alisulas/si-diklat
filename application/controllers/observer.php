<?php
/**
 * Description of course
 *
 * @author Administrator
 */
class Observer extends CI_Controller {
    private $limit=10;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_observer');
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
	$data['title']='Daftar Observer';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('observer/index/');
	$config['total_rows']=$this->mdl_observer->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
                    array('data'=>'No','width'=>10),
		    'Nama',
		    'Alamat',
		    'Telp',
		    'Fax',
		    'Email',
                    'Detail',
                    'Edit',
                    'Hapus'
		);
	$q=$this->mdl_observer->get_index()->result_array();
         if (empty($observer_name)){
            $observer_name='';
        }
        
	$i=0+$offset;
	foreach ($q as $row)
	{         
            $edit=  anchor('observer/edit/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('observer/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));                
            $detail=  anchor('observer/detail/'.$row['id'],'<i class="icon-search"></i>',array('rel'=>'tooltip','title'=>'Lihat detail'));
            $this->table->add_row(
		    ++$i,
		    $row['nama'],
		    $row['alamat'],
		    $row['telp'],
		    $row['fax'],
		    $row['email'],
                    array('data'=>$detail,'width'=>10),
                    array('data'=>$edit,'width'=>10),
                    array('data'=>$delete,'width'=>10)
		    );
	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
	$data['content']=$this->table->generate();
        $data['tambah']=  anchor('observer/add', '<i class="icon-plus-sign icon-white"></i>&nbsp;Tambah', array('class'=>'btn btn-primary'));
        $this->template->display('observer/index',$data);
    }

    /*
     * Create new Observer
     */
    function add()
    {
	$data['title']='Tambah Observer Baru';
	$data['link_back']=site_url('observer/index');
        $data['action']='observer/add';
	$this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $data['observer']['nama']='';
	    $data['observer']['alamat']='';
	    $data['observer']['telp']='';
	    $data['observer']['fax']='';
	    $data['observer']['email']='';
	    $this->template->display('observer/form',$data);
	} else {            
	    $observer=array(
		'nama'=>$this->input->post('nama'),
		'alamat'=>$this->input->post('alamat'),
		'telp'=>$this->input->post('telp'),
		'fax'=>$this->input->post('fax'),
		'email'=>$this->input->post('email'),
                'insert_date'=>  date('Y-m-d G:i:s')
	    );
	    $this->mdl_observer->add($observer);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Obsrever baru berhasil ditambahkan</div>');
	    redirect('observer/index');
	}
    }

   /*
     * Create new training
     */
    function edit($id)
    {
	$data['title']='Edit Observer';
	$data['link_back']=site_url('observer/index');
        $data['action']='observer/edit/'.$id;
	$this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $data['observer']=$this->mdl_observer->get_by_id($id)->row_array();
	} else {
$observer=array(
		'nama'=>$this->input->post('nama'),
		'alamat'=>$this->input->post('alamat'),
		'telp'=>$this->input->post('telp'),
		'fax'=>$this->input->post('fax'),
		'email'=>$this->input->post('email'),
                'update_date'=>  date('Y-m-d G:i:s')
	    );

	    $this->mdl_observer->update($id,$observer);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Observer berhasil diperbarui</div>');
            redirect('observer/detail/'.$id);
	}
        $this->template->display('observer/form',$data);
    }

    // validation rules
    function _set_rules(){
	$this->form_validation->set_rules('nama','Nama Observer','required|trim');
    }

    function delete($id)
    {
        $this->mdl_observer->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success">Observer '.$id.' berhasil dihapus</div>');
        redirect('observer');
    }

    function detail($id){
    $data['title']='Detail Observer';
    $data['observer']=$this->mdl_observer->get_by_id($id)->row_array();
    $data['edit']=  anchor('obsrver/edit/'.$data['observer']['id'], '<i class="icon-wrench icon-white"></i> Edit Dokumen', array('class'=>'btn btn-success'));
    $this->template->display('observer/detail',$data);
    }

}

/* End of file course.php */
/* Location: ./application/controllers/provider.php */
