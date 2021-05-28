<?php

/**
 * Description of mdl_learning_days
 *
 * @author Ade Hermawan
 */
class mdl_learning_days extends CI_Model
{
    //put your code here
    private $table = 'learning_days';
    private $table_pekerja = 'pekerja';

    function count_all()
    {
        $q = $this->db->get($this->table);
        return $q->num_rows();
    }

    function count_pekerja()
    {
        $a =  $this->db->get($this->table_pekerja);
        return $a->num_rows();
    }

    function get_index($list, $search_name, $limit, $offset)
    {
        if (empty($search_name)) {
            $search_name = '';
        }
        if ($list == 'nopek') {
            $this->db->like('nopek', $search_name);
        } elseif ($list == 'name') {
            $this->db->like('name', $search_name);
        } elseif ($list == 'training_name') {
            $this->db->like('training_name', $search_name);
        }

        $this->db->order_by('insert_date', 'desc');
        return $this->db->get($this->table, $limit, $offset);
    }

    function get_pekerja($limit, $offset)
    {
        return $this->db->get($this->table_pekerja, $limit, $offset);
    }

    function add_dataexcel($dataarray)
    {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'nopek' => $dataarray[$i]['nopek'],
                'name' => $dataarray[$i]['name'],
                'personnel_area' => $dataarray[$i]['personnel_area'],
                'company_code' => $dataarray[$i]['company_code'],
                'id_position' => $dataarray[$i]['id_position'],
                'position_name' => $dataarray[$i]['position_name'],
                'cost_ctr' => $dataarray[$i]['cost_ctr'],
                'cost_center' => $dataarray[$i]['cost_center'],
                'start_date' => join('-', array_reverse(explode('/', $dataarray[$i]['start_date']))),
                'end_date' => join('-', array_reverse(explode('/', $dataarray[$i]['end_date']))),
                'education' => $dataarray[$i]['education'],
                'location' => $dataarray[$i]['location'],
                'country' => $dataarray[$i]['country'],
                'certification' => $dataarray[$i]['certification'],
                'duration' => $dataarray[$i]['duration'],
                'training_name' => $dataarray[$i]['training_name'],
                'departemen' => $dataarray[$i]['departemen'],
                'tw' => $dataarray[$i]['tw'],
                'insert_date' =>  date('Y-m-d G:i:s')
            );
            $this->db->insert($this->table, $data);
        }
    }


    function add_excel_pekerja($dataarray)
    {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'nopek' => $dataarray[$i]['nopek'],
                'plc_jabatan_id' => $dataarray[$i]['plc_jabatan_id'],
                'name' => $dataarray[$i]['name'],
                'tgl_lahir' => join('-', array_reverse(explode('/', $dataarray[$i]['tgl_lahir']))),
                'cost_ctr' => $dataarray[$i]['cost_ctr'],
                'cost_center' => $dataarray[$i]['cost_center'],
                'jabatan' => $dataarray[$i]['jabatan'],
                'company_code' => $dataarray[$i]['company_code'],
                'personel_area' => $dataarray[$i]['personel_area'],
                'sub_area' => $dataarray[$i]['sub_area'],
                'employee_group' => $dataarray[$i]['employee_group'],
                'employee_subgroup' => $dataarray[$i]['employee_subgroup'],
                'cost_center_group' => $dataarray[$i]['cost_center_group'],
                'direktorat' => $dataarray[$i]['direktorat'],
                'insert_date' =>  date('Y-m-d G:i:s')
            );
            $this->db->insert($this->table_pekerja, $data);
        }
    }

    function get_pekerja_by_nopek($nopek, $nama)
    {
        $this->db->where('nopek', $nopek);
        if ($this->db->get($this->table_pekerja)->num_rows() == 0) {
            $pekerja = 'Tidak Ada';
        } else {
            $this->db->where('nopek', $nopek);
            $pekerja = $this->db->get($this->table_pekerja)->row()->$nama;
        }
        return $pekerja;
    }

    function get_pekerja_by_nop($nopek)
    {
        $this->db->where('nopek', $nopek);
        return $this->db->get($this->table_pekerja);
    }

    function add_ld($ld)
    {
        $this->db->insert($this->table, $ld);
    }

    function get_ld_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }


    function edit_ld($id, $ld)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $ld);
    }

    function delete_ld($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }


    function lookup_pekerja($keyword)
    {
        $this->db->like('nopek', $keyword, 'after');
        $query = $this->db->get($this->table_pekerja);
        return $query->result_array();
    }
}