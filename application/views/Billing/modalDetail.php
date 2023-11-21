<div class="container">
<div class="card">
<div class="card-header"><h6 class="text-bold"><?= $ts_kj['no_rm'];?> / <?= $ts_kj['nama_px'];?> / <?= $ts_kj['kode_layanan_header'];?> / <button class="badge badge-success" id="printRincian" data-id ="<?= $ts_kj['id_header'];?>">PRINT RINCIAN</button> / 
<button class="badge badge-warning text-danger" id="printRincianRetur" data-id ="<?= $ts_kj['id_header'];?>">PRINT RETURAN </a></h6></div>
<div class="card-body">
<table id="tabledetail" class="table table-bordered table-sm text-center">
    <thead>
        <th>Nama layanan</th>
        <th>Tarif</th>
        <th>Jumlah layanan</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php foreach($ts_layanan_detail as $d):?>
        <tr>
            <td><?= $d['NAMA_TARIF'];?></td>
            <td><?= rupiah($d['tarif']);?></td>
            <td><?= $d['jumlah_layanan'];?></td>
            <td><?php if($d['jumlah_layanan'] > 0):?><button disabled class="btn btn-danger returbtn" data-nama = "<?= $d['NAMA_TARIF'];?>" data-id="<?= $d['id_layanan_detail'];?>">retur</button>
            <?php else:?> -
            <?php endif;?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</div>
</div>
<?php if($unit == '3011'):?>
<div class="card">
    <div class="card-header">Data pemakaian darah</div>
    <div class="card-body">
        <table id="tabelpemakaiandarah" class="table table-sm table-bordered text-center">
            <thead>
                <th>Nomor kantong</th>
                <th>Golongan darah</th>
                <th>Jenis</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php foreach($ts_pemakaian_darah as $d):?>
                <tr>
                    <td><?= $d['nomor_kantong'];?></td>
                    <td><?= $d['goldar'];?></td>
                    <td><?= $d['jenis'];?></td>
                    <td><?php if($d['status_retur'] == 1):?>Retur<?php endif;?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php endif;?>
</div>
<script>
$('#tabelpemakaiandarah').on('click', '.returdarah', function() {
    var id = $(this).attr('data-id');
    $("#modaldetailreturdarah").modal('show');
    $.ajax({
        type: 'post',
        url: '<?= base_url('Billing/detailReturdarah'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            id: id        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-detailreturdarah').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });

});
$('#tabledetail').on('click', '.returbtn', function() {
    var id = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    $("#modaldetailretur").modal('show');
    $.ajax({
        type: 'post',
        url: '<?= base_url('Billing/detailRetur'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            id: id,
            nama: nama
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-detailretur').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });

});
$('#printRincian').click(function(){
    var kode_layanan_header = $(this).attr('data-id');
    window.open('<?= base_url('SimrsPrint/PrintRincianBilling/'); ?>' + kode_layanan_header);
});
$('#printRincianRetur').click(function(){
    var kode_layanan_header = $(this).attr('data-id');
    window.open('<?= base_url('SimrsPrint/printRincianRetur/'); ?>' + kode_layanan_header);
});
</script>