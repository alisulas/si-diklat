<?php
/**
 *
 */
class Mdl_tugas_belajar extends CI_Model
{
  private $table='plc_tugas_belajar';

function get_index($limit=10,$offset=0){
$this->db->order_by('id','desc');
return $this->db->get($this->table,$limit,$offset);
}

function count_all()
{
  return $this->db->get($this->table)->num_rows();
}

function get_by_id($id){
  $this->db->where('id',$id);
  return $this->db->get($this->table);
}

function add_peserta($var){
    $this->db->insert($this->table,$var);
    return $this->db->insert_id();
  }

  function update($id,$data){
    $this->db->where('id',$id);
    return $this->db->update($this->table,$data);
  }

}
