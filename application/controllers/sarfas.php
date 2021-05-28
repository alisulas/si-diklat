<?php
class Sarfas extends CI_Controller
{
    private $limit = 10;

    function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_sarfas');
        $this->load->model('mdl_peserta');
        $this->load->model('mdl_laptop');
        $this->load->model('mdl_fgt_pelatihan');
        $this->load->model('mdl_pelatihan');
        $this->load->model('mdl_course');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
    }

    function index($offset = 0)
    {
        $this->get_index($offset);
    }

    /*
     * Get index table
     */
    protected function get_index($offset)
    {
        $data['title'] = 'Jadwal Kelas';
        $data['action'] = 'sarfas/add_schedule';
        $data['tambah_kegiatan'] =  anchor('#tambah_kegiatan', 'Tambah Kegiatan', array('class' => 'btn btn-success', 'data-toggle' => 'modal'));
        $data['lihat_kalender'] =  anchor('sarfas/get_jadwal_kelas', 'Lihat Kalender', array('class' => 'btn btn-info'));
        $data['lihat_jadwal'] =  anchor('agenda', 'Lihat Jadwal Kelas', array('class' => 'btn btn-primary'));
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        /* Pagination */
        $config['base_url'] = site_url('sarfas/index/');
        $config['total_rows'] = $this->mdl_sarfas->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
            'No',
            'Jenis',
            'Nama Kegiatan',
            'Tanggal',
            'Lokasi',
            'Memo Masuk',
            'Memo Keluar',
            'Aktivitas',
            'Status',
            array('data' => 'Update', 'colspan' => 2)
        );

        /* Pilihan Kelas */
        $opt_class = $this->mdl_sarfas->get_class();
        $data['options_class'] = '';
        foreach ($opt_class->result_array() as $row_class) {
            $data['options_class'] .= '<option value="' . $row_class['id'] . '">' . $row_class['class_name'] . '</option>';
        }

        $list =  $this->input->post('list');
        $cari =  $this->input->post('cari');

        $q = $this->mdl_sarfas->get_index($list, $cari, $this->limit, $offset)->result_array();

        $i = 0 + $offset;
        $data['modal_aktivitas_sarfas'] = '';
        $data['modal_lihat_aktivitas_sarfas'] = '';
        $data['add_memo_masuk'] = '';
        $data['add_memo_keluar'] = '';
        $data['location'] = '';
        foreach ($q as $row) {
            if (!$this->mdl_sarfas->get_aktivitas_by_course($row['id'])->num_rows() == 0) {
                $atk_permintaan =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->atk_permintaan;
                $atk_realisasi =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->atk_realisasi;
                $hk_permintaan =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->hk_permintaan;
                $hk_realisasi =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->hk_realisasi;
                $res_permintaan =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->res_permintaan;
                $res_realisasi =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->res_realisasi;
                $nonres_permintaan =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->nonres_permintaan;
                $nonres_realisasi =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->nonres_realisasi;
                $it_permintaan =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->it_permintaan;
                $it_realisasi =  $this->mdl_sarfas->get_aktivitas_by_course($row['id'])->row()->it_realisasi;
            } else {
                $atk_permintaan = '';
                $atk_realisasi = '';
                $hk_permintaan = '';
                $hk_realisasi = '';
                $res_permintaan = '';
                $res_realisasi = '';
                $nonres_permintaan = '';
                $nonres_realisasi = '';
                $it_permintaan = '';
                $it_realisasi = '';
            }
            if ($this->mdl_sarfas->get_aktivitas_by_course($row['id'])->num_rows() <> 0) {
                $data['modal_lihat_aktivitas_sarfas'] .= $this->editor->modal_lihat_aktivitas_sarfas($row['id']);
                $lihat_aktivitas =  anchor('#modal_lihat_aktivitas_sarfas' . $row['id'], 'Lihat', array('data-toggle' => 'modal', 'class' => 'label label-success'));

                $status_aktivitas = 1;
            } else {
                $lihat_aktivitas =  anchor('#modal_aktivitas_sarfas' . $row['id'], 'Tambah', array('data-toggle' => 'modal', 'class' => 'label label-warning'));
                $status_aktivitas = 0;
            }

            $data['modal_aktivitas_sarfas'] .= $this->editor->modal_aktivitas_sarfas($row['id']);



            if ($this->mdl_course->get_memo_by_course($row['id'], 1)->num_rows() == 0) {
                $list_memo_masuk = '';
                $status_memo_masuk = 0;
            } else {
                $data_memo =  $this->mdl_course->get_memo_by_course($row['id'], 1)->result_array();
                $list_memo_masuk = '';
                $status_memo_masuk = 1;
                foreach ($data_memo as $memo) {
                    $list_memo_masuk .=  anchor('assets/uploads/course/' . $memo['memo_sarfas'], 'Download', array('class' => 'label label-success')) . '<br>';
                }
            }

            if ($this->mdl_course->get_memo_by_course($row['id'], 2)->num_rows() == 0) {
                $list_memo_keluar = '';
                $status_memo_keluar = 0;
            } else {
                $data_memo_keluar =  $this->mdl_course->get_memo_by_course($row['id'], 2)->result_array();
                $list_memo_keluar = '';
                $status_memo_keluar = 1;
                foreach ($data_memo_keluar as $memo_keluar) {
                    $list_memo_keluar .=  anchor('assets/uploads/course/' . $memo_keluar['memo_sarfas'], 'Download', array('class' => 'label label-success')) . '<br>';
                }
            }

            $data['location'] .= $this->editor->tambah_lokasi($row['id'], $offset);
            if (is_numeric($row['class'])) {
                //             $location=  anchor('#tambah_lokasi'.$row['id'], 'Pilih', array('class'=>'label label-info','data-toggle'=>'modal'));  
                $location =  $this->mdl_sarfas->get_class_by_id($row['class'])->row()->class_name;
            } else {
                $location = $row['class'];
            }
            $masuk = 1;
            $keluar = 2;
            $data['add_memo_masuk'] .= $this->editor->modal_add_memo($row['id'], 1);
            $data['add_memo_keluar'] .= $this->editor->modal_add_memo($row['id'], 2);
            $add_memo_masuk =  anchor('#add_memo' . $row['id'] . $masuk, '<i class="icon-upload icon-white"></i>Upload', array('class' => 'label label-info', 'data-toggle' => 'modal'));
            $add_memo_keluar =  anchor('#add_memo' . $row['id'] . $keluar, '<i class="icon-upload icon-white"></i>Upload', array('class' => 'label label-info', 'data-toggle' => 'modal'));

            $edit =  anchor('sarfas/edit_kegiatan/' . $row['id'], 'Edit', array('class' => 'label'));
            $hapus =  anchor('sarfas/delete_kegiatan/' . $row['id'], 'Hapus', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')", 'class' => 'label label-important'));
            //     $pic=$this->mdl_course->get_function_by_id($row['plc_function_id'])->row()->name;

            if (($status_memo_masuk == 0) || ($status_memo_keluar == 0) || ($status_aktivitas == 0)) {
                $status = '<span class="label label-warning">Progress</span>';
            } else {
                $status = '<span class="label label-info">Close</span>';
            }
            $this->table->add_row(
                ++$i,
                $row['jenis'],
                $row['activity'],
                $this->editor->date_correct($row['start_date']) . ' s/d ' . $this->editor->date_correct($row['end_date']),
                $location,
                $list_memo_masuk . $add_memo_masuk,
                $list_memo_keluar . $add_memo_keluar,
                $lihat_aktivitas,
                $status,
                $edit,
                $hapus
            );
        }

        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-condensed table-striped">'));
        $data['course'] = $this->table->generate();
        $this->template->display('sarfas/index', $data);
    }

    function add_memo($id, $status)
    {

        $this->upload->initialize(array(
            'upload_path' => './assets/uploads/course/',
            'allowed_types' => '*',
            'max_size' => 5000, // 5MB
            'remove_spaces' => true,
            'overwrite' => false
        ));

        if ($this->upload->do_upload('upload_memo')) {

            $this->upload->do_upload('upload_memo');
            $unggah = $this->upload->data();
            $unggah['file_name'];
            $data_memo = $unggah['file_name'];

            $memo = array(
                'course_id' => $id,
                'memo_sarfas' => $data_memo,
                'memo_sarfas_status' => $status
            );

            $this->mdl_course->add_memo($memo);
        }
        redirect('sarfas');
    }

    function add_schedule()
    {
        $data['title'] = 'Tambah Jadwal Kegiatan';
        $data['link_back'] =  site_url('sarfas/index');
        $data['action'] = 'sarfas/add_schedule';
        $this->_set_rules_schedule();
        if ($this->form_validation->run() == FALSE) {
            $data['schedule']['activity'] = '';
            $data['schedule']['start_date'] = '';
            $data['schedule']['end_date'] = '';
            $data['schedule']['pic'] = '';
            $opt_class = $this->mdl_sarfas->get_class();
            $data['options_class'] = '';
            foreach ($opt_class->result_array() as $row_class) {
                $data['options_class'] .= '<option value="' . $row_class['id'] . '">' . $row_class['class_name'] . '</option>';
            }
            $this->template->display('sarfas/schedule_form', $data);
        } else {
            $start_date =  $this->input->post('start_date');
            $bulan =  date('m',  strtotime($start_date));
            $tahun =  date('Y',  strtotime($start_date));
            if ($this->input->post('kelas') == 19) {
                $kelas =  $this->input->post('other');
                $status = 1;
            } else {
                $kelas =  $this->input->post('kelas');
                $status = 0;
            }
            $schedule = array(
                'jenis' =>  $this->input->post('jenis'),
                'activity' =>  $this->input->post('activity'),
                'class' =>  $kelas,
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'pic' =>  $this->input->post('pic'),
                'color' =>  '#' . $this->input->post('color'),
                'ket' => $this->input->post('ket'),
                'status' => $status,
                'insert_date' => date('Y-m-d G:i:s')
            );
            $this->mdl_sarfas->add_schedule($schedule);
            redirect('sarfas');
            //  redirect('sarfas/get_jadwal_kelas/'.$bulan.'/'.$tahun);  
        }
    }

    function check_jadwal()
    {
        $start_date =  $this->input->post('start_date');
        $end_date =  $this->input->post('end_date');
        $kelas = $this->input->post('kelas');

        $hari = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
        $jml_hari = $hari + 1;
        $b = 0;

        $check = $this->mdl_sarfas->check_jadwal($kelas)->result_array();
        foreach ($check as $row) {
            $tgl_mulai = $row['start_date'];
            $tgl_selesai = $row['end_date'];
            $days = (strtotime($tgl_selesai) - strtotime($tgl_mulai)) / (60 * 60 * 24);
            $jml_day = $days + 1;

            for ($a = 1; $a <= $jml_day; $a++) {
                $tanggal_db = date("Y-m-d", strtotime("$tgl_mulai +$a days"));
                for ($d = 1; $d <= $jml_hari; $d++) {
                    $tanggal_cek = date("Y-m-d", strtotime("$start_date +$d days"));

                    if ($tanggal_cek == $tanggal_db) {
                        $b = $b + 1;
                    }
                }
            }
        }


        if ($b > 0) {
            echo 0;
        } else {
            echo 1;
        }
    }

    function jadwal_check()
    {
        $start_date =  $this->input->post('date_start');
        $end_date =  $this->input->post('date_end');
        $kelas = $this->input->post('kel');

        $hari = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
        $jml_hari = $hari + 1;
        $b = 0;

        $check = $this->mdl_sarfas->check_jadwal($kelas)->result_array();
        foreach ($check as $row) {
            $tgl_mulai = $row['start_date'];
            $tgl_selesai = $row['end_date'];
            $days = (strtotime($tgl_selesai) - strtotime($tgl_mulai)) / (60 * 60 * 24);
            $jml_day = $days + 1;

            for ($a = 1; $a <= $jml_day; $a++) {
                $tanggal_db = date("Y-m-d", strtotime("$tgl_mulai +$a days"));
                for ($d = 1; $d <= $jml_hari; $d++) {
                    $tanggal_cek = date("Y-m-d", strtotime("$start_date +$d days"));

                    if ($tanggal_cek == $tanggal_db) {
                        $b = $b + 1;
                    }
                }
            }
        }


        if ($b > 0) {
            echo 0;
        } else {
            echo 1;
        }
    }

    function _set_rules_schedule()
    {
        $this->form_validation->set_rules('activity', 'Kegiatan', 'required|trim');
    }

    function lihat_schedule()
    {
        $data['title'] = 'Jadwal Ruangan Kelas';

        $this->template->display('sarfas/schedule_calendar', $data);
    }

    function schedule_detail($id)
    {
        $data['title'] = 'Detail Jadwal';
        $schedule = $this->mdl_sarfas->get_schedule_by_id($id)->result();
        foreach ($schedule as $row) {
            $data['activity'] = $row->activity;
            $data['class'] =  $this->mdl_sarfas->get_class_by_id($row->class)->row()->class_name;
            $data['start_date'] =  $this->editor->date_correct($row->start_date);
            $data['end_date'] =  $this->editor->date_correct($row->end_date);
        }

        $this->template->display('sarfas/schedule_detail', $data);
    }
    function get_jadwal_kelas($bulan = null, $tahun = null)
    {
        if ($bulan == NULL | $tahun == NULL) {
            $bulan =  date('m');
            $tahun =  date('Y');
        }
        if ($bulan == 0) {
            $bulan = 12;
            $tahun = $tahun - 1;
        }


        if ($bulan == 13) {
            $bulan = 1;
            $tahun = $tahun + 1;
        }


        $data = array();
        $jadwal = $this->mdl_sarfas->get_jadwal_by($bulan, $tahun)->result_array();

        // die('masuk');
        for ($b = 1; $b <= 31; $b++) {
            $data['class'][1][$b] = '';
            $data['class'][2][$b] = '';
            $data['class'][3][$b] = '';
            $data['class'][4][$b] = '';
            $data['class'][5][$b] = '';
            $data['class'][6][$b] = '';
            $data['class'][7][$b] = '';
            $data['class'][8][$b] = '';
            $data['class'][9][$b] = '';
            $data['class'][10][$b] = '';
            $data['class'][11][$b] = '';
            $data['class'][12][$b] = '';
            $data['class'][13][$b] = '';
            $data['class'][14][$b] = '';
            $data['class'][15][$b] = '';
            $data['class'][16][$b] = '';
            $data['class'][17][$b] = '';
            $data['class'][18][$b] = '';
            $data['class'][30][$b] = '';
            $data['class'][31][$b] = '';
            $data['class'][32][$b] = '';
            $data['class'][33][$b] = '';
            $data['class'][34][$b] = '';
            $data['class'][35][$b] = '';
            $data['class'][36][$b] = '';
            $data['class'][37][$b] = '';

            //Kegiatan
            $data['kegiatan'][1][$b] = '';
            $data['kegiatan'][2][$b] = '';
            $data['kegiatan'][3][$b] = '';
            $data['kegiatan'][4][$b] = '';
            $data['kegiatan'][5][$b] = '';
            $data['kegiatan'][6][$b] = '';
            $data['kegiatan'][7][$b] = '';
            $data['kegiatan'][8][$b] = '';
            $data['kegiatan'][9][$b] = '';
            $data['kegiatan'][10][$b] = '';
            $data['kegiatan'][11][$b] = '';
            $data['kegiatan'][12][$b] = '';
            $data['kegiatan'][13][$b] = '';
            $data['kegiatan'][14][$b] = '';
            $data['kegiatan'][15][$b] = '';
            $data['kegiatan'][16][$b] = '';
            $data['kegiatan'][17][$b] = '';
            $data['kegiatan'][18][$b] = '';
            $data['kegiatan'][30][$b] = '';
            $data['kegiatan'][31][$b] = '';
            $data['kegiatan'][32][$b] = '';
            $data['kegiatan'][33][$b] = '';
            $data['kegiatan'][34][$b] = '';
            $data['kegiatan'][35][$b] = '';
            $data['kegiatan'][36][$b] = '';
            $data['kegiatan'][37][$b] = '';


            $data['detail'] = '';
        }
        $data['ket'] = '';

        foreach ($jadwal as $row) {
            //            echo "<pre>";
            $bln_awal = date('m', strtotime($row['start_date']));
            $bln_ahir = date('m', strtotime($row['end_date']));

            if ($bulan == $bln_awal && $bulan == $bln_ahir) {
                $tgl_awal = date('d', strtotime($row['start_date']));
                $tgl_ahir = date('d', strtotime($row['end_date']));
            } elseif ($bulan > $bln_awal) {
                $tgl_awal = 1;
                $tgl_ahir = date('d', strtotime($row['end_date']));
            } elseif ($bln_ahir > $bulan) {
                $tgl_awal = date('d', strtotime($row['start_date']));
                $tgl_ahir = date('t', strtotime($row['end_date']));
            }

            // print_r($tgl_awal);
            // print_r($tgl_ahir);
            for ($a = (int)$tgl_awal; $a <= $tgl_ahir; $a++) {
                // echo $a;
                $clas = $this->mdl_sarfas->get_class_by_id($row['class'])->row()->class_name;
                $tanggal =  $this->editor->date_correct($row['start_date']) . ' s/d ' .  $this->editor->date_correct($row['end_date']);
                $data['detail'] .= $this->editor->detail_kegiatan($row['id'], $row['activity'], $clas, $row['pic'], $row['color'], $row['ket'], $tanggal);
                $data['class'][$row['class']][$a] = $row['color'];
                $data['kegiatan'][$row['class']][$a] = anchor('#detail' . $row['id'], strtolower(substr($row['activity'], 0, 3)), array('data-toggle' => 'modal'));
            }
            $data['ket'] .= strtolower(substr($row['activity'], 0, 3)) . ' = ' . $row['activity'] . '<br>';
        }

        $opt_class = $this->mdl_sarfas->get_class();
        $data['options_class'] = '';
        foreach ($opt_class->result_array() as $row_class) {
            $data['options_class'] .= '<option value="' . $row_class['id'] . '">' . $row_class['class_name'] . '</option>';
        }

        $data['title'] = 'Jadwal Ruangan Kelas';
        $data['action'] = 'sarfas/add_schedule';
        $next_bulan = $bulan + 1;
        $prev_bulan = $bulan - 1;
        $data['tambah_kegiatan'] =  anchor('#tambah_kegiatan', 'Tambah Kegiatan', array('class' => 'btn btn-success', 'data-toggle' => 'modal'));
        $data['bulan_sekarang'] =  anchor('sarfas/get_jadwal_kelas', 'Bulan Sekarang', array('class' => 'btn btn-success'));
        $data['bulan'] = anchor('sarfas/get_jadwal_kelas/' . $prev_bulan . '/' . $tahun, '<span class="icon icon-backward"></span>&nbsp;') . $this->editor->conv_bulan($bulan) . ' ' . $tahun . anchor('sarfas/get_jadwal_kelas/' . $next_bulan . '/' . $tahun, '&nbsp;<span class="icon icon-forward"></span>');
        $this->template->display('sarfas/schedule_class', $data);
        //   echo "<pre>";
        // print_r($data);
    }



    function delete_kegiatan($ids)
    {
        $this->mdl_sarfas->delete_kegiatan($ids);
        $this->mdl_sarfas->delete_aktivitas($ids);
        $this->mdl_sarfas->delete_memo($ids);
        redirect('sarfas/sarfas');
    }

    function edit_kegiatan($id)
    {
        $data['title'] = 'Edit Kegiatan';
        $data['action'] = 'sarfas/edit_kegiatan/' . $id;
        $this->_set_rules_schedule();
        if ($this->form_validation->run() == FALSE) {
            $data['kegiatan'] =  $this->mdl_sarfas->get_jadwal_by_id($id)->row_array();

            if (is_numeric($data['kegiatan']['class'])) {

                $data['class'] = 0;
                $select_class = $this->mdl_sarfas->get_jadwal_by_id($id)->row()->class;
                $data['other_class'] = '';
            } else {
                $data['class'] = 1;
                $select_class = 19;
                $data['other_class'] = $this->mdl_sarfas->get_jadwal_by_id($id)->row()->class;
            }
            $opt_class = $this->mdl_sarfas->get_class();
            $data['options_class'] = '';
            foreach ($opt_class->result_array() as $row_class) {
                if ($row_class['id'] == $select_class) {
                    $data['options_class'] .= '<option value="' . $row_class['id'] . '" selected="selected">' . $row_class['class_name'] . '</option>';
                } else {
                    $data['options_class'] .= '<option value="' . $row_class['id'] . '">' . $row_class['class_name'] . '</option>';
                }
            }

            $opt_jenis = array(
                'LDT' => 'LDT',
                'Ad-Hoc' => 'Ad-Hoc',
                'BPS/BPA' => 'BPS/BPA',
                'GFT' => 'GFT',
                'Workshop' => 'Workshop',
                'Rapat' => 'Rapat',
                'HSE' => 'HSE',
                'Academy MNT' => 'Academy MNT',
                'Academy Refinery' => 'Academy Refinery',
                'Academy Upstream' => 'Academy Upstream',
                'Academy Leadership' => 'Academy Leadership',
                'Academy Support' => 'Academy Support',
                'Lainnya' => 'Lainnya'
            );




            $jenis = $this->mdl_sarfas->get_jadwal_by_id($id)->row()->jenis;
            $data['options_jenis'] = form_dropdown('jenis', $opt_jenis, $jenis);
            $this->template->display('sarfas/schedule_form', $data);
        } else {
            $start_date =  $this->input->post('start_date');
            $bulan =  date('m',  strtotime($start_date));
            $tahun =  date('Y',  strtotime($start_date));
            if ($this->input->post('kelas') == 19) {
                $kelas =  $this->input->post('other');
                $status = 1;
            } else {
                $kelas =  $this->input->post('kelas');
                $status = 0;
            }

            $schedule = array(
                'jenis' =>  $this->input->post('jenis'),
                'activity' =>  $this->input->post('activity'),
                'class' =>  $kelas,
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'pic' =>  $this->input->post('pic'),
                'color' =>  '#' . $this->input->post('color'),
                'ket' => $this->input->post('ket'),
                'status' => $status,
                'insert_date' => date('Y-m-d G:i:s')
            );
            $this->mdl_sarfas->edit_kegiatan($id, $schedule);
            // redirect('sarfas/get_jadwal_kelas/'.$bulan.'/'.$tahun); 
            redirect('sarfas');
        }
    }


    function add_aktivitas($id)
    {
        if ($this->input->post('atk_tidak_ada') == 'yes') {
            $atk_permintaan = 'Tidak Ada';
            $atk_realisasi = 'Tidak Ada';
        } else {
            $atk_permintaan = $this->editor->date_correct($this->input->post('atk_permintaan'));
            $atk_realisasi = $this->editor->date_correct($this->input->post('atk_realisasi'));
        }

        if ($this->input->post('hk_tidak_ada') == 'yes') {
            $hk_permintaan = 'Tidak Ada';
            $hk_realisasi = 'Tidak Ada';
        } else {
            $hk_permintaan = $this->editor->date_correct($this->input->post('hk_permintaan'));
            $hk_realisasi = $this->editor->date_correct($this->input->post('hk_realisasi'));
        }

        if ($this->input->post('res_tidak_ada') == 'yes') {
            $res_permintaan = 'Tidak Ada';
            $res_realisasi = 'Tidak Ada';
        } else {
            $res_permintaan = $this->editor->date_correct($this->input->post('res_permintaan'));
            $res_realisasi = $this->editor->date_correct($this->input->post('res_realisasi'));
        }

        if ($this->input->post('nonres_tidak_ada') == 'yes') {
            $nonres_permintaan = 'Tidak Ada';
            $nonres_realisasi = 'Tidak Ada';
        } else {
            $nonres_permintaan = $this->editor->date_correct($this->input->post('nonres_permintaan'));
            $nonres_realisasi = $this->editor->date_correct($this->input->post('nonres_realisasi'));
        }

        if ($this->input->post('it_tidak_ada') == 'yes') {
            $it_permintaan = 'Tidak Ada';
            $it_realisasi = 'Tidak Ada';
        } else {
            $it_permintaan = $this->editor->date_correct($this->input->post('it_permintaan'));
            $it_realisasi = $this->editor->date_correct($this->input->post('it_realisasi'));
        }


        $aktivitas = array(
            'course_id' => $id,
            'atk_permintaan' => $atk_permintaan,
            'atk_realisasi' => $atk_realisasi,
            'hk_permintaan' => $hk_permintaan,
            'hk_realisasi' => $hk_realisasi,
            'res_permintaan' => $res_permintaan,
            'res_realisasi' => $res_realisasi,
            'nonres_permintaan' => $nonres_permintaan,
            'nonres_realisasi' => $nonres_realisasi,
            'it_permintaan' => $it_permintaan,
            'it_realisasi' => $it_realisasi,
        );
        $this->mdl_sarfas->add_aktivitas($aktivitas);
        redirect('sarfas');
    }

    function gl_front($offset = 0)
    {
        $data['title'] = 'Guanrantee Letter';
        $data['tambah'] =  anchor('sarfas/gl', 'Tambah', array('class' => 'btn btn-success'));
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        /* Pagination */
        $config['base_url'] = site_url('sarfas/gl_front/');
        $config['total_rows'] = $this->mdl_sarfas->count_gl();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
            'No',
            'Tanggal',
            'Kepada',
            'Dari',
            'Judul Program',
            array('data' => 'Action', 'rowspan' => 4)
        );
        $q = $this->mdl_sarfas->get_gl($this->limit, $offset)->result_array();
        $i = 0 + $offset;
        foreach ($q as $row) {
            $view =  anchor('sarfas/view_gl/' . $row['id'], '<i class="icon-search"></i>', array('rel' => 'tooltip', 'title' => 'View', 'class' => "fancybox fancybox.iframe"));
            $edit =  anchor('sarfas/edit_gl/' . $row['id'], '<i class="icon-wrench"></i>', array('rel' => 'tooltip', 'title' => 'Edit'));
            $delete =  anchor('sarfas/delete_gl/' . $row['id'] . '/' . $offset, '<i class="icon-trash"></i>', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')", 'rel' => 'tooltip', 'title' => 'Delete'));
            $pdf =  anchor('sarfas/gl_pdf/' . $row['id'], '<i class="icon-print"></i>', array('target' => '_blank', 'class' => 'new_window', 'rel' => 'tooltip', 'title' => 'Delete'));
            $this->table->add_row(
                ++$i,
                $this->editor->date_correct($row['tanggal']),
                $row['kepada'],
                $row['dari'],
                $row['judul_program'],
                array('data' => $view, 'width' => 10),
                array('data' => $edit, 'width' => 10),
                array('data' => $delete, 'width' => 10),
                array('data' => $pdf, 'width' => 10)
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('sarfas/gl_index', $data);
    }

    function gl()
    {
        $data['title'] = 'Tambah Guarantee Letter';
        $data['action'] = 'sarfas/gl';
        $this->__set_rules_gl();
        if ($this->form_validation->run() == FALSE) {
            $this->template->display('sarfas/form_gl', $data);
        } else {
            $refreshment = $this->input->post('refreshment');
            for ($a = 0; $a < count($refreshment); $a++) {
                $ref .= $refreshment[$a] . '@';
            }
            $pemberian = $this->input->post('pemberian');
            for ($b = 0; $b < count($pemberian); $b++) {
                $pemb .= $pemberian[$b] . '@';
            }

            $gl = array(
                'no_gl' =>  $this->input->post('no_gl'),
                'tanggal' =>  $this->input->post('tanggal'),
                'kepada' =>  $this->input->post('kepada'),
                'dari' =>  $this->input->post('dari'),
                'no_fax' =>  $this->input->post('no_fax'),
                'judul_program' =>  $this->input->post('judul_program'),
                'kode_program' =>  $this->input->post('kode_program'),
                'tgl_pelaksanaan' =>  $this->input->post('tgl_pelaksanaan'),
                'durasi' =>  $this->input->post('durasi'),
                'waktu' =>  $this->input->post('waktu'),
                'tempat' =>  $this->input->post('tempat'),
                'sifat' =>  $this->input->post('sifat'),
                'rm_kapasitas' =>  $this->input->post('rm_kapasitas'),
                'rm_perlengkapan' =>  $this->input->post('rm_perlengkapan'),
                'rm_layout' =>  $this->input->post('rm_layout'),
                'rm_keterangan' =>  $this->input->post('rm_keterangan'),
                'bc_ukuran_ruangan' =>  $this->input->post('bc_ukuran_ruangan'),
                'bc_perlengkapan' =>  $this->input->post('bc_perlengkapan'),
                'bc_keterangan' =>  $this->input->post('bc_keterangan'),
                'akomodasi_peserta' => $this->input->post('kamar_pes') . '#' . $this->input->post('type_pes') . '#' . $this->input->post('check_in_pes') . '#' . $this->input->post('check_out_pes'),
                'akomodasi_instruktur' => $this->input->post('kamar_ins') . '#' . $this->input->post('type_ins') . '#' . $this->input->post('check_in_ins') . '#' . $this->input->post('check_out_ins'),
                'akomodasi_keterangan' =>  $this->input->post('akomodasi_keterangan'),
                'meal_breakfast' =>  $this->input->post('meal_breakfast'),
                'meal_launch' =>  $this->input->post('meal_lunch'),
                'meal_dinner' =>  $this->input->post('meal_dinner'),
                'cb_jumlah' =>  $this->input->post('cb_jumlah'),
                'cb_frekuansi' =>  $this->input->post('cb_frekuensi'),
                'cb_waktu_pemberian' => $pemb,
                'refreshment_diruangan' => $ref,
                'konsumsi_ket' =>  $this->input->post('konsumsi_ket'),
                'trans_jenis_kendaraan' =>  $this->input->post('trans_jenis_kendaraan'),
                'trans_tanggal' =>  $this->input->post('trans_tanggal'),
                'trans_waktu' =>  $this->input->post('trans_waktu'),
                'tk_tas_ransel' =>  $this->input->post('tk_tas_ransel'),
                'tk_block_note' =>  $this->input->post('tk_block_note'),
                'tk_ballpoint' =>  $this->input->post('tk_ballpoint'),
                'tk_flashdisk' =>  $this->input->post('tk_flashdisk'),
                'tk_cd' =>  $this->input->post('tk_cd'),
                'tk_dvd' =>  $this->input->post('tk_dvd'),
                'tk_lainnya' =>  $this->input->post('tk_lainnya'),
                'cost_center' =>  $this->input->post('cost_center'),
                'cost_element' =>  $this->input->post('cost_element')
            );

            $this->mdl_sarfas->add_gl($gl);
            redirect('sarfas/gl_front');
        }
    }
    function gl_edit($id)
    {
        $refreshment = $this->input->post('refreshment');
        for ($a = 0; $a < count($refreshment); $a++) {
            $ref .= $refreshment[$a] . '@';
        }
        $pemberian = $this->input->post('pemberian');
        for ($b = 0; $b < count($pemberian); $b++) {
            $pemb .= $pemberian[$b] . '@';
        }

        $gl_edit = array(
            'no_gl' =>  $this->input->post('no_gl'),
            'tanggal' =>  $this->input->post('tanggal'),
            'kepada' =>  $this->input->post('kepada'),
            'dari' =>  $this->input->post('dari'),
            'no_fax' =>  $this->input->post('no_fax'),
            'judul_program' =>  $this->input->post('judul_program'),
            'kode_program' =>  $this->input->post('kode_program'),
            'tgl_pelaksanaan' =>  $this->input->post('tgl_pelaksanaan'),
            'durasi' =>  $this->input->post('durasi'),
            'waktu' =>  $this->input->post('waktu'),
            'tempat' =>  $this->input->post('tempat'),
            'sifat' =>  $this->input->post('sifat'),
            'rm_kapasitas' =>  $this->input->post('rm_kapasitas'),
            'rm_perlengkapan' =>  $this->input->post('rm_perlengkapan'),
            'rm_layout' =>  $this->input->post('rm_layout'),
            'rm_keterangan' =>  $this->input->post('rm_keterangan'),
            'bc_ukuran_ruangan' =>  $this->input->post('bc_ukuran_ruangan'),
            'bc_perlengkapan' =>  $this->input->post('bc_perlengkapan'),
            'bc_keterangan' =>  $this->input->post('bc_keterangan'),
            'akomodasi_peserta' => $this->input->post('kamar_pes') . '#' . $this->input->post('type_pes') . '#' . $this->input->post('check_in_pes') . '#' . $this->input->post('check_out_pes'),
            'akomodasi_instruktur' => $this->input->post('kamar_ins') . '#' . $this->input->post('type_ins') . '#' . $this->input->post('check_in_ins') . '#' . $this->input->post('check_out_ins'),
            'akomodasi_keterangan' =>  $this->input->post('akomodasi_keterangan'),
            'meal_breakfast' =>  $this->input->post('meal_breakfast'),
            'meal_launch' =>  $this->input->post('meal_lunch'),
            'meal_dinner' =>  $this->input->post('meal_dinner'),
            'cb_jumlah' =>  $this->input->post('cb_jumlah'),
            'cb_frekuansi' =>  $this->input->post('cb_frekuensi'),
            'cb_waktu_pemberian' => $pemb,
            'refreshment_diruangan' => $ref,
            'konsumsi_ket' =>  $this->input->post('konsumsi_ket'),
            'trans_jenis_kendaraan' =>  $this->input->post('trans_jenis_kendaraan'),
            'trans_tanggal' =>  $this->input->post('trans_tanggal'),
            'trans_waktu' =>  $this->input->post('trans_waktu'),
            'tk_tas_ransel' =>  $this->input->post('tk_tas_ransel'),
            'tk_block_note' =>  $this->input->post('tk_block_note'),
            'tk_ballpoint' =>  $this->input->post('tk_ballpoint'),
            'tk_flashdisk' =>  $this->input->post('tk_flashdisk'),
            'tk_cd' =>  $this->input->post('tk_cd'),
            'tk_dvd' =>  $this->input->post('tk_dvd'),
            'tk_lainnya' =>  $this->input->post('tk_lainnya'),
            'cost_center' =>  $this->input->post('cost_center'),
            'cost_element' =>  $this->input->post('cost_element')
        );

        $this->mdl_sarfas->edit_gl($id, $gl_edit);
        redirect('sarfas/gl_front');
    }

    function __set_rules_gl()
    {
        $this->form_validation->set_rules('judul_program', 'Judul Program', 'required|trim');
    }

    function view_gl($id)
    {

        $data['title'] = 'GUARANTEE LETTER';
        $data['kembali'] =  anchor('sarfas/gl_front', 'Kembali', array('class' => 'btn'));
        $data['gl'] =  $this->mdl_sarfas->get_gl_by_id($id)->row_array();
        $peserta =  $this->mdl_sarfas->get_gl_by_id($id)->row()->akomodasi_peserta;
        $instruktur =  $this->mdl_sarfas->get_gl_by_id($id)->row()->akomodasi_instruktur;
        $refreshment =  $this->mdl_sarfas->get_gl_by_id($id)->row()->refreshment_diruangan;
        $pemberian =  $this->mdl_sarfas->get_gl_by_id($id)->row()->cb_waktu_pemberian;
        $akomodasi_peserta =  explode('#', $peserta);
        $akomodasi_instruktur =  explode('#', $instruktur);
        $refresh =  explode('@', $refreshment);
        $wkt_pemberian =  explode('@', $pemberian);
        $data['akomodasi_peserta'] = 'Jumlah Kamar : ' . $akomodasi_peserta[0] . '<br> Type : ' . $akomodasi_peserta[1] . '<br> Check In : ' . $this->editor->date_correct($akomodasi_peserta[2]) . '<br> Check Out : ' . $this->editor->date_correct($akomodasi_peserta[3]);
        $data['akomodasi_instruktur'] = 'Jumlah Kamar : ' . $akomodasi_instruktur[0] . '<br> Type : ' . $akomodasi_instruktur[1] . '<br> Check In : ' . $this->editor->date_correct($akomodasi_instruktur[2]) . '<br> Check Out : ' . $this->editor->date_correct($akomodasi_instruktur[3]);
        $data['waktu_pemberian'] = '';
        $data['refreshment'] = '';
        for ($c = 0; $c < count($refresh); $c++) {
            $data['refreshment'] .= $refresh[$c] . '<br> ';
        }

        for ($d = 0; $d < count($wkt_pemberian); $d++) {
            $data['waktu_pemberian'] .= $wkt_pemberian[$d] . '<br> ';
        }

        $this->template->display('sarfas/view_gl', $data);
    }

    function gl_pdf($id)
    {
        $this->load->library('fpdf');
        $this->fpdf->FPDF('P', 'mm', 'A4');
        $data['gl'] =  $this->mdl_sarfas->get_gl_by_id($id)->row_array();
        $peserta =  $this->mdl_sarfas->get_gl_by_id($id)->row()->akomodasi_peserta;
        $instruktur =  $this->mdl_sarfas->get_gl_by_id($id)->row()->akomodasi_instruktur;
        $refreshment =  $this->mdl_sarfas->get_gl_by_id($id)->row()->refreshment_diruangan;
        $pemberian =  $this->mdl_sarfas->get_gl_by_id($id)->row()->cb_waktu_pemberian;
        $akomodasi_peserta =  explode('#', $peserta);
        $akomodasi_instruktur =  explode('#', $instruktur);
        $refresh =  explode('@', $refreshment);
        $wkt_pemberian =  explode('@', $pemberian);
        $data['waktu_pemberian'] = '';
        $data['refreshment'] = '';
        for ($c = 0; $c < count($refresh); $c++) {
            $data['refreshment'] .= $refresh[$c] . ' | ';
        }

        for ($d = 0; $d < count($wkt_pemberian); $d++) {
            $data['waktu_pemberian'] .= $wkt_pemberian[$d] . ' | ';
        }
        $this->fpdf->AddPage();
        $this->fpdf->Image(site_url('assets/img/logo_pertamina.gif'), 167, 10, 28, 6);
        //$teks = "Ini hasil Laporan PDF menggunakan Library FPDF di CodeIgniter";
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(190, 10, 'GUARANTEE LETTER', '', '', 'L');
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln();
        $this->fpdf->SetLineWidth(0.3);
        $this->fpdf->Cell(20, 5, 'Number');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['no_gl']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(20, 5, 'Date');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $this->editor->date_correct($data['gl']['tanggal']));
        $this->fpdf->Ln();
        $this->fpdf->Cell(20, 5, 'To');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(95, 5, $data['gl']['kepada'], 1, 0, 'L');
        $this->fpdf->Cell(5, 5, ' ');
        $this->fpdf->Cell(20, 5, 'No Fax');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(35, 5, $data['gl']['no_fax'], 1, 0, 'L');
        $this->fpdf->Ln(6);
        $this->fpdf->Cell(20, 5, 'From');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(95, 5, $data['gl']['dari'], 1, 0, 'L');
        $this->fpdf->Cell(5, 5, ' ');
        $this->fpdf->Cell(20, 5, 'No Fax');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(35, 5, $data['gl']['no_fax'], 1, 0, 'L');
        $this->fpdf->Ln();
        $this->fpdf->SetLineWidth(1);
        $this->fpdf->Line(10, 45, 195, 45);
        $this->fpdf->SetLineWidth(0.5);
        $this->fpdf->Line(10, 46, 195, 46);
        $this->fpdf->Ln(8);
        $this->fpdf->SetLineWidth(0.4);
        $this->fpdf->Cell(50, 5, 'Bersama ini Disampaikan bahwa PT. Pertamina(Persero) akan menyelenggarakan program berikut :');
        $this->fpdf->Ln(9);
        $this->fpdf->Cell(20, 5, 'Title');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(105, 5, $data['gl']['judul_program'], 1, 0, 'L');
        $this->fpdf->Cell(5, 5, ' ');
        $this->fpdf->Cell(10, 5, 'Code');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(35, 5, $data['gl']['kode_program'], 1, 0, 'L');
        $this->fpdf->Ln(6);
        $this->fpdf->Cell(20, 5, 'Dates ');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(30, 5,  $this->editor->date_correct($data['gl']['tgl_pelaksanaan']), 1, 0, 'L');
        $this->fpdf->Cell(20, 5, 'Times ', 0, 0, 'C');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['waktu'], 1, 0, 'L');
        $this->fpdf->Cell(20, 5, 'Duration', 0, 0, 'C');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['durasi'] . ' Hari', 1, 0, 'L');
        $this->fpdf->Ln(6);
        $this->fpdf->Cell(20, 5, 'Place');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(105, 5, $data['gl']['tempat'], 1, 0, 'L');
        $this->fpdf->Ln(6);
        $this->fpdf->Cell(20, 5, '');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['sifat'], 1, 0, 'L');
        $this->fpdf->Ln();
        $this->fpdf->Cell(50, 5, 'Mohon dapat disiapkan sarana dan fasililtas sebagai berikut : ');
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Cell(20, 5, '1. Ruang Meeting');
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    Kapasitas');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['rm_kapasitas']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    Perlengkapan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['rm_perlengkapan']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    Layout Ruangan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['rm_layout']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    Keterangan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['rm_keterangan']);
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Cell(20, 5, '2. Business Center');
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    Ukuran Ruangan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['bc_ukuran_ruangan']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    Perlengkapan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['bc_perlengkapan']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    Keterangan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(20, 5, $data['gl']['bc_keterangan']);
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Cell(20, 5, '3. Akomodasi (Khusus Residensial)');
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    => Peserta');
        $this->fpdf->Ln();
        $this->fpdf->Cell(35, 5, '        Jumlah Kamar : ');
        $this->fpdf->Cell(10, 5, $akomodasi_peserta[0], 1, '', 'C');
        $this->fpdf->Cell(13, 5, ' Type : ');
        $this->fpdf->Cell(15, 5, $akomodasi_peserta[1], 1);
        $this->fpdf->Cell(18, 5, ' CheckIn : ');
        $this->fpdf->Cell(25, 5, $this->editor->date_correct($akomodasi_peserta[2]), 1);
        $this->fpdf->Cell(20, 5, ' CheckOut : ');
        $this->fpdf->Cell(25, 5, $this->editor->date_correct($akomodasi_peserta[3]), 1);
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    => Instruktur');
        $this->fpdf->Ln();
        $this->fpdf->Cell(35, 5, '        Jumlah Kamar : ');
        $this->fpdf->Cell(10, 5, $akomodasi_instruktur[0], 1, '', 'C');
        $this->fpdf->Cell(13, 5, ' Type : ');
        $this->fpdf->Cell(15, 5, $akomodasi_peserta[1], 1);
        $this->fpdf->Cell(18, 5, ' CheckIn : ');
        $this->fpdf->Cell(25, 5, $this->editor->date_correct($akomodasi_instruktur[2]), 1);
        $this->fpdf->Cell(20, 5, ' CheckOut : ');
        $this->fpdf->Cell(25, 5, $this->editor->date_correct($akomodasi_instruktur[3]), 1);
        $this->fpdf->Ln();
        $this->fpdf->Cell(35, 5, '        Keterangan      :');
        $this->fpdf->Cell(150, 5, $data['gl']['akomodasi_keterangan']);
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Cell(20, 5, '4. Konsumsi');
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    a). Meal');
        $this->fpdf->Ln();
        $this->fpdf->Cell(28, 5, '        Breakfast');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(100, 5, $data['gl']['meal_breakfast']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(28, 5, '        Lunch');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(100, 5, $data['gl']['meal_launch']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(28, 5, '        Dinner');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(100, 5, $data['gl']['meal_dinner']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(28, 5, '        Keterangan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(150, 5, $data['gl']['konsumsi_ket']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(33, 5, '    b). Cofee Break');
        $this->fpdf->Ln();
        $this->fpdf->Cell(28, 5, '        Jumlah');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(100, 5, $data['gl']['cb_jumlah']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(28, 5, '        Frekuensi');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(100, 5, $data['gl']['cb_frekuansi']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(48, 5, '        Waktu Pemberian');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(150, 5, $data['waktu_pemberian']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(48, 5, '        Refreshment di Ruangan ');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(150, 5, $data['refreshment']);
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Cell(20, 5, '5. Transportasi');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Jenis Kendaraan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['trans_jenis_kendaraan']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Tanggal Penggunaan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $this->editor->date_correct($data['gl']['trans_tanggal']));
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Waktu Penggunaan');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['trans_waktu']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(20, 5, '6. Training Kit');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Tas Ransel');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['tk_tas_ransel'] . ' pcs');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Block Note');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['tk_block_note'] . ' pcs');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Ballpoint');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['tk_ballpoint'] . ' pcs');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Flashdisk');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['tk_flashdisk'] . ' pcs');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Keping CD');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['tk_cd'] . ' pcs');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Keping DVD');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['tk_dvd'] . ' pcs');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Lainnya');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['tk_lainnya'] . ' pcs');
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Cost Center');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['cost_center']);
        $this->fpdf->Ln();
        $this->fpdf->Cell(40, 5, '    Cost Element');
        $this->fpdf->Cell(5, 5, ':');
        $this->fpdf->Cell(50, 5, $data['gl']['cost_element']);
        $this->fpdf->Ln();

        $this->fpdf->Output();
    }

    public function pdf_report($id)
    {
        $this->load->helper('dompdf');   //  Load helper
        $data = file_get_contents(site_url('sarfas/view_gl/' . $id)); // Pass the url of html report
        create_pdf($data); //Create pdf
    }


    function edit_gl($id)
    {
        $data['title'] = 'EDIT GUARANTEE LETTER';
        $data['kembali'] =  anchor('sarfas/gl_front', 'Kembali', array('class' => 'btn'));
        $data['action'] = 'sarfas/gl_edit/' . $id;
        $data['gl'] =  $this->mdl_sarfas->get_gl_by_id($id)->row_array();
        $peserta =  $this->mdl_sarfas->get_gl_by_id($id)->row()->akomodasi_peserta;
        $instruktur =  $this->mdl_sarfas->get_gl_by_id($id)->row()->akomodasi_instruktur;
        $refreshment =  $this->mdl_sarfas->get_gl_by_id($id)->row()->refreshment_diruangan;
        $pemberian =  $this->mdl_sarfas->get_gl_by_id($id)->row()->cb_waktu_pemberian;
        $akomodasi_peserta =  explode('#', $peserta);
        $akomodasi_instruktur =  explode('#', $instruktur);
        $refresh =  explode('@', $refreshment);
        $wkt_pemberian =  explode('@', $pemberian);

        $data['kamar_pes'] = $akomodasi_peserta[0];
        $data['type_pes'] = $akomodasi_peserta[1];
        $data['check_in_pes'] = $akomodasi_peserta[2];
        $data['check_out_pes'] = $akomodasi_peserta[3];

        $data['kamar_ins'] = $akomodasi_instruktur[0];
        $data['type_ins'] = $akomodasi_instruktur[1];
        $data['check_in_ins'] = $akomodasi_instruktur[2];
        $data['check_out_ins'] = $akomodasi_instruktur[3];

        if (!empty($wkt_pemberian[0])) {
            $data['pemberian1'] = $wkt_pemberian[0];
        } else {
            $data['pemberian1'] = '';
        }
        if (!empty($wkt_pemberian[1])) {
            $data['pemberian2'] = $wkt_pemberian[1];
        } else {
            $data['pemberian2'] = '';
        }
        if (!empty($wkt_pemberian[2])) {
            $data['pemberian3'] = $wkt_pemberian[2];
        } else {
            $data['pemberian3'] = '';
        }
        if (!empty($refresh[0])) {
            $data['refreshment1'] = $refresh[0];
        } else {
            $data['refreshment1'] = '';
        }
        if (!empty($refresh[1])) {
            $data['refreshment2'] = $refresh[1];
        } else {
            $data['refreshment2'] = '';
        }
        $this->template->display('sarfas/form_edit_gl', $data);
    }

    function delete_gl($id, $offset)
    {
        $this->mdl_sarfas->delete_gl($id);
        redirect('sarfas/gl_front/' . $offset);
    }

    function tambah_lokasi($id, $offset)
    {
        $lokasi = array(
            'location' =>  $this->input->post('location')
        );

        $this->mdl_course->update($id, $lokasi);
        redirect('sarfas/index/' . $offset);
    }



    function add_peminjaman_laptop()
    {
        $data['title'] = 'Form Peminjaman Laptop';
        $data['action'] = 'sarfas/post_peminjaman_laptop';
        $this->template->display('sarfas/form_peminjaman_laptop', $data);
    }

    function update_status_laptop($laptop, $var)
    {
        $ex_laptop =  explode("#", $laptop);
        for ($i = 0; $i < count($ex_laptop); $i++) {
            $this->mdl_laptop->update_status($ex_laptop[$i], $var);
        }
    }

    function list_laptop($laptop)
    {
        $ex_laptop =  explode("#", $laptop);
        $list = '';
        for ($i = 0; $i < count($ex_laptop); $i++) {
            $list .=  anchor('laptop/detail/' . $ex_laptop[$i], $this->mdl_laptop->get_by_id($ex_laptop[$i])->row()->no_asset, array('class' => 'label label-info')) . ' ';
        }
        return $list;
    }

    function post_peminjaman_laptop()
    {
        $laptop = $this->input->post('laptop');
        if ($laptop != 0) {
            $laptop = implode('#', $laptop);
        } else {
            $laptop = '';
        }

        $this->update_status_laptop($laptop, 0);
        $peminjaman = array(
            'nopeg' =>  $this->input->post('nopeg'),
            'nama' =>  $this->input->post('nama'),
            'telp' =>  $this->input->post('telp'),
            'fungsi' =>  $this->input->post('fungsi'),
            'id_laptop' => $laptop,
            'perangkat_laptop' =>  $this->input->post('perangkat_laptop'),
            'keperluan' =>  $this->input->post('keperluan'),
            'tgl_peminjaman' =>  $this->input->post('tgl_peminjaman'),
            'tgl_kembali' =>  $this->input->post('tgl_kembali'),
            'catatan' =>  $this->input->post('catatan'),
            'insert_date' =>  date('Y-m-h G:i:s')
        );
        $this->mdl_sarfas->add_peminjaman_laptop($peminjaman);
        redirect('sarfas/list_peminjaman_laptop');
    }

    function update_peminjaman_laptop($id)
    {
        if ($this->input->post('tgl_pengembalian') != "") {
            $this->mdl_sarfas->update_status_peminjaman_laptop($id, 1);
            $laptop = $this->mdl_sarfas->get_laptop_by($id)->row()->id_laptop;
            $this->update_status_laptop($laptop, 1);
        }
        $peminjaman = array(
            'nopeg' =>  $this->input->post('nopeg'),
            'nama' =>  $this->input->post('nama'),
            'telp' =>  $this->input->post('telp'),
            'fungsi' =>  $this->input->post('fungsi'),
            'merk_laptop' =>  $this->input->post('merk_laptop'),
            'no_asset' =>  $this->input->post('no_asset'),
            'no_seri' =>  $this->input->post('no_seri'),
            'jumlah' =>  $this->input->post('jumlah'),
            'perangkat_laptop' =>  $this->input->post('perangkat_laptop'),
            'keperluan' =>  $this->input->post('keperluan'),
            'tgl_peminjaman' =>  $this->input->post('tgl_peminjaman'),
            'tgl_kembali' =>  $this->input->post('tgl_kembali'),
            'tgl_pengembalian' =>  $this->input->post('tgl_pengembalian'),
            'catatan' =>  $this->input->post('catatan'),
            'update_date' =>  date('Y-m-h G:i:s')
        );

        $this->mdl_sarfas->update_peminjaman_laptop($id, $peminjaman);
        redirect('sarfas/list_peminjaman_laptop');
    }

    function delete_peminjaman_laptop($id)
    {
        $laptop = $this->mdl_sarfas->get_laptop_by($id)->row()->id_laptop;
        $this->update_status_laptop($laptop, 1);
        $this->mdl_sarfas->delete_peminjaman_laptop($id);
        redirect('sarfas/list_peminjaman_laptop');
    }

    function list_peminjaman_laptop($back = 0, $offset = 0)
    {
        $data['title'] = 'Data Peminjaman Laptop';
        $this->load->library('pagination');

        $config['base_url'] =  site_url('sarfas/list_peminjaman_laptop/' . $back);
        $config['total_rows'] =  $this->mdl_sarfas->count_laptop();
        $config['per_page'] =  $this->limit;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['refresh'] = anchor('sarfas/list_peminjaman_laptop', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class' => 'btn btn-info'));
        $data['action'] = 'sarfas/list_peminjaman_laptop';
        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
            'No',
            'Nopeg',
            'Nama',
            'Fungsi',
            'No Seri',
            'Tgl Pinjam',
            'Tgl Kembali',
            'Keperluan',
            'Status',
            ''
        );
        $nopek =  $this->input->post('nopek');
        $nama =  $this->input->post('nama');
        $status =  $this->input->post('status');

        $i = $offset + 0;
        $query =  $this->mdl_sarfas->get_laptop($this->limit, $offset, $nopek, $nama, $status)->result_array();
        $data['detail_laptop'] = '';
        $data['edit_laptop'] = '';
        foreach ($query as $row) {
            $detail = anchor('#detail_laptop' . $row['id'], '<span class="label label-success">Detail</span>', array('data-toggle' => 'modal'));
            $edit = anchor('#edit_laptop' . $row['id'], '<span class="label label-success">Edit</span>', array('data-toggle' => 'modal'));
            $delete = anchor('sarfas/delete_peminjaman_laptop/' . $row['id'], 'Hapus', array('class' => 'label label-important', 'onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')"));
            if (!empty($row['tgl_pengembalian']) && $row['status'] == 1) {
                $status = '<span class="label label-success">Sudah Kembali</span><br>' . $this->editor->date_correct($row['tgl_peminjaman']);
            } else {
                $status = '<span class="label label-important">Belum Kembali</span>';
            }
            $data['detail_laptop'] .= $this->editor->detail_laptop($row['id']);
            $data['edit_laptop'] .= $this->editor->edit_laptop($row['id']);

            $this->table->add_row(
                ++$i,
                $row['nopeg'],
                $row['nama'],
                $row['fungsi'],
                $this->list_laptop($row['id_laptop']),
                $this->editor->date_correct($row['tgl_peminjaman']),
                $this->editor->date_correct($row['tgl_kembali']),
                $row['keperluan'],
                $status,
                $detail . '&nbsp;' . $edit . '&nbsp;' . $delete
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('sarfas/list_peminjaman_laptop', $data);
    }

    function list_pelatihan($offset = 0)
    {
        $data['title'] = 'Data Pelatihan';
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        $kd_pelatihan = $this->input->post('kd_pelatihan');
        $batch =  $this->input->post('batch');
        $no_tiket = $this->input->post('no_tiket');
        $tgl_awal =  $this->input->post('tgl_awal');
        $tgl_selesai =  $this->input->post('tgl_selesai');

        /* Pagination */
        $config['base_url'] = site_url('sarfas/list_pelatihan/');
        $config['total_rows'] = $this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan, $batch, $no_tiket, $tgl_awal, $tgl_selesai);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['jml_pelatihan'] = $this->mdl_fgt_pelatihan->count_all_view($kd_pelatihan, $batch, $no_tiket, $tgl_awal, $tgl_selesai);
        $data['action'] = 'sarfas/list_pelatihan';
        $data['refresh'] = anchor('sarfas/list_pelatihan', '<i class="icon icon-refresh icon-white"></i>&nbsp;Reset', array('class' => 'btn btn-info'));

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
            'No',
            'No Tiket',
            'Judul Pelatihan',
            'PIC',
            array('data' => 'Tanggal', 'colspan' => 2),
            'Tempat',
            'Permintaan Sarfas'
        );
        $this->table->add_row(
            array('data' => '', 'colspan' => 4),
            'Mulai',
            'Akhir',
            array('data' => '', 'colspan' => 4)
        );

        $q = $this->mdl_fgt_pelatihan->get_index_sarfas($kd_pelatihan, $batch, $no_tiket, $tgl_awal, $tgl_selesai, $this->limit, $offset)->result_array();
        $i = 0 + $offset;
        foreach ($q as $row) {
            $judul =  $this->mdl_pelatihan->get_by_id($row['kd_pelatihan'])->row()->judul;
            if ($this->mdl_fgt_pelatihan->count_sarfas($row['id']) <= 0) {
                $sarfas =  '';
            } else {
                $sarfas =  $this->cek_sarfas($row['id']);
            }

            if (empty($row['tempat'])) {
                $tempat =  anchor('sarfas/tempat/' . $row['id'], 'Tambah', array('class' => 'label label-important'));
            } else {
                $tempat =  anchor('sarfas/tempat/' . $row['id'], $row['tempat'], array('class' => 'label label-info'));
            }

            $this->table->add_row(
                ++$i,
                $row['kd_tiket'],
                $judul . ' Batch ' . $row['batch'],
                $row['pic'],
                $this->editor->date_correct($row['tgl_mulai']),
                $this->editor->date_correct($row['tgl_selesai']),
                $tempat,
                $sarfas
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('sarfas/list_pelatihan', $data);
    }

    function cek_sarfas($id)
    {
        if ($this->mdl_fgt_pelatihan->get_sarfas_by_pelatihan($id)->row()->status == 1) {
            $sarfas = anchor('sarfas/view_sarfas/' . $id, 'Detail', array('class' => 'label label-success'));
        } else {
            $sarfas = anchor('sarfas/view_sarfas/' . $id, 'Detail', array('class' => 'label label-warning'));
        }
        return $sarfas;
    }

    function view_sarfas($id)
    {
        $data['title'] = 'Kebutuhan Sarfas';
        $data['sarfas'] =  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        $data['detail'] =  $this->mdl_fgt_pelatihan->get_sarfas_by_pelatihan($id)->row_array();
        $data['judul'] =  $this->mdl_pelatihan->get_by_id($data['sarfas']['kd_pelatihan'])->row()->judul;
        $data['jml_peserta'] = $this->mdl_peserta->count_all($data['sarfas']['id']);
        if (empty($data['sarfas']['tempat'])) {
            $data['tempat'] = '<form action="sarfas/post_sarfas/' . $id . '" method="POST"><input type="text" name="tempat" placeholder="Masukan Tempat"><button type="submit" class="btn btn-primary">Simpan</button></form>';
        } else {
            $data['tempat'] = 'Tempat : ' . $data['sarfas']['tempat'];
        }
        $this->mdl_fgt_pelatihan->update_sarfas_pelatihan($id, 1);
        $this->template->display('sarfas/view_sarfas', $data);
    }

    function post_tempat($id)
    {

        if ($this->input->post('tempat') == 1) {
            $dat = array(
                'tempat' => 'PCU-Pertamina Corporate University',
                'ruangan' => $this->input->post('ruangan')
            );
            $this->mdl_fgt_pelatihan->update($id, $dat);
        } elseif ($this->input->post('tempat') == 2) {
            $dat = array(
                'tempat' => $this->input->post('tempat_lain'),
                'ruangan' => $this->input->post('ruangan_lain')
            );
            $this->mdl_fgt_pelatihan->update($id, $dat);
        }

        if ($this->session->userdata('fungsi') == 4) {
            redirect('fgt_pelatihan/edit_plan/' . $id);
        } else if ($this->session->userdata('fungsi') == 5) {
            redirect('sarfas/tempat/' . $id);
        }

        // header("location:javascript://history.go(-2)");
        //redirect('sarfas/tempat/'.$id);
    }

    function tempat($id)
    {
        $data['title'] = 'Tempat Pelatihan';
        $data['sarfas'] =  $this->mdl_fgt_pelatihan->get_by_id($id)->row_array();
        $data['detail'] =  $this->mdl_fgt_pelatihan->get_sarfas_by_pelatihan($id)->row_array();
        $data['judul'] =  $this->mdl_pelatihan->get_by_id($data['sarfas']['kd_pelatihan'])->row()->judul;
        $data['jml_peserta'] = $this->mdl_peserta->count_all($data['sarfas']['id']);
        $data['action'] = 'sarfas/post_tempat/' . $id;
        $data['tempat'] =  $this->cek_tempat($data['sarfas']['tempat']);
        $data['ruangan'] =  $this->cek_tempat($data['sarfas']['ruangan']);
        $data['kota'] =  $this->cek_tempat($data['sarfas']['lokasi_kota']);
        $opt_class = $this->mdl_sarfas->get_class();
        $data['options_class'] = '';
        foreach ($opt_class->result_array() as $row_class) {
            $data['options_class'] .= '<option value="' . $row_class['class_name'] . '">' . $row_class['class_name'] . '</option>';
        }

        $this->template->display('sarfas/tempat', $data);
    }

    function cek_tempat($dat)
    {
        if (empty($dat)) {
            $tmp = '<span class="label label-important">Belum Dimasukan</span>';
        } else {
            $tmp = '<span class="label label-info">' . $dat . '</span>';
        }
        return $tmp;
    }
}