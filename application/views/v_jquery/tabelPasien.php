<div hidden class="spinner-border m-5" role="status" id="spinner">
    <span class="sr-only">Loading...</span>
</div>
<table class="table table-sm table-hover" id="tbpx">
    <thead>
        <th>Nomor RM</th>
        <th>Nama Unit</th>
        <th>JK</th>
        <th>Nama</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php $nomor = 0;?>
        <?php foreach($tabel_pasien as $t) :?>
        <tr>
            <td><?= $t['no_rm'];?>
                <input hidden class="form-control" id="nama_unit<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['nama_unit'];?>">
                <input hidden class="form-control" id="no_rm<?= $t['kode_kunjungan'];?>" value="<?= $t['no_rm'];?>">
                <input hidden class="form-control" id="nama_px<?= $t['kode_kunjungan'];?>" value="<?= $t['nama_px'];?>">
                <input hidden class="form-control" id="jenis_kelamin<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['jenis_kelamin'];?>">
                <input hidden class="form-control" id="alamat<?= $t['kode_kunjungan'];?>" value="<?= $t['alamat'];?>">
                <input hidden class="form-control" id="tgl_lahir<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['tgl_lahir'];?>">
                <input hidden class="form-control" id="kode_unit<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['kode_unit'];?>">
                <input hidden class="form-control" id="Umur<?= $t['kode_kunjungan'];?>" value="<?= $t['Umur'];?>">
                <input hidden class="form-control" id="Dokter<?= $t['kode_kunjungan'];?>" value="<?= $t['Dokter'];?>">
                <input hidden class="form-control" id="kode_penjamin<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['kode_penjamin'];?>">
                <input hidden class="form-control" id="kamar<?= $t['kode_kunjungan'];?>" value="<?= $t['kamar'];?>">
                <input hidden class="form-control" id="Bed<?= $t['kode_kunjungan'];?>" value="<?= $t['Bed'];?>">
                <input hidden class="form-control" id="kelas<?= $t['kode_kunjungan'];?>" value="<?= $t['kelas'];?>">
                <input hidden class="form-control" id="status_kunjungan<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['status_kunjungan'];?>">
                <input hidden class="form-control" id="counter<?= $t['kode_kunjungan'];?>" value="<?= $t['counter'];?>">
                <input hidden class="form-control" id="ktp<?= $t['kode_kunjungan'];?>" value="<?= $t['ktp'];?>">
                <input hidden class="form-control" id="nama_paramedis<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['nama_paramedis'];?>">
                <input hidden class="form-control" id="nama_penjamin<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['nama_penjamin'];?>">
                <input hidden class="form-control" id="KELAS_UNIT<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['KELAS_UNIT'];?>">
                <input hidden class="form-control" id="kode_kunjungan<?= $t['kode_kunjungan'];?>"
                    value="<?= $t['kode_kunjungan'];?>">
            </td>
            <td><?= $t['nama_unit'];?></td>
            <td><?= $t['jenis_kelamin'];?></td>
            <td><?= $t['nama_px'];?></td>
            <td>
                <abs class="badge badge-success" data-id<?= $t['kode_kunjungan'];?>="<?= $t['kode_kunjungan'];?>" id="
                    daftar<?= $t['kode_kunjungan'];?>" onclick="pasien<?= $t['kode_kunjungan'];?>()">Daftar</a>
            </td>
        </tr>
        <script type="text/javascript">
        function pasien<?= $t['kode_kunjungan'];?>() {
            nama_unit = $('#nama_unit<?= $t['kode_kunjungan'];?>').val();
            no_rm = $('#no_rm<?= $t['kode_kunjungan'];?>').val();
            nama_px = $('#nama_px<?= $t['kode_kunjungan'];?>').val();
            jenis_kelamin = $('#jenis_kelamin<?= $t['kode_kunjungan'];?>').val();
            alamat = $('#alamat<?= $t['kode_kunjungan'];?>').val();
            tgl_lahir = $('#tgl_lahir<?= $t['kode_kunjungan'];?>').val();
            kode_unit = $('#kode_unit<?= $t['kode_kunjungan'];?>').val();
            Umur = $('#Umur<?= $t['kode_kunjungan'];?>').val();
            Dokter = $('#Dokter<?= $t['kode_kunjungan'];?>').val();
            kode_penjamin = $('#kode_penjamin<?= $t['kode_kunjungan'];?>').val();
            kamar = $('#kamar<?= $t['kode_kunjungan'];?>').val();
            Bed = $('#Bed<?= $t['kode_kunjungan'];?>').val();
            kelas = $('#kelas<?= $t['kode_kunjungan'];?>').val();
            status_kunjungan = $('#status_kunjungan<?= $t['kode_kunjungan'];?>').val();
            counter = $('#counter<?= $t['kode_kunjungan'];?>').val();
            ktp = $('#ktp<?= $t['kode_kunjungan'];?>').val();
            nama_paramedis = $('#nama_paramedis<?= $t['kode_kunjungan'];?>').val();
            nama_penjamin = $('#nama_penjamin<?= $t['kode_kunjungan'];?>').val();
            KELAS_UNIT = $('#KELAS_UNIT<?= $t['kode_kunjungan'];?>').val();
            kode_kunjungan = $('#kode_kunjungan<?= $t['kode_kunjungan'];?>').val();
            $("#get_unit").val(document.getElementById("nama_unit<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_rm").val(document.getElementById("no_rm<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_nama_pasien").val(document.getElementById("nama_px<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_jenis_kelamin").val(document.getElementById("jenis_kelamin<?= $t['kode_kunjungan'];?>")
                .value); //sudah
            $("#get_alamat").val(document.getElementById("alamat<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_tgl_lahir").val(document.getElementById("tgl_lahir<?= $t['kode_kunjungan'];?>").value);
            $("#get_kode_unit").val(document.getElementById("kode_unit<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_Umur").val(document.getElementById("Umur<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_Dokter").val(document.getElementById("Dokter<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_kode_penjamin").val(document.getElementById("kode_penjamin<?= $t['kode_kunjungan'];?>").value);
            $("#get_kamar").val(document.getElementById("kamar<?= $t['kode_kunjungan'];?>").value);
            $("#get_Bed").val(document.getElementById("Bed<?= $t['kode_kunjungan'];?>").value);
            $("#get_kelas").val(document.getElementById("KELAS_UNIT<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_status_kunjungan").val(document.getElementById("status_kunjungan<?= $t['kode_kunjungan'];?>")
                .value);
            $("#get_counter").val(document.getElementById("counter<?= $t['kode_kunjungan'];?>").value); //sudah
            $("#get_ktp").val(document.getElementById("ktp<?= $t['kode_kunjungan'];?>").value);
            $("#get_nama_paramedis").val(document.getElementById("nama_paramedis<?= $t['kode_kunjungan'];?>")
                .value); //sudah
            $("#get_nama_penjamin").val(nama_penjamin); //sudah
            $("#get_KELAS_UNIT").val(document.getElementById("KELAS_UNIT<?= $t['kode_kunjungan'];?>").value);
            $("#get_kode_kunjungan").val(document.getElementById("kode_kunjungan<?= $t['kode_kunjungan'];?>").value);
        }
        </script>
        <?php endforeach;?>
    </tbody> 
</table>