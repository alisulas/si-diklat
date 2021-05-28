<?php
class Mdl_jadwal extends CI_Model
{
    private $table = 'jadwal';


    function get_jadwal($id, $tgl)
    {
        $this->db->where('plc_course_id', $id);
        $this->db->where('tanggal', $tgl);
        return $this->db->get($this->table);
    }

    function get_jadwal_by_id($id_course)
    {
        $this->db->where('plc_course_id');
        return $this->db->get($this->table);
    }

    function get_jadwal_by_course($id_course, $tanggal)
    {
        $this->db->where('plc_course_id', $id_course);
        $this->db->where('tanggal', $tanggal);
        $this->db->order_by('waktu', 'asc');
        return $this->db->get($this->table);
    }

    function delete($id_jadwal)
    {
        $this->db->where('id', $id_jadwal);
        return $this->db->delete($this->table);
    }
}