<?php

/**
 * Description of course
 *
 * @author Administrator
 */
class Mdl_tln extends CI_Model {

    private $table = 'tln';
    private $table_libur = 'libur';

    /**
     * CRUD Course
     */
    
    function get_index($limit = 10, $offset = 0, $month,$tahun,$nopek,$nama,$judul,$status) {
        if (empty($month) && empty($nopek)&& empty($nama) && empty($tahun) && empty($judul)) {
            $month = 0;
            $nopek = 0;
            $nama=0;
            $judul = 0;
            $tahun=0;
        }

        if (!$nopek == 0) {
            $this->db->like('nopek', $nopek);
        }
        if (!$nama == 0) {
            $this->db->like('nama', $nama);
        }

        if (!$judul == 0) {
            $this->db->like('judul', $judul);
        }
        
          if (!$status == 0) {
            $this->db->like('status_pelaksanaan_tln', $status);
        }

        if (!$month == 0) {
            $this->db->where('MONTH(`tgl_mulai_tln`)', $month);
        }

        if (!$tahun == 0) {
            $this->db->where('YEAR(`tgl_akhir_tln`)', $tahun);
        }  else {
            $this->db->where('YEAR(`tgl_mulai_tln`)', date("Y-m-d"));            
        }
        
        $this->db->order_by('tgl_mulai_tln', 'desc');
        return $this->db->get($this->table, $limit, $offset);
    }
    

    function get_exel($month,$tahun) {
        if (empty($month) && empty($tahun)) {
            $month = 0;
            $tahun = 0;
        }

        if (!$month == 0) {
            $this->db->where('MONTH(`tgl_mulai_tln`)', $month);
        }
        if (!$tahun == 0) {
            $this->db->where('YEAR(`tgl_mulai_tln`)', $tahun);
        }
        $this->db->order_by('tgl_mulai_tln', 'desc');
        return $this->db->get($this->table);
    }

    function count_all($month,$tahun,$nopek,$nama,$judul,$status) {
        if (empty($month) && empty($nopek)&& empty($nama) && empty($tahun) && empty($judul)) {
            $month = 0;
            $nopek = 0;
            $nama=0;
            $judul = 0;
            $tahun=0;
        }

        if (!$nopek == 0) {
            $this->db->like('nopek', $nopek);
        }
        if (!$nama == 0) {
            $this->db->like('nama', $nama);
        }

        if (!$judul == 0) {
            $this->db->like('judul', $judul);
        }
        
        if (!$status == 0) {
            $this->db->like('status_pelaksanaan_tln', $status);
        }

        if (!$month == 0) {
            $this->db->where('MONTH(`tgl_mulai_tln`)', $month);
        }

        if (!$tahun == 0) {
            $this->db->where('YEAR(`tgl_mulai_tln`)', $tahun);
        }

        $this->db->order_by('id', 'desc');
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }

    function get_libur() {
        return $this->db->get($this->table_libur);
    }

    // Add new Certificate
    function add($var) {
        $this->db->insert($this->table, $var);
        return $this->db->insert_id();
    }

    // Delete Certificate
    function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Get Certificate by id
    function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    // Update Certificate
    function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $status);
    }

    function add_dataexcel($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {

            $data = array(
                'prm_kegiatan' => $this->prm_kegiatan(strtolower($dataarray[$i]['prm_kegiatan'])),
                'prm_via' => $this->prm_via(strtolower($dataarray[$i]['prm_via'])),
                'prm_tgl' => join('-', array_reverse(explode('/', $dataarray[$i]['prm_tgl']))),
                'prm_tgl_lengkap' => join('-', array_reverse(explode('/', $dataarray[$i]['prm_tgl_lengkap']))),
                'inf_nama' => $dataarray[$i]['inf_nama'],
                'inf_nopek' => $dataarray[$i]['inf_nopek'],
                'inf_direktorat' => $dataarray[$i]['inf_direktorat'],
                'inf_lembaga' => $dataarray[$i]['inf_lembaga'],
                'inf_judul' => $dataarray[$i]['inf_judul'],
                'inf_kontak' => $dataarray[$i]['inf_kontak'],
                'inf_email' => $dataarray[$i]['inf_email'],
                'inf_lokasi' => $dataarray[$i]['inf_lokasi'],
                'inf_tgl_mulai' => join('-', array_reverse(explode('/', $dataarray[$i]['inf_tgl_mulai']))),
                'inf_tgl_selesai' => join('-', array_reverse(explode('/', $dataarray[$i]['inf_tgl_selesai']))),
                'chk_disposisi' => $this->chk_disposisi(strtolower($dataarray[$i]['chk_disposisi'])),
                'chk_persetujuan' => $this->chk_persetujuan(strtolower($dataarray[$i]['chk_persetujuan'])),
                'chk_reg_via' => $this->chk_reg_via(strtolower($dataarray[$i]['chk_reg_via'])),
                'chk_reg_tgl' => join('-', array_reverse(explode('/', $dataarray[$i]['chk_reg_tgl']))),
                'prt_feedback' => $this->prt_feedback(strtolower($dataarray[$i]['prt_feedback'])),
                'prt_tgl' => join('-', array_reverse(explode('/', $dataarray[$i]['prt_tgl']))),
                'keu_inv_no' => $dataarray[$i]['keu_inv_no'],
                'inv_currency' => $dataarray[$i]['inv_currency'],
                'keu_inv_jumlah' => $dataarray[$i]['keu_inv_jumlah'],
                'keu_inv_tgl' => join('-', array_reverse(explode('/', $dataarray[$i]['keu_inf_tgl']))),
                'keu_sp' => $this->keu_sp($dataarray[$i]['keu_sp']),
                'keu_tgl' => join('-', array_reverse(explode('/', $dataarray[$i]['keu_tgl']))),
                'keu_prosedur' => $this->opt_keu_prosedur(strtolower($dataarray[$i]['keu_prosedur'])),
                'status_proses' => $dataarray[$i]['status_proses'],
                'keterangan' => $dataarray[$i]['keterangan']
            );
            $this->db->insert($this->table, $data);
        }
    }

    function prm_kegiatan($kegiatan) {
        if ($kegiatan == 'pendaftaran') {
            $prm_kegiatan = '1';
        } elseif ($kegiatan == 'pendaftaran') {
            $prm_kegiatan = '2';
        } else {
            $prm_kegiatan = '3';
        }
        return $prm_kegiatan;
    }

    function prm_via($via) {
        if ($via == 'e-corr') {
            $prm_via = '1#';
        } else {
            $prm_via = '2#';
        }
        return $prm_via;
    }

    function chk_disposisi($disposisi) {
        if ($disposisi == 'vp plc') {
            $disp = '1';
        } elseif ($disposisi == 'ldt man') {
            $disp = '2';
        } else {
            $disp = '3';
        }

        return $disp;
    }

    function chk_persetujuan($persetujuan) {
        if ($persetujuan == 'y') {
            $prt = '1';
        } else {
            $prt = '0';
        }
    }

    function chk_reg_via($reg_via) {
        if ($reg_via == 'registrasi sendiri') {
            $chk_reg_via = '1';
        } else {
            $chk_reg_via = '0';
        }

        return $chk_reg_via;
    }

    function prt_feedback($feedback) {
        if ($feedback == 'y') {
            $prt_feedback = '1';
        } else {
            $prt_feedback = '0';
        }
        return $prt_feedback;
    }

    function keu_sp($sp) {
        if ($sp == 'y') {
            $keu_sp = '1';
        } else {
            $keu_sp = '0';
        }
        return $keu_sp;
    }

    function opt_keu_prosedur($prosedur) {
        if ($prosedur == 'umk') {
            $keu_prosedur = '1';
        } elseif ($prosedur == 'penagihan') {
            $keu_prosedur = '2';
        } else {
            $keu_prosedur = '3';
        }
    }

}

/* End of file certificate.php */
/* Location: ./application/models/mdl_certificate.php */
