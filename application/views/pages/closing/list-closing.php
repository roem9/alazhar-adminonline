<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>
            <div class="">
                <!-- <a href="#modalAdd" data-toggle="modal" class="btn btn-primary btn-sm mb-3" id="btnModalAdd"><i class="fa fa-plus"></i> Tambah Closing</a> -->
                <a href="#modalPrint" data-toggle="modal" class="btn btn-success btn-sm mb-3"><i class="fa fa-print"></i> Print</a>
                <a onclick="reload_table()" data-toggle="modal" class="btn btn-sm btn-info mb-3 text-light"><i class="fa fa-sync"></i> Reload</a>
            </div>
            <div class="notification">
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="msg-closing">
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4" style="max-width: 1100px">
                <div class="card-body">
                    <div id="reload">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <tr>
                                    <th width="5%"><center>No</center></th>
                                    <th width="10%">Tgl Closing</th>
                                    <th width="">Nama</th>
                                    <th width="15%">Program</th>
                                    <th width=10%>WA</th>
                                    <th width=10%>Biaya</th>
                                    <th>Closing</th>
                                    <th width=5%>Detail</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal add closing -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle">Tambah Closing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add">
                <div class="msg-add-data"></div>
                <form id="formAdd">
                    <div class="form-group">
                        <label for="tgl_closing ">Tgl Closing</label>
                        <input type="date" name="tgl_closing" id="tgl_closing_add" class="form-control form-control-sm"  value="<?= date("Y-m-d");?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <select name="nama" id="nama_add" class="form-control form-control-sm" required>
                        </select>
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
                        <label for="no_wa">No WA</label>
                        <input type="text" name="no_wa" id="no_wa_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya</label>
                        <input type="text" name="biaya" id="biaya_add" class="form-control form-control-sm" required>
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
                        <label for="sumber">Sumber Closing</label>
                        <select name="sumber" id="sumber_add" class="form-control form-control-sm" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lainnya">Sumber Closing Lainnya</label>
                        <input type="text" name="sumber_lainnya" id="sumber_lainnya_add" class="form-control form-control-sm" disabled>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Tambah Closing" class="btn btn-sm btn-primary" id="btnmodalAdd">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add closing -->


<!-- modal edit closing -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle">Edit Closing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-edit">
                <div class="msg-edit-data"></div>
                <form id="formEdit">
                    <input type="hidden" name="id_closing" id="id_closing_edit">
                    <div class="form-group">
                        <label for="tgl_closing ">Tgl Closing</label>
                        <input type="date" name="tgl_closing" id="tgl_closing_edit" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama_edit" class="form-control form-control-sm" readonly>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="t4_lahir">Tempat Lahir</label>
                        <input type="text" name="t4_lahir" id="t4_lahir_edit" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tgl Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir_edit" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat_edit" class="form-control form-control-sm" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_wa">No WA</label>
                        <input type="text" name="no_wa" id="no_wa_edit" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <input type="text" name="program" id="program_edit" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya</label>
                        <input type="text" name="biaya" id="biaya_edit" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="sumber">Sumber Closing</label>
                        <select name="sumber" id="sumber_edit" class="form-control form-control-sm" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lainnya">Sumber Closing Lainnya</label>
                        <input type="text" name="sumber_lainnya" id="sumber_lainnya_edit" class="form-control form-control-sm" disabled>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-outline-danger mr-1" id="btnmodalHapus">Hapus</button>
                        <input type="submit" value="Edit Closing" class="btn btn-sm btn-success" id="btnModalEdit">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal edit closing -->

<!-- modal print -->
    <div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPrintTitle">Print Data Closing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add">
                <form action="<?= base_url()?>closing/cetak_laporan_closing" method="post">
                    <div class="form-group">
                        <label for="tgl_awal">Tgl Awal</label>
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_akhir">Tgl Akhir</label>
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Print Data Closing" class="btn btn-sm btn-primary" id="btnmodalPrint">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal print -->

<script>
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
    
    $("#sumber_edit").change(function(){
        let sumber = $(this).val();
        if(sumber == "Lainnya"){
            $("#sumber_lainnya_edit").prop("disabled", false);
            $("#sumber_lainnya_edit").prop("required", true);
        } else {
            $("#sumber_lainnya_edit").val("");
            $("#sumber_lainnya_edit").prop("disabled", true);
            $("#sumber_lainnya_edit").prop("required", false);
        }
    })

    $("#nama_add").change(function(){
        let data = $(this).val()
        data = data.split("|");
        let id_user = data[0];

        $.ajax({
            url: "<?= base_url()?>closing/get_peserta",
            dataType: "JSON",
            method: "POST",
            data: {id_user:id_user},
            success: function(result){
                $("#t4_lahir_add").val(result.t4_lahir);
                $("#tgl_lahir_add").val(result.tgl_lahir);
                $("#alamat_add").val(result.alamat);
                $("#no_wa_add").val(result.no_hp);
            }
        })
    })

    $("#dataTable").on("click", "#btnDetail", function(){
        delete_msg()
        $("#sumber_lainnya_edit").prop("disabled", true);
        $("#sumber_lainnya_edit").prop("required", false);
        let id = $(this).data("id")
        $.ajax({
            url: "<?= base_url()?>closing/get_closing",
            method: "POST",
            dataType: "JSON",
            data: {id:id},
            success: function(data){
                $("#id_closing_edit").val(data.id)
                $("#tgl_closing_edit").val(data.tgl_closing);
                $("#nama_edit").val(data.nama);
                $("#t4_lahir_edit").val(data.t4_lahir);
                $("#tgl_lahir_edit").val(data.tgl_lahir);
                $("#alamat_edit").val(data.alamat);
                $("#no_wa_edit").val(data.no_wa);
                $("#biaya_edit").val(formatRupiah(data.biaya, "Rp"));
                $("#program_edit").val(data.program);
                option_modal(data.sumber);
                // $("#sumber_edit").val(data.sumber);
            }
        })
    })

    $("#formAdd").submit(function(){
        if(confirm("Yakin akan menambahkan closing baru?")){
            var tgl_closing = $("#tgl_closing_add").val();
            var data = $("#nama_add").val();
            data = data.split("|");
            let id_user = data[0];
            let nama = data[1];
            var t4_lahir = $("#t4_lahir_add").val();
            var tgl_lahir = $("#tgl_lahir_add").val();
            var alamat = $("#alamat_add").val();
            var no_wa = $("#no_wa_add").val();
            var program = $("#program_add").val();
            var biaya = $("#biaya_add").val();
            var sumber = $("#sumber_add").val();
            var sumber_lainnya = $("#sumber_lainnya_add").val();
            $.ajax({
                method : "POST",
                url : "<?= base_url()?>closing/add_closing",
                dataType : "JSON",
                data : {id_user:id_user,tgl_closing:tgl_closing,nama:nama,t4_lahir:t4_lahir,tgl_lahir:tgl_lahir,alamat:alamat,no_wa:no_wa,sumber:sumber,sumber_lainnya:sumber_lainnya,program:program,biaya:biaya},
                success : function(data){
                    console.log(data)
                    $("#formAdd").trigger("reset");
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan data closing<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msg-add-data').html(msg);
                    $("#modal-add").scrollTop(0);
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown)
                }
            })
        }
        return false;
    })

    $("#formEdit").submit(function(){
        if(confirm("Yakin akan mengubah data closing?")){
            var id = $("#id_closing_edit").val();
            var tgl_closing = $("#tgl_closing_edit").val();
            var program = $("#program_edit").val();
            var biaya = $("#biaya_edit").val();
            var sumber = $("#sumber_edit").val();
            var sumber_lainnya = $("#sumber_lainnya_edit").val();
            $.ajax({
                method : "POST",
                url : "<?= base_url()?>closing/edit_closing",
                dataType : "JSON",
                data : {id:id,tgl_closing:tgl_closing,sumber:sumber,sumber_lainnya:sumber_lainnya,program:program,biaya:biaya},
                success : function(data){
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah data closing<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msg-closing').html(msg);
                    $("#formEdit").trigger("reset");
                    $("#modalEdit").modal("hide");
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown)
                }
            })
        }
        return false;
    })

    $("#btnmodalHapus").click(function(){
        let id = $('#id_closing_edit').val()
        if(confirm("Yakin akan menghapus data closing ini?")){
            $.ajax({
                url: "<?= base_url()?>closing/delete_closing",
                type: "POST",
                data: {id: id},
                dataType: "JSON",
                success: function(data){
                    reload_table();
                    $(".msg-closing").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle text-success mr-1"></i> berhasil menghapus data closing
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`)
                    $("#modalEdit").modal('hide');
                }
            })
        }
    })

    $("#<?= $sidebar?>").addClass("active");
                             
    table = $('#dataTable').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url()?>closing/get_all_closing",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0, 4, 5, 7], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });

    // function 
        function reload_table(){
            table.ajax.reload(null,false); //reload datatable ajax 
        }
    // function 

    $("#btnModalAdd").click(function(){
        delete_msg();
        $("#sumber_lainnya_add").prop("disabled", true);
        $("#sumber_lainnya_add").prop("required", false);
        option_modal();
    })
    
    function option_modal(option = ""){
        $.ajax({
            // option nama dan option sumber 
            url: "<?= base_url()?>closing/get_option_add_modal",
            method: "GET",
            dataType: "JSON",
            success: function(data){
                console.log(data)
                html = "";
                html += `<option value="">Pilih Peserta</option>`
                if(data.peserta){
                    data.peserta.forEach(peserta => {
                        html += `<option value="`+peserta.id_user+`|`+peserta.nama+`">`+peserta.nama+`</option>`;
                    });
                }
                $("#nama_add").html(html);
                
                html = "";
                html += `<option value="">Pilih Sumber Closing</option>`
                if(data.sumber){
                    data.sumber.forEach(sumber => {
                        if(option == sumber.sumber){
                            html += `<option value="`+sumber.sumber+`" selected>`+sumber.sumber+`</option>`;
                        } else {
                            html += `<option value="`+sumber.sumber+`">`+sumber.sumber+`</option>`;
                        }
                    });
                }
                html += `<option value="Lainnya">Lainnya</option>`
                $("#sumber_add").html(html);
                $("#sumber_edit").html(html);
            }

        })
    }

    $("input[name=biaya]").keyup(function(){
        $(this).val(formatRupiah(this.value, 'Rp. '))
    })

    function delete_msg(){
        $(".msg-closing").html("")
        $(".msg-add-data").html("")
        $(".msg-edit-data").html("")
        $(".msg-add-data").html("")
    }
</script>