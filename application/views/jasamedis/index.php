<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <input hidden class="form-control" id="alert" value="<?= $this->session->flashdata('message'); ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semerusmart - Jasa Medis Dokter</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Jasa Medis Dokter</li>
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
                        <div class="card-header"><h3> + detail jasa medis</h3></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Tanggal awal</span>
                                        </div>
                                        <input type="text" class="form-control datepicker" id="tgl_kemarin"
                                            aria-describedby="basic-addon3" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Tanggal akhir</span>
                                        </div>
                                        <input type="text" class="form-control datepicker" id="tgl_kedepan"
                                            aria-describedby="basic-addon3" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">pilih dokter</span>
                                        </div>
                                        <input type="text" class="form-control" id="get_nama_paramedis"                                            aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" id="penjamin">
                                            <option>-- Pilih penjamin -- </option>
                                            <option value="BPJS">BPJS</option>
                                            <option value="JAMPERSAL">JAMPERSAL</option>
                                            <option value="COVID19">COVID - 19</option>
                                            <option value="UMUM">UMUM</option>
                                            <option value="ASURANSILAIN">Asuransi Lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <button class="btn btn-primary" onclick="tampiljm()"> <i class="fas fa-eye mr-2"></i> Tampilkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="jm_v container-fluid" id="jm_v">

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div id="laporan" class="container-fluid">
            <table id="tabel_laporan_jm" class="table table-sm table-bordered">
                <thead>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Tanggal dibuat</th>
                    <th>Periode awal</th>
                    <th>Periode akhir</th>
                    <th>Penjamin</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php $no = 1;foreach($laporan as $u):?>
                    <tr>
                        <td><?= $no;?></td>
                        <td><?= $u['dokter'];?><?php if($u['status'] == 0):?><span class="badge badge-danger ml-2">New</span><?php endif;?></td>
                        <td><?= $u['created_date'];?></td>
                        <td><?= $u['tanggal_awal'];?></td>
                        <td><?= $u['tanggal_akhir'];?></td>
                        <td><?= $u['penjamin'];?></td>
                        <td><a class="btn btn-info btn-sm mr-1 printdetail" id-detail="<?= $u['id'];?>"><i class="fas fa-print"></i></a>
                        <a class="btn btn-warning btn-sm mr-1 printlaporan" id-detail="<?= $u['id'];?>"><i class="fas fa-print"></i></a>
                        <a class="btn btn-danger btn-sm mr-1 hapuslaporan" id-detail="<?= $u['id'];?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php $no++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->