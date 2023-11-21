<table id="riwayatpasienEX" class="table table-sm table-bordered text-center">
    <thead>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Umur</th>
        <th>Tanggal entry</th>
        <th>Tindakan</th>
        <th>---</th>
        <th>status</th>
    </thead>
    <tbody>
        <?php foreach($dataPasien as $d) : ?>
        <tr>
            <td><?= $d['no_rm'];?></td>
            <td><?= $d['NAMA_PASIEN'];?></td>
            <td><?= $d['UMUR'];?></td>
            <td><?= $d['tgl_input_layanan'];?></td>
            <td><?= $d['NAMA_TARIF'];?></td>
            <td>
                <?php if($d['no_periksa'] == '') :?>
                <button class="btn btn-sm btn-danger isiExpert" no_rm="<?= $d['no_rm'];?>"
                    nama_pasien="<?= $d['NAMA_PASIEN'];?>" data-id="<?= $d['id_header'];?>" data-toggle="modal"
                    data-target="#staticBackdrop" no_periksa="<?= $d['no_periksa'] ;?>"
                    kode_unit="<?= $d['kode_unit'] ;?>" kode_kunjungan="<?= $d['kode_kunjungan'] ;?>"
                    no_rm="<?= $d['no_rm'] ;?>" nama_pasien="<?= $d['NAMA_PASIEN'] ;?>" jk="<?= $d['JK'] ;?>"
                    umur="<?= $d['UMUR'] ;?>" dokkirim="<?= $d['dokkirim'];?>" counter="<?= $d['counter'] ;?>"
                    nama_penjamin="<?= $d['nama_penjamin'] ;?>" kode_header="<?= $d['kode_header'] ;?>"
                    id_header="<?= $d['id_header'] ;?>" id_detail="<?= $d['id_detail'] ;?>"
                    unit_asal="<?= $d['unit_asal'] ;?>" nama_tarif="<?= $d['NAMA_TARIF'] ;?>"
                    tgl_input_layanan="<?= $d['tgl_input_layanan'] ;?>" data-toggle="tooltip" data-placement="left"
                    title="Isi expertise">
                    <i class="fas fa-edit"></i></button>
                <?php else:?>
                <button class="btn btn-sm btn-warning modalEditexpert" no_rm="<?= $d['no_rm'];?>"
                    nama_pasien="<?= $d['NAMA_PASIEN'];?>" data-id="<?= $d['id_header'];?>" data-toggle="modal"
                    data-target="#modalEditExpert" id_detail="<?= $d['id_detail'] ;?>"
                    nama_tarif="<?= $d['NAMA_TARIF'] ;?>" data-toggle="tooltip" data-placement="left"
                    title="Edit expertise"><i class="fas fa-edit"></i></button>
                <?php endif;?>
            </td>
            <td <?php if($d['hasil'] == NULL || $d['hasil'] == '' && $d['validasi'] == '0'):?> class="bg-danger"
                <?php elseif($d['hasil'] != NULL && $d['validasi'] == '0'):?> class="bg-warning" <?php else:?>
                class="bg-success" <?php endif;?>>
                <?php if($d['hasil'] == NULL || $d['hasil'] == '' && $d['validasi'] == '0'):?> Belum diisi !
                <?php elseif($d['hasil'] != NULL && $d['validasi'] == '0'):?> Belum validasi !
                <?php else:?>sudah diisi !
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<script>
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
    var no_rm = $(this).attr('no_rm');
    var nama_pasien = $(this).attr('nama_pasien');
    var id_detail = $(this).attr('id_detail');
    var nama_tarif = $(this).attr('nama_tarif');
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
</script>