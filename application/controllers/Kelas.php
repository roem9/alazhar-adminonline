<?php
class Kelas extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Main_model');
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
            redirect(base_url("login"));
        }
    }

    public function index(){
        $data['title'] = 'List Kelas';
        $data['program'] = $this->Main_model->get_all("program", "", "program", "ASC");
        $data['civitas'] = $this->Main_model->get_all("civitas", ["status" => "aktif"], "nama_civitas");
        // $kelas = $this->Main_model->get_all("kelas", "", "tgl_mulai", "ASC");
        // $data['kelas'] = [];
        // foreach ($kelas as $i => $kelas) {
        //     $data['kelas'][$i] = $kelas;
        //     $data['kelas'][$i]['peserta'] = COUNT($this->Main_model->get_all("kelas_user", ["id_kelas" => $kelas['id_kelas']]));
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/kelas', $data);
        $this->load->view('templates/footer');
    }

    public function ajax_list(){
        $list = $this->Kelas_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kelas) {
            $no++;
            $row = array();
            $row[] = '<center>'.$no.'</center>';
            // if($kelas->status == "aktif") $row[] = $kelas->status;
            if($kelas->status == "aktif") $row[] = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-id="'.$kelas->id_kelas.'|'.$kelas->nama_kelas.'|menonaktifkan" id="btnStatusKelas">aktif</a>';
            else $row[] = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary" data-id="'.$kelas->id_kelas.'|'.$kelas->nama_kelas.'|mengaktifkan" id="btnStatusKelas">nonaktif</a>';
            $row[] = date("d-m-Y", strtotime($kelas->tgl_mulai));
            $row[] = $kelas->nama_kelas;
            
            if($kelas->nama_civitas)
                $row[] = $kelas->nama_civitas;
            else 
                $row[] = "<center>-</center>";
                
            $row[] = $kelas->program;
            $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$kelas->id_kelas.'" class="btn btn-sm btn-outline-dark peserta">' . COUNT($this->Main_model->get_all("kelas_user", ["id_kelas" => $kelas->id_kelas])) . '</a></center>';
            $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$kelas->id_kelas.'" class="btn btn-sm btn-outline-warning wl">' . COUNT($this->Main_model->get_all("kelas_user", ["id_kelas" => null, "program" => $kelas->program])) . '</a></center>';
            $row[] = '<a href="#modalEdit" data-toggle="modal" data-id="'.$kelas->id_kelas.'" class="btn btn-sm btn-info detail">detail</a>';

            $data[] = $row;
        }

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Kelas_model->count_all(),
                    "recordsFiltered" => $this->Kelas_model->count_filtered(),
                    "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    // get
        public function get_detail_kelas(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("kelas", ["id_kelas" => $id]);
            $data['pertemuan'] = $this->Main_model->get_all("materi_kelas", ["id_kelas" => $id]);
            $peserta = $this->Main_model->get_all("kelas_user", ["id_kelas" => $id]);
            foreach ($peserta as $i => $peserta) {
                $data['peserta'][$i] = $this->Main_model->get_one("user", ["id_user" => $peserta['id_user']]);
                $data['peserta'][$i]['id'] = $peserta['id'];
            }

            $wl = $this->Main_model->get_all("kelas_user", ["id_kelas" => null, "program" => $data['program']]);
            foreach ($wl as $i => $wl) {
                $data['wl'][$i] = $this->Main_model->get_one("user", ["id_user" => $wl['id_user']]);
                $data['wl'][$i]['id'] = $wl['id'];
            }

            echo json_encode($data);
        }

        public function get_kelas_aktif_program(){
            $program = $this->input->post("program");
            $kelas = $this->Main_model->get_all("kelas", ["program" => $program, "status" => "aktif"]);
            foreach ($kelas as $i => $kelas) {
                $data[$i] = $kelas;
                $peserta = COUNT($this->Main_model->get_all("kelas_user", ["id_kelas" => $kelas['id_kelas']]));
                $data[$i]['peserta'] = $peserta;
            }
            echo json_encode($data);
        }
    // get

    // edit
        public function edit_kelas(){
            $id = $this->input->post("id_kelas");
            $data = [
                "nama_kelas" => $this->input->post("nama_kelas"),
                "program" => $this->input->post("program"),
                "tgl_mulai" => $this->input->post("tgl_mulai"),
                "tgl_selesai" => $this->input->post("tgl_selesai"),
                "id_civitas" => $this->input->post("id_civitas"),
            ];
            $this->Main_model->edit_data("kelas", ["id_kelas" => $id], $data);
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengubah data kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            // redirect($_SERVER['HTTP_REFERER']);
            echo json_encode("1");
        }

        public function list_pertemuan(){
            $id = $this->input->post("id_kelas");
            $pert = $this->input->post("pertemuan");
            
            // delete list
                $this->Main_model->delete_data("materi_kelas", ["id_kelas" => $id]);
            // delete list

            if($pert){
                foreach ($pert as $pert) {
                    $data = [
                        "materi" => $pert,
                        "id_kelas" => $id
                    ];
    
                    $this->Main_model->add_data("materi_kelas", $data);
                }
            }

            echo json_encode("1");
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menyimpan data pertemuan kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            // redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit_status_kelas(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("kelas", ["id_kelas" => $id]);
            if($data['status'] == "aktif") $this->Main_model->edit_data("kelas", ["id_kelas" => $id], ["status" => "nonaktif"]);
            else $this->Main_model->edit_data("kelas", ["id_kelas" => $id], ["status" => "aktif"]);
            echo json_encode("1");
        }
    // edit
    
    // add
        public function add_kelas(){
            $data = [
                "nama_kelas" => $this->input->post("nama_kelas"),
                "program" => $this->input->post("program"),
                "tgl_mulai" => $this->input->post("tgl_mulai"),
                "tgl_selesai" => $this->input->post("tgl_selesai"),
                "status" => "aktif",
            ];
            
            $this->Main_model->add_data("kelas", $data);
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            // redirect('kelas');
            echo json_encode("1");
        }
        
        // pindah dari waiting list ke kelas 
        public function add_kelas_wl(){
            $id = $this->input->post("id");
            $id_kelas = $this->input->post("id_kelas");

            $this->Main_model->edit_data("kelas_user", ["id" => $id], ["id_kelas" => $id_kelas]);
            echo $id_kelas;
        }
    // add

    // delete
        public function delete_peserta(){
            $peserta = $this->input->post("peserta");
            foreach ($peserta as $peserta) {
                $where = [
                    "id_kelas" => $this->input->post("id_kelas"),
                    "id_user" => $peserta,
                ];

                $this->Main_model->delete_data("kelas_user", $where);
            };
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus peserta dari kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            // redirect($_SERVER['HTTP_REFERER']);

            echo json_encode("1");
        }
        
        public function keluar_kelas(){
            $id = $this->input->post("id");

            $data = $this->Main_model->get_one("kelas_user", ["id" => $id]);
            $this->Main_model->edit_data("kelas_user", ["id" => $id], ["id_kelas" => null]);

            echo $data['id_kelas'];
        }

        public function delete_wl(){
            $id = $this->input->post("id");
            $id_kelas = $this->input->post("id_kelas");

            $data = $this->Main_model->get_one("kelas_user", ["id" => $id]);
            $this->Main_model->delete_data("kelas_user", ["id" => $id]);

            echo $id_kelas;
        }
}