<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calendar_course
 *
 * @author Ade Hermawan
 */

class calendar_course extends CI_Controller{
    //put your code here
    private $limit=10;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_calendar_course');
        $this->load->model('mdl_sarfas');
    }
    
    function view($bulan=null,$tahun=null,$offset=null) {
        $data['title']='Calendar Course';
        
            if ($bulan==NULL || $tahun==NULL || $offset==NULL){
            $bulan=  date('m');
            $tahun=  date('Y');
            $offset=0;
        }
                if ($bulan==0){
            $bulan=12;
            $tahun=$tahun-1;
        }
           

        if($bulan===13){
            $bulan=1;
            $tahun=$tahun+1;
        }

        $this->load->library('pagination');
        //Paginatoin
        $config['base_url']=  site_url('calendar_course/view/'.$bulan.'/'.$tahun.'/');
        $config['total_rows']= $this->mdl_calendar_course->count_all($bulan,$tahun);
        $config['per_page']=  $this->limit;
        $config['uri_segment']=5;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();

        // Make a table
        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
        array('data'=>'Nama Kegiatan','style'=>'background-color:#CCFFFF'),
        array('data'=>'01','style'=>'background-color:#CCFFFF'),
        array('data'=>'02','style'=>'background-color:#CCFFFF'),
        array('data'=>'03','style'=>'background-color:#CCFFFF'),
        array('data'=>'04','style'=>'background-color:#CCFFFF'),
        array('data'=>'05','style'=>'background-color:#CCFFFF'),
        array('data'=>'06','style'=>'background-color:#CCFFFF'),
        array('data'=>'07','style'=>'background-color:#CCFFFF'),
        array('data'=>'08','style'=>'background-color:#CCFFFF'),
        array('data'=>'09','style'=>'background-color:#CCFFFF'),
        array('data'=>'10','style'=>'background-color:#CCFFFF'),
        array('data'=>'11','style'=>'background-color:#CCFFFF'),
        array('data'=>'12','style'=>'background-color:#CCFFFF'),
        array('data'=>'13','style'=>'background-color:#CCFFFF'),
        array('data'=>'14','style'=>'background-color:#CCFFFF'),
        array('data'=>'15','style'=>'background-color:#CCFFFF'),
        array('data'=>'16','style'=>'background-color:#CCFFFF'),
        array('data'=>'17','style'=>'background-color:#CCFFFF'),
        array('data'=>'18','style'=>'background-color:#CCFFFF'),
        array('data'=>'19','style'=>'background-color:#CCFFFF'),
        array('data'=>'20','style'=>'background-color:#CCFFFF'),
        array('data'=>'21','style'=>'background-color:#CCFFFF'),
        array('data'=>'22','style'=>'background-color:#CCFFFF'),
        array('data'=>'23','style'=>'background-color:#CCFFFF'),
        array('data'=>'24','style'=>'background-color:#CCFFFF'),
        array('data'=>'25','style'=>'background-color:#CCFFFF'),
        array('data'=>'26','style'=>'background-color:#CCFFFF'),
        array('data'=>'27','style'=>'background-color:#CCFFFF'),
        array('data'=>'28','style'=>'background-color:#CCFFFF'),
        array('data'=>'29','style'=>'background-color:#CCFFFF'),
        array('data'=>'30','style'=>'background-color:#CCFFFF'),
        array('data'=>'31','style'=>'background-color:#CCFFFF')
                );           
$warna=1;
        $course= $this->mdl_calendar_course->get_jadwal_course($this->limit,$offset,$bulan,$tahun)->result_array();
        $data['detail_course']='';

        foreach ($course as $row) {
        $bln_awal= date('m',strtotime($row['start_date']));
        $bln_ahir= date('m',strtotime($row['end_date']));
        
        if ($bulan==$bln_awal && $bulan==$bln_ahir) {
        $tgl_awal= date('d',strtotime($row['start_date']));
        $tgl_ahir= date('d',strtotime($row['end_date']));            
        }elseif($bulan>$bln_awal){
        $tgl_awal= 1;          
        $tgl_ahir= date('d',strtotime($row['end_date']));                  
        }elseif($bln_ahir>$bulan){
        $tgl_awal= date('d',strtotime($row['start_date']));          
        $tgl_ahir= date('t',strtotime($row['end_date']));      
        }        
                for ($d=1;$d<=31;$d++){
            $tgl[$d]='';
        }

        if ($warna % 2 ==0){
            $color='label-success';
        }else{
            $color='label-important';
        }
        $warna++;
           // print_r($tgl_awal);
           // print_r($tgl_ahir);
            for ($a=(int)$tgl_awal;$a<=(int)$tgl_ahir;$a++){
                // echo $a;
                if ($this->mdl_sarfas->get_class_by_id($row['location'])->num_rows()==0) {
                    $lokasi='';
                }else{
                  $lokasi=  $this->mdl_sarfas->get_class_by_id($row['location'])->row()->code;
                }
                $tgl[$a]='<span class="label '.$color.'">'.$lokasi.'</span>';
            }
            

$data['detail_course'].=$this->editor->detail_course($row['id'],$row['course_name'],$row['location'],$row['start_date'],$row['end_date']);          
            $this->table->add_row(
                    anchor('#detail'.$row['id'], $row['course_name'], array('data-toggle' => 'modal')),
                    $tgl[1],
                    $tgl[2],
                    $tgl[3],
                    $tgl[4],
                    $tgl[5],
                    $tgl[6],
                    $tgl[7],
                    $tgl[8],
                    $tgl[9],
                    $tgl[10],
                    $tgl[11],
                    $tgl[12],
                    $tgl[13],
                    $tgl[14],
                    $tgl[15],
                    $tgl[16],
                    $tgl[17],
                    $tgl[18],
                    $tgl[19],
                    $tgl[20],
                    $tgl[21],
                    $tgl[22],
                    $tgl[23],
                    $tgl[24],
                    $tgl[25],
                    $tgl[26],
                    $tgl[27],
                    $tgl[28],
                    $tgl[29],
                    $tgl[30],
                    $tgl[31]
                    
                    );
            
           
        }
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-condensed table-striped">'));
        $data['content'] = $this->table->generate();
        
        $next_bulan=$bulan+1;
        $prev_bulan=$bulan-1;
        $data['bulan_sekarang']=  anchor('calendar_course/view/', 'Bulan Sekarang',array('class'=>'label label-info'));
        $data['bulan']= anchor('calendar_course/view/'.$prev_bulan.'/'.$tahun.'/0', '<span class="icon icon-backward"></span>&nbsp;').$this->bulan($bulan).' '.$tahun.anchor('calendar_course/view/'.$next_bulan.'/'.$tahun.'/0', '&nbsp;<span class="icon icon-forward"></span>');

        $this->template->display('dashboard/calendar',$data);
    }
    
        function bulan($bln) {
        switch ($bln) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;

            default:
                return 'Error';
                break;
        }
    }
}

?>
