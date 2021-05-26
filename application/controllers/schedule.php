<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Schedule extends Member_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mdl_schedule');
        $this->load->model('mdl_course');
        $this->load->model('mdl_trainer');
    }

    protected function btn($var1,$var2)
    {
        return '<a href="#schedule" class="btn btn-inverse" data-toggle="modal" onclick="editSchedule(\''.$var1.'\',\''.$var2.'\')">Edit</a>';
    }

    function view($id=null){
        if($id==null){
            $this->session->set_flashdata('msg', $this->editor->alert_error('Terjadi Kesalahan'));
	    redirect('course');
        }else{
	    $sch=$this->mdl_schedule->get_by_course_id($id);
	    if($sch->num_rows() <= 0){
		for($i=1;$i<3;$i++)
		{
		    for($j=1;$j<8;$j++)
		    {
			$var=array(
			    'plc_course_id'=>$id,
			    'w'=>$i,
			    'd'=>$j
			);
			$this->mdl_schedule->init($var);
		    }
		}
		$this->session->set_flashdata('msg',$this->editor->alert_ok('schedule telah ditambahkan'));
		redirect('schedule/view/'.$id);
	    } else {
		$data['title']='Schedule Pembelajaran';
		$data['action']='schedule/add/'.$id;
		$data['course_id']=$id;
		$data['course_code'] = $this->mdl_course->get_by_id($id)->row()->code;
                $data['course_name'] = $this->mdl_course->get_by_id($id)->row()->course_name;
                $data['start_date'] = $this->mdl_course->get_by_id($id)->row()->start_date;
                $data['end_date'] = $this->mdl_course->get_by_id($id)->row()->end_date;
                $data['course_location'] = $this->mdl_course->get_by_id($id)->row()->location;

		$this->load->library('table');
		$this->table->set_empty('&nbsp');
		for($i=1;$i<3;$i++)
		{
		    for($j=1;$j<8;$j++)
		    {
			$jdw[$i][$j]=$this->mdl_schedule->get_by_id($id,$i,$j);
			$jadwal[$i][$j]=$jdw[$i][$j]->row();
			if($jdw[$i][$j]->num_rows() <=0){
			    $j1[$i][$j]='';
			    $j2[$i][$j]='';
			    $j3[$i][$j]='';
			    $j4[$i][$j]='';
			    $j5[$i][$j]='';
			    $j6[$i][$j]='';
			    $j7[$i][$j]='';
			    $j8[$i][$j]='';
			    $j9[$i][$j]='';
			    $j10[$i][$j]='';
			    $j11[$i][$j]='';
			    $j12[$i][$j]='';
			    $j13[$i][$j]='';
			    $j14[$i][$j]='';
			} else {
			    $j1[$i][$j]=$this->explode_s($jadwal[$i][$j]->t1);
			    $j2[$i][$j]=$this->explode_s($jadwal[$i][$j]->t2);
			    $j3[$i][$j]=$this->explode_s($jadwal[$i][$j]->t3);
			    $j4[$i][$j]=$this->explode_s($jadwal[$i][$j]->t4);
			    $j5[$i][$j]=$this->explode_s($jadwal[$i][$j]->t5);
			    $j6[$i][$j]=$this->explode_s($jadwal[$i][$j]->t6);
			    $j7[$i][$j]=$this->explode_s($jadwal[$i][$j]->t7);
			    $j8[$i][$j]=$this->explode_s($jadwal[$i][$j]->t8);
			    $j9[$i][$j]=$this->explode_s($jadwal[$i][$j]->t9);
			    $j10[$i][$j]=$this->explode_s($jadwal[$i][$j]->t10);
			    $j11[$i][$j]=$this->explode_s($jadwal[$i][$j]->t11);
			    $j12[$i][$j]=$this->explode_s($jadwal[$i][$j]->t12);
			    $j13[$i][$j]=$this->explode_s($jadwal[$i][$j]->t13);
			    $j14[$i][$j]=$this->explode_s($jadwal[$i][$j]->t14);
			}
		    }
		}
		$this->table->set_heading(array('data'=>'Waktu','width'=>80),array('data'=>'Hari 1','width'=>123),
					    array('data'=>'Hari 2','width'=>123),array('data'=>'Hari 3','width'=>123),
					    array('data'=>'Hari 4','width'=>123),array('data'=>'Hari 5','width'=>123),
					    array('data'=>'Hari 6','width'=>123),array('data'=>'Hari 7','width'=>123));
		$this->table->add_row('07.30 - 08.00',$j1[1][1],$j1[1][2],$j1[1][3],$j1[1][4],$j1[1][5],$j1[1][6],$j1[1][7]);
		$this->table->add_row('08.00 - 08.45',$j2[1][1],$j2[1][2],$j2[1][3],$j2[1][4],$j2[1][5],$j2[1][6],$j2[1][7]);
		$this->table->add_row('08.45 - 09.30',$j3[1][1],$j3[1][2],$j3[1][3],$j3[1][4],$j3[1][5],$j3[1][6],$j3[1][7]);
		$this->table->add_row('09.30 - 09.45',$j4[1][1],$j4[1][2],$j4[1][3],$j4[1][4],$j4[1][5],$j4[1][6],$j4[1][7]);
		$this->table->add_row('09.45 - 10.30',$j5[1][1],$j5[1][2],$j5[1][3],$j5[1][4],$j5[1][5],$j5[1][6],$j5[1][7]);
		$this->table->add_row('10.30 - 11.15',$j6[1][1],$j6[1][2],$j6[1][3],$j6[1][4],$j6[1][5],$j6[1][6],$j6[1][7]);
		$this->table->add_row('11.15 - 12.00',$j7[1][1],$j7[1][2],$j7[1][3],$j7[1][4],$j7[1][5],$j7[1][6],$j7[1][7]);
		$this->table->add_row('12.00 - 13.00',$j8[1][1],$j8[1][2],$j8[1][3],$j8[1][4],$j8[1][5],$j8[1][6],$j8[1][7]);
		$this->table->add_row('13.00 - 13.45',$j9[1][1],$j9[1][2],$j9[1][3],$j9[1][4],$j9[1][5],$j9[1][6],$j8[1][7]);
		$this->table->add_row('13.45 - 14.30',$j10[1][1],$j10[1][2],$j10[1][3],$j10[1][4],$j10[1][5],$j10[1][6],$j10[1][7]);
		$this->table->add_row('14.30 - 15.15',$j11[1][1],$j11[1][2],$j11[1][3],$j11[1][4],$j11[1][5],$j11[1][6],$j11[1][7]);
		$this->table->add_row('15.15 - 15.30',$j12[1][1],$j12[1][2],$j12[1][3],$j12[1][4],$j12[1][5],$j12[1][6],$j12[1][7]);
		$this->table->add_row('15.30 - 16.15',$j13[1][1],$j13[1][2],$j13[1][3],$j13[1][4],$j13[1][5],$j13[1][6],$j13[1][7]);
		$this->table->add_row('16.15 - 17.00',$j14[1][1],$j14[1][2],$j14[1][3],$j14[1][4],$j14[1][5],$j14[1][6],$j14[1][7]);
		$this->table->add_row('',$this->btn(1,1),$this->btn(2,1),$this->btn(3,1),$this->btn(4,1),$this->btn(5,1),$this->btn(6,1),$this->btn(7,1));
		$this->table->set_template(array('table_open'=>'<table class="table table-bordered table-striped">'));
		$data['week1']=$this->table->generate();

		/* Table week 2*/
		$this->table->set_heading(array('data'=>'Waktu','width'=>80),array('data'=>'Hari 1','width'=>123),
					    array('data'=>'Hari 2','width'=>123),array('data'=>'Hari 3','width'=>123),
					    array('data'=>'Hari 4','width'=>123),array('data'=>'Hari 5','width'=>123),
					    array('data'=>'Hari 6','width'=>123),array('data'=>'Hari 7','width'=>123));
		$this->table->add_row('07.30 - 08.00',$j1[2][1],$j1[2][2],$j1[2][3],$j1[2][4],$j1[2][5],$j1[2][6],$j1[2][7]);
		$this->table->add_row('08.00 - 08.45',$j2[2][1],$j2[2][2],$j2[2][3],$j2[2][4],$j2[2][5],$j2[2][6],$j2[2][7]);
		$this->table->add_row('08.45 - 09.30',$j3[2][1],$j3[2][2],$j3[2][3],$j3[2][4],$j3[2][5],$j3[2][6],$j3[2][7]);
		$this->table->add_row('09.30 - 09.45',$j4[2][1],$j4[2][2],$j4[2][3],$j4[2][4],$j4[2][5],$j4[2][6],$j4[2][7]);
		$this->table->add_row('09.45 - 10.30',$j5[2][1],$j5[2][2],$j5[2][3],$j5[2][4],$j5[2][5],$j5[2][6],$j5[2][7]);
		$this->table->add_row('10.30 - 11.15',$j6[2][1],$j6[2][2],$j6[2][3],$j6[2][4],$j6[2][5],$j6[2][6],$j6[2][7]);
		$this->table->add_row('11.15 - 12.00',$j7[2][1],$j7[2][2],$j7[2][3],$j7[2][4],$j7[2][5],$j7[2][6],$j7[2][7]);
		$this->table->add_row('12.00 - 13.00',$j8[2][1],$j8[2][2],$j8[2][3],$j8[2][4],$j8[2][5],$j8[2][6],$j8[2][7]);
		$this->table->add_row('13.00 - 13.45',$j9[2][1],$j9[2][2],$j9[2][3],$j9[2][4],$j9[2][5],$j9[2][6],$j8[2][7]);
		$this->table->add_row('13.45 - 14.30',$j10[2][1],$j10[2][2],$j10[2][3],$j10[2][4],$j10[2][5],$j10[2][6],$j10[2][7]);
		$this->table->add_row('14.30 - 15.15',$j11[2][1],$j11[2][2],$j11[2][3],$j11[2][4],$j11[2][5],$j11[2][6],$j11[2][7]);
		$this->table->add_row('15.15 - 15.30',$j12[2][1],$j12[2][2],$j12[2][3],$j12[2][4],$j12[2][5],$j12[2][6],$j12[2][7]);
		$this->table->add_row('15.30 - 16.15',$j13[2][1],$j13[2][2],$j13[2][3],$j13[2][4],$j13[2][5],$j13[2][6],$j13[2][7]);
		$this->table->add_row('16.15 - 17.00',$j14[2][1],$j14[2][2],$j14[2][3],$j14[2][4],$j14[2][5],$j14[2][6],$j14[2][7]);
		$this->table->add_row('',$this->btn(1,2),$this->btn(2,2),$this->btn(3,2),$this->btn(4,2),$this->btn(5,2),$this->btn(6,2),$this->btn(7,2));
		$this->table->set_template(array('table_open'=>'<table class="table table-bordered table-striped">'));
		$data['week2']=$this->table->generate();

		/*
		 * Options Pengajar
		 */
		$q=$this->mdl_course->get_kursil_by_course($id)->row();

		if($q->trainers!=0)
		{
		    $options[0]='';
		    $tr=explode('#',$q->trainers);
		    foreach($tr as $row)
		    {
			$options[$row]=$this->mdl_trainer->get_by_id($row)->row()->name;
		    }
		} else {
		    $options=array(0=>'Belum ada pengajar');
		}

		$data['tr1']=form_dropdown('tr1',$options,0);
		$data['tr2']=form_dropdown('tr2',$options,0);
		$data['tr3']=form_dropdown('tr3',$options,0);
		$data['tr4']=form_dropdown('tr4',$options,0);
		$data['tr5']=form_dropdown('tr5',$options,0);
		$data['tr6']=form_dropdown('tr6',$options,0);
		$data['tr7']=form_dropdown('tr7',$options,0);
		$data['tr8']=form_dropdown('tr8',$options,0);
		$data['tr9']=form_dropdown('tr9',$options,0);
		$data['tr10']=form_dropdown('tr10',$options,0);
		$data['tr11']=form_dropdown('tr11',$options,0);
		$data['tr12']=form_dropdown('tr12',$options,0);
		$data['tr13']=form_dropdown('tr13',$options,0);
		$data['tr14']=form_dropdown('tr14',$options,0);
		/* Create display */
		$this->template->display('schedule/index',$data);
	    }
        }
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

    function update_schedule()
    {
	$id=$this->input->post('id');
	$w=$this->input->post('w');
	$d=$this->input->post('d');
	$s1=array($this->input->post('t1'),$this->input->post('tr1'));
	$s2=array($this->input->post('t2'),$this->input->post('tr2'));
	$s3=array($this->input->post('t3'),$this->input->post('tr3'));
	$s4=array($this->input->post('t4'),$this->input->post('tr4'));
	$s5=array($this->input->post('t5'),$this->input->post('tr5'));
	$s6=array($this->input->post('t6'),$this->input->post('tr6'));
	$s7=array($this->input->post('t7'),$this->input->post('tr7'));
	$s8=array($this->input->post('t8'),$this->input->post('tr8'));
	$s9=array($this->input->post('t9'),$this->input->post('tr9'));
	$s10=array($this->input->post('t10'),$this->input->post('tr10'));
	$s11=array($this->input->post('t11'),$this->input->post('tr11'));
	$s12=array($this->input->post('t12'),$this->input->post('tr12'));
	$s13=array($this->input->post('t13'),$this->input->post('tr13'));
	$s14=array($this->input->post('t14'),$this->input->post('tr14'));
	$var=array(
	    't1'=>$this->implode_s('#',$s1),
	    't2'=>$this->implode_s('#',$s2),
	    't3'=>$this->implode_s('#',$s3),
	    't4'=>$this->implode_s('#',$s4),
	    't5'=>$this->implode_s('#',$s5),
	    't6'=>$this->implode_s('#',$s6),
	    't7'=>$this->implode_s('#',$s7),
	    't8'=>$this->implode_s('#',$s8),
	    't9'=>$this->implode_s('#',$s9),
	    't10'=>$this->implode_s('#',$s10),
	    't11'=>$this->implode_s('#',$s11),
	    't12'=>$this->implode_s('#',$s12),
	    't13'=>$this->implode_s('#',$s13),
	    't14'=>$this->implode_s('#',$s14)
	);
	$q=$this->mdl_schedule->update_schedule($id,$w,$d,$var);
	if($q)
	{
	    $this->session->set_flashdata('msg',$this->editor->alert_ok('Schedule telah ditambahkan'));
	    redirect('schedule/view/'.$id);
	} else {
	    $this->session->set_flashdata('msg',$this->editor->alert_error('Terjadi kesalahan'));
	    redirect('schedule/view/'.$id);
	}
    }

    protected function implode_s($d,$s)
    {
	$q=implode($d,$s);
	if($q=='#0')
	{
	    return NULL;
	} else {
	    return $q;
	}
    }
}

/* End of file schedule.php */
/* Location: ./application/controllers/schedule.php */