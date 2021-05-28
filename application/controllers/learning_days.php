<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of learning_days
 *
 * @author Ade Hermawan
 */
class learning_days extends CI_Controller
{
    //put your code here
    private $limit = 10;
    public $hal = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_learning_days');
        $this->load->library(array('upload', 'session'));

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('form_validation');
    }

    function index($offset = 0)
    {
        $this->get_index($offset);
        $hal = $offset;
    }

    protected function get_index($offset)
    {

        $data['title'] = 'Data Learning Days';
        $this->load->library('pagination');

        /* Pagination */
        $config['base_url'] =  site_url('learning_days/index/');
        $config['total_rows'] =  $this->mdl_learning_days->count_all();
        $config['per_page'] =  $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] =  $this->pagination->create_links();

        /*list table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
            'No',
            'Nopek',
            'Nama',
            'Tgl Mulai',
            'Tgl Selesai',
            'Lokasi',
            'Nama Pelatihan',
            array('data' => 'Action', 'colspan' => 3, 'width' => '10')
        );

        $search_name = $this->input->post('search_name');
        $list = $this->input->post('list');

        $ld =  $this->mdl_learning_days->get_index($list, $search_name, $this->limit, $offset)->result_array();
        $i = 0 + $offset;
        $data['view_ld'] = '';
        $data['edit_ld'] = '';
        foreach ($ld as $row) {
            $view =  anchor('#view_ld' . $row['id'], '<span class="label label-success">Lihat</span>', array('data-toggle' => 'modal'));
            $edit = anchor('#edit_ld' . $row['id'], '<span class="label label-info">Ubah</span>', array('data-toggle' => 'modal'));
            $delete = anchor('learning_days/delete_ld/' . $row['id'] . '/' . $offset, '<span class="label label-important">Hapus</span>', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')", 'rel' => 'tooltip', 'title' => 'Delete'));
            $data['view_ld'] .= $this->editor->view_ld($row['id']);
            $data['edit_ld'] .= $this->editor->edit_ld($row['id'], $offset);
            $this->table->add_row(
                ++$i,
                $row['nopek'],
                $row['name'],
                $this->editor->date_correct($row['start_date']),
                $this->editor->date_correct($row['end_date']),
                $row['location'],
                $row['training_name'],
                $view,
                $edit,
                $delete
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        $this->template->display('learning_days/index', $data);
    }


    //upload excel
    function do_upload()
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls';
        $config['max_size'] = '999999999999999999999';
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        } else {
            $data = array('error' => false);
            $upload_data = $this->upload->data();
            $this->load->library('spreadsheet_excel_reader');
            //         include_once ( APPPATH."libraries/excel_reader2.php");

            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $file = $upload_data['full_path'];

            $this->spreadsheet_excel_reader->read($file);
            error_reporting(E_ALL ^ E_NOTICE);

            // Sheet 1
            $data =  $this->spreadsheet_excel_reader->sheets[0];
            $dataexcel = array();
            for ($i = 1; $i <= $data['numRows']; $i++) {

                if ($data['cells'][$i][1] == '')
                    break;

                $dataexcel[$i - 1]['nopek'] = $data['cells'][$i][1];
                $dataexcel[$i - 1]['name'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['personnel_area'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['company_code'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['id_position'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['position_name'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['cost_ctr'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['cost_center'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['start_date'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['end_date'] = $data['cells'][$i][10];
                $dataexcel[$i - 1]['education'] = $data['cells'][$i][11];
                $dataexcel[$i - 1]['location'] = $data['cells'][$i][12];
                $dataexcel[$i - 1]['country'] = $data['cells'][$i][13];
                $dataexcel[$i - 1]['certification'] = $data['cells'][$i][14];
                $dataexcel[$i - 1]['duration'] = $data['cells'][$i][15];
                $dataexcel[$i - 1]['training_name'] = $data['cells'][$i][16];
                $dataexcel[$i - 1]['departemen'] = $data['cells'][$i][17];
                $dataexcel[$i - 1]['tw'] = $data['cells'][$i][18];
            }

            delete_files($upload_data['file_path']);
            $this->mdl_learning_days->add_dataexcel($dataexcel);
        }
        redirect("learning_days");
    }

    function list_pekerja($offset = 0)
    {
        $data['title'] = 'Data Pekerja Pertamina';
        $this->load->library('pagination');

        /* Pagination */
        $config['base_url'] =  site_url('learning_days/list_pekerja/');
        $config['total_rows'] =  $this->mdl_learning_days->count_pekerja();
        $config['per_page'] =  $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] =  $this->pagination->create_links();

        /*list table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
            'No',
            'Nopek',
            'Nama',
            'Jabatan',
            'Perusahaan',
            'Direktorat'
        );

        $ld =  $this->mdl_learning_days->get_pekerja($this->limit, $offset)->result_array();
        $i = 0 + $offset;
        foreach ($ld as $row) {
            $this->table->add_row(
                ++$i,
                $row['nopek'],
                $row['name'],
                $row['jabatan'],
                $row['company_code'],
                $row['direktorat']
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        $this->template->display('learning_days/pekerja', $data);
    }


    //upload excel
    function do_upload_pekerja()
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls';
        $config['max_size'] = '999999999999999999999';
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        } else {
            $data = array('error' => false);
            $upload_data = $this->upload->data();
            $this->load->library('spreadsheet_excel_reader');
            //         include_once ( APPPATH."libraries/excel_reader2.php");

            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $file = $upload_data['full_path'];

            $this->spreadsheet_excel_reader->read($file);
            error_reporting(E_ALL ^ E_NOTICE);

            // Sheet 1
            $data =  $this->spreadsheet_excel_reader->sheets[0];
            $dataexcel = array();
            for ($i = 1; $i <= $data['numRows']; $i++) {

                if ($data['cells'][$i][1] == '')
                    break;

                $dataexcel[$i - 1]['nopek'] = $data['cells'][$i][1];
                $dataexcel[$i - 1]['plc_jabatan_id'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['name'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['tgl_lahir'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['cost_ctr'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['cost_center'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['jabatan'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['company_code'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['personel_area'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['sub_area'] = $data['cells'][$i][10];
                $dataexcel[$i - 1]['employee_group'] = $data['cells'][$i][11];
                $dataexcel[$i - 1]['employee_subgroup'] = $data['cells'][$i][12];
                $dataexcel[$i - 1]['cost_center_group'] = $data['cells'][$i][13];
                $dataexcel[$i - 1]['direktorat'] = $data['cells'][$i][14];
            }

            delete_files($upload_data['file_path']);
            $this->mdl_learning_days->add_excel_pekerja($dataexcel);
        }
        redirect("learning_days/list_pekerja");
    }

    function add_ld()
    {
        $data['title'] = 'Tambah Learning Days Baru';
        $data['link_back'] =  site_url('learning_days');
        $data['action'] = 'learning_days/add_ld';
        $nopek = $this->input->post('cari');
        $this->__set_rules();
        if ($this->form_validation->run() === FALSE) {

            $data['ld']['nopek'] =  $this->mdl_learning_days->get_pekerja_by_nopek($nopek, 'nopek');
            $data['ld']['name'] =  $this->mdl_learning_days->get_pekerja_by_nopek($nopek, 'name');
            $data['ld']['personel_area'] =  $this->mdl_learning_days->get_pekerja_by_nopek($nopek, 'personel_area');
            $data['ld']['company_code'] =  $this->mdl_learning_days->get_pekerja_by_nopek($nopek, 'company_code');
            $data['ld']['plc_jabatan_id'] =  $this->mdl_learning_days->get_pekerja_by_nopek($nopek, 'plc_jabatan_id');
            $data['ld']['jabatan'] =  $this->mdl_learning_days->get_pekerja_by_nopek($nopek, 'jabatan');
            $data['ld']['cost_ctr'] =  $this->mdl_learning_days->get_pekerja_by_nopek($nopek, 'cost_ctr');
            $data['ld']['cost_center'] =  $this->mdl_learning_days->get_pekerja_by_nopek($nopek, 'cost_center');
            $data['ld']['start_date'] =  '';
            $data['ld']['end_date'] = '';
            $data['ld']['education'] = '';
            $data['ld']['location'] = '';
            $data['ld']['country'] = '';
            $data['ld']['certification'] = '';
            $data['ld']['duration'] = '';
            $data['ld']['training_name'] = '';
            $data['ld']['departement'] = '';

            $this->template->display('learning_days/form_ld', $data);
        } else {
            $pek = $this->input->post('pekerja');
            $tahun =  date('Y');
            $jml_pek =  count($pek);
            for ($i = 0; $i < $jml_pek; $i++) {
                // do something         
                $ld = array(
                    'nopek' => $pek[$i],
                    'name' => $this->mdl_learning_days->get_pekerja_by_nop($pek[$i])->row()->name,
                    'personnel_area' => $this->mdl_learning_days->get_pekerja_by_nop($pek[$i])->row()->personel_area,
                    'company_code' => $this->mdl_learning_days->get_pekerja_by_nop($pek[$i])->row()->company_code,
                    'id_position' => $this->mdl_learning_days->get_pekerja_by_nop($pek[$i])->row()->plc_jabatan_id,
                    'position_name' => $this->mdl_learning_days->get_pekerja_by_nop($pek[$i])->row()->jabatan,
                    'cost_ctr' => $this->mdl_learning_days->get_pekerja_by_nop($pek[$i])->row()->cost_ctr,
                    'cost_center' => $this->mdl_learning_days->get_pekerja_by_nop($pek[$i])->row()->cost_center,
                    'start_date' =>  $this->input->post('start_date'),
                    'end_date' =>  $this->input->post('end_date'),
                    'education' =>  $this->input->post('education'),
                    'location' =>  $this->input->post('location'),
                    'country' =>  $this->input->post('country'),
                    'certification' =>  $this->input->post('certification'),
                    'duration' =>  $this->input->post('duration'),
                    'training_name' =>  $this->input->post('training_name'),
                    'departemen' =>  $this->input->post('departemen'),
                    'tw' =>  $this->input->post('tw') . $tahun,
                    'insert_date' => date('Y-m-d G:i:s')
                );

                $this->mdl_learning_days->add_ld($ld);
            }

            redirect('learning_days');
        }
    }


    function __set_rules()
    {
        $this->form_validation->set_rules('training_name', 'Nama Pelatihan', 'required|trim');
    }

    function edit_ld($id, $offset)
    {
        $ld = array(
            'start_date' =>  $this->input->post('start_date'),
            'end_date' =>  $this->input->post('end_date'),
            'education' =>  $this->input->post('education'),
            'location' =>  $this->input->post('location'),
            'country' =>  $this->input->post('country'),
            'certification' =>  $this->input->post('certification'),
            'duration' =>  $this->input->post('duration'),
            'training_name' =>  $this->input->post('training_name'),
            'departemen' =>  $this->input->post('departemen')
        );

        $this->mdl_learning_days->edit_ld($id, $ld);
        redirect('learning_days/index/' . $offset);
    }

    function delete_ld($id, $offset)
    {
        $this->mdl_learning_days->delete_ld($id);
        redirect('learning_days/index/' . $offset);
    }

    //autoComplete Pekerja
    function lookup_pekerja()
    {
        // process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->mdl_learning_days->lookup_pekerja($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id' => $row['nopek'],
                    'value' => $row['name']
                );  //Add a row to array
            }
            echo json_encode($data); //echo json string if ajax request
        } else {
            $datax['response'] = 'true';
            $data['message'] = array();
            $datax['message'][] = array(
                'id' => 0,
                'value' => 'Tidak ditemukan'
            );
            echo json_encode($datax);
        }
    }
}