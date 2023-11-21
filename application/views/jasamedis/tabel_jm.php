<a class="btn btn-warning float-right" data-toggle="modal" onclick="addrumus()" data-target="#modalAddRumus"> <i
        class="fas fa-plus"></i> Rumus</a>
<table id="jmtabel" class="table table-sm table-bordered table-hover">
    <thead class="bg-info">
        <th>No</th>
        <th>NOMOR RM</th>
        <th>NAMA PASIEN</th>
        <th>NAMA UNIT</th>
        <th>KELAS</th>
        <th>KELOMPOK</th>
        <th>TANGGAL</th>
        <th>NAMA TARIF</th>
        <th>JUMLAH LAYANAN</th>
        <th>GRAND TOTAL LAYANAN</th>
        <th>CARA BAYAR</th>
        <th <?php if($penjamin != 'ASURANSILAIN'):?>hidden<?php endif;?>>NAMA PENJAMIN</th>
        <th>JASA MEDIS</th>
    </thead>
    <tbody>
        <?php $i = 1 ;?>
        <?php foreach($jm_v as $j):?>
        <tr>
            <td><?= $i;?></td>
            <td><?= $j['rm'];?></td>
            <td><?= $j['NAMA_PX'];?></td>
            <td><?= $j['NAMA_UNIT'];?></td>
            <td><?= $j['kode_unit'];?></td>
            <td><?= $j['KELOMPOK'];?></td>
            <td><?= $j['TGL'];?></td>
            <td><?= $j['NAMA_TARIF'];?></td>
            <td><?= $j['jumlah_layanan'];?></td>
            <td><?= rupiah($j['grantotal_layanan']);?></td>
            <td><?= $j['CARA_BAYAR'];?></td>
            <td <?php if($penjamin != 'ASURANSILAIN'):?>hidden<?php endif;?>><?= $j['NAMA_PENJAMIN'];?></td>
            <td><?= rupiah($j['JS']);?></td>
        </tr>
        <?php $i++;?>
        <input hidden class="form-control" name="" value="<?= $j['rm'];?>">
        <input hidden class="form-control" name="" value="<?= $j['NAMA_PX'];?>">
        <input hidden class="form-control" name="" value="<?= $j['NAMA_UNIT'];?>">
        <input hidden class="form-control" name="" value="<?= $j['kode_unit'];?>">
        <input hidden class="form-control" name="" value="<?= $j['KELOMPOK'];?>">
        <input hidden class="form-control" name="" value="<?= $j['TGL'];?>">
        <input hidden class="form-control" name="" value="<?= $j['NAMA_TARIF'];?>">
        <input hidden class="form-control" name="" value="<?= $j['jumlah_layanan'];?>">
        <input hidden class="form-control" name="" value="<?= $j['grantotal_layanan'];?>">
        <input hidden class="form-control" name="" value="<?= $j['CARA_BAYAR'];?>">
        <input hidden class="form-control" name="" value="<?= $j['NAMA_PENJAMIN'];?>">
      
        <?php endforeach;?>
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary float-right mt-3 mb-3" onclick="simpanlaporanjm()"><i
                class="far fa-save mr-2"></i>SIMPAN</button>       
    </div>
</div>
<div class="modal fade" id="modalAddRumus" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Masukan rumus kelompok jasa medis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('JasaMedis/simpanrumus');?>" method="post">
                <div class="modal-addRumus">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function addrumus() {
    var tgl_awal = $('#tgl_kemarin').val()
    var tgl_akhir = $('#tgl_kedepan').val()
    var dokter = $('#get_nama_paramedis').val()
    var penjamin = $('#penjamin').val()
    $.ajax({
        type: 'post',
        url: '<?= base_url('C_js/add_rumus'); ?>',
        /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
        data: {
            tgl_awal: tgl_awal,
            tgl_akhir: tgl_akhir,
            dokter: dokter,
            penjamin: penjamin,
        },
        /* memanggil fungsi getDetail dan mengirimkannya */
        success: function(response) {
            $('.modal-addRumus').html(response);
            /* menampilkan data dalam bentuk dokumen HTML */
        }
    });
}

</script>