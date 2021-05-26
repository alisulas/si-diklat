<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Feedback extends Member_Controller {

    private $limit = 10;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_feedback');
        $this->load->model('mdl_course');
        $this->load->model('mdl_trainer');
    }

    function index($offset = 0) {
        $this->get_index($offset);
    }

    /*
     * Get index table
     */

    protected function get_index($offset) {
        $data['title'] = 'Data Pelatihan';
        $this->load->library('pagination');
        if (empty($offset)) {
            $offset = 0;
        }
        
        /* Pagination */
        $config['base_url'] = site_url('course/index/');
        $config['total_rows'] = $this->mdl_course->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        /* List Table */
        $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                array('data'=>'No','width'=>'10'), 'Kode', 'Nama Pelatihan', array('data'=>'Feedback Peserta','width'=>'120'),array('data'=>'Feedback Trainer','width'=>'120')
        );
        $q = $this->mdl_course->get_index($this->limit, $offset,$month=0,$status=0)->result_array();
        $i = 0 + $offset;
        foreach ($q as $row) {
             if($this->mdl_feedback->get_feedbackpeserta_by_course($row['id'])->num_rows() <= 0)
	    {
		$lbl_peserta='<span class="label label-error">Belum Lengkap</span>';
		$rel_peserta='Klik untuk menambahkan Feedback';
                
                if($this->session->userdata('user_id')==1){
                $fb_peserta_btn = anchor('absen/detail/' .$row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary', 'rel' => 'tooltip', 'title' => $rel_peserta));
                }else{
                $fb_peserta_btn = '<button class="btn btn-primary"><i class="icon-search icon-white"></i></button>';    
                }
	    } else {
		$lbl_peserta='<span class="label label-success">Sudah Lengkap</span>';
		$rel_peserta='Klik untuk melihat Feedback';
                 $fb_peserta_btn = anchor('absen/detail/' .$row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary', 'rel' => 'tooltip', 'title' => $rel_peserta));
               
	    }
            
            $trainer=  $this->mdl_feedback->get_by_course_id($row['id'])->row()->trainer;
            $data_trainers= explode('#',$trainer);
            $jumlah_trainer=count($data_trainers);

            if($this->mdl_feedback->get_trainer_by_course($row['id'])->num_rows() < $jumlah_trainer)
	    {
		$lbl_trainer='<span class="label label-error">Belum Lengkap</span>';
		$rel_trainer='Klik untuk menambahkan Feedback';
                
            if ($this->session->userdata('user_id')==1){
            $fb_trainer_btn = anchor('absen/trainer/' . $row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary', 'rel' => 'tooltip', 'title' => $rel_trainer));                
            }else{
                $fb_trainer_btn = '<button class="btn btn-primary"><i class="icon-search icon-white"></i></button>';    
                
            }
            
	    } else {
		$lbl_trainer='<span class="label label-success">Sudah Lengkap</span>';
		$rel_trainer='Klik untuk melihat Feedback';
	    $fb_trainer_btn = anchor('absen/trainer/' . $row['id'], '<i class="icon-search icon-white"></i>', array('class' => 'btn btn-primary', 'rel' => 'tooltip', 'title' => $rel_trainer));                
            
                
            }
            //  $fb_peserta_btn= anchor('feedback/kursil/'.$row['id'],'<i class="icon-search icon-white"></i>',array('class'=>'btn btn-primary','rel'=>'tooltip','title'=>$rel_kursil));
            
           
            $this->table->add_row(
                    ++$i, $row['code'], $row['course_name'], '<div align="center">' . $fb_peserta_btn . '<br />' . $lbl_peserta . '</div>','<div align="center">' . $fb_trainer_btn . '<br />' . $lbl_trainer . '</div>'
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('feedback/index', $data);
    }

    function add($id, $jml) {
        if (empty($id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-error">Terjadi Kesalahan</div>');
        } else {
            $data['course_id'] = $id;
            $data['title'] = 'Form Feedback';
            $data['action'] = 'feedback/postadd/' . $id . '/' . $jml;
            $data['link_back'] = site_url('feedback/index');

            $jumlahpeserta = $this->mdl_feedback->count_all($id);

            $data['jumlahpeserta'] = $jml;

            $this->template->display('feedback/form', $data);
        }
    }
    
    function fbtrainer($id_course,$id_trainer,$jml_feedback) {
       if (empty($id_course)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-error">Terjadi Kesalahan</div>');
        } else {
            $data['course_id'] = $id_course;
            $data['trainer_id']=$id_trainer;
            $data['title'] = 'Form Feedback Instruktur';
            $data['action'] = 'feedback/postaddtrainer';
            $data['link_back'] = site_url('feedback/index');
            $data['trainer_name']=  $this->mdl_trainer->get_by_id($id_trainer)->row()->name;
            $data['course_name']=  $this->mdl_course->get_by_id($id_course)->row()->course_name;
            $data['start_date']=  $this->mdl_course->get_by_id($id_course)->row()->start_date;
            $data['end_date']=  $this->mdl_course->get_by_id($id_course)->row()->end_date;
            $data['jumlahpeserta'] = $jml_feedback;

            $this->template->display('feedback/form_trainer', $data);
        } 
    }

    function detail($id) {
        $data['title'] = 'Formulir Umpan Balik Program Pembelajaran';
        $data['id_course']=$id;
        $data['course_name'] = $this->mdl_feedback->get_by_course_id($id)->row()->course_name;
        $data['start_date'] = $this->mdl_feedback->get_by_course_id($id)->row()->start_date;
        $data['end_date'] = $this->mdl_feedback->get_by_course_id($id)->row()->end_date;
        $jumlah_peserta = $this->mdl_feedback->count_all($id);
        if ($jumlah_peserta==0) {
            $data['jumlah_peserta']=1;
        }else{
            $data['jumlah_peserta']=$jumlah_peserta;
        }
        $data['jumlah_feedback'] = $this->mdl_feedback->get_by_id($id)->row()->jml;

        $data['totalfb1'] = $this->mdl_feedback->get_by_id($id)->row()->fb_1;
        $data['totalfb2'] = $this->mdl_feedback->get_by_id($id)->row()->fb_2;
        $data['totalfb3'] = $this->mdl_feedback->get_by_id($id)->row()->fb_3;
        $data['totalfb4'] = $this->mdl_feedback->get_by_id($id)->row()->fb_4;
        $data['totalfb5'] = $this->mdl_feedback->get_by_id($id)->row()->fb_5;
        $data['jumlahcom1'] = $data['totalfb1'] + $data['totalfb2'] + $data['totalfb3'] + $data['totalfb4'] + $data['totalfb5'];
        $data['ratacom1'] = $data['jumlahcom1'] / $data['jumlah_feedback'] / 5;
        $data['prosentase_com1'] = $data['jumlah_feedback'] / $data['jumlah_peserta'] * 100;
        $data['com1'] = $this->mdl_feedback->get_by_id($id)->row()->com1;

        $data['totalfb6'] = $this->mdl_feedback->get_by_id($id)->row()->fb_6;
        $data['totalfb7'] = $this->mdl_feedback->get_by_id($id)->row()->fb_7;
        $data['totalfb8'] = $this->mdl_feedback->get_by_id($id)->row()->fb_8;
        $data['totalfb9'] = $this->mdl_feedback->get_by_id($id)->row()->fb_9;
        $data['totalfb10'] = $this->mdl_feedback->get_by_id($id)->row()->fb_10;
        $data['jumlahcom2'] = $data['totalfb6'] + $data['totalfb7'] + $data['totalfb8'] + $data['totalfb9'] + $data['totalfb10'];
        $data['ratacom2'] = $data['jumlahcom2'] / $data['jumlah_feedback'] / 5;
        $data['prosentase_com2'] = $data['jumlah_feedback'] / $data['jumlah_peserta'] * 100;
        $data['com2'] = $this->mdl_feedback->get_by_id($id)->row()->com2;


        $data['totalfb11'] = $this->mdl_feedback->get_by_id($id)->row()->fb_11;
        $data['totalfb12'] = $this->mdl_feedback->get_by_id($id)->row()->fb_12;
        $data['totalfb13'] = $this->mdl_feedback->get_by_id($id)->row()->fb_13;
        $data['jumlahcom3'] = $data['totalfb11'] + $data['totalfb12'] + $data['totalfb13'];
        $data['ratacom3'] = $data['jumlahcom3'] / $data['jumlah_feedback'] / 3;
        $data['prosentase_com3'] = $data['jumlah_feedback'] / $data['jumlah_peserta'] * 100;
        $data['com3'] = $this->mdl_feedback->get_by_id($id)->row()->com3;

        $data['totalfb14'] = $this->mdl_feedback->get_by_id($id)->row()->fb_14;
        $data['totalfb15'] = $this->mdl_feedback->get_by_id($id)->row()->fb_15;
        $data['totalfb16'] = $this->mdl_feedback->get_by_id($id)->row()->fb_16;
        $data['totalfb17'] = $this->mdl_feedback->get_by_id($id)->row()->fb_17;
        $data['jumlahcom4'] = $data['totalfb14'] + $data['totalfb15'] + $data['totalfb16'] + $data['totalfb17'];
        $data['ratacom4'] = $data['jumlahcom4'] / $data['jumlah_feedback'] / 4;
        $data['prosentase_com4'] = $data['jumlah_feedback'] / $data['jumlah_peserta'] * 100;
        $data['com4'] = $this->mdl_feedback->get_by_id($id)->row()->com4;

        $data['totalfb18'] = $this->mdl_feedback->get_by_id($id)->row()->fb_18;
        $data['jumlahcom5'] = $data['totalfb18'];
        $data['ratacom5'] = $data['jumlahcom5'] / $data['jumlah_feedback'] / 1;
        $data['prosentase_com5'] = $data['jumlah_feedback'] / $data['jumlah_peserta'] * 100;
        $data['com5'] = $this->mdl_feedback->get_by_id($id)->row()->com5;

        $data['totalfb19'] = $this->mdl_feedback->get_by_id($id)->row()->fb_19;
        $data['totalfb20'] = $this->mdl_feedback->get_by_id($id)->row()->fb_20;
        $data['jumlahcom6'] = $data['totalfb19'] + $data['totalfb20'];
        $data['ratacom6'] = $data['jumlahcom6'] / $data['jumlah_feedback'] / 2;
        $data['prosentase_com6'] = $data['jumlah_feedback'] / $data['jumlah_peserta'] * 100;
        $data['com6'] = $this->mdl_feedback->get_by_id($id)->row()->com6;


        $data['totalfb21'] = $this->mdl_feedback->get_by_id($id)->row()->fb_21;
        $data['totalfb22'] = $this->mdl_feedback->get_by_id($id)->row()->fb_22;
        $data['totalfb23'] = $this->mdl_feedback->get_by_id($id)->row()->fb_23;
        $data['totalfb24'] = $this->mdl_feedback->get_by_id($id)->row()->fb_24;
        $data['totalfb25'] = $this->mdl_feedback->get_by_id($id)->row()->fb_25;
        $data['totalfb26'] = $this->mdl_feedback->get_by_id($id)->row()->fb_26;
        $data['totalfb27'] = $this->mdl_feedback->get_by_id($id)->row()->fb_27;
        $data['totalfb28'] = $this->mdl_feedback->get_by_id($id)->row()->fb_28;
        $data['totalfb29'] = $this->mdl_feedback->get_by_id($id)->row()->fb_29;
        $data['totalfb30'] = $this->mdl_feedback->get_by_id($id)->row()->fb_30;
        $data['totalfb31'] = $this->mdl_feedback->get_by_id($id)->row()->fb_31;
        $data['jumlahcom7'] = $data['totalfb21'] + $data['totalfb22'] + $data['totalfb23'] + $data['totalfb24'] + $data['totalfb25'] + $data['totalfb26'] + $data['totalfb27'] + $data['totalfb28'] + $data['totalfb29'] + $data['totalfb30'] + $data['totalfb31'];
        $data['ratacom7'] = $data['jumlahcom7'] / $data['jumlah_feedback'] / 11;
        $data['prosentase_com7'] = $data['jumlah_feedback'] / $data['jumlah_peserta'] * 100;
        $data['com7'] = $this->mdl_feedback->get_by_id($id)->row()->com7;

        $this->template->display('feedback/detail', $data);
    }

    function postadd($id, $jml) {
        $jumlahpeserta = $jml;
        $jumlahfb1 = 0;
        $jumlahfb2 = 0;
        $jumlahfb3 = 0;
        $jumlahfb4 = 0;
        $jumlahfb5 = 0;
        $jumlahfb6 = 0;
        $jumlahfb7 = 0;
        $jumlahfb8 = 0;
        $jumlahfb9 = 0;
        $jumlahfb10 = 0;
        $jumlahfb11 = 0;
        $jumlahfb12 = 0;
        $jumlahfb13 = 0;
        $jumlahfb14 = 0;
        $jumlahfb15 = 0;
        $jumlahfb16 = 0;
        $jumlahfb17 = 0;
        $jumlahfb18 = 0;
        $jumlahfb19 = 0;
        $jumlahfb20 = 0;
        $jumlahfb21 = 0;
        $jumlahfb22 = 0;
        $jumlahfb23 = 0;
        $jumlahfb24 = 0;
        $jumlahfb25 = 0;
        $jumlahfb26 = 0;
        $jumlahfb27 = 0;
        $jumlahfb28 = 0;
        $jumlahfb29 = 0;
        $jumlahfb30 = 0;
        $jumlahfb31 = 0;
        for ($i = 1; $i <= $jumlahpeserta; $i++) {
            $jumlahfb1 +=$this->input->post('fb1_' . $i);
            $jumlahfb2 +=$this->input->post('fb2_' . $i);
            $jumlahfb3 +=$this->input->post('fb3_' . $i);
            $jumlahfb4 +=$this->input->post('fb4_' . $i);
            $jumlahfb5 +=$this->input->post('fb5_' . $i);
            $jumlahfb6 +=$this->input->post('fb6_' . $i);
            $jumlahfb7 +=$this->input->post('fb7_' . $i);
            $jumlahfb8 +=$this->input->post('fb8_' . $i);
            $jumlahfb9 +=$this->input->post('fb9_' . $i);
            $jumlahfb10 +=$this->input->post('fb10_' . $i);
            $jumlahfb11 +=$this->input->post('fb11_' . $i);
            $jumlahfb12 +=$this->input->post('fb12_' . $i);
            $jumlahfb13 +=$this->input->post('fb13_' . $i);
            $jumlahfb14 +=$this->input->post('fb14_' . $i);
            $jumlahfb15 +=$this->input->post('fb15_' . $i);
            $jumlahfb16 +=$this->input->post('fb16_' . $i);
            $jumlahfb17 +=$this->input->post('fb17_' . $i);
            $jumlahfb18 +=$this->input->post('fb18_' . $i);
            $jumlahfb19 +=$this->input->post('fb19_' . $i);
            $jumlahfb20 +=$this->input->post('fb20_' . $i);
            $jumlahfb21 +=$this->input->post('fb21_' . $i);
            $jumlahfb22 +=$this->input->post('fb22_' . $i);
            $jumlahfb23 +=$this->input->post('fb23_' . $i);
            $jumlahfb24 +=$this->input->post('fb24_' . $i);
            $jumlahfb25 +=$this->input->post('fb25_' . $i);
            $jumlahfb26 +=$this->input->post('fb26_' . $i);
            $jumlahfb27 +=$this->input->post('fb27_' . $i);
            $jumlahfb28 +=$this->input->post('fb28_' . $i);
            $jumlahfb29 +=$this->input->post('fb29_' . $i);
            $jumlahfb30 +=$this->input->post('fb30_' . $i);
            $jumlahfb31 +=$this->input->post('fb31_' . $i);
        }
        $var = array(
            'plc_course_id' => $this->input->post('course_id'),
            'fb_1' => $jumlahfb1,
            'fb_2' => $jumlahfb2,
            'fb_3' => $jumlahfb3,
            'fb_4' => $jumlahfb4,
            'fb_5' => $jumlahfb5,
            'com1' => $this->input->post('com1'),
            'fb_6' => $jumlahfb6,
            'fb_7' => $jumlahfb7,
            'fb_8' => $jumlahfb8,
            'fb_9' => $jumlahfb9,
            'fb_10' => $jumlahfb10,
            'com2' => $this->input->post('com2'),
            'fb_11' => $jumlahfb11,
            'fb_12' => $jumlahfb12,
            'fb_13' => $jumlahfb13,
            'com3' => $this->input->post('com3'),
            'fb_14' => $jumlahfb14,
            'fb_15' => $jumlahfb15,
            'fb_16' => $jumlahfb16,
            'fb_17' => $jumlahfb17,
            'com4' => $this->input->post('com4'),
            'fb_18' => $jumlahfb18,
            'com5' => $this->input->post('com5'),
            'fb_19' => $jumlahfb19,
            'fb_20' => $jumlahfb20,
            'com6' => $this->input->post('com6'),
            'fb_21' => $jumlahfb21,
            'fb_22' => $jumlahfb22,
            'fb_23' => $jumlahfb23,
            'fb_24' => $jumlahfb24,
            'fb_25' => $jumlahfb25,
            'fb_26' => $jumlahfb26,
            'fb_27' => $jumlahfb27,
            'fb_28' => $jumlahfb28,
            'fb_29' => $jumlahfb29,
            'fb_30' => $jumlahfb30,
            'fb_31' => $jumlahfb31,
            'com7' => $this->input->post('com7'),
            'jml' => $jml
        );
        $this->mdl_feedback->add($var);
        $this->session->set_flashdata('msg', $this->editor->alert_ok('Data peserta berhasil dimasukkan'));
        redirect('feedback/detail/' . $id);
    }
    
    function postaddtrainer(){
       $jumlahpeserta = $this->input->post('jumlahpeserta');
       $course_id=  $this->input->post('course_id');
       $trainer_id=  $this->input->post('trainer_id');
        $jumlahft1 = 0;
        $jumlahft2 = 0;
        $jumlahft3 = 0;
        $jumlahft4 = 0;
        $jumlahft5 = 0;
        $jumlahft6 = 0;
        $jumlahft7 = 0;
        
        for ($i = 1; $i <= $jumlahpeserta; $i++) {
            $jumlahft1 +=$this->input->post('ft1_' . $i);
            $jumlahft2 +=$this->input->post('ft2_' . $i);
            $jumlahft3 +=$this->input->post('ft3_' . $i);
            $jumlahft4 +=$this->input->post('ft4_' . $i);
            $jumlahft5 +=$this->input->post('ft5_' . $i);
            $jumlahft6 +=$this->input->post('ft6_' . $i);
            $jumlahft7 +=$this->input->post('ft7_' . $i);
            
        }
        $var = array(
            'plc_course_id' => $course_id,
            'plc_trainer_id'=>  $trainer_id,
            'ft1' => $jumlahft1,
            'ft2' => $jumlahft2,
            'ft3' => $jumlahft3,
            'ft4' => $jumlahft4,
            'ft5' => $jumlahft5,
            'ft6' => $jumlahft6,
            'ft7' => $jumlahft7,
            'com' => $this->input->post('com'),
            'jml' => $jumlahpeserta
        );
        $this->mdl_feedback->add_trainer($var);
        $this->session->set_flashdata('msg', $this->editor->alert_ok('Data Trainer berhasil dimasukkan'));
        redirect('feedback/detail_trainer/'.$course_id.'/'.$trainer_id);  
    }
    
    function detail_trainer($course_id,$trainer_id) {
        $data['title']='Detail Evaluasi Trainer';
        $data['course_id']=$course_id;
        $data['trainer_name']=  $this->mdl_trainer->get_by_id($trainer_id)->row()->name;
        $data['course_name']=  $this->mdl_course->get_by_id($course_id)->row()->course_name;
        $data['start_date']=  $this->mdl_course->get_by_id($course_id)->row()->start_date;
        $data['end_date']=  $this->mdl_course->get_by_id($course_id)->row()->end_date;
        
        $data['id_feedback']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->id;
        $data['ft1']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->ft1;
        $data['ft2']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->ft2;
        $data['ft3']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->ft3;
        $data['ft4']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->ft4;
        $data['ft5']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->ft5;
        $data['ft6']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->ft6;
        $data['ft7']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->ft7;
        $data['jumlah_feedback']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->jml;
        $data['com']=  $this->mdl_feedback->get_fb_by($course_id,$trainer_id)->row()->com;
        $jml_peserta = $this->mdl_feedback->count_all($course_id);
        if ($jml_peserta==0) {
            $data['jumlah_peserta']=1;
        }  else {
        $data['jumlah_peserta']=$jml_peserta;    
        }
        
        $data['jumlah'] = $data['ft1'] + $data['ft2'] + $data['ft3'] + $data['ft4'] + $data['ft5']+ $data['ft6']+ $data['ft7'];
        $data['rata'] = $data['jumlah'] / $data['jumlah_feedback'] / 7;
        $data['prosentase'] = $data['jumlah_feedback'] / $data['jumlah_peserta'] * 100;
        
        $this->template->display('feedback/detail_trainer',$data);
    }
    
    
    function delete_trainer($id_feedback,$id_course) {
        $this->mdl_feedback->delete_trainer($id_feedback);
         $this->session->set_flashdata('msg','<div class="alert alert-success"">trainer '.$id.' berhasil dihapus</div>');
         redirect('absen/trainer/'.$id_course);
    }
    function delete_fb_peserta($id_course) {
        $this->mdl_feedback->delete_fb_peserta($id_course);
         $this->session->set_flashdata('msg','<div class="alert alert-success"">trainer '.$id.' berhasil dihapus</div>');
         redirect('absen/detail/'.$id_course);
    }

}

?>
