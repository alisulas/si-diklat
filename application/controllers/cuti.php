<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cuti
 *
 * @author dhecode
 */
class cuti extends CI_Controller
{
    //put your code here
    private $limit = 10;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_cuti');
        //    $this->load->library('form_validation');

    }

    function index()
    {
        $data['title'] = 'Daftar Cuti Pekerja';
        $data['link_back'] = site_url('cuti/index');
        $data['action'] = 'cuti/add';
        $data['action_nopek'] = 'cuti/index';
        $nopek =  $this->input->post('nopek');

        if (empty($nopek)) {
            $data['nopek'] = '';
            $data['nama'] = '';
            $data['jabatan'] = '';
            $data['tanggal'] = '';
            $data['tahun_ke'] = '';
            $data['total_hari'] = '';
            $data['sisa_cuti'] = '';
        } else {
            $data['nopek'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->nopek;
            $data['nama'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->nama;
            $data['jabatan'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->jabatan;
            $data['tanggal'] =  $this->editor->date_correct($this->mdl_cuti->get_by_nopek($nopek)->row()->tgl_mulai_cuti) . ' s/d ' . $this->editor->date_correct($this->mdl_cuti->get_by_nopek($nopek)->row()->tgl_akhir_cuti);
            $data['tahun_ke'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->tahun_ke;
            $data['total_hari'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->total_hari . ' Hari';
            $data['sisa_cuti'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->sisa;
        }
        $this->template->display('cuti/index', $data);
    }

    function add()
    {
        $nopek =  $this->input->post('nopek');
        $sisa_db = $this->mdl_cuti->get_by_nopek($nopek)->row()->sisa;

        $sisa = $sisa_db - $this->input->post('total_hk');
        $cuti_log = array(
            'nopek' =>  $this->input->post('nopek'),
            'tgl_mulai' =>  $this->input->post('tgl_mulai'),
            'tgl_selesai' =>  $this->input->post('tgl_selesai'),
            'total_hk' =>  $this->input->post('total_hk'),
            'sisa' =>  $sisa,
            'update_date' => date('Y-m-d G:i:s')
        );
        $this->mdl_cuti->add_log($cuti_log);

        $cuti_updtae = array(
            'sisa' =>  $sisa,
            'update_date' => date('Y-m-d G:i:s')
        );

        $this->mdl_cuti->update_cuti($nopek, $cuti_updtae);

        redirect('cuti/index');
    }

    function admin_cuti()
    {
        $data['title'] = 'Admin Cuti Pekerja';
        $data['link_back'] = site_url('cuti/index');
        $data['action'] = 'cuti/update_admin_cuti';
        $data['action_nopek'] = 'cuti/admin_cuti';
        $nopek = $this->input->post('nopek');

        if (empty($nopek)) {
            $data['nopek'] = '';
            $data['nama'] = '';
            $data['jabatan'] = '';
            $data['tanggal'] = '';
            $data['tahun_ke'] = '';
            $data['total_hari'] = '';
            $data['sisa_cuti'] = '';
        } else {
            $data['nopek'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->nopek;
            $data['nama'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->nama;
            $data['jabatan'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->jabatan;
            $data['tgl_mulai'] =  $this->mdl_cuti->get_by_nopek($nopek)->row()->tgl_mulai_cuti;
            $data['tgl_akhir'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->tgl_akhir_cuti;
            $data['tahun_ke'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->tahun_ke;
            $data['total_hari'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->total_hari;
            $data['cuti_bersama'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->cuti_bersama;
            $data['sisa_cuti'] = $this->mdl_cuti->get_by_nopek($nopek)->row()->sisa;
        }

        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
            'Nopek',
            'Nama Pekerja'
        );
        $query =  $this->mdl_cuti->get_cuti()->result_array();
        foreach ($query as $row) {
            $this->table->add_row(
                $row['nopek'],
                $row['nama']
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['tabel'] =  $this->table->generate();

        $this->template->display('cuti/form_admin', $data);
    }

    function update_admin_cuti()
    {
        $nopek =  $this->input->post('nopek');
        $update_cuti = array(
            'nama' =>  $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'tgl_mulai_cuti' => $this->input->post('tgl_mulai_cuti'),
            'tgl_akhir_cuti' => $this->input->post('tgl_akhir_cuti'),
            'tahun_ke' => $this->input->post('tahun_ke'),
            'total_hari' => $this->input->post('total_hari'),
            'cuti_bersama' => $this->input->post('cuti_bersama'),
            'sisa' => $this->input->post('sisa'),
            'update_date' => date('Y-m-d G:i:s')
        );

        $this->mdl_cuti->update_cuti($nopek, $update_cuti);
        redirect('cuti/admin_cuti');
    }

    /*   
    function view($offset=0) {
        
        $data['title']='Daftar Cuti Pekerja PLC';
        $this->load->library('pagination');
        
        $config['base_url']=  site_url('cuti/view/');
        $config['total_rows']=  $this->mdl_cuti->count_all();
        $config['per_page']=  $this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=  $this->pagination->create_links();
        
    }
  * */
}