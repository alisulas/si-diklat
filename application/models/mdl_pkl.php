<?php
class Mdl_pkl extends CI_Model
{
    private $table_pkl = 'pkl';

    function get_pkl($list = '', $pkl_name = '')
    {

        if ($list == 'nama') {
            $this->db->like('nama', $pkl_name);
        } elseif ($list == 'fakultas') {
            $this->db->like('fakultas', $pkl_name);
        } elseif ($list == 'perguruan_tinggi') {
            $this->db->like('perguruan_tinggi', $pkl_name);
        } elseif ($list == 'status') {
            $this->db->like('status', $pkl_name);
        }

        $this->db->order_by('id', 'desc');
        return $this->db->get($this->table_pkl);
    }
    function get_pkl_laporan($bulan, $tahun)
    {
        if (!$bulan == 0) {
            $this->db->where('MONTH(`tgl_mulai`)', $bulan);
        }

        if (!$tahun == 0) {
            $this->db->where('YEAR(`tgl_mulai`)', $tahun);
        }
        return $this->db->get($this->table_pkl);
    }

    function count_pkl()
    {
        $q =  $this->db->get($this->table_pkl);
        return $q->num_rows();
    }

    function get_by_nim($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get($this->table_pkl)->num_rows();
    }

    function add_pkl($pkl)
    {
        $this->db->insert($this->table_pkl, $pkl);
    }


    function update_uang_saku($id, $uang_saku)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table_pkl, $uang_saku);
    }

    function update_pkl($id, $pkl)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table_pkl, $pkl);
    }

    function get_pkl_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_pkl);
    }

    function get_manager_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_manager);
    }

    function delete_pkl($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table_pkl);
    }
    function lookup_manager($keyword)
    {
        $this->db->like('name', $keyword, 'after');
        $query = $this->db->get($this->table_manager);
        return $query->result_array();
    }
}