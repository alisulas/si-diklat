<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdl_ldp
 *
 * @author dhecode
 */
class mdl_ldp extends CI_Model
{
    //put your code here
    private $table = 'ldp_tagihan';
    function add_tagihan($var)
    {
        $this->db->insert($this->table, $var);
        return $this->db->insert_id();
    }

    function get_tagihan($limit, $offset)
    {
        $this->db->order_by('tgl_mulai', 'desc');
        return $this->db->get($this->table, $limit, $offset);
    }
    function get_all_tagihan()
    {
        return $this->db->get($this->table);
    }

    function count_tagihan()
    {
        $a = $this->db->get($this->table);
        return $a->num_rows();
    }

    function get_tagihan_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    function update_tagihan($id, $var)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $var);
    }

    function delete_tagihan($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}