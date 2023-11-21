<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Riwayat expertisi PA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Riwayat experisi PA</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row justify-content-center mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Tanggal awal</span>
                                        </div>
                                        <input type="text" class="form-control datepicker" id="tgl_kemarin"
                                            aria-describedby="basic-addon3" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Tanggal akhir</span>
                                        </div>
                                        <input type="text" class="form-control datepicker" id="tgl_kedepan"
                                            aria-describedby="basic-addon3" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-1">
                                        <button class="btn btn-primary" onclick="tampilPx()">Tampilkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div id="tampildata" class="content">
        <div class="container-fluid">
            <table id="tableriwayatPA" class="table table-sm table-bordered table-hover">
            <thead>
                    <th>Nomor RM</th>
                    <th>Nama paien</th>
                    <th>Umur</th>
                    <th>Tanggal entry</th>
                    <th>Tindakan</th>
                    <th>---</th>
                    <th>Status</th>
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
                            <?php if($d['hasil'] == ''):?>
                            <!-- <button class="btn btn-sm btn-warning modalRetur" data-toggle="modal"
                                data-target="#modalRetur" id_detail="<?= $d['id_detail'] ;?>"><i
                                    class="fas fa-undo-alt mr-2"></i>Retur</button> -->
                            <?php else :?> <button class="btn btn-sm btn-success modalLihatExpert"
                                data-id="<?= $d['id_header'];?>" data-toggle="modal" data-target="#modaldetailexpa"
                                nama_px = "<?= $d['NAMA_PASIEN'];?>" no_rm = "<?= $d['no_rm'];?>" id_detail="<?= $d['id_detail'] ;?>" nama_tarif="<?= $d['NAMA_TARIF'] ;?>"><i
                                    class="fas fa-eye text-center"></i></button>
                            <?php endif;?>
                        </td>
                        <td <?php if($d['hasil'] == NULL && $d['validasi'] == '0'):?> class="bg-danger"
                            <?php elseif($d['hasil'] != NULL && $d['validasi'] == '0'):?> class="bg-warning"
                            <?php else:?> class="bg-success" <?php endif;?>>
                            <?php if($d['hasil'] == NULL && $d['validasi'] == '0'):?> Belum diisi !
                            <?php elseif($d['hasil'] != NULL && $d['validasi'] == '0'):?> Belum validasi !
                            <?php else:?>sudah diisi !
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->