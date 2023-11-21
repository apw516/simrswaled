<!-- Content Wrapper. Contains page content -->
<form action="<?= base_url('Billing/simpanBilling');?>" method="post">
    <div class="content-wrapper">
        <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Semerusmart - Billing system</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Billing system</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <?php if($rajal == 1) :?>
                <div class="container-fluid">
                <table id="tabel_pasien_poli" class="table table-sm table-bordered">
                <thead>
                <th>No RM</th>
                <th>Nama pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>action</th>
                </thead>
                <tbody>
                <?php foreach($px_poli as $p):?>
                            <tr>
                                <td><?= $p['no_rm'];?></td>
                                <td><?= $p['nama_px'];?></td>
                                <td><?= $p['jenis_kelamin'];?></td>
                                <td><?= $p['alamat'];?></td>
                                <td><button type="button" class="badge badge-info daftarpx" data-rm="<?= $p['no_rm'];?>" data-namapx="<?= $p['nama_px'];?>" data-alamat="<?= $p['alamat'];?>"
                                data-umur="<?= $p['Umur'];?>" data-unit="<?= $p['kode_unit'];?>" data-namaunit="<?= $p['nama_unit'];?>" data-kelas="<?= $p['KELAS_UNIT'];?>" data-kodepenjamin="<?= $p['kode_penjamin'];?>" data-penjamin=<?= $p['nama_penjamin'];?>>Daftar</button></td>                                 
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            <?php endif;?>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div  class="col-lg-12 justify-content-center">
                        <div <?php if($rajal == 1):?>hidden<?php endif;?> class="card">
                            <div class="card-header bg-secondary">Silahkan cari pasien</div>
                            <div class="card-body">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenisLayanan" id="jenisLayanan"
                                        value="1">
                                    <label class="form-check-label" for="inlineRadio1">Rawat Jalan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenisLayanan" id="jenisLayanan"
                                        value="2" checked>
                                    <label class="form-check-label" for="inlineRadio2">Rawat Inap</label>
                                </div>
                                <table class="table table-sm">
                                    <thead>
                                        <th>Tanggal</th>
                                        <th>Nomor RM</th>
                                        <th>Unit</th>
                                    </thead>
                                    <tr>
                                        <td><input class="form-control datepicker" id="tanggal_cari" name="tanggal_cari"
                                                value="<?= date('Y-m-d');?>" data-date-format="yyyy-mm-dd"></td>
                                        <td><input class="form-control" id="nomor_rm"></td>
                                        <td><input class="form-control" id="unit_daftar"><input hidden
                                                class="form-control" id="kode_unit_daftar"></td>
                                    </tr>
                                </table>
                                <a class="btn btn-primary float-right btn-lg" onclick="cariPasien()"><i
                                        class="fas fa-search mr-2"></i>Cari pasien</a>
                            </div>
                        </div>
                        <div  <?php if($rajal == 1):?>hidden<?php endif;?>  class="card">
                            <div id="tabelPasien" class="card-body">
                                <p class="text-danger">*Tidak ada hasil pencarian</p>
                                <div hidden class="spinner-border m-5" role="status" id="spinner">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h5 class="m-0">Pasien yang dipilih</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <td>Rm & nama pasien</td>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col">
                                                    <input required readonly type="text" class="form-control"
                                                        placeholder="Nomor RM" id="get_rm" name="get_rm">
                                                </div>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control"
                                                        placeholder="Nama pasien" id="get_nama_pasien"
                                                        name="get_nama_pasien">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="Nama pasien" id="get_jenis_kelamin">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td colspan="3"><textarea readonly class="form-control"
                                                id="get_alamat"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Umur</td>
                                        <td><input readonly class="form-control" id="get_Umur"><input hidden readonly
                                                class="form-control" id="get_tgl_lahir"></td>
                                        <td>Unit asal</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="First name" id="get_kode_unit"
                                                        name="get_kode_unit">
                                                    <input readonly type="text" class="form-control"
                                                        placeholder="Nama unit" id="get_unit" name="get_unit">
                                                </div>
                                                <div class="col">
                                                    <input readonly type="text" class="form-control" placeholder="kelas"
                                                        id="get_kelas" name="get_kelas">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="Last name" id="get_kamar">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="Last name" id="get_Bed">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="Last name" id="get_status_kunjungan">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="Last name" id="get_counter">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="Last name" id="get_KELAS_UNIT">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="Last name" id="get_kode_kunjungan"
                                                        name="get_kode_kunjungan">
                                                    <input hidden readonly type="text" class="form-control"
                                                        placeholder="Last name" id="get_ktp">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Penjamin</td>
                                        <td><input readonly class="form-control" id="get_nama_penjamin"><input readonly
                                                hidden class="form-control" id="get_kode_penjamin"
                                                name="get_kode_penjamin"></td>
                                        <td>Dokter pengirim</td>
                                        <td><input class="form-control" id="get_nama_paramedis"><input hidden
                                                class="form-control" id="get_Dokter" name="get_Dokter"></td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosa</td>
                                        <td colspan="3"><textarea class="form-control" id="diagnosa_pasien"
                                                name="diagnosa_pasien"></textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success">
                                <h5 class="m-0">Cari layanan</h5>
                            </div>
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nama layanan"
                                        aria-label="Recipient's username" aria-describedby="button-addon2"
                                        id="inputLayanan">
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-secondary" type="button" id="cariLayanan"
                                            onclick="cariLayanan()">Cari</a>
                                    </div>
                                </div>
                                <div id="tabelLayanan"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h5 class="m-0">Layanan yang dipilih</h5>
                            </div>
                            <div class="card-body input_fields_wrap">

                            </div>
                            <div hidden class="card-footer" id="card-footer">
                            <!-- <div class="form-check">                                  
                                    <input class="form-check-input" type="checkbox" value="" name="ambildarah" id="ambildarah">
                                    <label class="form-check-label text-danger" for="flexCheckChecked">
                                        Pakai kantong darah yang sudah dipesan !
                                    </label>
                                </div> -->
                                <div class="form-check">
                                    <input hidden  class="form-control" type="input" value="1" id="pesan_cekstok">
                                    <input class="form-check-input" type="checkbox" value="" name="valid" id="valid">
                                    <label class="form-check-label text-danger" for="flexCheckChecked">
                                        Saya yakin data sudah terisi dengan benar !
                                    </label>
                                </div><button disabled type="submit" class="btn btn-primary float-right"
                                    id="simpanBil">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</form>
<!-- /.content-wrapper -->