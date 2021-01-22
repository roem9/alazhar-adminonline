<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Closing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Closing_model');
        $this->load->model('Main_model');
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
            redirect(base_url("login"));
        }
        //Do your magic here
    }

    public function cek(){
        var_dump($_POST);
        exit();
    }

    public function index(){
        $data['title'] = 'List Closing';
        $data['program'] = $this->Main_model->get_all("program", "", "program", "ASC");
        $data['sidebar'] = 'sidebarClosing';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pages/closing/list-closing', $data);
        $this->load->view('templates/footer');
    }

    public function get_all_closing(){
        $list = $this->Closing_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $peserta) {
            $no++;
            $row = array();
            $row[] = '<center>'.$no.'</center>';
            $row[] = date('d-m-Y', strtotime($peserta->tgl_closing));
            $row[] = $peserta->nama;
            $row[] = $peserta->program;
            $row[] = $peserta->no_wa;
            $row[] = $this->Main_model->rupiah($peserta->biaya);
            $row[] = $peserta->sumber;
            $row[] = '<a href="#modalEdit" data-toggle="modal" class="btn btn-sm btn-info" id="btnDetail" data-id="'.$peserta->id.'">detail</a>';
            

            $data[] = $row;
        }

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Closing_model->count_all(),
                    "recordsFiltered" => $this->Closing_model->count_filtered(),
                    "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function add_closing(){
        $data = $this->Closing_model->add_closing();
        echo json_encode($data);
    }

    public function add_closing_konfirm(){
        $data = $this->Closing_model->add_closing_konfirm();
        echo json_encode($data);
    }

    public function get_option_add_modal(){
        $data = $this->Closing_model->get_option_add_modal();
        echo json_encode($data);
    }

    public function get_peserta(){
        $data = $this->Closing_model->get_peserta();
        echo json_encode($data);
    }

    public function get_closing(){
        $data = $this->Closing_model->get_closing();
        echo json_encode($data);
    }

    public function edit_closing(){
        $data = $this->Closing_model->edit_closing();
        echo json_encode($data);
    }

    public function delete_closing(){
        $data = $this->Closing_model->delete_closing();
        echo json_encode("1");
    }

    public function cetak_laporan_closing(){
        $tgl_awal = date("d-m-Y", strtotime($this->input->post("tgl_awal")));
        $tgl_akhir = date("d-m-Y", strtotime($this->input->post("tgl_akhir")));
        
        $filename = "laporan_closing_{$tgl_awal}_{$tgl_akhir}";

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

        $data = $this->Closing_model->cetak_laporan_closing();
        $this->load->view('pages/closing/cetak-closing', $data);        
    }
}

/* End of file Closing.php */
