<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
	parent::__construct();
	$this->load->model('mdl_login');
	$this->load->model('mdl_dashboard');
	$this->load->model('mdl_course');
	$this->load->library('access');
	$this->load->library('editor');
    }

    public function index()
    {
	if($this->access->is_login())
	    redirect('dashboard');
	else
	    redirect('agenda');
    }

    function auth(){
	$this->load->library('form_validation');
	$this->load->helper('form');
	$this->form_validation->set_rules('password','Password','trim|required');
	$this->form_validation->set_rules('token','token','callback_check_login');

	if($this->form_validation->run() === FALSE){
	    $func=$this->mdl_login->get_list()->result_array();
	    $data['functions']='';
	    foreach ($func as $row)
	    {
		$data['functions'].='<option value='.$row['id'].'>'.$row['name'].'</option>';
	    }
	    $this->template->display('login/index',$data);
	} else {
	    $dashboard=$this->mdl_dashboard->get_index()->row();
	    $this->session->set_flashdata('msg','<div class="alert alert-success fade in" id="login_success">Login berhasil</div>');
           if ($this->session->userdata('user_id')==2){
            redirect('fgt_pelatihan');               
           }  else {
               redirect('agenda');    
           }

	}
    }

    function logout(){
	$this->access->logout();
	redirect('login');
    }

    function check_login(){
	$username = $this->input->post('username',TRUE);
	$password = $this->input->post('password',TRUE);

	$login = $this->access->login($username,$password);
	if($login){
	    return TRUE;
	}else{
	    $this->session->set_flashdata('msg','<div class="alert alert-error fade in"><button class="close" data-dismiss="alert">x</button>Password yang Anda masukkan salah!</div>');
	    return FALSE;
	}
    }

    function information()
    {
	$data['title']='Calendar';
              $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                array('data'=>'No','width'=>'10'),
                array('data'=>'Kode','width'=>'30'),
                'Nama Pelatihan',
                array('data'=>'Tanggal Pelaksanaan','width'=>'80'),
                array('data'=>'Durasi','width'=>'20'),
                array('data'=>'PIC','width'=>'20')
                );
        
        $que = $this->mdl_dashboard->get_course_week()->result();
        $a=0;
        foreach ($que as $row) {
            $pic=$this->mdl_course->get_function_by_id($row->plc_function_id)->row()->name;
            $this->table->add_row(
             ++$a,
              $row->code,
                    $row->course_name,
                    $this->editor->date_correct($row->start_date),
                    $row->duration.' Hari',
                   $pic
                    );
 
        }
 $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
 $data['pelatihan']= $this->table->generate();       
$this->template->display('login/information',$data);
    }

    function event(){
	$cal=$this->mdl_dashboard->get_all()->result_array();
	$i=0;
	foreach ($cal as $row)
	{
	    $data[$i]['id']=$row['id'];
	    $data[$i]['title']=$row['course_name'];
            $data[$i]['start']=$row['start_date'];
	    $data[$i]['end']=$row['end_date'];
	    $data[$i]['url']= 'login/course_info/'.$row['id'];
	    $i++;
	}
	$this->data['output'] = $data;
	$this->load->view('json_view',$this->data);
    }
    
    function course_info($id) {
        $data['title']='Informasi Pelatihan';
        $data['course_code']=  $this->mdl_dashboard->get_course_by_id($id)->row()->code;
        $data['course_name']=  $this->mdl_dashboard->get_course_by_id($id)->row()->course_name;
        $data['location']=  $this->mdl_dashboard->get_course_by_id($id)->row()->location;
        $start_date=  $this->mdl_dashboard->get_course_by_id($id)->row()->start_date;
        $end_date=  $this->mdl_dashboard->get_course_by_id($id)->row()->end_date;
        $data['start_date']=  $this->editor->date_correct($start_date);
        $data['end_date']=  $this->editor->date_correct($end_date);
        
         if (empty($this->mdl_dashboard->get_kursil_by($id)->row()->candidate_estimation)){
             $data['target_peserta']='Belum di isi';
         }else{
             $data['target_peserta']=$this->mdl_dashboard->get_kursil_by($id)->row()->candidate_estimation.' Orang';
         }
         
         if($this->mdl_dashboard->get_peserta_by_course($id)==0){
             $data['jumlah_peserta']='Belum dimasukan';
         }else{
             $data['jumlah_peserta']=$this->mdl_dashboard->get_peserta_by_course($id).' Orang';
         }
         
         $data['back']= anchor('dashboard', 'Kembali', array('class'=>'btn btn-info'));
     
         
        $this->template->display('login/detailcourse',$data);
    }
    
    
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */