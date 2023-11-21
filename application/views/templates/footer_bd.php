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
alertmsg = $("#alert").val()

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

$(document).ready(function() {
    $('#tabelstokdarah').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
</script>
</body>

</html>