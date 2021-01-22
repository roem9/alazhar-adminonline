<?php
    class Peserta extends CI_CONTROLLER{
        public function __construct(){
            parent::__construct();
            $this->load->model('Peserta_model');
            $this->load->model('Wl_model');
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
            $data['title'] = 'List Peserta';
            $data['program'] = $this->Main_model->get_all("program", "", "program", "ASC");
            $data['sidebar'] = 'sidebarPeserta';

            // konfirm = 1 telah dikonfirmasi
            $data['konfirm'] = '1';

            $data['kelas'] = $this->Main_model->get_all("kelas", ["status" => "aktif"], "nama_kelas");

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('peserta/peserta', $data);
            $this->load->view('templates/footer');
        }
        
        public function konfirm(){
            $data['title'] = 'Konfirmasi Peserta';
            $data['program'] = $this->Main_model->get_all("program", "", "program", "ASC");
            $data['sidebar'] = 'sidebarKonfirmPeserta';
            
            // konfirm = 0 belum dikonfirmasi
            $data['konfirm'] = '0';

            $data['kelas'] = $this->Main_model->get_all("kelas", ["status" => "aktif"], "nama_kelas");

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('peserta/peserta', $data);
            $this->load->view('templates/footer');
        }

        public function wl(){
            $data['title'] = 'Waiting List Peserta';
            $data['program'] = $this->Main_model->get_all("program", "", "program", "ASC");
            
            // konfirm = 0 belum dikonfirmasi
            $data['konfirm'] = '0';

            $data['kelas'] = $this->Main_model->get_all("kelas", ["status" => "aktif"], "nama_kelas");

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('peserta/peserta-wl', $data);
            $this->load->view('templates/footer');
        }

        public function ajax_list($konfirm){
            $list = $this->Peserta_model->get_datatables("konfirm = $konfirm");
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $peserta) {
                $no++;
                $row = array();

                if($konfirm == 1){
                    $row[] = '<center>'.$no.'</center>';
                    if($peserta->username == "") $row[] = '<a href="javascript:void(0)" class="btn btn-sm btn-primary" data-id="'.$peserta->id_user.'|'.$peserta->nama.'" id="btnAddId">buat ID</a>';
                    else $row[] = $peserta->username;
                    $row[] = $peserta->nama;
                    $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$peserta->id_user.'" class="btn btn-sm btn-outline-dark peserta">' . COUNT($this->Main_model->get_all("kelas_user", ["id_user" => $peserta->id_user, "id_kelas <>" => NULL, "hapus" => 0])) . '</a></center>';
                    $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$peserta->id_user.'" class="btn btn-sm btn-outline-warning peserta">' . COUNT($this->Main_model->get_all("kelas_user", ["id_user" => $peserta->id_user, "id_kelas =" => NULL, "hapus" => 0])) . '</a></center>';
                    $row[] = '<a href="#modalEdit" data-toggle="modal" data-id="'.$peserta->id_user.'" class="btn btn-sm btn-info detail">detail</a>';
                    
                    $nama = str_replace(" ", "%20", $peserta->nama);
                    $link_member = $this->Main_model->get_one("option", ["field" => "link_member"]);
                    if($peserta->data_login == 1) $row[] = '<center><a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=%F0%9F%91%8F%20*Selamat%20'.$nama.'%20kamu%20sudah%20terdaftar%20di%20Member%20Area%20Al%20Azhar%20Arabic%20Online.*%0A%0A*Silahkan%20kunjungi%20'.$link_member['value'].'*%0A%0A*Ini%20data%20Login%20kamu%20ya%3A*%0AUsername%20%3A%20'.$peserta->username.'%0APassword%20%3A%20'.date('dmY', strtotime($peserta->tgl_lahir)).'%0A%0AJika%20ada%20pertanyaan%20lebih%20lanjut%2C%20harap%20menghubungi%20saya%20langsung%20ya%20%F0%9F%98%8A%0A%0A*-%20Admin%20Al%20Azhar%20Arabic%20Online*" id="dataLogin" class="btn btn-sm btn-success"><i class="fa fa-user-lock"></i></a></center>';
                    else $row[] = '<center><a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=%F0%9F%91%8F%20*Selamat%20'.$nama.'%20kamu%20sudah%20terdaftar%20di%20Member%20Area%20Al%20Azhar%20Arabic%20Online.*%0A%0A*Silahkan%20kunjungi%20'.$link_member['value'].'*%0A%0A*Ini%20data%20Login%20kamu%20ya%3A*%0AUsername%20%3A%20'.$peserta->username.'%0APassword%20%3A%20'.date('dmY', strtotime($peserta->tgl_lahir)).'%0A%0AJika%20ada%20pertanyaan%20lebih%20lanjut%2C%20harap%20menghubungi%20saya%20langsung%20ya%20%F0%9F%98%8A%0A%0A*-%20Admin%20Al%20Azhar%20Arabic%20Online*" id="dataLogin" class="btn btn-sm btn-secondary"><i class="fa fa-user-lock"></i></a></center>';
                } else {
                    $row[] = '<center>'.$no.'</center>';
                    if($peserta->username == "") $row[] = '<a href="javascript:void(0)" class="btn btn-sm btn-primary" data-id="'.$peserta->id_user.'|'.$peserta->nama.'" id="btnAddId">buat ID</a>';
                    else $row[] = $peserta->username;
                    $row[] = $peserta->nama;
                    
                    // btn follow up 
                    if($peserta->username == "") {
                        if($peserta->followup == 2){
                            $row[] = '<center>
                                    <a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=*Follow%20up*%0A%0A%D8%A7%D9%84%D8%B3%D9%84%D8%A7%D9%85%20%D8%B9%D9%84%D9%8A%D9%83%D9%85%0ASelamat%20datang%20di%20Lembaga%20Al-Azhar%20Arabic%20Online%20kak%20'.$peserta->nama.'%20%E2%98%BA%EF%B8%8F%0A%0AKami%20ingin%20mengingatkan%20pendaftaran%20kakak%20yang%20tertunda%20sudah%20dengan%20rincian%20sebagai%20berikut%2C%0A%0AProgram%20%3A%20Al%20Azhar%20Arabic%20Online%0ABiaya%20%3A%20Rp150.000%0ATotal%20%3A%20Rp150.000%0A%0A%0APendaftar%20atas%20nama%20%3A%0ANama%20%3A%20%20'.$peserta->nama.'%0ANo%20HP%20%3A%20%20'.$peserta->no_hp.'%0AAlamat%20%3A%20'.$peserta->alamat.'%20%0A%0ASilahkan%20transfer%20senilai%20Rp150.000%2C%20ke%20rekening%20dibawah%20ini%3A%0AMandiri%0ANo.%20Rek%20%3A%201710003472746%0AAtas%20Nama%20%3A%20Cv%20Alazhar%0A%0A*NB%20%3A%20Abaikan%20pesan%20ini%20jika%20kakak%20sudah%20menyelesaikan%20pembayaran*|1" id="followUp1" class="btn btn-sm btn-success mr-1">1</a>
                                    <a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=*Follow%20up*%0A%0A%D8%A7%D9%84%D8%B3%D9%84%D8%A7%D9%85%20%D8%B9%D9%84%D9%8A%D9%83%D9%85%0ASelamat%20datang%20di%20Lembaga%20Al-Azhar%20Arabic%20Online%20kak%20'.$peserta->nama.'%20%E2%98%BA%EF%B8%8F%0A%0AKami%20ingin%20mengingatkan%20pendaftaran%20kakak%20yang%20tertunda%20sudah%20dengan%20rincian%20sebagai%20berikut%2C%0A%0AProgram%20%3A%20Al%20Azhar%20Arabic%20Online%0ABiaya%20%3A%20Rp150.000%0ATotal%20%3A%20Rp150.000%0A%0A%0APendaftar%20atas%20nama%20%3A%0ANama%20%3A%20%20'.$peserta->nama.'%0ANo%20HP%20%3A%20%20'.$peserta->no_hp.'%0AAlamat%20%3A%20'.$peserta->alamat.'%20%0A%0ASilahkan%20transfer%20senilai%20Rp150.000%2C%20ke%20rekening%20dibawah%20ini%3A%0AMandiri%0ANo.%20Rek%20%3A%201710003472746%0AAtas%20Nama%20%3A%20Cv%20Alazhar%0A%0A*NB%20%3A%20Abaikan%20pesan%20ini%20jika%20kakak%20sudah%20menyelesaikan%20pembayaran*|2" id="followUp2" class="btn btn-sm btn-success">2</a>
                            </center>';
                        } else if($peserta->followup == 1){
                            $row[] = '<center>
                                    <a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=*Follow%20up*%0A%0A%D8%A7%D9%84%D8%B3%D9%84%D8%A7%D9%85%20%D8%B9%D9%84%D9%8A%D9%83%D9%85%0ASelamat%20datang%20di%20Lembaga%20Al-Azhar%20Arabic%20Online%20kak%20'.$peserta->nama.'%20%E2%98%BA%EF%B8%8F%0A%0AKami%20ingin%20mengingatkan%20pendaftaran%20kakak%20yang%20tertunda%20sudah%20dengan%20rincian%20sebagai%20berikut%2C%0A%0AProgram%20%3A%20Al%20Azhar%20Arabic%20Online%0ABiaya%20%3A%20Rp150.000%0ATotal%20%3A%20Rp150.000%0A%0A%0APendaftar%20atas%20nama%20%3A%0ANama%20%3A%20%20'.$peserta->nama.'%0ANo%20HP%20%3A%20%20'.$peserta->no_hp.'%0AAlamat%20%3A%20'.$peserta->alamat.'%20%0A%0ASilahkan%20transfer%20senilai%20Rp150.000%2C%20ke%20rekening%20dibawah%20ini%3A%0AMandiri%0ANo.%20Rek%20%3A%201710003472746%0AAtas%20Nama%20%3A%20Cv%20Alazhar%0A%0A*NB%20%3A%20Abaikan%20pesan%20ini%20jika%20kakak%20sudah%20menyelesaikan%20pembayaran*|1" id="followUp1" class="btn btn-sm btn-success mr-1">1</a>
                                    <a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=*Follow%20up*%0A%0A%D8%A7%D9%84%D8%B3%D9%84%D8%A7%D9%85%20%D8%B9%D9%84%D9%8A%D9%83%D9%85%0ASelamat%20datang%20di%20Lembaga%20Al-Azhar%20Arabic%20Online%20kak%20'.$peserta->nama.'%20%E2%98%BA%EF%B8%8F%0A%0AKami%20ingin%20mengingatkan%20pendaftaran%20kakak%20yang%20tertunda%20sudah%20dengan%20rincian%20sebagai%20berikut%2C%0A%0AProgram%20%3A%20Al%20Azhar%20Arabic%20Online%0ABiaya%20%3A%20Rp150.000%0ATotal%20%3A%20Rp150.000%0A%0A%0APendaftar%20atas%20nama%20%3A%0ANama%20%3A%20%20'.$peserta->nama.'%0ANo%20HP%20%3A%20%20'.$peserta->no_hp.'%0AAlamat%20%3A%20'.$peserta->alamat.'%20%0A%0ASilahkan%20transfer%20senilai%20Rp150.000%2C%20ke%20rekening%20dibawah%20ini%3A%0AMandiri%0ANo.%20Rek%20%3A%201710003472746%0AAtas%20Nama%20%3A%20Cv%20Alazhar%0A%0A*NB%20%3A%20Abaikan%20pesan%20ini%20jika%20kakak%20sudah%20menyelesaikan%20pembayaran*|2" id="followUp2" class="btn btn-sm btn-secondary">2</a>
                            </center>';
                        } else {
                            $row[] = '<center>
                                    <a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=*Follow%20up*%0A%0A%D8%A7%D9%84%D8%B3%D9%84%D8%A7%D9%85%20%D8%B9%D9%84%D9%8A%D9%83%D9%85%0ASelamat%20datang%20di%20Lembaga%20Al-Azhar%20Arabic%20Online%20kak%20'.$peserta->nama.'%20%E2%98%BA%EF%B8%8F%0A%0AKami%20ingin%20mengingatkan%20pendaftaran%20kakak%20yang%20tertunda%20sudah%20dengan%20rincian%20sebagai%20berikut%2C%0A%0AProgram%20%3A%20Al%20Azhar%20Arabic%20Online%0ABiaya%20%3A%20Rp150.000%0ATotal%20%3A%20Rp150.000%0A%0A%0APendaftar%20atas%20nama%20%3A%0ANama%20%3A%20%20'.$peserta->nama.'%0ANo%20HP%20%3A%20%20'.$peserta->no_hp.'%0AAlamat%20%3A%20'.$peserta->alamat.'%20%0A%0ASilahkan%20transfer%20senilai%20Rp150.000%2C%20ke%20rekening%20dibawah%20ini%3A%0AMandiri%0ANo.%20Rek%20%3A%201710003472746%0AAtas%20Nama%20%3A%20Cv%20Alazhar%0A%0A*NB%20%3A%20Abaikan%20pesan%20ini%20jika%20kakak%20sudah%20menyelesaikan%20pembayaran*|1" id="followUp1" class="btn btn-sm btn-secondary mr-1">1</a>
                                    <a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=*Follow%20up*%0A%0A%D8%A7%D9%84%D8%B3%D9%84%D8%A7%D9%85%20%D8%B9%D9%84%D9%8A%D9%83%D9%85%0ASelamat%20datang%20di%20Lembaga%20Al-Azhar%20Arabic%20Online%20kak%20'.$peserta->nama.'%20%E2%98%BA%EF%B8%8F%0A%0AKami%20ingin%20mengingatkan%20pendaftaran%20kakak%20yang%20tertunda%20sudah%20dengan%20rincian%20sebagai%20berikut%2C%0A%0AProgram%20%3A%20Al%20Azhar%20Arabic%20Online%0ABiaya%20%3A%20Rp150.000%0ATotal%20%3A%20Rp150.000%0A%0A%0APendaftar%20atas%20nama%20%3A%0ANama%20%3A%20%20'.$peserta->nama.'%0ANo%20HP%20%3A%20%20'.$peserta->no_hp.'%0AAlamat%20%3A%20'.$peserta->alamat.'%20%0A%0ASilahkan%20transfer%20senilai%20Rp150.000%2C%20ke%20rekening%20dibawah%20ini%3A%0AMandiri%0ANo.%20Rek%20%3A%201710003472746%0AAtas%20Nama%20%3A%20Cv%20Alazhar%0A%0A*NB%20%3A%20Abaikan%20pesan%20ini%20jika%20kakak%20sudah%20menyelesaikan%20pembayaran*|2" id="followUp2" class="btn btn-sm btn-secondary">2</a>
                            </center>';
                        }
                    } else $row[] = '<center>-</center>';

                    // btn delete peserta 
                    if($peserta->username == "") $row[] = '<center><a href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'" class="btn btn-sm btn-danger delete_peserta"><i class="fa fa-trash-alt"></i></a></center>';
                    else $row[] = "<center>-</center>";

                    // btn waiting list peserta 
                    $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$peserta->id_user.'" class="btn btn-sm btn-outline-warning peserta">' . COUNT($this->Main_model->get_all("kelas_user", ["id_user" => $peserta->id_user, "id_kelas =" => NULL, "hapus" => 0])) . '</a></center>';
                    
                    // btn detail peserta 
                    $row[] = '<a href="#modalEdit" data-toggle="modal" data-id="'.$peserta->id_user.'" class="btn btn-sm btn-info detail">detail</a>';
                    
                    // btn data login 
                    $nama = str_replace(" ", "%20", $peserta->nama);
                    $link_member = $this->Main_model->get_one("option", ["field" => "link_member"]);
                    if($peserta->username == "") $row[] = "<center>-</center>";
                    else {
                        if($peserta->data_login == 1) $row[] = '<center><a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=%F0%9F%91%8F%20*Selamat%20'.$nama.'%20kamu%20sudah%20terdaftar%20di%20Member%20Area%20Al%20Azhar%20Arabic%20Online.*%0A%0A*Silahkan%20kunjungi%20'.$link_member['value'].'*%0A%0A*Ini%20data%20Login%20kamu%20ya%3A*%0AUsername%20%3A%20'.$peserta->username.'%0APassword%20%3A%20'.date('dmY', strtotime($peserta->tgl_lahir)).'%0A%0AJika%20ada%20pertanyaan%20lebih%20lanjut%2C%20harap%20menghubungi%20saya%20langsung%20ya%20%F0%9F%98%8A%0A%0A*-%20Admin%20Al%20Azhar%20Arabic%20Online*" id="dataLogin" class="btn btn-sm btn-success"><i class="fa fa-user-lock"></i></a></center>';
                        else $row[] = '<center><a target="_blank" href="javascript:void(0)" data-id="'.$peserta->id_user.'|'.$peserta->nama.'|https://api.whatsapp.com/send?phone=62'.substr($peserta->no_hp, 1).'&text=%F0%9F%91%8F%20*Selamat%20'.$nama.'%20kamu%20sudah%20terdaftar%20di%20Member%20Area%20Al%20Azhar%20Arabic%20Online.*%0A%0A*Silahkan%20kunjungi%20'.$link_member['value'].'*%0A%0A*Ini%20data%20Login%20kamu%20ya%3A*%0AUsername%20%3A%20'.$peserta->username.'%0APassword%20%3A%20'.date('dmY', strtotime($peserta->tgl_lahir)).'%0A%0AJika%20ada%20pertanyaan%20lebih%20lanjut%2C%20harap%20menghubungi%20saya%20langsung%20ya%20%F0%9F%98%8A%0A%0A*-%20Admin%20Al%20Azhar%20Arabic%20Online*" id="dataLogin" class="btn btn-sm btn-secondary"><i class="fa fa-user-lock"></i></a></center>';
                    }

                    // btn konfirmasi peserta 
                    if($peserta->username == "") $row[] = "<center>-</center>";
                    else {
                        // if($peserta->data_login == 1) 
                        if(COUNT($this->Main_model->get_all("kelas_user", ["id_user" => $peserta->id_user, "closing" => 0, "hapus" => 0])) == 0) $row[] = '<a href="javascript:void(0)" data-toggle="modal" data-id="'.$peserta->id_user.'|'.$peserta->nama.'" class="btn btn-sm btn-success konfirmasi">konfirmasi</a>';
                        else $row[] = '<a href="javascript:void(0)" onclick="alert(`Sebelum mengkonfirmasi peserta, input data closing terlebih dahulu`)" class="btn btn-sm btn-secondary">konfirmasi</a>';
                    }
                    
                    if($peserta->username == "") {
                        $row[] = "<center>-</center>";
                    } elseif($peserta->username != "" && COUNT($this->Main_model->get_all("kelas_user", ["id_user" => $peserta->id_user, "closing" => 0, "hapus" => 0])) == 0) { 
                        $row[] = "<center>-</center>";
                    } else {
                        // if($peserta->data_login == 1) 
                        $row[] = '<a href="#modalClosing" data-toggle="modal" data-id="'.$peserta->id_user.'" class="btn btn-sm btn-warning closing">closing</a>';
                        // else $row[] = '<a href="javascript:void(0)" onclick="alert(`Sebelum mengkonfirmasi peserta, kirim data login terlebih dahulu`)" class="btn btn-sm btn-secondary">konfirmasi</a>';
                    }
                }
    
                $data[] = $row;
            }
    
            $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Peserta_model->count_all("konfirm = $konfirm"),
                        "recordsFiltered" => $this->Peserta_model->count_filtered("konfirm = $konfirm"),
                        "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }

        public function wl_list(){
            $list = $this->Wl_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $peserta) {
                $no++;
                $row = array();
                $row[] = '<center>'.$no.'</center>';
                $row[] = $peserta->username;
                $row[] = $peserta->nama;
                $row[] = $peserta->program;
                $row[] = '<a href="#modalAdd" data-toggle="modal" data-id="'.$peserta->id.'|'.$peserta->nama.'|'.$peserta->program.'" class="btn btn-sm btn-info kelas">kelas</a>';
                $row[] = '<center><a href="javascript:void(0)" data-id="'.$peserta->id.'|'.$peserta->nama.'|'.$peserta->program.'" class="btn btn-sm btn-danger delete-wl"><i class="fa fa-trash-alt"></i></a></center>';
    
                $data[] = $row;
            }
    
            $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Wl_model->count_all(),
                        "recordsFiltered" => $this->Wl_model->count_filtered(),
                        "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }

        // get
            public function get_detail_peserta(){
                $link_member = $this->Main_model->get_one("option", ["field" => "link_member"]);
                $id = $this->input->post("id");
                $data = $this->Main_model->get_one("user", ["id_user" => $id]);
                $nama = str_replace(" ", "%20", $data['nama']);
                $data['link'] = 'https://api.whatsapp.com/send?phone=62'.substr($data["no_hp"], 1).'&text=%F0%9F%91%8F%20*Selamat%20'.$nama.'%20kamu%20sudah%20terdaftar%20di%20Member%20Area%20Al%20Azhar%20Arabic%20Online.*%0A%0A*Silahkan%20kunjungi%20'.$link_member['value'].'*%0A%0A*Ini%20data%20Login%20kamu%20ya%3A*%0AUsername%20%3A%20'.$data['username'].'%0APassword%20%3A%20'.date('dmY', strtotime($data['tgl_lahir'])).'%0A%0AJika%20ada%20pertanyaan%20lebih%20lanjut%2C%20harap%20menghubungi%20saya%20langsung%20ya%20%F0%9F%98%8A%0A%0A*-%20Admin%20Al%20Azhar%20Arabic%20Online*';

                // kelas peserta 
                    $kelas = $this->Main_model->get_all("kelas_user", ["id_user" => $id, "id_kelas <>" => NULL, "hapus" => 0], "id");
                    foreach ($kelas as $i => $kelas) {
                        $data['user'][$i] = $kelas;
                        $data['user'][$i]['link'] = MD5($kelas['id']);
                        $data['user'][$i]['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $kelas['id_kelas']]);
                    }
                // kelas peserta 
                
                // waiting list peserta 
                    $wl = $this->Main_model->get_all("kelas_user", ["id_user" => $id, "id_kelas =" => NULL, "hapus" => 0], "id");
                    foreach ($wl as $i => $wl) {
                        $data['wl'][$i] = $wl;
                    }
                // waiting list peserta 
                echo json_encode($data);
            }

            public function get_kelas_peserta(){
                $id = $this->input->post("id");
                $kelas = $this->Main_model->get_all("kelas_user", ["id_user" => $id, "id_kelas <>" => NULL, "hapus" => 0]);
                foreach ($kelas as $i => $kelas) {
                    $data['user'][$i] = $kelas;
                    $data['user'][$i]['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $kelas['id_kelas']]);
                }
                echo json_encode($data);
            }
        // get

        // edit
            public function edit_peserta(){
                $id = $this->input->post("id_user", TRUE);
                $data = [
                    "nama" => $this->input->post("nama", TRUE),
                    "no_hp" => $this->input->post("no_hp", TRUE),
                    "alamat" => $this->input->post("alamat", TRUE),
                    "t4_lahir" => $this->input->post("t4_lahir", TRUE),
                    "tgl_lahir" => $this->input->post("tgl_lahir", TRUE),
                    "email" => $this->input->post("email", TRUE)
                ];

                $this->Main_model->edit_data("user", ["id_user" => $id], $data);
                echo json_encode("1");
            }

            public function konfirmasi(){
                $id_user = $this->input->post("id_user", TRUE);
                $this->Main_model->edit_data("user", ["id_user" => $id_user], ["konfirm" => 1]);
                echo json_encode("1");
            }
        // edit

        // delete
            public function remove_kelas(){
                $kelas = $this->input->post("id");
                foreach ($kelas as $kelas) {
                    $this->Main_model->edit_data("kelas_user", ["id" => $kelas], ["hapus" => 1]);
                }
                echo json_encode("1");
            }

            public function delete_wl(){
                $id = $this->input->post("id");
                $data = $this->Main_model->get_one("kelas_user", ["id" => $id]);
                $this->Main_model->edit_data("kelas_user", ["id" => $id], ["hapus" => 1]);
                
                // hapus closing 
                    $this->Main_model->edit_data("closing_peserta", ["id" => $id], ["status" => 1]);
                // hapus closing 

                echo json_encode($data['id_user']);
            }

            public function delete_peserta(){
                $id = $this->input->post("id");
                $this->Main_model->edit_data("user", ["id_user" => $id], ["konfirm" => 2]);
                echo json_encode("1");
            }
        // delete

        // add
            public function add_kelas(){
                $id_kelas = $this->input->post("id_kelas", TRUE);
                $id_user = $this->input->post("id_user", TRUE);
                $user = $this->Main_model->get_one("user", ["id_user" => $id_user]);

                if($id_kelas == "") $id_kelas = NULL;
                $data = [
                    "id_kelas" => $id_kelas,
                    "id_user" => $id_user,
                    "nama" => $user['nama'],
                    "t4_lahir" => $user["t4_lahir"],
                    "tgl_lahir" => $user["tgl_lahir"],
                    "alamat" => $user["alamat"],
                    "program" => $this->input->post("program", TRUE),
                    "hapus" => 0
                ];

                $cek = $this->Main_model->get_one("kelas_user", $data);
                if($cek){
                    echo json_encode("0");
                } else {
                    $id = $this->Main_model->add_data("kelas_user", $data);
                    $sumber = $this->input->post("sumber", TRUE);
                    if($sumber == "Lainnya") {
                        $sumber = $this->input->post("sumber_lainnya");
                        $this->Main_model->add_data("sumber_closing", ["sumber" => $sumber]);
                    }
                    else $sumber = $sumber;

                    $data = [
                        "id_kelas_user" => $id,
                        "id_user" => $id_user,
                        "tgl_closing" => $this->input->post("tgl_closing", TRUE),
                        "nama" => $user['nama'],
                        "t4_lahir" => $user["t4_lahir"],
                        "tgl_lahir" => $user["tgl_lahir"],
                        "alamat" => $user["alamat"],
                        "no_wa" => $user["no_hp"],
                        "program" => $this->input->post("program", TRUE),
                        "biaya" => $this->Main_model->rupiah_to_int($this->input->post("biaya", TRUE)),
                        "sumber" => $sumber,
                    ];

                    $result = $this->Main_model->add_data("closing_peserta", $data);
                    echo json_encode("1");
                }
            }

            public function add_kelas_wl(){
                $id = $this->input->post("id");
                $id_kelas = $this->input->post("id_kelas");

                $this->Main_model->edit_data("kelas_user", ["id" => $id], ["id_kelas" => $id_kelas]);
                echo json_encode("1");
            }

            public function add_peserta(){
                $user = $this->username($this->input->post("tgl_masuk", TRUE));
                $password = date('dmY', strtotime($this->input->post("tgl_lahir", TRUE)));
                $data = [
                    "nama" => $this->input->post("nama", TRUE),
                    "no_hp" => $this->input->post("no_hp", TRUE),
                    "alamat" => $this->input->post("alamat", TRUE),
                    "tgl_lahir" => $this->input->post("tgl_lahir", TRUE),
                    "tgl_masuk" => $this->input->post("tgl_masuk", TRUE),
                    "t4_lahir" => $this->input->post("t4_lahir", TRUE),
                    "email" => $this->input->post("email", TRUE),
                    "username" => $user,
                    "password" => MD5($password),
                ];

                $this->Main_model->add_data("user", $data);
                echo json_encode("1");
            }

            public function buat_id(){
                $id = $this->input->post("id");
                $tgl = date("Y-m-d");
                $user = $this->username($tgl);
                $data = [
                    "username" => $user,
                    "tgl_masuk" => $tgl
                ];

                $this->Main_model->edit_data("user", ["id_user" => $id], $data);
                echo json_encode("1");
            }

            public function add_followup(){
                $id = $this->input->post("id");
                $followup = $this->input->post("followup");
                $data = $this->Main_model->get_one("user", ["id_user" => $id]);
                $this->Main_model->edit_data("user", ["id_user" => $id], ["followup" => $followup]);
                echo json_encode("1");
            }

            public function username($tgl){
                $username = $this->Main_model->get_username_terakhir($tgl);
                if($username){
                    $id = $username['id'] + 1;
                } else {
                    $id = 1;
                }

                if($id >= 1 && $id < 10){
                    $user = date('ym', strtotime($tgl))."000".$id;
                } else if($id >= 10 && $id < 100){
                    $user = date('ym', strtotime($tgl))."00".$id;
                } else if($id >= 100 && $id < 1000){
                    $user = date('ym', strtotime($tgl))."0".$id;
                } else {
                    $user = date('ym', strtotime($tgl)).$id;
                }
                return $user;
            }

        public function send_login(){
            $id = $this->input->post("id");
            $this->Main_model->edit_data("user", ["id_user" => $id], ["data_login" => "1"]);
            echo json_encode("1");
        }

    }