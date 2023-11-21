<input hidden class="form-control" value="<?= $user['kode_unit'];?>" id="kode_unit">
<table class="table " id="tbly">
    <thead>
        <th>Kode</th>
        <th>Tindakan</th>
        <th>Tarif</th>
        <th></th>
    </thead>
    <tbody>
        <?php  $button = 1;?>
        <?php foreach($tb_layanan as $t) :?>
        <tr>
            <td><?= $t['kode'];?></td>
            <td><?= $t['Tindakan'];?></td>
            <td><?= rupiah($t['tarif']);?></td>
            <td width="120px" class="text-center"><button type="button" class="badge badge-success add_field_button"
                    data-id="<?= $t['Tindakan'];?>" id="button<?= $t['kode'];?>" data-kode="<?= $t['kode'];?>"
                    data-tarif="<?= $t['tarif'];?>">+</button>
            </td>
        </tr>
        <?php $button++;?>
        <?php endforeach;?>
    </tbody>
    <script type="text/javascript">
    $(document).ready(function() {
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var x = 0; //initlal text box count        
        $('#tbly').on('click', '.add_field_button', function() {
            var max_fields = 15; //maximum input boxes allowed    
            var kode_unit = $('#kode_unit').val();
            var layanan = $(this).attr('data-id');
            var kode = $(this).attr('data-kode');
            var tarif = $(this).attr('data-tarif');
            $('#button' + kode + '').attr('disabled', true);
            if (x < max_fields) { //max input box allowed
                x++; //text box increment   
                if (kode_unit == 3011) {
                    if (kode == 'TX26292' || kode == 'TX39652') {
                        $(wrapper).append(
                            '<div><a href="#" class="remove_field" kode=' + kode +
                            '><i class="far fa-times-circle"></i></a><div class="form-row"><div class="form-group col-md-5"><label>Nama layanan</label><input class="form-control" id="data[][layanan]" name="data[' +
                            x + '][layanan]" value="' + layanan +
                            '"><input hidden class="form-control" id="statuskantong' + x +
                            '" name="" value="0"><input hidden class="form-control" id="kodelayanan' +
                            x + '" name="data[' + x + '][kodelayanan]" value="' + kode +
                            '"></div><div class="form-group col-md-2"><label>Tarif</label><input type="text" class="form-control" id="tarif[]" name="data[' +
                            x + '][tarif]"value="' + tarif +
                            '"></div><div class="form-group col-sm-1"><label>jlh</label><input type="text" class="form-control" name="data[' +
                            x + '][jlh]" id="jlh' + x +
                            '" value="1"></div><div class="form-group col-md-2"><label>Disc</label><input type="text" class="form-control" id="disc[]" name="data[' +
                            x +
                            '][disc]" value="0"></div><div class="form-group col-md-1"><label>Cyto</label><input type="text" class="form-control" id="cyto[]" name="data[' +
                            x +
                            '][cyto]" value="0"></div></div><button disabled type="button" class="btn btn-warning addkantong" nomor-urut = "' +
                            x + '">+ darah</button><div class="kantongdarah' + x + '"></div></div>'
                        );
                    } else {
                        var status = 1;
                        $(wrapper).append(
                            '<div><a href="#" class="remove_field" kode=' + kode +
                            '><i class="far fa-times-circle"></i></a><div class="form-row"><div class="form-group col-md-5"><label>Nama layanan</label><input class="form-control" id="data[][layanan]" name="data[' +
                            x + '][layanan]" value="' + layanan +
                            '"><input hidden class="form-control" id="statuskantong' + x +
                            '" name="" value="0"><input hidden class="form-control" id="kodelayanan' +
                            x + '" name="data[' + x + '][kodelayanan]" value="' + kode +
                            '"></div><div class="form-group col-md-2"><label>Tarif</label><input type="text" class="form-control" id="tarif[]" name="data[' +
                            x + '][tarif]"value="' + tarif +
                            '"></div><div class="form-group col-sm-1"><label>jlh</label><input type="text" class="form-control" name="data[' +
                            x + '][jlh]" id="jlh' + x +
                            '" value="0"></div><div class="form-group col-md-2"><label>Disc</label><input type="text" class="form-control" id="disc[]" name="data[' +
                            x +
                            '][disc]" value="0"></div><div class="form-group col-md-1"><label>Cyto</label><input type="text" class="form-control" id="cyto[]" name="data[' +
                            x +
                            '][cyto]" value="0"></div></div><button type="button" class="btn btn-warning addkantong" nomor-urut = "' +
                            x +
                            '">+ darah</button><p class=",l-2">Klik untuk mengisi nomor kantong darah</p><div class="kantongdarah' +
                            x + '"></div></div>'
                        );
                        $('#status_pilih').val(status);
                    }
                } else {
                    $(wrapper).append(
                        '<div><a href="#" class="remove_field" kode=' + kode +
                        '><i class="far fa-times-circle"></i></a><div class="form-row"><div class="form-group col-md-5"><label>Nama layanan</label><input class="form-control" id="data[][layanan]" name="data[' +
                        x + '][layanan]" value="' + layanan +
                        '"><input hidden class="form-control" id="statuskantong' + x +
                        '" name="" value="0"><input hidden class="form-control" id="kodelayanan' +
                        x + '" name="data[' + x + '][kodelayanan]" value="' + kode +
                        '"></div><div class="form-group col-md-2"><label>Tarif</label><input type="text" class="form-control" id="tarif[]" name="data[' +
                        x + '][tarif]"value="' + tarif +
                        '"></div><div class="form-group col-sm-1"><label>jlh</label><input type="text" class="form-control" name="data[' +
                        x + '][jlh]" id="jlh' + x +
                        '" value="1"></div><div class="form-group col-md-2"><label>Disc</label><input type="text" class="form-control" id="disc[]" name="data[' +
                        x +
                        '][disc]" value="0"></div><div class="form-group col-md-1"><label>Cyto</label><input type="text" class="form-control" id="cyto[]" name="data[' +
                        x + '][cyto]" value="0"></div></div></div>'
                    );
                }
                // $('#simpanBil').removeAttr('disabled');     
                $('#card-footer').removeAttr('Hidden');
                swal({
                    icon: 'error',
                    title: layanan + " dipilih !",
                })
            }
        });
        $(wrapper).on("click", ".addkantong", function(e) { //user click on remove text
            e.preventDefault();
            var urutan = $(this).attr('nomor-urut');
            jlh1 = $('#jlh' + urutan + '').val()
            kode1 = $('#kodelayanan' + urutan + '').val()
            for (i = 0; i < jlh1; i++) {
                $('.kantongdarah' + urutan + '').append(
                    '<div><div class="input-group"><input required class="form-control col-md-6 cekstok mt-2" name="darah[' +
                    kode1 + i + '][nomorkantong]" pesan-1="pesan1' + i + '" pesan-2="pesan2' + i +
                    '"><div class="input-group-append"><span hidden class="text-success">Tersedia</span><span hidden class="text-danger ">Tidak ditemukan</span></div></input><input hidden class="form-control mt-2" name="darah[' +
                    kode1 + i + '][kodelayanan]" value="' + kode1 + '"><span hidden class="pesan[' +
                    i + '] text-danger" id="pesan1' + i +
                    '">kantong darah tidak ditemukan!</span><span hidden class="pesan[' + i +
                    '] text-success" id="pesan2' + i +
                    '">kantong darah ditemukan!</span></div></div>'
                );
                $(wrapper).on("change", ".cekstok", function(e) { //user click on remove text    
                    var nomorkantong = this.value;
                    var pesan1 = $(this).attr('pesan-1')
                    var pesan2 = $(this).attr('pesan-2')
                    $.ajax({
                        type: 'post',
                        url: '<?= base_url('Bankdarah/cekstok'); ?>',
                        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                        data: {
                            nomorkantong: nomorkantong
                        },
                        async: true,
                        dataType: 'json',
                        /* memanggil fungsi getDetail dan mengirimkannya */
                        success: function(data) {
                            if (data.cekstok == 0) {
                                Swal.fire({
                                    title: 'Nomor kantong tidak ditemukan',
                                    text: "periksa stok darah !",
                                    type: 'warning'
                                })
                                $('#pesan_cekstok').val('0');
                            } else {
                                $('#' + pesan1 + i).attr('hidden', true);
                                $('#' + pesan2 + i).removeAttr('hidden');
                                $('#pesan_cekstok').val('1');
                            }
                        }
                    });
                });
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            var kode2 = $(this).attr('kode');
            $('#button' + kode2 + '').removeAttr('disabled');
            $(this).parent('div').remove();
            x--;
            if (x == 0) {
                $('#simpanBil').attr('disabled', true);
                $('#card-footer').attr('Hidden', true);
                $('#simpanBil').attr('disabled');
            }

        });
    });
    </script>
</table>