<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>
            <div class="">
                <?php if($konfirm == 1):?>
                    <a href="#modalAdd" data-toggle="modal" class="btn btn-success btn-sm mb-3 btnModal"><i class="fa fa-plus"></i> Tambah Peserta</a>
                <?php endif;?>
                <a onclick="reload_table()" data-toggle="modal" class="btn btn-sm btn-info mb-3 text-light"><i class="fa fa-sync"></i> Reload</a>
            </div>
            <div class="notification">
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="msgPeserta">
                    </div>
                </div>
            </div>
            <?php if($konfirm == 1):?>
                <div class="card shadow mb-4" style="max-width: 680px">
            <?php else:?>
                <div class="card shadow mb-4" style="max-width: 900px">
            <?php endif?>
                <div class="card-body">
                    <div id="reload">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <tr>
                                    <?php if($konfirm == 1):?>
                                        <th width="5%">No</th>
                                        <th width="12%">ID</th>
                                        <th width="">Nama</th>
                                        <th width="5%">Kelas</th>
                                        <th width=7%>Wl</th>
                                        <th width=7%>Detail</th>
                                        <th width="5%">Login</th>
                                    <?php else :?>
                                        <th width="5%">No</th>
                                        <th width="12%">ID</th>
                                        <th width="">Nama</th>
                                        <th width=11%>Follow Up</th>
                                        <th width=7%>Hapus</th>
                                        <th width=7%><center>Wl</center></th>
                                        <th width=7%>Detail</th>
                                        <th width="5%">Login</th>
                                        <th width=7%>konfirmasi</th>
                                        <th width=7%>Closing</th>
                                    <?php endif;?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal peserta -->
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
                                <a href="javascript:void(0)" class='nav-link active' id="btn-form-1"><i class="fas fa-user"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-2"><i class="fas fa-book"></i></a>
                            </li>
                            <?php if($konfirm == 1):?>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class='nav-link' id="btn-form-3">Tambah Kelas/WL</a>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                    <div class="card-body cus-font">
                        <div class="card" id="form-1">
                            <div class="card-header text-primary">
                                <strong>Data Diri</strong>
                            </div>
                            <div class="card-body">
                                <div class="msgEditPeserta"></div>
                                <form action="peserta/edit_peserta" method="post" id="formEditPeserta">
                                    <input type="hidden" name="id_user">
                                    <div class="form-group">
                                        <label for="tgl_masuk">Tgl Masuk</label>
                                        <input type="text" name="tgl_masuk" id="tgl_masuk_edit" class="form-control form-control-sm" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">ID Username</label>
                                        <input type="text" name="username" id="username_edit" class="form-control form-control-sm" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">No Handphone</label>
                                        <input type="text" name="no_hp" id="no_hp_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat_edit" class="form-control form-control-sm" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="t4_lahir">Tempat Lahir</label>
                                        <input type="text" name="t4_lahir" id="t4_lahir_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tgl Lahir</label>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" value="Ubah Data" class="btn btn-sm btn-success" id="btnEdit">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card" id="form-2">
                            <div class="card-header text-primary">
                                <strong>Data Akademik</strong>
                            </div>
                            <div class="card-body" id="modalEditKelas">
                                <form id="formKelasPeserta">
                                    <input type="hidden" name="id_user">
                                    <!-- <ul class="list-group mb-3">
                                        <li class="list-group-item list-group-item-primary"><strong>Data Login</strong></li>
                                        <div class="data-login"></div>
                                        <a href="" target="_blank" id="linkHref" class="btn btn-sm btn-success">Kirim Akun</a>
                                    </ul> -->
                                    <div class="msgWl"></div>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-warning"><strong>List Waiting List</strong></li>
                                        <div id="list-wl"></div>
                                    </ul>
                                    <div class="msgKelas"></div>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-success"><strong>List Kelas</strong></li>
                                        <div id="list-kelas"></div>
                                    </ul>
                                </form>
                            </div>
                        </div>

                        <div id="form-3">
                            <form id="formAddKelas">
                                <div class="msgAddKelas"></div>
                                <!-- <div class="alert alert-info"><i class="fa fa-info-circle text-info"></i> apabila kelas dikosongkan maka akan masuk waiting list</div> -->
                                <?php if($konfirm == 0):?>
                                    <div class="form-group">
                                        <label for="catatan_edit">Catatan</label>
                                        <textarea name="catatan_edit" id="catatan_edit" class="form-control form-control-sm" readonly></textarea>
                                    </div>
                                <?php endif;?>
                                <input type="hidden" name="id_user">
                                <div class="form-group">
                                    <label for="program_add">Program</label>
                                    <select name="program_add" id="program_add" class="form-control form-control-sm" required>
                                        <option value="">Pilih Program</option>
                                        <?php foreach ($program as $data) :?>
                                            <option value="<?= $data['program']?>"><?= $data['program']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="id_kelas" id="id_kelas_add" class="form-control form-control-sm">
                                        <option value="">Pilih Kelas</option>
                                        <?php foreach ($kelas as $data) :?>
                                            <option value="<?= $data['id_kelas']?>"><?= $data['nama_kelas']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <small id="emailHelp" class="form-text text-danger">*apabila kelas dikosongkan maka akan masuk waiting list</small>
                                </div>
                                <div class="form-group">
                                    <label for="biaya">Biaya</label>
                                    <input type="text" name="biaya" id="biaya_add_kelas" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_closing_add">Tgl Closing</label>
                                    <input type="date" name="tgl_closing_add" id="tgl_closing_add_kelas" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="sumber">Sumber Closing</label>
                                    <select name="sumber" id="sumber_add_kelas" class="form-control form-control-sm" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="lainnya">Sumber Closing Lainnya</label>
                                    <input type="text" name="sumber_lainnya" id="sumber_lainnya_add_kelas" class="form-control form-control-sm" disabled>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type='submit' value='Tambah Kelas/WL' class='btn btn-sm btn-primary mt-3' id='btnTambahKelas'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- modal peserta -->

<!-- modal add peserta -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle">Tambah Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add">
                <div class="msg-add-data"></div>
                <form action="" method="post" id="formAdd">
                    <div class="form-group">
                        <label for="tgl_masuk ">Tgl Masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk_add" class="form-control form-control-sm"  value="<?= date("Y-m-d");?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="t4_lahir">Tempat Lahir</label>
                        <input type="text" name="t4_lahir" id="t4_lahir_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tgl Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat_add" class="form-control form-control-sm" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Handphone</label>
                        <input type="text" name="no_hp" id="no_hp_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email_add" class="form-control form-control-sm">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Tambah Peserta" class="btn btn-sm btn-primary" id="btnmodalAdd">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add peserta -->


<!-- modal add closing -->
    <div class="modal fade" id="modalClosing" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalClosingTitle">Tambah Closing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add-closing">
                <div class="msg-add-data"></div>
                <form action="" method="post" id="formAddClosing">
                    <input type="hidden" name="id_peserta_closing" id="id_peserta_closing">
                    <div class="form-group">
                        <label for="">Data Kelas Yang Diambil</label>
                        <div class="row checkbox-group required">
                            <!-- <div class="col-6">
                                <input type="checkbox" class="mr-1" name="program[]" id="<?= $data['id_program']?>" value="<?= $data['program']?>"><label for="<?= $data['id_program']?>"><?= $data['program']?></label>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_peserta">Nama</label>
                        <input type="text" name="nama_peserta" id="nama_peserta_add" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tgl_closing">Tgl Closing</label>
                        <input type="date" name="tgl_closing" id="tgl_closing_add" class="form-control form-control-sm"  value="<?= date("Y-m-d");?>" required>
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya</label>
                        <input type="text" name="biaya" id="biaya_add" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="sumber">Sumber Closing</label>
                        <select name="sumber" id="sumber_add" class="form-control form-control-sm" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lainnya">Sumber Closing Lainnya</label>
                        <input type="text" name="sumber_lainnya" id="sumber_lainnya_add" class="form-control form-control-sm" disabled>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Tambah Closing" class="btn btn-sm btn-primary" id="btnmodalAddClosing">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add closing -->

<script>
    $("#<?= $sidebar?>").addClass("active");
     
    $(".btnModal").click(function(){
        delete_msg();
    })
                                    
    table = $('#dataTable').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url()?>peserta/ajax_list/<?= $konfirm?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            <?php if($konfirm == 1):?>
                "targets": [0, 3, 4, 5, 6], //first column / numbering column
            <?php else :?>
                "targets": [0, 3, 4, 5, 6, 7, 8], //first column / numbering column
            <?php endif ;?>
            "orderable": false, //set not orderable
        },
        ],
    });

    $("#formAdd").submit(function(){
        if(confirm("Yakin akan menambahkan peserta baru?")){
            var tgl_masuk = $("#tgl_masuk_add").val();
            var nama = $("#nama_add").val();
            var t4_lahir = $("#t4_lahir_add").val();
            var tgl_lahir = $("#tgl_lahir_add").val();
            var alamat = $("#alamat_add").val();
            var no_hp = $("#no_hp_add").val();
            var email = $("#email_add").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/add_peserta",
                dataType : "JSON",
                data : {tgl_masuk : tgl_masuk,nama : nama,t4_lahir : t4_lahir,tgl_lahir : tgl_lahir,alamat : alamat,no_hp : no_hp,email : email},
                success : function(data){
                    $("#formAdd").trigger("reset");
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan peserta baru<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msg-add-data').html(msg);
                    $("#modal-add").scrollTop(0);
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    var msg = `
                        <span class="fas icon-msg fa-times-circle"></span>
                        <span class="msg">Gagal menambahkan kelas baru</span>
                        <span class="close-msg">
                            <span class="fas fa-times"></span>
                        </span>`;
                    $('.notification').html(msg);
                    $('.notification').addClass("show");
                    $('.notification').addClass("danger");
                    $('.notification').removeClass("hide");
                    $('.notification').addClass("showAlert");
                    setTimeout(function(){
                        $('.notification').removeClass("show");
                        $('.notification').addClass("hide");
                    },5000);
                }
            })
        }
        return false;
    })
    
    $("#formEditPeserta").submit(function(){
        if(confirm("Yakin akan merubah data peserta?")){
            var id = $("input[name='id_user']").val()
            var nama = $("#nama_edit").val();
            var t4_lahir = $("#t4_lahir_edit").val();
            var tgl_lahir = $("#tgl_lahir_edit").val();
            var alamat = $("#alamat_edit").val();
            var no_hp = $("#no_hp_edit").val();
            var email = $("#email_edit").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/edit_peserta",
                dataType : "JSON",
                data : {id_user : id,nama : nama,t4_lahir : t4_lahir,tgl_lahir : tgl_lahir,alamat : alamat,no_hp : no_hp,email : email},
                success : function(data){
                    // $("#modalEditTitle").html(nama)
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah data peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgEditPeserta').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    var msg = `
                        <span class="fas icon-msg fa-times-circle"></span>
                        <span class="msg">Gagal menambahkan kelas baru</span>
                        <span class="close-msg">
                            <span class="fas fa-times"></span>
                        </span>`;
                    $('.notification').html(msg);
                    $('.notification').addClass("show");
                    $('.notification').addClass("danger");
                    $('.notification').removeClass("hide");
                    $('.notification').addClass("showAlert");
                    setTimeout(function(){
                        $('.notification').removeClass("show");
                        $('.notification').addClass("hide");
                    },5000);
                }
            })
        }
        return false;
    })
    
    $("#formAddKelas").submit(function(){
        if(confirm("Yakin akan menambahkan kelas peserta ini?")){
            var id = $("input[name='id_user']").val()
            var id_kelas = $("#id_kelas_add").val();
            var program = $("#program_add").val();
            var sumber = $("#sumber_add_kelas").val();
            var sumber_lainnya = $("#sumber_lainnya_add_kelas").val();
            var tgl_closing = $("#tgl_closing_add_kelas").val();
            var biaya = $("#biaya_add_kelas").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/add_kelas",
                dataType : "JSON",
                data : {id_kelas:id_kelas, id_user:id, program:program, sumber:sumber, sumber_lainnya:sumber_lainnya, tgl_closing:tgl_closing, biaya:biaya},
                success : function(data){
                    if(data == 1){
                        var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    } else {
                        var msg = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan kelas/waiting list peserta, karena peserta telah bergabung di kelas/waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    }
                    $('.msgAddKelas').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    btn_3();
                    reload_table();
                    
                    $("#formAddKelas").trigger("reset");
                    $("#sumber_lainnya_add_kelas").prop("disabled", true);
                    $("#sumber_lainnya_add_kelas").prop("required", false);
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
    
    $("#dataTable").on("click", ".konfirmasi", function(){
        let data = $(this).data("id");
        data = data.split("|");
        nama = data[1]
        if(confirm("yakin akan mengkonfirmasi peserta atas nama "+nama+"?")){
            const id = data[0]
            $.ajax({
                url: "<?= base_url()?>/peserta/konfirmasi",
                method: "POST",
                dataType: "JSON",
                data: {id_user: id},
                success: function(data){
                    reload_table();
                    $(".msgPeserta").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle text-success mr-1"></i> berhasil mengkonfirmasi peserta
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`)
                }
            })
        }
    })
    
    $("#dataTable").on("click", ".peserta", function(){
        const id = $(this).data('id');
        detail(id)
        btn_2();
        delete_msg();
    })

    $("#formAddClosing").submit(function(){
        if(confirm("Yakin akan menambahkan closing?")){
            if (!$('input:radio', this).is(':checked')) {
                alert('Pilih program terlebih dahulu');
                return false;
            }
            var id_user = $("#id_peserta_closing").val();
            var tgl_closing = $("#tgl_closing_add").val();
            var program = $("input[name='program_add']").val();
            var biaya = $("#biaya_add").val();
            var sumber = $("#sumber_add").val();
            var sumber_lainnya = $("#sumber_lainnya_add").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>closing/add_closing_konfirm",
                dataType : "JSON",
                data : {id_user: id_user, tgl_closing:tgl_closing, sumber:sumber, sumber_lainnya:sumber_lainnya, program:program, biaya:biaya},
                success : function(data){
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan data closing<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgPeserta').html(msg);
                    reload_table();
                    $("#modalClosing").modal("hide")
                    $("#formAddClosing").trigger("reset");
                    $("#sumber_lainnya_add").prop("disabled", true);
                    $("#sumber_lainnya_add").prop("required", false);
                }, error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            })
        }
        return false;
    })

    // closing peserta
        // program closing
        let program_closing = [];

        $(".checkbox-group").on("change", "input[type='checkbox']", function(){
            let program = $(this).val();
            // console.log(program)
            if(this.checked){
                program_closing.push(program)
            } else {
                program_closing = program_closing.filter(function(item) {
                    return item !== program
                })
            }
            // console.log(program_closing)
        })

        $("#dataTable").on("click", ".closing", function(){
            program_closing = [];
            html = "";

            let id_user = $(this).data("id");
            data = detail_peserta(id_user);
            option = option_modal();
            // console.log(data)
            // console.log(option)
            $("#id_peserta_closing").val(data.id_user);
            $("#nama_peserta_add").val(data.nama);
            data.wl.forEach(wl => {
                if(wl.closing == 0)
                html += `<div class="col-6"><input type="radio" class="mr-1" name="program_add" id="`+wl.id+`" value="`+wl.id+`"><label for="`+wl.id+`">`+wl.program+`</label></div>`;
            });

            $(".checkbox-group").html(html)

            html = "";

            html += `<option value="">Pilih Sumber Closing</option>`
            option.sumber.forEach(sumber => {
                html += `<option value="`+sumber.sumber+`">`+sumber.sumber+`</option>`;
            });
            html += `<option value="Lainnya">Lainnya</option>`

            $("#sumber_add").html(html);
            // $(".checkbox-group").html(html)
        })
    // closing peserta

    $("#sumber_add").change(function(){
        let sumber = $(this).val();
        if(sumber == "Lainnya"){
            $("#sumber_lainnya_add").prop("disabled", false);
            $("#sumber_lainnya_add").prop("required", true);
        } else {
            $("#sumber_lainnya_add").val("");
            $("#sumber_lainnya_add").prop("disabled", true);
            $("#sumber_lainnya_add").prop("required", false);
        }
    })

    $("#sumber_add_kelas").change(function(){
        let sumber = $(this).val();
        if(sumber == "Lainnya"){
            $("#sumber_lainnya_add_kelas").prop("disabled", false);
            $("#sumber_lainnya_add_kelas").prop("required", true);
        } else {
            $("#sumber_lainnya_add_kelas").val("");
            $("#sumber_lainnya_add_kelas").prop("disabled", true);
            $("#sumber_lainnya_add_kelas").prop("required", false);
        }
    })

    function option_modal(option = ""){
        var result = "";
        $.ajax({
            // option nama dan option sumber 
            url: "<?= base_url()?>closing/get_option_add_modal",
            method: "GET",
            dataType: "JSON",
            async: false, 
            success: function(data){
                result = data;
            }
        })

        return result;
    }

    function detail_peserta(id){
        var result = "";
        $.ajax({
            url : "<?=base_url()?>peserta/get_detail_peserta",
            method : "POST",
            data : {id : id},
            dataType : 'json',
            async: false,  
            success : function(data){
                result = data;
            }
        })

        return result;
    }

    // delete peserta 
        $("#dataTable").on("click", ".delete_peserta", function(){
            let data = $(this).data("id");
            data = data.split("|")
            let id = data[0];
            let nama = data[1];
            if(confirm("Yakin akan menghapus peserta atas nama "+nama+"?")){
                $.ajax({
                    url: "<?= base_url()?>peserta/delete_peserta",
                    type: "POST",
                    data: {id: id},
                    dataType: "JSON",
                    success: function(data){
                        reload_table();
                        $(".msgPeserta").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle text-success mr-1"></i> berhasil menghapus peserta
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                    }
                })
            }
        })
    // delete peserta 

    // btn buat id 
        $("#dataTable").on("click", "#btnAddId", function(){
            let data = $(this).data("id");
            data = data.split("|");
            let nama = data[1];
            let id = data[0];
            if(confirm("Yakin akan membuat id peserta "+nama+"?")){
                $.ajax({
                    url: "<?= base_url()?>peserta/buat_id",
                    method: "POST",
                    dataType: "JSON",
                    data: {id: id},
                    success: function(data){
                        reload_table();
                        $(".msgPeserta").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle text-success mr-1"></i> berhasil membuat id peserta
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                    }
                })
            }
        })
    // btn buat id 

    // hapus wl 
        $("#list-wl").on("click", "#delete_wl", function(){
            if(confirm("Yakin akan menghapus waiting list?")){
                delete_msg()
                let id = $(this).data("id");
                $.ajax({
                    url: "<?= base_url()?>peserta/delete_wl",
                    dataType: "JSON",
                    data: {id: id},
                    method: "POST",
                    success: function(data){
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgWl').html(msg);
                        $("#modalDetail").scrollTop(0);
                        detail(data);
                        btn_2();
                        reload_table();
                    }
                })
            }
        })
    // hapus wl 
    
    // hapus kelas
        $("#list-kelas").on("click", "#delete_wl", function(){
            if(confirm("Yakin akan menghapus kelas ini?")){
                delete_msg()
                let id = $(this).data("id");
                $.ajax({
                    url: "<?= base_url()?>peserta/delete_wl",
                    dataType: "JSON",
                    data: {id: id},
                    method: "POST",
                    success: function(data){
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgKelas').html(msg);
                        $("#modalDetail").scrollTop(0);
                        detail(data);
                        btn_2();
                        reload_table();
                    }
                })
            }
        })
    // hapus kelas

    $("#dataTable").on("click", '#followUp1', function(){
        let data = $(this).data('id');
        data = data.split("|");
        let id = data[0];
        let nama = data[1];
        let url = data[2];
        let followup = data[3];

        if(confirm("Kirim follow up pertama ke "+nama+"?")){
            $.ajax({
                url: "<?= base_url()?>peserta/add_followup",
                dataType: "JSON",
                type: "POST",
                data: {id: id, followup: followup},
                success: function(data){
                    reload_table();
                    window.open(url, '_blank');
                }
            })
        }
        return false
    })

    $("#dataTable").on("click", '#followUp2', function(){
        let data = $(this).data('id');
        data = data.split("|");
        let id = data[0];
        let nama = data[1];
        let url = data[2];
        let followup = data[3];

        if(confirm("Kirim follow up kedua ke "+nama+"?")){
            $.ajax({
                url: "<?= base_url()?>peserta/add_followup",
                dataType: "JSON",
                type: "POST",
                data: {id: id, followup: followup},
                success: function(data){
                    reload_table();
                    window.open(url, '_blank');
                }
            })
        }
        return false
    })
    
    $("#dataTable").on("click", '#dataLogin', function(){
        let data = $(this).data('id');
        data = data.split("|");
        let id = data[0];
        let nama = data[1];
        let url = data[2];

        if(confirm("Kirim data login kepada "+nama+"?")){
            $.ajax({
                url: "<?= base_url()?>peserta/send_login",
                dataType: "JSON",
                type: "POST",
                data: {id: id},
                success: function(data){
                    reload_table();
                    window.open(url, '_blank');
                }
            })
        }
        return false
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
        
        function detail(id){
            $.ajax({
                url : "<?=base_url()?>peserta/get_detail_peserta",
                method : "POST",
                data : {id : id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#modalEditTitle").html(data.nama)
                    $("#tgl_masuk_edit").val(data.tgl_masuk)
                    $("#alamat_edit").val(data.alamat)
                    $("#t4_lahir_edit").val(data.t4_lahir)
                    $("#tgl_lahir_edit").val(data.tgl_lahir)
                    $("#email_edit").val(data.email)
                    $("#username_edit").val(data.username)
                    $("#nama_edit").val(data.nama)
                    $("#no_hp_edit").val(data.no_hp)
                    $("#tgl_masuk_edit").val(data.tgl_masuk)
                    $("#catatan_edit").val(data.catatan)
                    $("input[name='id_user']").val(data.id_user)
                    // $("#link").html(data.link)
                    $("a#linkHref").attr("href", data.link);
                    html = "";

                    if(data.username == ""){
                        $(".data-login").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> data login tidak ada, buat id peserta terlebih dahulu</div>`);
                        $("#linkHref").hide();
                    } else {
                        $(".data-login").html("");
                        $("#linkHref").show();
                    }

                    if(data.user){
                        array = data.user;
                        array.forEach((user, i) => {
                            if(user.kelas.status == "aktif") btnDelete = `<a href="javascript:void(0)" id="delete_wl" data-id="`+user.id+`" class="btn btn-sm btn-outline-danger">hapus</a>`
                            else btnDelete = ''
                            
                            if(user.nilai == "") nilai = `<small class="form-text text-danger">nilai belum diinputkan</small>`
                            else nilai = ``

                            mumtaz = "";
                            jj = "";
                            jayyid = "";
                            maqbul = "";

                            if(user.nilai == "ممتاز"){ mumtaz = "selected" }else {mumtaz = ""}
                            if(user.nilai == "جيد جدا"){ jj = "selected" }else {jj = ""}
                            if(user.nilai == "جيد"){ jayyid = "selected" }else {jayyid = ""}
                            if(user.nilai == "مقبول"){ maqbul = "selected" }else {maqbul = ""}

                            html += `<li class="list-group-item d-flex justify-content-between">
                                <span>
                                    `+user.kelas.nama_kelas+`<br>
                                
                                    <div class="form-inline mt-1">
                                        <select name="nilai" id="nilai`+user.id+`" class="form-control form-control-sm mr-1">
                                            <option value="">Nilai</option>
                                            <option `+mumtaz+` value="ممتاز">ممتاز</option>
                                            <option `+jj+` value="جيد جدا">جيد جدا</option>
                                            <option `+jayyid+` value="جيد">جيد</option>
                                            <option `+maqbul+` value="مقبول">مقبول</option>
                                        </select>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary mr-1" id="btnSaveNilai" data-id="`+user.id+`"><i class="fa fa-save"></i></a>
                                        <a href="<?= base_url()?>kelas/syahadah/`+user.link+`" target="_blank" class="btn btn-sm btn-warning mr-1"><i class="fa fa-award"></i></a>
                                    </div>
                                    <span id="msg-`+user.id+`">`+nilai+`</span>
                                
                                </span>
                                <span>
                                    `+btnDelete+`
                                </span>
                            </li>`;
                        });
                        $("#list-kelas").html(html);
                        $("#btnHapus").show();
                    } else {
                        $("#list-kelas").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> List kelas kosong</div>`);
                        $("#btnHapus").hide();
                    }
                    
                    html = "";
                    
                    if(data.wl){
                        array = data.wl;
                        array.forEach((user, i) => {
                            html += `<li class="list-group-item d-flex justify-content-between">
                                <span>`+user.program+`</span>
                                <span>
                                    <a href="javascript:void(0)" id="delete_wl" data-id="`+user.id+`"><i class="fa fa-minus-circle text-danger"></i></a>
                                </span>
                            </li>`;
                        });
                        $("#list-wl").html(html);
                        $("#list-wl").addClass("mb-3");
                    } else {
                        $("#list-wl").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> Waiting List kosong</div>`);
                        $("#list-wl").removeClass("mb-3");
                    }       

                    option = option_modal();
                    html = `<option value="">Pilih Sumber Closing</option>`
                    option.sumber.forEach(sumber => {
                        html += `<option value="`+sumber.sumber+`">`+sumber.sumber+`</option>`;
                    });
                    html += `<option value="Lainnya">Lainnya</option>`

                    $("#sumber_add_kelas").html(html);             
                }
            })
        }
        
        $("#list-kelas").on("click", "#btnSaveNilai", function(){
            let id = $(this).data("id");
            let nilai = $("#nilai"+id).val();

            $.ajax({
                url: "<?= base_url()?>kelas/add_nilai_sertifikat",
                method: "POST",
                dataType: "JSON",
                data: {id:id, nilai:nilai},
                success: function(result){
                    delete_msg();
                    $("#msg-"+id).html(`<small class="form-text text-success msg-nilai">berhasil menginputkan nilai</small>`)
                }
            })
        })

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
            $("#program_add").val("");
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").addClass('active');
            
            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").show();
        }

        function delete_msg(){
            $(".msgWl").html("");
            $(".msgKelas").html("");
            $(".msgAddKelas").html("");
            $('.msgEditPeserta').html("");
            $('.msgEditKelas').html("");
            $('.msg-add-data').html("");
            $('.msgPeserta').html("");
            $('.msg-nilai').html("");
        }
    // function 

    $("input[name=biaya]").keyup(function(){
        $(this).val(formatRupiah(this.value, 'Rp. '))
    })
</script>