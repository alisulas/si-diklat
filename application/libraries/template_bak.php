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
            switch ($fungsi) {
                case 1:
                    $menu = 'template/menu_adm';
                    break;
                case 2:
                    $menu = 'template/menu_pnd';
                    break;
                case 3:
                    $menu = 'template/menu_fgt';
                    break;
                case 4:
                    $menu = 'template/menu_ldt';
                    break;
                case 5:
                    $menu = 'template/menu_ls';
                    break;
                case 6:
                    $menu = 'template/menu_hsetc';
                    break;
                default:
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