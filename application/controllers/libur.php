<?php

/**
 * Description of course
 *
 * @author Administrator
 */
class Libur extends Member_Controller {

    private $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_libur');
        $this->load->library('form_validation');
    }

    /*
     * Create new training
     */
    function index(){
        if(empty($offset)){$offset=0;}
        $this->view($offset);
    }
    function view($offset=0)
    {
	    $data['title']='Daftar Tanggal Libur';
	    $data['action']='libur/add';
	    $this->load->library('pagination');
	    if(empty($offset)){$offset=0;}
	    /* Pagination */
	    $config['base_url']=site_url('libur/view');
	    $config['total_rows']=$this->mdl_libur->count_all();
	    $config['per_page']=$this->limit;
	    $config['uri_segment']=3;
	    $this->pagination->initialize($config);
	    $data['pagination']=$this->pagination->create_links();


	    /* List Table */
	    $this->load->library('table');
	    $this->table->set_empty('&nbsp;');
	    $this->table->set_heading(
		    array('data'=>'No','width'=>5),
		    array('data'=>'Tanggal','width'=>100),
		    'Keterangan',
		    array('data'=>'Action','width'=>20)
		    );

	    $libur=$this->mdl_libur->get_index($this->limit,$offset)->result_array();
	    $i=0+$offset;
	    foreach ($libur as $row)
	    {
                if($this->session->userdata('user_id')==1 || $this->session->userdata('user_id')==4){
                 		$delete=  anchor('libur/delete/'.$row['id'],'Delete',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete','class'=>'btn btn-danger'));   
                }else{
                    		$delete=  '<button class="btn btn-danger">Delete</button>';
                }
		$this->table->add_row(
			++$i,
			$this->editor->date_correct($row['date']),
			$row['ket'],
			array('data'=>$delete,'width'=>10)
			);
	    }
	    $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	    $data['content']=$this->table->generate();
	    $this->template->display('libur/index',$data);
	
    }

    function add()
    {
	$this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $this->session->set_flashdata('msg',$this->editor->alert_error('Masukan semua data'));
	    redirect('libur/view');
	} else {
	    $var=array(
		'date'=>$this->input->post('date'),
		'ket'=>$this->input->post('ket')
	    );
	    $this->mdl_libur->add($var);
	    $this->session->set_flashdata('msg',$this->editor->alert_ok('Data peserta berhasil dimasukkan'));
	    redirect('libur/view');
	}
    }
    // validation rules
    function _set_rules() {
        $this->form_validation->set_rules('date', 'Tanggal Libur', 'required|trim');
        $this->form_validation->set_rules('ket', 'Deskripsi', 'required|trim');
    }

    function delete($id) {
         $this->mdl_libur->delete($id);
        $this->session->set_flashdata('msg',$this->editor->alert_ok('Data berhasil dihapus'));
        redirect('libur/view');
    }
}

/* End of file libur.php */
/* Location: ./application/controllers/libur.php */
