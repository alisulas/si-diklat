<?php

class Member_Controller extends CI_Controller{
    function __construct() {
	parent::__construct();
	$this->load->library('access');
	if(!$this->access->is_login()){
	    $this->session->set_flashdata('msg','<div class="alert alert-error"><strong>Perhatian!</strong> Anda belum login. Silakan klik tombol Login di atas untuk masuk ke aplikasi</div>');
	    redirect('login/auth');
	}
    }

    function is_login(){
	return $this->access->is_login();
    }
}

class MY_Controller extends CI_Controller {
    function __construct() {
	parent::__construct();
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */