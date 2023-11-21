<table id="datapasien_cari" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nomor RM</th>
        <th>Nomor BPJS</th>
        <th>Nomor KTP</th>
        <th>Nama pasien</th>
        <th>Tanggal lahir</th>
        <th>Jenis kelamin</th>
        <th>Alamat</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php foreach($mt_pasien as $m ) :?>
        <tr>
            <td><?= $m['no_rm'];?></td>
            <td><?= $m['no_Bpjs'];?></td>
            <td><?= $m['nik_bpjs'];?></td>
            <td><?= $m['nama_px'];?></td>
            <td><?= $m['tgl_lahir'];?></td>
            <td><?= $m['jenis_kelamin'];?></td>
            <td><?= $m['alamat'];?></td>
            <td></td>
        </tr>

        <?php endforeach;?>
    </tbody>
</table>