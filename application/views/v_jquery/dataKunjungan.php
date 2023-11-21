<table id="tabelkunjungan" class="table table-sm table-bordered text-center">
    <thead>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Tanggal masuk</th>
        <th> --- </th>
    </thead>
    <tbody>
        <?php foreach($kunjungan as $k ):?>
            <tr>
                <td><?= $k['nomor_rm'];?></td>
                <td><?= $k['nama_pasien'];?></td>
                <td><?= $k['tgl_masuk'];?></td>
                <td><button class="btn btn-primary"><i class="fas fa-eye"></i></button></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>