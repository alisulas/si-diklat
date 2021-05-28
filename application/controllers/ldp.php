<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ldp extends CI_Controller
{
    private  $limit = 10;
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->model('mdl_ldp');
        $this->load->model('mdl_tln');
    }

    function index_tagihan($offset = 0)
    {
        $data['title'] = 'Data Tagihan';
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        /* Pagination */
        $config['base_url'] = site_url('ldp/index_tagihan/');
        $config['total_rows'] = $this->mdl_ldp->count_tagihan();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
            'No',
            'Program',
            'Lembaga Provider',
            'Tanggal Pelaksanaan',
            'Tagihan Masuk',
            'Kelangkapan Dokumen',
            'Tanggal ke GSFA',
            'Status',
            'Catatan',
            'Pembayaran',
            'Tanggal Pembayaran',
            array('data' => 'Action', 'rowspan' => 3)
        );
        $q = $this->mdl_ldp->get_tagihan($this->limit, $offset)->result_array();
        $i = 0 + $offset;
        foreach ($q as $row) {
            $pertama = 0;
            $kedua = 0;
            if (!empty($row['dok_tagihan_provider'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_tagihan_provider']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_absen_peserta'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_absen_peserta']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_absen_instruktur'])) {
                $pertama = $pertama + 1;
                $doc_tagihan = explode("#", $row['dok_absen_instruktur']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_nota_pembayaran'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_nota_pembayaran']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_kwitansi'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_kwitansi']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_faktur_pajak'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_faktur_pajak']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_ssp'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_ssp']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_berita_acara'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_berita_acara']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_surat_provider'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_surat_provider']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if (!empty($row['dok_surat_perintah'])) {
                $pertama = $pertama + 1;
                $doc_tagihan =  explode("#", $row['dok_surat_perintah']);
                if (!empty($doc_tagihan[1]) or !empty($doc_tagihan[2])) {
                    $kedua = $kedua + 1;
                }
            }

            if ($pertama == $kedua) {
                $kelengkapan =  anchor('ldp/kelengkapan_tagihan/' . $row['id'], 'Lengkap', array('class' => 'label label-info'));
            } else {
                $kelengkapan =  anchor('ldp/kelengkapan_tagihan/' . $row['id'], 'Belum Lengkap', array('class' => 'label label-important'));
            }
            $libur = $this->mdl_tln->get_libur()->result_array();
            $data_libur = '';
            foreach ($libur as $liburan) {
                $data_libur .= $liburan['date'] . '#';
            }


            $tgl_libur = explode('#', $data_libur);
            //       $tgl_ahir=  date('Y-m-d');
            if (empty($row['tgl_tagihan_masuk']) or empty($row['tgl_tagihan_gsfa'])) {
                $sla = 0;
            } else {
                $sla = $this->editor->hitung_sla($row['tgl_tagihan_masuk'], $row['tgl_tagihan_gsfa'], $tgl_libur);
            }

            if (($pertama != $kedua) and ($sla > 7)) {
                $kelengkapan =  anchor('ldp/kelengkapan_tagihan/' . $row['id'], 'Belum Lengkap', array('class' => 'label label-important'));
            } elseif (($pertama != $kedua) and ($sla <= 7)) {
                $kelengkapan =  anchor('ldp/kelengkapan_tagihan/' . $row['id'], 'Belum Lengkap', array('class' => 'label label-warning'));
            } elseif (($pertama == $kedua) and ($sla > 7)) {
                $kelengkapan =  anchor('ldp/kelengkapan_tagihan/' . $row['id'], 'Lengkap', array('class' => 'label label-important'));
            } elseif (($pertama == $kedua) and ($sla <= 7)) {
                $kelengkapan =  anchor('ldp/kelengkapan_tagihan/' . $row['id'], 'Lengkap', array('class' => 'label label-success'));
            }




            if (empty($row['tgl_dokumen_lengkap']) or empty($row['tgl_tagihan_gsfa'])) {
                $sla_status = 0;
            } else {
                $sla_status = $this->editor->hitung_sla($row['tgl_dokumen_lengkap'], $row['tgl_tagihan_gsfa'], $tgl_libur);
            }

            if (empty($row['tgl_tagihan_gsfa']) and ($sla_status > 3)) {
                $status =  '<button class="btn btn-danger">Open</b>';
            } elseif (empty($row['tgl_tagihan_gsfa']) and ($sla <= 3)) {
                $status =  '<button class="btn btn-warning">Open</b>';
            } elseif (!empty($row['tgl_tagihan_gsfa']) and ($sla > 7)) {
                $status =  '<button class="btn btn-danger">closed</b>';
            } elseif (!empty($row['tgl_tagihan_gsfa']) and ($sla <= 7)) {
                $status =  '<button class="btn btn-success">Closed</b>';
            }


            $detail =  anchor('ldp/view_tagihan/' . $row['id'], 'Lihat', array('class' => 'label label-info'));
            $edit =  anchor('ldp/edit_tagihan/' . $row['id'], 'Edit', array('class' => 'label label-info'));
            $delete =  anchor('ldp/delete_tagihan/' . $row['id'] . '/' . $row['program'], 'Hapus', array('onclick' => "return confirm('Apakah Anda yakin akan menghapus data?')", 'class' => 'label label-important'));
            if (!empty($row['tgl_pembayaran'])) {
                $pembayaran = '<button class="btn btn-primary" type="button">Paid</button>';
                $tgl_pembayaran =  $this->editor->date_correct($row['tgl_pembayaran']);
            } else {
                $pembayaran = '<button class="btn btn-warning" type="button">Unpaid</button>';
                $tgl_pembayaran = '';
            }

            $this->table->add_row(
                ++$i,
                $row['program'],
                $row['provider'],
                $this->editor->date_correct($row['tgl_mulai']) . 's/d' . $this->editor->date_correct($row['tgl_selesai']),
                $this->editor->date_correct($row['tgl_tagihan_masuk']),
                $kelengkapan,
                $this->editor->date_correct($row['tgl_tagihan_gsfa']),
                $status,
                $row['catatan'],
                $pembayaran,
                $tgl_pembayaran,
                array('data' => $detail, 'width' => 10),
                array('data' => $edit, 'width' => 10),
                array('data' => $delete, 'width' => 10)
            );
        }

        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $data['add_tagihan'] =  anchor('ldp/add_tagihan', 'Tambah', array('class' => 'btn btn-primary'));
        $data['download_excel'] =  anchor('ldp/to_exel', 'Download Excel', array('class' => 'btn btn-success'));
        $this->template->display('ldp/index', $data);
    }

    function delete_tagihan($id, $program)
    {
        $this->mdl_ldp->delete_tagihan($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Program ' . $program . ' berhasil dihapus</div>');
        redirect('ldp/index_tagihan');
    }

    function add_tagihan()
    {
        $data['title'] = 'Tambah LDP Tagihan';
        $data['link_back'] =  site_url('ldp/index');
        $data['action'] = 'ldp/add_tagihan';
        $this->_set_rules_tgihan();
        if ($this->form_validation->run() == FALSE) {
            $this->template->display('ldp/form_tagihan', $data);
        } else {

            /*          
            $this->upload->initialize(array(
                'upload_path' => './assets/uploads/ldp/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            
             if(!$this->upload->do_upload('dok_tagihan_provider'))
            {
                $dok_tagihan_provider='';
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $dok_tagihan_provider=$unggah['file_name'];
             }
             
             if(!$this->upload->do_upload('dok_absen_peserta'))
            {
                 $dok_absen_peserta='';
            } else {
                $unggah = $this->upload->data();
                $dok_absen_peserta=$unggah['file_name'];
             }
             
             
             if(!$this->upload->do_upload('dok_absen_instruktur'))
            {
                $dok_absen_instruktur='';
            } else {
                $unggah = $this->upload->data();
                $dok_absen_instruktur=$unggah['file_name'];
             }

             if(!$this->upload->do_upload('dok_nota_pembayaran'))
            {
                $dok_nota_pembayaran='';
            } else {
                $unggah = $this->upload->data();
                $dok_nota_pembayaran=$unggah['file_name'];
             }
             if(!$this->upload->do_upload('dok_kwitansi'))
            {
                $dok_kwitansi='kwitansi.jpg';
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $dok_kwitansi=$unggah['file_name'];
             }
             if(!$this->upload->do_upload('dok_faktur_pajak'))
            {
                $dok_faktur_pajak='';
            } else {
                $unggah = $this->upload->data();
                $dok_faktur_pajak=$unggah['file_name'];
             }
             
             if(!$this->upload->do_upload('dok_ssp'))
            {
                $dok_ssp='';
            } else {
                $unggah = $this->upload->data();
                $dok_ssp=$unggah['file_name'];
             }
             
             if(!$this->upload->do_upload('dok_berita_acara'))
            {
                $dok_berita_acara='';
            } else {
                $unggah = $this->upload->data();
                $dok_berita_acara=$unggah['file_name'];
             }

             if(!$this->upload->do_upload('dok_surat_provider'))
            {
                $dok_surat_provider='';
            } else {
                $unggah = $this->upload->data();
                $dok_surat_provider=$unggah['file_name'];
             }
             
             if(!$this->upload->do_upload('dok_surat_perintah'))
            {
                $dok_surat_perintah='';
            } else {
                $unggah = $this->upload->data();
                $dok_surat_perintah=$unggah['file_name'];
             }
   */

            // Ceklist
            $cek_tagihan_provider =  $this->input->post('cek_tagihan_provider');
            $cek_absen_peserta =  $this->input->post('cek_absen_peserta');
            $cek_absen_instruktur =  $this->input->post('cek_absen_instruktur');
            $cek_nota_pembayaran =  $this->input->post('cek_nota_pembayaran');
            $cek_kwitansi =  $this->input->post('cek_kwitansi');
            $cek_faktur_pajak =  $this->input->post('cek_faktur_pajak');
            $cek_ssp =  $this->input->post('cek_ssp');
            $cek_berita_acara =  $this->input->post('cek_berita_acara');
            $cek_surat_provider =  $this->input->post('cek_surat_provider');
            $cek_surat_perintah =  $this->input->post('cek_surat_perintah');
            /*            
// No Textbox
             $no_tagihan_provider=  $this->input->post('no_tagihan_provider');
             $no_absen_peserta=  $this->input->post('no_absen_peserta');
             $no_absen_instruktur=  $this->input->post('no_absen_instruktur');
             $no_nota_pembayaran=  $this->input->post('no_nota_pembayaran');
             $no_kwitansi=  $this->input->post('no_kwitansi');
             $no_faktur_pajak=  $this->input->post('no_faktur_pajak');
             $no_ssp=  $this->input->post('no_ssp');
             $no_berita_acara=  $this->input->post('no_berita_acara');
             $no_surat_provider=  $this->input->post('no_surat_provider');
             $no_surat_perintah=  $this->input->post('no_surat_perintah');
       */

            $ldp = array(
                'program' =>  $this->input->post('program'),
                'tgl_mulai' =>  $this->input->post('tgl_mulai'),
                'tgl_selesai' =>  $this->input->post('tgl_selesai'),
                'provider' =>  $this->input->post('provider'),
                'tgl_tagihan_masuk' =>  $this->input->post('tgl_tagihan_masuk'),
                'tgl_tagihan_gsfa' =>  $this->input->post('tgl_tagihan_gsfa'),
                'catatan' =>  $this->input->post('catatan'),
                'tgl_pembayaran' =>  '',
                'dok_tagihan_provider' =>  $this->set_dok2($cek_tagihan_provider),
                'dok_absen_peserta' => $this->set_dok2($cek_absen_peserta),
                'dok_absen_instruktur' => $this->set_dok2($cek_absen_instruktur),
                'dok_nota_pembayaran' => $this->set_dok2($cek_nota_pembayaran),
                'dok_kwitansi' => $this->set_dok2($cek_kwitansi),
                'dok_faktur_pajak' => $this->set_dok2($cek_faktur_pajak),
                'dok_ssp' => $this->set_dok2($cek_ssp),
                'dok_berita_acara' => $this->set_dok2($cek_berita_acara),
                'dok_surat_provider' => $this->set_dok2($cek_surat_provider),
                'dok_surat_perintah' => $this->set_dok2($cek_surat_perintah),
                'insert_date' => date('Y-m-d G:i:s'),
                'update_date' => date('Y-m-d G:i:s')

            );

            $this->mdl_ldp->add_tagihan($ldp);
            redirect('ldp/index_tagihan');
        }
    }

    function add_kelengkapan_tagihan($id)
    {

        $this->upload->initialize(array(
            'upload_path' => './assets/uploads/ldp/',
            'allowed_types' => '*',
            'max_size' => 5000, // 5MB
            'remove_spaces' => true,
            'overwrite' => false
        ));

        if (!$this->upload->do_upload('dok_tagihan_provider')) {
            $dok_tagihan_provider =  $this->input->post('dok_tagihan_provider2');
        } else {
            $unggah = $this->upload->data();
            $unggah['file_name'];
            $dok_tagihan_provider = $unggah['file_name'];
        }

        if (!$this->upload->do_upload('dok_absen_peserta')) {
            $dok_absen_peserta =  $this->input->post('dok_absen_peserta2');
        } else {
            $unggah = $this->upload->data();
            $dok_absen_peserta = $unggah['file_name'];
        }


        if (!$this->upload->do_upload('dok_absen_instruktur')) {
            $dok_absen_instruktur =  $this->input->post('dok_absen_instruktur2');
        } else {
            $unggah = $this->upload->data();
            $dok_absen_instruktur = $unggah['file_name'];
        }

        if (!$this->upload->do_upload('dok_nota_pembayaran')) {
            $dok_nota_pembayaran =  $this->input->post('dok_nota_pembayaran2');
        } else {
            $unggah = $this->upload->data();
            $dok_nota_pembayaran = $unggah['file_name'];
        }
        if (!$this->upload->do_upload('dok_kwitansi')) {
            $dok_kwitansi =  $this->input->post('dok_kwitansi2');
        } else {
            $unggah = $this->upload->data();
            $dok_kwitansi = $unggah['file_name'];
        }
        if (!$this->upload->do_upload('dok_faktur_pajak')) {
            $dok_faktur_pajak =  $this->input->post('dok_faktur_pajak2');
        } else {
            $unggah = $this->upload->data();
            $dok_faktur_pajak = $unggah['file_name'];
        }

        if (!$this->upload->do_upload('dok_ssp')) {
            $dok_ssp =  $this->input->post('dok_ssp2');
        } else {
            $unggah = $this->upload->data();
            $dok_ssp = $unggah['file_name'];
        }

        if (!$this->upload->do_upload('dok_berita_acara')) {
            $dok_berita_acara =  $this->input->post('dok_berita_acara2');
        } else {
            $unggah = $this->upload->data();
            $dok_berita_acara = $unggah['file_name'];
        }

        if (!$this->upload->do_upload('dok_surat_provider')) {
            $dok_surat_provider =  $this->input->post('dok_surat_provider2');
        } else {
            $unggah = $this->upload->data();
            $dok_surat_provider = $unggah['file_name'];
        }

        if (!$this->upload->do_upload('dok_surat_perintah')) {
            $dok_surat_perintah =  $this->input->post('dok_surat_perintah2');
        } else {
            $unggah = $this->upload->data();
            $dok_surat_perintah = $unggah['file_name'];
        }

        // Ceklist
        $cek_tagihan_provider =  $this->input->post('cek_tagihan_provider');
        $cek_absen_peserta =  $this->input->post('cek_absen_peserta');
        $cek_absen_instruktur =  $this->input->post('cek_absen_instruktur');
        $cek_nota_pembayaran =  $this->input->post('cek_nota_pembayaran');
        $cek_kwitansi =  $this->input->post('cek_kwitansi');
        $cek_faktur_pajak =  $this->input->post('cek_faktur_pajak');
        $cek_ssp =  $this->input->post('cek_ssp');
        $cek_berita_acara =  $this->input->post('cek_berita_acara');
        $cek_surat_provider =  $this->input->post('cek_surat_provider');
        $cek_surat_perintah =  $this->input->post('cek_surat_perintah');

        // No Textbox
        $no_tagihan_provider =  $this->input->post('no_tagihan_provider');
        $no_absen_peserta =  $this->input->post('no_absen_peserta');
        $no_absen_instruktur =  $this->input->post('no_absen_instruktur');
        $no_nota_pembayaran =  $this->input->post('no_nota_pembayaran');
        $no_kwitansi =  $this->input->post('no_kwitansi');
        $no_faktur_pajak =  $this->input->post('no_faktur_pajak');
        $no_ssp =  $this->input->post('no_ssp');
        $no_berita_acara =  $this->input->post('no_berita_acara');
        $no_surat_provider =  $this->input->post('no_surat_provider');
        $no_surat_perintah =  $this->input->post('no_surat_perintah');


        $ldp = array(
            'dok_tagihan_provider' =>  $this->set_dok($cek_tagihan_provider, $no_tagihan_provider, $dok_tagihan_provider),
            'dok_absen_peserta' => $this->set_dok($cek_absen_peserta, $no_absen_peserta, $dok_absen_peserta),
            'dok_absen_instruktur' => $this->set_dok($cek_absen_instruktur, $no_absen_instruktur, $dok_absen_instruktur),
            'dok_nota_pembayaran' => $this->set_dok($cek_nota_pembayaran, $no_nota_pembayaran, $dok_nota_pembayaran),
            'dok_kwitansi' => $this->set_dok($cek_kwitansi, $no_kwitansi, $dok_kwitansi),
            'dok_faktur_pajak' => $this->set_dok($cek_faktur_pajak, $no_faktur_pajak, $dok_faktur_pajak),
            'dok_ssp' => $this->set_dok($cek_ssp, $no_ssp, $dok_ssp),
            'dok_berita_acara' => $this->set_dok($cek_berita_acara, $no_berita_acara, $dok_berita_acara),
            'dok_surat_provider' => $this->set_dok($cek_surat_provider, $no_surat_provider, $dok_surat_provider),
            'dok_surat_perintah' => $this->set_dok($cek_surat_perintah, $no_surat_perintah, $dok_surat_perintah),
            'update_date' => date('Y-m-d G:i:s')

        );

        $this->mdl_ldp->update_tagihan($id, $ldp);
        redirect('ldp/view_tagihan/' . $id);
    }
    function add_edit_tagihan($id)
    {

        $ldp = array(
            'program' =>  $this->input->post('program'),
            'tgl_mulai' =>  $this->input->post('tgl_mulai'),
            'tgl_selesai' =>  $this->input->post('tgl_selesai'),
            'provider' =>  $this->input->post('provider'),
            'tgl_tagihan_masuk' =>  $this->input->post('tgl_tagihan_masuk'),
            'tgl_dokumen_lengkap' =>  $this->input->post('tgl_dokumen_lengkap'),
            'tgl_tagihan_gsfa' =>  $this->input->post('tgl_tagihan_gsfa'),
            'catatan' =>  $this->input->post('catatan'),
            'tgl_pembayaran' =>  $this->input->post('tgl_pembayaran'),
            'update_date' => date('Y-m-d G:i:s')

        );

        $this->mdl_ldp->update_tagihan($id, $ldp);
        redirect('ldp/view_tagihan/' . $id);
    }

    function view_tagihan($id)
    {
        $data['title'] = 'Lihat Tagihan';
        $data['link_back'] =  site_url('ldp/index');
        $tagihan =  $this->mdl_ldp->get_tagihan_by_id($id)->result_array();
        $data['dokumen'] = '';
        foreach ($tagihan as $row) {
            $data['program'] = $row['program'];
            $data['provider'] = $row['provider'];
            $data['tgl_pelaksanaan'] =  $this->editor->date_correct($row['tgl_mulai']) . 's/d' . $this->editor->date_correct($row['tgl_selesai']);
            $data['tgl_tagihan_masuk'] =  $this->editor->date_correct($row['tgl_tagihan_masuk']);
            $data['tgl_tagihan_gsfa'] =  $this->editor->date_correct($row['tgl_tagihan_gsfa']);
            $data['tgl_dokumen_lengkap'] =  $this->editor->date_correct($row['tgl_dokumen_lengkap']);
            $data['catatan'] =  $row['catatan'];
            $data['tgl_pembayaran'] =  $this->editor->date_correct($row['tgl_pembayaran']);

            if (!empty($row['dok_tagihan_provider'])) {
                $doc_tagihan =  explode("#", $row['dok_tagihan_provider']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Tagihan Provider</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_absen_peserta'])) {
                $doc_tagihan =  explode("#", $row['dok_absen_peserta']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Absensi Peserta</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_absen_instruktur'])) {
                $doc_tagihan =  explode("#", $row['dok_absen_instruktur']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Absensi Instruktur</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_nota_pembayaran'])) {
                $doc_tagihan =  explode("#", $row['dok_nota_pembayaran']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Nota Pembayaran</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_kwitansi'])) {
                $doc_tagihan =  explode("#", $row['dok_kwitansi']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Kwitansi</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_faktur_pajak'])) {
                $doc_tagihan =  explode("#", $row['dok_faktur_pajak']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Faktur Pajak</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_ssp'])) {
                $doc_tagihan =  explode("#", $row['dok_ssp']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">SSP</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_berita_acara'])) {
                $doc_tagihan =  explode("#", $row['dok_berita_acara']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Berita Acara</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_surat_provider'])) {
                $doc_tagihan =  explode("#", $row['dok_surat_provider']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Surat Provider</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }

            if (!empty($row['dok_surat_perintah'])) {
                $doc_tagihan =  explode("#", $row['dok_surat_perintah']);
                if (empty($doc_tagihan[2])) {
                    $doc = '<span class="label label-important">Data Belum Tersedia</span>';
                } else {
                    $doc = anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                }
                $data['dokumen'] .= '<tr><td width="140">Surat Perintah</td><td width="100">' . $doc_tagihan[1] . '</td><td>' . $doc . '</td></tr>';
            }
        }
        $data['back'] =  anchor('ldp/index_tagihan', 'Kembali', array('class' => 'btn'));

        $this->template->display('ldp/detail_tagihan', $data);
    }

    function kelengkapan_tagihan($id)
    {
        $data['title'] = 'Edit Kelangkapan Tagihan';
        $data['link_back'] =  site_url('ldp/index');
        $data['action'] = 'ldp/add_kelengkapan_tagihan/' . $id;
        $tagihan =  $this->mdl_ldp->get_tagihan_by_id($id)->result_array();
        $data['dokumen'] = '';
        foreach ($tagihan as $row) {
            $data['program'] = $row['program'];
            $data['provider'] = $row['provider'];
            $data['tgl_pelaksanaan'] =  $this->editor->date_correct($row['tgl_mulai']) . 's/d' . $this->editor->date_correct($row['tgl_selesai']);
            $data['tgl_tagihan_masuk'] =  $this->editor->date_correct($row['tgl_tagihan_masuk']);
            $data['tgl_tagihan_gsfa'] =  $this->editor->date_correct($row['tgl_tagihan_gsfa']);
            $data['catatan'] =  $row['catatan'];
            $data['tgl_pembayaran'] =  $this->editor->date_correct($row['tgl_pembayaran']);

            if (!empty($row['dok_tagihan_provider'])) {
                $doc_tagihan =  explode("#", $row['dok_tagihan_provider']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Tagihan Provider</td>
        <td><input type="checkbox" name="cek_tagihan_provider" value="1" checked></td>
        <td><input type="text" name="no_tagihan_provider" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_tagihan_provider2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_tagihan_provider">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
        <input type="hidden" name="cek_tagihan_provider">
        <input type="hidden" name="no_tagihan_provider"/>
	<input type="hidden" name="dok_tagihan_provider">
                   
';
            }

            if (!empty($row['dok_absen_peserta'])) {
                $doc_tagihan =  explode("#", $row['dok_absen_peserta']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Absen Peserta</td>
        <td><input type="checkbox" name="cek_absen_peserta" value="1" checked></td>
        <td><input type="text" name="no_absen_peserta" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_absen_peserta2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_absen_peserta">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
<input type="hidden" name="cek_absen_peserta">
<input type="hidden" name="no_absen_peserta"/>
<input type="hidden" name="dok_absen_peserta">
                    
';
            }

            if (!empty($row['dok_absen_instruktur'])) {
                $doc_tagihan =  explode("#", $row['dok_absen_instruktur']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Absen Instruktur</td>
        <td><input type="checkbox" name="cek_absen_instruktur" value="1" checked></td>
        <td><input type="text" name="no_absen_instruktur" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_absen_instruktur2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_absen_instruktur">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
<input type="hidden" name="cek_absen_instruktur">
<input type="hidden" name="no_absen_instruktur"/>
<input type="hidden" name="dok_absen_instruktur">
';
            }

            if (!empty($row['dok_nota_pembayaran'])) {
                $doc_tagihan =  explode("#", $row['dok_nota_pembayaran']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Nota Pembayaran</td>
        <td><input type="checkbox" name="cek_nota_pembayaran" value="1" checked></td>
        <td><input type="text" name="no_nota_pembayaran" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_nota_pembayaran2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_nota_pembayaran">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
        <input type="hidden" name="cek_nota_pembayaran">
        <input type="hidden" name="no_nota_pembayaran"/>
	<input type="hidden" name="dok_nota_pembayaran">
                   
';
            }

            if (!empty($row['dok_kwitansi'])) {
                $doc_tagihan =  explode("#", $row['dok_kwitansi']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Kwitansi</td>
        <td><input type="checkbox" name="cek_kwitansi" value="1" checked></td>
        <td><input type="text" name="no_kwitansi" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_kwitansi2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_kwitansi">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
        <input type="hidden" name="cek_kwitansi">
        <input type="hidden" name="no_kwitansi"/>
	<input type="hidden" name="dok_kwitansi">
                   
';
            }

            if (!empty($row['dok_faktur_pajak'])) {
                $doc_tagihan =  explode("#", $row['dok_faktur_pajak']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Faktur Pajak</td>
        <td><input type="checkbox" name="cek_faktur_pajak" value="1" checked></td>
        <td><input type="text" name="no_faktur_pajak" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_faktur_pajak2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_faktur_pajak">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
        <input type="hidden" name="cek_faktur_pajak">
        <input type="hidden" name="no_faktur_pajak"/>
	<input type="hidden" name="dok_faktur_pajak">
                   
';
            }

            if (!empty($row['dok_ssp'])) {
                $doc_tagihan =  explode("#", $row['dok_ssp']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">SSP</td>
        <td><input type="checkbox" name="cek_ssp" value="1" checked></td>
        <td><input type="text" name="no_ssp" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_ssp2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_ssp">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
        <input type="hidden" name="cek_ssp">
        <input type="hidden" name="no_ssp"/>
	<input type="hidden" name="dok_ssp">
                   
';
            }

            if (!empty($row['dok_berita_acara'])) {
                $doc_tagihan =  explode("#", $row['dok_berita_acara']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Berita Acara</td>
        <td><input type="checkbox" name="cek_berita_acara" value="1" checked></td>
        <td><input type="text" name="no_berita_acara" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_berita_acara2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_berita_acara">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
        <input type="hidden" name="cek_berita_acara">
        <input type="hidden" name="no_berita_acara"/>
	<input type="hidden" name="dok_berita_acara">
                   
';
            }

            if (!empty($row['dok_surat_provider'])) {
                $doc_tagihan =  explode("#", $row['dok_surat_provider']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Surat Provider</td>
        <td><input type="checkbox" name="cek_surat_provider" value="1" checked></td>
        <td><input type="text" name="no_surat_provider" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_surat_provider2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_surat_provider">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
        <input type="hidden" name="cek_surat_provider">
        <input type="hidden" name="no_surat_provider"/>
	<input type="hidden" name="dok_surat_provider">
                   
';
            }

            if (!empty($row['dok_surat_perintah'])) {
                $doc_tagihan =  explode("#", $row['dok_surat_perintah']);
                if (!empty($doc_tagihan[2])) {
                    $dokumen =  anchor('./assets/uploads/ldp/' . $doc_tagihan[2], 'Download', array('class' => 'label label-success', 'target' => '_blank'));
                } else {
                    $dokumen = '<span class="label label-important">Belum Tersedia</span>';
                }
                $data['dokumen'] .= '
    <tr>
	<td valign="top">Surat Perintah</td>
        <td><input type="checkbox" name="cek_surat_perintah" value="1" checked></td>
        <td><input type="text" name="no_surat_perintah" value="' . $doc_tagihan[1] . '"/></td>
	<td><input type="hidden" name="dok_surat_perintah2" value="' . $doc_tagihan[2] . '"><input type="file" name="dok_surat_perintah">' . $dokumen . '</td>
    </tr>                    
';
            } else {
                $data['dokumen'] .= '
        <input type="hidden" name="cek_surat_perintah">
        <input type="hidden" name="no_surat_perintah"/>
	<input type="hidden" name="dok_surat_perintah">
                   
';
            }
        }

        $this->template->display('ldp/kelengkapan_tagihan', $data);
    }
    function edit_tagihan($id)
    {
        $data['title'] = 'Edit Tagihan';
        $data['link_back'] =  site_url('ldp/index');
        $data['action'] = 'ldp/add_edit_tagihan/' . $id;
        $tagihan =  $this->mdl_ldp->get_tagihan_by_id($id)->result_array();
        foreach ($tagihan as $row) {
            $data['program'] = $row['program'];
            $data['provider'] = $row['provider'];
            $data['tgl_mulai'] = $row['tgl_mulai'];
            $data['tgl_selesai'] = $row['tgl_selesai'];
            $data['tgl_tagihan_masuk'] =  $row['tgl_tagihan_masuk'];
            $data['tgl_dokumen_lengkap'] =  $row['tgl_dokumen_lengkap'];
            $data['tgl_tagihan_gsfa'] =  $row['tgl_tagihan_gsfa'];
            $data['catatan'] =  $row['catatan'];
            $data['tgl_pembayaran'] = $row['tgl_pembayaran'];

            $this->template->display('ldp/edit_tagihan', $data);
        }
    }
    function set_dok2($var1)
    {
        if (empty($var1)) {
            $dok = '';
        } else {
            $dok = $var1 . '##';
        }
        return $dok;
    }

    function set_dok($var1, $var2, $var3)
    {
        if (empty($var1)) {
            $dok = '';
        } else {
            $dok = $var1 . '#' . $var2 . '#' . $var3;
        }
        return $dok;
    }


    function _set_rules_tgihan()
    {
        $this->form_validation->set_rules('program', 'Data Program', 'required|trim');
    }

    function to_exel()
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
        $this->table->set_caption("Data Tagihan LDP");

        $this->table->set_heading(
            'No',
            'Program',
            'Lembaga Provider',
            'Tanggal Pelaksanaan',
            'Tagihan Masuk',
            'Tanggal Dokumen Lengkap',
            'Kelengkapan',
            'Tanggal Dokumen Ke GSFA',
            'Nilai SLA',
            'Pembayaran',
            'Tanggal Pembayaran'
        );
        $q = $this->mdl_ldp->get_all_tagihan()->result_array();
        $i = 0;

        $libur = $this->mdl_tln->get_libur()->result_array();
        $data_libur = '';
        foreach ($libur as $liburan) {
            $data_libur .= $liburan['date'] . '#';
        }

        $tgl_libur = explode('#', $data_libur);

        foreach ($q as $row) {

            $tgl_pelaksanaan =  $this->editor->date_correct($row['tgl_mulai']) . ' s/d ' . $this->editor->date_correct($row['tgl_selesai']);
            if (empty($row['tgl_dokumen_lengkap'])) {
                $tgl_dokumen_lengkap = 'Belum Dimasukan';
            } else {
                $tgl_dokumen_lengkap =  $this->editor->date_correct($row['tgl_dokumen_lengkap']);
            }

            //       $tgl_ahir=  date('Y-m-d');
            if (empty($row['tgl_tagihan_masuk']) or empty($row['tgl_dokumen_lengkap'])) {
                $kelengkapan = 0;
            } else {
                $kelengkapan = $this->editor->hitung_sla($row['tgl_tagihan_masuk'], $row['tgl_dokumen_lengkap'], $tgl_libur);
            }


            if (empty($row['tgl_tagihan_gsfa'])) {
                $tgl_dokumen_gsfa = 'Belum Dimasukan';
            } else {
                $tgl_dokumen_gsfa =  $this->editor->date_correct($row['tgl_tagihan_gsfa']);
            }

            if (empty($row['tgl_dokumen_lengkap']) or empty($row['tgl_tagihan_gsfa'])) {
                $nilai_sla = 0;
            } else {
                $nilai_sla = $this->editor->hitung_sla($row['tgl_dokumen_lengkap'], $row['tgl_tagihan_gsfa'], $tgl_libur);
            }

            if (empty($row['tgl_pembayaran'])) {
                $pembayaran = 'Unpaid';
            } else {
                $pembayaran = 'Paid';
            }
            if (empty($row['tgl_pembayaran'])) {
                $tgl_pembayaran = 'Belum Dimasukan';
            } else {
                $tgl_pembayaran = $row['tgl_pembayaran'];
            }


            $this->table->add_row(
                ++$i,
                $row['program'],
                $row['provider'],
                $tgl_pelaksanaan,
                $this->editor->date_correct($row['tgl_tagihan_masuk']),
                $tgl_dokumen_lengkap,
                $kelengkapan,
                $tgl_dokumen_gsfa,
                $nilai_sla,
                $pembayaran,
                $tgl_pembayaran
            );
        }
        //       $this->table->set_template(array('<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered">'));
        $data['content'] = $this->table->generate();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=ldp-tagihan.xls");  //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);


        echo $data['content'];
    }
}