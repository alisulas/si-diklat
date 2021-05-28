<?php
class Mdl_sarfas extends CI_Model
{
    private $table_course = 'course';
    private $table_tln = 'tln';
    private $table_lokasi = 'lokasi';
    private $table_gl = 'sarfas_gl';
    private $table_memo = 'memo';
    private $table_class = 'class';
    private $table_schedule = 'schedule_sarfas';
    private $table_mobil = 'mobil';
    private $table_shcedule_mobil = 'schedule_mobil';
    private $table_sarfas_aktivitas = 'sarfas_aktivitas';
    private $table_pkl = 'sarfas_pkl';
    private $table_manager = 'manager';
    private $table_peminjaman_laptop = 'peminjaman_laptop';

    function get_index($list = '', $name = '', $limit = 10, $offset = 0)
    {
        //       $this->db->where('status',NULL);
        // $start_date=date("Y-m-d",strtotime('monday this week'));
        // $end_date=date("Y-m-d",strtotime('sunday this week'));
        //  $this->db->where('start_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        if (empty($name)) {
            $name = '';
        }
        if ($list == 'kode') {
            $this->db->like('course_id', $name);
        } elseif ($list == 'name') {
            $this->db->like('activity', $name);
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->table_schedule, $limit, $offset);
    }
    function get_index_agenda($limit = 100, $offset = 0)
    {
        //       $this->db->where('status',NULL);
        $start_date = date("Y-m-d", strtotime('monday this week'));
        $end_date = date("Y-m-d", strtotime('sunday this week'));
        $this->db->where('start_date BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->where('status', 0);
        $this->db->order_by('start_date', 'asc');
        return $this->db->get($this->table_schedule, $limit, $offset);
    }

    function get_gl($limit = 10, $offset = 0)
    {
        return $this->db->get($this->table_gl, $limit, $offset);
    }


    function get_laptop($limit = 10, $offset = 0, $nopek, $nama, $status)
    {
        if (!empty($nopek)) {
            $this->db->where('nopeg', $nopek);
        }
        if (!empty($nama)) {
            $this->db->where('nama', $nama);
        }

        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        return $this->db->get($this->table_peminjaman_laptop, $limit, $offset);
    }
    function get_pkl($list = '', $pkl_name = '', $limit = 10, $offset = 0)
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
        return $this->db->get($this->table_pkl, $limit, $offset);
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

    function get_gl_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_gl);
    }

    function get_tln($limit = 10, $offset = 0)
    {
        $this->db->where('status', NULL);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->table_tln, $limit, $offset);
    }



    function count_all()
    {
        $q =  $this->db->get($this->table_schedule);
        return $q->num_rows();
    }

    function count_laptop()
    {
        $dat =  $this->db->get($this->table_peminjaman_laptop);
        return $dat->num_rows();
    }

    function count_gl()
    {
        $q =  $this->db->get($this->table_gl);
        return $q->num_rows();
    }
    function count_pkl()
    {
        $q =  $this->db->get($this->table_pkl);
        return $q->num_rows();
    }

    function count_tln()
    {
        $q =  $this->db->get($this->table_tln);
        return $q->num_rows();
    }

    function get_tln_by($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_tln);
    }

    function get_class()
    {
        $this->db->order_by('class_name');
        return $this->db->get($this->table_class);
    }



    function add_schedule($schedule)
    {
        $this->db->insert($this->table_schedule, $schedule);
        return $this->db->insert_id();
    }
    function add_gl($gl)
    {
        $this->db->insert($this->table_gl, $gl);
        return $this->db->insert_id();
    }

    function get_schedule()
    {
        return $this->db->get($this->table_schedule);
    }

    function get_schedule_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_schedule);
    }

    function get_class_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_class);
    }

    function get_mobil()
    {
        return $this->db->get($this->table_mobil);
    }

    function add_schedule_mobil($schedule)
    {
        $this->db->insert($this->table_shcedule_mobil, $schedule);
        return $this->db->insert_id();
    }

    function get_schedule_mobil()
    {
        return $this->db->get($this->table_shcedule_mobil);
    }

    function get_mobil_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_mobil);
    }

    function get_schedule_mobil_by($id)
    {
        $this->db->where('plc_mobil_id', $id);
        return $this->db->get($this->table_shcedule_mobil);
    }

    function get_schedule_by_class($id_class)
    {
        $this->db->where('class', $id_class);
        return $this->db->get($this->table_schedule);
    }

    function get_jadwal_by($bulan, $tahun)
    {
        // die($bulan.$tahun);
        //       $this->db->where('status','0');
        $this->db->having('status = 0');
        $this->db->where('MONTH(`start_date`)', $bulan);
        $this->db->where('YEAR(`start_date`)', $tahun);
        $this->db->where('YEAR(`end_date`)', $tahun);
        $this->db->or_where('MONTH(`end_date`)', $bulan);

        //  $this->db->order_by('start_date','asc');
        return $this->db->get_where($this->table_schedule);
    }

    function check_jadwal($kelas)
    {
        $this->db->where('class', $kelas);
        return $this->db->get($this->table_schedule);
    }

    // Delete Kegiatan
    function delete_kegiatan($ids)
    {
        $this->db->where('id', $ids);
        return $this->db->delete($this->table_schedule);
    }
    function delete_aktivitas($ids)
    {
        $this->db->where('course_id', $ids);
        return $this->db->delete($this->table_sarfas_aktivitas);
    }
    function delete_memo($ids)
    {
        $this->db->where('course_id', $ids);
        return $this->db->delete($this->table_memo);
    }

    function delete_gl($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table_gl);
    }

    function get_jadwal_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_schedule);
    }

    function get_laptop_by($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table_peminjaman_laptop);
    }

    function edit_kegiatan($id, $var)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table_schedule, $var);
    }

    function edit_gl($id, $vari)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table_gl, $vari);
    }


    function get_aktivitas_by_course($id)
    {
        $this->db->where('course_id', $id);
        return $this->db->get($this->table_sarfas_aktivitas);
    }

    function add_aktivitas($aktiv)
    {
        $this->db->insert($this->table_sarfas_aktivitas, $aktiv);
    }

    function add_pkl($pkl)
    {
        $this->db->insert($this->table_pkl, $pkl);
    }

    function add_peminjaman_laptop($data)
    {
        $this->db->insert($this->table_peminjaman_laptop, $data);
    }

    function update_peminjaman_laptop($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table_peminjaman_laptop, $data);
    }

    function update_schedule($id, $schedule)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table_schedule, $schedule);
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

    function delete_peminjaman_laptop($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table_peminjaman_laptop);
    }

    function update_status_peminjaman_laptop($id, $val)
    {
        $this->db->where('id', $id);
        $var = array(
            'status' => $val
        );
        return $this->db->update($this->table_peminjaman_laptop, $var);
    }


    function lookup_manager($keyword)
    {
        $this->db->like('name', $keyword, 'after');
        $query = $this->db->get($this->table_manager);
        return $query->result_array();
    }



    function get_lokasi_opt()
    {
        return $this->db->get($this->table_lokasi);
    }

    function lookup_kota($keyword)
    {
        $this->db->like('nama', $keyword, 'after');
        $query = $this->db->get($this->table_lokasi);
        return $query->result_array();
    }
}