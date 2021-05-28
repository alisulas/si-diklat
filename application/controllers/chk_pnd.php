<?php

/**
 * Description of chk_pnd
 *
 * @author dhecode
 */
class chk_pnd extends Member_Controller
{
    //put your code here

    function __construct()
    {
        parent::__construct();
        $this->load->model(mdl_course);
    }

    function index($id)
    {
    }
}