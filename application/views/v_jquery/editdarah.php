<div class="container">
    <form action="<?= base_url('Bankdarah/pesanKantong');?>" method="post">
        <table class="table table-sm">
            <tr>
                <td>Nomor kantong</td>
                <td><input class="form-control" id="nomor_kantong" value="<?= $stok['nomor_kantong'];?>"><input hidden
                        class="form-control" id="id_kantong" value="<?= $stok['id'];?>"></td>
            </tr>
            <tr>
                <td>Jenis darah</td>
                <td><input class="form-control" id="jenis" value="<?= $stok['jenis'];?>"></td>
                <td>Golongan darah</td>
                <td><input class="form-control" id="goldar" value="<?= $stok['goldar'];?>"></td>
            </tr>
            <tr>
                <td>Tgl aftap</td>
                <td><input class="form-control" id="tgl_aftap" value="<?= $stok['tanggal_aftap'];?>"></td>
                <td>Tgl expired</td>
                <td><input class="form-control" id="tgl_exp" value="<?= $stok['tanggal_exp'];?>"></td>
                <td>Tgl periksa</td>
                <td><input class="form-control" id="tgl_periksa" value="<?= $stok['tanggal_periksa'];?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td colspan="2">
                    <div class="form-check form-check-inline">
                        <input <?php if($stok['status'] == 1 ):?>checked<?php endif;?> class="form-check-input" type="radio" name="statusdarah" id="statusdarah"
                            value="1">
                        <label class="form-check-label" for="inlineRadio1">Tersedia</label>
                    </div>
                    <!-- <div class="form-check form-check-inline">
                        <input <?php if($stok['status'] == 3 ):?>checked<?php endif;?> class="form-check-input" type="radio" name="statusdarah" id="statusdarah"
                            value="3">
                        <label class="form-check-label" for="inlineRadio2">Sudah dipesan</label>
                    </div>                    -->
                </td>
            </tr>
        </table>
        <button type="button" class="btn btn-success float-right mb-3" onclick="editdarah()">Simpan Perubahan </button>
    </form>
</div>