<?php
/**
 * Description of memo
 *
 * @author Administrator
 */
class Memo extends Member_Controller{
    //put your code here
    private $limit=10;
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_memo');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));

    }
    function index($offset=0){
        $this->get_index($offset);
    }

    protected function get_index($offset)
    {
	$data['title']='Index Memo';
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('memo/index/');
	$config['total_rows']=$this->mdl_memo->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    'No',
                 'Dari',
                 'Tujuan',
		    'Judul Memo',
                    array('data'=>'Action','rowspan'=>3)
		);
	$q=$this->mdl_memo->get_index($this->limit,$offset)->result_array();
	$i=0+$offset;
	foreach ($q as $row)
	{
            $view=  anchor('assets/uploads/memo/'.$row['file'],'<i class="icon-search"></i>',array('rel'=>'tooltip','title'=>'View','class'=>"fancybox fancybox.iframe"));
            $edit=  anchor('memo/edit/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('memo/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));
	    $this->table->add_row(
		    ++$i,
                    $row['from'],
                    $row['to'],
		    $row['subject'],

                    array('data'=>$view,'width'=>10),
                    array('data'=>$edit,'width'=>10),
                    array('data'=>$delete,'width'=>10)
		    );
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $this->template->display('memo/index',$data);
    }

    function add() {
        $data['title']='Tambah Memo Baru';
	$data['link_back']=site_url('memo/index');
        $data['action']='memo/add';

        $this->_set_rules();

        if ($this->form_validation->run() === FALSE){
            $data['memo']['subject']='';
            $data['memo']['file']='';


            $cat_list=$this->mdl_memo->get_function()->result();
	    $data['to']='<option value="-">-</option>';
             $data['from']='<option value="-">-</option>';
	    foreach ($cat_list as $list)
	    {
		$data['to'].='<option value="'.$list->name.'">'.$list->name.'</option>';
                $data['from'].='<option value="'.$list->name.'">'.$list->name.'</option>';
	    }
            $this->template->display('memo/form',$data);
        }else{
            $this->upload->initialize(array(
                'upload_path' => './assets/uploads/memo/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            if(!$this->upload->do_upload('filememo'))
            {
                $data_memo=$this->input->post('filememo2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $data_memo=$unggah['file_name'];
            }
            $memo = array(
                'from'=>$this->input->post('from'),
                'to'=>$this->input->post('to'),
                'subject'=>$this->input->post('subject'),
                'file'=>$data_memo
            );
            $id=$this->mdl_memo->add($memo);
	    $this->validation->no = $id;
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Memo baru berhasil ditambahkan</div>');
	    redirect('memo/index');
        }
    }
    // validation rules
    function _set_rules(){
	$this->form_validation->set_rules('subject','Judul','required|trim');

    }

    function edit($id){
        $data['title']='Edit Memo';
	$data['link_back']=site_url('memo/index');
        $data['action']='memo/edit/'.$id;
        $this->_set_rules();
	if($this->form_validation->run() === FALSE)
	{
	    $data['memo']=$this->mdl_memo->get_by_id($id)->row_array();
	}else{
           $this->upload->initialize(array(
                'upload_path' => './assets/uploads/memo/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            if(!$this->upload->do_upload('filememo'))
            {
                $data_memo=$this->input->post('filememo2');
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $data_memo=$unggah['file_name'];
            }
            $memo = array(
                 'from'=>$this->input->post('from'),
                'to'=>$this->input->post('to'),
                'subject'=>$this->input->post('subject'),
                'file'=>$data_memo
            );
            $id=$this->mdl_memo->update($id,$memo);
	    $this->validation->no = $id;
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Memo baru berhasil ditambahkan</div>');
            $data['memo']=$this->mdl_memo->get_by_id($id)->row_array();
	    redirect('memo/index');

        }
        $cat_list=$this->mdl_memo->get_function()->result();
	$data['from']='';
        $data['to']='';
	foreach ($cat_list as $list)
	{
	    if($list->name == $data['memo']['from'])
	    {
		$data['from'].='<option value="'.$list->name.'" selected="selected">'.$list->name.'</option>';
	    } else {
		$data['from'].='<option value="'.$list->name.'">'.$list->name.'</option>';
	    }

             if($list->name == $data['memo']['to'])
	    {
		$data['to'].='<option value="'.$list->name.'" selected="selected">'.$list->name.'</option>';
	    } else {
		$data['to'].='<option value="'.$list->name.'">'.$list->name.'</option>';
	    }
	}
     $this->template->display('memo/form',$data);


    }

    function delete($id)
    {
        $this->mdl_memo->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success"">trainer '.$id.' berhasil dihapus</div>');
        redirect('memo');
    }

}

?>
