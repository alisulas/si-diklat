<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pekerja
 *
 * @author Ade Hermawan
 * mail@adehermawan.com
 */
class pekerja extends CI_Controller
{
    //put your code here
    private $limit = 10;
    public $hal = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_pekerja');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
    }

    function index($offset = 0)
    {
        $this->get_index($offset);
        $hal = $offset;
    }
    protected function get_index($offset)
    {
        $data['title'] = 'Data Pekerja';
        $this->load->library('pagination');

        /*Pagination*/
        $config['base_url'] =  site_url('pekerja/index/');
        $config['total_rows'] =  $this->mdl_pekerja->count_all();
        $config['per_page'] =  $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
            array('data' => 'No', 'width' => '3%'),
            array('data' => 'Nopek', 'width' => '5%'),
            array('data' => 'Nama', 'width' => '30%'),
            array('data' => 'Jabatan', 'width' => '30%'),
            array('data' => 'Direktorat', 'width' => '27%'),
            array('data' => 'Action', 'colspan' => '5%')
        );

        $search_name = $this->input->post('search_name');
        $list = $this->input->post('list');
        $i = 0 + $offset;
        $pekerja =  $this->mdl_pekerja->get_index($list, $search_name, $this->limit, $offset)->result_array();
        $data['view_pekerja'] = '';
        $data['edit_pekerja'] = '';
        foreach ($pekerja as $row) {
            $view =  anchor('#view_pekerja' . $row['id'], '<span class="label label-success">Lihat</span>', array('data-toggle' => 'modal'));
            $edit =  anchor('#edit_pekerja' . $row['id'], '<span class="label label-info">Ubah</span>', array('data-toggle' => 'modal'));
            $delete =  anchor('pekerja/delete/' . $row['id'] . '/' . $offset, '<span class="label label-important">Hapus</span>', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data ?')", 'rel' => 'tooltip', 'title' => 'Hapus'));
            $data['view_pekerja'] .= $this->editor->view_pekerja($row['id']);
            $data['edit_pekerja'] .= $this->editor->edit_pekerja($row['id'], $offset);

            $this->table->add_row(
                ++$i,
                $row['nopek'],
                $row['nama'],
                $row['position'],
                $row['direktorat'],
                $view,
                $edit,
                $delete
            );
        }

        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('pekerja/index', $data);
    }


    function delete($id, $offset)
    {
        $this->mdl_pekerja->delete($id);
        redirect('pekerja/index/' . $offset);
    }

    function edit($id, $offset)
    {
        $pekerja = array(
            'nopek' => $this->input->post('nopek'),
            'plc_jabatan_id' => $this->input->post('plc_jabatan_id'),
            'name' => $this->input->post('name'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'cost_ctr' => $this->input->post('cost_ctr'),
            'cost_center' => $this->input->post('cost_center'),
            'jabatan' => $this->input->post('jabatan'),
            'company_code' => $this->input->post('company_code'),
            'personel_area' => $this->input->post('personel_area'),
            'sub_area' => $this->input->post('sub_area'),
            'employee_group' => $this->input->post('employee_group'),
            'employee_subgroup' => $this->input->post('employee_subgroup'),
            'cost_center_group' => $this->input->post('cost_center_group'),
            'direktorat' => $this->input->post('direktorat'),
            'insert_date' => date('Y-m-d G:i:s')
        );

        $this->mdl_pekerja->edit($id, $pekerja);
        redirect('pekerja/index/' . $offset);
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
                $dataexcel[$i - 1]['nama'] = $data['cells'][$i][2];
                $dataexcel[$i - 1]['tgl_lahir'] = $data['cells'][$i][3];
                $dataexcel[$i - 1]['id_position'] = $data['cells'][$i][4];
                $dataexcel[$i - 1]['position'] = $data['cells'][$i][5];
                $dataexcel[$i - 1]['cost_center_code'] = $data['cells'][$i][6];
                $dataexcel[$i - 1]['cost_center_name'] = $data['cells'][$i][7];
                $dataexcel[$i - 1]['company_code'] = $data['cells'][$i][8];
                $dataexcel[$i - 1]['personnel_area'] = $data['cells'][$i][9];
                $dataexcel[$i - 1]['personnel_sub_area'] = $data['cells'][$i][10];
                $dataexcel[$i - 1]['employee_group'] = $data['cells'][$i][11];
                $dataexcel[$i - 1]['employee_sub_group'] = $data['cells'][$i][12];
                $dataexcel[$i - 1]['layering'] = $data['cells'][$i][13];
                $dataexcel[$i - 1]['direktorat'] = $data['cells'][$i][14];
                $dataexcel[$i - 1]['fungsi'] = $data['cells'][$i][15];
                $dataexcel[$i - 1]['divisi'] = $data['cells'][$i][16];
                $dataexcel[$i - 1]['departemen'] = $data['cells'][$i][17];
            }

            delete_files($upload_data['file_path']);
            $this->mdl_pekerja->add_excel_pekerja($dataexcel);
        }
        redirect("pekerja");
    }

    //Data Manager

    function index_manager($offset = 0)
    {
        $this->get_index_manager($offset);
        $hal = $offset;
    }
    protected function get_index_manager($offset)
    {
        $data['title'] = 'Data manager';
        $this->load->library('pagination');

        /*Pagination*/
        $config['base_url'] =  site_url('pekerja/index_manager/');
        $config['total_rows'] =  $this->mdl_pekerja->count_manager();
        $config['per_page'] =  $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();


        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
            'No',
            'ID',
            'Nama',
            array('data' => 'Action', 'colspan' => 2, 'width' => '10')
        );
        $i = 0 + $offset;
        $manager =  $this->mdl_pekerja->get_index_manager($this->limit, $offset)->result_array();
        $data['edit_manager'] = '';


        foreach ($manager as $row) {
            $edit =  anchor('#edit_manager' . $row['id'], '<span class="label label-info">Ubah</span>', array('data-toggle' => 'modal'));
            $delete =  anchor('pekerja/delete_manager/' . $row['id'], '<span class="label label-important">Hapus</span>', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data ?')", 'rel' => 'tooltip', 'title' => 'Hapus'));
            $data['edit_manager'] .= $this->editor->edit_manager($row['id']);

            $this->table->add_row(
                ++$i,
                $row['id'],
                $row['name'],
                $edit,
                $delete
            );
        }

        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('pekerja/index_manager', $data);
    }


    function delete_manager($id)
    {
        $this->mdl_pekerja->delete_manager($id);
        redirect('pekerja/index_manager/');
    }

    function edit_manager($id)
    {
        $manager = array(
            'name' => $this->input->post('name'),
            'update_date' => date('Y-m-d G:i:s')
        );

        $this->mdl_pekerja->edit_manager($id, $manager);
        redirect('pekerja/index_manager/');
    }

    function tambah_manager()
    {
        $manager = array(
            'name' =>  $this->input->post('name'),
            'insert_date' => date('Y-m-d G:i:s')
        );
        $this->mdl_pekerja->tambah_manager($manager);
        redirect('pekerja/index_manager');
    }

    //upload excel
    function do_upload_manager()
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

                $dataexcel[$i - 1]['name'] = $data['cells'][$i][1];
            }

            delete_files($upload_data['file_path']);
            $this->mdl_pekerja->add_excel_manager($dataexcel);
        }
        redirect("pekerja/index_manager");
    }
}