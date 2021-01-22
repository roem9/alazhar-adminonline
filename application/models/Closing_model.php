<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Closing_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Main_model");
    }

    // var $table = 'user';
    var $column_order = array(null,'tgl_closing','nama',"program",null,null,"sumber",null); //set column field database for datatable orderable
    var $column_search = array('nama','sumber'); //set column field database for datatable searchable 
    var $order = array('tgl_closing' => 'desc', 'tgl_input' => 'desc'); // default order 
 
    private function _get_datatables_query()
    {
        $this->db->from("closing_peserta");
        $this->db->where(["status" => 0]);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 

        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from("closing_peserta");
        $this->db->where(["status" => 0]);
        return $this->db->count_all_results();
    }
    
    public function add_closing(){
        $sumber = $this->input->post("sumber", TRUE);
        if($sumber == "Lainnya") {
            $sumber = $this->input->post("sumber_lainnya");
            $this->Main_model->add_data("sumber_closing", ["sumber" => $sumber]);
        }
        else $sumber = $sumber;

        $data = [
            "id_user" => $this->input->post("id_user", TRUE),
            "tgl_closing" => $this->input->post("tgl_closing", TRUE),
            "nama" => $this->input->post("nama", TRUE),
            "t4_lahir" => $this->input->post("t4_lahir", TRUE),
            "tgl_lahir" => $this->input->post("tgl_lahir", TRUE),
            "alamat" => $this->input->post("alamat", TRUE),
            "no_wa" => $this->input->post("no_wa", TRUE),
            "program" => $this->input->post("program", TRUE),
            "biaya" => $this->Main_model->rupiah_to_int($this->input->post("biaya", TRUE)),
            "sumber" => $sumber,
        ];

        $result = $this->Main_model->add_data("closing_peserta", $data);
        return $result;
    }

    public function add_closing_konfirm(){
        $sumber = $this->input->post("sumber", TRUE);
        if($sumber == "Lainnya") {
            $sumber = $this->input->post("sumber_lainnya");
            $this->Main_model->add_data("sumber_closing", ["sumber" => $sumber]);
        }
        else $sumber = $sumber;

        $closing = $this->input->post("program");
        $this->Main_model->edit_data("kelas_user", ["id" => $closing], ["closing" => 1]);
        $program = $this->Main_model->get_one("kelas_user", ["id" => $closing]);

        $id_user = $this->input->post("id_user", TRUE);
        $user = $this->Main_model->get_one("user", ["id_user" => $id_user]);        

        $data = [
            "id_user" => $user['id_user'],
            "id_kelas_user" => $program['id'],
            "tgl_closing" => $this->input->post("tgl_closing", TRUE),
            "nama" => $user['nama'],
            "t4_lahir" => $user['t4_lahir'],
            "tgl_lahir" => $user['tgl_lahir'],
            "alamat" => $user['alamat'],
            "no_wa" => $user['no_hp'],
            "program" => $program['program'],
            "biaya" => $this->Main_model->rupiah_to_int($this->input->post("biaya", TRUE)),
            "sumber" => $sumber,
        ];

        $this->Main_model->add_data("closing_peserta", $data);       

        return 0;
    }

    public function get_option_add_modal(){
        $data = [];
        $data['peserta'] = $this->Main_model->get_all("user", ["konfirm" => 1], "nama", "ASC");
        $data['sumber'] = $this->Main_model->get_all("sumber_closing", "", "sumber", "ASC");
        return $data;
    }

    public function get_peserta(){
        $id_user = $this->input->post("id_user");
        $data = $this->Main_model->get_one("user", ["id_user" => $id_user]);

        return $data;
    }

    public function get_closing(){
        $id = $this->input->post("id");
        $data = $this->Main_model->get_one("closing_peserta", ["id" => $id]);
        return $data;
    }

    public function edit_closing(){
        $id = $this->input->post("id");
        $sumber = $this->input->post("sumber", TRUE);
        
        if($sumber == "Lainnya") {
            $sumber = $this->input->post("sumber_lainnya");
            $this->Main_model->add_data("sumber_closing", ["sumber" => $sumber]);
        }
        else $sumber = $sumber;
        
        $data = [
            "tgl_closing" => $this->input->post("tgl_closing"),
            "biaya" => $this->Main_model->rupiah_to_int($this->input->post("biaya", TRUE)),
            "program" => $this->input->post("program"),
            "sumber" => $sumber,
        ];

        $this->Main_model->edit_data("closing_peserta", ["id" => $id], $data);
        return $id;
    }

    public function delete_closing(){
        $id = $this->input->post("id");
        $data = $this->Main_model->edit_data("closing_peserta", ["id" => $id], ["status" => 1]);
        
        // delete kelas user 
            $closing = $this->Main_model->get_one("closing_peserta", ["id" => $id]);
            $this->Main_model->edit_data("kelas_user", ["id" => $closing['id']], ["hapus" => 1]);
        // delete kelas user 

        return $data;
    }

    public function cetak_laporan_closing(){
        $tgl_awal = $this->input->post("tgl_awal");
        $tgl_akhir = $this->input->post("tgl_akhir");

        $data['closing'] = $this->Main_model->get_all("closing_peserta", "tgl_closing BETWEEN '$tgl_awal' AND '$tgl_akhir' AND status = 0", "tgl_input", "ASC");
        return $data;
    }
}

/* End of file Closing_model.php */
