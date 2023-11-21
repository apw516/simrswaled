<div class="container">

    <table class="table table-sm">
        <tr>
            <td>No RM</td>
            <td><input class="form-control col-sm-6" value="<?= $kunjungan['no_rm'];?>"></td>
        </tr>
        <tr>
            <td>Nama pasien</td>
            <td><input class="form-control col-sm-6" value="<?= $pasien['nama_px'];?>"></td>
        </tr>
        <tr>
            <td>Tgl entry</td>
            <td><input class="form-control col-sm-6" value="<?= $header['tgl_entry'];?>"></td>
        </tr>
        <tr>
            <td>Unit asal</td>
            <td><input class="form-control col-sm-6" value="<?= $unit['nama_unit'];?>"></td>
        </tr>
    </table>

    <div class="container">
        <table class="table table-sm mt-1 text-center">
            <thead class="bg-info">
                <th>Nama layanan</th>
                <th>tarif</th>
                <th>Jumlah layanan</th>
                <th>Jumlah retur</th>
                <th>Total layanan</th>
            </thead>
            <tbody>
                <?php foreach($rincian as $d):?>
                <tr>
                    <td><?= $d['NAMA_TARIF'];?></td>
                    <td><?= rupiah($d['total_tarif']);?></td>
                    <td><?= $d['jumlah_layanan'];?></td>
                    <td><?= $d['jumlah_retur'];?></td>
                    <td><?= rupiah($d['total_layanan']);?></td>
                </tr>
                <?php endforeach;?>
                <!-- <tr>
                    <td><?= rupiah($header['tagihan_pribadi']);?></td>
                    <td><?= rupiah($header['tagihan_penjamin']);?></td>
                </tr> -->
            </tbody>
        </table>
        <table class="mb-4">
            <thead>
            <th  width="1500px" class="text-right">Grandtotal layanan</th>
            <th width="300px" class="text-center"><?= rupiah($header['total_layanan']);?></th>
            </thead>
        </table>
    </div>
  
</div>