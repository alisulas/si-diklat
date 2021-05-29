<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $limit=10;

    function __construct() {
	parent::__construct();
	$this->load->model('mdl_dashboard');
	$this->load->model('mdl_course');
    }

    public function index()
    {
        redirect('monitoring');
       // $this->information();
	// $this->get_index($offset);
    }

    protected function get_index($offset)
    {
	$data['title']='Halaman Utama';
        
	$this->load->library('pagination');
        if(empty($offset)){$offset=0;}
	/* Pagination */
	$config['base_url']=site_url('course/index/');
	$config['total_rows']=$this->mdl_course->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']=3;
	$this->pagination->initialize($config);
	$data['pagination']=$this->pagination->create_links();

	/* List Table */
	$this->load->library('table');
	$this->table->set_empty('&nbsp;');
	$this->table->set_heading(
		    'No',
		    'Kode',
		    'Nama Pelatihan',
		    'Durasi',
		    'PIC',
		    array('data'=>'Tanggal Inisiasi','width'=>'90'),
		    array('data'=>'Update Terakhir','width'=>'90'),
		    
		    array('data'=>'Status','width'=>'90'),
		    array('data'=>'Kurikulum Silabus','width'=>'30'),
                array('data'=>'Daftar Peserta','width'=>'30'),
		    array('data'=>'Kelengkapan Pelatihan','width'=>'30'),
		    
                    array('data'=>'Action','colspan'=>'2','width'=>'10')
		);
	$q=$this->mdl_course->get_index($this->limit,$offset)->result_array();
	$i=0+$offset;
	
        $data['cancel']='';
        $data['popup']='';
	foreach ($q as $row)
	{
           
	    if($this->mdl_course->get_kursil_by_course($row['id'])->num_rows() <= 0)
	    {
		$lbl_kursil='<span class="label label-error">Belum Lengkap</span>';
		$rel_kursil='Klik untuk menambahkan kursil';
	    } else {
		$lbl_kursil='<span class="label label-success">Lengkap</span>';
		$rel_kursil='Klik untuk melihat kursil';
	    }
	    if($this->mdl_course->get_peserta_by_course($row['id'])->num_rows() <= 0)
	    {
		$lbl_peserta='<span class="label label-error">Belum Lengkap</span>';
		$rel_peserta='Klik untuk menambahkan peserta';
	    } else {
		$lbl_peserta='<span class="label label-success">Lengkap</span>';
		$rel_peserta='Klik untuk melihat peserta';
	    }
	    if(!$this->cek_kelengkapan($row['id']))
	    {
		$lbl_activity='<span class="label label-error">Belum Lengkap</span>';
		$rel_activity='Klik untuk menambah kelengkapan';
	    } else {
		$lbl_activity='<span class="label label-success">Lengkap</span>';
		$rel_activity='Klik untuk melihat kelengkapan';
	    }
          
            if($this->mdl_course->get_by_id($row['id'])->row()->status == NULL){
                $status=  anchor('dashboard/close/'.$row['id'], 'Close', 'class="label label-info"').'&nbsp;'.anchor('#popup'.$row['id'], 'Cancel',array('class'=>'label label-warning','data-toggle'=>'modal'));           
              $data['popup'].=$this->editor->modal_popupcancel($row['id']); 
            }else{
                
             $ex_status=  $this->mdl_course->get_by_id($row['id'])->row()->status;
            $ket_status= explode("#", $ex_status);
            if ($ket_status[0]==1){
                $status='Closed <br>'.$ket_status[1];
            }else{
                
                $status=anchor('#cancel'.$row['id'], 'Canceled', array('data-toggle'=>'modal')).'<br>'.$ket_status[1];
            $data['cancel'].=$this->editor->modal_cancel($row['id'],$ket_status[2]);
                
            }
                
            }
            $edit=  anchor('course/edit/'.$row['id'],'<i class="icon-wrench"></i>',array('rel'=>'tooltip','title'=>'Edit'));
            $delete=  anchor('course/delete/'.$row['id'],'<i class="icon-trash"></i>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data?')",'rel'=>'tooltip','title'=>'Delete'));

	    $kursil_btn= anchor('course/kursil/'.$row['id'],'<i class="icon-search icon-white"></i>',array('class'=>'btn btn-primary','rel'=>'tooltip','title'=>$rel_kursil));
	    $peserta_btn= anchor('peserta/view/'.$row['id'],'<i class="icon-search icon-white"></i>',array('class'=>'btn btn-primary','rel'=>'tooltip','title'=>$rel_peserta));
            $kelengkapan_btn= anchor('activity/edit/'.$row['id'], '<i class="icon-search icon-white"></i>', array('class'=>'btn btn-primary','rel'=>'tooltip','title'=>$rel_activity));

	    $data['pic']=$this->mdl_course->get_function_by_id($row['plc_function_id'])->row()->name;
            $this->table->add_row(
		    ++$i,
		    $row['code'],
		    $row['course_name'],
		    $row['duration'].' Hari',
		    $data['pic'],
		    $this->editor->date_correct($row['insert_date']),
		    $this->editor->date_correct($row['update_date']),                  
		    $status,
                    $kursil_btn.'<br />'.$lbl_kursil,
		     $peserta_btn.'<br />'.$lbl_peserta,
		    $kelengkapan_btn.'<br />'.$lbl_activity,
		   
		    array('data'=>$edit,'width'=>10),
                    array('data'=>$delete,'width'=>10)
	    );
	    
	}
        $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
	$data['content']=$this->table->generate();
        $this->template->display('dashboard/index',$data);
    }

    protected function cek_kelengkapan($id)
    {
	$q=$this->mdl_course->get_activity_by_course($id);
	$val = TRUE;
	if($q->num_rows() <= 0)
	{
	    return FALSE;
	} else {
	    for($i=1;$i<22;$i++)
	    {
		$act='act'.$i;
		if(($q->row()->$act!=NULL))
		{
		    $val=$val && TRUE;
		} else {
		    $val=$val && FALSE;
		}
	    }
	    return $val;
	}
    }
    
    function information()
    {
	$data['title']='';
                $this->load->library('table');
        $this->table->set_empty('&nbsp;');
        $this->table->set_heading(
                array('data'=>'No','width'=>'10'),
                array('data'=>'Kode','width'=>'30'),
                'Nama Pelatihan',
                array('data'=>'Tanggal Pelaksanaan','width'=>'80'),
                array('data'=>'Durasi','width'=>'20'),
                array('data'=>'PIC','width'=>'20')
                );
        
        $que = $this->mdl_dashboard->get_course_week()->result();
        $a=0;
        foreach ($que as $row) {
            $pic=$this->mdl_course->get_function_by_id($row->plc_function_id)->row()->name;
            $this->table->add_row(
             ++$a,
              $row->code,
                    $row->course_name,
                    $this->editor->date_correct($row->start_date),
                    $row->duration.' Hari',
                   $pic
                    );
 
        }
 $this->table->set_template(array('table_open'=>'<table class="table table-bordered">'));
 $data['pelatihan']= $this->table->generate();  
	$this->template->display('login/information',$data);
    }
    
    function cancel($id){
      $date_now=  $this->editor->date_correct(date('Y-m-d'));
        $data=array(
            'status'=>'2#'.$date_now.'#'.$this->input->post('ket'),
                'update_date'=> date('Y-m-d G:i:s')
        );
        $this->mdl_dashboard->update_status($id,$data);
        redirect('dashboard');   
    }


    function close($id) {
        $date_now=  $this->editor->date_correct(date('Y-m-d'));
        $data=array(
            'status'=>'1#'.$date_now,
            'update_date'=>  date('Y-m-d G:i:s')
        );
        $this->mdl_dashboard->update_status($id,$data);
        redirect('dashboard');
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */