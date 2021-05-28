<?php

/**
 * Description of learning_days
 *
 * @author Ade Hermawan
 */
class learning_hsetc extends CI_Controller
{
    //put your code here
    private $limit = 10;
    public $hal = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_learning_hsetc');
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

        $data['title'] = 'Data Pelatihan HSETC';
        $this->load->library('pagination');

        /* Pagination */
        $config['base_url'] =  site_url('learning_hsetc/index/');
        $config['total_rows'] =  $this->mdl_learning_hsetc->count_all();
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

        $ld =  $this->mdl_learning_hsetc->get_index($list, $search_name, $this->limit, $offset)->result_array();
        $i = 0 + $offset;
        $data['view_hsetc'] = '';
        $data['edit_hsetc'] = '';
        foreach ($ld as $row) {
            $view =  anchor('#view_hsetc' . $row['id'], '<span class="label label-success">Lihat</span>', array('data-toggle' => 'modal'));
            $edit = anchor('#edit_hsetc' . $row['id'], '<span class="label label-info">Ubah</span>', array('data-toggle' => 'modal'));
            $delete = anchor('learning_hsetc/delete_hsetc/' . $row['id'] . '/' . $offset, '<span class="label label-important">Hapus</span>', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')", 'rel' => 'tooltip', 'title' => 'Delete'));
            $data['view_hsetc'] .= $this->editor->view_hsetc($row['id']);
            $data['edit_hsetc'] .= $this->editor->edit_hsetc($row['id'], $offset);
            $this->table->add_row(
                ++$i,
                $row['nopek'],
                $row['nama'],
                $this->editor->date_correct($row['tgl_mulai']),
                $this->editor->date_correct($row['tgl_selesai']),
                $row['lokasi'],
                $row['judul_pelatihan'],
                $view,
                $edit,
                $delete
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        $this->template->display('learning_hsetc/index', $data);
    }


    //upload excel
    function upload()
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls';
        $config['max_size'] = '999999999999';
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
            $this->session->set_flashdata('msg', $file);
            // Sheet 1
            $data =  $this->spreadsheet_excel_reader->sheets[0];
            $dataexcel = array();
            for ($i = 1; $i <= $data['numRows']; $i++) {

                //                if ($data['cells'][$i][1] == '')
                //                    break;

                $dataexcel[$i - 1]['kode'] = $data['cells'][$i][1];
                $dataexcel[$i - 1]['no_sertifikat'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['judul_pelatihan'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['lokasi'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['tgl_mulai'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['tgl_selesai'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['durasi'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['nopek'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['nama'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['fungsi'] = $data['cells'][$i][10];
                $dataexcel[$i - 1]['unit_asal'] = $data['cells'][$i][11];
                $dataexcel[$i - 1]['direktorat'] = $data['cells'][$i][12];
                $dataexcel[$i - 1]['insert_date'] = date('Y-m-d G:i:s');
            }

            delete_files($upload_data['file_path']);

            $this->mdl_learning_hsetc->add_dataexcel($dataexcel);
        }
        redirect("learning_hsetc");
    }

    function add()
    {
        $data['title'] = 'Tambah Pelatihan HSETC';
        $data['link_back'] =  site_url('learning_hsetc');
        $data['action'] = 'learning_hsetc/add';
        $data['action_nonpekerja'] = 'learning_hsetc/add_nonpekerja';
        $nopek = $this->input->post('cari');
        $this->__set_rules();
        if ($this->form_validation->run() === FALSE) {
            $this->template->display('learning_hsetc/form_pekerja', $data);
        } else {
            $pek = $this->input->post('pekerja');
            $tahun =  date('Y');
            $jml_pek =  count($pek);
            for ($i = 0; $i < $jml_pek; $i++) {
                // do something         
                $ld = array(
                    'kode' => $this->input->post('kode'),
                    'no_sertifikat' =>  $this->input->post('no_sertifikat'),
                    'judul_pelatihan' => $this->input->post('judul_pelatihan'),
                    'lokasi' => $this->input->post('lokasi'),
                    'tgl_mulai' =>  $this->input->post('tgl_mulai'),
                    'tgl_selesai' =>  $this->input->post('tgl_selesai'),
                    'durasi' =>  $this->input->post('durasi'),
                    'nopek' => $this->mdl_learning_hsetc->get_pekerja_by_nop($pek[$i])->row()->nopek,
                    'nama' => $this->mdl_learning_hsetc->get_pekerja_by_nop($pek[$i])->row()->name,
                    'fungsi' =>  $this->mdl_learning_hsetc->get_pekerja_by_nop($pek[$i])->row()->cost_center,
                    'unit_asal' =>  $this->mdl_learning_hsetc->get_pekerja_by_nop($pek[$i])->row()->personel_area,
                    'direktorat' =>  $this->mdl_learning_hsetc->get_pekerja_by_nop($pek[$i])->row()->direktorat,
                    'insert_date' => date('Y-m-d G:i:s')
                );

                $this->mdl_learning_hsetc->add_ld($ld);
            }
            redirect('learning_hsetc');
        }
    }




    function add_nonpekerja()
    {
        $data['title'] = 'Tambah Pelatihan HSETC Non Pekerja Pertamina';
        $data['link_back'] =  site_url('learning_hsetc');
        $data['action'] = 'learning_hsetc/add_nonpekerja';
        $this->__set_rules();
        if ($this->form_validation->run() === FALSE) {

            $this->template->display('learning_hsetc/form_nonpekerja', $data);
        } else {

            $ld_nonpekerja = array(
                'kode' => $this->input->post('kode'),
                'no_sertifikat' =>  $this->input->post('no_sertifikat'),
                'judul_pelatihan' => $this->input->post('judul_pelatihan'),
                'lokasi' => $this->input->post('lokasi'),
                'tgl_mulai' =>  $this->input->post('tgl_mulai'),
                'tgl_selesai' =>  $this->input->post('tgl_selesai'),
                'durasi' =>  $this->input->post('durasi'),
                'nopek' => $this->input->post('nopek'),
                'nama' => $this->input->post('nama'),
                'fungsi' => $this->input->post('fungsi'),
                'unit_asal' => $this->input->post('unit_asal'),
                'direktorat' => $this->input->post('direktorat'),
                'insert_date' => date('Y-m-d G:i:s')
            );

            $this->mdl_learning_hsetc->add_ld($ld_nonpekerja);
            redirect('learning_hsetc');
        }
    }


    function __set_rules()
    {
        $this->form_validation->set_rules('judul_pelatihan', 'Nama Pelatihan', 'required|trim');
    }

    function edit_hsetc($id, $offset)
    {
        $ld = array(
            'kode' => $this->input->post('kode'),
            'no_sertifikat' =>  $this->input->post('no_sertifikat'),
            'judul_pelatihan' => $this->input->post('judul_pelatihan'),
            'lokasi' => $this->input->post('lokasi'),
            'tgl_mulai' =>  $this->input->post('tgl_mulai'),
            'tgl_selesai' =>  $this->input->post('tgl_selesai'),
            'durasi' =>  $this->input->post('durasi'),
            'nopek' =>  $this->input->post('nopek'),
            'nama' => $this->input->post('nama'),
            'fungsi' => $this->input->post('fungsi'),
            'unit_asal' => $this->input->post('unit_asal'),
            'direktorat' => $this->input->post('direktorat'),
            'insert_date' => date('Y-m-d G:i:s')
        );

        $this->mdl_learning_hsetc->edit_hsetc($id, $ld);
        redirect('learning_hsetc/index/' . $offset);
    }

    function delete_hsetc($id, $offset)
    {
        $this->mdl_learning_hsetc->delete_hsetc($id);
        redirect('learning_hsetc/index/' . $offset);
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