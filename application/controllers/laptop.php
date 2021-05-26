<?php
/**
 * Description of memo
 *
 * @author Administrator
 */
class Laptop extends Member_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_laptop');
        $this->load->library('form_validation');
    }
    
    function index(){
        $this->get_index();
    }

    protected function get_index()
    {
	$data['title']='Data Laptop';
	
	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    'No',
                    'No Asset',
                    'No Seri',
		    'Merk',
                    'Lokasi',
                    'kelengkapan',
                    'Status',
                    'Action'
		);
	$q=$this->mdl_laptop->get_index()->result_array();
	$i=0;
	foreach ($q as $row)
	{
            $edit=  anchor('laptop/edit/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('laptop/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));
	    
            $this->table->add_row(
		    array('data'=>++$i,'width'=>15),
                    $row['no_asset'],
                    $row['no_seri'],
		    $row['merk'],
                    $row['lokasi'],
                    $row['kelengkapan'],
                    $this->cek_status($row['status']),
                    array('data'=>$edit.'&nbsp;'.$delete,'width'=>50)
		    );
	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
	$data['content']=$this->table->generate();
        $this->template->display('laptop/index',$data);
    }

    function add() {
        $data['title']='Tambah Data Laptop';
	$data['link_back']=site_url('laptop/index');
        $data['action']='laptop/add';
        $this->_set_rules();

        if ($this->form_validation->run() === FALSE){    
            $this->template->display('laptop/form',$data);
        }else{
            $laptop = array(
                'no_asset'=>$this->input->post('no_asset'),
                'no_seri'=> $this->input->post('no_seri'),
                'merk'=>$this->input->post('merk'),
                'lokasi'=>$this->input->post('lokasi'),
                'kelengkapan'=>$this->input->post('kelengkapan'),
                'catatan'=>$this->input->post('catatan'),
                'status'=>$this->input->post('status'),
                'insert_date'=>date('Y-m-d G:i:s'),
                'update_date'=>date('Y-m-d G:i:s')
            );
            $this->mdl_laptop->add($laptop);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Laptop baru berhasil ditambahkan</div>');
	    redirect('laptop/index');
        }
    }
    
    // validation rules
    function _set_rules(){
	$this->form_validation->set_rules('no_asset','no_asset','required|trim');
        $this->form_validation->set_rules('merk','merk','required|trim');

    }

       function _set_rules_edit(){
	$this->form_validation->set_rules('merk','merk','required|trim');
    }
    
    
    function edit($id){
        $data['title']='Edit User';
	$data['link_back']=site_url('laptop/index');
        $data['action']='laptop/edit/'.$id;
        $this->_set_rules_edit();
	if($this->form_validation->run() === FALSE)
	{
	$data['laptop']=$this->mdl_laptop->get_by_id($id)->row_array();
        $data['status']=  $this->cek_status_cek($data['laptop']['status']);
        
	}else{
         $laptop = array(
                'no_asset'=>$this->input->post('no_asset'),
                'no_seri'=> $this->input->post('no_seri'),
                'merk'=>$this->input->post('merk'),
                'lokasi'=>$this->input->post('lokasi'),
                'kelengkapan'=>$this->input->post('kelengkapan'),
                'catatan'=>$this->input->post('catatan'),
                'status'=>$this->input->post('status'),
                'update_date'=>date('Y-m-d G:i:s')
            );
            $this->mdl_laptop->update($id,$laptop);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">Data berhasil di ubah</div>');
	    redirect('laptop/index');
        }
        
     $this->template->display('laptop/form_edit',$data);

    }

    function delete($id)
    {
        $this->mdl_laptop->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success"">Data berhasil dihapus</div>');
        redirect('laptop');
    }
    
    
    function cek_status($id) {
        switch ($id) {
            case 0:
                $st='<span class="label label-important">Dipinjam</span>';
                break;
            case 1:
                $st='<span class="label label-info">Tersedia</span>';
                break;
            default:
                break;
        }
        return $st;
    }
    
    function cek_status_cek($id) {
    switch ($id) {
        case 0:
            $cek='<input type="radio" name="status" value="1">&nbsp;<span class="label label-info">Tersedia</span><br><input  checked="true" type="radio" name="status" value="0">&nbsp;<span class="label label-important">Dipinjam</span>';
            break;
        case 1:
            $cek='<input type="radio" name="status" value="1" checked="true">&nbsp;<span class="label label-info">Tersedia</span><br><input type="radio" name="status" value="0">&nbsp;<span class="label label-important">Dipinjam</span>';
            break;
        default:
            break;
    }
    return $cek;
}
   
   function lookup_laptop() {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_laptop->lookup_laptop($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id' => $row['id'],
                    'value' => $row['no_asset']
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
