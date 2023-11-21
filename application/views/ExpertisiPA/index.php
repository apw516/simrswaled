<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Riwayat expertisi PA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Data billing system</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Tanggal awal</span>
                                        </div>
                                        <input type="text" class="form-control datepicker" id="tgl_kemarin"
                                            aria-describedby="basic-addon3" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Tanggal akhir</span>
                                        </div>
                                        <input type="text" class="form-control datepicker" id="tgl_kedepan"
                                            aria-describedby="basic-addon3" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <button class="btn btn-primary" onclick="tampilRiwayat()">Tampilkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $user['petugas'];?>
            <div class="tabelPasienEX" id="RIWAYATEX">
                <div class="container-fluid">
                    <table id="riwayatpasienEX" class="table table-sm table-bordered text-center">
                        <thead>
                            <th>Nomor RM</th>
                            <th>Nama Pasien</th>
                            <th>Umur</th>
                            <th>Tanggal entry</th>
                            <th>Tindakan</th>
                            <th>---</th>
                            <th>status</th>
                        </thead>
                        <tbody>
                            <?php foreach($dataPasien as $d) : ?>
                            <tr>
                                <td><?= $d['no_rm'];?></td>
                                <td><?= $d['NAMA_PASIEN'];?></td>
                                <td><?= $d['UMUR'];?></td>
                                <td><?= $d['tgl_input_layanan'];?></td>
                                <td><?= $d['NAMA_TARIF'];?></td>
                                <td>
                                    <?php if($d['no_periksa'] == '') :?>
                                        <?php if($user['petugas'] != 'casemi') :?>
                                    <button class="btn btn-sm btn-danger isiExpert" data-id="<?= $d['id_header'];?>"
                                        no_rm = "<?= $d['no_rm'];?>"
                                        nama_pasien = "<?= $d['NAMA_PASIEN'];?>"
                                        data-toggle="modal" data-target="#staticBackdrop"
                                        no_periksa="<?= $d['no_periksa'] ;?>" kode_unit="<?= $d['kode_unit'] ;?>"
                                        kode_kunjungan="<?= $d['kode_kunjungan'] ;?>" no_rm="<?= $d['no_rm'] ;?>"
                                        nama_pasien="<?= $d['NAMA_PASIEN'] ;?>" jk="<?= $d['JK'] ;?>"
                                        umur="<?= $d['UMUR'] ;?>" dokkirim="<?= $d['dokkirim'];?>"
                                        counter="<?= $d['counter'] ;?>" nama_penjamin="<?= $d['nama_penjamin'] ;?>"
                                        kode_header="<?= $d['kode_header'] ;?>" id_header="<?= $d['id_header'] ;?>"
                                        id_detail="<?= $d['id_detail'] ;?>" unit_asal="<?= $d['unit_asal'] ;?>"
                                        nama_tarif="<?= $d['NAMA_TARIF'] ;?>"
                                        tgl_input_layanan="<?= $d['tgl_input_layanan'] ;?>" data-toggle="tooltip"
                                        data-placement="left" title="Isi expertise">
                                        <i class="fas fa-edit"></i></button>
                                        <?php endif;?>
                                    <?php else:?>
                                    <button class="btn btn-sm btn-warning modalEditexpert"
                                        no_rm = "<?= $d['no_rm'];?>"
                                        nama_pasien = "<?= $d['NAMA_PASIEN'];?>"
                                        data-id="<?= $d['id_header'];?>" data-toggle="modal"
                                        data-target="#modalEditExpert" id_detail="<?= $d['id_detail'] ;?>"
                                        nama_tarif="<?= $d['NAMA_TARIF'] ;?>" data-toggle="tooltip"
                                        data-placement="left" title="Edit expertise"><i
                                            class="fas fa-edit"></i></button>
                                    <?php endif;?>
                                </td>
                                <td <?php if($d['hasil'] == NULL || $d['hasil'] == '' && $d['validasi'] == '0'):?>
                                    class="bg-danger" <?php elseif($d['hasil'] != NULL && $d['validasi'] == '0'):?>
                                    class="bg-warning" <?php else:?> class="bg-success" <?php endif;?>>
                                    <?php if($d['hasil'] == NULL || $d['hasil'] == '' && $d['validasi'] == '0'):?> Belum
                                    diisi !
                                    <?php elseif($d['hasil'] != NULL && $d['validasi'] == '0'):?> Belum validasi !
                                    <?php else:?>sudah diisi !
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->