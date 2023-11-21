<form action="<?= base_url('ExpertisiPA/simpanEX');?>" method="post">
    <div class="modal fade" id="modalPesanDarah" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pesan kantong darah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-pesandarah">
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="modalhapusDarah" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus kantong darah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-hapusdarah">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaleditDarah" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit kantong darah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-editdarah">
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".tambah-darah"); //Fields wrapper
    var add_button = $(".stokdarah"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row"><div class="form-group col-md-2"><label>Nomor kantong</label><input class="form-control" required id="data[][layanan]" name="data[' +
                x +
                '][nomor_kantong]" value=""></div><div class="form-group col-md-1"><label>Goldar</label><input required type="text" class="form-control" id="tarif[]" name="data[' +
                x +
                '][goldar]"value=""></div><div class="form-group col-md-1"><label>jenis</label><input type="text" required class="form-control" name="data[' +
                x +
                '][jenis]" id="jlh[]" value=""></div><div class="form-group col-md-2"><label>Tanggal aftap</label><input type="text" class="form-control datetimepicker" name="data[' +
                x +
                '][tgl_aftap]" value=""></div><div class="form-group col-md-2"><label>Tanggal periksa</label><input type="text" class="form-control datetimepicker" name="data[' +
                x +
                '][tgl_periksa]" value=""></div><div class="form-group col-md-2 "><label>Tanggal expired</label><input type="text" class="form-control datetimepicker" name="data[' +
                x +
                '][tgl_exp]" value=""></div><a href="#" class="remove_field"><i class="far fa-times-circle"></i></a></div>'
            ); //add input box
        }
        $('#simpanstok').removeAttr('Hidden');
        $(".datetimepicker").datetimepicker({
            format: 'yyyy-mm-dd h:i:s',
            autoclose: true,
            todayHighlight: true,
        });

    });
    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        if (x == 1) {
            $('#simpanstok').attr('Hidden', true);
        }

    })
});
$('#tabelstokdarah').on('click', '.pesandarah', function() {
    var id = $(this).attr('id-kantong');
    $.ajax({
        type: 'post',
        url: '<?= base_url('Bankdarah/pesandarah'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            id: id
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-pesandarah').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
});
$('#tabelstokdarah').on('click', '.hapusdarah', function() {
    var id = $(this).attr('id-kantong');
    $.ajax({
        type: 'post',
        url: '<?= base_url('Bankdarah/hapusdarah'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            id: id
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-hapusdarah').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
});
$('#tabelstokdarah').on('click', '.editdarah', function() {
    var id = $(this).attr('id-kantong');
    $.ajax({
        type: 'post',
        url: '<?= base_url('Bankdarah/editdarah'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            id: id
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-editdarah').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
});

function pesandarah() {
    var nomor_kantong = $('#id_kantong').val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('Bankdarah/pesandarahDone'); ?>',
        data: {
            nomor_kantong: nomor_kantong
        },
        async: true,
        dataType: 'json',
        success: function(data) {
            if (data.cekstok == 0) {
                Swal.fire(
                    'Pesan kantong darah,gagal!'
                )
            } else {
                Swal.fire(
                    'berhasil dipesan!'
                )
                location.reload()
            }
        }
    });
}

function hapusdarah() {
    var nomor_kantong = $('#id_kantong').val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('Bankdarah/hapusdarahDone'); ?>',
        data: {
            nomor_kantong: nomor_kantong
        },
        async: true,
        dataType: 'json',
        success: function(data) {
            if (data.cekstok == 0) {
                Swal.fire(
                    'stok darah dihapus!'
                )
                location.reload()
            } else {
                Swal.fire(
                    'gagal!'
                )
                location.reload()
            }
        }
    });
}

function editdarah() {
    var id = $('#id_kantong').val()
    var nomor_kantong = $('#nomor_kantong').val()
    var jenis = $('#jenis').val()
    var goldar = $('#goldar').val()
    var tgl_aftap = $('#tgl_aftap').val()
    var tgl_exp = $('#tgl_exp').val()
    var tgl_periksa = $('#tgl_exp').val()
    var status_darah = $('input[name=statusdarah]:checked').val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('Bankdarah/editdarahDone'); ?>',
        data: {
            id: id,
            nomor_kantong: nomor_kantong,
            jenis: jenis,
            goldar: goldar,
            tgl_aftap: tgl_aftap,
            tgl_exp: tgl_exp,
            tgl_periksa: tgl_periksa,
            status_darah: status_darah
        },
        async: true,
        dataType: 'json',
        success: function(data) {
            if (data.cekstok == 0) {
                Swal.fire(
                    'Edit berhasil !'
                )
                location.reload()
            } else {
                Swal.fire(
                    'gagal !'
                )
                location.reload()
            }
        }
    });
}
</script>

