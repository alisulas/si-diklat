<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author irhamnurhalim
 */
class Access {
    public $user;
    /**
     * Constructor
     */
    function __construct() {
	$this->CI=& get_instance();
	$auth = $this->CI->config->item('auth');
	$this->CI->load->library('session');
	$this->CI->load->helper('cookie');
	$this->CI->load->model('mdl_user');
	$this->mdl_user =& $this->CI->mdl_user;
    }

    /*
     * Cek Login user
     */
    function login($username,$password){
	$result = $this->mdl_user->get_login_info($username)->row();
	if($result) {
	    $password = md5($password);
	    if($password === $result->password){
		$fungsi=  $this->mdl_user->get_function_by_id($result->fungsi)->row()->name;
		// Start Session
		    $sess=array(
			'user_id'=>$result->id,
			'user_name'=>$result->nama,
			'fungsi'=>$result->fungsi,
                        'role'=>$result->role,
                        'fungsi_name'=>$fungsi,
			'is_login'=>TRUE
		    );
		$this->CI->session->set_userdata($sess);
		return TRUE;
	    }
	}
	return FALSE;
    }

    
    /*
     * Cek is login
     */
    function is_login(){
	return (($this->CI->session->userdata('is_login')) ? TRUE : TRUE);
    }

    /*
     * Logout
     */
    function logout(){
	$data=array(
	    'user_id',
	    'user_name',
	    'is_login'
	);
	$this->CI->session->unset_userdata($data);
	$this->CI->session->sess_destroy();
    }
}

/* End of file access.php */
/* Location: ./application/libraries/access.php */