<div class="container">
<div class="card">
<div class="card-body">
<input  class="form-control" value="<?= $ts_ly_dt['row_id_header'];?>" name="kode_header" id="kode_header">
<input hidden class="form-control" value="<?= $ts_ly_dt['id_layanan_detail'];?>" name="kode_detail" id="kode_detail">
<table style="font-size:medium"class="table table-sm">
<tr>
<td>Tindakan</td>
<td><?= $mt_tarif_header['NAMA_TARIF'];?></td>
</tr>
<tr>
<td>Jumlah layanan</td>
<td><?= $ts_ly_dt['jumlah_layanan'];?></td>
</tr>
<tr>
<td>Layanan yang diretur</td>
<td><input required class="form-control" id="jumlah_retur" name="jumlah_retur"></td>
</tr>
<tr>
<td>Alasan retur</td>
<td><textarea class="form-control" id="jumlah_retur" name="alasan_retur"></textarea></td>
</tr>
</table>
<h3>Yakin retur layanan ?</h3>
</div>
<div class="card-footer">
<button class="btn btn-success float-right">YAKIN</button>
<button class="btn btn-danger float-right mr-2" data-dismiss="modal">BATAL</button>
</div>
</div>
</div>
