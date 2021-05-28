<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdl_cuti
 *
 * @author dhecode
 */
class Mdl_cuti extends CI_Model
{
    //put your code here
    private $table = 'cuti';
    private $table_log = 'cuti_log';

    // Add new course
    function add_log($var)
    {
        $this->db->insert($this->table_log, $var);
        return $this->db->insert_id();
    }

    function update_cuti($nopek, $data)
    {
        $this->db->where('nopek', $nopek);
        return $this->db->update($this->table, $data);
    }

    function get_by_nopek($nopek)
    {
        $this->db->where('nopek', $nopek);
        return $this->db->get($this->table);
    }

    function get_cuti()
    {
        return $this->db->get($this->table);
    }
}