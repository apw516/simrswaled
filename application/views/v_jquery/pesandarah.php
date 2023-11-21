<div class="container">
<form action="<?= base_url('Bankdarah/pesanKantong');?>" method="post">
<table class="table table-sm">
    <tr>
        <td>Nomor kantong</td>
        <td><input readonly class="form-control" id="nomor_kantong" value="<?= $stok['nomor_kantong'];?>"><input hidden class="form-control" id="id_kantong" value="<?= $stok['id'];?>"></td>
    </tr>
</table>
<button type="button" class="btn btn-primary float-right mb-3" onclick="pesandarah()">YA , Pesan kantong darah </button>
</form>
</div>