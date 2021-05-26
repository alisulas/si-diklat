<?php

/**
 * Description of course
 *
 * @author Administrator
 */
class Activity extends Member_Controller {
//ad
    private $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_activity');
        $this->load->model('mdl_trainer');
        $this->load->model('mdl_peserta');
        $this->load->model('mdl_course');
        $this->load->model('mdl_schedule');
        $this->load->library('form_validation');
        $this->load->library(array('upload', 'session'));
    }

    /*
     * Create new training
     */

    function add($id) {
        if (empty($id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-error">Terjadi kesalahan</div>');
            redirect('course');
        } else {
            $data['title'] = 'Tambah Activity Baru';
            $data['link_back'] = site_url('activity/index');
            $data['action'] = 'activity/add/' . $id;
            $data['course_id'] = $id;

            $this->_set_rules();
            if ($this->form_validation->run() === FALSE) {
                $data['course_code'] = $this->mdl_course->get_by_id($id)->row()->code;
                $data['course_name'] = $this->mdl_course->get_by_id($id)->row()->course_name;
                $data['start_date'] = $this->mdl_course->get_by_id($id)->row()->start_date;
                $data['end_date'] = $this->mdl_course->get_by_id($id)->row()->end_date;
                $data['course_location'] = $this->mdl_course->get_by_id($id)->row()->location;
                $data['activity']['act1'] = '';
                $data['activity']['act2'] = '';
                $data['activity']['act3'] = '';
                $data['activity']['act4'] = '';
                $data['activity']['act5'] = '';
                $data['activity']['act6'] = '';
                $data['activity']['act7'] = '';
                $data['activity']['act8'] = '0';
                $data['activity']['act9'] = '';
                $data['activity']['act10'] = '';
                $data['activity']['file'] = '';
                $data['activity']['act12'] = '0';
                $data['activity']['act13'] = '0';
                $data['activity']['act14'] = '0';
                $data['activity']['act15'] = '0';
                $data['activity']['act16'] = '0';
                $data['activity']['act17'] = '0';
                $data['activity']['act18'] = '0';
                $data['activity']['act19'] = '';
                $data['activity']['act20'] = '';
                $data['activity']['act21'] = '';
                $data['activity']['act22'] = '';

                $this->template->display('activity/form', $data);
            } else {

                $this->upload->initialize(array(
                'upload_path' => './assets/uploads/memo/',
                'allowed_types' => '*',
                'max_size' => 5000, // 5MB
                'remove_spaces' => true,
                'overwrite' => false
            ));
            $data_act=  $this->input->post('file');

            if(!$this->upload->do_upload(array(
                    'act1','act5','act6','act7','act9',$data_act,'act19','act20','act21'
                )))
            {
                $data_act=  $this->input->post('file');
                if($data_act==0)
		{
		    $act_imp= 0;
		} else {
		    $act_imp= implode('#', $data_act);
		}

                $data_memo=array(
                   'act1'=> $this->input->post('act1'),
                   'act5'=> $this->input->post('act5'),
                   'act6'=> $this->input->post('act6'),
                   'act7'=> $this->input->post('act7'),
                   'act9'=> $this->input->post('act9'),
                   'act11'=> $act_imp,
                   'act19'=>$this->input->post('act19'),
                   'act20'=> $this->input->post('act20'),
                   'act21'=> $this->input->post('act21'),
                   'act22'=> $this->input->post('act22')
                );
            } else {
                $unggah = $this->upload->data();
                $unggah['file_name'];
                $data_memo=$unggah['file_name'];
            }
            $memo = array(
                'act1'=>$data_memo['act1'],
                'act5'=>$data_memo['act5'],
                'act6'=>$data_memo['act6'],
                'act7'=>$data_memo['act7'],
                'act9'=>$data_memo['act9'],
                'act11'=>$data_memo['act11'],
                'act19'=>$data_memo['act19'],
                'act20'=>$data_memo['act20'],
                'act21'=>$data_memo['act21'],
                'act22'=>$data_memo['act22'],
                'plc_course_id' => $this->input->post('course_id'),
                'act8'=> $this->input->post('act8'),
                'act12'=> $this->input->post('act12'),
                'act13'=> $this->input->post('act13'),
                'act14'=> $this->input->post('act14'),
                'act15'=> $this->input->post('act15'),
                'act16'=> $this->input->post('act16'),
                'act17'=> $this->input->post('act17'),
                'act18'=> $this->input->post('act18'),

            );

                $id_act = $this->mdl_activity->add_activity($memo);
                $this->validation->id = $id_act;
                $this->session->set_flashdata('msg', '<div class="alert alert-success">activity baru berhasil ditambahkan</div>');
                redirect('activity/detail/' .$id);
            }
        }
    }



    /*
     * Create new training
     */

    function edit($id) {
        if($id==null)
	{
	    $this->session->set_flashdata('msg',$this->editor->alert_error('Error!'));
	    redirect('dashboard');
	} else {
	    $act=$this->mdl_activity->get_by_id($id);
	    if($act->num_rows() <=0)
	    {
		$var=array('plc_course_id'=>$id);
		$q=$this->mdl_activity->add_activity($var);
		$this->session->set_flashdata('msg',$this->editor->alert_ok('Kelengkapan telah ditambahkan'));
		redirect('activity/edit/'.$id);
	    }else{
        $data['title'] = 'Kelengkapan Pelatihan';
        $data['link_back'] = site_url('dashboard/index');
        $data['action'] = 'activity/edit/' . $id;
	$data['upload_action']='activity/upload_one';
        $this->_set_rules();
        if ($this->form_validation->run() === FALSE) {
            $data['course_code'] = $this->mdl_course->get_by_id($id)->row()->code;
            $data['course_name'] = $this->mdl_course->get_by_id($id)->row()->course_name;
            $data['start_date'] = $this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->start_date);
            $data['end_date'] = $this->editor->date_correct($this->mdl_course->get_by_id($id)->row()->end_date);
            $data['course_location'] = $this->mdl_course->get_by_id($id)->row()->location;
            $data['activity'] = $this->mdl_activity->get_by_id($id)->row_array();
            $date_update = $this->mdl_activity->get_by_id($id)->row()->date_update;
            $data['date_update']=  $this->editor->date_correct($date_update);
            $data['course_id'] = $data['activity']['plc_course_id'];
	    $provider=$this->mdl_course->get_provider_by_id($this->mdl_course->get_kursil_by_course($id)->row()->plc_provider_id)->row();
	    $provider_name=$provider->name;
	    $provider_id=$provider->id;
	    $data['provider']=anchor('provider/detail/'.$provider_id,$provider_name);

	    $trainer=$this->mdl_course->get_kursil_by_course($id)->row_array();
	    if($trainer['trainers']==0)
	    {
		$data['trainer']='';
	    } else {
		$trainers=explode("#", $trainer['trainers']);
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
		    $data['trainer'].='</tr>';

		}
	    }
            $data['peserta']='';
            $peserta=  $this->mdl_peserta->get_by_id($id)->result_array();
            $data['jumlah_peserta']=  count($peserta);
            foreach ($peserta as $tbl_peserta) {
                $data['peserta'].='<tr>';
                $data['peserta'].='<td>'.$tbl_peserta['nama'].'</td>';
                $data['peserta'].='<td>'.$tbl_peserta['nopek'].'</td>';
                $data['peserta'].='<td>'.$tbl_peserta['direktorat'].'</td>';
                $data['peserta'].='</tr>';
            }
	    /* Upload form */
	    for($i=1;$i<23;$i++)
	    {
		$data['upload_act'.$i]=$this->cek_upload($id, 'act'.$i);
		$data['info_act'.$i]=$this->cek_upload_info($id, 'act'.$i);
	    }

        } else {

            $activity = array(
                'plc_course_id' => $this->input->post('course_id'),
                'act1' => $this->input->post('act1'),
                'act2' => $this->input->post('act2'),
                'act3' => $this->input->post('act3'),
                'act4' => $this->input->post('act4'),
                'act5' => $this->input->post('act5'),
                'act6' => $this->input->post('act6'),
                'act7' => $this->input->post('act7'),
                'act8' => $this->input->post('act8'),
                'act9' => $this->input->post('act9'),
                'act10' => $this->input->post('act10'),
                'act11' => $this->input->post('act11'),
                'act12' => $this->input->post('act12'),
                'act13' => $this->input->post('act13'),
                'act14' => $this->input->post('act14'),
                'act15' => $this->input->post('act15'),
                'act16' => $this->input->post('act16'),
                'act17' => $this->input->post('act17'),
                'act18' => $this->input->post('act18'),
                'act19' => $this->input->post('act19'),
                'act22' => $this->input->post('act22'),
                'date_update' => date('Y-m-d G:i:s'),
            );
            $this->mdl_activity->update($id, $activity);
            $this->session->set_flashdata('msg', $this->editor->alert_ok('Aktifitas telah diperbarui'));
            $data['activity'] = $this->mdl_activity->get_by_id($id)->row_array();
            redirect('activity/detail/' . $id);
        }

	$data['program_title']=  $this->mdl_course->get_by_id($id)->row()->course_name;
        $this->template->display('activity/form', $data);
    
        }
        }
    }

    // validation rules
    function _set_rules() {
        $this->form_validation->set_rules('course_id', 'Nama Program', 'required|trim');
    }

    function delete($id) {
        $this->mdl_activity->delete($id);
        $this->session->set_flashdata('msg', $this->editor->alert_ok('Aktifitas telah dihapus'));
        redirect('course');
    }

    function detail($id=null) {
	if($id==null)
	{
	    $this->session->set_flashdata('msg',$this->editor->alert_error('Error!'));
	    redirect('course');
	} else {
	    $act=$this->mdl_activity->get_by_id($id);
	    if($act->num_rows() <=0)
	    {
		$var=array('plc_course_id'=>$id);
		$q=$this->mdl_activity->add_activity($var);
		$this->session->set_flashdata('msg',$this->editor->alert_ok('Aktifitas telah ditambahkan'));
		redirect('activity/detail/'.$id);
	    } else {
		$data['title'] = 'Formulir  activity Pembelajaran Pertamina Learning Center';
		$data['course_code'] = $this->mdl_course->get_by_id($id)->row()->code;
		$data['course_name'] = $this->mdl_course->get_by_id($id)->row()->course_name;
		$data['start_date'] = $this->mdl_course->get_by_id($id)->row()->start_date;
		$data['end_date'] = $this->mdl_course->get_by_id($id)->row()->end_date;
		$data['course_location'] = $this->mdl_course->get_by_id($id)->row()->location;
		$data['activity'] = $this->mdl_activity->get_by_id($id)->row_array();
		$this->template->display('activity/detail', $data);
	    }
	}

    }

    function update_one()
    {
	$post=explode("#", $this->input->post('dataVal'));
	$id=$post[0];
	$field=$post[1];
	$val=$post[2];

	$q=$this->mdl_activity->update_one($id,$field,$val);
	if($q)
	{
	    $data['valueInput']=$val;
	    echo json_encode($data);
	}
    }

    function upload_file($course_id,$id)
    {
	    $name = $this->input->post('fileName');
	    $q=$this->mdl_activity->upload_file($course_id,$id,$name);
	    if($q)
	    {
		$data[]['final']='true';
	    } else {
		$data[]['final']='false';
	    }
	    echo json_encode($data);
    }

    protected function explode_s($r)
    {
	$s=explode("#", $r);
	if(!empty($s[1]))
	{
	    $q=$this->mdl_trainer->get_by_id($s[1])->row()->name;
	    $jdw=anchor('trainer/detail/'.$s[1],$q,array('rel'=>'tooltip','title'=>'Klik untuk melihat detail pemateri'));
	    return $s[0].'<br />('.$jdw.')';
	} else {
	    return $s[0];
	}
    }

    protected function cek_upload($id,$field)
    {
	if($this->mdl_activity->get_by_id($id)->row()->$field !=NULL)
	{
	    return '<button class="btn btn-info" onclick="editUpload(\''.$field.'\')">Edit</button>&nbsp;<a href="activity/download/'.$id.'/'.$field.'" class="btn btn-success">Download File</a>';
	} else {
	    return $this->editor->upload_input($field,$id);
	}
    }

    protected function cek_upload_info($id,$field)
    {
	if($this->mdl_activity->get_by_id($id)->row()->$field !=NULL)
	{
	    return '<img src="assets/img/publish.png" id="pub_'.$field.'"/>';
	} else {
	    return '<img src="assets/img/unpublish.png" id="pub_'.$field.'"/>';
	}
    }

    function download($id,$field)
    {
	$this->load->helper('download');

	$path_upload='assets/uploads/';
	$name = $this->mdl_activity->download($id,$field);
	$file=$path_upload.$name;

	$data = file_get_contents($file);
	force_download($name,$data);
    }

    function edit_upload()
    {
	$id=$this->input->post('val');
	$course_id=$this->input->post('courseId');
	$data['form']=$this->editor->upload_input($id,$course_id);
	$this->load->view('activity/edit',$data);
    }
}

/* End of file activity.php */
/* Location: ./application/controllers/activity.php */
