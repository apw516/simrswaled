<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="<?= base_url('Billing');?>">SemerusmartReborn</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.1.1.simrswaled
    </div>
</footer>
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
$(document).ready(function() {
    $('#tabel_laporan_jm').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
function tampiljm() {
    $(".preloader").fadeIn();

    tgl_kemarin = $("#tgl_kemarin").val()
    tgl_sekarang = $("#tgl_kedepan").val()
    dokter = $("#get_nama_paramedis").val()
    penjamin = $("#penjamin").val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('JasaMedis/tampilJM'); ?>',
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
</script>
<script type="text/javascript">

function simpanlaporanjm() {
    var tgl_awal = $('#tgl_kemarin').val()
    var tgl_akhir = $('#tgl_kedepan').val()
    var dokter = $('#get_nama_paramedis').val()
    var penjamin = $('#penjamin').val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('JasaMedis/simpan_laporan_jm'); ?>',
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
    window.open("<?= base_url('SimrsPrint/PrintJM');?>"+'/'+id_detail); 
});
$('#tabel_laporan_jm').on('click', '.printlaporan', function() {
    var id_detail = $(this).attr('id-detail');  
    window.open("<?= base_url('Jasa_medis_dokter/Printdetail2');?>"+'/'+id_detail); 
});
$('#tabel_laporan_jm').on('click', '.hapuslaporan', function() {
    var id_detail = $(this).attr('id-detail'); 
    $.ajax({
        type: 'post',
        url: '<?= base_url('JasaMedis/hapus_jm'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            id_detail: id_detail
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            Swal.fire(
                    'Laporan jasa medis berhasil dihapus !',
                );
                $('#laporan').load(location.href + ' #laporan');
                // window.location.hash = '#laporan';
        }
    });
});
</script>
</body>

</html>