<div class="container">
<form action="<?= base_url('Billing/returLayanan');?>" method="post">
<p>Nama layanan</p>
<input readonly class="form-control" value="<?= $nama;?>" placeholder="masukan jumlah yang diretur">
<input hidden readonly class="form-control" name="id_detail" value="<?= $id;?>" placeholder="masukan jumlah yang diretur">
<p>jumlah retur</p>
<input class="form-control" name="jlh_retur"  value="1" placeholder="masukan jumlah yang diretur">
<p>Alasan retur</p>
<textarea class="form-control" name ="alasan" value="1" placeholder="alasan layanan diretur"></textarea>

<button type="submit" class="btn btn-primary mt-2 mb-2 float-right">Retur</button>
</form>
</div>