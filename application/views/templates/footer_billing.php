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
function loadingsimpan()
{
    $(".preloader").fadeOut();
}
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
    $('#tabel_pasien_poli').DataTable({
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
    window.open('<?= base_url('SemerusmartPrint/printRincianBiaya/'); ?>' + rm + '/' + counter);
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
    window.open('<?= base_url('SemerusmartPrint/printEX/'); ?>' + id_detail);
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
    window.open('<?= base_url('SemerusmartPrint/printEX/'); ?>' + id_detail);
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
$('#rincianBiaya').click(function() {
    var kode_layanan_header = $(this).attr('data-id');
    window.open('<?= base_url('SemerusmartPrint/printRincian/'); ?>' + kode_layanan_header);
});

$('#tabel_pasien_poli').on('click', '.daftarpx', function() {
    var no_rm = $(this).attr('data-rm');
    var nama_px = $(this).attr('data-namapx');
    var alamat = $(this).attr('data-alamat');
    var umur = $(this).attr('data-umur');
    var unit = $(this).attr('data-unit');
    var nama_unit = $(this).attr('data-namaunit');
    var kelas = $(this).attr('data-kelas');
    var kode_penjamin = $(this).attr('data-kodepenjamin');
    var penjamin = $(this).attr('data-penjamin');
    $("#get_rm").val(no_rm); //sudah
    $("#get_nama_pasien").val(nama_px); //sudah
    $("#get_alamat").val(alamat); //sudah
    $("#get_Umur").val(umur); //sudah
    $("#get_unit").val(nama_unit); //sudah
    $("#get_kode_unit").val(unit); //sudah
    $("#get_kelas").val(kelas); //sudah
    $("#get_KELAS_UNIT").val(kelas);
    $("#get_nama_penjamin").val(penjamin); //sudah


});
</script>
</body>

</html>