<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mandatory
 *
 * @author dhecode
 */
class mandatory extends CI_Controller
{
    private $limit = 10;
    //put your code here
    function __construct()
    {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mdl_mandatory');
    }

    function index($th = 0, $dir = 0, $bln = 0, $offset = 0)
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $direktorat = $this->input->post('direktorat');

        if (!empty($tahun)) {
            $th = $this->input->post('tahun');
        } else {
            $th = $th;
        }

        if (!empty($bulan)) {
            $bln = $this->input->post('bulan');
        } else {
            $bln = $bln;
        }

        if (!empty($direktorat)) {
            $dir = $this->input->post('direktorat');
        } else {
            $dir = $dir;
        }

        $data['download_excel'] =  anchor('mandatory/to_excel/' . $th . '/' . $dir . '/' . $bln, 'Download Excel', array('class' => 'btn'));
        $this->load->library('pagination');
        $config['base_url'] =  site_url('mandatory/index/' . $th . '/' . $dir . '/' . $bln);
        $config['total_rows'] = $this->mdl_mandatory->get_count_index($th, $dir, $bln);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Data Mandatory';

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
            'No',
            'Nama Pelatihan',
            'Aktn',
            'Tempat',
            'Wktu Buka',
            'Wktu Tutup',
            'Durasi',
            'R/NR',
            'IH/P',
            'Penyelenggara',
            'Nama',
            'Nopek',
            'Fungsi',
            'Direktorat',
            'Srtfkt',
            array('data' => 'Aksi', 'colspan' => '2')
        );


        /*
              if (empty($th)) {
              $tahun=0;
              }  else {
              $tahun=  $this->input->post('tahun');    
              }
              
              if (empty($dir)) {
                  $direktorat=0;
              }  else {
              $direktorat=  $this->input->post('direktorat');    
              }
        */


        $ad =  $this->mdl_mandatory->get_index($this->limit, $offset, $th, $dir, $bln)->result_array();
        $a = 0 + $offset;
        foreach ($ad as $row) {
            $edit =  anchor('mandatory/edit/' . $row['id'], 'Edit', array('class' => 'label label-info'));
            $delete =  anchor('mandatory/delete/' . $row['id'], 'Hapus', array('class' => 'label label-important', 'onclick' => 'Aapakah anda ingin menghapus ?'));
            $this->table->add_row(
                ++$a,
                $row['nama_pelatihan'],
                $row['angkatan'],
                $row['tempat'],
                $this->editor->date_correct($row['wkt_buka']),
                $this->editor->date_correct($row['wkt_tutup']),
                $row['durasi'],
                $row['rnr'],
                $row['ihp'],
                $row['penyelenggara'],
                $row['nama'],
                $row['nopek'],
                $row['fungsi'],
                $row['direktorat'],
                $row['sertifikat'],
                $edit,
                $delete
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] =  $this->table->generate();

        $this->template->display('mandatory/index', $data);
    }

    function to_excel($th, $dir, $bln)
    {
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        //-- Table Initiation
        $tmpl = array(
            'table_open' => '<table border="1" cellpadding="0" cellspacing="0">',
            'heading_row_start' => '<tr class="heading">',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr class="alt">',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );
        $this->table->set_template($tmpl);
        $this->table->set_caption("Data Mandatory");

        $this->table->set_heading(
            'No',
            'Nama Pelatihan',
            'Aktn',
            'Tempat',
            'Wktu Buka',
            'Wktu Tutup',
            'Durasi',
            'R/NR',
            'IH/P',
            'Penyelenggara',
            'Nama',
            'Nopek',
            'Fungsi',
            'Direktorat',
            'Srtfkt'
        );


        $ad =  $this->mdl_mandatory->get_excel($th, $dir, $bln)->result_array();
        $a = 0;
        foreach ($ad as $row) {
            $this->table->add_row(
                ++$a,
                $row['nama_pelatihan'],
                $row['angkatan'],
                $row['tempat'],
                $this->editor->date_correct($row['wkt_buka']),
                $this->editor->date_correct($row['wkt_tutup']),
                $row['durasi'],
                $row['rnr'],
                $row['ihp'],
                $row['penyelenggara'],
                $row['nama'],
                $row['nopek'],
                $row['fungsi'],
                $row['direktorat'],
                $row['sertifikat']
            );
        }

        $data['content'] =  $this->table->generate();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=ldp-tagihan.xls");  //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);


        echo $data['content'];
    }


    function add()
    {
        $data['title'] = 'Tambah Data Mandatory';
        $data['action'] = 'mandatory/add';
        $this->_set_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->template->display('mandatory/add_form', $data);
        } else {
            $mandatory = array(
                'nama_pelatihan' =>  $this->input->post('nama_pelatihan'),
                'angkatan' =>  $this->input->post('angkatan'),
                'tempat' =>  $this->input->post('tempat'),
                'wkt_buka' =>  $this->input->post('wkt_buka'),
                'wkt_tutup' =>  $this->input->post('wkt_tutup'),
                'durasi' =>  $this->input->post('durasi'),
                'rnr' =>  $this->input->post('rnr'),
                'ihp' =>  $this->input->post('ihp'),
                'penyelenggara' =>  $this->input->post('penyelenggara'),
                'nama' =>  $this->input->post('nama'),
                'nopek' =>  $this->input->post('nopek'),
                'fungsi' =>  $this->input->post('fungsi'),
                'direktorat' =>  $this->input->post('direktorat'),
                'sertifikat' =>  $this->input->post('sertifikat')
            );

            $this->mdl_mandatory->add($mandatory);
            redirect('mandatory/index');
        }
    }

    function edit($id)
    {
        $data['title'] = 'Edit Data Mandatory';
        $data['action'] = 'mandatory/edit/' . $id;
        $this->_set_rules();
        if ($this->form_validation->run() == FALSE) {
            $data['mandatory'] =  $this->mdl_mandatory->get_by_id($id)->row_array();
            $this->template->display('mandatory/edit_form', $data);
        } else {
            $mandatory = array(
                'nama_pelatihan' =>  $this->input->post('nama_pelatihan'),
                'angkatan' =>  $this->input->post('angkatan'),
                'tempat' =>  $this->input->post('tempat'),
                'wkt_buka' =>  $this->input->post('wkt_buka'),
                'wkt_tutup' =>  $this->input->post('wkt_tutup'),
                'durasi' =>  $this->input->post('durasi'),
                'rnr' =>  $this->input->post('rnr'),
                'ihp' =>  $this->input->post('ihp'),
                'penyelenggara' =>  $this->input->post('penyelenggara'),
                'nama' =>  $this->input->post('nama'),
                'nopek' =>  $this->input->post('nopek'),
                'fungsi' =>  $this->input->post('fungsi'),
                'direktorat' =>  $this->input->post('direktorat'),
                'sertifikat' =>  $this->input->post('sertifikat')
            );

            $this->mdl_mandatory->update($id, $mandatory);
            redirect('mandatory/index');
        }
    }

    function delete($id)
    {
        $this->mdl_mandatory->delete($id);
        redirect('mandatory/index');
    }

    function _set_rules()
    {
        $this->form_validation->set_rules('nama_pelatihan', 'Nama Pelatihan', 'trim|required');
    }

    function do_upload()
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls';
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

                $dataexcel[$i - 1]['nama_pelatihan'] = $data['cells'][$i][1];
                $dataexcel[$i - 1]['angkatan'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['tempat'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['wkt_buka'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['wkt_tutup'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['durasi'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['rnr'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['ihp'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['penyelenggara'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['nama'] = $data['cells'][$i][10];
                $dataexcel[$i - 1]['nopek'] = $data['cells'][$i][11];
                $dataexcel[$i - 1]['fungsi'] = $data['cells'][$i][12];
                $dataexcel[$i - 1]['direktorat'] = $data['cells'][$i][13];
                $dataexcel[$i - 1]['sertifikat'] = $data['cells'][$i][14];
            }

            // delete_files($upload_data['file_path']);
            $this->mdl_mandatory->add_dataexcel($dataexcel);
        }
        redirect("mandatory");
    }
}