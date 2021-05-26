<?php

class absen extends Member_Controller {
    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_peserta');
        $this->load->model('mdl_feedback');
        $this->load->model('mdl_trainer');
        $this->load->model('mdl_course');
    }

    function detai($id_course) {
        $data['title'] = 'Data Absensi';
        $data['link_back'] = site_url('course/index');

        $data['action'] = 'absen/postfb/' . $id_course;
        $data['course_id'] = $id_course;
        $data['upload_action'] = 'absen/upload_one';
        $data['jumlahfeedback'] = $this->mdl_feedback->get_fb_by_course($id_course)->num_rows();

        $this->load->library('table');
        $this->table->set_empty('$nbsp');
        $this->table->set_heading(
                array('data' => 'No', 'width' => 5), array('data' => 'Nama'), array('data' => 'Nopek', 'width' => 200), array('data' => 'Direktorat', 'width' => 300), array('data' => 'Kehadiran', 'width' => 160), 'Status'
        );
        $peserta = $this->mdl_peserta->get_by_id($id_course)->result_array();

        $i = 0;
        foreach ($peserta as $rows) {
            $this->table->add_row(
                    ++$i, $rows['nama'], $rows['nopek'], $rows['direktorat'], $this->button_group($rows['id'], $rows['kehadiran']), array('data' => $this->ket($rows['kehadiran'], $rows['id']), 'id' => 'ket_' . $rows['id'])
            );
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered">'));
        $data['content'] = $this->table->generate();
        $this->template->display('absen/index', $data);
    }

    function postfb($id) {
        $jumlahfeed = $this->input->post('feedback');
        redirect('feedback/add/'.$id.'/'.$jumlahfeed);
    }

    function button_group($val, $p) {
        return '
                <div class="btn-group" data-toggle-name="' . $val . '" data-toggle="buttons-radio">
                    <button type="button" class="btn btn-info" value="1" onclick="changeVal(\'' . $val . '\')">Hadir</button>
                    <button type="button" class="btn btn-info" value="0" onclick="changeVal(\'' . $val . '\')">Tidak Hadir</button>
                </div>
                    <input type="hidden" name="' . $val . '" value="' . $p . '" id="hidden_' . $val . '">
                <span id="msg_' . $val . '"></span>
           ';
    }

    function ket($var, $id) {
        if ($var == 1) {
            return '<img src="assets/img/publish.png" id="pub_' . $id . '"/>';
        } else {
            return '<img src="assets/img/unpublish.png" id="pub_' . $id . '"/>';
        }
    }

    function update_one() {
        $post = explode("#", $this->input->post('dataVal'));
        $id = $post[0];
        $val = $post[1];

        $q = $this->mdl_peserta->update_one($id, $val);
        if ($q) {
            $data['valueInput'] = $val;
            echo json_encode($data);
        }
    }


    function trainer($id){
        $data['title']='Data Pengajar';
        $trainer=$this->mdl_course->get_by_id($id)->row_array();
	    if($trainer['trainer']==0)
	    {
		$data['trainer']='';
	    } else {
		$trainers=explode("#", $trainer['trainer']);
		$data['trainer']='';
		$i=0;
		foreach ($trainers as $row_trainer)
		{
		    $tbl_trainer=$this->mdl_trainer->get_by_id($row_trainer)->row();
		    $data['trainer'].='<tr>';
		    $data['trainer'].='<td width="20"><div align="center">'.++$i.'</div></td>';
		    $data['trainer'].='<td>'.anchor('trainer/detail/'.$tbl_trainer->id,$tbl_trainer->name,array('rel'=>'tooltip','title'=>'Lihat data pengajar')).'</td>';
		    $data['trainer'].='<td>'.$tbl_trainer->job_experience.'</td>';
		    $data['trainer'].='<td>'.$tbl_trainer->certification.'</td>';
                    $feedback_trainer=  $this->mdl_feedback->get_fb_by($id,$tbl_trainer->id)->num_rows();
                    if ($feedback_trainer<=0){
                        $data['trainer'].='<form method="POST" action="absen/postfbtrainer/'.$id.'/'.$tbl_trainer->id.'">';
                        $data['trainer'].='<td><input name="feedback" type="text" class="input input-mini" style="width:20px">&nbsp;';
                        $data['trainer'].='<button class="btn btn-primary" type="submit">Input Feedback</button></td>';
                        $data['trainer'].='</form>';
                    }else{
                        $data['trainer'].='<td><a href="feedback/detail_trainer/'.$id.'/'.$tbl_trainer->id.'"><button class="btn btn-primary" type="submit">Lihat Feedback</button></a></td>';
                    }

		    $data['trainer'].='</tr>';

		}
	    }

            $this->template->display('absen/trainer',$data);

    }

    function postfbtrainer($id_course,$id_trainer) {
        $jumlahfeedback=  $this->input->post('feedback');
        redirect('feedback/fbtrainer/'.$id_course.'/'.$id_trainer.'/'.$jumlahfeedback);
    }

}
