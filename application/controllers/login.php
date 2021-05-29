<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
	parent::__construct();
	$this->load->model('mdl_login');
        $this->load->model('mdl_user');
	$this->load->library('access');
	$this->load->library('editor');
    }

    public function index()
    {
        if($this->access->is_login()){
            redirect('dashboard');   
        } else {
	    redirect('dashboard');            
        }

    }

    function auth(){
        $data['title']='';
	$this->load->library('form_validation');
	$this->load->helper('form');
	$this->form_validation->set_rules('password','Password','trim|required');
	$this->form_validation->set_rules('token','token','callback_check_login');

	if($this->form_validation->run() === FALSE){	   
	    $this->template->display('login/index',$data);
	} else {
            $tgl_last_login=$this->mdl_user->get_by_id($this->session->userdata('user_id'))->row()->last_login;
	    $this->session->set_flashdata('msg','<div class="alert alert-success fade in" id="login_success">Welcome <b>'.$this->session->userdata('user_name').'</b>, Last login - '.date('l, d M Y, G:i:s', strtotime($tgl_last_login)).'</div>');           
            $this->mdl_user->last_login($this->session->userdata('user_id'));
//            header('Location: ' . $_SERVER['HTTP_REFERER']);
           
          redirect('dashboard');        
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
    
 
    
    
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */