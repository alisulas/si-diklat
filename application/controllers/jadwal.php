<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class jadwal extends Member_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        
   
        $this->load->model('mdl_course');
        $this->load->model('mdl_jadwal');
        $this->load->model('mdl_trainer');
        
    }
    
    function view($id=null) {
        if ($id==null){
            $this->session->set_flashdata('msg',  $this->editor->alert_error('Terjadi Kesahalahan'));
            redirect('course');
        }else{
            	$data['title']='Jadwal Pembelajaran';
		$data['course_id']=$id;
		$data['course_code'] = $this->mdl_course->get_by_id($id)->row()->code;
                $data['course_name'] = $this->mdl_course->get_by_id($id)->row()->course_name;
                $data['start_date'] = $this->mdl_course->get_by_id($id)->row()->start_date;
                $data['end_date'] = $this->mdl_course->get_by_id($id)->row()->end_date;
                $data['course_location'] = $this->mdl_course->get_by_id($id)->row()->location;
            
                $days = $this->getDatesBetween2Dates($data['start_date'],$data['end_date']);
                $jumlah_hari=  count($days);
                $data['jumlah_hari']=  count($days);
                for ($i=0;$i<=$jumlah_hari;$i++){
                   $data['table_jadwal'.$i]='
<table>
<tr>
<td>Coba</td>
</tr>
</table>
'; 
                }
                $data['jadwal']='';
                $tgl_jadwal = $this->mdl_jadwal->get_jadwal_by_id($id)->result_array();

$options='';
$data['jadwal']='';
$data['lihat_jadwal']='';
foreach($days as $key=>$value){

   $options[$value]=  $this->editor->date_correct($value);
   $data['tgl'][]=$this->editor->date_correct($value);
   $data['jadwal'] .= anchor('#lihat_jadwal'.$value,$this->editor->date_correct($value),array('class'=>'btn btn-success','data-toggle'=>'modal','rel'=>'tooltip','title'=>'Lihat Jadwal Pembelajaran')).' ';
    $data['lihat_jadwal'].=$this->editor->modal_jadwal($id,$value);  
}
                $data['tanggal']=  form_dropdown('tanggal', $options,0);
                
		$q=$this->mdl_course->get_kursil_by_course($id)->row();

		if($q->trainers!=0)
		{
		    $pilihan[0]='';
		    $tr=explode('#',$q->trainers);
		    foreach($tr as $row)
		    {
			$pilihan[$row]=$this->mdl_trainer->get_by_id($row)->row()->name;
		    }
		} else {
		    $pilihan=array(0=>'Belum ada pengajar');
		}
                
                $data['trainer']= form_dropdown('trainer', $pilihan,0);
              
        }
       $this->template->display('jadwal/index',$data);   
    }
    
    function getDatesBetween2Dates($startTime, $endTime) {
    $day = 86400;
    $format = 'Y-m-d';
    $startTime = strtotime($startTime);
    $endTime = strtotime($endTime);
    $numDays = round(($endTime - $startTime) / $day) + 1;
    $days = array();
        
    for ($i = 0; $i < $numDays; $i++) {
        $days[] = date($format, ($startTime + ($i * $day)));
    }
        
    return $days;
}

    function tambah_jadwal($course_id) {
        $waktu= $this->input->post('waktu1').' - '.  $this->input->post('waktu2');
        $data=array(
            'plc_course_id'=>$course_id,
            'tanggal'=>  $this->input->post('tanggal'),
            'waktu'=>  $waktu,
            'kegiatan'=>  $this->input->post('kegiatan'),
            'trainer'=>  $this->input->post('trainer')
        );
        $this->mdl_course->add_jadwal($data);
        redirect('jadwal/view/'.$course_id);
    }
    
    function waktu($time) {
        switch ($time) {
            case 1:
$wkt='';
                break;

            default:
                break;
        }
    }
    
    function delete($id_course,$id_jadwal) {
        $this->mdl_jadwal->delete($id_jadwal);
        redirect('jadwal/view/'.$id_course);
    }
    
    
    
}
