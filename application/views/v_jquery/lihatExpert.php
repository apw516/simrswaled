<div class="container mt-2">
    <table class="table table-sm">
        <tr>
            <td>Nomor RM /  Nama pasien</td>
            <td><input readonly class="form-control" value="<?= $no_rm;?> / <?= $nama_px;?>" name="nomor_periksa"></td>
        </tr>
        <tr>
            <td>Nomor periksa</td>
            <td><input readonly class="form-control" value="<?= $isi['no_periksa'];?>" name="nomor_periksa"></td>
        </tr>
        <tr>
            <td>Jenis pemeriksaan</td>
            <td>
                <input readonly class="form-control" id="nama_tarif" name="nama_tarif" value="<?= $nama_tarif;?>">
                <input hidden class="form-control" id="id_detail" name="id_detail" value="<?= $isi['id_detail'];?>">
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
            <td><input readonly class="form-control" value="<?= $isi['tipe'];?>" name="tipe"></td>
        </tr>
        <tr>
            <td>Tipe</td>
            <td>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" id="kritis" name="kritis" value="1"
                        <?php if($isi['kritis'] == '1'):?> checked<?php endif;?>>
                    <label class="form-check-label" for="inlineCheckbox1">Kritis</label>
                </div>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" id="cyto" name="cyto" value="1"
                        <?php if($isi['cito'] == '1'):?> checked<?php endif;?>>
                    <label class="form-check-label" for="inlineCheckbox2">Cyto</label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Makroskopis</td>
            <td><textarea required readonly rows="9" cols="50" class="form-control" name="Makroskopis"
                    value="<?= $isi_expert['makro'];?>"><?= $isi_expert['makro'];?></textarea></td>
        </tr>
        <tr>
            <td>Mikroskopis</td>
            <td><textarea required readonly rows="9" cols="50" class="form-control"
                    name="Mikroskopis"><?= $isi_expert['mikro'];?></textarea></td>
        </tr>
        <tr>
            <td>Kesimpulan</td>
            <td><textarea required readonly rows="9" cols="50" class="form-control"
                    name="Kesimpulan"><?= $isi_expert['kesimpulan'];?></textarea></td>
        </tr>
        <tr>
            <td>Validasi</td>
            <td>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" id="validasi" name="validasi" value="1"
                        <?php if($isi['validasi'] != 0):?>checked<?php endif;?>>
                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="card">
    <div class="card-footer">
        <button type="button" class="btn btn-danger float-right ml-2" data-dismiss="modal"><i
                class="fas fa-times mr-2"></i>Batal</button>
        <?php if($isi['validasi'] != 0):?><button type="button" class="btn btn-primary float-right"
            onclick="printEx()"><i class="fas fa-print mr-2"></i>Print</button><?php endif;?>
    </div>
</div>