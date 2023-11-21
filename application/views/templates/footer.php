<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="<?= base_url('Billing');?>">SemerusmartReborn</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.1.1.simrswaled
    </div>
</footer>
</div>
<!-- ./wrapper -->
<form action="<?= base_url('ExpertisiPA/simpanEX');?>" method="post">
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Isi Expertisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-expert">
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal -->
<form action="<?= base_url('ExpertisiPA/simpanEX');?>" method="post">
    <div class="modal fade" id="modalEditExpert" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">edit Expertisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-editexpert">
                </div>
            </div>
        </div>
    </div>
</form>
<form action="<?= base_url('Billing/returLayanan');?>" method="post">
    <div class="modal fade" id="modalRetur" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">retur layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-retur">
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="modaldetailexpa" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail expertisi PA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-detailexpa">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetailBilling" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail billing / layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-detailbilling">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaldetailreturdarah" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pemakian Darah akan diretur ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-detailreturdarah">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaldetailretur" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Masukan jumlah layanan yang diretur !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-detailretur">
            </div>
        </div>
    </div>
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url('assets/js/jquery-3.5.1.js');?>"></script>
<script src="<?= base_url('assets/js/popper.min.js');?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?= base_url('assets/js/jquery-ui.js');?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?= base_url('assets/js/dataTables.responsive.min.js');?>"></script>
<script src="<?= base_url('assets/js/responsive.bootstrap4.min.js');?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js');?>"></script>
<script src="<?= base_url('assets/js/vfs_fonts.js');?>"></script>
<script src="<?= base_url('assets/js/jszip.min.js');?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js');?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js');?>"></script>

<!-- <script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js');?>"></script> -->

<!-- Bootstrap -->
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.js');?>"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css');?>">
<script src="<?= base_url('assets/adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js');?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/raphael/raphael.min.js');?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jquery-mapael/jquery.mapael.min.js');?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jquery-mapael/maps/usa_states.min.js');?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/adminlte/plugins/chart.js/Chart.min.js');?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datetimepicker.js');?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datetimepicker.min.js');?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.js');?>"></script>

<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="<?= base_url('assets/js/sweetalert2.min.js');?>"></script>
<script>
//javascript untuk controller billing
$(document).ready(function() {
    $(".preloader").fadeOut();
})
</script>
<script>
$(function() {
    $(".datepicker").datepicker({
        autoclose: true,
        todayHighlight: true
    }).datepicker('update', new Date());
});
$(document).ready(function() {
    $("#unit_daftar").autocomplete({
        source: "<?php echo site_url('C_js/get_autocomplete_unit/?');?>",
        select: function(event, ui) {
            $("#kode_unit_daftar").val(ui.item.kd_unit);
        }
    });
});
alertmsg = $("#alert").val()

$(document).ready(function() {
    $("#get_nama_paramedis").autocomplete({
        source: "<?php echo site_url('C_js/get_autocomplete_dokter/?');?>",
        select: function(event, ui) {
            $("#get_Dokter").val(ui.item.kd_paramedis);
        }
    });
});

function cariPasien() {
    $('#spinner').removeAttr('Hidden');
    jenis_layanan = $('#jenisLayanan:checked').val();
    nomor_rm = $('#nomor_rm').val();
    nama_pasien = $('#nama_pasien').val();
    alamat = $('#alamat').val();
    tanggal_cari = $('#tanggal_cari').val();
    kode_unit_daftar = $('#kode_unit_daftar').val();
    if (nomor_rm == '') {
        swal({
            icon: 'error',
            title: 'Isi nomor RM !',
        })
    } else if (jenis_layanan == 1) {
        if (kode_unit_daftar == '') {
            swal({
                icon: 'error',
                title: 'Pilih unit !',
            })
        } else {
            $.ajax({
                type: 'post',
                url: '<?= base_url('C_js/tabelPasien'); ?>',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data: {
                    jenis_layanan: jenis_layanan,
                    nomor_rm: nomor_rm,
                    nama_pasien: nama_pasien,
                    alamat: alamat,
                    kode_unit_daftar: kode_unit_daftar,
                    tanggal_cari: tanggal_cari
                },
                /* memanggil fungsi getDetail dan mengirimkannya */
                error: function(data) {
                    swal({
                        icon: 'error',
                        title: 'Sepertinya telah terjadi kesalahan !',
                    })
                },
                success: function(response) {
                    $('#tabelPasien').html(response);
                    $('#tbpx').DataTable();
                    /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
        }
    } else {
        $.ajax({
            type: 'post',
            url: '<?= base_url('C_js/tabelPasien'); ?>',
            /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
            data: {
                jenis_layanan: jenis_layanan,
                nomor_rm: nomor_rm,
                nama_pasien: nama_pasien,
                alamat: alamat,
                kode_unit_daftar: kode_unit_daftar,
                tanggal_cari: tanggal_cari
            },
            /* memanggil fungsi getDetail dan mengirimkannya */
            error: function(data) {
                swal({
                    icon: 'error',
                    title: 'Sepertinya telah terjadi kesalahan !',
                })
            },
            success: function(response) {
                $('#tabelPasien').html(response);
                $('#tbpx').DataTable();
                /* menampilkan data dalam bentuk dokumen HTML */
            }
        });
    }
}

function cariLayanan() {
    layanan = $('#inputLayanan').val();
    if (layanan == '') {
        swal({
            icon: 'error',
            title: 'nama layanan tidak boleh kosong !',
        })
    } else {
        kelas_tarif = $('#get_KELAS_UNIT').val();
        $.ajax({
            type: 'post',
            url: '<?= base_url('C_js/cariLayanan'); ?>',
            /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
            data: {
                layanan: layanan,
                kelas_tarif: kelas_tarif
            },
            /* memanggil fungsi getDetail dan mengirimkannya */
            success: function(response) {
                $('#tabelLayanan').html(response);
                $('#tbly').DataTable();
                /* menampilkan data dalam bentuk dokumen HTML */
            }
        });
    }
}
$(document).ready(function() {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div><input type="text" name="mytext[]" class="form-control col-md-8"/><a href="#" class="remove_field">Remove</a></div>'
            ); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
$(document).ready(function() {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".addDarah"); //Fields wrapper
    var add_button = $(".tambahdarah"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div><input required type="text" name="nomorKantong[]" class="form-control col-md-8 mt-2" placeholder="Nomor kantong darah"><a href="#" class="badge remove_field badge-danger">Hapus</a></div>'
            ); //add input box
            $('#jlh_kantong_darah').val(1);
        }
    });

    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        if (x == 1) {
            $('#jlh_kantong_darah').val(0);
        }
    })
});
$(document).ready(function() {
    $('input[name="ambildarah"]').click(function() {
        if ($(this).prop("checked") == true) {
            {
                $('#pesan_cekstok').val(1)
            }
        } else if ($(this).prop("checked") == false) {
            $('#pesan_cekstok').val(0)
        }
    });
    $('input[name="valid"]').click(function() {
        if ($(this).prop("checked") == true) {
            {
                if ($('#pesan_cekstok').val() == '1') {
                    $('#simpanBil').removeAttr('disabled');
                }
            }
        } else if ($(this).prop("checked") == false) {
            $('#simpanBil').attr('disabled', true);
        }
    });
});
alertmsg = $("#alert").val()
$(document).ready(function() {
    if (alertmsg == 1) {
        Swal.fire({
            title: 'Input layanan berhasil!',
            text: "Cetak hasil inputan !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Cetak struk!'
        }).then((result) => {
            if (result.value) {
                window.open('<?= base_url('Billing/cetakBilling'); ?>');
                Swal.fire(
                    'Cetak!',
                    'Periksa tab selanjutnya',
                    'success'
                )
            }
        })
    } else if (alertmsg == 2) {
        swal({
            icon: 'error',
            title: 'Layanan berhasil diretur !',
        })
    } else if (alertmsg == 3) {
        swal({
            icon: 'error',
            title: 'Hasil expertisi disimpan !',
        })
    } else if (alertmsg == 4) {
        swal({
            icon: 'error',
            title: 'Update Hasil expertisi berhasil !',
        })
    } else if (alertmsg == 5) {
        swal({
            icon: 'error',
            title: 'retur gagal !',
        })
    } else if (alertmsg == 6) {
        swal({
            icon: 'error',
            title: 'Stok darah ditambah !',
        })
    } else if (alertmsg == 7) {
        swal({
            icon: 'error',
            title: 'Rumus jasa medis berhasil ditambah !',
        })
    }
});

//javascript dataBilling system

$(document).ready(function() {
    $('#tabelkunjungan').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});

$(document).ready(function() {
    $('#tabelrincianbiaya').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
$(document).ready(function() {
    $('#dataBillingsystem').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
$(document).ready(function() {
    $('#tabel_laporan_jm').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
$(document).ready(function() {
    $('#tableriwayatPA').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
$(document).ready(function() {
    $('#riwayatpasienEX').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
$(document).ready(function() {
    $('#tabelstokdarah').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
$(document).ready(function() {
    $('#tabel_tempat_sare').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
$('#dataBillingsystem').on('click', '.detailBilling', function() {
    var id = $(this).attr('data-id');
    $.ajax({
        type: 'post',
        url: '<?= base_url('Billing/detailBilling'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            id: id
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-detailbilling').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
});
$('#dataBillingsystem').on('click', '.rincianBiaya', function() {
    var counter = $(this).attr('data-counter');
    var rm = $(this).attr('data-rm');
    window.open('<?= base_url('SimrsPrint/PrintRincianBiaya/'); ?>' + rm + '/' + counter);
});

//expertisi PA
function tampilPx() {
    tgl_kemarin = $("#tgl_kemarin").val()
    tgl_sekarang = $("#tgl_kedepan").val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('Billing/cariRiwayat'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            tgl_kemarin: tgl_kemarin,
            tgl_sekarang: tgl_sekarang,
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('#tampildata').html(response);
            $('#datapasien').DataTable();
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
}

$('#tableriwayatPA').on('click', '.modalLihatExpert', function() {
    var id_detail = $(this).attr('id_detail');
    var nama_tarif = $(this).attr('nama_tarif');
    var nama_px = $(this).attr('nama_px');
    var no_rm = $(this).attr('no_rm');
    $.ajax({
        type: 'post',
        url: '<?= base_url('Billing/detailExpertisiPA'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            id_detail: id_detail,
            nama_tarif: nama_tarif,
            nama_px: nama_px,
            no_rm: no_rm
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-detailexpa').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
});

function printEx() {
    id_detail = $("#id_detail").val()
    window.open('<?= base_url('SimrsPrint/printEX/'); ?>' + id_detail);
}

//expertisi PA dokter
function tampilRiwayat() {
    $(".preloader").fadeIn();
    tgl_kemarin = $("#tgl_kemarin").val()
    tgl_sekarang = $("#tgl_kedepan").val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('ExpertisiPA/cariRiwayat'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            tgl_kemarin: tgl_kemarin,
            tgl_sekarang: tgl_sekarang,
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $(".preloader").fadeOut();
            $('#RIWAYATEX').html(response);
            $('#riwayatpasienEX').DataTable();
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
}

function getNomorPeriksa() {
    kode_unit = $('#kode_unit').val();
    kode_kunjungan = $('#kode_kunjungan').val();
    no_rm = $('#no_rm').val();
    counter = $('#counter').val();
    kode_header = $('#kode_header').val();
    id_header = $('#id_header').val();
    id_detail = $('#id_detail').val();
    unit_asal = $('#unit_asal').val();
    Mikroskopis = $('#Mikroskopis').val();
    Makroskopis = $('#Makroskopis').val();
    Kesimpulan = $('#Kesimpulan').val();
    kritis = $('#kritis').val();
    jenisSampel = $('#jenisSampel').val();
    cyto = $('#cyto').val();
    validasi = $('#validasi').val();
    tanggal_input = $('#tanggal_input').val();
    nama_tarif = $('#nama_tarif').val();
    $.ajax({
        type: 'post',
        url: '<?= base_url('ExpertisiPA/getNoPeriksa'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            kode_unit: kode_unit,
            kode_kunjungan: kode_kunjungan,
            no_rm: no_rm,
            counter: counter,
            kode_header: kode_header,
            id_header: id_header,
            id_detail: id_detail,
            unit_asal: unit_asal,
            Mikroskopis: Mikroskopis,
            Makroskopis: Makroskopis,
            Kesimpulan: Kesimpulan,
            kritis: kritis,
            jenisSampel: jenisSampel,
            cyto: cyto,
            validasi: validasi,
            tanggal_input: tanggal_input,
            nama_tarif: nama_tarif
        },
        async: true,
        dataType: 'json',
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(data) {
            $('#no_periksa').val(data.no_periksa);
            $('#addNomor').attr('disabled', true);
            $('#simex').removeAttr('disabled');
            // $('.modal-lihatrincian').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
}
$('#riwayatpasienEX').on('click', '.isiExpert', function() {
    var no_rm = $(this).attr('no_rm');
    var nama_pasien = $(this).attr('nama_pasien');
    var kode = $(this).attr('kode_unit');
    var kode_kunjungan = $(this).attr('kode_kunjungan');
    var no_rm = $(this).attr('no_rm');
    var nama_pasien = $(this).attr('nama_pasien');
    var jk = $(this).attr('jk');
    var umur = $(this).attr('umur');
    var counter = $(this).attr('counter');
    var dokkirim = $(this).attr('dokkirim');
    var nama_penjamin = $(this).attr('nama_penjamin');
    var kode_header = $(this).attr('kode_header');
    var id_header = $(this).attr('id_header');
    var id_detail = $(this).attr('id_detail');
    var unit_asal = $(this).attr('unit_asal');
    var nama_tarif = $(this).attr('nama_tarif');
    var tgl_input_layanan = $(this).attr('tgl_input_layanan');
    $.ajax({
        type: 'post',
        url: '<?= base_url('ExpertisiPA/isiExpert'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            no_rm: no_rm,
            nama_pasien: nama_pasien,
            kode: kode,
            kode_kunjungan: kode_kunjungan,
            no_rm: no_rm,
            nama_pasien: nama_pasien,
            jk: jk,
            umur: umur,
            dokkirim: dokkirim,
            counter: counter,
            nama_penjamin: nama_penjamin,
            kode_header: kode_header,
            id_header: id_header,
            id_detail: id_detail,
            unit_asal: unit_asal,
            nama_tarif: nama_tarif,
            tgl_input_layanan: tgl_input_layanan
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-expert').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
});
$('#riwayatpasienEX').on('click', '.modalEditexpert', function() {
    var id_detail = $(this).attr('id_detail');
    var nama_tarif = $(this).attr('nama_tarif');
    var no_rm = $(this).attr('no_rm');
    var nama_pasien = $(this).attr('nama_pasien');
    $.ajax({
        type: 'post',
        url: '<?= base_url('ExpertisiPA/editExpert'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            no_rm: no_rm,
            nama_pasien: nama_pasien,
            id_detail: id_detail,
            nama_tarif: nama_tarif
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-editexpert').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
});

function printExDok1() {
    id_detail = $("#id_detail").val()
    window.open('<?= base_url('SimrsPrint/printEX/'); ?>' + id_detail);
}

function tampilkunjungan() {
    nomor_rm = $("#rm_cari").val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('rincianBiaya/tampilKunjungan'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            nomor_rm: nomor_rm,
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('#TABELPX').html(response);
            $('#tabelkunjungan').DataTable();
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
}
// $('#rincianBiaya').click(function() {
//     var kode_layanan_header = $(this).attr('data-id');
//     window.open('<?= base_url('SimrsPrint/PrintRincianBiaya/'); ?>' + kode_layanan_header);
// });

function tampilborlosstoi() {
    $(".preloader").fadeIn();
    tgl_kemarin = $("#tgl_kemarin").val()
    tgl_sekarang = $("#tgl_kedepan").val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('indikatorPelayananRS/tampilborlosstoi'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            tgl_kemarin: tgl_kemarin,
            tgl_sekarang: tgl_sekarang,
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $(".preloader").fadeOut();
            $('#borlosstoi').html(response);
            $('#borlosstoi_bulanan').DataTable({
                "paging": false,
                "ordering": false,
                "fixedHeader": true,
                "info": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
}
$(document).ready(function() {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".set_bed"); //Fields wrapper
    var add_button = $(".setbedbtn"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row"><div class="form-group"><label>Unit</label><select class="form-control" id="" name="data[' +
                x +
                '][unit]"><option value="2001">SOKA</option><option value="2002">SERUNI</option><option value="2003">TERATAI</option><option value="2004">PERINATOLOGI</option><option value="2005">MAWAR</option><option value="2006">NUSA INDAH</option><option value="2007">ANGGREK</option><option value="2008">ANYELIR</option><option value="2009">BOUGENVILE II</option><option value="2010">DAHLIA</option><option value="2011">ICU</option><option value="2012">SEROJA</option><option value="2013">NICU</option><option value="2014">ROOMING IN</option><option value="2015">KEMUNING</option><option value="2016">BOUGENVILE I</option><option value="2017">BOUGENVILE III</option><option value="2018">MATERNAL</option></select></div><div class="form-group col-md-1"><label>Tahun</label><input type="text" required class="form-control" name="data[' +
                x +
                '][tahun]" id="th[]" value=""></div><div class="form-group"><label>bulan</label><select class="form-control" id=""name="data[' +
                x +
                '][bulan]"><option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option><option value="4">April</option><option value="5">Mei</option>    <option value="6">Juni</option><option value="7">Juli</option><option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option>          <option value="11">November</option><option value="12">Desember</option></select></div><div class="form-group col-md-2 "><label>Jumlah bed</label><input type="text" class="form-control" name="data[' +
                x +
                '][jumlah]" value=""></div><a href="#" class="remove_field"><i class="far fa-times-circle"></i></a></div>'
                );
        }
        $('#setbedsavebtn').removeAttr('Hidden');
        $(".datetimepicker").datetimepicker({
            format: 'yyyy-mm-dd h:i:s',
            autoclose: true,
            todayHighlight: true,
        });
        $(".get_unit").autocomplete({
            source: "<?php echo site_url('C_js/get_autocomplete_unit_ranap/?');?>",
            select: function(event, ui) {
                $("#kode_unit" + x).val(ui.item.kd_unit);
            }
        });
        $(".get_bulan").autocomplete({
            source: "<?php echo site_url('C_js/get_autocomplete_bulan/?');?>",
            select: function(event, ui) {
                $("#kode_unit" + x).val(ui.item.kd_unit);
            }
        });

    });
    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        if (x == 1) {
            $('#setbedsavebtn').attr('Hidden', true);
        }

    })
});

function tampiljm() {
    $(".preloader").fadeIn();

    tgl_kemarin = $("#tgl_kemarin").val()
    tgl_sekarang = $("#tgl_kedepan").val()
    dokter = $("#get_nama_paramedis").val()
    penjamin = $("#penjamin").val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('Jasa_medis_dokter/tampilJM'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            tgl_kemarin: tgl_kemarin,
            tgl_sekarang: tgl_sekarang,
            dokter: dokter,
            penjamin: penjamin
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $(".preloader").fadeOut();
            $('#jm_v').html(response);
            $('#jmtabel').DataTable({
                "paging": false,
                "ordering": false,
                "fixedHeader": true,
                "info": false,
                "responsive": true,
                scrollY: '50vh',
                scrollCollapse: true,
                "dom": 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
}
$('#jmtabel').on('click', '.rumus', function() {
    var kelompok = $(this).attr('data-kelompok');
    alert(kelompok)
});

function getborlos() {
    $(".preloader").fadeIn();
    var bulan = $('#pilihbulan').val();
    $.ajax({
        type: 'post',
        url: '<?= base_url('indikatorPelayananRS/indikatorbor'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            bulan: bulan
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $(".preloader").fadeOut();
            $('#indikatorbor').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });

}
</script>
<script type="text/javascript">

function simpanlaporanjm() {
    var tgl_awal = $('#tgl_kemarin').val()
    var tgl_akhir = $('#tgl_kedepan').val()
    var dokter = $('#get_nama_paramedis').val()
    var penjamin = $('#penjamin').val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('jasa_medis_dokter/simpan_laporan_jm'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            tgl_awal: tgl_awal,
            tgl_akhir: tgl_akhir,
            dokter: dokter,
            penjamin: penjamin,
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            Swal.fire(
                    'Laporan jasa medis berhasil disimpan !',
                );
                $('#laporan').load(location.href + ' #laporan');
                location.reload();
                // window.location.hash = '#laporan';
        }
    });
}
$('#tabel_laporan_jm').on('click', '.printdetail', function() {
    var id_detail = $(this).attr('id-detail');  
    location.reload();
    window.open("<?= base_url('Jasa_medis_dokter/Printdetail');?>"+'/'+id_detail); 
});
$('#tabel_laporan_jm').on('click', '.printlaporan', function() {
    var id_detail = $(this).attr('id-detail');  
    window.open("<?= base_url('Jasa_medis_dokter/Printdetail2');?>"+'/'+id_detail); 
});
$('#tabel_laporan_jm').on('click', '.hapuslaporan', function() {
    var id_detail = $(this).attr('id-detail');  
    window.open("<?= base_url('Jasa_medis_dokter/hapusdetail');?>"+'/'+id_detail); 
});
</script>
</body>

</html>