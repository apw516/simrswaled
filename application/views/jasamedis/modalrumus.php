<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Pilih kelompok</label>
                <select class="form-control" id="KELOMPOK" name="KELOMPOK">
                    <?php foreach($array as $a):?>
                    <option value="<?= $a['kelompok'];?>"><?= $a['kelompok'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Cara bayar</label>
                <select class="form-control" id="cara" name="cara">
                    <?php $cara = ''; foreach($array as $a):?>
                    <?php if($cara != $a['cara_bayar']):?>
                    <option value="<?= $a['cara_bayar'];?>"><?= $a['cara_bayar'];?></option>
                    <?php endif; $cara = $a['cara_bayar']; ?>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Kelas</label>
                <select class="form-control" id="kelas" name="kelas">
                   
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>                
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Rumus 1</label>
                <input type="text" class="form-control" id="RUMUS1" name="RUMUS1">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Rumus 2</label>
                <input type="text" class="form-control" id="RUMUS2" name="RUMUS2">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Rumus 3</label>
                <input type="text" class="form-control" id="RUMUS3" name="RUMUS3">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Rumus 4</label>
                <input type="text" class="form-control" id="RUMUS4" name="RUMUS4">
            </div>
        </div>
    </div>
</div>