<div class="container mt-2">
    <table class="table table-sm">
    <tr>
        <td>Nomor RM / Nama pasien</td>
        <td><?= $isi['no_rm'];?> / <?= $isi['nama_pasien'];?> </td>
    </tr>
    <tr>
    <td>Nomor periksa</td>
    <td><div class="input-group mb-3">
  <input readonly type="text" class="form-control" id="no_periksa" value="<?= $ts_exp_pa['no_periksa'];?>">
  <div class="input-group-append">
    <?php if($ts_exp_pa['no_periksa'] == '0'):?><button class="btn btn-outline-secondary" nama-tarif = "<?= $isi['nama_tarif'];?>" type="button" id="addNomor" onClick="getNomorPeriksa()">AMBIL NOMOR</button><?php endif;?>
  </div>
</div></td>
    </tr>
        <tr>
            <td>Jenis pemeriksaan</td>
            <td><input hidden readonly class="form-control" id="kode_unit" name="kode_unit" value="<?= $isi['kode'];?>">
                <input hidden readonly class="form-control" id="kode_kunjungan" name="kode_kunjungan" value="<?= $isi['kode_kunjungan'];?>">
                <input hidden readonly class="form-control" id="no_rm" name="no_rm" value="<?= $isi['no_rm'];?>">
                <input hidden readonly class="form-control" id="nama_pasien" name="nama_pasien"  value="<?= $isi['nama_pasien'];?>">
                <input hidden readonly class="form-control" id="jk" name="jk"  value="<?= $isi['jk'];?>">
                <input hidden readonly class="form-control" id="umur" name="umur"  value="<?= $isi['umur'];?>">
                <input hidden readonly class="form-control" id="counter" name="counter"  value="<?= $isi['counter'];?>">
                <input hidden readonly class="form-control" id="nama_penjamin" name="nama_penjamin"  value="<?= $isi['nama_penjamin'];?>">
                <input hidden readonly class="form-control" id="kode_header" name="kode_header"  value="<?= $isi['kode_header'];?>">
                <input hidden readonly class="form-control" id="id_header" name="id_header"  value="<?= $isi['id_header'];?>">
                <input hidden readonly class="form-control" id="id_detail" name="id_detail"  value="<?= $isi['id_detail'];?>">
                <input hidden readonly class="form-control" id="unit_asal" name="unit_asal"  value="<?= $isi['unit_asal'];?>">
                <input readonly class="form-control" id="nama_tarif" name="nama_tarif" value="<?= $isi['nama_tarif'];?>">
                <input  hidden class="form-control" id="tanggal_input" name="tanggal_input" value="<?= $isi['tgl_input_layanan'];?>">
                <!-- <input  readonly class="form-control" id="tgl_input_layanan_ex" nama="tgl_input_layanan_ex" value="<?= $isi['tgl_input_layanan'];?>"> -->

            </td>
        </tr>
        <!-- <tr>
            <td>Dokter DPJP</td>
            <td><input class="form-control" value="<?= $isi['dokkirim'];?>">
            <input class="form-control" value="<?= $isi['dokkirim'];?>">
            </td>
        </tr> -->
        <tr>
            <td>Jenis sampel</td>
            <td><input class="form-control" id="jenisSampel" name="jenisSampel"></td>
        </tr>
        <tr>
            <td>Tipe</td>
            <td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="kritis" name="kritis" value="1">
                    <label class="form-check-label" for="inlineCheckbox1">Kritis</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="cyto" name="cyto" value="1">
                    <label class="form-check-label" for="inlineCheckbox2">Cyto</label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Makroskopis</td>
            <td><textarea required rows="9" cols="50" class="form-control" name="Makroskopis" id="Makroskopis"></textarea></td>
        </tr>
        <tr>
            <td>Mikroskopis</td>
            <td><textarea required rows="9" cols="50" class="form-control" name="Mikroskopis" id="Mikroskopis"></textarea></td>
        </tr>
        <tr>
            <td>Diagnostik Klinik</td>
            <td><textarea required rows="9" cols="50" class="form-control" name="dgklinik" id="dgklinik"></textarea></td>
        </tr>
        <tr>
            <td>Diagnostik Pasca Bedah</td>
            <td><textarea required rows="9" cols="50" class="form-control" name="dgpascabedah" id="dgpascabedah"></textarea></td>
        </tr>
        <tr>
            <td>Kesimpulan</td>
            <td><textarea required rows="9" cols="50" class="form-control" name="Kesimpulan" id="Kesimpulan"> </textarea></td>
        </tr>
        <tr>
            <td>Validasi</td>
            <td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="validasi" name="validasi" value="2">
                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                </div>              
            </td>
        </tr>
    </table>
</div>  
<div class="card">
    <div class="card-footer">
        <button type="button" class="btn btn-danger float-right ml-2" data-dismiss="modal"><i class="far fa-window-close mr-2"></i>Batal</button>
        <button <?php if($ts_exp_pa['no_periksa'] == '0'):?> disabled <?php endif;?> id="simex" type="submit" class="btn btn-primary float-right"><i class="far fa-save mr-2"></i>Simpan</button>
    </div>
</div>
