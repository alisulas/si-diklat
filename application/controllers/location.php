<?php

/**
 * Description of newPHPClass
 *
 * @author adehermawan
 */
class location extends Member_Controller{
    //put your code here
    private $limit=10;
    
        function list_city($offset=0) {
        $data['title']='Data Kota';
        $this->load->library('pagination');
        /*Pagination*/
        $config['base_url']=  site_url('sarfas/list_city/');
        $config['total_rows']=  $this->mdl_location->count_all_location();
        $config['per_page']=  $this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        $this->load->library('table');
        $this->table->set_empty('&nbsp');
        $this->table->set_heading(
                array('data'=>'No','width'=>20),
                'Lokasi',
                'Ket',
                array('data'=>'Action','width'=>80)
                );

        $search_name=$this->input->post('search_name');
        $i=0+$offset;
        $location=  $this->mdl_location->get_city()->result_array();
        $data['edit_location']='';
        foreach ($location as $row) {
            $edit=  anchor('#edit_location'.$row['id'],'<span class="label label-info">Ubah</span>', array('data-toggle'=>'modal'));
            $delete=  anchor('location/delete_city/'.$row['id'].'/'.$offset,'<span class="label label-important">Hapus</span>',array('onclick'=>"return confirm('Apakah Anda yakin akan menghapus data ?')",'rel'=>'tooltip','title'=>'Hapus'));
            $data['edit_location'].=$this->editor->edit_location($row['id']);
            
            $this->table->add_row(
                    ++$i,
                    $row['nama'],
                    $row['ket'],
                    $edit.' '.$delete
                    );
        }
        
        $tmpl = array ( 'table_open'  => '<table id="data_table" cellpadding="2" cellspacing="1" class="table table-hover table-striped table-bordered dTableR display order-column">' );
        $this->table->set_template($tmpl);
        $data['content']=$this->table->generate();
        $this->template->display('location/list_city',$data);
    }
    
    
    function delete_city($id) {
        $this->mdl_location->delete_city($id);
        redirect('location/list_city');
    }
    
    function edit_city($id) {
        $location=array(
            'nama'=> $this->input->post('nama'),
            'ket'=> $this->input->post('ket'),
            'update_date'=> date('Y-m-d G:i:s')
        );
        
        $this->mdl_location->edit_city($id,$location);
        redirect('location/list_city');
    }
    
    function add_city() {
        $location=array(
            'nama'=> $this->input->post('nama'),
            'ket'=> $this->input->post('ket'),
            'insert_date'=> date('Y-m-d G:i:s')
        );
        
        $this->mdl_location->add_city($location);
        redirect('location/list_city');
    } 
    
}
