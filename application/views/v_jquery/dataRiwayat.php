<table id="tableriwayatPA" class="table table-sm table-hover table-bordered text-center datapasien">
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
                <?php if($d['hasil'] == ''):?>
                <!-- <button class="btn btn-sm btn-warning modalRetur" data-toggle="modal" data-target="#modalRetur" id_detail="<?= $d['id_detail'] ;?>"><i
                        class="fas fa-undo-alt mr-2"></i>Retur</button> -->
                <?php else :?> <button class="btn btn-sm btn-success modalLihatExpert" data-id="<?= $d['id_header'];?>"
                    data-toggle="modal" nama_px = "<?= $d['NAMA_PASIEN'];?>" no_rm = "<?= $d['no_rm'];?>" data-target="#modaldetailexpa" id_detail="<?= $d['id_detail'] ;?>"
                    nama_tarif="<?= $d['NAMA_TARIF'] ;?>"><i class="fas fa-eye"></i></button>
                <?php endif;?>
            </td>
            <td <?php if($d['hasil'] == NULL && $d['validasi'] == '0'):?> class="bg-danger"
                <?php elseif($d['hasil'] != NULL && $d['validasi'] == '0'):?> class="bg-warning" <?php else:?>
                class="bg-success" <?php endif;?>>
                <?php if($d['hasil'] == NULL && $d['validasi'] == '0'):?> Belum diisi !
                <?php elseif($d['hasil'] != NULL && $d['validasi'] == '0'):?> Belum validasi !
                <?php else:?>sudah diisi !
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#tableriwayatPA').DataTable({
        "order": [
            [3, "desc"]
        ]
    });
});
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
</script>