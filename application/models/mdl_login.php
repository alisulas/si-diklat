<?php
/**
 * Description of mdl_login
 *
 * @author Administrator
 */
class Mdl_login extends CI_Model{
    private $table_function='function';

    /**
     * CRUD login
     */
    function get_list()
    {
        return $this->db->get($this->table_function);
    }
}

/* End of file mdl_login.php */
/* Location: ./application/models/mdl_login.php */