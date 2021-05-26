<?php
/**
 * Description of memo
 *
 * @author Administrator
 */
class User extends Member_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_user');
        $this->load->library('form_validation');

    }
    function index(){
        $this->get_index();
    }

    protected function get_index()
    {
	$data['title']='Users';
	
	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    'No',
                    'Username',
                    'Nama',
		    'Fungsi',
                    'Status',
                    'Action'
		);
	$q=$this->mdl_user->get_index()->result_array();
	$i=0;
	foreach ($q as $row)
	{
            $edit=  anchor('user/edit/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('user/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));
	    $fungsi=  $this->mdl_user->get_function_by_id($row['fungsi'])->row()->name;
            $this->table->add_row(
		    array('data'=>++$i,'width'=>15),
                    $row['username'],
                    $row['nama'],
		    $fungsi,
                    $this->cek_status($row['status']),
                    array('data'=>$edit.'&nbsp;'.$delete,'width'=>50)
		    );
	}
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
	$data['content']=$this->table->generate();
        $this->template->display('user/index',$data);
    }

    function add() {
        $data['title']='Tambah Data User';
	$data['link_back']=site_url('user/index');
        $data['action']='user/add';
        $this->_set_rules();

        if ($this->form_validation->run() === FALSE){            

            $cat_list=$this->mdl_user->get_function()->result();
	    $data['fungsi']='<option value="-">-</option>';
	    foreach ($cat_list as $list)
	    {
		$data['fungsi'].='<option value="'.$list->id.'">'.$list->name.'</option>';
	    }
            $this->template->display('user/form',$data);
        }else{
            $pass=  $this->input->post('password');
            
            $user = array(
                'username'=>$this->input->post('username'),
                'password'=>  md5($pass),
                'nopek'=>$this->input->post('nopek'),
                'nama'=>$this->input->post('nama'),
                'email'=>$this->input->post('email'),
                'fungsi'=>$this->input->post('fungsi'),
                'jabatan'=>$this->input->post('jabatan'),
                'hp'=>$this->input->post('hp'),
                'role'=>$this->input->post('role'),
                'status'=>  $this->input->post('status'),
                'insert_date'=>date('Y-m-d G:i:s')
            );
            $this->mdl_user->add($user);
	    $this->session->set_flashdata('msg','<div class="alert alert-success">User baru berhasil ditambahkan</div>');
	    redirect('user/index');
        }
    }
    
    // validation rules
    function _set_rules(){
	$this->form_validation->set_rules('username','username','required|trim');
        $this->form_validation->set_rules('password','password','required|trim');

    }

       function _set_rules_edit(){
	$this->form_validation->set_rules('username','username','required|trim');
    }
    
    
    function edit($id){
        $data['title']='Edit User';
	$data['link_back']=site_url('user/index');
        $data['action']='user/edit/'.$id;
        $this->_set_rules_edit();
	if($this->form_validation->run() === FALSE)
	{
	$data['user']=$this->mdl_user->get_by_id($id)->row_array();
        $cat_list=$this->mdl_user->get_function()->result();
	$data['fungsi']='';
	foreach ($cat_list as $list)
	{
	    if($list->id == $data['user']['fungsi'])
	    {
		$data['fungsi'].='<option value="'.$list->id.'" selected="selected">'.$list->name.'</option>';
	    } else {
		$data['fungsi'].='<option value="'.$list->id.'">'.$list->name.'</option>';
	    }
	}
        
        $role=array(
            1=>'Group 1',
            2=>'Group 2',
            3=>'Group 3',
            4=>'Group 4',
            5=>'Group 5'
        );
        
        $data['role']=  form_dropdown('role',$role,$data['user']['role']);
        
	}else{
          
         $pass=  $this->input->post('password');
           if ($pass==''){
             
            $user = array(
                'username'=>$this->input->post('username'),
                'nopek'=>$this->input->post('nopek'),
                'nama'=>$this->input->post('nama'),
                'email'=>$this->input->post('email'),
                'fungsi'=>$this->input->post('fungsi'),
                'jabatan'=>$this->input->post('jabatan'),
                'hp'=>$this->input->post('hp'),
                'role'=>$this->input->post('role'),
                'status'=>  $this->input->post('status'),
                'update_date'=>date('Y-m-d G:i:s')
            );   
            $this->mdl_user->update_user($id,$user);
           }  else {
            
            $user = array(
                'username'=>$this->input->post('username'),
                'password'=>  md5($pass),
                'nopek'=>$this->input->post('nopek'),
                'nama'=>$this->input->post('nama'),
                'email'=>$this->input->post('email'),
                'fungsi'=>$this->input->post('fungsi'),
                'jabatan'=>$this->input->post('jabatan'),
                'hp'=>$this->input->post('hp'),
                'role'=>$this->input->post('role'),
                'status'=>  $this->input->post('status'),
                'update_date'=>date('Y-m-d G:i:s')
            );    
            $this->mdl_user->update_user($id,$user);
           }
	    $this->session->set_flashdata('msg','<div class="alert alert-success">User berhasil di ubah</div>');
           
	    redirect('user/index');

        }
       
        
     $this->template->display('user/form_edit',$data);

    }

    function delete($id)
    {
        $this->mdl_user->delete($id);
        $this->session->set_flashdata('msg','<div class="alert alert-success"">User berhasil dihapus</div>');
        redirect('user');
    }
    
    function profile($id) {
        $data['title']='Profile';
        $data['user']=$this->mdl_user->get_by_id($id)->row_array();
        $data['action']='user/change_pwd/'.$id;
        $data['fungsi']=$this->mdl_user->get_function_by_id($data['user']['fungsi'])->row()->name;
        switch ($data['user']['role']) {
            case 1:
                $data['role']='Manager';
                break;
                case 2:
                    $data['role']='Officer';
                    break;
            default:
                $data['role']='';
                break;
        }
        $this->template->display('user/profile',$data);
    }
    
    function change_pwd($id) {
        $old=  $this->input->post('old_password');
        $new=  $this->input->post('new_password');
        if ($this->mdl_user->get_by_id($id)->row()->password== md5($old)){
            $ubh=array(
                'password'=>  md5($new)
            );
            $this->mdl_user->update_user($id,$ubh);
            $this->session->set_flashdata('msg','<div class="alert alert-success"">Password Berhasil di Ubah</div>');
            redirect('user/profile/'.$id);
        }  else {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"">Password lama salah</div>');    
        redirect('user/profile/'.$id);
        
        }
    }
    
    function cek_status($id) {
        switch ($id) {
            case 0:
                $st='<span class="label label-important">Non Aktif</span>';
                break;
            case 1:
                $st='<span class="label label-info">Aktif</span>';
                break;
            default:
                break;
        }
        return $st;
    }
    

}

?>
