<?php
class Laporan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Peserta_model');
        $this->load->model('Main_model');
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
            redirect(base_url("login"));
        }
    }

    public function cetak_laporan(){
        $tgl_awal = $this->input->post("tgl_awal");
        $tgl_akhir = $this->input->post("tgl_akhir");
        $laporan = $this->input->post("laporan", TRUE);
        if($laporan == "Laporan Login"){
            $user['user'] = $this->Main_model->get_all("user", "tgl_masuk between '$tgl_awal' AND '$tgl_akhir'");
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
    
            $data = $this->load->view('laporan/login', $user, TRUE);
            $mpdf->WriteHTML($data);
            $mpdf->Output();

        }
    }
}