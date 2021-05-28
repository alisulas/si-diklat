<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mdl_carpar extends CI_Model
{
    //put your code here
    private $table = 'carpar';
    private $table_function = 'function';
    private $table_log = 'carpar_log';

    // Add new course
    function add_carpar($var)
    {
        $this->db->insert($this->table, $var);
        return $this->db->insert_id();
    }

    function add_carpar_log($var)
    {
        $this->db->insert($this->table_log, $var);
        return $this->db->insert_id();
    }

    function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }


    function get_carpar_log_by_id($id)
    {
        $this->db->where('id_carpar', $id);
        return $this->db->get($this->table_log);
    }

    function get_carpar_log_status($id)
    {
        $this->db->where('id_carpar', $id);
        $this->db->where('status', 1);
        return $this->db->get($this->table_log);
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function update_log($id, $data)
    {
        $this->db->where('id_carpar', $id);
        return $this->db->update($this->table_log, $data);
    }

    function get_index($list, $cari, $limit = 10, $offset = 0)
    {
        if (empty($cari)) {
            $cari = '';
        }
        if ($list == 'nama_program') {
            $this->db->like('nama_program', $cari);
        } elseif ($list == 'tempat') {
            $this->db->like('tempat', $cari);
        }

        return $this->db->get($this->table, $limit, $offset);
    }

    function get_index_user($pic, $list, $cari, $limit = 10, $offset = 0)
    {
        if (empty($cari)) {
            $cari = '';
        }
        if ($list == 'nama_program') {
            $this->db->like('nama_program', $cari);
        } elseif ($list == 'tempat') {
            $this->db->like('tempat', $cari);
        }
        $this->db->where('pic', $pic);
        $this->db->where('review', 1);

        return $this->db->get($this->table, $limit, $offset);
    }
    // Counting Pagination
    function count_all()
    {
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }
    function count_all_user()
    {
        $this->db->where('review', 1);
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }


    function get_pic($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_function);
    }
}