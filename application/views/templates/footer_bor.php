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
    $('#tabel_tempat_sare').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});

function tampilborlosstoi() {
    $(".preloader").fadeIn();
    tgl_kemarin = $("#tgl_kemarin").val()
    tgl_sekarang = $("#tgl_kedepan").val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('IndikatorPelayanan/tampilborlosstoi'); ?>',
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

function getborlos() {
    $(".preloader").fadeIn();
    var bulan = $('#pilihbulan').val();
    $.ajax({
        type: 'post',
        url: '<?= base_url('IndikatorPelayanan/indikatorbor'); ?>',
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
</body>

</html>