<div class="container">
<form action="<?= base_url('Billing/returDarah');?>" method="post">
<p>Nomor kantong</p>
<input readonly class="form-control" name="nomor_kantong" value="<?= $id;?>" placeholder="masukan jumlah yang diretur">
<button type="submit" class="btn btn-primary mt-2 mb-2 float-right">YA</button>
</form>
</div>