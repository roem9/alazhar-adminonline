<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>
            <div class="">
                <a href="#modalAdd" data-toggle="modal" class="btn btn-success btn-sm mb-3 btnModal"><i class="fa fa-plus"></i> Tambah Kelas</a>
                <a onclick="reload_table()" data-toggle="modal" class="btn btn-sm btn-info mb-3 text-light"><i class="fa fa-sync"></i> Reload</a>
            </div>
            <div class="notification">
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="msgKelas">
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4" style="max-width: 1000px">
                <div class="card-body">
                    <div id="reload">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <tr>
                                    <th style="width: 3%">No</th>
                                    <th style="width: 6%">Status</th>
                                    <th style="width: 10%">Tgl. Mulai</th>
                                    <th style="width: 23%">Nama Kelas</th>
                                    <th>Pengajar</th>
                                    <th style="width: 10%"><center>Program</center></th>
                                    <th style="width: 5%">Peserta</th>
                                    <th style="width: 5%">WL</th>
                                    <th style="width: 5%">Detail</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal kelas -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDetail">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link active' id="btn-form-1"><i class="fas fa-book"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-2"><i class="fas fa-users"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-3"><i class="fas fa-clock"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body cus-font">
                        <div class="card" id="form-1">
                            <div class="card-header text-primary">
                                <strong>Data Kelas</strong>
                            </div>
                            <div class="card-body">
                                <div class="msgEditKelas"></div>
                                <form action="kelas/edit_kelas" method="post" id="formEditKelas">
                                    <input type="hidden" name="id_kelas">
                                    <div class="form-group">
                                        <label for="nama_kelas">Nama Kelas</label>
                                        <input type="text" name="nama_kelas" id="nama_kelas_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="program">Program</label>
                                        <select name="program" id="program_edit" class="form-control form-control-sm">
                                            <option value="">Pilih Program</option>
                                            <?php foreach ($program as $data) :?>
                                                <option value="<?= $data['program']?>"><?= $data['program']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_civitas">Pengajar</label>
                                        <select name="id_civitas" id="id_civitas_edit" class="form-control form-control-sm">
                                            <option value="0">Pilih Pengajar</option>
                                            <?php foreach ($civitas as $data) :?>
                                                <option value="<?= $data['id_civitas']?>"><?= $data['nama_civitas']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_mulai">Tgl. Mulai</label>
                                        <input type="date" name="tgl_mulai" id="tgl_mulai_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_selesai">Tgl. Selesai</label>
                                        <input type="date" name="tgl_selesai" id="tgl_selesai_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" value="Ubah Data" class="btn btn-sm btn-success" id="btnEdit">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card" id="form-2">
                            <div class="card-header text-primary">
                                <strong>List Peserta <span class="badge badge-info" id="jumPeserta">0</span></strong>
                            </div>
                            <div class="card-body">
                                <div class="msgHapusPeserta"></div>
                                <form action="kelas/delete_peserta" method="post" id="formDeletePeserta">
                                    <input type="hidden" name="id_kelas">
                                    <ul class="list-group">
                                        <div id="list-peserta"></div>
                                    </ul>
                                </form>
                            </div>
                        </div>

                        <div class="card" id="form-3">
                            <div class="card-header text-primary">
                                <strong>Waiting list Peserta <span class="badge badge-info" id="jumWlPeserta">0</span></strong>
                            </div>
                            <div class="card-body">
                                <div class="msgHapusPeserta"></div>
                                <form action="kelas/delete_peserta" method="post" id="formWlPeserta">
                                    <input type="hidden" name="id_kelas">
                                    <ul class="list-group">
                                        <div id="list-wl-peserta"></div>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- modal kelas -->

<!-- modal add kelas -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add">
                <div class="msg-add-data"></div>
                <form action="kelas/add_kelas" method="post" id="formAdd">
                    <div class="form-group">
                        <label for="tgl_mulai">Tgl. Mulai</label>
                        <input type="date" name="tgl_mulai" id="tgl_mulai_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai">Tgl. Selesai</label>
                        <input type="date" name="tgl_selesai" id="tgl_selesai_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select name="program" id="program_add" class="form-control form-control-sm" required>
                            <option value="">Pilih Program</option>
                            <?php foreach ($program as $data) :?>
                                <option value="<?= $data['program']?>"><?= $data['program']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Tambah Kelas" class="btn btn-sm btn-primary" id="btnModalAdd">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add kelas -->
<script>
    $("#sidebarKelas").addClass("active");
    
    $(".btnModal").click(function(){
        delete_msg();
    })

    // peserta
    let a = [];

    // pertemuan
    let b = [];

    $(".btnModal").click(function(){
        delete_msg();
    })
                                    
    table = $('#dataTable').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url()?>kelas/ajax_list/<?= $status?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0, 6, 7], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });
    
    // untuk menghindari input double ajax 
    var finish = 1;

    $("#formAdd").submit(function(){
        if(finish == 1){
            finish = 2;
            if(confirm("Yakin akan menambahkan kelas baru?")){
                var tgl_mulai = $("#tgl_mulai_add").val();
                var tgl_selesai = $("#tgl_selesai_add").val();
                var nama_kelas = $("#nama_kelas_add").val();
                var program = $("#program_add").val();
                $.ajax({
                    type : "POST",
                    url : "<?= base_url()?>kelas/add_kelas",
                    dataType : "JSON",
                    data : {tgl_mulai : tgl_mulai,tgl_selesai : tgl_selesai,nama_kelas : nama_kelas,program : program},
                    success : function(data){
                        $("#formAdd").trigger("reset");
            
                        $("#tgl_mulai_add").val(tgl_mulai);
                        $("#tgl_selesai_add").val(tgl_selesai);

                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas baru<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msg-add-data').html(msg);
                        $("#modal-add").scrollTop(0);
                        reload_table();

                        finish = 1;
                    },
                })
            } else {
                finish = 1;
            }
        }
        return false;
    })

    $("#formEditKelas").submit(function(){
        if(confirm("Yakin akan merubah data kelas ini?")){
            var id = $("input[name='id_kelas']").val()
            var nama_kelas = $("#nama_kelas_edit").val();
            var program = $("#program_edit").val();
            var tgl_mulai = $("#tgl_mulai_edit").val();
            var tgl_selesai = $("#tgl_selesai_edit").val();
            var id_civitas = $("#id_civitas_edit").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>kelas/edit_kelas",
                dataType : "JSON",
                data : {id_kelas : id,nama_kelas : nama_kelas,program : program,tgl_mulai : tgl_mulai,tgl_selesai : tgl_selesai,id_civitas : id_civitas},
                success : function(data){
                    // $("#modalEditTitle").html(nama)
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah data kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgEditKelas').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    reload_table();
                }
            })
        }
        return false;
    })
    
    $("#dataTable").on("click", ".detail", function(){
        const id = $(this).data('id');
        detail(id)
        btn_1();
        delete_msg();
    })
    
    $("#dataTable").on("click", ".peserta", function(){
        const id = $(this).data('id');
        detail(id)
        btn_2();
        delete_msg();
    })

    $("#dataTable").on("click", ".wl", function(){
        const id = $(this).data('id');
        detail(id)
        btn_3();
        delete_msg();
    })

    $("#dataTable").on("click", "#btnStatusKelas", function(){
        let data = $(this).data("id");
        data = data.split("|");
        let id = data[0];
        let nama = data[1];
        let status = data[2]

        if(confirm("Yakin akan "+status+" kelas "+nama+"?")){
            $.ajax({
                url: "<?= base_url()?>kelas/edit_status_kelas",
                type: "POST",
                data: {id: id},
                dataType: "JSON",
                success: function(data){
                    reload_table();
                    $(".msgKelas").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle text-success mr-1"></i> berhasil mengganti status kelas
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`)
                }
            })
        }
    })
    
    $("#formDeletePeserta").submit(function(){
        if(confirm("Yakin akan menghapus peserta dari kelas ini?")){
            if((a === undefined || a.length == 0)){
                var msg = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Untuk menghapus peserta silahkan menandai checkbox terlebih dahulu<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                $('.msgHapusPeserta').html(msg);
                $("#modalDetail").scrollTop(0);
            }
            var id = $("input[name='id_kelas']").val()
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>kelas/delete_peserta",
                dataType : "JSON",
                data : {peserta:a, id_kelas:id},
                success : function(data){
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus peserta dari kelas ini<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgHapusPeserta').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    btn_2();
                    reload_table();
                    $("#select1").html(0);
                }
            })
        }   
        return false;
    })

    $('#formDeletePeserta').on('click', 'input[type="checkbox"][name="peserta[]"]', function(){
        if($(this).prop("checked") == true){
            a.push($(this).val());
            $("#select1").html(a.length);
        }
        else if($(this).prop("checked") == false){
            let no = a.indexOf($(this).val());
            a.splice(no, 1);
            $("#select1").html(a.length);
        }
    });
    
    $('#formListPertemuan').on('click', 'input[type="checkbox"][name="pertemuan[]"]', function(){
        if($(this).prop("checked") == true){
            b.push($(this).val());
        }
        else if($(this).prop("checked") == false){
            let no = b.indexOf($(this).val());
            b.splice(no, 1);
        }
    });
    
    $("#formListPertemuan").submit(function(){
        if(confirm("Yakin akan merubah data pertemuan?")){
            var id = $("input[name='id_kelas']").val()
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>kelas/list_pertemuan",
                dataType : "JSON",
                data : {pertemuan:b, id_kelas:id},
                success : function(data){
                    b = [];
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah data pertemuan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgListPertemuan').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    reload_table();
                }
            })
        }   
        return false;
    })
    
    
    // hapus peserta dari kelas
        $("#list-peserta").on('click', '#keluar_kelas', function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id = data[0];
            let nama = data[1];
            let kelas = data[2];
            if(confirm("Yakin akan mengeluarkan "+nama+" dari kelas "+kelas+"?")){
                $.ajax({
                    url: "<?= base_url()?>kelas/keluar_kelas",
                    data: {id: id},
                    method: "POST",
                    success: function(data){
                        detail(data);
                        reload_table();
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus peserta dari kelas ini<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgHapusPeserta').html(msg);
                    }
                })
            }
        })

    // masukkan waiting list ke kelas
        $("#list-wl-peserta").on("click", "#add_kelas_wl", function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id = data[0];
            let nama = data[1];
            let kelas = data[2];
            let id_kelas = data[3]
            if(confirm("Yakin akan menambahkan "+nama+" ke kelas "+kelas+"?")){
                $.ajax({
                    url: "<?= base_url()?>kelas/add_kelas_wl",
                    data: {id: id, id_kelas: id_kelas},
                    method: "POST",
                    success: function(data){
                        detail(data);
                        reload_table();
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil memasukkan peserta ke kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgHapusPeserta').html(msg);
                    }
                })
            }
        })
    
    // hapus peserta dari waiting list 
        $("#list-wl-peserta").on('click', '#delete_wl', function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id = data[0];
            let nama = data[1];
            let kelas = data[2];
            let id_kelas = data[3]
            if(confirm("Yakin akan menghapus "+nama+" dari waiting list "+kelas+"?")){
                $.ajax({
                    url: "<?= base_url()?>kelas/delete_wl",
                    data: {id: id, id_kelas: id_kelas},
                    method: "POST",
                    success: function(data){
                        detail(data);
                        reload_table();
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus peserta dari waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgHapusPeserta').html(msg);
                    }
                })
            }
        })

    // detail
        $("#btn-form-1").click(function(){
            btn_1();
            delete_msg();
        })
        
        $("#btn-form-2").click(function(){
            btn_2();
            delete_msg();
        })
        
        $("#btn-form-3").click(function(){
            btn_3();
            delete_msg();
        })
    // detail

    // function 
        function reload_table(){
            table.ajax.reload(null,false); //reload datatable ajax 
        }

        function btn_1(){
            $("#btn-form-1").addClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").removeClass('active');
            
            $("#form-1").show();
            $("#form-2").hide();
            $("#form-3").hide();
        }

        function btn_2(){ 
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").addClass('active');
            $("#btn-form-3").removeClass('active');
            
            $("#form-1").hide();
            $("#form-2").show();
            $("#form-3").hide();
        }
        
        function btn_3(){
            $("#id_kelas_add").val("");
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").addClass('active');
            
            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").show();
        }

        function delete_msg(){
            $('.msgHapusPeserta').html("");
            $('.msgEditKelas').html("");
            $('.msg-add-data').html("");
            $('.msgListPertemuan').html("");
            $('.msgKelas').html("");
            $('.msg-nilai').html("");
        }

        function detail(id){
            $.ajax({
                url : "<?=base_url()?>kelas/get_detail_kelas",
                method : "POST",
                data : {id : id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#modalEditTitle").html(data.nama_kelas);
                    $("input[name='id_kelas']").val(data.id_kelas);
                    $("#nama_kelas_edit").val(data.nama_kelas);
                    $("#program_edit").val(data.program);
                    $("#tgl_mulai_edit").val(data.tgl_mulai)
                    $("#tgl_selesai_edit").val(data.tgl_selesai)
                    $("#id_civitas_edit").val(data.id_civitas)
                    
                    pert = [];
                    data.pertemuan.forEach((materi, i) => {
                        pert[i] = materi.materi;
                    });
                    
                    let html = "";

                    // let peserta = data.peserta;
                    if(data.program == "Tahfidz Putra" || data.program == "Tahfidz Putri"){
                        if(data.peserta){
                            $("#jumPeserta").html(data.peserta.length)
                            data.peserta.forEach((element, i) => {
                                if(data.status == "aktif") btnDelete = `<a href="javascript:void(0)" id="keluar_kelas" class="mr-1" data-id="`+element.id+`|`+element.nama+`|`+data.nama_kelas+`"><i class="fa fa-minus-circle text-danger"></i></a>`
                                else btnDelete = "";

                                if(element.nilai == "") nilai = `<small class="form-text text-danger">nilai belum diinputkan</small>`
                                else nilai = ``

                                dataNilai = [];

                                for (let i = 0; i < 30; i++) {
                                    dataNilai[i] = ""
                                }

                                if(element.nilai == "الأول"){ dataNilai[0] = "selected"}else{dataNilai[0] = ""}
                                if(element.nilai == "الثاني"){ dataNilai[1] = "selected"}else{dataNilai[1] = ""}
                                if(element.nilai == "الثالث"){ dataNilai[2] = "selected"}else{dataNilai[2] = ""}
                                if(element.nilai == "الرابع"){ dataNilai[3] = "selected"}else{dataNilai[3] = ""}
                                if(element.nilai == "الخامس"){ dataNilai[4] = "selected"}else{dataNilai[4] = ""}
                                if(element.nilai == "السادس"){ dataNilai[5] = "selected"}else{dataNilai[5] = ""}
                                if(element.nilai == "السابع"){ dataNilai[6] = "selected"}else{dataNilai[6] = ""}
                                if(element.nilai == "الثامن"){ dataNilai[7] = "selected"}else{dataNilai[7] = ""}
                                if(element.nilai == "التاسع"){ dataNilai[8] = "selected"}else{dataNilai[8] = ""}
                                if(element.nilai == "العاشر"){ dataNilai[9] = "selected"}else{dataNilai[9] = ""}
                                if(element.nilai == "الحادي عشر"){ dataNilai[10] = "selected"}else{dataNilai[10] = ""}
                                if(element.nilai == "الثاني عشر"){ dataNilai[11] = "selected"}else{dataNilai[11] = ""}
                                if(element.nilai == "الثالث عشر"){ dataNilai[12] = "selected"}else{dataNilai[12] = ""}
                                if(element.nilai == "الرابع عشر"){ dataNilai[13] = "selected"}else{dataNilai[13] = ""}
                                if(element.nilai == "الخامس عشر"){ dataNilai[14] = "selected"}else{dataNilai[14] = ""}
                                if(element.nilai == "السادس عشر"){ dataNilai[15] = "selected"}else{dataNilai[15] = ""}
                                if(element.nilai == "السابع عشر"){ dataNilai[16] = "selected"}else{dataNilai[16] = ""}
                                if(element.nilai == "الثامن عشر"){ dataNilai[17] = "selected"}else{dataNilai[17] = ""}
                                if(element.nilai == "التاسع عشر"){ dataNilai[18] = "selected"}else{dataNilai[18] = ""}
                                if(element.nilai == "العشرون"){ dataNilai[19] = "selected"}else{dataNilai[19] = ""}
                                if(element.nilai == "الحادي و العشرون"){ dataNilai[20] = "selected"}else{dataNilai[20] = ""}
                                if(element.nilai == "الثاني و العشرون"){ dataNilai[21] = "selected"}else{dataNilai[21] = ""}
                                if(element.nilai == "الثالث و العشرون"){ dataNilai[22] = "selected"}else{dataNilai[22] = ""}
                                if(element.nilai == "الرابع و العشرون"){ dataNilai[23] = "selected"}else{dataNilai[23] = ""}
                                if(element.nilai == "الخامس و العشرون"){ dataNilai[24] = "selected"}else{dataNilai[24] = ""}
                                if(element.nilai == "السادس و العشرون"){ dataNilai[25] = "selected"}else{dataNilai[25] = ""}
                                if(element.nilai == "السابع و العشرون"){ dataNilai[26] = "selected"}else{dataNilai[26] = ""}
                                if(element.nilai == "الثامن و العشرون"){ dataNilai[27] = "selected"}else{dataNilai[27] = ""}
                                if(element.nilai == "التاسع و العشرون"){ dataNilai[28] = "selected"}else{dataNilai[28] = ""}
                                if(element.nilai == "الثلاثون"){ dataNilai[29] = "selected"}else{dataNilai[29] = ""}
                                html += `<li class="list-group-item d-flex justify-content-between">
                                            <span>
                                                `+btnDelete+`
                                                `+element.nama+`<br>
                                                <div class="form-inline mt-1">
                                                    <select name="nilai" id="nilai`+element.id+`" class="form-control form-control-sm mr-1">
                                                        <option value="">Juz</option>
                                                        <option `+dataNilai[0]+` value="الأول">الأول</option>
                                                        <option `+dataNilai[1]+` value="الثاني">الثاني</option>
                                                        <option `+dataNilai[2]+` value="الثالث">الثالث</option>
                                                        <option `+dataNilai[3]+` value="الرابع">الرابع</option>
                                                        <option `+dataNilai[4]+` value="الخامس">الخامس</option>
                                                        <option `+dataNilai[5]+` value="السادس">السادس</option>
                                                        <option `+dataNilai[6]+` value="السابع">السابع</option>
                                                        <option `+dataNilai[7]+` value="الثامن">الثامن</option>
                                                        <option `+dataNilai[8]+` value="التاسع">التاسع</option>
                                                        <option `+dataNilai[9]+` value="العاشر">العاشر</option>
                                                        <option `+dataNilai[10]+` value="الحادي عشر">الحادي عشر</option>
                                                        <option `+dataNilai[11]+` value="الثاني عشر">الثاني عشر</option>
                                                        <option `+dataNilai[12]+` value="الثالث عشر">الثالث عشر</option>
                                                        <option `+dataNilai[13]+` value="الرابع عشر">الرابع عشر</option>
                                                        <option `+dataNilai[14]+` value="الخامس عشر">الخامس عشر</option>
                                                        <option `+dataNilai[15]+` value="السادس عشر">السادس عشر</option>
                                                        <option `+dataNilai[16]+` value="السابع عشر">السابع عشر</option>
                                                        <option `+dataNilai[17]+` value="الثامن عشر">الثامن عشر</option>
                                                        <option `+dataNilai[18]+` value="التاسع عشر">التاسع عشر</option>
                                                        <option `+dataNilai[19]+` value="العشرون">العشرون</option>
                                                        <option `+dataNilai[20]+` value="الحادي و العشرون">الحادي و العشرون</option>
                                                        <option `+dataNilai[21]+` value="الثاني و العشرون">الثاني و العشرون</option>
                                                        <option `+dataNilai[22]+` value="الثالث و العشرون">الثالث و العشرون</option>
                                                        <option `+dataNilai[23]+` value="الرابع و العشرون">الرابع و العشرون</option>
                                                        <option `+dataNilai[24]+` value="الخامس و العشرون">الخامس و العشرون</option>
                                                        <option `+dataNilai[25]+` value="السادس و العشرون">السادس و العشرون</option>
                                                        <option `+dataNilai[26]+` value="السابع و العشرون">السابع و العشرون</option>
                                                        <option `+dataNilai[27]+` value="الثامن و العشرون">الثامن و العشرون</option>
                                                        <option `+dataNilai[28]+` value="التاسع و العشرون">التاسع و العشرون</option>
                                                        <option `+dataNilai[29]+` value="الثلاثون">الثلاثون</option>
                                                    </select>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="btnSaveNilai" data-id="`+element.id+`"><i class="fa fa-save"></i></a>
                                                </div>
                                                <span id="msg-`+element.id+`">`+nilai+`</span>
                                            </span>
                                            <span>
                                                <a href="<?= base_url()?>kelas/syahadah/`+element.link+`" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-award"></i></a>
                                            </span>
                                        </li>`;
                            });
                            
                            $("#list-peserta").html(html);
                            $("#btnPeserta").show();
                        } else {
                            $("#jumPeserta").html(0)
                            $("#list-peserta").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> List peserta kosong</div>`);
                            $("#btnPeserta").hide();
                        }
                    } else {
                        if(data.peserta){
                            $("#jumPeserta").html(data.peserta.length)
                            data.peserta.forEach((element, i) => {
                                if(data.status == "aktif") btnDelete = `<a href="javascript:void(0)" id="keluar_kelas" class="mr-1" data-id="`+element.id+`|`+element.nama+`|`+data.nama_kelas+`"><i class="fa fa-minus-circle text-danger"></i></a>`
                                else btnDelete = "";

                                if(element.nilai == "") nilai = `<small class="form-text text-danger">nilai belum diinputkan</small>`
                                else nilai = ``
                                
                                mumtaz = "";
                                jj = "";
                                jayyid = "";
                                maqbul = "";

                                if(element.nilai == "ممتاز"){ mumtaz = "selected" }else {mumtaz = ""}
                                if(element.nilai == "جيد جدا"){ jj = "selected" }else {jj = ""}
                                if(element.nilai == "جيد"){ jayyid = "selected" }else {jayyid = ""}
                                if(element.nilai == "مقبول"){ maqbul = "selected" }else {maqbul = ""}

                                html += `<li class="list-group-item d-flex justify-content-between">
                                            <span>
                                                `+btnDelete+`
                                                `+element.nama+`<br>
                                                <div class="form-inline mt-1">
                                                    <select name="nilai" id="nilai`+element.id+`" class="form-control form-control-sm mr-1">
                                                        <option value="">Nilai</option>
                                                        <option `+mumtaz+` value="ممتاز">ممتاز</option>
                                                        <option `+jj+` value="جيد جدا">جيد جدا</option>
                                                        <option `+jayyid+` value="جيد">جيد</option>
                                                        <option `+maqbul+` value="مقبول">مقبول</option>
                                                    </select>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="btnSaveNilai" data-id="`+element.id+`"><i class="fa fa-save"></i></a>
                                                </div>
                                                <span id="msg-`+element.id+`">`+nilai+`</span>
                                            </span>
                                            <span>
                                                <a href="<?= base_url()?>kelas/syahadah/`+element.link+`" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-award"></i></a>
                                            </span>
                                        </li>`;
                            });
                            

                            $("#list-peserta").html(html);
                            $("#btnPeserta").show();
                        } else {
                            $("#jumPeserta").html(0)
                            $("#list-peserta").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> List peserta kosong</div>`);
                            $("#btnPeserta").hide();
                        }
                    }

                    html = "";

                    if(data.wl){
                        $("#jumWlPeserta").html(data.wl.length)
                        data.wl.forEach((element, i) => {
                            if(data.status == "aktif") btnAdd = `<a href="javascript:void(0)" id="add_kelas_wl" data-id="`+element.id+`|`+element.nama+`|`+data.nama_kelas+`|`+data.id_kelas+`"><i class="fa fa-plus-circle text-success"></i></a>`
                            else btnAdd = "";
                            html += `<li class="list-group-item d-flex justify-content-between">
                                        <span>
                                            <a href="javascript:void(0)" id="delete_wl" class="mr-1" data-id="`+element.id+`|`+element.nama+`|`+data.program+`|`+data.id_kelas+`"><i class="fa fa-minus-circle text-danger"></i></a>
                                            `+element.nama+`
                                        </span>
                                        <span>
                                            `+btnAdd+`
                                        </span>
                                    </li>`;
                        });
                        
                        $("#list-wl-peserta").html(html);
                    } else {
                        $("#jumWlPeserta").html(0)
                        $("#list-wl-peserta").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> List peserta kosong</div>`);
                    }
                }
            })
        }
    // function 

    $("#list-peserta").on("click", "#btnSaveNilai", function(){
        let id = $(this).data("id");
        let nilai = $("#nilai"+id).val();

        $.ajax({
            url: "<?= base_url()?>kelas/add_nilai_sertifikat",
            method: "POST",
            dataType: "JSON",
            data: {id:id, nilai:nilai},
            success: function(result){
                delete_msg();
                // $("#msg-"+id).html(`<small class="form-text text-success msg-nilai">berhasil menginputkan nilai</small>`)
                if(result == 1){
                    $("#msg-"+id).html(`<small class="form-text text-success msg-nilai">berhasil menginputkan nilai</small>`)
                } else {
                    $("#msg-"+id).html(`<small class="form-text text-danger msg-nilai">nilai belum diinputkan</small>`)
                }
            }
        })
    })
    
</script>
