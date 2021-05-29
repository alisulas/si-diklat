<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of template
 *
 * @author Administrator
 */
class Template {

    protected $ci;

    // Constructor
    function __construct() {
        $this->_ci = &get_instance();
    }

    // Default Template
    function display($template, $data = null) {
        if (!$this->_ci->session->userdata('is_login')) {
            $menu = 'template/menu_dashboard';
        } else {
            $fungsi = $this->_ci->session->userdata('fungsi');
            $role = $this->_ci->session->userdata('role');
            switch ($fungsi) {
                case 111:
                    $menu = 'template/menu_adm';
                    break;
                case 2:
                    $menu = 'template/menu_pnd';
                    break;
                case 3:
                    $menu = 'template/menu_ldt';
                    break;
                case 4:
                    if ($role==1) {
                    $menu = 'template/menu_fgt';    
                    }elseif ($role==2) {
                    $menu = 'template/menu_fgt_2';    
                    }
                    break;
                case 5:
                    $menu = 'template/menu_ls';
                    break;
                case 6:
                    $menu = 'template/menu_hsetc';
                    break;
                case 8:
                    $menu = 'template/menu_mtc';
                    break;
                case 9:
                    $menu = 'template/menu_vp';
                    break;
                default:
                    $menu = 'template/menu_dashboard';
                    break;
            }
        }
        $data['_content'] = $this->_ci->load->view($template, $data, true);
        $data['_menu'] = $this->_ci->load->view($menu, $data, true);
        $this->_ci->load->view('/template/template.php', $data);
    }

}

/* End of file template.php */
/* Location: ./application/libraries/template.php */